<?php
session_start();

// Get the product slug from the URL
$slug = $_GET['slug'] ?? null;

// Validate the slug
if ($slug) {
  // Initialize the cart session if it doesn't exist
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  // Add the slug only if it's not already in the cart
  if (!in_array($slug, $_SESSION['cart'])) {
    $_SESSION['cart'][] = $slug;
    echo "✅ Product added to cart!";
  } else {
    echo "ℹ️ Product already in cart.";
  }
} else {
  echo "❌ No product selected.";
}
