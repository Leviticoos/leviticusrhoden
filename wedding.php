<html>
<head>
<title>
Rhoden Wedding
</title>
</head>
<body>

<link href="/css/weddingstyles.css" rel="stylesheet" type="text/css">

<img src="/photos/pikachu_construction.gif" width="300px" class="center">

<dl>
<dt style="font-size: 20pt;"><address><a href="#rsvp">RSVP</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#directions">Directions</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#itinerary">Itinerary</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#photos">Photos</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#hallmark">The Plot of our Hallmark Movie</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#party">Wedding Party Members</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#hotels">Hotels</a></address></dt>
<dt style="font-size: 20pt;"><address><a href="#registry">Registry</a></address></dt>
</dl>
<br><br>

<h1 id="rsvp">
RSVP
</h1>
<p>

</p>
<br><br>

<h1 id="directions">
Directions
</h1>
<p>
You can drive there! Not much else. Reach out to us if you need/can offer to drive for a carpool.
</p>

<h1 id="itinerary">
Itinerary
</h1>
<p>
HEY Y"ALL WE GETTING MARRIED, ON A DAY OR SOMETHING IDK.
</p>
<br><br>

<h1 id="photos">
Photos
</h1>
<p>
Engagement photos, and maybe eventually our wedding photos!
</p>
<br><br>

<h1 id="hallmark">
The Plot of our Hallmark Movie
</h1>
<p>

</p>
<br><br>

<h1 id="party">
Wedding Party Members
</h1>
<p>

</p>
<br><br>

<h1 id="hotels">
Hotels
</h1>
<p>

</p>
<br><br>

<h1 id="registry">
Registry
</h1>
<p>

</p>
<br><br>

<!--  from https://www.w3schools.com/howto/howto_js_countdown.asp -->
<script>
// Set the date we're counting down to
var countDownDate = new Date("Dec 2, 2023 12:30:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

</body>

</html>