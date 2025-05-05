<!-- 
Author: Momin Imran 
Description: Thank you message to user upon checkout and displaying count of products bought.-->



<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: customer/cust_login.php");
  exit();
}

$count = count($_SESSION['cart'] ?? []);
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html>
<head><title>Thank You</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Order Confirmed!</h2>
  <?php if ($count): ?>
    <p>Thanks for buying <?= $count ?> item<?= $count > 1 ? 's' : '' ?> with us.</p>
  <?php else: ?>
    <p>You didn’t have anything in your cart…</p>
  <?php endif; ?>
  <p><a href="index.php">Continue Shopping</a></p>
</body>
</html>