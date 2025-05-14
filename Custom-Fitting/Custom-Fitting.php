<?php

include_once('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


session_start();

$servername = "studentdb-maria.gl.umbc.edu";
$username = "eubini1"; // replace with your DB username
$password = "eubini1"; // replace with your DB password
$database = "eubini1"; // replace with your DB name


$db =  mysqli_connect($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno())    exit("Error - could not connect to MySQL");


if ($_SERVER["REQUEST_METHOD"]=="POST" ){
    if(
        isset($_POST['email']) && !empty($_POST['email'])
    )
    {
        $email = trim(htmlspecialchars($_POST['email']));
        $email = mysqli_real_escape_string($db, $email);

        $queryUser = "SELECT user_id FROM Users WHERE email = '$email' ";
        $ResUser = mysqli_query($db, $queryUser);

        if (! $ResUser || mysqli_num_rows($ResUser) !==1) {
            echo "<script>alert('No user found with that email.');</script>";
 
        }

        $user_id = mysqli_fetch_assoc($ResUser)['user_id'];

        //Lookup customer_id from user
        $queryCustomer = "SELECT customer_id FROM Customer WHERE user_id = $user_id";
        $resCustomer = mysqli_query($db, $queryCustomer);

        // check for SQL errors
        if (! $resCustomer) {
        $err = mysqli_error($db);
        echo "<script>alert('Customer lookup failed: $err');</script>";
        exit;
        }

        // make sure exactly one row was returned
        if (mysqli_num_rows($resCustomer) !== 1) {
            echo "<script>alert('No Customer record found for this user.');</script>";
            exit;
        }

        // pull out the customer_id
        $row = mysqli_fetch_assoc($resCustomer);
        $Customer_ID = $row['customer_id'];

        function numOrNull($val) {
            return ($val !== '') 
              ? floatval($val) 
              : 'NULL';
        }

        // sanitize & prepare measurements (NULL if blank)
        $chest    = numOrNull($_POST['chest']   ?? '');
        $waist    = numOrNull($_POST['waist']   ?? '');
        $neck     = numOrNull($_POST['neck']    ?? '');
        $shoulder = numOrNull($_POST['shoulder']?? '');
        $arm     = numOrNull($_POST['arm']     ?? '');
        $inseam   = numOrNull($_POST['inseam']  ?? '');
        $hips     = numOrNull($_POST['hips']    ?? '');
        $rise     = numOrNull($_POST['rise']    ?? '');
        
        // only specInst is truly a string, so escape and quote it:
        $specInst = mysqli_real_escape_string(
           $db,
           trim(htmlspecialchars($_POST['special_instructions'] ?? ''))
        );
        
        
       
        $updateSizePref = "
        UPDATE SizePrefs
        SET chest          = $chest,
        waist              = $waist,
        neck               = $neck,
        shoulder           = $shoulder,
        arm                = $arm,
        inseam             = $inseam,
        hips               = $hips,
        rise               = $rise,
        specInst           = '$specInst'
        WHERE customer_id       = $Customer_ID";

        if (! mysqli_query($db, $updateSizePref)) {
            die("Insert failed: " . mysqli_error($db));
        }

        // success
        echo "<script>
        window.alert('Measurements saved successfully!');
        window.location.href = 'Custom-Fitting.php';
        </script>";
    exit;
    
    } 

}   

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <title>Custom Fitting Application</title>

    <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/styles.css">

    <!-- Prototype.js for Ajax.Request -->
    <script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
    <script src="custom_fitting.js"></script>

</head>

<body>


    <!--Nav Bar-->
    <header id="navbar"></header>
    <script>
        // Load the navbar from the external file
        fetch('<?php echo $BASE_URL; ?>/navbar.php')
            .then(response => response.text())
            .then(data => document.getElementById('navbar').innerHTML = data);
    </script>
    <!--Insert code to pull information from User account if applicable-->
    <!-- Using an If-Else statement for the above, Current code is hypothetical "else" code-->

    <section id="user-contact">
        <h2>Please enter your information:</h2>
        <h3>If you do not know your measurements you may leave those blank and answer what you do know.</h3>
        <form id="contact-information" method="POST" action="Custom-Fitting.php">
            <fieldset class="GuestContact">
                
                <label for="Email">Email address:</label>
                <input type="email" name="email" maxlength="75" required>

            </fieldset>

            <fieldset class="measurements-upper">

                <label for="Chest-Measurement">Chest measurement (cm):</label>
                <input type="number" name="chest">

                <label for="Waist-Measurement">Waist measurement (cm):</label>
                <input type="number" name="waist">

                <label for="Shoulder-Measurement">Shoulder Width (cm):</label>
                <input type="number" name="shoulder">

                <label for="Arm-Measurement">Arm Length (cm):</label>
                <input type="number" name="arm">

                <label for="Neck-Measurement">Neck Size (cm):</label>
                <input type="number" name="neck">
            </fieldset>

            <fieldset class="measurements-lower">

                <label for="Inseam-Measurement">Inseam measurement (cm):</label>
                <input type="number" name="inseam">

                <label for="Hips-Measurement">Hips measurement (cm):</label>
                <input type="number" name="hips">

                <label for="Rise-Measurement">Rise measurement (cm):</label>
                <input type="number" name="rise">

            </fieldset>

            <fieldset class="special">
                <label for="special-instructions">Special Instructions:</label>
                <textarea id="special-instructions" name="special-instructions" rows="4" placeholder="Any special tailoring requests (500 character limit)..."></textarea>
            </fieldset>

            <button type="submit">Submit</button>
            </div>
        </form>
    </section>


    <header id="footer"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>

</body>

</html>
