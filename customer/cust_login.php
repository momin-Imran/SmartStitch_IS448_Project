<!-- 
Author: Adams Ubini
Description: Register and login page for the smart clothing store 
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/styles.css">
</head>

<body>

    <header id="navbar"></header>

    <script>
        // Load the navbar from the external file
        fetch('/navbar.html')
            .then(response => response.text())
            .then(data => document.getElementById('navbar').innerHTML = data);
    </script>

        <?php
            session_start();
            #connect to mysql database
            $db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
        
            if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");

            // Only run this code if the form is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                #get the parameter from the HTML form that this PHP program is connected to
                #since data from the form is sent by the HTTP POST action, use the $_POST array here
                if (isset($_POST['password_login']) && !empty($_POST['password_login']) && isset($_POST['email']) && !empty($_POST['email'])){
                    $password = htmlspecialchars($_POST['password_login']);
                    $email = htmlspecialchars($_POST['email']);
            
                    $password = mysqli_real_escape_string($db, $password);
                    $email = mysqli_real_escape_string($db, $email);
            
            
            
                    #construct a query
                    $constructed_query = "SELECT * FROM Customer_Reg WHERE cust_email = '$email' AND cust_password = '$password'";
            
                    #Execute query
                    $result = mysqli_query($db, $constructed_query);
            
                    #if result object is not returned, then print an error and exit the PHP program
                    if (! $result) {
                        print("Error - query could not be executed");
                        $error = mysqli_error($db);
                        print "<p> . $error . </p>";
                        exit;
                    }
            #  <!-- check if exactly one row was returned -->
                if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
            
                        // <!-- Set session variables -->
                        $_SESSION['cust_id'] = $row['customer_id'];
                        $_SESSION['cust_email'] = $row['cust_email'];
                        $_SESSION['cust_first_name'] = $row['cust_first_name'];
                        $_SESSION['cust_last_name'] = $row['cust_last_name'];
                        $_SESSION['cust_phone'] = $row['cust_phone'];
                        $_SESSION['cust_title'] = $row['cust_title'];

                        // Login successful, redirect to homepage
                        header("Location: /index.php");
                        exit();
                    }
                } else {
                    echo "all fields must be filled out";
                }
        }
        ?>


    <h2>Login to the Smart Clothing Store</h2>

    <form action="" method="POST">
        <dl>

            <dt><label for="email">Email:</label></dt>
            <dd><input type="text" id="email" name="email" required maxLength=255><br><br></dd>

            <dt><label for="password_login">Password:</label></dt>
            <dd><input type="password" id="password_login" name="password_login" required maxLength=100><br><br></dd>
        </dl>
        <button type="submit" name="login_submit">Login</button>
    </form>

    <button class="create-account" type="submit" onclick="window.location.href='cust_register.php'">Create Account</button>



    <header id="footer"></header>
    <script>
        fetch('/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
</body>

</html>