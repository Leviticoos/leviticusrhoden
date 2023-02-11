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
Record Player Platter
</h1>

<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="crafting.php">Back to Crafting</a>
</address>

<h2>
A Study of a Cheap, Injection Molded Platter
</h2>
<p>
If you have been keeping up with my projects, you'll remember <a href="recordplayer.php">my first project with this record player</a>, where I got it running on a USB battery instead of a wall outlet. This time around, I'm hoping to fix a problem that it's had since I've gotten it. The platter (the rotating piece the record sits on) wobbles! Disassembling the platter revealed that the hole in the center of it was elliptical, one axis being a couple millimeters longer than the other. This means that as the record revolved, the tonearm would wiggle the platter and record back and forth as the radius of the platter changed. Why this happened is hard to say, although I remember it happening since I first got the player, so I'm pretty sure it isn't a wear problem. Just poor quality control.
</p><p>
So that just leaves us to try and make a new platter. Which can't be that hard, I hope (spoiler alert, it is that hard).
</p><br><br>

<h2>
Take 1 on a New Platter
</h2>
<p>
Taking some measurements of the platter, I found a very close similarity with some of the wood I had on hand. The platter can be broken down into two main parts. The top is a wide, thin piece of plastic to hold a large part of the records area. Below that is a smaller diameter hub of sorts, which the belt runs around to rotate it. The whole thing sits on a fixed metal rod, rotating around it. I had some cheap pine that was about the same thickness as the hub, and plywood for the platter. All I had to do was make a pair of circles and glue them together, then bore out the center so it fits in the player.
</p>
<img src="../crafting/photos/old_platter.jpg" alt="A black, injection molded plastic platter. It is made of the two main parts described in the above paragraph." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    The injection molded platter, with a large flat top and hub for the belt.
</figcaption><br><br>
<img src="../crafting/photos/player_without_platter.jpg" alt="TODO, I'm sorry if I never filled this in." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    The non-rotating axle that the platter sits on. 
</figcaption><br><br>
<p>
Having a bandsaw in my college apartment made this job fairly easy. For christmas, my dad made me a circle-cutting jig for my bandsaw, where an 1/8" post can be slid closer or farther from the blade. Then, the part can be rotated on that post, cutting at a constant distance from it. This meant that all I needed was a 1/8" pilot hole in my pieces.
</p>
<img src="../crafting/photos/level_setup.jpg" alt="A few long arms, a rachet, and a small arm that stops a cam from turning." style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    The very unprofessional way I tried to drill a straight hole with a hand drill and unleveled desk. It did not end well.
</figcaption><br><br>
<p>
Well. That's on me.
</p>
<p>
    What I should have done is gone into the shop to drill the pilot holes, but I was impatient. Wanting a new platter, I tried to use a hand drill on an unleveled table. The result was a 5-10 degree angle on the pilot hole, that transfered over all the way to the final platter, which had a way bigger tilt than the original platter. That means, unfortunately, I had to go back to square one.
</p><br><br>

<h2>
    Take 2, With Mystery Plastic
</h2>

<p>
    With my first try up in flames, I figured it was back to the drawing board. In my experience, when you thought something would be a quick job and it wasn't, you have to sit down and make a good plan. The shop guys, while helpful, seemed convinced the problem was that wood warps. I love engineers, we all think what we know how to make is the solution to every problem (yes, I'm also guilty of this). In spite of this, I decided to still make the hub out of wood, although this time I drilled the holes on an endmill for consistence. For the platter, I took a piece of scrap plastic. I don't know what kind of plastic it is except that it's not acrylic. 
</p>
<p>
    The wooden hub was made by putting a square chunk of pine into an endmill and drilling the 1/8" pilot hole. This was then set as (0,0), and four 1/4" holes were drilled. These will have metal dowels inserted into them to attach the hub to the platter. Then, I took the piece home and mounted it on the circle jig. Don't tell the guys at the UW shop, but what would've taken ~2 hours on a CNC endmill took less than 3 minutes for setup, cutting, and cleanup on the bandsaw. 
</p>
<p>
    The plastic platter was the trickier part. To start, I faced one side of the plastic in an endmill, then used its CNC programming to cut 3/8" down in a circle of the right diameter. The final piece needs to be about 5mm thick, meaning it will be quite the workpiece to machine on the lathe. However, I am currently pretty married to the idea of doing the final facing on the lathe, as that would all but ensure the center drilled hole is perpendicular (I'd use the lathe for both the facing and drilling). Since I'm writing this as I work out the problem, I'll make a list of routes that could work.
</p>
<h3>Possible Paths After Endmilling</h3>
<dd>1) Face on the lathe, ignoring any tilt in the assembly since the hole will be perpendicular to the top anyway.</dd>
<dd>2) Insert the metal rods, attaching the platter to the wooden hub,and using that hold to face the platter. The hole would be in line with the center of the hub, and the platter would be perpendicular to the hub. This may not be possible with the lathe chucks I have access to.</dd>
<dd>3) Do the facing and drilling on the endmill, which should also ensure perpendicularity, but would square up with the bottom of the wooden hub instead of the sides of the plastic platter.</dd>
<dd>4) Build a jig, probably involving making a larger radius dummy hub to mount in the lathe, endmilling counterbores for nuts to hold the platter to it, and machining that in the lathe. This would square up to the sides of the dummy hub.</dd>
<br><p>
    With those plans in mind, #1 jumps out to me as the best option. However, in practice it has quite a few problems. Mainly in how difficult the piece is to mount on the lathe. A 5mm thick plate with a diameter of ~8" is not easy to set up. While it is a bit thicker than that at the moment, we can only clamp ~4mm, so we can still work the piece. On the other hand, #2 also seems like a good bet, assuming the hub was made to good accuracy. The problem is, the jaws of the shop chuck have 3 levels. The outer level does not close enough to hold the wood hub, and the middle level would have the platter hit the chuck before the hub was seccured. 
</p>
<p>
    It has just come to my attention that that type of chuck is generally reversible. I happen to know from accidentially overextending the jaws that they do indeed fall out of the chuck, so I think they should be reversible. That would allow me to try option #2. With that mistake and my bout of COVID over, I can get to final machining.
</p><br><br>

<h2>Final Machining and Assembly</h2>
<p>With a plan in my head, I went to the Mechanical Engineering shop. I put the metal dowels into the wooden hub, having them about 3mm into the plastic platter above it. Then I put the hub in the chuck and started turning. This was an unholy amount of trial and error. I was so worried about overtightening the chuck and marking up the hub, that it actually slid in the chuck and now has many horrendous grooves. But, I was able to eventually start machining the surface of the platter down to about 5 millimeters.</p>
<img src="../crafting/photos/grooves.jpg" alt="The side of the wooden hub, with two parralel gouge marks left from the chuck" style="display: block; margin-left: auto; margin-right: auto;">
<figcaption>
    Remember kids, you can't win when clamping soft woods.
</figcaption><br><br>
<p>After surfacing the top plate down, it was time to use the lathe to drill out the hole. Both the hub and platter at this point have a 1/8" pilot hole, but it has to be drilled to ~19/64" to fit the player. Luckily, I was already set up on the lathe. The surface should even be perpendicular to the drill bit! So I put the bit in, started turning the piece, and slowly drilled through both pieces. Then, I ran the belt around the motor and wooden hub and turned it on. There was a bit of a problem. Somehow, the drill either bent or torqued the workpiece. Either way, the platter fits nicely on the axel, but has a couple millimeters of wobble. But it does indeed run, and even plays records.</p>
<img src="../crafting/photos/new_platter.jpg" alt="A cloudy, semi transparent plastic platter with 4 metal posts in it, level with its surface." style="display: block; margin-left: auto; margin-right: auto;"><br><br>

<h2>Conclusion</h2>

<p>The main goal of this project was to replace the wobbly platter that came with my record player. And in that area, I think I did alright! While the new platter does have a wobble, it is consistent and does not have a sharp up and down motion like the old one had. I got practice designing and machining parts, and have a much better idea of what to do next. At some point in the future, I will make a new case and possibly electrical system for this player, and I plan to remake this platter. While it works, it will get on my nerves that it isn't nice and flat. Next time, I think I'll forego the low quality pine wood, and instead make the hub out of something both flat and strong. This would let it be better held in the chuck, and more likely to not mess up the facing operations on the lathe. I think a red hub with a semi transparent or fully transparant platter would look really cool, if I could get my hands on some red plastic. </p>


<address>
<a href="../index.php">leviticusrhoden.com Homepage</a>
</address>
<address>
<a href="crafting.php">Back to Crafting</a>
</address>
<address><a href = "rss.xml"> RSS Feed</a></address>
<address><a href = "mailto: levi@leviticusrhoden.com">Send Me an E-Mail!</a></address>
</body>

</html>
