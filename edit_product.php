<?php
include 'auth_check.php';
include 'db.php';


$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "uploads/";
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            unlink("uploads/" . $product['image']);
            $conn->query("UPDATE products SET name='$name', slug='$slug', description='$description', price='$price', image='$imageName' WHERE id=$id");
        }
    } else {
        $conn->query("UPDATE products SET name='$name', slug='$slug', description='$description', price='$price' WHERE id=$id");
    }

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
  <link rel="stylesheet" href="CSS/admin.css">
</head>
<body>
  <h2>Edit Product</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Product Image:</label>
    <img src="uploads/<?php echo $product['image']; ?>" width="100"><br>
    <input type="file" name="image">

    <label>Product Name:</label>
    <input type="text" name="name" value="<?php echo $product['name']; ?>" required>

    <label>Description:</label>
    <textarea name="description" required><?php echo $product['description']; ?></textarea>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>

    <button type="submit">Update Product</button>
  </form>

  <div style="text-align:center; margin-top:20px;">
    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
  </div>
</body>
</html>
