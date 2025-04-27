<!-- 
Author: Nathan Rakhamimov  
Description: This HTML file provides a login form for tailors and an availability update section.
    Tailors can log in with their email and password, then update their available time slots 
    using a weekly calendar format. The form submits data for processing. 
-->


<?php
include_once('config.php');
// include_once($_SERVER['DOCUMENT_ROOT'] . '/SmartStitch_IS448_Project/config.php');

// include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailor Availability Update</title>

    <!-- Link to external CSS file for styling -->
    <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>

    <header id="navbar"></header>
    <script>
        // Load the navbar from the external file
        fetch('<?php echo $BASE_URL; ?>/navbar.php')
            .then(response => response.text())
            .then(data => document.getElementById('navbar').innerHTML = data);
    </script>
    <!-- Tailor Login Form -->
    <h2>Tailor Login</h2>
    <form id="loginForm" method="POST" action="login.php">
        <!-- Input for email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <!-- Input for password -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <!-- Submit button for login -->
        <button type="submit">Login</button>
    </form>

    <!-- Availability Update Section -->
    <h2>Update Availability</h2>
    <!-- PHP code work in progress -->
    <form id="availabilityForm" method="POST" action="updateAvailability.php">

        <!-- Weekly Calendar Table for Selecting Availability -->
        <table>
            <tr>
                <th>Time Slot</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
            </tr>
            <tr>
                <td>9AM - 11AM</td>
                <td><input type="checkbox" name="mon_9am" title="Monday 9AM - 11AM"></td>
                <td><input type="checkbox" name="tue_9am" title="Tuesday 9AM - 11AM"></td>
                <td><input type="checkbox" name="wed_9am" title="Wednesday 9AM - 11AM"></td>
                <td><input type="checkbox" name="thu_9am" title="Thursday 9AM - 11AM"></td>
                <td><input type="checkbox" name="fri_9am" title="Friday 9AM - 11AM"></td>
                <td><input type="checkbox" name="sat_9am" title="Saturday 9AM - 11AM"></td>
                <td><input type="checkbox" name="sun_9am" title="Sunday 9AM - 11AM"></td>
            </tr>
            <tr>
                <td>12PM - 2PM</td>
                <td><input type="checkbox" name="mon_12pm" title="Monday 12PM - 2PM"></td>
                <td><input type="checkbox" name="tue_12pm" title="Tuesday 12PM - 2PM"></td>
                <td><input type="checkbox" name="wed_12pm" title="Wednesday 12PM - 2PM"></td>
                <td><input type="checkbox" name="thu_12pm" title="Thursday 12PM - 2PM"></td>
                <td><input type="checkbox" name="fri_12pm" title="Friday 12PM - 2PM"></td>
                <td><input type="checkbox" name="sat_12pm" title="Saturday 12PM - 2PM"></td>
                <td><input type="checkbox" name="sun_12pm" title="Sunday 12PM - 2PM"></td>
            </tr>
            <tr>
                <td>3PM - 5PM</td>
                <td><input type="checkbox" name="mon_3pm" title="Monday 3PM - 5PM"></td>
                <td><input type="checkbox" name="tue_3pm" title="Tuesday 3PM - 5PM"></td>
                <td><input type="checkbox" name="wed_3pm" title="Wednesday 3PM - 5PM"></td>
                <td><input type="checkbox" name="thu_3pm" title="Thursday 3PM - 5PM"></td>
                <td><input type="checkbox" name="fri_3pm" title="Friday 3PM - 5PM"></td>
                <td><input type="checkbox" name="sat_3pm" title="Saturday 3PM - 5PM"></td>
                <td><input type="checkbox" name="sun_3pm" title="Sunday 3PM - 5PM"></td>
            </tr>
        </table>

        <!-- Submit button for updating availability -->
        <button type="submit">Update Availability</button>
    </form>

    <header id="footer"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>

</body>

</html>