<?php

session_start();
// Example: Assume user logs in somewhere and $_SESSION['username'] is set

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHotelBooking - Find Your Perfect Stay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="home.css">
    <!-- Font Awesome for icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>


   <!-- Header -->
   <header class="bg-white shadow-md py-4 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2 text-white text-xl font-bold">
                <i class="fas fa-hotel text-white"></i>
                <span class="text-white">MyHotelBooking</span>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4 md:mt-0 flex flex-wrap justify-center md:justify-start space-x-4 text-white font-medium">
                <a href="/myhotelbooking.com/home/home.php" class="hover:text-gray-800">Home</a>
                <a href="/myhotelbooking.com/hotels/hotels.php" class="hover:text-gray-800">Hotels</a>
                <a href="#" class="hover:text-gray-800">Destinations</a>
                <a href="#" class="hover:text-gray-800">Deals</a>
                <a href="#" class="hover:text-gray-800">About</a>
            </nav>

            <!-- Auth Buttons -->
            <div class="mt-4 md:mt-0 flex items-center space-x-3">
                <?php if (isset($_SESSION['name'])): ?>
                    <span class="text-sm font-medium text-gray-600">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></span>
                    <a href="/myhotelbooking.com/Auth/logout.php" class="logout-btn flex items-center">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="/myhotelbooking.com/Auth/login.html" class="btn bg-indigo-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600 transition">Login</a>
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
   

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Your Perfect Stay</h1>
                <p>Book from over 10,000 hotels across Asia and Europe. Best price guarantee and eco-friendly options available.</p>

                <!-- Search Form -->
                <div class="search-form">
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <input type="text" id="destination" placeholder="Where are you going?">
                            </div>
                            <div class="form-group">
                                <label for="check-in">Check-in</label>
                                <input type="date" id="check-in">
                            </div>
                            <div class="form-group">
                                <label for="check-out">Check-out</label>
                                <input type="date" id="check-out">
                            </div>
                            <div class="form-group">
                                <label for="guests">Guests</label>
                                <select id="guests">
                                    <option value="1">1 Guest</option>
                                    <option value="2">2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5+">5+ Guests</option>
                                </select>
                            </div>
                            <button type="submit" class="search-btn">
                                <a href="hotel_list.html">Hotels</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Hotels -->
    <section class="featured">
        <div class="container">
            <div class="section-title">
                <h2>Featured Hotels</h2>
                <p>Top-rated accommodations from our partners</p>
            </div>

            <div class="hotel-grid">
                <!-- Hotel cards (repeat for each hotel) -->
                <div class="hotel-card">
                    <div class="hotel-img">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1950&q=80" alt="Marriott Hotel">
                        <div class="eco-badge">Eco Certified</div>
                    </div>
                    <div class="hotel-info">
                        <h3>Marriott Grand</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bangkok, Thailand</span>
                        </div>
                        <div class="hotel-meta">
                            <div class="rating">4.8 ★</div>
                            <div class="price">AED 120 <span>/ night</span></div>
                        </div>
                    </div>
                </div>

                <!-- More hotel cards as needed -->
            </div>
        </div>
    </section>

    <?php
    // Include the header
    include('../Component/footer.php');
    ?>
   </div>
</body>
</html>
