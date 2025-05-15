<?php
session_start();

// Optional: verify if a customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: cust_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Confirmed</title>
    <link rel="stylesheet" href="/usecase3/styles2.css">
</head>
<body>

<header id="navbar"></header>
<script>
    fetch('/navbar.php')
        .then(response => response.text())
        .then(data => document.getElementById('navbar').innerHTML = data);
</script>

<h2>Appointment Confirmed</h2>
<p>Thank you! Your appointment has been successfully booked.</p>
<a href="bookAppointment.php">Book Another Appointment</a>

<footer id="footer"></footer>
<script>
    fetch('/footer.html')
        .then(response => response.text())
        .then(data => document.getElementById('footer').innerHTML = data);
</script>

</body>
</html>
