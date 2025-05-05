<!-- 
Author: Momin Imran 
Description: Displays the number of products within the cart and then allows the user to finalize their cart and get ready to checkout.-->


<?php
include_once('config.php');

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: $BASE_URL/customer/cust_login.php");
  exit();
}

$cart = $_SESSION['cart'] ?? [];
$count = count($cart);
?>
<!DOCTYPE html>
<html>

<head>
  <title>Your Cart</title>
  <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>
  <h2>Your Cart 🛒</h2>

  <?php if ($count === 0): ?>
    <p>Your cart is empty. <a href="<?php echo $BASE_URL; ?>/index.php">Shop now</a>.</p>
  <?php else: ?>
    <p>You have <?= $count ?> item<?= $count > 1 ? 's' : '' ?> in your cart.</p>
    <p><a href="<?php echo $BASE_URL; ?>/index.php">Continue Shopping</a></p>
    <form method="POST" action="<?php echo $BASE_URL; ?>/purchase.php">
      <button type="submit">Checkout</button>
    </form>
  <?php endif; ?>
</body>

</html>