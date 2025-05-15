<?php
include_once('../config.php');
session_start();

// Optional: verify if a customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: $BASE_URL/customer/cust_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmed</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>

    <header id="navbar"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/navbar.php')
            .then(response => response.text())
            .then(data => document.getElementById('navbar').innerHTML = data);
    </script>

    <h2>Appointment Confirmed</h2>
    <p>Thank you! Your appointment has been successfully booked.</p>
    <a href="bookAppointment.php">Book Another Appointment</a>

    <footer id="footer"></footer>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>

</body>

</html>