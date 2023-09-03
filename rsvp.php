<html>
<head>
<title>
Rhoden Wedding RSVP
</title>
</head>
<body>

<link href="css/weddingstyles.css" rel="stylesheet" type="text/css">

<h1>Rhoden Wedding RSVP</h1>
<br><br>

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

        <div id="guest1" style="display: block;">
        <label for="feed">What will you be eating?</label>
          <select id="feed" name="feed" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="guest2" style="display: none;">

        <label for="name2">What is the full name of the second person?</label>
            <input type="text" id="name2" name="name2"><br><br>

        <label for="feed2">What will the second person be eating?</label>
          <select id="feed2" name="feed2" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="guest3" style="display: none;">

        <label for="name3">What is the full name of the third person?</label>
            <input type="text" id="name3" name="name3"><br><br>

        <label for="feed3">What will the third person be eating?</label>
          <select id="feed3" name="feed3" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="guest4" style="display: none;">

        <label for="name4">What is the full name of the fourth person?</label>
            <input type="text" id="name4" name="name4"><br><br>

        <label for="feed4">What will the fourth person be eating?</label>
          <select id="feed4" name="feed4" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <div id="guest5" style="display: none;">

        <label for="name5">What is the full name of the second person?</label>
            <input type="text" id="name5" name="name5"><br><br>

        <label for="feed5">What will the fifth person be eating?</label>
          <select id="feed5" name="feed5" required>
              <option value="n/a">Select one</option>
              <option value="chicken">Chicken marsala</option>
              <option value="lasagna">Vegetarian lasagna</option>
          </select>
        </div><br><br>

        <label for="notes">Any other comments? Dietary or otherwise?</label>
            <input type="text" id="notes" name="notes"><br><br>

        <input type="submit" value="Submit">
</form>
<br><br>

<script>
          const guests = document.getElementById("guests");
          const feed = document.getElementById("guest1");
          const feed2 = document.getElementById("guest2");
          const feed3 = document.getElementById("guest3");
          const feed4 = document.getElementById("guest4");
          const feed5 = document.getElementById("guest5");

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


    </body>
    </html>