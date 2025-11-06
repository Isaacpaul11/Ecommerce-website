<?php
// Include database connection
require_once 'db.php';

// Fetch all products
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  
  <!-- Link CSS -->
  <link rel="stylesheet" href="CSS/admin.css">
  
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<h2><i class="fas fa-chart-line"></i> Admin Dashboard</h2>

<!-- Buttons -->
<div style="text-align:center; margin:20px;">
  <a href="admin.php" class="btn btn-primary">
    <i class="fas fa-plus-circle"></i> Add New Product
  </a>
  <a href="logout.php" class="btn btn-danger">
    <i class="fas fa-sign-out-alt"></i> Logout
  </a>
</div>

<!-- Product Table -->
<table>
  <thead>
    <tr>
      <th>Image</th>
      <th>Product Name</th>
      <th>Description</th>
      <th>Price</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td data-label="Image">
            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Product">
          </td>
          <td data-label="Name">
            <strong style="white-space:normal; display:block;">
              <?php echo htmlspecialchars($row['name']); ?>
            </strong>
          </td>
          <td data-label="Description">
            <?php echo htmlspecialchars($row['description']); ?>
          </td>
          <td data-label="Price">
            $<?php echo number_format($row['price'], 2); ?>
          </td>
          <td data-label="Actions">
            <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">
              <i class="fas fa-edit"></i> Edit
            </a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this product?')">
              <i class="fas fa-trash"></i> Delete
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="5" style="text-align:center;">No products found!</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
