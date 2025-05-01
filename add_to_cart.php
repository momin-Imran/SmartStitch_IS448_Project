<?php
// Author: Momin Imran
// Description: Adds a product to the session cart

include_once('config.php');
session_start();

// 1) require login
if (!isset($_SESSION['user_id'])) {
    header("Location: $BASE_URL/customer/cust_login.php");
    exit();
}

// 2) get and sanitize
$product_id = isset($_POST['product_id'])
    ? intval($_POST['product_id'])
    : 0;

if ($product_id > 0) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $product_id;
}

// 3) go to cart
header("Location: $BASE_URL/cart.php");
exit;
