<!-- 
Author: Momin Imran 
Description: This is the entry-point to our web app. Generates a basic homepage, with a user-friendly navbar that I initially created only for this page but then we decided to extend to all pages for a consistent connection between pages. Homepage shows the products listed for purchase using block inline styling. 
-->

<?php
include_once('config.php');

session_start();

// 1) Require login
if (!isset($_SESSION['customer_id'])) {
  header("Location: $BASE_URL/customer/cust_login.php");
  exit();
}

// 2) Greet user
echo "<p>Welcome, "
  . htmlspecialchars($_SESSION['first_name'])
  . " "
  . htmlspecialchars($_SESSION['last_name'])
  . "!</p>";
echo "<p>Your email: " . htmlspecialchars($_SESSION['email']) . "</p>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart Stitch</title>
  <!-- Relative link to your CSS -->
  <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/styles.css">
</head>

<body>

  <!-- Navbar -->
  <header id="navbar"></header>
  <script>
    fetch('<?php echo $BASE_URL; ?>/navbar.php')
      .then(r => r.text())
      .then(html => document.getElementById('navbar').innerHTML = html);
  </script>

  <h2>Welcome to Smart Stitch!</h2>
  <p>Shop for your favorite clothes and book an appointment with a tailor for the perfect fit.</p>

  <h3>Shop Our Collection</h3>
  <div class="product-container">

    <!-- Product 1 -->
    <div class="product">
      <img src="assets/cotton_shirts.jpg" alt="Stylish Cotton Shirt" width="150">
      <h4>Stylish Cotton Shirt</h4>
      <p>$29.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="1">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <!-- Product 2 -->
    <div class="product">
      <img src="assets/denim.jpg" alt="Classic Denim Jeans" width="150">
      <h4>Classic Denim Jeans</h4>
      <p>$49.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="2">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <!-- Product 3 -->
    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>


    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>

    <div class="product">
      <img src="assets/dress.jpg" alt="Elegant Evening Dress" width="150">
      <h4>Elegant Evening Dress</h4>
      <p>$79.99</p>
      <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_id" value="3">
        <button type="submit">Add to Cart</button>
      </form>
    </div>


  </div>

  <!-- Footer -->
  <footer id="footer"></footer>
  <script>
    fetch('footer.html')
      .then(r => r.text())
      .then(html => document.getElementById('footer').innerHTML = html);
  </script>

</body>

</html>