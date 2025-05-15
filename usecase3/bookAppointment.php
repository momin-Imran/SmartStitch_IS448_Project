<?php
// Author: Nathan Rakhamimov
// ==============================
// bookAppointment.php
// Allows a logged-in customer to book an appointment with a tailor.
// Checks for existing bookings, inserts new appointment if valid.
// ==============================

include_once('../config.php');
session_start();


// Redirect if customer is not logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: $BASE_URL/customer/cust_login.php");
    exit();
}



$customer_id = $_SESSION['customer_id'];

// Connect to database
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tailor_id = $_POST['tailor_id'];
    $appointment_day = $_POST['day'];
    $appointment_time = $_POST['time'];

    // Check for empty input fields
    if (empty($tailor_id) || empty($appointment_day) || empty($appointment_time)) {
        $message = "All fields are required.";
    } else {
        // Check if the appointment slot is already booked
        $check_sql = "SELECT * FROM appointments WHERE tailor_id = ? AND day = ? AND time_slot = ?";
        $stmt = mysqli_prepare($db, $check_sql);
        mysqli_stmt_bind_param($stmt, "iss", $tailor_id, $appointment_day, $appointment_time);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $message = "This time slot is already booked.";
        } else {
            // Insert new appointment into the database
            $insert_sql = "INSERT INTO appointments (customer_id, tailor_id, day, time_slot)
                           VALUES (?, ?, ?, ?)";
            $insert_stmt = mysqli_prepare($db, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "iiss", $customer_id, $tailor_id, $appointment_day, $appointment_time);

            if (mysqli_stmt_execute($insert_stmt)) {
                // Redirect to confirmation page
                header("Location: appointmentConfirmed.php");
                exit();
            } else {
                $message = "Booking failed: " . mysqli_error($db);
            }

            mysqli_stmt_close($insert_stmt);
        }
        mysqli_stmt_close($stmt);
    }
}

// Close DB connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book an Appointment</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>

    <!-- Load dynamic navbar -->
    <header id="navbar"></header>
    <script>
        fetch('/navbar.php')
            .then(response => response.text())
            .then(data => document.getElementById('navbar').innerHTML = data);
    </script>

    <h2>Book an Appointment</h2>

    <!-- Display message if any -->
    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <!-- Appointment booking form -->
    <form method="POST" action="">
        <label for="tailor_id">Select Tailor:</label>
        <select name="tailor_id" id="tailor_id" required>
            <option value="">-- Choose Tailor --</option>
            <option value="1">Tailor 1</option>
            <option value="2">Tailor 2</option>
            <!-- Replace with dynamic tailor list if needed -->
        </select><br><br>

        <label for="day">Select Day:</label>
        <select name="day" id="day" required>
            <option value="">-- Choose Day --</option>
            <option value="mon">Monday</option>
            <option value="tue">Tuesday</option>
            <option value="wed">Wednesday</option>
            <option value="thu">Thursday</option>
            <option value="fri">Friday</option>
            <option value="sat">Saturday</option>
            <option value="sun">Sunday</option>
        </select><br><br>

        <label for="time">Select Time Slot:</label>
        <select name="time" id="time" required>
            <option value="">-- Choose Time --</option>
            <option value="9AM-11AM">9AM–11AM</option>
            <option value="12PM-2PM">12PM–2PM</option>
            <option value="3PM-5PM">3PM–5PM</option>
        </select><br><br>

        <button type="submit">Book Appointment</button>
    </form>

    <!-- Load dynamic footer -->
    <footer id="footer"></footer>
    <script>
        fetch('/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>

    <!-- Client-side form validation -->
    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            const tailor = document.getElementById("tailor_id").value;
            const day = document.getElementById("day").value;
            const time = document.getElementById("time").value;

            let errorMsg = "";

            if (!tailor) errorMsg += "Please select a tailor.\n";
            if (!day) errorMsg += "Please select a day.\n";
            if (!time) errorMsg += "Please select a time slot.\n";

            if (errorMsg !== "") {
                e.preventDefault(); // Stop form submission
                alert(errorMsg); // Show error messages
            }
        });
    </script>

</body>

</html>