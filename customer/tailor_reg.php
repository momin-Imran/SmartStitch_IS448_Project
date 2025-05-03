
<?php
    #connect to mysql database
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

    // User info
    $phone = '5467811234';
    $password = '12345678Ab';
    $last_name = 'Levin';
    $first_name = 'Keith';
    $title = 'Mr';
    $email = 'g@g.com';

    $password = trim(htmlspecialchars($password));
    $email = trim(htmlspecialchars($email));
    $last_name = trim(htmlspecialchars($last_name));
    $first_name = trim(htmlspecialchars($first_name));
    $title = trim(htmlspecialchars($title));
    $phone = trim(htmlspecialchars($phone));
    $role = trim(htmlspecialchars('tailor'));    

    $password = mysqli_real_escape_string($db, $password);
    $email = mysqli_real_escape_string($db, $email);
    $last_name = mysqli_real_escape_string($db, $last_name);
    $first_name = mysqli_real_escape_string($db, $first_name);
    $title = mysqli_real_escape_string($db, $title);
    $phone = mysqli_real_escape_string($db, $phone);
    $role = mysqli_real_escape_string($db, $role);

    $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

    #construct a query
    $constructed_query = "INSERT INTO Users (title, first_name, last_name, email, password, phone, role) VALUES ('$title', '$first_name', '$last_name', '$email', '$password', '$phone', '$role')";

    #Execute query
    $result = mysqli_query($db, $constructed_query);

    #if result object is not returned, then print an error and exit the PHP program
    if (! $result) {
        $error = mysqli_error($db);
        echo "<script>alert('Registration failed: $error')</script>";
        exit;
    } else {

        // Get the inserted user_id
        $user_id = mysqli_insert_id($db);

        // Insert into Customer table
        $tailor_query = "INSERT INTO Tailors (user_id) VALUES ('$user_id')";
        $tailor_result = mysqli_query($db, $tailor_query);

        if (!$tailor_result) {
            $error = mysqli_error($db);
            echo "<script>alert('Registration failed: $error')</script>";
            exit;
        }

        echo "<script>alert('Registration successful! You can now log in.');</script>";
        exit;
    }

    

?>