<?php
// This will include the session start if it's not already started in other files
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Header -->
<header>
    <div class="container">
        <nav>
            <div class="logo">
                <i class="fas fa-hotel"></i>
                <span>MyHotelBooking</span>
            </div>
            <div class="nav-links">
                <a href="home.php">Home</a>
                <a href="/myhotelbooking.com/hotel_list/hotel_list.php">Hotels</a>
                <a href="#">Destinations</a>
                <a href="#">Deals</a>
                <a href="#">About</a>
            </div>
            <div class="auth-buttons">
                <?php if (isset($_SESSION['name'])): ?>
                    <span class="welcome-msg">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></span>
                    <a href="/myhotelbooking.com/Auth/logout.php" class="btn">Logout</a>
                <?php else: ?>
                    <a href="/myhotelbooking.com/Auth/login.html" class="btn">Login</a>
                    <a href="/myhotelbooking.com/Auth/register.php" class="btn">Sign Up</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
