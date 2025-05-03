<?php
/*
-------------------------------------------------------
Description: 
This file displays a web form for tailors to update their weekly 
availability in different time slots. It verifies user session data, 
establishes a database connection, and dynamically renders a table 
of checkboxes. Tailor availability data is submitted to 
updateAvailability.php for processing.
-------------------------------------------------------
*/

// Include configuration file (useful for constants or DB reuse)
include_once('../config.php');

// Start or resume the current session
session_start();

// SESSION VALIDATION
// Check if tailor is logged in by verifying session variables
if (!isset($_SESSION['tailor_email']) || !isset($_SESSION['tailor_id'])) {
    echo "Session variables not set. Something went wrong with login.";
    exit(); // Stop execution if session data is missing
}

// Store logged-in tailor's credentials
$tailor_email = $_SESSION['tailor_email'];
$tailor_id = $_SESSION['tailor_id'];

// DATABASE CONNECTION
// Connect to UMBC's student MariaDB server with current credentials
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

// If the database connection fails, display an error and terminate
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

// DEBUGGING (can be removed or disabled later)
// Show currently logged-in tailor information
echo "Logged in as: " . $tailor_email . " (ID: $tailor_id)";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tailor Availability Update</title>
    <link rel="stylesheet" href="styles2.css"> <!-- External stylesheet -->
</head>

<body>

    <!-- NAVBAR LOADING -->
    <!-- Dynamically load navigation bar from external PHP file using fetch API -->
    <header id="navbar"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/navbar.php')
            .then(response => response.text())
            .then(data => document.getElementById('navbar').innerHTML = data);
    </script>

    <!-- PAGE TITLE -->
    <h2>Update Availability</h2>

    <!-- AVAILABILITY FORM -->
    <!-- Submits selected checkboxes to updateAvailability.php via POST -->
    <form method="POST" action="updateAvailability.php">
        <table>
            <tr>
                <th>Time Slot</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>

            <?php
            // Define time slots and corresponding suffixes used in checkbox names
            $timeSlots = [
                '9AM-11AM' => '9am',
                '12PM-2PM' => '12pm',
                '3PM-5PM' => '3pm'
            ];

            // Define the days of the week
            $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

            // Loop through each time slot to generate a row
            foreach ($timeSlots as $label => $suffix) {
                echo "<tr><td>$label</td>";
                foreach ($days as $day) {
                    // Construct the input name: e.g., mon_9am, tue_12pm
                    $name = "{$day}_{$suffix}";
                    echo "<td><input type='checkbox' name='{$name}'></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>

        <!-- Submit button to send selected availability to server -->
        <button type="submit">Update Availability</button>
    </form>

    <!-- FOOTER LOADING -->
    <!-- Dynamically load footer HTML from external file using fetch API -->
    <footer id="footer"></footer>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>

</body>

</html>