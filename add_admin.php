<?php
include "db.php";

$username = "admin";
$password = "admin123";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Update password for existing admin
$sql = "UPDATE admins SET password='$hashedPassword' WHERE username='$username'";
if ($conn->query($sql) === TRUE) {
    echo "✅ Admin password updated successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}
$conn->close();
?>
