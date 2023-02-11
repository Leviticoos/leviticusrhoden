<html>
    <!page has been copy edited oct 2022>
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<title>
Leviticus' Website
</title>
</head>

<body>

<h1>
Digi-Chrome Film Process™
</h1>

<img src="../photos/pikachu_construction.gif" width="300px" class="center">

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="crafting.php">Back to Crafting</a>
</address>



<h2>
An Introduction of Autochrome
</h2>
<p>
Ever since we've started collecting images on latent silver crystals, we've wanted to remember the colors of said images. One attempt to do this, thought up by the motion picture-inventing Lumiere Brothers themselves was called an autochrome. The images consisted of a black and white emulsion underneath an array of randomly dispersed color filters, in the form of dyed  potato starch grains. These grains serve two purposes. First, when taking a picture, each grain filters out one color of light, so that the brightness of a black and white photo at that point is reflective of how much of "that color" is at that point. Then, because after developing we still have the starch grains over the photograph, it turns any bright white below it into color. Thus film underneath a green dyed grain will capture the green light, then when it is used to display the image later, it will be green, as it reflects white light through the green filter. 
</p><p>
That was a lot. Lets look at some pictures of these grains, to get the idea.
</p>
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Microphoto_of_Autochrome_plate.jpg/330px-Microphoto_of_Autochrome_plate.jpg" width="560px" class="center", alt="A photo of small grains of potato starch, dyed red, green, and yellow. They look like cells under a microscope. The space inbetween the grains is black.">
<figcaption>
A photo from wikipedia that shows a zoomed in look of the dyed grains on an Autochrome plate.
</figcaption><br><br>
<p>
    While zoomed in you couldn't tell, these produced amazing color photographs!
</p>
<img src="https://upload.wikimedia.org/wikipedia/commons/3/3b/Mauretania_in_drydock_1928_autochrome_process_starboard_side.jpg" width="560px" class="center", alt="A photo of a drydock with an early-mid 1900s cruise liner. She has a black hull with rust red below the waterline (if it wasn't in a dry dock, of course). In the foreground, a well dressed man crouches and looks on.">
<figcaption>
    A 1928 Autochrome of the HMS Mauretania in a drydock. While the color is absolutely, stunningly beautiful, note the RGB speckles in the sky hinting this is an Autochrome.
</figcaption><br><br>
<p>
    I was first drawn into the world of Autochrome by one of my favorite youtubers <a href="https://www.youtube.com/channel/UCy0tKL1T7wFoYcxCe0xjN6Q">Technology Connections</a>, with <a href="https://www.youtube.com/watch?v=hE3KjKg69ZA">this video</a>, where he describes the process much better than I can, as well as dives into the history of the process. Cited in that video, and much more influential in my experimentation, is the work of <a href="https://www.jonhilty.com">Jon Hilty</a>, an accomplished recreater of historical photographic methods. He has he been perfecting his historically accurate <a href="https://www.jonhilty.com/autochromeguide">Autochrome guide</a>, that I highly recomend giving a read if you're curious in how the real Autochrome works.
</p><br><br>

<h2>
The Beginning of the Idea of Digichrome
</h2>
<p>
After seeing the Autochrome, I starting thinking about how it could be updated to the modern age. The original Autochrome had a few disadvantages that I think could be rectified with some modern machinery. First, the Autochrome has to be viewed through the same filter it was taken by. This is alright if you are taking photos with a glass plate, but seems inconvenient when trying to adapt for modern film. I'd rather not need to go into a dark room to apply filters to a roll of film, then pack it up again. Instead, I think you could make one film that you put into the camera. This filter would then appear on every photo, and could also be scanned prior to installation, then digitally overlaid after scanning. 
</p><p>
My second thought was how to make the color filter. I originally did some experiments with corn starch instead of potato, since I had it on hand. Looking again at <a href="https://www.jonhilty.com/autochromeguide">Jon Hilty's guide</a>, the dyeing process was much more intensive than I wanted it to be. My half-arsed attempt at using food coloring was no good either. Plus, the more I looked into the starch method, the more concerned I got about how long it would take to expose through. In the end, I figured I could try printing on plastic transparencies to make the filters instead. 
</p><p>
It was about this time I poked around and found <a href="https://www.jonhilty.com/pseudochrome">this experiment</a> on Hilty's website. It was about what I was trying to do, minus the computer side. He was very kind and a short email exchange gave me the following advice:
</p>
<dd>-Start at a high grain size and work smaller</dd>
<dd>-Starch adds about 2-3 stops to exposure time, may be better for a transparency</dd>
<dd>-Black and White film is not necesarily Panchromatic, may need to be color balanced</dd>
<dd>-Computer registraiton could work</dd>
<br><br>
With all that in mind, I went to my roommate, material science engineering wunderkind and data scientist Evan Truesdale. He knows python much better than I do and is willing to help me with the registration side of my plan. While I was unsure of how well the digital re-alignment might go, Evan seemed to have the same high hopes as Jon. Quite frankly, since both the photographer and computer whiz think it could work, I am starting to have some high hopes myself!

<h2>
Making the Color Filter
</h2>
<p>
    The first plan is to make a digital spray of "grains." I mentioned the idea of defining it randomly in python to Evan, and he mentioned Voronoi diagrams. If you are unfamiliar, Voronoi diagrams start with a bunch of points. These points then have polygons around them defined by points that are equidistant from two points. Or said another way, every part of each polygon is closest to the point from the beginning that is inside the same polygon than any other point. 
</p>
<img src="https://upload.wikimedia.org/wikipedia/commons/5/54/Euclidean_Voronoi_diagram.svg" width="560px" class="center", alt="A collection of colorful polygons, each with a point inside them. ">
<figcaption>
A Voronoi diagram, also from wikipedia.
</figcaption><br><br>
<p>
    You may have seen a Voronoi diagram in this fun article that <a href="https://www.howderfamily.com/blog/closest-state-capital/">defines the US states by closest state capital,</a> which I think gives a great understanding of what a Voronoi diagram is.
</p><p>
    But back to how this relates to Digichrome. I wanted to have very fine control over my random grains. One way to do this project could've been to simply make a grid of square colors. But that would look too digital. The fun of film photography and resurecting Autochrome is to keep the comfortable fuzziness of the grains. But at the same time, I wanted to control the grain size tightly, and keep the same colors from being next to each other, which effectively makes the grain size bigger. To do that, I made a python script to generate me a .png or .svg file of a color filter. I started by making a grid and placing one point randomly within each grid. Then I made a Voronoi diagram from those points, sequentially coloring them in (either with red green blue or cyan magenta yellow) with chance of skipping a color to help it keep the random feel. Since this is now a computer code, I can finely control the average grain size (with how I define the grid at the start), how often we skip colors, what colors are used, etc. That python script can be downloaded by <a href="/digichrome_py/Autochrome Filter Generator.ipynb" download>clicking here TODO FIX</a>. You can also find it on <a href="https://github.com/EvanTruesdale/Digichrome/tree/master">our GitHub</a>.
</p>
<img src="./photos/voro_RGB_0.5_1.svg" width="560px" class="center", alt="A collection of RGB colored polygons, with black elbows in the corner.">
<figcaption>
A color filter generated with my python script. In the corner are some early registration marks. This is an .svg file, since we want high resolution, and it is made of single color polygons. This filter has a grain size of 0.5mm.
</figcaption><br><br>

<h2>Image Registration</h2>
<p>
    This stuff is hard. Like really hard. For registration, I'm using the openCV library in python. This library lets me use a function called ORB, which makes my git commit notes fun ("ORB is not pleased with my attempts to pre-process photos"). I started with the corner elbows shown in the above filter, but they proved not enough to line up photos. ORB works by looking for corners, or pixels where an arc around it is a diffrent brightness than the point itself. It then tries to match up corners between two images. The main problem with our elbows is they have only 6 corners each, and the photos and filters end up with more elbows. To try and create more corners, and stone a few other birds while I'm at it, I came up with this.
</p>
<img src="./photos/voro_RGB_0.5_1.svg" width="560px" class="center", alt="A collection of RGB colored polygons, with black elbows in the corner.">
<figcaption>
A color filter generated with my python script. In the corner are some early registration marks. This is an .svg file, since we want high resolution, and it is made of single color polygons. This filter has a grain size of 0.5mm.
</figcaption><br><br>
<p>
    I made a python script to generate a simple vine with leaves, with some random variation. This shape gives many more corners for ORB to detect and align by, and the random variation in it should help these corners be unique enough to line up. At the same time, the pattern of leaves can encode a serial number, where left leaf only is 1, right leaf only is 2, and both leaves is 3. The vine above is for color_filter_123123. This means, if anyone else is crazy enough to try this project for themselves, they can tell which filter a photo used.
</p><p>
    We still have a few more problems to figure out, mostly in the realm of pre ORB processing. This pattern of vines will only be visible if light is shown onto its part of a photo, so it can block it out. If it occupies a low-light part of a photo, it may be hard for ORB to detect its corners. To make it stand out, we have a few options. My first thought was to do some edge detection or brightness boolean-ing. But both of these processes change the outlines enough that corners can't be matched up. They esentially change a corner's 'fingerprint,' such that ORB has no idea what to do with it. The other idea is simple censoring. If an area is too dark, simply make it stark white. This masking, which can also be applied to the main part of the image, blinds ORB to everything but the areas of the vine that are clear enough to compare to the color filter file. This then gives us the correct transformation to line them up, which we can apply to the unmasked original.
</p>

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
