<?php
include "db.php";

// Old username (the one currently in DB)
$oldUsername = "admin";

// New credentials
$newUsername = "joel";
$newPassword = "1110joel";

// Hash the passwordc 
$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

// Update username & password
$sql = "UPDATE admins SET username='$newUsername', password='$hashedPassword' WHERE username='$oldUsername'";

if ($conn->query($sql) === TRUE) {
    echo "✅ Admin updated successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
