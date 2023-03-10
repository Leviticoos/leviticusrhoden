<html>
<head>
<title>
Leviticus' Website
</title>
</head>

<h1>
COMING SOON: Non Planar 3D Printing
</h1>

<link href="../css/styles.css" rel="stylesheet" type="text/css">

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="/crafting.php">Back to Crafting</a>
</address>



<h2>
How Does 3D Printing Normally Work?
</h2>
<p>
    3D printing usually works by putting down 2D layers of plastic that are thin enough they form a 3D facsimile. Usually, this makes a fine object, that while it has some layer lines, it is a fantastic 3D object. However, I wanted a funky fresh curved surface. Something that wasn't just flat, or a terrace like facsimile of curvy, like below.
</p><br>
<img src="photos/camera_roll_mechanism.jpg" alt="A few long arms, a rachet, and a small arm that stops a cam from turning." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    See that? That surface sucks!
</figcaption><br><br>
<p>
    eeeee
</p><br><br>

<h2>
What Can We Do?
</h2>
<p>
To make a 3D print that avoids terracing, we need to make our slices non-planar. While a smart person would make a ground up slicer, that is code that takes an STL file and turns it into non-planar GCODE. But that's hard! You have to figure out infill and shtuff, no thanks! So we got to be smart, and do our darndest to ride on cura's coattails. Have cura calculate walls and infills and extrusion rates, and we only focus on the non-planar aspects.
</p><p>
So what would that look like? Well, lets imagine we want a curvy plane at the top of a cube. We very well can't have our printer lay down a wavey bottom layer, so we have to interpolate from a flat surface at layer one to our desired surface. From here on out, I'll be using the term <i>Layer Surface</i> We also need to change the rate of extrusion, to adjust for the increase or decrease in volume. All of these will be looked at in their own section, and then I will show and share the final results, which you can skip to <a href="#code">here.</a>
</p><br><br>

<h2>
    Interpolation Between Layer Surfaces
</h2>
<p>
    The code I've writen has the option to define 3 layer surfaces, although the first layer better be zero delta, or I guess whatever your printbed surface is. Which it BETTER BE FLAT. You also set the height you want to be that surface. Ok, should probably define some things now. the height <i>z</i> of a point is the height in the origonal, planar .Gcode file. Then that height, along with the x and y position, returns a change from that height, a <i>dz</i>. So the layer surfaces augment the original height <i>z</i> by a factor <i>dz</i>. But of course, we can't just change between the layer surfaces, we have to transition between them. So we set <i>h2</i> and <i>h3</i> as the heights we want our print to reach layer surface 2 and 3 respectivly. Then we slowly change the between the diffrent defined layer surfaces, until we have transitioned from one two another. While I could write a ton try to explain this more, I think a picture will show more.
</p><br>
<img src="photos/camera_roll_mechanism.jpg" alt="A few long arms, a rachet, and a small arm that stops a cam from turning." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    See that? That surface sucks!
</figcaption><br><br>
<p>
    This is where I explain the photo more, tbd.
</p>

<h2>
    Extrusion Rate
</h2>
<p>
    Our other big problem is extrusion rate. Thankfully, we let Cura do most of the heavy lifting here as well. We know what it thinks the right amount to extrude is! We can also backtrack to calculate the volume of that area, simply by multiplying distance by layer height. We can also aproximate our new print volume, treating our movement as a trapazoid. See the image below for details, but the long and short of it is we can find the ratio of our new volume and the origonal cura volume. Then, we multiply the cura extrusion over the cura volume, which gives us a factor we can multiply by our new volume to get our new extrusion!
</p><br>
<img src="photos/camera_roll_mechanism.jpg" alt="A few long arms, a rachet, and a small arm that stops a cam from turning." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    See that? That surface sucks!
</figcaption><br><br>

<h2 id="code">
    The Final Product
</h2>
<p>
    The outcome is absolutely better than I could have hoped for! Not only did it turn normal Cura Gcode into a wibbly wobbly code:
</p>
<!-- TODO image of normal and wavy side by side -->
<p>
    But it can also cary over ironing, giving us a very smooth, math function defined surface! The fact that you can take an ironing enabled cura Gcode and make it non-Planar, while the smoothness of the ironing still shines through is amazing. Look how shiny that is!
</p>
<p>
    If you're looking to use this yourlesf, I made <a href="https://github.com/Leviticoos/nonPlanarPrinting">this spiffy code</a> put up on github, particulary non-Planar-GCODE-converter-2.ipynb. This code has a lot of, well it's just a lot. But, I have put a comment with <i>PARAMETER</i> with everything you need to set up to use it. A simple ctrt-f should bring you to everything you might want to adjust to use this code. It's just a python notebook, that needs accses to a Gcode file, and it'll spit out a new Gcode file. As always, feel free to shoot me an email if you have questions, want to use it for something specific, or have questions!
</p>



<address>
<a href="/index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="styleguide.php">Back to Style Guide (replace with parent page)</a>
</address>
<address><a href="rss.xml"> RSS Feed</a></address>
<address><a href="https://web.archive.org/web/20220323015114/mailto: levi@leviticusrhoden.com">Send Me an E-Mail!</a></address>
</body>

</html>