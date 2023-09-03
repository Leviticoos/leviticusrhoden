<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $name2 = $_POST["name2"];
    $name3 = $_POST["name3"];
    $name4 = $_POST["name4"];
    $name5 = $_POST["name5"];
    $email = $_POST["email"];
    $guests = $_POST["guests"];
    $attend = $_POST["attend"];
    $feed = $_POST["feed"];
    $feed2 = $_POST["feed2"];
    $feed3 = $_POST["feed3"];
    $feed4 = $_POST["feed4"];
    $feed5 = $_POST["feed5"];
    $notes = $_POST["notes"];

    $responseText = "Names: $name, $name2, $name3, $name4, $name5\nGuests: $guests\nEmail: $email\nAttendance: $attend\nFood Choices: $feed, $feed2, $feed3, $feed4, $feed5\nNotes: $notes\n\n";

    // Specify the path to the text file
    $filePath = "rsvp_responses.txt";

    // Append the response to the text file
    file_put_contents($filePath, $responseText, FILE_APPEND);

    echo "Thank you for your RSVP!";
} else {
    echo "Invalid request.";
}
?>
