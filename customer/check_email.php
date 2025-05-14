<?php
include_once('../config.php');

#connect to mysql database
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

// Check connection
if (!$db) {
    echo json_encode([
        "status"    => "error",
        "message"   => "Database connection failed: " . mysqli_connect_error()
    ]);
    exit;
}

// Check if email is sent via POST
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($db, trim($_POST['email']));

    $query = "SELECT * FROM Users where email = '$email'";
    $result = mysqli_query($db, $query);

    if (!$result) {
        echo json_encode([
            "status"    => "error",
            "message"   => "Query failed: " . mysqli_error($db)
        ]);
        exit;
    }

    $emailExists = mysqli_num_rows($result) > 0;

    echo json_encode([
        "exists" => $emailExists
    ]);

} else {
    echo json_encode([
        "status"    => "error",
        "message"   => "No email parameter received"
    ]);
}
?>