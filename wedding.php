<html>
<head>
<title>
Rhoden Wedding
</title>
</head>
<body>

<link href="css/weddingstyles.css" rel="stylesheet" type="text/css">

<!-- Display the countdown timer in an element -->
<dt id="demo" style="font-size: 32pt;"></dt>

<font size="+2">

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
We have not set up an RSVP yet, but stay tuned!
</p>
<br><br>

<h1 id="directions">
Directions
</h1>
<p>
  If you are looking for timing of things, please jump to <a href="#itinerary">the itinerary</a>, but if you're hoping into a car and are about to start an argument while trying to remember where you're going next, here are the addresses!
</p>
<p>
  First, we are having our ceremony at the very pretty <a href="https://goo.gl/maps/rW78RwH3E3EJwyPn7">Snohomish United Methodist Church</a> at 12:30! It's a nice drive north of both Seattle and Levi's parents house.
</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2672.7882575412013!2d-122.1022207846582!3d47.940479379208256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x549aa982b7207fe1%3A0xba55f81073e14a92!2sSnohomish%20United%20Methodist%20Church!5e0!3m2!1sen!2sus!4v1678817193956!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<p>
Our reception will be held at the lovely <a href="https://goo.gl/maps/iKdSjHkyPrbB6HsE7">Sadie Lake Events</a>! We will drive there after the ceremony, which should wrap up around 1:30, and the drive is about 30 minutes.
</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2662.557367009776!2d-122.22825558465013!3d48.138058879223486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5485513e2dd7cfbf%3A0x4fcb498450d0912!2sSadie%20Lake%20Events!5e0!3m2!1sen!2sus!4v1678816463240!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<h1 id="itinerary">
Itinerary
</h1>
<p>
Our wedding will be held on Saturday December 2nd, year of our Lord 2023. We will start things off at <a href="https://goo.gl/maps/rW78RwH3E3EJwyPn7">Snohomish United Methodist Church</a>, 12:30.
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

</font>

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
    document.getElementById("demo").innerHTML = "Emma & Levi are Now Married! I Love You My Dear Wife!";
  }
}, 1000);
</script>

</body>

</html>