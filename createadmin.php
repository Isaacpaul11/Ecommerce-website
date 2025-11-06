<?php
// create_admin.php - run once, then delete
require_once 'db.php';

$username = 'admin';
$password_plain = 'admin123'; // change this after login!

$hash = password_hash($password_plain, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    echo "Admin created: username = {$username} , password = {$password_plain} <br>";
    echo "IMPORTANT: Delete create_admin.php now for security.";
} else {
    echo "Error (maybe already exists): " . $stmt->error;
}
$stmt->close();
?>
