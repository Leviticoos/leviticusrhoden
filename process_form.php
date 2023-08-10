<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $guests = $_POST["guests"];
    $attend = $_POST["attend"];
    $feed = $_POST["feed"];

    $responseText = "Name: $name\nGuests: $guests\nEmail: $email\nAttendance: $attend\nFood Choice: $feed\n\n";

    // Specify the path to the text file
    $filePath = "rsvp_responses.txt";

    // Append the response to the text file
    file_put_contents($filePath, $responseText, FILE_APPEND);

    echo "Thank you for your RSVP!";
} else {
    echo "Invalid request.";
}
?>
