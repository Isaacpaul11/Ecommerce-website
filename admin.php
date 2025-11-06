<?php
include 'auth_check.php';  // 🔐 Protect this page
include 'db.php';


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

    $targetDir = "uploads/";
    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $sql = "INSERT INTO products (name, slug, description, price, image) 
                VALUES ('$name', '$slug', '$description', '$price', '$imageName')";
        if ($conn->query($sql) === TRUE) {
            $message = "✅ Product added successfully!";
        } else {
            $message = "❌ Error: " . $conn->error;
        }
    } else {
        $message = "❌ Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
  <h2>Add New Product</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <label>Product Image:</label>
    <input type="file" name="image" required>

    <label>Product Name:</label>
    <input type="text" name="name" required>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required>

    <button type="submit">Add Product</button>
  </form>

  <p style="text-align:center; color:green;"><?php echo $message; ?></p>

  <div style="text-align:center; margin-top:20px;">
    <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
  </div>
</body>
</html>
