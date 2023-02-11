function [pos_list] = Kinematic_Pilot(x0, T_max)

    %NOTES:
    %units in mm, kg, s
    %Psi is wave height in this program
    %Eta is particle height
    
    load('faria_paper_constants.mat');
    
    %Initial droplet condition
    x = x0;
    y = 0.5;
    vx = 0;
    vy = 22.6;
    T=0;
    
    Trapped = 0;
    
    pos_list = [x0,T];
    
    %Drop Loop
        %We I'll  run the wave.m function for look_ahead_T to see if we can
        %find the T where it overlaps
    while T<=T_max
        
        iterations = look_ahead_T/dt + 1; %this ought to be a whole number
        wave(T, T+look_ahead_T,iterations);
        load('faria_paper_constants.mat','eta_list','phi_list');
        
        for t = 0:dt:look_ahead_T
            i = round(t/dt + 1);
            %Path of Pilot
            x_t = x + vx*t;
            y_t = y - 1/2*g*t^2 + vy*t;
            
            %find the index of x (ix) to compare heights with
            dist = abs(X - x_t);
            [~,ix] = min(dist);
            
            Psi = eta_list(i,ix);
            
            height_above_wave = y_t - R - Psi;
            
            if height_above_wave > 0
                Trapped = 0;
            else
                if Trapped == 1
                    disp("I'm trapped!");
                    
                else
                    if abs(height_above_wave) < 0.0001
                        t_impact = t;
                        eta = eta_list(i,:)';
                        phi = phi_list(i,:)';
                        save('faria_paper_constants.mat','eta','phi','-append');
                        
                    elseif height_above_wave < 0
                       
                        t_end = t;
                        t_start = t - dt;
                        eta = eta_list(i-1,:)';
                        phi = phi_list(i-1,:)';
                        save('faria_paper_constants.mat','eta','phi','-append');
                        
                        iterations = dt / dt_2 + 1; %this ought to be a whole number
                        wave(t_start + T, t_end + T, iterations);
                        load('faria_paper_constants.mat','eta_list','phi_list');
                        
                        for t_2 = 0:dt_2:dt
                            i = round(t_2 / dt_2 + 1);
                            
                            %Path of Pilot
                            x_t = x + vx*(t-dt + t_2);
                            y_t = y - 1/2*g*(t-dt + t_2)^2 + vy*(t-dt + t_2);

                            %find the index of x (ix) to compare heights with
                            dist = abs(X - x_t);
                            [~,ix] = min(dist);

                            Psi = eta_list(i,ix);

                            heights_above_wave(i) = y_t - R - Psi;
                        end
                        %Find the time step where the bath and drop are
                        %closest
                        [dist,it] = min(abs(heights_above_wave));
                        
                        %Find x position xi at it (index of t)
                        t_impact = t - dt + (it-1)*dt_2;
                        xi = x + vx*t_impact;
                        
                        %Find the x pixel closest to xi
                        dist = abs(X - xi);
                        [~,ix] = min(dist);
                        
                        %save x position to output list

                        %%% Derivatives
                        dxidt = vx;
                        detadt = vy - g*t_impact;

                        %%%Update the wave condition (todo add disturbance)
                        %todo, consider not rounding but re-running wave function
                        index = it;
                        
                        %bad fix to problem. hmu at lrhoden@uw.edu
                        if index == 1
                            index = 2;
                            disp('index was 1!')
                        end
                        if index == iterations
                            index = iterations - 1;
                            disp('index was iterations!')
                        end
                        
                        eta = eta_list(index,:)';
                        phi = phi_list(index,:)';

                        %dPsi / dx
                        etaft = fft(eta);
                        eta_gradient = ifft(1i*KX.*etaft);
                        dPsidx = eta_gradient(ix);

                        %dPsi / dt  todo make with faria PDEs
                        dPsi = (eta_list(index+1,ix) - eta_list(index-1,ix));
                        dPsidt = dPsi / (2*dt_2);

                        %%% Rectifying angles at impact; i.e., finding theta
                        %%% Angles and Velocities
                        theta_in = atan2(detadt,dxidt);
                        phi_angle = atan(dPsidx);
                        alpha_in = (theta_in + pi) - phi_angle;
                        u_in = sqrt((dxidt)^2 + (detadt - dPsidt)^2);
                        ut = -u_in*sin(pi/2 + alpha_in);
                        un = u_in*sin(alpha_in);

                        % Coefficient of restitution
                        We = rho*R*un^2/sigma;
                        We = log10(We);

                        CRn = -0.077877342024652*We + 0.219769978437467;
                        CRt = -0.004433030858978*We^4 - 0.045354932949122*We^3 + ...
                                -0.190613483794666*We^2 - 0.394841202070383*We + ...
                                0.620909597750850;

                        if CRn < 0.2
                           CRn = 0.2;
                           disp("CRn was small");
                        else
                            if CRn > 0.35
%                                 CRn = 0.35;
                                disp("CRn was big");
                            end
                        end

                        if CRt < 0.26
                           CRt = 0.26;
                           disp("CRt was small");
                        else
                            if CRt > 0.8
%                                 CRt = 0.8;
                                disp("CRt was big");
                            end
                        end

                        %%%%%%%%%%%%%%%%%%%%%%%

                        alpha_out = atan2(CRn*un,CRt*ut);

                        theta_out = alpha_out + phi_angle;
                        u_out = sqrt((CRn*un)^2 + (CRt*ut)^2);

                        %%% Iterating velocity and coordinates
                        vx = u_out*sin(pi/2 + theta_out);
                        if abs(vx) < 1e-12
                           vx = 0; 
                        end
                        vy = u_out*sin(theta_out);
                        x = xi;
                        y = Psi + R;
                        
                        %todo delete
                        disp("V= " + vx + ", " + vy)
                        
                        if vy < dPsidt
                            %vy = dPsidt;
                            Trapped = 1;
                            disp("I'm trapped");
                        end

                        %add disturbance to wave.m's eta
                        force = mass * (g + ut);
                        phi(ix) = phi(ix) + force;
                        phi(ix-1) = phi(ix-1) + 0.5*force;
                        phi(ix+1) = phi(ix+1) + 0.5*force;
                        phi(ix-2) = phi(ix-2) + 0.25*force;
                        phi(ix+2) = phi(ix+2) + 0.25*force;
                        phi(ix-3) = phi(ix-3) + 0.125*force;
                        phi(ix+3) = phi(ix+3) + 0.125*force;
                        save('faria_paper_constants.mat','eta','phi','-append');
                        break
                    end
                end
            end
        end
        T = T + t_impact;
        disp("(x,T) = " + xi + ", " + T)
        disp("------------------")
        pos_list = [pos_list; xi T];
        save('faria_paper_constants.mat','pos_list','-append');
    end