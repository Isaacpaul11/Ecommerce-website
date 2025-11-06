<?php
// Carnelian Ornaments Header Component
// Responsive single-line header with purple theme
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnelian Ornaments</title>
    <link rel="stylesheet" href="CSS/header.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"rel="stylesheet"/>
</head>

<body>
    <!-- Main Header Container -->
    <header class="main-header">
        <div class="header-container">

            <!-- Logo and Company Name Section -->
            <div class="logo-section">
                <a href="index.php" class="logo-link">
                    <img src="assest/1.png" alt="Carnelian Ornaments Logo" class="logo">
                    <!-- Company name -->
                    <span class="company-name">Carnelian Ornaments</span>
                </a>
            </div>



            <!-- Search Bar Section -->
            <div class="search-section">
                <form class="search-form" action="search.php" method="GET">
                    <input type="text" name="query" placeholder="Search ornaments..." class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Contact and Cart Section -->
            <div class="header-actions">
                <!-- Contact Number -->
                <div class="contact-info">
                    <i class="fas fa-phone contact-icon"></i>
                    <span class="contact-number">+91 96290 36015</span>
                </div>

                <!-- Cart Button -->
                <a href="cart.php" class="cart-btn">
                   <i class="ri-shopping-cart-fill"></i>
                    <span class="cart-text">Cart</span>
                    <span class="cart-count">0</span>
                </a>
            </div>

        </div>
    </header>

    <!-- Mobile Menu Toggle (hidden by default) -->
    <div class="mobile-menu-toggle">
        <button class="menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Page Content -->
    <!-- <main class="main-content">
        <h1>Welcome to Carnelian Ornaments</h1>
        <p>Your premium jewelry destination</p>
    </main> -->

    <!-- Basic JavaScript for mobile menu -->
    <script>
        // Simple mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.querySelector('.menu-btn');
            const header = document.querySelector('.main-header');

            if (menuBtn) {
                menuBtn.addEventListener('click', function() {
                    header.classList.toggle('mobile-open');
                });
            }
        });
    </script>
</body>

</html>