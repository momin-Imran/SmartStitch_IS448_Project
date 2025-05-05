<!-- 
Author: Adams Ubini
Description: Register and login page for the smart clothing store 
-->

<?php
    include_once('../config.php');

    #connect to mysql database
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");


    # Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        #get the parameter from the HTML form that this PHP program is connected to
        #since data from the form is sent by the HTTP POST action, use the $_POST array here
        if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['last_name']) && !empty($_POST['last_name']) && isset($_POST['first_name']) && !empty($_POST['first_name'])) {

            
            $password = trim(htmlspecialchars($_POST['password']));
            $email = trim(htmlspecialchars($_POST['email']));
            $last_name = trim(htmlspecialchars($_POST['last_name']));
            $first_name = trim(htmlspecialchars($_POST['first_name']));
            $title = trim(htmlspecialchars($_POST['title']));
            $phone = trim(htmlspecialchars($_POST['phone']));

            $password = mysqli_real_escape_string($db, $password);
            $email = mysqli_real_escape_string($db, $email);
            $last_name = mysqli_real_escape_string($db, $last_name);
            $first_name = mysqli_real_escape_string($db, $first_name);
            $title = mysqli_real_escape_string($db, $title);
            $phone = mysqli_real_escape_string($db, $phone);

            $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
        

            #construct a query
            $constructed_query = "INSERT INTO Users (title, first_name, last_name, email, password, phone) VALUES ('$title', '$first_name', '$last_name', '$email', '$password', '$phone')";

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
                $cust_query = "INSERT INTO Customer (user_id) VALUES ('$user_id')";
                $cust_result = mysqli_query($db, $cust_query);

                if (!$cust_result) {
                    $error = mysqli_error($db);
                    echo "<script>alert('Registration failed: $error')</script>";
                    exit;
                }

                echo "<script>alert('Registration successful! You can now log in.');</script>";
                // Redirect to the login page after successful registration
                header("Refresh: 2; URL=$BASE_URL/customer/cust_login.php");
                exit;
            }
        } else {
            echo "all fields must be filled out";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    <h2>CREATE ACCOUNT</h2>

    <p class="already-registered">
        <a href="<?php echo $BASE_URL; ?>/customer/cust_login.php">I already have it</a>
    </p>

    <form id="registerForm" action="cust_register.php" method="POST">
        <dl>
            <dt><label for="title">TITLE:</label></dt>
            <dd>
                <select id="title" name="title" required>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                </select>
                <br><br>
            </dd>

            <dt><label for="first_name">FIRST NAME:</label></dt>
            <dd><input type="text" id="first_name" name="first_name" required maxLength=255><br><br></dd>

            <dt><label for="last_name">LAST NAME:</label></dt>
            <dd><input type="text" id="last_name" name="last_name" required maxLength=255><br><br></dd>

            <dt><label for="email">EMAIL:</label></dt>
            <dd><input type="email" id="email" name="email" required maxLength=255><br><br></dd>

            <dt><label for="phone">PHONE NUMBER:</label></dt>
            <dd><input type="phone" id="phone" name="phone" required maxLength=100><br><br></dd>

            <dt><label for="password">PASSWORD:</label></dt>
            <dd><input type="password" id="password" name="password" required maxLength=100><br><br></dd>

            <dt><label for="confirm_password">CONFIRM PASSWORD:</label></dt>
            <dd><input type="password" id="confirm_password" name="confirm_password" required maxLength=100><br><br></dd>
        </dl>
        <button type="submit">Create Account</button>
    </form>


    <header id="footer"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
    <script src="<?php echo $BASE_URL; ?>/customer/cust_register.js"></script>
</body>

</html>