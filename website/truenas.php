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

<img src="../photos/pikachu_construction.gif" width="300px" class="center">

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
</p><br><br>

<h2>
TrueNAS, the OS
</h2><p>
While originally I was looking at using Open Media Vault due to the Pi's limited hardware, with this full rig being set up I can go with good ol' TrueNAS. TrueNAS is pretty simple, if you've ever loaded an OS before on a new computer, it works just like that. We'll follow <a href=""> this very comprehensive tutorial by TODO </a>, for most of the early stages of this project. <a href="">This video</a> goes into the specifics of installing the OS. First, we download <a href="">the TrueNAS scale OS file<\a>, then we use <a href="">this tool</a> to format a USB drive as a boot device with the TrueNAS image on it. This will let a computer boot from the USB drive to install the OS. Then, we put the USB into our server computer and turn it on. Before windows/the old OS boots, you will see a black screen with a flash of text on it. That text will tell you what button to press to open the BIOS (usually delete or a function key). You'll probably miss it on the first power on, but reset the computer and spam that button until your BIOS settings are pulled up. This menu is on your computer's motherboard, and gives you more control about the computer itself. You will want to navigate to the boot section, which is where you set which storage device the computer will look at to load an OS. It will be looking at your current boot drive, and we will set it to the USB drive we flashed with TrueNAS. You may need to save before exiting settings. Then, restarting the computer should prompt you with an install wizard for TrueNAS. The video should give you details in how to proceed from there!
</p><p>
The next three sections, <i>Running Heedlessly</i>, <i>Networking</i> and <i>Pools, Datasets, etc.</i>, should be followed first (if you're following along). The sections after, like <i>Immich</i> and <i>Minecraft Server</i>, should be able to done in pretty much any order you want, if you want to do them at all.
</p>
<br>
<br>

<h2>
Running Heedlessly
</h2><p>
After your TrueNAS computer is set up, you can run it "headlessly," or without a monitor and keyboard. All you have to do is plug it into power and ethernet, and turn it on. To access the TrueNAS software and do anything, you will have to type in the server's IP into your search bar. Now, if you were smart, you would've noted the IP of our TrueNAS system when you had it plugged into a monitor during setup. If not, then you can find it's IP by logging into your router. For example, here is mine. Your server's IP should look something like this.
</p><quote>
192.108.6.107 TODO use real
</quote><p>
Once you navigate to your server on another computer, you will be prompted for the username and password you set up during the initial install.
</p>
<br>
<br>

<h2>
Networking
</h2><p>
I'll admit it, setting up the networking stuff itself is my weak point. But, it's worth putting in the effort. <a href="">This video from TODOs playlist</a> goes through creating a thing called a bridge, which is basically an extra, virtual layer between the server's actual port and what converses with the wider internet. We will set that up as br0 per the video. We will also configure the global settings: nameservers to "1.1.1.1" and "8.8.8.8", and global ip to our router's ip, which usually ends in .1.
</p>
<img src="photos/global_ip_settings.jpg" alt="Network Settings on my TrueNAS server." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    It's settings, do I need a caption?
</figcaption><br><br>
<p>
I'm not sure if this is a common problem, or if it's just proof of how bone headed I am with tech, but the global IP is where the server will look to access the internet as a whole. It is not the IP of the server. I had it set to my server's IP for quite awhile, and thus was unable to download apps for TrueNAS. Basically, it was asking itself for a GitHub repo, instead of the internet at large. So global IP should be the router that will give your server access to the whole of the internet, which is why I mentioned it usually ends in 1.
</p><p>
We can also look into setting up a domain or subdomain to point towards our TrueNAS. This step is not necessary, but it makes it so much more fun. For example, my TrueNAS page, which used to be an IP in the search bar, is now <i>server.leviticusrhoden.com</i>. Nice try, but that address only works on my local network. This step mainly requires going to your domain's DNS settings, and setting up subdomains (the <i>server.</i> before the main domain <i>leviticusrhoden.com</i>) to point towards your local addresses. We can also use it down the line, say directing <i>photos.leviticusrhoden.com</i> toward our Immich server. Your domain registrar may have a different look, but this is what my namecheap DNS dashboard looks like.
</p>
<img src="./website/photos/namecheap_dns.jpg" alt="Namecheap dns dashboard" style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Why would I add a caption here? What could I add?
</figcaption><br><br>
<p>
TODO more directions
</p>
<br>
<br>

<h2>
Pools, Datasets, etc.
</h2><p>
Alright, with TrueNAS Scale loaded onto our 128GB SSD, it's time to set up the other drives in a RAID configuration. I won't explain the RAID system here, but <a href="">this site</a> gives a great overview. We will set up our two 3TB HHDs as RAID1, which means we will have two copies of all our data, and if one hard drive fails we won't be up the creek. This is called a pool, which TrueNAS treats like a single drive. We can store things on a pool, and TrueNAS will store it on the drives within that pool according to the RAID configuration.
</p>
<img src="./website/photos/pool.jpg" alt="The settings we used to create a RAID 1 pool." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Come on in, the water's fine!
</figcaption><br><br>
<p>
And while we are here, it would be a good idea to set up some datasets. While pools are our "drives", datasets are our "folders". Most things we will do on this server will require their own dataset. For example, a network drive is associated with one dataset, and our future image storage will be on another. We don't have to get too in the weeds now, but on my first run-through of building a server I learned how messy stuff gets if you don't set up sub-datasets. You can use general names like "apps" and "drives", or we can come up with a fun codename system. My buddy named top level datasets with the names of birds that begin with C, for example. My wife christened my server as "BossNAS," in honor of the best gungan, so we could run through some starwars planets.
</p>
<img src="./website/photos/datasets.jpg" alt="The (file?) structure of our pool." style="display: block; margin-left: auto; margin-right: auto; max-height: 500px; max-width: 500px;">
<figcaption>
    Can you belive I'm married?
</figcaption><br><br>
<p>
Personally, I set up a few parent datasets in our pool. One to house network drives: One for media like photos, videos, and music: an apps dataset that we can stuff video game servers and whatever simulations I mess around with: and possibly a dataset for network setup, things like VPNs.
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
