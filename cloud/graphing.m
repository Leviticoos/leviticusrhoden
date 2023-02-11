load('faria_paper_constants.mat','pos_list');
time = pos_list(:,2);
position = pos_list(:,1);
del_time = diff(time);
del_time = [del_time; 0];
velocity = [diff(position); 0];

figure;
clf;
title("Position vs Time"); hold on;
xlabel('Time in Seconds'); hold on;
ylabel('Position'); hold on;
scatter(time,position,'.','k')

figure;
clf;
title("Time Between Bounces vs Time"); hold on;
xlabel("Time in Seconds"); hold on;
ylabel("Time Between Bounces in Seconds"); hold on;
scatter(time, del_time, '.', 'k')

figure;
clf;
title("Velocity vs Time"); hold on;
xlabel('Time in Seconds'); hold on;
ylabel('Velocity'); hold on;
scatter(time,velocity,'.','k')