<?php
session_start();
include 'db.php';

$cartSlugs = $_SESSION['cart'] ?? [];

$cartItems = [];

if (!empty($cartSlugs)) {
    $placeholders = implode(',', array_fill(0, count($cartSlugs), '?'));
    $stmt = $conn->prepare("SELECT name, price, image, slug FROM products WHERE slug IN ($placeholders)");
    $stmt->bind_param(str_repeat('s', count($cartSlugs)), ...$cartSlugs);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="CSS/cart.css">
</head>

<body>
    <section class="cart-section">
        <h2>Your Cart — <span>Ready to Wrap Some Joy?</span></h2>

        <?php if (!empty($cartItems)): ?>
            <div class="cart-grid">
                <?php foreach ($cartItems as $index => $item): ?>
                    <div class="cart-card" data-index="<?php echo $index; ?>" data-price="<?php echo $item['price']; ?>">
                        <button class="remove-btn" onclick="removeItem(this)">×</button>
                        <img src="uploads/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        <div class="cart-details">
                            <h3><?php echo $item['name']; ?></h3>
                            <p class="item-price">₹<?php echo number_format($item['price']); ?></p>

                            <div class="quantity-control">
                                <button class="qty-btn minus">−</button>
                                <input type="text" class="qty-input" value="1" readonly>
                                <button class="qty-btn plus">+</button>
                            </div>

                            <label>
                                <input type="checkbox" class="gift-wrap" data-price="50">
                                Add ₹50 to turn your order into a heartfelt gift 🎁
                            </label>

                            <textarea class="gift-message" placeholder="Write your gift message here..."></textarea>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="cart-actions">
                <button onclick="window.location.href='index.php'" class="btn continue">← Continue Shopping</button>
                <button onclick="checkout()" class="btn checkout">Checkout</button>
            </div>

            <p class="total">Total: ₹<span id="totalPrice">0</span></p>
        <?php else: ?>
            <p class="empty-cart">Your cart is empty. Go find something beautiful!</p>
            <div class="cart-actions">
                <button onclick="window.location.href='index.php'" class="btn continue">← Continue Shopping</button>
            </div>
        <?php endif; ?>
    </section>

    <script src="JS/cart.js"></script>
</body>

</html>