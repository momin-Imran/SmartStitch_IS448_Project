<?php
/*
-------------------------------------------------------
Author: Nathan Rakhamimov
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

// Utility function: May weekday abbreviation to actual date for the current week
function getDateForDayThisWeek($dayAbbr) {
    $dayMap = [
        'sun' => 0,
        'mon' => 1,
        'tue' => 2,
        'wed' => 3,
        'thu' => 4,
        'fri' => 5,
        'sat' => 6
    ];

    $today = date('w'); // Get current day index (0=Sun, 6=Sat)
    $target = $dayMap[$dayAbbr];

    // Calculate the timestamp for this week's Monday
    $mondayTimestamp = strtotime("last Sunday") + (60 * 60 * 24); // always get this week's Monday
    $targetTimestamp = $mondayTimestamp + 86400 * ($target - 1); // offset from Monday

    return date('Y-m-d', $targetTimestamp);
}
// Define possible days and time slots
$days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
$slots = ['9am', '12pm', '3pm'];

// Step 1: Delete all previous availability records for the tailor
$deleteQuery = "DELETE FROM Tailor_Availability WHERE tailor_id = ?";
$deleteStmt = $db->prepare($deleteQuery);
$deleteStmt->bind_param("i", $tailor_id);
$deleteStmt->execute();
$deleteStmt->close();

// Step 2: Prepare the insert statement for new availability
$insertQuery = "INSERT INTO Tailor_Availability (tailor_id, date, time_slot) VALUES (?, ?, ?)";
$insertStmt = $db->prepare($insertQuery);

// Step 3: Loop through the form inputs and save checked time slots
foreach ($days as $day) {
    $dateValue = getDateForDayThisWeek($day);

    foreach ($slots as $slot) {
        $inputName = "{$day}_{$slot}";
        if (isset($_POST[$inputName])) {
            $insertStmt->bind_param("iss", $tailor_id, $dateValue, $slot);
            $insertStmt->execute();
        }
    }
}
// Cleanup
$insertStmt->close();
$db->close();
// Output success message to client
echo "success";
exit();
?>
