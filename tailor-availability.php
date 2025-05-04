<?php
/**
 * Tailor Availability Page
 * 
 * This secure page allows a logged-in tailor to update their weekly availability.
 * It ensures the tailor is authenticated using session validation, connects to the database,
 * and presents a form with time slots and weekdays as checkboxes.
 * 
 * On form submission, the data is sent to updateAvailability.php for processing and storage.
 */

 include_once('config.php');

session_start(); // Start or resume the session

// Check if the tailor is logged in by verifying session variables
if (!isset($_SESSION['tailor_email'])) {
    // Redirect to login if not authenticated
    header("Location: cust_login.php");
    exit();
}

// Store session values for use in this page
$tailor_email = $_SESSION['tailor_email'];
$tailor_id = $_SESSION['tailor_id'];

// Connect to the MySQL database using given credentials
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

// If connection fails, display an error and stop execution
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tailor Availability Update</title>
    <link rel="stylesheet" href="styles2.css"> <!-- Link to external stylesheet -->
</head>
<body>

<!-- Navbar is dynamically loaded from navbar.php using JavaScript -->
<header id="navbar"></header>
<script>
    fetch('navbar.php') // Fetch navbar HTML from an external file
        .then(response => response.text()) // Convert response to plain text
        .then(data => document.getElementById('navbar').innerHTML = data); // Inject into page
</script>

<h2>Update Availability</h2>

<!-- Form to collect availability data from tailor -->
<form method="POST" action="updateAvailability.php">
    <table>
        <tr>
            <!-- First row: headers for time slots and weekdays -->
            <th>Time Slot</th>
            <th>Mon</th><th>Tue</th><th>Wed</th>
            <th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th>
        </tr>
        <?php
        // Define the available time slots and assign each a short suffix
        $timeSlots = [
            '9AM-11AM' => '9am',
            '12PM-2PM' => '12pm',
            '3PM-5PM' => '3pm'
        ];

        // Define the days of the week in lowercase
        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

        // Loop through each time slot
        foreach ($timeSlots as $label => $suffix) {
            echo "<tr><td>$label</td>"; // Create a new table row with the time label

            // Loop through each day to create a checkbox input
            foreach ($days as $day) {
                $name = "{$day}_{$suffix}"; // Example: mon_9am
                // Each checkbox will send a value like name="mon_9am" if checked
                echo "<td><input type='checkbox' name='{$name}'></td>";
            }

            echo "</tr>"; // End of row for that time slot
        }
        ?>
    </table>
    <button type="submit">Update Availability</button> <!-- Submit button to send form data -->
</form>

<!-- Footer is dynamically loaded from footer.html using JavaScript -->
<footer id="footer"></footer>
<script>
    fetch('footer.html') // Fetch footer HTML content
        .then(response => response.text()) // Convert response to text
        .then(data => document.getElementById('footer').innerHTML = data); // Inject into page
</script>

</body>
</html>
