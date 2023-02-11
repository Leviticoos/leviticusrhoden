function output = wave(t_start, t_end, iterations)
    
    load('faria_paper_constants.mat');
    tspan = linspace(t_start,t_end, iterations);
    etaft = fft(eta);
    phift = fft(phi);
    y0 = [phift;etaft];
    [t,phieta] = ode45(@delta,tspan,y0);

    %todo weight this so that it is proportional to droplet mass, currently
    %it is only a random normal distribution
    etaft = phieta(end, x_steps+1:2*x_steps);
    phift = phieta(end, 1:x_steps);
    
    eta_list_ft = phieta(:, x_steps+1:2*x_steps);
    eta_list = zeros(length(t),x_steps);
    for i = 1:length(t)
       eta_list(i,:) = ifft(eta_list_ft(i,:)); 
    end
    
    phi_list_ft = phieta(:,1:x_steps);
    phi_list = zeros(length(t),x_steps);
    for i = 1:length(t)
       phi_list(i,:) = ifft(phi_list_ft(i,:));
    end
    
    eta = ifft(etaft);
    etaft = fft(eta);
    eta_gradient = ifft(1i*KX.*etaft);
    
    phi = ifft(phift);

%     dist = abs(KX-x_given);
%     [d,ix]=min(dist);
%     eta_x = eta(ix,1);
%     grad_x = eta_gradient(ix,1);
%     output = [eta_x,grad_x];
    output = 'I have waved';
    height = eta';
    plot(X,height,'k-.')

    save('faria_paper_constants.mat','eta','phi','eta_list','phi_list','-append');
end
    
function output = delta(t,phieta)
   
    load('faria_paper_constants.mat','x_steps','KX','gamma','omega','sigma','rho','Ekv','g','X','Y','b_funct');
    
    phi_ft = phieta(1:(x_steps));
    eta_ft = phieta((x_steps)+1:2*(x_steps));
    
    phi_dtt_ft = -1*((KX.^2)).*phi_ft;
    eta_dtt_ft = -1*((KX.^2)).*eta_ft;
    
    phi_dt_x = ifft((1i.*KX).*phi_ft);
    b_phi_dt_x = b_funct(X).*phi_dt_x;
    b_phi_dt_x_ft = fft(b_phi_dt_x);
    b_phi_dtt_x_ft = (1i.*(KX.*b_phi_dt_x_ft));
    
    phift_new = ...
            -(g*(1 + gamma*cos(omega*t))).*eta_ft +...
             (sigma/rho)*eta_dtt_ft +...
             2*Ekv*phi_dtt_ft;
    
    etaft_new = ...
            -1.*b_phi_dtt_x_ft + ...
            2*Ekv*(-(KX.^2)).*eta_ft;
            
    output = [phift_new; etaft_new];
    
end