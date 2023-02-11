<html>
<head>
<link href="../css/styles.css" rel="stylesheet" type="text/css">

<title>
leviticusrhoden.com Style Guide
</title>
</head>
<body>

<h1>
leviticusrhoden.com Style Guide
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
This page is my <em>website style guide</em>, a mostly useless page that I will use to lay out how I want to format my website. I hope to write down all the general guidelines I think of to keep this website somewhat uniform in appearance, as well as document things I may likely forget later. I hope it will be interesting to some other people too, so I'm putting it up here. I will start with the more technical things, like hooking up to the Pi on a desktop and coding, and later on will define style and formatting guides.
</p><br><br>

<h2>
Uploading Files via SSH
</h2>
<p>
The main way I upload to the raspberry server is by opening an ubuntu terminal and navigating to the folder on my PC where I have all the website pages organized as they will appear on the pi. For me, it is the following.
</p>
<p><b>cd /mnt/j/leviticusrhoden</b></p>
<p>
The next step is to upload that whole folder to the pi, where the Apache server will look when it is requested to serve up the website. scp stands for secure copy, so we are asking my desktop to copy files over SSH. -r * means we are copying all files and folders at the current location. Then we address the pi and the location in the pi that we want to copy these files to. Altogether, that gives us the following.
</p>
<p><b>scp -r * pi@10.0.0.19:/var/www/html</b></p>
<p>
Running that code will prompt a password for the pi, which is <em>raspberry</em> by default, but I have changed and won't share. Then, I can send over those updated files to the pi and they will appear when someone opens the website.
</p>
<p>
This ends up being a very convenient way to workflow. Now as I make pages, it takes about 5 keypresses to load them onto the pi so I can see how they look. Very handy for all but the most tedious tinkering, where I use a browser based html runner. Make sure the .php files are saved and organized, upload it all, and the website is updated!
</p><br><br>


<h2>
Site Layout and Formatting
</h2>
<p>
The layout of this site is meant to group my projects into general clusters. I have a wide range of projects from carpentry to research to writing. On the homepage, there is a directory of pages broken down by the type of project they are. Each group has a main page, which gives a brief overview of all the projects in that category. Each of these projects are linked both on the homepage and on their category’s page.
</p>
<p>
Each page has a main, h1 heading. This is the big, centered text that should be the same as it appears in the Table of Contents and on topic pages. Directly under the main heading, there is a link to homepage and the topic page the project is classified as. In the main body, subheadings separate the text into different sections in such a way to make skimming the text to find something specific easier. The text should be broken up in small paragraphs, such that they look good on skinny screens. After the last paragraph in a subsection, two instances of line break should be called to add an empty line between the end of a section and the subtitle of the next. At the bottom of the page, there should be links to the homepage and the parent category page. 
</p>
<p>
An example .php file for this setup is shown <a href="example.php">here</a> and downloadable <a href="example.php" download="leviticusexample.php">here</a>.
</p><br><br>

<h2>
Code Formatting
</h2>
<p>
Each html/php file starts with the following header, these examples taken from the example.php file shown <a href="example.php">here</a> and downloadable <a href="example.php" download="leviticusexample.php">here</a>.
</p>
<blockquote><pre><code>
&lt;html&gt; 

&lt;head&gt; 
&lt;link href=&quot;../css/styles.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt; 
&lt;title&gt; 
Name that apears in browser, should be same as below.
&lt;/title&gt; 
&lt;/head&gt; 

&lt;body&gt; 

&lt;h1&gt; 
Main title of the page goes here.
&lt;/h1&gt;

&lt;address&gt; 
&lt;a href=&quot;index.php&quot;&gt;leviticusrhoden.com Homepage&lt;/a&gt; 
&lt;/address&gt; 
&lt;address&gt; 
&lt;a href=&quot;website/styleguide.php&quot;&gt;Back to Styleguide (replace with parent page)&lt;/a&gt; 
&lt;/address&gt;
</code></pre></blockquote>
<p>
After this header, we see the general format of the subsections, each with a blank like between them.
</p>
<blockquote><pre><code>
&lt;h2&gt;
First subheading, often Introduction
&lt;/h2&gt;
&lt;p&gt;
First Paragraph.
&lt;/p&gt;&lt;p&gt;
Second paragraph, notice the double line break after.
&lt;/p&gt;&lt;br&gt;&lt;br&gt;

&lt;h2&gt;
Another Subheading
&lt;/h2&gt;
&lt;p&gt;
Paragraph 1.
&lt;/p&gt;&lt;p&gt;
</pre>Paragraph 2. This one I made longer to showcase how it drops down a line, it's quite interesting. Also appreciate &lt;a href=&quot;website/hostingpi.php&quot;&gt;this link&lt;/a&gt; as an example of link html. Remember to put a &lt;b&gt;../&lt;/b&gt; in the address for each step back in the directories you need to go from the current page before you can go down a branch to the page you want.<pre>
&lt;/p&gt;&lt;br&gt;&lt;br&gt;
</code></pre></blockquote>
<p>
And the end of each page has the following footer, along with the links put at the top to the homepage and parent page.
</p>
<blockquote><pre><code>
&lt;address&gt;
&lt;a href=&quot;index.php&quot;&gt;leviticusrhoden.com Homepage&lt;/a&gt;
&lt;/address&gt;
&lt;address&gt;
&lt;a href=&quot;website/styleguide.php&quot;&gt;Back to Style Guide (replace with parent page)&lt;/a&gt;
&lt;/address&gt;

&lt;/body&gt;

&lt;/html&gt;
</code></pre></blockquote>

<h2>
Color
</h2>
<p>
The colors scheme of this website is very simple. I'm using a cream-beige color for the background and a dark purple for all text, even hyperlinks, which become the normal purple-ish color after being clicked. The cream color is <em>#EAEABD</em> and the purple is <em>#1E064B</em>.
</p><br><br>

<h2>
Tag Style
</h2>
<p>
This website uses <a href="../css/styles.css" download="styles.css">this</a> .css file to define a site wide scheme (you can download it to either use it yourself or to inspect with a text editor). Within it, tags are given the following properties.
</p>
<h3>
Body
</h3>
<p>
The body of the website is assigned a cream-beige color, #EAEABD, and has margins of 35 pixels along the sides.
</p>
<h3>
Headings and Subheadings 
</h3>
<p>
Headings are aligned center, with the purple color code #1E064B
</p>
<p>
Subheadings are all aligned left, at the margins of the body.
</p>
<h3>
Paragraphs
</h3>
<p>
Paragraphs are justified and have an indent of 40 pixels at the start.
</p>
<h3>
Lists
</h3>
<p>
dl, the whole list, is aligned left. Both sub tags dt and dd are colored purple.
</p>
<h3>
Blockquotes
</h3>
<p>
Blockquotes are justified, and every line is indented 80 pixels, or twice as much as the indent at the start of a paragraph.
</p><br><br>

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="website.php">Website Topic Page</a>
</address>

</body>

</html>




