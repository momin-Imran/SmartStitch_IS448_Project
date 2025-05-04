<!-- 
Author: Adams Ubini & Momin Imran  
Description: Navigation bar for the Smart Stitch website
-->

<?php
include_once('config.php')
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
            <li><a href="<?php echo $BASE_URL; ?>/index.php">Home</a></li>
            <li><a href="<?php echo $BASE_URL; ?>/Custom-Fitting.php">Custom Fitting</a></li>
            <li><a href="<?php echo $BASE_URL; ?>/usecase3/tailor-availability.php">Tailor Availability</a></li>
            <li><a href="<?php echo $BASE_URL; ?>/User-Tailor-Communication.php">Contact Tailor</a></li>
            <li><a href="<?php echo $BASE_URL; ?>/customer/cust_login.php">Login</a></li>
            <li><a href="<?php echo $BASE_URL; ?>/logout.php">Logout</a></li>
        </ul>
    </nav>
</body>

</html>