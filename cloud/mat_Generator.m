name = 'faria_paper_constants.mat';

%NOTES:
%height is dimensionalized by gravity related thing
%Time by forcing frequency
%acel, height dim by gravity
%%% Dimensional parameters in mm, kg, s

%Variable Setup
%Initial Constants
    gamma = 4.2; %Forcing amplitude of the bath
    Ekv = 16.05; %effective kinematic viscosity, mm^2/s
    sigma = 0.0206; %Surface tension, N/m, m's cancel out
    rho = 9.49e-9; % dim oil density kg/mm^3
    g = 9.80665*10^3; %gravity in mm/s^2
    f = 80; %Frequency of shakeing bath
    omega = f*2*pi; %angular velocity of table ossilation

    %droplet
    R = 0.39; %mm
    mass = (4/3)*pi*(R^3)*rho; %kg
    point_disp = -mass*g; %kg mm / s^2 = N * 10^3

    %Sim Settings
    start_t = 0;
    x_length = 30; %mm
    x_steps = 2^10;
    coral_radius = 5;

    %Amin Constants
    a = 0.5/sqrt(1.047 - 1); %dim amplitude at gamma = 1.047gammaF
    varphi = omega/4;
    dt = 0.0001;
    dt_2 = .001 * dt;
    look_ahead_T = 0.015; %Seconds to look ahead for amin's function
    gammaF = 4.2; %todo check nessesity, maybe need to find on own
    
    %Initial Functions
    table_force =@(t) g*(1 + gamma*cos(omega*t));
    droplet_force =@(t) mass*g*(mod(t,(4*pi/omega)*steps_per_sec) == 0);

    %Topology of the arena
    topology_depths = [6.09,0.42];
    area_1 =@(x) (x < coral_radius);
    area_2 =@(x) (x >= coral_radius);

    topology =@(x) area_1(x).*topology_depths(1) +...
        area_2(x).*topology_depths(2); 

    %k values and b_funct definitions
    k_val = [];
    for h = topology_depths
        syms k
        k_solver = ((g + (sigma/rho)*k^2)*k*tanh(h*k)) == (omega/2)^2;
        new_k = vpasolve(k_solver,k,1);
        k_val = [k_val double(new_k)];
    end
    b_funct =@(x) area_1(x).*tanh(k_val(1)*height(1))./k_val(1) +...
        area_2(x).*tanh(k_val(2)*height(2))./k_val(2);

    %Set up Linspace and meshes
    x2 = linspace(-x_length/2,x_length/2,x_steps+1);
    x = x2(1:x_steps);
    y2 = 0;
    y = 0;
    [X,Y] = meshgrid(x,y);
    X2 = X;
    Y2 = Y;
    X = reshape(X,[],1);
    Y = reshape(Y,[],1);

    kx = (2*pi/x_length)*[0:x_steps/2-1, 0, -x_steps/2+1:-1];
    [KX,KY] = meshgrid(kx, [0]);
    KX = reshape(KX,[],1);
    KY = reshape(KY,[],1);

    %Initial Condition

    eta = zeros(x_steps,1);
    phi = zeros(x_steps,1);
    
    save(name);