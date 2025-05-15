<!-- 
Author: Momin Imran 
Description: This is the entry-point to our web app. Generates a basic homepage, with a user-friendly navbar that I initially created only for this page but then we decided to extend to all pages for a consistent connection between pages. Homepage shows the products listed for purchase using block inline styling. 
-->

<?php
include_once('config.php');


session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: $BASE_URL/customer/cust_login.php");
  exit();
}

// Database connection
$mysqli = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");
if (mysqli_connect_errno()) {
  die("Failed to connect: " . mysqli_connect_error());
}


include "navbar.php";

// Get all products
$products = [];
$result = mysqli_query($mysqli, "SELECT * FROM Products");
if ($result) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Smart Stitch</title>
  <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/styles.css">
  <script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
</head>

<body>
  <h2>Welcome to Smart Stitch!</h2>
  <p>Shop for your favorite clothes and book an appointment with a tailor for the perfect fit.</p>
  <h3>Shop Our Collection</h3>

  <!-- AJAX implementation to search live -->
  <input type="text" id="searchBox" placeholder="Search available products..." onkeyup="liveSearch()" autocomplete="off" />
  <div>
    <b>
      <p>Our sugestions:</p><b>
        <div id="suggestions"></div>
  </div>
  <br>
  <br>

  <div class="product-container">
    <?php foreach ($products as $p): ?>
      <div class="product">
        <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" width="150">
        <h4><?= htmlspecialchars($p['name']) ?></h4>
        <p>$<?= number_format($p['price'], 2) ?></p>
        <form method="POST" action="add_to_cart.php">
          <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
          <button type="submit">Add to Cart</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
  <?php include "$BASE_URL/footer.html"; ?>

  <!-- AJAX and JS validation to make sure we can search for prods live -->
  <script>
    function liveSearch() {
      var query = document.getElementById('searchBox').value;

      // Validaing making sureonly letters, numbers, and spaces allowed
      var valid = /^[A-Za-z0-9 ]+$/.test(query);
      if (query.length > 0 && !valid) {
        alert("Please use only letters, numbers, and spaces in your search.");
        document.getElementById('searchBox').value = ""; // we could clear the field after prompt
        document.getElementById('suggestions').innerHTML = '';
        return false;
      }

      if (query.length < 2) {
        document.getElementById('suggestions').innerHTML = '';
        return;
      }

      // make the call 
      new Ajax.Request('<?php echo $BASE_URL; ?>/search_ajax.php', {
        method: 'get',
        parameters: {
          query: query
        },
        onSuccess: function(ajax) {
          document.getElementById('suggestions').innerHTML = ajax.responseText;
        }
      });
    }
  </script>

</body>

</html>