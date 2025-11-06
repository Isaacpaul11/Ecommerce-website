<?php
// database connection
include 'db.php';  // contains $conn = new mysqli(...);

// fetch products from database
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - My Shop</title>
  <link rel="stylesheet" href="CSS/homepage.css"> <!-- your CSS -->
</head>

<body>

  <!-- Latest Products -->
  <section class="latest-products py-5">
    <div class="container">
      <h2>Latest Products</h2>
      <div class="product-grid">
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product-card">
              <a href="product.php?slug=<?php echo $row['slug']; ?>">
                <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
              </a>
              <h3><?php echo $row['name']; ?></h3>
              <p>₹<?php echo number_format($row['price']); ?></p>

              <a href="javascript:void(0);"
                class="btn"
                onclick="addToCart('<?php echo $row['slug']; ?>')">
                Add to Cart
              </a>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No products available</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <script>
    function addToCart(slug) {
      fetch(`add_to_cart.php?slug=${slug}`)
        .then(res => res.text())
        .then(msg => {
          alert(msg); // Shows "Product added to cart!"
        });
    }
  </script>

</body>

</html>