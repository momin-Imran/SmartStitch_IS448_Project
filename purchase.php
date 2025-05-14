<!-- 
Author: Momin Imran 
Description: Thank you message to user upon checkout and displaying count of products bought along with receipt.-->



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

// Get user email from session
$email = htmlspecialchars($_SESSION['email'] ?? 'your email address');

// Prepare cart summary
$cart = $_SESSION['cart'] ?? [];
$items = [];
$total = 0.00;

if ($cart) {
    $counts = array_count_values($cart);
    $ids = implode(',', array_map('intval', array_keys($counts)));
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

// Clear cart after displaying order
unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Order Confirmed!</h2>
    <?php if ($items): ?>
        <p>
            <strong>Thank you for your purchase, <?= htmlspecialchars($_SESSION['first_name'] ?? 'Valued Customer') ?>!</strong>
        </p>
        <p>
            Your order summary:
        </p>
        <table>
    <tr>
        <th>Product</th>
        <th>Image</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
    </tr>
    <?php foreach ($items as $it): ?>
        <tr>
            <td><?= htmlspecialchars($it['name']) ?></td>
            <td><img src="<?= htmlspecialchars($it['image']) ?>" width="50" alt=""></td>
            <td><?= $it['qty'] ?></td>
            <td>$<?= number_format($it['price'], 2) ?></td>
            <td>$<?= number_format($it['price'] * $it['qty'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan="4" style="text-align:right;">Total:</th>
        <th>$<?= number_format($total, 2) ?></th>
    </tr>
</table>

        <p>
            A confirmation email has been sent to <strong><?= $email ?></strong>.
        </p>
        <p>
            We appreciate your business. You can <a href="index.php">continue shopping</a> anytime!
        </p>
    <?php else: ?>
        <p>You didn’t have anything in your cart…</p>
        <p><a href="index.php">Go back to shopping</a></p>
    <?php endif; ?>
    <!-- <?php include "footer.php"; ?> -->
</body>
</html>
