<html>
<head>
<title>
Leviticus' Website
</title>
</head>

<h1>
Thin Lens Optics Simulation in Python
</h1>

<link href="../css/styles.css" rel="stylesheet" type="text/css">

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="cameras.php">Back to Cameras</a>
</address>

<img src="/photos/pikachu_construction.gif" width="300px" class="center">

<h2>
Introduction
</h2>
<p>
So, why a thin lens simulator, first of all? Lets start with the simulation part of it. I wan't to make a camera lens assembly (don't worry, we will talk about that project at a diffrent time on a diffrent page), and have learned optical simulation programs can cost $100's of dollars. Quite frankly, those programs also annoy me because they never work how I want them too. So, to save money and have control over everything, I decided to program my own! As for the thin lens part, that is an unfortunate consequence of buying lenses form a surplus store. While the lenses are a tenth or less the price of new lenses, they do end up lacking some of the finner meassurments. No worries, I happen to not be a stickler on aberations and such. So while the math of this simulation would be the same for a thick lens (I think), the boundry detection is much easier and wolud need a revamp to accommodate curved interfaces. 
</p><p>
Alright, with the motivation defined, what is the nitty gritty of what I want it to do? Basically, I've got a list of ~20 lenses that I think could work, and I want to see if any combination of them (and gaps between them) yield a good lens assembly. This "good lens" definition is mainly defined by where and at what scale images are formed. Think how and where would I have to put film to have an in focus image from this lens. The best end product could run through all kinds of diffrent lenses, find where the light rays intersect, record that, and then present to me all of the lens assemblies with their image location and scale. An important note here is that it is not up to the program to pick <i>The Best</i> lens, simply show me some of the best so I can make a decision and tweak that design.
</p><p>
    One last note, I will use the word "lens" to refer to a single piece of glass with optical properties, and "lens assembly" to refer to one or (usually) more lenses with the express purpose of focusing light onto a sensor or piece of film.
</p><br><br>

<h2>
Defining C, our Rate of Convergance
</h2>
<p>
If you ever took a high school or college physics course, you might remember a ray trace like the one below.
</p>
<img src="photos/ray_diagram.png" alt="A thin lens high school ray trace, with an object closer to the lens than the focal point. The image, while farther than the focal point, is still relativly close." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
This takes me back.
</figcaption><br>
<p>
These guys are wild. And not to mention, anoying to solve. What we are told here is that we can draw the top trace parallel to the opical axis, or horizontal, and that means when it hits the lens it goes through the focal point. Then we draw a line from the object to the center of the lens, meaning it does not change course and keeps going straight. Then for good meassure, draw the line through the object and the left side focal length till it hits the lens, then it comes out parallel to the optical axis. Where the three lines intersect is the image! So obvious! And if you said you wanted a smattering of analytics, you'd get a neutered Lens Makers equation like so.
</p>
<math>
    <sup>1</sup>&#8260;<sub>f</sub> = <sup>1</sup>&#8260;<sub>d<sub>object</sub></sub> + <sup>1</sup>&#8260;<sub>d<sub>image</sub></sub>
</math>
<p>
    If you couldn't follow that, please don't worry. Neither could I. It is an ad hoc method for getting an intuition for lenses, but does not really help us in this case. I want to make individual rays, and wether or not they are one of the above three plot its path through the lens assembly. So I did what any sane man would do, I tried to see if there was a way to rearange variables to make more sense of the math. And I came up with something I am quite proud of! Now, I'm sure it's already exsisting out there, and I may have heard it in passing at one point, but as far as I can remember, this is a novel idea? It was never taught in class, so I think I can claim I formulated this independently. If anyone has seen this before, please let me know where from! I'd love to read up a more formalized, and probably more correct version of this!
</p><p>
    We start by thinking about what focal length is. It is where parallel light rays are focused with a lens. 
</p>
<img src="photos/para_in.png" alt="Parralell light rays coming into a lens and converging at the focal point" style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
How we define/determine the focal point of a lens, by putting parallel rays into it and seeing where they converge.
</figcaption><br>
<p>
    Focal distance is in units of length, specifically mm. Now, if you happen to be taking an electronics class at the moment, you might remember how it is sometimes easier to do math with 1/x, instead of the variable x. Lets do that with focal length and get
</p><math><i>
    <sup>1</sup>&#8260;<sub>f</sub> = c,
</i></math><p>
    where c is inverse focal length. Now, c has units of 1/mm, or per mm. This is starting to sound like a slope! So, if we have a parallel light ray hit the lens at a height 1mm from the optical axis like so, 
</p>
<img src="photos/lone_ray.png" alt="A light ray coming into the lens horizontally, then going to the focal point." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
A single 'parallel' ray from the above picture, with the slope of the exiting ray labled and pointed out. 
</figcaption><br><p>
    and we end up with a light ray with slope c! Look back at the focal distance image and notice the farther the incident (incoming) ray was from the optical axis, the steeper it's slope is. For a parallel ray, this slope is whatever is needed to get from it's height when it hits the lens to the focal point. Let's define this height as y. So, when a horizontal ray (ie, it has a slope of zero) hits a thin lens, its slope exiting the lens is
</p><math><i>
    slope = <sup>y</sup>&#8260;<sub>f</sub> = yc.
</i></math><p>
    Now that we have a mathematical framework for horizontal in light rays, lets see if we can't generalize it.
</p>
<br><br>

<h2>Proposing a Slope Transformation Function of a Lens</h2>
<p>
    So we saw above that light rays with zero slope exit a lens with a slope of <i>yc</i>, where c is the Rate of Convergance, or inverse focal length of the lens, and y is distance from the optical axis (where y=0) that the incident ray hits the lens. To explore how these slopes compound, lets look at the example of an object that is a focal distance away from the lens like such.
</p>
<img src="photos/para_out.png" alt="An Object at y=0, a focal length to the left of a lens. Every light ray from this object leave the lens parallel" style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
I am an obligatory figcaption, even though no real explanation is needed.
</figcaption><br><p>
    Here, our lenses start with a slope, and then some sort of transformation or compounding of it's slope happens, and it leaves the lens with no slope. We know the origonal slope of any ray from the object is <i>yc</i>, as the rise is the eventual <i>y</i> of the ray when it hits the lens, and the run is focal length. And we see that the lens itself modifies this slope in some way by, with it's input slope of <i>yc</i>. 
</p>
<p>
    To put this more clearly, we imagine the lens as a machine that modifieys a light rays slope, as some sort of function of the <i>yc</i> of the lens and the slope of the incident ray <i>m<sub>in</sub></i>, to return to us the slope of an outgoing ray <i>m<sub>out</sub></i>, or
    </p>
    <math>
        <i>m<sub>out</sub> = L(yc, m<sub>in</sub>)</i>.
    </math>
<p>
    So looking at the object at the focal length, we can say <i>m<sub>in</sub></i> is equal to <i>yc</i>, so what can our fuction <i>L(yc,m<sub>in</sub>)</i> do to get us zero? Using simply intuition, we can hypothosize our function looks like this.
</p>
<math><i>
    L(yc, m<sub>in</sub>) = m<sub>in</sub> - yc = m<sub>out</sub>
</i></math><br><br>

<h3>Testing our Function</h3>
<p>
    The easiest way to test this method may be to see if it agrees with the lensmakers equation shown above,
</p>
<math><i>
    <sup>1</sup>&#8260;<sub>f</sub> = <sup>1</sup>&#8260;<sub>d<sub>object</sub></sub> + <sup>1</sup>&#8260;<sub>d<sub>image</sub></sub>
</i></math>
<p>
    This is as easy as drawing the following lens diagram and labeling it's parts. 
</p>
<img src="photos/labled_lens.png", alt="A lens diagram with an object and image, with a few labled variables. First, the distance do for an object on the left side of the lens, the distance di for the image on the right side of the lens, the height from the optical axis y the ray hits the thin lens, and the slopes m in of the incoming ray and m out of the outgoing ray. ", style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
This is the figure that RoC framework can be derived from!
</figcaption><br>
<p>
    Looking at this diagram, we can find a simple equation for m<sub>in</sub> and m<sub>out</sub>, using that good ol' rise over run stuff from middle school.
</p>
<math><i>
    m<sub>in</sub> = <sup>y</sup>&#8260;<sub>d<sub>object</sub></sub>
    </i></math>.<br><math><i>
    m<sub>out</sub> = <sup>-y</sup>&#8260;<sub>d<sub>image</sub></sub>
</i></math>.
<p>
    Now we make the wild assumption that my theory for the L function is correct.
</p><p>
    So, pluging in these functions for m<sub>in</sub> and m<sub>out</sub> into our ray transform function L, we get
</p>
<math><i>
    m<sub>in</sub> - yc = <sup>y</sup>&#8260;<sub>d<sub>object</sub></sub> - yc = <sup>-y</sup>&#8260;<sub>d<sub>image</sub></sub> = m<sub>out</sub>
    </i></math>,<br>
<p>
    which can be reorginized into a very familiar form,
</p>
<math><i>
    <sup>y</sup>&#8260;<sub>d<sub>object</sub></sub> + <sup>y</sup>&#8260;<sub>d<sub>image</sub></sub> = yc
    </i></math>.<br>
<p>
I hope this breakdown is elementry enough to be noticed as the lens maker's equation, as y can be factored out of both sides. While not rigorus, I hope this should at least convince you that this is not a dumb idea. Plus, I'm an engineer. Theory proves itself not by being mathematically sound, but by getting me results that work in the real world! How'd that soap box get here...
</p><br><br>

<h2>Ray Transform Sim based off Rate of Convergance</h2>
<p>
    The principle mathematics of my simulation is based off of two mathematical assumptions:
</p>
    <dt>1) We consider the Rate of Convergance, or RoC of a lens, instead of the focal length,</dt>
    <dt>2) Every time a light ray is incident on a lens surface (in this case, assumed to be a 2D thin lens), its slope changes by the following function:
    <math><i>
    L(yc, m<sub>in</sub>) = m<sub>in</sub> - yc = m<sub>out</sub>.
    </i></math>
    </dt>
<p>
    Anything else you'll find in my python script, and there is a fair bit, is fluff on top of this. I suppose I should also link my github code for this sim. It is set up to run an arbitrary 3 lens assembly, for a specific project I'm doing. Still, if you need a starting point, it is one!
</p><br>
<a href='https://github.com/Leviticoos/LensSim'>GIT HUB WITH CODE</a><br>
<p>
    This repository should be kept up to date with my work on this. As it stands, I don't plan on releasing a polished easy to use version, as I have it setup for my needs already. However, I've got a few sub functions in this code I think one could find useful.
</p>
<dt>-Lens Assembly Class</dt>
<dt>-Ray Class</dt>
<dt>-Ray Generator Function</dt>
<dd>This function makes n rays from an object at a given location that hit the first lens in an assembly.</dd>


<br><br>

<address>
<a href="/index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="cameras.php">Back to Cameras</a>
</address>
<address><a href="rss.xml"> RSS Feed</a></address>
<address><a href="https://web.archive.org/web/20220323015114/mailto: levi@leviticusrhoden.com">Send Me an E-Mail!</a></address>
</body>

</html>