<!-- 
Author: Adams Ubini
Description: Register and login page for the smart clothing store 
-->

<?php
    include_once('../config.php');

    session_start();
    #connect to mysql database
    $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

    if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

    // Only run this code if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        #get the parameter from the HTML form that this PHP program is connected to
        #since data from the form is sent by the HTTP POST action, use the $_POST array here
        if (isset($_POST['password_login']) && !empty($_POST['password_login']) && isset($_POST['email']) && !empty($_POST['email'])) {
            $password = trim(htmlspecialchars($_POST['password_login']));
            $email = trim(htmlspecialchars($_POST['email']));

            $password = mysqli_real_escape_string($db, $password);
            $email = mysqli_real_escape_string($db, $email);

            $constructed_query = "SELECT * FROM Users WHERE email = '$email'";
            $result = mysqli_query($db, $constructed_query);

            #if result object is not returned, then print an error and exit the PHP program
            if (! $result) {
                print("Error - query could not be executed");
                $error = mysqli_error($db);
                print "<p> . $error . </p>";
                exit;
            }

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                
                // Check hashed password
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['title'] = $row['title'];
                    $_SESSION['role'] = $row['role'];

                    // Login successful, redirect to homepage
                    header("Location: $BASE_URL/index.php");
                    exit();
                } else {
                    echo "<script>alert('Invalid email or password. Please try again.');</script>";
                }
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
    <title>Login</title>
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


    <h2>Login to the Smart Clothing Store</h2>

    <form id="loginForm" action="<?php echo $BASE_URL; ?>/customer/cust_login.php" method="POST">
        <dl>

            <dt><label for="email">Email:</label></dt>
            <dd><input type="text" id="email" name="email" required maxLength=255><br><br></dd>

            <dt><label for="password_login">Password:</label></dt>
            <dd><input type="password" id="password_login" name="password_login" required maxLength=100><br><br></dd>
        </dl>
        <button type="submit" name="login_submit">Login</button>
    </form>

    <button class="create-account" type="submit" onclick="window.location.href='<?php echo $BASE_URL; ?>/customer/cust_register.php'">Create Account</button>



    <header id="footer"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
    <script src="<?php echo $BASE_URL; ?>/customer/cust_login.js"></script>
</body>

</html>