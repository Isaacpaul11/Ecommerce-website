function addToCart(slug) {
  fetch(`add_to_cart.php?slug=${slug}`)
    .then(res => res.text())
    .then(msg => {
      alert(msg); // Optional: show confirmation
      // Optionally redirect to cart page
      // window.location.href = 'cart.php';
    });
}
