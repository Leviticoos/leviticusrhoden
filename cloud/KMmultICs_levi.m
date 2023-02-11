function [x] = KMmultICs_levi(x0, T_max, gamma)

load('faria_paper_constants.mat');

%NOTES:
%height is dimensionalized by gravity related thing
%Time by forcing frequency
%acel, height dim by gravity
%todo, move my work to new amin

%eps and A are only for generating wave
eps = gamma/gammaF - 1; %reduced acceleration, GammaF is faraday, this only matters if above
A = a*sqrt(eps); %dim amplitude
A = A*(2*pi*f)^2/gamma; %Todo, what the?

G = 16*pi^2*g/gamma; %gravity for wave, is non-dim

%%%  Initializations
y = (A+1)*1.1;
vx = 0;
vy = 0;
T = 0;

%%% Initial drop
wave(0,dt,look_ahead_T,round(look_ahead_T / dt));
load('faria_paper_constants.mat','eta_list');
for t = 1:length(eta_list(:,1)) % Discretization of intermediate projectile motion
   
    %%% Path of flight
    eta = y - G*t^2/2 + vy*t; %This program uses eta as height of droplet, not wave
    
    dist = abs(KX-x0); %This finds closest pixel to x0, todo maybe make eta a function.
    [d,ix]=min(dist);
    
    Psi = eta_list(t,ix); %This program uses Psi as wave height, not wave velocity potential. 
    
    if eta < Psi + R/(gamma/(2*pi*f)^2) % Just past impact
       
        %%% Bisection method to find time of intersection
        
        t_low = t;
        t_high = t-dt;
        
        %Todo generate psi/eta for 10,000 steps between t_high and t_low,
        %start at eta_list(t-1,:)
        wave(x0,t_high,t_low,10000)
        
        for i = 1:10000
            
            t_impact = (t_low+t_high)/2;
            eta = y - G*t_impact^2/2 + vy*t_impact;
            Psi = A*sin(pi/2 + 2*pi*t_impact)*sin(pi/2 + 2*pi*x0) + sin(pi/2 + 2*pi*(2*t_impact-varphi));
        
            if abs(eta - (Psi + R/(gamma/(2*pi*f)^2))) < 0.0001
                break
            else if eta < Psi + R/(gamma/(2*pi*f)^2)
                    t_low = t_impact;
                else
                    t_high = t_impact;
                end
            end
        end
       
        %%% Derivatives
    dPsidx = -A*2*pi*sin(pi/2 + 2*pi*t_impact)*sin(2*pi*x0);
    dPsidt = -A*2*pi*sin(2*pi*t_impact)*sin(pi/2 + 2*pi*x0) - 4*pi*sin(2*pi*(2*t_impact-varphi));
    detadt = vy - G*t_impact;
    
    %%% Angles and Velocities
    theta_in = -pi/2;
    phi = atan(dPsidx*(gamma/(2*pi*f)^2)/lam_f);
    alpha_in = (theta_in + pi)-phi;
    u_in = abs((detadt - dPsidt)*(gamma/(2*pi*f)^2)/Tf);
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
                else if CRn > 0.35
                    CRn = 0.35;
                    end
                end
%                 
                if CRt < 0.2
                   CRt = 0.2;
                else if CRt > 1
                        CRt = 1;
                    end
                end
           %%%%%%%%%%%%%%%%%%%%%%%
           
           
      if ut ~= 0
           alpha_out = atan2(CRn*un,CRt*ut);
      else
           alpha_out = pi/2;
      end
                
      theta_out = alpha_out + phi;
      u_out = sqrt((CRn*un)^2 + (CRt*ut)^2);
      
      %%% Iterating velocity and coordinates
      vx = u_out*sin(pi/2 + theta_out)*Tf/lam_f;
      vy = u_out*sin(theta_out)*Tf/(gamma/(2*pi*f)^2);
      x = x0;
      y = Psi+R/(gamma/(2*pi*f)^2);
      
      break
      
    end
        
end

%%% Subsequent drops

Trapped = 0;
T=t_impact;

while T <= T_max
for t = dt:dt:4  % Discretization of intermediate projectile motion
   
    T = T + dt;
    
    %%% Path of flight
    xi = x + vx*t;
    eta = y - G*t^2/2 + vy*t;
    Psi = A*sin(pi/2 + 2*pi*T)*sin(pi/2 + 2*pi*xi) + sin(pi/2 + 2*pi*(2*T-varphi));

    if eta > Psi + R/(gamma/(2*pi*f)^2)
        Trapped = 0;
    
    else %%% Just past impact
        
        if Trapped == 1
            
                %%% Chatering fix
            dxidt = vx;
            dPsidx = -2*pi*A*sin(pi/2 + 2*pi*T)*sin(2*pi*xi);
            dPsidt = -2*pi*A*sin(2*pi*T)*sin(pi/2 + 2*pi*xi) - 4*pi*sin(2*pi*(2*T-varphi)) + dPsidx*dxidt;
            
            y = Psi + R/(gamma/(2*pi*f)^2);
            vy = dPsidt;
            break
            
        else
       
            if eta == Psi + R/(gamma/(2*pi*f)^2)
                t_impact = t;
            else
        t_low = t;
        t_high = t-dt;
        T_prev = T-t;
        
        for i = 1:10000
        
            t_impact = (t_low+t_high)/2;
            T = T_prev + t_impact;
            xi = x + vx*t_impact;
            eta = y - G*t_impact^2/2 + vy*t_impact;
            Psi = A*sin(pi/2 + 2*pi*T)*sin(pi/2 + 2*pi*xi) + sin(pi/2 + 2*pi*(2*T-varphi));
            
            if abs(eta - (Psi + R/(gamma/(2*pi*f)^2))) < 0.0001
                break
            else if eta < Psi + R/(gamma/(2*pi*f)^2)
                    t_low = t_impact;
                else
                    t_high = t_impact;
                end
            end
        end
            end
        
            %%% Derivatives
            dxidt = vx;
            detadt = vy - G*t_impact;
            dPsidx = -2*pi*A*sin(pi/2 + 2*pi*T)*sin(2*pi*xi);
            dPsidt = -2*pi*A*sin(2*pi*T)*sin(pi/2 + 2*pi*xi) - 4*pi*sin(2*pi*(2*T-varphi)) + dPsidx*dxidt;
            
            %%% Rectifying angles at impact; i.e., finding theta

            theta_in = atan2(detadt*(gamma/(2*pi*f)^2)/Tf,dxidt*lam_f/Tf);
            
            phi = atan(dPsidx*(gamma/(2*pi*f)^2)/lam_f);
            alpha_in = (theta_in + pi) - phi;
            u_in = sqrt((dxidt*lam_f/Tf)^2 + ((detadt - dPsidt)*(gamma/(2*pi*f)^2)/Tf)^2);
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
                else if CRn > 0.35
                    CRn = 0.35;
                    end
                end
                 
                if CRt < 0.2
                   CRt = 0.2;
                else if CRt > 1
                        CRt = 1;
                    end
                end
                %%%%%%%%%%%%%%%%%%%%%%%
                
                
            alpha_out = atan2(CRn*un,CRt*ut);
                 
            theta_out = alpha_out + phi;
            u_out = sqrt((CRn*un)^2 + (CRt*ut)^2);
            
            %%% Iterating velocity and coordinates
            vx = u_out*sin(pi/2 + theta_out)*Tf/lam_f;
%             if abs(vx) < 1e-15
%                vx = 0; 
%             end
            vy = u_out*sin(theta_out)*Tf/(gamma/(2*pi*f)^2);
            x = xi;
            y = Psi + R/(gamma/(2*pi*f)^2);
            
            if vy < dPsidt
                %vy = dPsidt;
                Trapped = 1;
            end
           
                        break
        end
            
    end
    
end
end
    
end

