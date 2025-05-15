<?php

/**
 * File: tailor-availability.php
 * -----------------------------
 * Author: Nathan Rakhamimov
 * Tailor Availability Page
 * 
 * This pafe allows authenticated tailors to update their weekly availability using a form with checkboxes
 * for different time slots and days of the week. Availability data is submitted to 'updateAvailability.php'.
 * 
 * Features: 
 * - Session-based authentication (tailor or customer)
 * - Dynamic navbar and footer inclusion using JS
 * - Conditional rendering based on user role (only tailors can update availability)
 * - Basic availability calendar structure with predefined time slots
 */

include_once('../config.php');

session_start(); // Start or resume the session

// Redirect back to log-in if not authenticated as either tailor or customer
if (!isset($_SESSION['tailor_email']) && !isset($_SESSION['customer_email'])) {
    header("Location: /customer/cust_login.php");
    exit();
}

// Determine user role and tailor_id
$isTailor = isset($_SESSION['tailor_email']);
$tailor_id = $isTailor ? $_SESSION['tailor_id'] : null;

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
    <link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>

    <!-- Navbar is dynamically loaded from navbar.php using JavaScript -->
    <header id="navbar"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/navbar.php') // Fetch navbar HTML from an external file
            .then(response => response.text()) // Convert response to plain text
            .then(data => document.getElementById('navbar').innerHTML = data); // Inject into page
    </script>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <p>Your availability has been successfully updated!</p>
    <?php endif; ?>

    <h2><?php echo $isTailor ? "Update Availability" : "Tailor Availability"; ?></h2>

    <!-- Availability calendar (visible to all logged-in users) -->
    <form method="POST" action="updateAvailability.php">
        <table>
            <tr>
                <!-- First row: headers for time slots and weekdays -->
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
                    if ($isTailor) {
                        // Each checkbox will send a value like name="mon_9am" if checked
                        echo "<td><input type='checkbox' name='{$name}'></td>";
                    } else {
                        echo "<td><input type='checkbox' disabled></td>";
                    }
                }

                echo "</tr>"; // End of row for that time slot
            }
            ?>
        </table>
        <!-- Only show submit button if user is a tailor -->
        <?php if ($isTailor): ?>
            <button type="submit">Update Availability</button> <!-- Submit button to send form data -->
        <?php endif; ?>
    </form>

    <!-- Footer is dynamically loaded from footer.html using JavaScript -->
    <footer id="footer"></footer>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html') // Fetch footer HTML content
            .then(response => response.text()) // Convert response to text
            .then(data => document.getElementById('footer').innerHTML = data); // Inject into page
    </script>
    <script src="<?php echo $BASE_URL; ?>/usecase3/availability.js"></script>
</body>

</html>