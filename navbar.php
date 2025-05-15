<!-- 
Author: Adams Ubini & Momin Imran  
Description: Navigation bar for the Smart Stitch website
-->

<?php

include_once('config.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
</head>

<body>
    <nav class="navbar">
        <h1>Smart Stitch - Your Personalized Clothing Experience</h1>
        <ul>
            <li><a href="<?php echo $BASE_URL; ?>/customer/cust_login.php">Login</a></li>

            <?php if (isset($_SESSION['user_id'])): ?>

                <?php if (isset($_SESSION['tailor_id'])): ?>
                    <li><a href="<?php echo $BASE_URL; ?>/usecase3/tailor-availability.php">Tailor Availability</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['customer_id'])): ?>
                    <li><a href="<?php echo $BASE_URL; ?>/index.php">Home</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/Custom-Fitting/Custom-Fitting.php">Custom Fitting</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/User-Tailor-Communication.php">Contact Tailor</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/usecase3/bookAppointment.php">Book Appointment</a></li>
                <?php endif; ?>
                <li><a href="<?php echo $BASE_URL; ?>/logout.php">Logout</a></li>
            <?php endif; ?>





        </ul>
    </nav>
</body>

</html>