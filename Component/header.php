<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHotelBooking</title>
    <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="header.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <i class="fas fa-hotel"></i>
                    <span>MyHotelBooking</span>
                </div>
                <div class="nav-links">
                    <a href="/myhotelbooking.com/home/home.php">Home</a>
                    <a href="/myhotelbooking.com/hotels/hotels.php">Hotels</a>
                    <a href="#">Destinations</a>
                    <a href="#">Deals</a>
                    <a href="#">About</a>
                </div>
                <div class="auth-buttons">
                    <?php if (isset($_SESSION['name'])): ?>
                        <span class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></span>
                        <a href="/myhotelbooking.com/Auth/logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    <?php else: ?>
                        <a href="/myhotelbooking.com/Auth/login.html" class="btn">Login</a>
                        <a href="/myhotelbooking.com/Auth/register.php" class="btn">Sign Up</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>
</body>
</html>
