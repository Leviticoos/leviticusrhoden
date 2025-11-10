<html>
<head>
<title>
Leviticus' Website
</title>
</head>

<h1>
My Homelab/TrueNAS server
</h1>

<link href="../css/styles.css" rel="stylesheet" type="text/css">

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="website.php">Website Topic Page</a>
</address>

<img src="../photos/pikachu_construction.gif" width="500px" class="center">

<h2>
Introduction
</h2>
<p>
I am hoping to create a home lab/server that does a few different things. I've dabbled with network attached computers before, most notably the year or so this website was hosted on a raspberry pi in my college apartment. However, this time around, it's time to do it like an adult. That is, set something up that can fit my needs as I get older, accumulate more data, do more projects, and have less free time. I'm also hoping for low maintenance needs, so that if I don't feel the ADHD itch to work on it for months or a year, it can still keep running as is. With that said, I set about making the below list of design goals.
</p><dt>
Operation Goals
</dt><dd>
- Host files on a Network Drive: I'd love to have all of my stuff stored on a server so they can be accessed by any computer I'm running. I have many files that it'd be nice to sync. I'm thinking working documents like tophy files, CAD files, anything that is PC agnostic.
</dd><dd>
- Host Photos/media: it'd be cool to have my photos and music and everything organized and easily accessible. It'd be nice to have better infrastructure than my current external hard drive with no real organization. It'd also be great to have it easily expandable wrt amount of storage, easy to increase redundancy (new raid drive, or even off site), and easy to loop other users in (my wife, maybe one day work it for my whole family). 
</dd><dd>
- Host simulations: this gets more into the homelab part, but I'd love a framework to load up a python program and have it run in the background with network connection. This includes things like Pocksward and Flatland.
</dd><dd>
- Host Websites: While I have an internet connected computer, might as well see if it can host my website! Save some money by not paying bluehost and hopefully having more control over it. Maybe even link it to hosted simulations. This goal might be the most far fetched, but it's worth writing down.
</dd><dt>
Design Goals
</dt><dd>
- Be run cheaply on an existing machine. I'll pay for the hard drives or SSDs, but I'd rather not pay for the computer itself. Possible options include a raspberry pi I have, or maybe I can steal my dad's old desktop I helped build.
</dd><dd>
- Independent of Hardware: I want my solution to be agnostic to the machine running it. Sure, it could benefit from better specs, but I'd love to be able to upgrade the machine without making major changes to the external workflow.
</dd><dd>
- HIPA compliant storage, so Emma can use it for work stuff. This is also a stretch/unknown goal, but I am hopeful we have options.
</dd><dd>
- Store copies of data. I want to have redundancy so that photos and such can be recovered if a drive fails. Because I have a 4TB external hard drive, my thought is I may actually follow the 3-2-1 rule. Have two hard drives in RAID-1 in the machine, and then back that up to an external drive that I usually keep at my 9-5 office. You know, in case my house burns down. 
</dd><br><br>

<h2>
The Hardware
</h2>
<p>
After conferring with a buddy, he convinced me that a Raspberry Pi would not be up to snuff for this endeavor. Luckily, my dad had an old desktop that he and I had built 10 or so years ago, and it was just gathering dust. A 128gb SSD to put the OS on, 16gb of ram, and a 3TB hard drive. No graphics card, but that should be alright for us (in fact, it might be better as it will use less power). I also did some poking around and found there were possibilities to slot a card in a PCIE slot to get more SATA ports. I'll get into those details if needed, but the main point is I have that option if I need more than the 4 SATA ports on the motherboard.
</p><p>
Then we have an interesting question, what storage drives do we want? It comes with an old 3TB drive, so you'd imagine we can use that for something. But, 3TB is a weird size, and it's possible the 10 year old HDD in the computer will die soon. Despite these risks, I found that western digital sells refurbished hard drives, which are a little sketch but the fact it's from the manufacturer themselves helps. Anyway, going that route will cost $60 for a 3TB drive, and then my storage will be set in a RAID config. So, $60 bucks for 3TB is not bad, and if one of the drives fail, then we will still have the backup disk. That is good enough for now, and down the line we can update the hardware if I need more storage.
</p>
<img src="photos/the_server.jpg" alt="A small desktop computer, with the cover removed. Two HDDs are visable, one nestled nicely in the top HDD bay, and the other haphazardly mounted horizontally and bolted through the fan vent holes." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    "It's a jigsaw puzzle. If the pieces don't fit, we make them fit!"
</figcaption><br><br>
<p>
And the computing hardware, for those interested. CPU is a AMD A8-7670K Radeon R7 TODO more specs. An important thing to note is that the operating system needs its own drive to load onto, and that drive can't be used for any data. That is, if I used one of the 3TB drives to load TrueNAS onto, I couldn't use it in raid to store my photos. For that reason, I recommend getting a 128GB SSD. These can be found under $20 on amazon with only a cursory look, so worth it to have a speedy OS drive, and it saves your big hard drives for actual data.
</p>
<img src="photos/making_the_pc.JPG" alt="A fresh faced Levi, circa. TODO, with all the parts to build the computer that 10 years later would become my TrueNAS server." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Time waits for Gnome Ann
</figcaption><br><br>
<br>
<br>

<h2>
TrueNAS, the OS
</h2><p>
While originally I was looking at using Open Media Vault due to the Pi's limited hardware, with this full rig being set up I can go with good ol' TrueNAS. TrueNAS is pretty simple, if you've ever loaded an OS before on a new computer, it works just like that. We'll follow <a href="https://youtube.com/playlist?list=PL6zQmF2gDqDT7SHyBe7ni1P2S4NzyJpD6&si=BuWS6EHVKaeFxPUd"> this very comprehensive tutorial by ServersatHome </a>, for most of the early stages of this project. <a href="https://youtu.be/cA8fZ-lfgaA?si=Svv1SXjV4_N91UfB">This video</a> goes into the specifics of installing the OS. First, we download <a href="https://www.truenas.com/download-truenas-community-edition/">the TrueNAS Community OS file</a>, then we use <a href="https://etcher.balena.io/">balenaEtcher</a> to format a USB drive as a boot device with the TrueNAS image on it. This will let a computer boot from the USB drive to install the OS. Then, we put the USB into our server computer and turn it on. Before windows/the old OS boots, you will see a black screen with a flash of text on it. That text will tell you what button to press to open the BIOS (usually delete or a function key). You'll probably miss it on the first power on, but reset the computer and spam that button until your BIOS settings are pulled up. This menu is on your computer's motherboard, and gives you more control about the computer itself. You will want to navigate to the boot section, which is where you set which storage device the computer will look at to load an OS. It will be looking at your current boot drive, and we will set it to the USB drive we flashed with TrueNAS. You may need to save before exiting settings. Then, restarting the computer should prompt you with an install wizard for TrueNAS. The video should give you details in how to proceed from there!
</p><p>
The next three sections, <i>Running Headlessly</i>, <i>Networking</i> and <i>Pools, Datasets, etc.</i>, should be followed first (if you're following along). The sections after, like <i>Immich</i> and <i>Minecraft Server</i>, should be able to done in pretty much any order you want, if you want to do them at all.
</p>
<br>
<br>

<h2>
Running Headlessly
</h2><p>
After your TrueNAS computer is set up, you can run it "headlessly," or without a monitor and keyboard. All you have to do is plug it into power and ethernet, and turn it on. To access the TrueNAS software and do anything, you will have to type in the server's IP into your search bar. Now, if you were smart, you would've noted the IP of our TrueNAS system when you had it plugged into a monitor during setup. If not, then you can find it's IP by logging into your router. For example, here is mine. Your server's IP should look something like this.
</p><code>
192.168.0.107
</code><p>
You can enter this IP on your browsers address bar, and it will open up your TrueNAS interface. Once you navigate to your server on another computer, you will be prompted for the username and password you set up during the initial install.
</p>
<br>
<br>

<h2>
Networking
</h2><p>
I'll admit it, setting up the networking stuff itself is my weak point. But, it's worth putting in the effort. <a href="https://youtu.be/0lzFHySymsU?si=OcZDh3qi88prtMLJ">This video from ServersatHome's playlist</a> goes through creating a thing called a bridge, which is basically an extra, virtual layer between the server's actual port and what converses with the wider internet TODO fact check. We will set that up as br0 per the video. We will also configure the global settings: nameservers to "1.1.1.1" and "8.8.8.8", and global ip to our router's ip, which usually ends in .1.
</p>
<img src="photos/global_ip_settings.jpg" alt="Network Settings on my TrueNAS server." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    It's settings, do I need a caption?
</figcaption><br><br>
<p>
I'm not sure if this is a common problem, or if it's just proof of how bone headed I am with tech, but the global IP/Default Route is where the server will look to access the internet as a whole. It is not the IP of the server. I had it set to my server's IP for quite awhile, and thus was unable to download apps for TrueNAS. Basically, it was asking itself for a GitHub repo, instead of the internet at large. So global IP should be the router that will give your server access to the whole of the internet, which is why I mentioned it usually ends in 1.
</p><p>
We can also look into setting up a domain or subdomain to point towards our TrueNAS. This step is not necessary, but it makes it so much more fun. For example, my TrueNAS page, which used to be an IP in the search bar, is now <i>server.leviticusrhoden.com</i>. Nice try, but that address only works on my local network. This step mainly requires going to your domain's DNS settings, and setting up subdomains (the <i>server.</i> before the main domain <i>leviticusrhoden.com</i>) to point towards your local addresses. We can also use it down the line, say directing <i>photos.leviticusrhoden.com</i> toward our Immich server (TBD). Your domain registrar may have a different look, but this is what my bluehost DNS settings looks like, and what settings I gave it.
</p>
<img src="photos/dns_settings.jpg" alt="Namecheap dns dashboard" style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<br><br>
<br>
<br>

<h2>
Pools, Datasets, etc.
</h2><p>
Alright, with TrueNAS Scale loaded onto our 128GB SSD, it's time to set up the other drives in a RAID configuration. I won't explain the RAID system here, but <a href="">this site</a> gives a great overview. We will set up our two 3TB HHDs as RAID1, which means we will have two copies of all our data, and if one hard drive fails we won't be up the creek. This is called a pool, which TrueNAS treats like a single drive. We can store things on a pool, and TrueNAS will store it on the drives within that pool according to the RAID configuration.
</p>
<img src="photos/pool.jpg" alt="The settings we used to create a RAID 1 pool." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Get it? Because my wife named the server BossNAS, and Lake Paonga is where Ohto Gunga is?
</figcaption><br><br>
<p>
And while we are here, it would be a good idea to set up some datasets. While pools are our "drives", datasets are our "folders". Most things we will do on this server will require their own dataset. For example, a network drive is associated with one dataset, and our future image storage will be on another. We don't have to get too in the weeds now, but on my first run-through of building a server I learned how messy stuff gets if you don't set up sub-datasets. You can use general names like "apps" and "drives", or we can come up with a fun codename system. My buddy named top level datasets with the names of birds that begin with C, for example. My wife christened my server as "BossNAS," in honor of the best gungan, so we could run through some starwars planets.
</p>
<img src="photos/datasets.jpg" alt="The (file?) structure of our pool." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Can you belive I'm married? And that she came up with the name!?
</figcaption><br><br>
<p>
Notice that the top is our RAID pool, Paonga, and our datasets are inside that drive. How you set up datasets is up to you and your predilictions. Personally, I set up a few parent datasets in our pool. One to house network drives (Naboo): One for media like photos, videos, and music (Coruscant): an apps dataset that we can stuff video game servers and whatever simulations I mess around with (Mustafar): and possibly a dataset for network setup, things like VPNs.
</p>
<br>
<br>

<h2>
TrueNAS Users and Setting Up a Network Drive
</h2><p>
This is the best bang for your buck with a home server. Once TrueNAS is set up, you can quite easily set up an SMB drive that will be visible to computers on your local network. That is, in fact, what the NAS in trueNAS stands for, network attached storage! TODO explain setting up a network drive
</p>
<img src="./website/photos/smb_settings.jpg" alt="Settings for a new SMB drive." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    TODO
</figcaption><br><br>
<p>
Next step, we will need to create a new user for our server. When we installed TrueNAS, and were prompted to create a user and password, we created the admin user for our server. That user has <i>UNLIMITED POWER</i>, which is great for setting stuff up. However, at this point we should create a Joe Schmoe user and password. This will be our personal user login, that we can use with less fear of accidentally wiping all of our data. Additionally, we can create a Jane Schmane user for a friend or partner to use when logging on. Mine is aptly named Levi, since that is my name. I have no permissions by default, which is what we want. We'll simply add permissions as they are needed. And remember, it's best to only give regular use permisions to our Self-Titled user, and log in as admin when we want to do server maintenance.
</p>
TODO the Levi User settings
<p>
Then we can go to the network drive we just created and give this new user the power to read and write from the network drive.
</p>
TODO photo of permisions on the network drive
<p>
It is worth mentioning that this overview of users is bare bones, and from an idiot. If you want a more comprehensive overview of users and permissions, I highly recommend <a href="">TODOs video on the subject</a>.
</p><p>
With our new user created, we go to file explorer on the computer we want to hook up. Right clicking on the side bar, we will get the option to <b>mount network drive or whateverthehellitsays</b>, which we will click on. 
</p>
<br>
<br>

<h2>
Tailscale; Accessing our Server from Afar
</h2><p>
Alrighty, lets set up a way to access our server from WiFi networks that are not our home networks. Said another way, lets talk to the server when not on the same local network as it. To do this, we will make a tailscale network. Tailscale is a VPN that essentially creates a little virtual network that everything is on, I think. The end result, however, is that the machines on the tailscale network can "see" each other as if they were on the same network. This means we are able to access our network drives and apps as if we were at home!
</p><p>
Setting up Tailscale is pretty easy, and they even <a href="https://tailscale.com/kb/1483/truenas#route-tailnet-traffic-through-truenas">have a tutorial on their website</a>. I won't go into too much detail, but it boils down to a few steps. Make a tailscale account, generate an auth key, download tailscale on your NAS server, give that server the auth key, and blam! That's just about it. If you enter the IP tailnet gives for your NAS server on any computer connected to the tailnet, you will be able to access it. 
</p><p>
Now, the next thing to do is add a subnet route to your NAS server. Since tailnet gives a new IP to the NAS server, your links will be different for on your home WiFi and on another WiFi. That would be annoying enough if it were just the server, but that will also impact server apps, network drives, pretty much everything. So, in order to have your Server reachable by the same IP address, we have to change some settings. First, in the Tailscale app on our server, we need to add an advertized route, and assign it the IP of our server on our local network. The one weird thing is we have to end it with a <i>/32</i>, instead of the <i>/24</i> it is usually ended with.
</p>
<img src="photos/tailscale_same_ip_setting.jpg" alt="TODO" style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Note the /32, and don't ask me why.
</figcaption><br><br>
<p>
After that, we have to go to the Tailscale website and add this route to our Server. Since we set it to be advertized by the server, Tailscale should see it, and all we have to do is check the box next to said IP.
</p>
<img src="photos/tailscale_subnet_route.jpg" alt="TODO" style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Ignore the key expiry warning.
</figcaption><br><br>
<p>
And that's it for Tailscale! It's not as clean as reverse proxy/https, but it allows you to access everything remotely. You can also log onto the Tailscale network like a VPN, and that will let you use your server for apps. The immich app, for example, has to be pointed to your immich instant. And if your phone is always on the Tailscale VPN, it will always be able to find it. TODO this conclusion sucks ass.
</p>
<a href="https://tailscale.com/kb/1483/truenas">Tailscale tutorial</a>
<br>
<br>

<h2>
Reverse Proxy, with Cloudflare, NGINX, and Pi-Hole
</h2><p>
This section is going to take a little introduction. First, networking is very confusing, even more so if you are following a tutorial rather than learning the theory. Because it's how I think, we will be starting with some theory work. Hopefully, that gives us a framework to add all the necessary programs, and understand what they are doing, and comunicating to each other. Two, I have my domain registered on NameCheap, as it's, well, cheap. However, I transfered DNS work to cloudflare, as it is both free and the most popular DNS service used for homelabing. If you want to try and use DNS from namecheap or another registrar, it should work. But, I couldn't get namecheap to work after quite a few hours, so be warned it's a path less traveled for a reason.
</p><h3>
Paint Me, Like One Of Your French Networks!
</h3>

<h2>
Putting the <i>s</i> in <i>https</i>
</h2><p>
Tailscale is great, it lets us do most of what we need to on our server from anywhere with an internet connection. But, some things want more than an IP address, they want a certified server(tm). The main one I ran into was Bitwarden on my iphone. It kept throwing errors when I told it I was self hosting a password vault on a lowley http:// address. Unfortunatley, I have never been good at keeping track of passwords, so setting this up was very high on my list. Very well, into the hell that is networking.
</p><p>
So, what do we need to get a SSL, or a certificate that will let our adresses be a https, convincing browsers somehow it's more secure? Alright, I'm sure it does something. But damn if it makes any sense to me! <a href="https://www.cloudflare.com/learning/ssl/what-is-an-ssl-certificate/">This article by Cloudflare</a> seems to explain it well enough. And speaking of cloudflare, they are who we will use for our adress' DNS, or domain name server. 
</p><p>
I have spent a long time trying to digest what the 
<h3>
Setting up Caddy
</h3><p>
Our first step is setting up Caddy, a program to help handle requests to our server from a domain. Basically, I'll be more formerly setting up the server.leviticusrhoden.com link to look at my server. I followed Dan, <a href="https://wiki.familybrown.org/en/fester/configure-apps/other/caddy">and his kick ass tutorial</a>.
</p>

<h2>
Immich
</h2><p>
The world is truely a magical place, and nothing proves that more than the fact there exists free, open source, and local running rip-offs of google photos and iCloud. Immich is an app that can be easily installed on TrueNAS from the apps tab, and will gather your photos for you. It handles metadata well, letting you search by time or location on a map. It even plays well with phones, allowing you to automatically back-up photos to your Immich server.
</p><h3>
Installing Immich
</h3><p>
Installing Immich is not that complicated. We can follow <a href="">this guide from Immich themselves</a> on our server and get it rolling. I have one additional note, however. When I tried to install Immich, I kept getting this error.
<code> TODO copy error note</code>
Which (after some digging) I learned meant that Immich did not have the needed permissions over the datasets Immich is going to use. TODO explain the box to check.
</p><h3>
Checking in locally
</h3><p>
Once installed, opening the Immich app on TrueNAS and clicking the <i>Web UI</i> button will open up the web interface. This is where the fun begins! We can now upload photos from our computer, or any computer. Uploading photos here means that they are backed-up, and will let Immich start analyzing our photos. Analyzing you say? Yeah! Immich will comb your library for duplicate images and help you cull them, as well as run facial recognition on your photos to sort by person. But don't worry, all the image recognition is run locally on your server, so while your computer can tell you from your dad apart, companies don't get that info.
</p><h3>
Opening our ports
</h3><p>
The next thing we want to do is open Immich to the wider web, safely, so that we can access our library, and add to it, while out and about. 
</p>
<br>
<br>

<h2>
Navidrome: Self-Hosted Spotify
</h2>
<p>
When my dad gifted me the computer, it still had all of our family data on it. Photos, movies, and coolest of all, music. So, with a wealth of mp3s, I figured I had to do something more than just place them in a folder somewhere. Enter, Navidrome. It's an open source, self hosted music streaming platform. When you listen to spotify, the music you are listening to is not on your device (unless you download it). So your phone goes to the spotify server, requests a song, and spotify then rustles it up and sends it in small chunks to your phone. But, there is no reason you can't have a computer in your house serve the same function. The Navidrome app on BossNAS works much the same, except the music library it's pulling from is music that I own and have stored on the server. 
</p><p>
Some of you think this idea is cool in and of itself, and this paragraph is not for you. But some people will hear this and go "but, spotify does it better and has a ton of music," and you'd be right. I don't think this sort of thing is what everyone wants to do. But as we march into the void of not owning anything digitally, I like the idea of owning at least some of my music. Plus, as streaming services raise their prices and, more importantly, pay artists less and less, this is a great way to get back at them. I can take the $17 a month for Apple Music and instead spend it on bandcamp, supporting artists way more directly. Ok, with that caveat out of the way, hopefully you're willing to come along on the journey, or at least skip this section without sending me your contrarian comments.
</p><p>
Alright, let's get into this one. 
</p><h3>
Installing Navidrome
</h3><p>
This one is pretty easy, although it can still present errors in installing and running if permisions are not set correctly. Permisions are important or whatever, but hell if I fully understand them yet. We can install Navidrome from the TrueNAS app repository, so a pretty routine install. We will need two datasets for Navidrome (one for data/music, and one for postgresdata that I assume is app settings but actually do not know), and we will make them standalone datasets, not the hidden ix ones. TODO, discuss explicit vs IX datasets in the datasets section. 
</p><h3>
Orginizing Music
</h3><p>
Now this part is a little less intuitive, but it's good to know ahead of time. Navidrome is different than immich. While immich lets you drag and drop photos, and it takes care of the file structure, navidrome does not touch your files at all. In fact, it can't accept new files either. What you need to do is turn the TrueNAS dataset (that you told Navidrome to use for it's data) into a shared drive. That way, you can use your computer's file manager to upload your MP3 files. I named my network drive music. Then, we make two folders, one <i>unsorted</i> and one <i>library</i>. Since my mp3s are coming from various sources, the files are messy. Both in terms of the file structure and of the metadata of the songs. I want to have them sorted by album, as well as make sure that they have the correct artist, title, and album art. 
</p>
<IMAGE OF HELL FILE STRUCTURE, MAYBE?>
<p>
And while this seems like a hard task, I have good news! For some reason, humanity has very robust databases of music that can be used to match up a random MP3 with it's associated metadata. Why? Beats me, but it does save my butt! This is why I created an "unsorted" folder for our music, so that we can take the unsorted music, compare it to those databases with a program, and then use the new information from said database to sort the music nicely into the "library" folder, while also adding any missing metadata. I used <a href="https://picard.musicbrainz.org/">musicbrainz's Picard program</a> to do this. It's a free download that uses the musicbrainz database to add that missing metadata to your files. Sure, overkill for importing your perfectly curated ripped CDs section. But for that mp3 file with a gibberish name that you got sent over discord? This will pretty it up for us. 
</p><p>
Now, to use Picard, I watched <a href="https://www.youtube.com/watch?v=aTjlb3vmHSg">this video that goes over the basics</a>, so that I knew what buttons to press to use it at all. Then we follow <a href="https://www.thedreaming.org/2020/11/22/musicbrainz-picard/">this blog post</a> on how to configure TODO what
</p>
<IMAGE OF THE CONFIGS>
<p>
Then, we just run the "fingerprint" option, which uses exsistnig metadata to try and complete the picture. This will work on some files, but not all, so we will then run "scan" on the remaining, unfiled songs to see if it can find a match for the mp3 file itself. After doing this, there will still be some unidentified songs. I'm fine calling those a wash if you are, so we select all the songs on both sides (catagorized and not catagorized) and hit save. If we set the configuration up correctly, this will save our metadata filled music to that <i>library</i> folder.
</p><h3>
Hitting the Road
</h3><p>
Navidrome is an awesome server app, but it is lacking in terms of being a nice piece of software to use on my computer or phone. So, now that we have our library set up and being hosted, it's time to turn our attention to how we will access this server. We have many options for this, <a href="">even Navidrome themselves have a list of apps</a>. I won't go into a ton of details here, each app requires you to sign in with your Navidrome username and password, as well as the server IP your TrueNAS is on. If you wan't that to work outside your WiFi, check out the Network 2 section. For my iPhone, I use <a href="">Arpeggi</a>, a beta app that has a very slick UI that is heavily based on Apple Music. Say what you will about apple, but UI athstetic is definatly a strong suite of theirs. On my computers, I like to use dedicated applications and not browser based services, if possible. 









<h2>
Examples of Embedding
</h2>
<p>
<a href="hostingpi.php">A link example, can be put inside paragraphs of text.</a>
</p>
<address>
<a href="hostingpi.php">A link example, but it's centered!</a>
</address>
<br><br>

<img src="./crafting/photos/camera_roll_mechanism.jpg" alt="A few long arms, a rachet, and a small arm that stops a cam from turning." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    An example of an embeded image that I resize to either 350px or 500px wide, to save space, bandwidth, and so I don't have to mess with scaling html-side.
</figcaption><br><br>

<img src="./photos/pikachu_construction.gif" width="300px" class="center">

<figcaption>An important gif to let the people know a page is unfinished.</figcaption>

<img src="https://web.archive.org/web/20220323015114im_/https://media.giphy.com/media/B7eXvaDYdHv8NDTM0v/giphy.gif" width="560px" class="center">
<figcaption>
Figure 1, A .gif of a fluid simulation I programmed. If you look closely you can see it did not work!
</figcaption><br><br>
<iframe width="560" height="315" src="https://www.youtube.com/embed/CUZq7yudbSU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<figcaption>
Figure 2, One of my best YouTube videos! Embedding it on your own is a pain, but YouTube has a handy html generator function, so it takes care of it all. Both img and iframe are centered in the styles.css file.
</figcaption>
<br><br>

<h2>
    Annotated Bibliography
</h2>
<dt><a href="crafting/crafting.php">Source 1, www.sourceone.com, accessed 01/01/2000</a></dt>
    <dd>This source was a great resource for how i could do x, y, and z.</a></dd>

<address>
<a href="/index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="styleguide.php">Back to Style Guide (replace with parent page)</a>
</address>
<address><a href="rss.xml"> RSS Feed</a></address>
<address><a href="mailto: levi@leviticusrhoden.com">Send Me an E-Mail!</a></address>
</body>

</html>
