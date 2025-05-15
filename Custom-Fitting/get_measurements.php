<?php
// get_measurements.php
// Returns measurement data for a given email via AJAX

// Start session (if you choose to use session-based auth, otherwise optional)
session_start();

// Return JSON
header('Content-Type: application/json');

// Ensure an email was provided
if (empty($_POST['email'])) {
    echo json_encode([]);
    exit;
}

// Database connection (adjust credentials as needed)
$db = mysqli_connect(
    'studentdb-maria.gl.umbc.edu',
    'eubini1',
    'eubini1!',
    'eubini1'
) or die(json_encode(['error' => 'DB connection failed']));

// Sanitize input
$email = mysqli_real_escape_string($db, trim($_POST['email']));

// Query measurements by email
$sql = "
    SELECT
        sp.chest,
        sp.waist,
        sp.neck,
        sp.shoulder,
        sp.arm,
        sp.inseam,
        sp.hips,
        sp.rise,
        sp.specInst AS specInstr
    FROM Users u
    JOIN Customer c   ON c.user_id       = u.user_id
    JOIN SizePrefs sp ON sp.customer_id  = c.customer_id
    WHERE u.email = '$email'
    LIMIT 1
";


$result = mysqli_query($db, $sql);
if (! $result) {
    echo json_encode(['error' => mysqli_error($db)]);
    exit;
}

$data = mysqli_fetch_assoc($result);

// Output the measurements (or empty array if none found)
echo json_encode($data ?: []);
