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

<img src="photos/cutie_and_the_beast.JPG" alt="HI EMMA! I LOVE YOU AND Y'OULL NEVER SEE THIS
    yes i will you silly bean. someone's gotta edit the dang website. I love you too //<3//" style="display: block; margin-left: auto; margin-right: auto;">


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

<form action="process_form.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="attend">Will you be attending?</label>
        <select id="attend" name="attend" required>
            <option value="yes">I joyfully accept the invitation</option>
            <option value="no">I regretfully decline the invitation</option>
        </select>
        <br><br>
        
        
        <label for="guests">For whom in your party are you responding?</label>
        <select id="guests" name= "guests" required>
            <option value="1">myself</option>
            <option value="2 PLUS 1">myself and my guest</option>
            <option value="2 FAM">myself and another invited family member</option>
            <option value="3">myself and two other invited family members</option>
            <option value="4">myself and three other invited family members</option>
            <option value="5">myself and four other invited family members</option>
        </select>
        <br><br>
        
        <div id="feed" style="display: block;">
        <label for="feed">What will you be eating?</label>
          <select id="feed" name="feed" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="feed2" style="display: none;">
        <label for="feed2">What will the second person be eating?</label>
          <select id="feed2" name="feed2" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="feed3" style="display: none;">
        <label for="feed3">What will the second person be eating?</label>
          <select id="feed3" name="feed3" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="feed4" style="display: none;">
        <label for="feed4">What will the second person be eating?</label>
          <select id="feed4" name="feed4" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="feed5" style="display: none;">
        <label for="feed5">What will the second person be eating?</label>
          <select id="feed5" name="feed5" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <input type="submit" value="Submit">
</form>
<br><br>

<script>
          const guests = document.getElementById("guests");
          const feed = document.getElementById("feed");
          const feed2 = document.getElementById("feed2");
          const feed3 = document.getElementById("feed3");
          const feed4 = document.getElementById("feed4");
          const feed5 = document.getElementById("feed5");

          guests.addEventListener("change", function() {
            const selectedValue = guests.value;

            if (selectedValue === "1") {
                feed.style.display = "block";
                feed2.style.display = "none";
                feed3.style.display = "none";
                feed4.style.display = "none";
                feed5.style.display = "none";
            } else if(selectedValue === "2 PLUS 1" || selectedValue === "2 FAM"){
              feed.style.display = "block";
              feed2.style.display = "block";
              feed3.style.display = "none";
              feed4.style.display = "none";
              feed5.style.display = "none";
            } else if(selectedValue === "3"){
              feed.style.display = "block";
              feed2.style.display = "block";
              feed3.style.display = "block";
              feed4.style.display = "none";
              feed5.style.display = "none";
            }else if(selectedValue === "4"){
              feed.style.display = "block";
              feed2.style.display = "block";
              feed3.style.display = "block";
              feed4.style.display = "block";
              feed5.style.display = "none";
            }else if(selectedValue === "5"){
              feed.style.display = "block";
              feed2.style.display = "block";
              feed3.style.display = "block";
              feed4.style.display = "block";
              feed5.style.display = "block";
            }
        })
          ;
      </script>



<h1 id="registry">
Registry
</h1>
<p></p>
<br><br>


<h1 id="directions">
Directions
</h1>
<p>
  If you are looking for timing of things, please jump to <a href="#itinerary">the itinerary</a>, but if you're hopping into a car and are about to start an argument while trying to remember where you're going next, here are the addresses!
</p>
<p>
  First, we are having our ceremony at the beautiful <a href="https://goo.gl/maps/rW78RwH3E3EJwyPn7">Snohomish United Methodist Church</a> at 12:30. It's a nice drive north of both Seattle and Levi's parents house.
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
Our wedding will be held on Saturday December 2nd, the year of our Lord 2023. We will start things off at <a href="https://goo.gl/maps/rW78RwH3E3EJwyPn7">Snohomish United Methodist Church</a> at 12:30.
</p>
<br><br>

<h1 id="photos">
Photos
</h1>
<p>
Engagement photos, and eventually some wedding photos!
</p>
<br><br>

<h1 id="hallmark">
The Plot of our Hallmark Movie
</h1>
<p>

</p>
<br><br>

<h1 id="party">
Wedding Party
</h1>
<h2>Best Man: Asa Rhoden</h2>
<h2>Maid of Honor: Laura Skinner</h2>
<p>Laura is Emma's best (and most annoying*) friend. She met Emma on move in weekend in freshman year of college and the two bonded over their shared love of knitting. Many years later they have had many adventures together, and Laura has hopefully shared enough pasta to make up for eating it all that first night in the dorms.</p>
<p>*Since Laura is writing this she can say that</p>
<h2>Groomsmen:</h2>
<h3>Evan Truesdale</h3>
<h3>Brooks Lee</h3>
<h3>Alex Lillian</h3>
<p>Alex is a San Diego native that had the great fortune to take a class with Mr. Rhoden durning their first quarter in collage. The two came together after sailing through English class with three other hooligans. Alex's greatest contribution to this crew was his organization of the table top games that helped keep the gang together for years durning the lockdown. Alex is passionate about games, but his true domain is the gym. Levi and Alex are early morning staples of the UW gym. All in all Alex has known Levi through years of coffee and cider, spears and swords, characters and classes, life and loss.</p>
<h3>Ryan Horn</h3>
<h2>Bridesmaids:</h2>
<h3>Kara Atiyeh</h3>
<img src="photos/IMG_7617.png" style="display: block; margin-left: auto; margin-right: auto;">
<p>Kara is a senior studying Environmental Science at Portland State University, in other words, she is obsessed with exploring the outdoors. She met Emma as a freshman in the dorms at PSU, and since then, they’ve spent most of their time either exploring the city, binge-watching Netflix shows, or baking sweet treats to snack on (and potentially ignoring any and all homework in the process). She met Levi through Emma and has loved getting to know him over the years. She can't wait to see their journey together continue to grow!</p>
<h3>Sara Miller</h3>
<p>Sara is Emma's younger sister by four years. She's excited to be part of the day.</p>
<h3>Kaden Lee</h3>
<img src="photos/K.jpf" style="display: block; margin-left: auto; margin-right: auto;">
<p>Hello! My name is Kaden/Kay (they/them). I’m a Structures Analyst at Boeing and a recent grad of University of Washington. I adore trivia (I was on Jeopardy!) and spend most of my free time rock climbing and playing too many board games. I met Levi freshman year in our shared Oceanic Literature class and was immediately looped into a yearslong dnd game with him. When he introduced me to Emma, I immediately realized that I had met two very special people. I’m so thankful to have met these little lovebirds and I could not be more happy to be one of Emma’s Bridesmaids.</p>
<h3>Eileen Arata</h3>
<img src="Eileen_photo_copy.jpg" style="display: block; margin-left: auto; margin-right: auto;">
<p>I'm just a huge Disney fan looking forward to seeing Levi and Emma live their happily ever after! I've known Levi since we met in the dorms freshman year at UW, and I met Emma at the same time since he was FaceTiming her (as always). Four years and many stories later, we're still all hanging out, and I can't wait to be a part of their big day.</p>
<br><br>

<h1 id="hotels">
Hotels
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