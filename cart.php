<?php
// Author: Momin Imran
// Description: Displays cart contents and lets user checkout

include_once('config.php');
session_start();

// 1) require login
if (!isset($_SESSION['user_id'])) {
    header("Location: $BASE_URL/customer/cust_login.php");
    exit();
}

// 2) connect
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
if (!$db) exit("DB connect error");

// 3) load cart
$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0.0;

foreach ($cart as $pid) {
    $pid = intval($pid);
    $res = mysqli_query($db, "SELECT * FROM Products WHERE product_id = $pid");
    if ($row = mysqli_fetch_assoc($res)) {
        $items[] = $row;
        $total += floatval($row['price']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Your Cart</title></head>
<body>
  <h2>Your Cart 🛒</h2>
  <?php if (empty($items)): ?>
    <p>Your cart is empty. <a href="index.php">Shop now</a>.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($items as $p): ?>
        <li>
          <?= htmlspecialchars($p['name']) ?>  
          — $<?= number_format($p['price'],2) ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <p><strong>Total:</strong> $<?= number_format($total,2) ?></p>

    <form method="POST" action="purchase.php">
      <button type="submit">Checkout &amp; Pay $<?= number_format($total,2) ?></button>
    </form>
  <?php endif; ?>
</body>
</html>
