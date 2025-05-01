<?php
// Author: Momin Imran
// Description: Processes checkout, inserts into Purchases, clears cart

include_once('config.php');
session_start();

// require login
if (!isset($_SESSION['user_id'])) {
    header("Location: $BASE_URL/customer/cust_login.php");
    exit();
}

// connect
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
if (!$db) exit("DB connect error");

// get cart
$cart = $_SESSION['cart'] ?? [];
$customer_id = intval($_SESSION['user_id']);

// insert each
foreach ($cart as $pid) {
    $pid = intval($pid);
    mysqli_query($db, "
      INSERT INTO Purchases (customer_id, product_id, quantity)
      VALUES ($customer_id, $pid, 1)
    ");
}

// clear
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Thank You</title></head>
<body>
  <h2>Order Confirmed!</h2>
  <p>Thanks for your purchase. We’ve recorded your order.</p>
  <a href="index.php">Continue Shopping</a>
</body>
</html>
