<html>

<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css">

<title>
Setting Up a Pi Website
</title>
</head>

<body>

<h1>
Hosting a Website on a Raspberry Pi
</h1>

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="website.php">Website Topic Page</a>
</address>

<h2>
Introduction
</h2>
<p>
Raspberry Pi is a fantastic microcontroller that is both cheap and capable. In fact, as of my writing this (5/31/2021) and for the foreseeable future, this website is actually running on one! It is sitting by my router, connected by ethernet, and running 24/7. I chose this route, as opposed to paying a hosting service, because I had a pi on hand and thought it'd be a fun way to spend a weekend. Not to mention it would be "free," and I'd have tons of control. In fact, since I'm hosting it on my own computer, I hope to be able to run simulations on it 24/7. But I'm getting ahead of myself. Speaking of heads...
</p><br><br>

<h2>
Headless Pi
</h2>
<p>
The nice thing about Raspberry Pi is that it is super easy to run headless, that is to say without a monitor or keyboard being connected to the pi itself. Currently, I'm writing this and working on the Pi from my windows 10 desktop! I simply turned on the SSH option on the pi with a mouse and monitor, and now I can connect to it on my PC. By opening an Ubuntu terminal and typing in the following, I can now control the Pi's terminal.
</p>
<p>
<b> ssh pi@10.0.0.19 </b>
</p>
<p>
This will then prompt you for a password, which by default is <b>raspberry</b>. Using this simple setup, I can put the pi over by the router and never think about it again! Any edits to this website or the Pi as a whole can be executed from my desktop. The one catch being I have to be on the same WiFi network as it. 
</p>
<p>
A courtesy note, as I did not catch this and it caused many headless problems, if your USB adapter does no supply enough power, the Pi will get caught in a boot loop and you will not be able to connect over SSH. I learned that the hard way. It is hard to tell why it is not booting if there is no screen.
</p><br><br>

<h2>
Apache, Downloading and Loading Files
</h2>
<p>
To host on the Pi, I followed <a href="https://www.raspberrypi.org/documentation/remote-access/web-server/apache.md">these instructions</a> from Raspberry Pi themselves. The main gist is pretty simple. Download apache2, the php addons, and give yourself root/admin powers with:
</p>
<p>
<b> sudo chown pi: /var/www/html </b>
</p>
<p>
In the link, they tell you how to set up root permissions for the single index.html file, but I decided to give myself power over the whole folder so I could make more edits to it as I made a bigger website. Is this a mistake I will realize down the line? Only time will tell.
</p>
<p>
The next bit of code is how I upload files to the Pi. While Apache can read both .html and .php, as of right now they have to be named index. Later, I can mess with adding pages beyond the index one (spoiler, this page is not index.php!). For now, I need to open a new Ubuntu terminal and run it from my PC. That is to say, a terminal that is accessing my Windows computer, not the Pi. Below is the code I used to transfer a file from my PC to the Pi. A note; before using this command you have to navigate to the folder on your PC with <b>filename.php</b>.
</p>
<p>
<b>scp filename.php pi@10.0.0.19:/var/www/html</b>
</p>
<p>
After this it'll ask for a password and such. Easy peasy. If the file you uploaded was not named Index, you will have to change it for it to load up automatically. Else you will be prompted with a list of files in the folder <b>html</b> when you connect to the Pi over internet.
</p><br><br>

<h2>
Dynamic IPs are a Pain
</h2>
<p>
Now that we have a Pi, headless and hosting, we need to connect it somehow with a domain name. There are plenty of sites that go over getting a domain for free, with a less than desirable name, but that is not what I want to do. I decided to make this website <em>after</em> I bought a domain name. So, what I really want to do is connect this Pi Apache server to namecheap, and leviticusrhoden.com. Namecheap walks us through setting up <em>dynamic DNS</em> <a href="https://www.namecheap.com/support/knowledgebase/article.aspx/36/11/how-do-i-start-using-dynamic-dns/">here</a>. I won't walk through that side as it is quite self-explanatory, and will be different for each registrar, but that link should provide help if you need it. 
</p>
<p>
For this project, I opted to use <a href="https://ddclient.net/#installation"><em>DDClient</em></a> to essentially update namecheap every time the Pi's IP address changes. That way, even when comcast switches IP's up, leviticusrhoden.com will still direct to the Pi. Their site is pretty ok, but not specific enough for my project. So, I'll walk through it here. First, I ran the install code from DDC's website. This will prompt you with tons of questions. I did not know what to put in for most of ‘em, so answer them as best as you can. But ultimately, we will edit the config file so it does not much matter.
</p>
<p>
A side note, I think the password input is broken. Both times I've installed DDC, it said my passwords didn't match. The first time I just put a single digit password, so I wonder if anyone else has noticed this and if it's a bug.
</p>
<p>
Let us edit a config file. For this step, I have to thank <a href="https://samhobbs.co.uk/2015/01/dynamic-dns-ddclient-raspberry-pi-and-ubuntu">Sam Hobbs</a> and <a href="https://deviant.engineer/2017/11/ddclient-centos7-namecheap/">The Deviant Engineer </a> for their great walkthroughs on how to set up the ddclient config file for a Pi server and a namecheap domain name. I will be summarizing their work here. If you need more details, I highly recommend them. While they use nano, I prefer vim, but you can use any terminal text editor (I believe nano is built into Raspbian, you have to specifically download vim) to open the config file like such:
</p>
<p><b>sudo vim /etc/ddclient.conf</b></p>
<p>
Then we get a file that we want to look like below. ssl=yes means we will use a secure connection to check our IP, the next line says we will check our WAN IP (the IP of our router that the larger internet sees), then we say we're using namecheap. Server is the name of the servers namecheap uses for dynamic DNS. Login is simply the url of the site we want to be directed to our Pi, and the password is a string namecheap gave us when we set up DNS on the domain name side. The final @ symbol is important, it says that we're updating the root domain of our website, and if you followed the namecheap tutorial, you should remember setting up the @ DNS.
</p>
<blockquote>
ssl=yes<br>
use=web<br>
protocol=namecheap<br>
server=dynamicdns.park-your-domain.com<br>
login=leviticulrhoden.com<br>
password='string from namecheap, yes, you need the quotes'<br>
</blockquote>
<p>
I recommend <a href="https://samhobbs.co.uk/2015/01/dynamic-dns-ddclient-raspberry-pi-and-ubuntu">Sam Hobbs'</a> tutorial to see how to check if this is all working. He also mentions turning on daemon, having the IP update every set interval, but I found that it was already turned on for me. 
</p><br><br>

<h2>
Port Forwarding
</h2>
<p>
So, my URL will link to my WAN, which is just my router. In fact, as I write this, leviticusrhoden.com redirects to an xfinity login page. So, we need to tell my router that if someone is knocking on its door, it should be directed to the raspberry pi. For this, we want to use <em>port 80</em>, the default port for http requests. Overall, what happens is this. http://leviticusrhoden.com, thanks to ddclient, will point towards my routers public IP address. When that request gets to the router, because it's an http request, it will come through port 80. My router will pass this on to my raspberry pi, and the pi will serve up this website! Xfinity has a pretty straightforward system for port forwarding. I hate to admit that it worked, especially after I spent hours trying to get it to work when it was in fact my error, but credit where credit is due. I won't go into details on how to do it, as it is pretty specific to each ISP and router, but it is an important step worth a section. Just google how to port forward with your specific setup.
</p><br><br>

<h2>
Conclusions
</h2>
<p>
All in all, I'm pretty stoked! I am a bit worried that Comcast will block port 80, as some ISPs tend to do this to discourage hosting websites on their private internet plans. But, if you can see this, it's still open! So far, I'm quite happy with how easy it is to update the server using SSH. In a separate page, I'll share the basics of how I update the website from my PC, as well as make a sort of style guide for it!
</p>
<p>
In conclusion, 10/10! Quite a fun project, if not frustrating at times, and the end product is very cool. If you are trying to do something similar and are finding trouble, feel free to email me and ask questions; Although I must admit I really don't know what I'm doing, and I might not be able to help. 
</p><br><br>
<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="website.php">Website Topic Page</a>
</address>

</body>

</html>


