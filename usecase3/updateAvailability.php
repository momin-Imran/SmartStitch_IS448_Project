<?php
/*
-------------------------------------------------------
updateAvailability.php
Processes the POST form submission for tailor availability.
Clears any previous availability records and saves the new ones.
-------------------------------------------------------
*/

include_once('../config.php');
session_start();

// Check if tailor is logged in
if (!isset($_SESSION['tailor_email']) || !isset($_SESSION['tailor_id'])) {
    echo "Access denied. Please log in as a tailor.";
    exit();
}

$tailor_id = $_SESSION['tailor_id'];

// Connect to database
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Define days and time slots
$days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
$slots = ['9am', '12pm', '3pm'];

// Delete existing availability for this tailor
$deleteQuery = "DELETE FROM tailor_availability WHERE tailor_id = ?";
$deleteStmt = $db->prepare($deleteQuery);
$deleteStmt->bind_param("i", $tailor_id);
$deleteStmt->execute();
$deleteStmt->close();

// Prepare insert query
$insertQuery = "INSERT INTO tailor_availability (tailor_id, day, time_slot) VALUES (?, ?, ?)";
$insertStmt = $db->prepare($insertQuery);

// Loop through all possible day-slot combos
foreach ($days as $day) {
    foreach ($slots as $slot) {
        $inputName = "{$day}_{$slot}";

        if (isset($_POST[$inputName])) {
            $insertStmt->bind_param("iss", $tailor_id, $day, $slot);
            $insertStmt->execute();
        }
    }
}

$insertStmt->close();
$db->close();

// Redirect to the availability page with a success message
header("Location: tailor-availability.php?status=success");
exit();
?>
