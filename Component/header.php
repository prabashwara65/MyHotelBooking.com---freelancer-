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
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="bg-white shadow-md py-4 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2 text-indigo-700 text-xl font-bold">
                <i class="fas fa-hotel text-indigo-500"></i>
                <span>MyHotelBooking</span>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4 md:mt-0 flex flex-wrap justify-center md:justify-start space-x-4 text-black font-medium">
                <a href="/myhotelbooking.com/home/home.php" class="hover:text-indigo-600">Home</a>
                <a href="/myhotelbooking.com/hotels/hotels.php" class="hover:text-indigo-600">Hotels</a>
                <a href="#" class="hover:text-indigo-600">Destinations</a>
                <a href="#" class="hover:text-indigo-600">Deals</a>
                <a href="#" class="hover:text-indigo-600">About</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="mt-4 md:mt-0 flex items-center space-x-3">
                <?php if (isset($_SESSION['name'])): ?>
                    <span class="text-sm font-medium text-gray-600">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></span>
                    <a href="/myhotelbooking.com/Auth/logout.php" class="logout-btn flex items-center">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="/myhotelbooking.com/Auth/login.php" class="btn bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600 transition">Login</a>
                    <a href="/myhotelbooking.com/Auth/register.php" class="btn bg-gray-200 text-gray-800 px-4 py-2 rounded-full hover:bg-gray-300 transition">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Add logout button style -->
    <style>
    .logout-btn {
        padding: 10px 20px;
        font-weight: 600;
        background-color: #ff4747;
        color: #fff;
        border-radius: 9999px;
        transition: all 0.3s ease;
    }
    .logout-btn:hover {
        background-color: #e94343;
    }
    </style>
</body>
</html>
