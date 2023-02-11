<html>
<!--this page has been edited-->
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<title>
Leviticus' Website
</title>
</head>

<body>

<h1>
Changing 3D Printer Color Mid-Print with Ender 3 and Octoprint
</h1>

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="crafting.php">Back to Crafting</a>
</address>



<h2>
Introduction
</h2>
<p>
My goal here is to lay out how to change colors mid print with my specific setup. My slicer, Cura, does have a built-in pause setting to change out the filament, but it ends up moot over Octoprint, which sends GCODE commands one after another to the printer. Since the printer is not able to pause the stream of GCODE, commands to pause in GCODE do not work. Because of that, we need to work with Octoprint to pause the printer.
</p><br><br>

<h2>
What I Did
</h2>
<p>
The first thing to do is change what Octoprint does when it pauses. If we don't do anything, it will just stop the printer wherever it is. This leads to a melty print and a lot of difficulty trying to access the nozzle. Going to <em>settings</em> > <em>GCODE scripts</em> > <em>After the print job is paused</em> & <em>Before the print job is resumed</em>, we can paste the below to run after a pause:
</p>

<blockquote>
    {% if pause_position.x is not none %}<br>
; relative XYZE<br>
G91<br>
M83<br>
<br>
; retract filament (3mm), move Z slightly upwards<br>
G1 Z+5 E-3 F4500<br>
<br>
; absolute XYZE<br>
M82<br>
G90<br>
<br>
; move to a safe rest position, adjust as necessary<br>
G1 X0 Y0<br>
{% endif %}<br>
</blockquote>
<p>and the next section to run before resuming the print.</p>
<blockquote>
    {% if pause_position.x is not none %}<br>
; relative extruder<br>
M83<br>
<br>
;re-home x and y<br>
G28 XY<br>
<br>
; prime nozzle<br>
G1 E-3 F4500<br>
G1 E3 F4500<br>
G1 E3 F4500<br>
<br>
; absolute E<br>
M82<br>
<br>
; absolute XYZ<br>
G90<br>
<br>
; reset E<br>
G92 E{{ pause_position.e }}<br>
<br>
; move back to pause position XYZ<br>
G1 X{{ pause_position.x }} Y{{ pause_position.y }} Z{{ pause_position.z }} F4500<br>
<br>
; reset to feed rate before pause if available<br>
{% if pause_position.f is not none %}G1 F{{ pause_position.f }}{% endif %}<br>
{% endif %}<br>
</blockquote>
<p>
Paragraph 2. This one I made longer to showcase how it drops down a line, it's quite interesting. Also appreciate <a href="hostingpi.php">this link</a> as an example of link html. Remember to put a <b>../</b> in the address for each step back in the directories you need to go from the current page before you can go down a branch to the page you want.
</p><br><br>

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

<img src="../crafting/photos/camera_roll_mechanism.jpg" alt="A few long arms, a rachet, and a small arm that stops a cam from turning." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    An example of an embedded image that I resize to either 350px or 500px wide, to save space, bandwidth, and so I don't have to mess with scaling html-side.
</figcaption><br><br>

<img src="../photos/pikachu_construction.gif" width="300px" class="center">

<figcaption>An important gif to let the people know a page is unfinished.</figcaption>

<img src="https://media.giphy.com/media/B7eXvaDYdHv8NDTM0v/giphy.gif" width="560px" class="center">
<figcaption>
Figure 1, A .gif of a fluid simulation I programmed. If you look closely you can see it did not work!
</figcaption><br><br>
<iframe width="560" height="315" src="https://www.youtube.com/embed/CUZq7yudbSU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<figcaption>
Figure 2, One of my best YouTube videos! Embedding it on your own is a pain, but YouTube has a handy html generator function, so it takes care of it all. Both img and iframe are centered in the styles.css file.
</figcaption>
<br><br>

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="styleguide.php">Back to Style Guide (replace with parent page)</a>
</address>
<address><a href = "rss.xml"> RSS Feed</a></address>
<address><a href = "mailto: levi@leviticusrhoden.com">Send Me an E-Mail!</a></address>
</body>

</html>
