%Model_XIV.m by Leviticus James Rhoden
%Gradien

%This model is based o
%Fluidff of Luiz Faria's model

global lambda Ekv sigma ro g omega KX KY X Y X2 Y2 b_funct x_steps y_steps;

%Initial Constants
lambda = 4.1; %Forcing amplitude of the bath
Ekv = 16.05; %effective kinematic viscosity, Faria uses this to tune lambda_f
sigma = 0.0206; %Surface tension
ro = 949/(1000^3); %density kg/mm todo
g = 9.80665*1000; %gravity in mm/s^2
omega = 80*2*pi; %angular velocity of table ossilation

%droplet
radius = 0.39;
mass = (4/3)*pi*(radius^3)*ro*1000;
air_drag = 0.01;
coef_rest = 0.1;


%Sim Settings
start_t = 0;
y_length = 100;
x_length = 100;
x_steps = 2^8;
y_steps = 2^8;
coral_radius = 10;
start = [10,0];

%Initial Functions
table_force =@(t) g*(1 + lambda*cos(omega*t));
droplet_force =@(t) mass*g*(mod(t,(4*pi/omega)*steps_per_sec) == 0);

%Topology of the arena
topology_depths = [6.09,.42];
area_1 =@(x,y) (sqrt((x).^2+(y).^2) < coral_radius);
area_2 =@(x,y) (sqrt((x).^2+(y).^2) >= coral_radius);

topology =@(x,y) area_1(x,y).*topology_depths(1) +...
    area_2(x,y).*topology_depths(2); 

%k values and b_funct definitions
k_val = [];
for h = topology_depths
    syms k
    k_solver = ((g + (sigma/ro)*k^2)*k*tanh(h*k)) == (omega/2)^2;
    new_k = vpasolve(k_solver,k,1);
    k_val = [k_val double(new_k)];
end
b_funct =@(x,y) area_1(x,y).*tanh(k_val(1)*height(1))./k_val(1) +...
    area_2(x,y).*tanh(k_val(2)*height(2))./k_val(2);

%Set up Linspace and meshes
x2 = linspace(-x_length/2,x_length/2,x_steps+1);
x = x2(1:x_steps);
y2 = linspace(-y_length/2, y_length/2, y_steps+1);
y = y2(1:y_steps);
[X,Y] = meshgrid(x,y);
X2 = X;
Y2 = Y;
X = reshape(X,[],1);
Y = reshape(Y,[],1);

kx = (2*pi/x_length)*[0:x_steps/2-1, 0, -x_steps/2+1:-1];
ky = (2*pi/y_length)*[0:y_steps/2-1, 0, -y_steps/2+1:-1];
[KX,KY] = meshgrid(kx, ky);
KX = reshape(KX,[],1);
KY = reshape(KY,[],1);

%Initial Condition
eta = -1*normpdf(sqrt((X-start(1)).^2+(Y-start(2)).^2), 0, 0.2);
eta_one = 1.*eta;
eta_two = 0.*eta;
% eta = zeros(x_steps,y_steps);
% eta(x_steps/2,y_steps/2) = -1;
phi = zeros(x_steps, y_steps);
phi_one = phi;
phi_two = phi;
phi_three = phi;
t = start_t;
loop = true;

s = surf(reshape(eta,[],x_steps));

tic
%Main sim part
while loop
    
    eta2ft = reshape(fft2(reshape(eta,[],x_steps)),[],1);
    eta1ft = zeros(x_steps*y_steps,1);
    phift = reshape(fft2(reshape(phi,[],x_steps)),[],1);
    tspan = [t:0.002:0.4];
    y0 = [phift;eta1ft;eta2ft];
    [t,phieta] = ode45(@delta,tspan,y0);
    
    loop = false;
    
end
toc

disp("I'm done")

function output = delta(t,phieta)
   

    global lambda Ekv sigma ro g omega KX KY X Y X2 Y2 b_funct x_steps y_steps;

    phi_ft = phieta(1:(x_steps*y_steps));
    eta_1_ft = phieta((x_steps*y_steps)+1:2*(x_steps*y_steps));
    eta_2_ft = phieta(2*(x_steps*y_steps)+1:3*(x_steps*y_steps));
    eta_ft = eta_1_ft + eta_2_ft;
    
    phi_dtt_ft = -1*((KX.^2)+(KY.^2)).*phi_ft;
    eta_dtt_ft = -1*((KX.^2)+(KY.^2)).*eta_ft;
    
    phi_dt_x = ifft2(reshape(((1i.*KX).*phi_ft),[x_steps,y_steps]));
    phi_dt_y = ifft2(reshape(((1i.*KY).*phi_ft),[x_steps,y_steps]));
    b_phi_dt_x = b_funct(X2,Y2).*phi_dt_x;
    b_phi_dt_y = b_funct(X2,Y2).*phi_dt_y;
    b_phi_dt_x_ft = reshape(fft2(b_phi_dt_x),[x_steps*y_steps,1]);
    b_phi_dt_y_ft = reshape(fft2(b_phi_dt_y),[x_steps*y_steps,1]);
    b_phi_dtt_ft = (1i*(KX.*b_phi_dt_x_ft + KY.*b_phi_dt_y_ft));
    
    phift_new = reshape(cat(3, ...
            -(g*(1 + lambda*cos(omega*t))).*eta_ft +...
             (sigma/ro)*eta_dtt_ft +...
             2*Ekv*phi_dtt_ft ...
             ),[],1);
    
    eta1ft_new = reshape(cat(3, ...
            -1*b_phi_dtt_ft) ...
            ,[],1);
            
    eta2ft_new = reshape(cat(3, ...
            2*Ekv*eta_dtt_ft) ...
            , [],1);
        
    output = [phift_new; eta1ft_new; eta2ft_new];
    
end