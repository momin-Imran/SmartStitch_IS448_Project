<!-- 
Author: Momin Imran 
Description: Displays the number of products within the cart and then allows the user to finalize their cart and get ready to checkout.-->


<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: customer/cust_login.php");
    exit();
}

$mysqli = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
if (mysqli_connect_errno()) {
    die("Failed to connect: " . mysqli_connect_error());
}


include "navbar.php";


$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0.00;

if ($cart) {
    // Count how many of each product
    $counts = array_count_values($cart);
    $ids = implode(',', array_map('intval', array_keys($counts)));
    // Only run query if there are items
    if (!empty($ids)) {
        $result = mysqli_query($mysqli, "SELECT * FROM Products WHERE product_id IN ($ids)");
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $row['qty'] = $counts[$row['product_id']];
                $items[] = $row;
                $total += $row['price'] * $row['qty'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Your Cart</title><link rel="stylesheet" href="styles.css"></head>
<body>
  <h2>Your Cart 🛒</h2>
  <?php if (empty($items)): ?>
    <p>Your cart is empty. <a href="index.php">Shop now</a>.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($items as $it): ?>
        <li>
          <img src="<?= htmlspecialchars($it['image']) ?>" width="50" alt="">
          <?= htmlspecialchars($it['name']) ?> (x<?= $it['qty'] ?>) — $<?= number_format($it['price'] * $it['qty'], 2) ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <p><strong>Total:</strong> $<?= number_format($total, 2) ?></p>
    <form method="POST" action="purchase.php">
      <button type="submit">Checkout</button>
    </form>
    <p><a href="index.php">Continue Shopping</a></p>
  <?php endif; ?>
  <?php include "footer.php"; ?>
</body>
</html>
