function [x_list] = PWH_kinematic(x0, T_max)

    %%% Dimensional parameters in mm, kg, s

    load('faria_paper_constants.mat');

    %NOTES:
    %height is dimensionalized by gravity related thing
    %Time by forcing frequency
    %acel, height dim by gravity
    %todo determine how to set up A
    %This program uses Psi as wave height, not wave velocity potential.
    %mm s grams?

    %%%  Initializations
    y = 1;
    vx = 0;
    vy = 0;
    T = 0;
    
    x_list = x0;

    %%% Initial drop
    wave(dt,look_ahead_T,round(look_ahead_T / dt));
    load('faria_paper_constants.mat','eta_list','phi_list');
    for t = dt:dt:look_ahead_T % Discretization of intermediate projectile motion

        %%% Path of flight
        eta_drop = y - g*t^2/2 + vy*t;

        dist = abs(KX-x0); %This finds closest pixel to x0, todo maybe make eta a function.
        [~,ix]=min(dist);

        Psi = eta_list(t/dt,ix);  %t/dt is an integer index for eta_list

        if eta_drop < Psi + R % Just past impact

            %%% Bisection method to find time of intersection
            
            %save new phi and eta for bisection method
            eta = eta_list(t/dt - 1, :)';
            phi = phi_list(t/dt - 1,:)';
            save('faria_paper_constants.mat','eta','phi','-append');
            
            t_end = t;
            t_start = t-dt;
            wave(t_start,t_end,1/dt_2);
            load('faria_paper_constants.mat','eta_list','phi_list');

            for i = 1:(1/dt_2)

                t_impact = (t_end+t_start)/2;
                eta_drop = y - g*t_impact^2/2 + vy*t_impact;
                Psi =  eta_list(i,ix);

                if abs(eta_drop - (Psi + R)) < 0.0001
                    break
                else
                    if eta_drop < Psi + R
                        t_end = t_impact;
                    else
                        t_start = t_impact;
                    end
                end
            end

            %%%Update the wave condition (todo add disturbance)
            %todo, consider not rounding but re-running wave function
            index = round(((t_impact-t+dt) / (dt))*1/dt_2);
            eta = eta_list(index,:)';
            phi = phi_list(index,:)';
            
            %%% Derivatives
            %these are based off of eta_ft * ik and the faria PDE

            %dPsi / dx
            etaft = fft(eta);
            eta_gradient = ifft(1i*KX.*etaft);
            dPsidx = eta_gradient(ix);
            %dPsi / dt todo make with faria PDEs
            dPsi = (eta_list(index+1,ix) - eta_list(index-1,ix));
            dPsidt = dPsi / (2*dt_2);
            %dEta / dt
            detadt = vy - g*t_impact;

            %%% Angles and Velocities
            theta_in = -pi/2;
            phi_angle = atan(dPsidx);
            alpha_in = (theta_in + pi)-phi_angle;
            u_in = abs((detadt - dPsidt));
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
            else
                if CRn > 0.35
                    CRn = 0.35;
                end
            end
    %                 
            if CRt < 0.26
               CRt = 0.26;
            else
                if CRt > 0.8
                    CRt = 0.8;
                end
            end


            %%%%%%%%%%%%%%%%%%%%%%%


            if ut ~= 0
               alpha_out = atan2(CRn*un,CRt*ut);
            else
               alpha_out = pi/2;
            end

            theta_out = alpha_out + phi_angle;
            u_out = sqrt((CRn*un)^2 + (CRt*ut)^2);

            %%% Iterating velocity and coordinates
            vx = u_out*sin(pi/2 + theta_out);
            vy = u_out*sin(theta_out);
            x = x0;
            y = Psi+R;      %/(g/(2*pi*f)^2); todo check if this is important?
            
            %Add the point disturbance, todo model it difrently if feeling
            %spicy
            eta(ix) = eta(ix) + point_disp;
            save('faria_paper_constants.mat','eta','phi','-append');
            disp('Initial Drop Dropped')
            break

        end

    end

    %%% Subsequent drops

    Trapped = 0;
    T=t_impact;

    while T <= T_max
        tic
        wave(dt,look_ahead_T,round(look_ahead_T / dt));
        
        load('faria_paper_constants.mat','eta_list');
        for t = dt:dt:look_ahead_T  % Discretization of intermediate projectile motion

            T = T + dt;
            disp(T);
            
            %%% Path of flight
            xi = x + vx*t;
            eta_drop = y - g*t^2/2 + vy*t;

            dist = abs(KX-xi); %This finds closest pixel to x0, todo maybe make eta a function.
            [~,ix]=min(dist);

            Psi = eta_list(t/dt,ix);  %t/dt is an integer index for eta_list
            
            if eta_drop > Psi + R
                Trapped = 0;
            
            elseif t == look_ahead_T
                disp('I never collided in all of look_ahead_T!');
                break;
                    
            else %%% Just past impact

                if Trapped == 1

                        %%% Chatering fix
                    dxidt = vx;

                    %dPsi / dx
                    etaft = fft(eta);
                    eta_gradient = ifft(1i*KX.*etaft);
                    dPsidx = eta_gradient(ix);
                    %dPsi / dt todo make with faria PDEs
                    dPsi = (eta_list(index+1,ix) - eta_list(index-1,ix));
                    dPsidt = dPsi / (2*dt_2);

                    y = Psi + R;
                    vy = dPsidt;
                    break

                else
                    
                    if abs(eta_drop - (Psi + R)) < 0.0001
                        t_impact = t;
                        
                        %save new phi and eta
                        eta = eta_list(t/dt, :)';
                        phi = phi_list(t/dt,:)';
                        save('faria_paper_constants.mat','eta','phi','-append');
                        disp('I did not need the bisection method')
                        
                    elseif eta_drop < Psi + R
                        t_end = t;
                        t_start = t-dt;
                        T_prev = T-t;

                        %save new phi and eta for bisection method
                        eta = eta_list(t/dt - 1, :)';
                        phi = phi_list(t/dt - 1,:)';
                        save('faria_paper_constants.mat','eta','phi','-append');

                        wave(t_start - (dt*dt_2),t_end + (dt*dt_2),dt/dt_2+2);
                        load('faria_paper_constants.mat','eta_list','phi_list');
                        disp('I DID need the bisection method')
                        %todo bisection is a dumb idea for this case.
                        %Simply find the smallest diffrence in all the
                        %eta's generated
%                         for i = 1:1/dt_2
% 
%                             t_impact = (t_low+t_high)/2;
%                             T = T_prev + t_impact;
%                             xi = x + vx*t_impact;
%                             eta_drop = y - g*t_impact^2/2 + vy*t_impact;
% 
%                             Psi = eta_list(i,ix);
% 
%                             
%                         end
                        
                        eta_drops = [];
                        psi_locals = [];
                        
                        for i = 1:length(eta_list(:,1)) %HERE FIX HERE
                            
                            t_impact = i*(t_end-t_start)*dt_2+t;
                            
                            eta_drops(i) =  y - g*t_impact^2/2 + vy*t_impact;
                            
                            xi = x + vx*t_impact;

                            dist = abs(KX-xi); %This finds closest pixel to x0, todo maybe make eta a function.
                            [~,ix]=min(dist);
                            
                            psi_locals(i) = eta_list(i,ix); 
                            
                        end
                        dif = psi_locals + R - eta_drop;
                    else
                        disp('something shurgary happened')
                    end
                    %Find the smallest delta and find the x position of the
                    %droplet
                    [~,it] = min(abs(dif));
                    disp(it)
                    t_impact = it*(t_end-t_start)*dt_2;
                    xi = x + vx*t_impact;
                    
                    %save x position to output list
                    x_list = [x_list, xi];
                    
                    %%% Derivatives
                    dxidt = vx;
                    detadt = vy - g*t_impact;
                    
                    %%%Update the wave condition (todo add disturbance)
                    %todo, consider not rounding but re-running wave function
                    index = it;
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
                    else
                        if CRn > 0.35
                            CRn = 0.35;
                        end
                    end

                    if CRt < 0.26
                       CRt = 0.26;
                    else
                        if CRt > 0.8
                            CRt = 0.8;
                        end
                    end
                    
                    %%%%%%%%%%%%%%%%%%%%%%%

                    alpha_out = atan2(CRn*un,CRt*ut);

                    theta_out = alpha_out + phi_angle;
                    u_out = sqrt((CRn*un)^2 + (CRt*ut)^2);

                    %%% Iterating velocity and coordinates
                    vx = u_out*sin(pi/2 + theta_out);
                    if abs(vx) < 1e-15
                       vx = 0; 
                    end
                    vy = u_out*sin(theta_out);
                    x = xi;
                    y = Psi + R;

                    if vy < dPsidt
                        %vy = dPsidt;
                        Trapped = 1;
                    end
                    
                    %add disturbance to wave.m's eta
                    eta(ix) = eta(ix) + point_disp;
                    save('faria_paper_constants.mat','eta','phi','-append');
                    disp('One Whole Bounce!');
                    toc
                    break
                    
                end

            end

        end
    end
    
end