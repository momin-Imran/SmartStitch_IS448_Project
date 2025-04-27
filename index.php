<!-- 
Author: Momin Imran 
Description: This is the entry-point to our web app. Generates a basic homepage, with a user-friendly navbar that I initially created only for this page but then we decided to extend to all pages for a consistent connection between pages. Homepage shows the products listed for purchase using block inline styling. 
-->

<?php

// include_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
include_once('config.php');


session_start();

// 1. Check if session expired
$timeout_duration = 15; // 2 seconds
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration)) {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy the session
    header("Location: $BASE_URL/customer/cust_login.php"); // Redirect to login page
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); //2 Update last activity time


// 3. Check if user is logged in
if (!isset($_SESSION['cust_id'])) {
    header("Location: $BASE_URL/customer/cust_login.php");
    exit();
} else {
    echo "<p>Welcome, " . $_SESSION['cust_first_name'] . " " . $_SESSION['cust_last_name'] . "</p>";
    echo "<p>Your email: " . $_SESSION['cust_email'] . "</p>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Stitch</title>
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

    <br>
    <br>

    <div>
        <h2>Welcome to Smart Stitch!</h2>
        <p>Shop for your favorite clothes and book an appointment with a tailor for the perfect fit.</p>
        <br>
        <br>
        <h3>Shop Our Collection</h3>
        <div class="product-container">
            <div class="product">
                <img src="assets/cotton_shirts.jpg" alt="Stylish Cotton Shirt" width="150">
                <h4>Stylish Cotton Shirt</h4>
                <p>$29.99</p>
                <button class="add-cart">Add to Cart</button> <!-- will add php functioality to cart in the future -->
                <!-- Goal is for Deliverable 6: turn this into a form that submits the product_id to purchase.php (new file) and then shows a simple “Order Confirmed” page. 
                 Also, INSERT into Purchases tabble (using Products for catalog). -->

            </div>
            <div class="product">
                <img src="assets/denim.jpg" alt="Classic Denim Jeans" width="150">
                <h4>Classic Denim Jeans</h4>
                <p>$49.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
                <h4>Elegant Evening Dress</h4>
                <p>$79.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/cotton_shirts.jpg" alt="Stylish Cotton Shirt" width="150">
                <h4>Stylish Cotton Shirt</h4>
                <p>$29.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/cotton_shirts.jpg" alt="Stylish Cotton Shirt" width="150">
                <h4>Stylish Cotton Shirt</h4>
                <p>$29.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/cotton_shirts.jpg" alt="Stylish Cotton Shirt" width="150">
                <h4>Stylish Cotton Shirt</h4>
                <p>$29.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
                <h4>Elegant Evening Dress</h4>
                <p>$79.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
                <h4>Elegant Evening Dress</h4>
                <p>$79.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
            <div class="product">
                <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
                <h4>Elegant Evening Dress</h4>
                <p>$79.99</p>
                <button class="add-cart">Add to Cart</button>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <header id="footer"></header>
    <script>
        fetch('<?php echo $BASE_URL; ?>/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>

</body>

</html>