<!-- 
Author: Momin Imran 
Description: Functionality for adding product to card within a started session.-->


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: customer/cust_login.php");
    exit();
}
$product_id = intval($_POST['product_id'] ?? 0);
if ($product_id > 0) {
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    $_SESSION['cart'][] = $product_id;
}
header("Location: cart.php");
exit;

