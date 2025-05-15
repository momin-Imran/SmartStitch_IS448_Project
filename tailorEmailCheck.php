<?php

    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

    $TEmail = $_POST["TEmail"];

    $query = "SELECT user_id from Users Where email='$TEmail'";
    $result = mysqli_query($db, $query);
    if (! $result) {
		print("Data could not be selected");
		$error = mysqli_error($db);
		print("<p> . $error . </p>");
		exit;
	}
    $num_rows = mysqli_num_rows($result);
	if($num_rows == 0) {
        echo "No matching tailor email";
    } else {
        echo "";
    }

?>