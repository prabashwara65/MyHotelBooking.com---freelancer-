<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels | MyHotelBooking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="hotels.css">
    <style>
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   
   <!-- Header -->
   <header class="bg-white shadow-md py-4 px-6">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2 text-white text-xl font-bold">
                <i class="fas fa-hotel text-blue-500"></i>
                <span class="text-blue-500">MyHotelBooking</span>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-4 md:mt-0 flex flex-wrap justify-center md:justify-start space-x-4 text-black font-medium">
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
                    <a href="/myhotelbooking.com/Auth/login.html" class="btn bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-indigo-600 transition">Login</a>
                    <a href="/myhotelbooking.com/Auth/register.php" class="btn bg-gray-200 text-gray-800 px-4 py-2 rounded-full hover:bg-gray-300 transition">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Filters Section -->
        <!-- <section class="filters">
            <div class="filter-grid">
                <div class="filter-group">
                    <h3>Price Range</h3>
                    <div class="filter-options">
                        <button class="filter-btn">AED 0 - AED 100</button>
                        <button class="filter-btn active">AED 100 - AED 200</button>
                        <button class="filter-btn">AED 200 - AED 300</button>
                        <button class="filter-btn">AED 300+</button>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Rating</h3>
                    <div class="filter-options">
                        <button class="filter-btn">3★+</button>
                        <button class="filter-btn active">4★+</button>
                        <button class="filter-btn">5★</button>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Amenities</h3>
                    <div class="filter-options">
                        <button class="filter-btn"><i class="fas fa-wifi"></i> WiFi</button>
                        <button class="filter-btn"><i class="fas fa-swimming-pool"></i> Pool</button>
                        <button class="filter-btn"><i class="fas fa-utensils"></i> Restaurant</button>
                        <button class="filter-btn"><i class="fas fa-spa"></i> Spa</button>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h3>Eco-Friendly</h3>
                    <div class="filter-options">
                        <button class="filter-btn"><i class="fas fa-leaf"></i> Sustainable</button>
                        <button class="reset-btn">Reset All</button>
                    </div>
                </div>
            </div>
        </section> -->
        <?php
                // Include the hotel list
                include('../Component/filter_section.php');
            ?>


       <div class="flex flex-row">

         <!-- Hotel Listing -->
        <div class="w-2/3">
            <?php
                // Include the hotel list
                include('../Component/hotel_list.php');
            ?>
        </div>

            <!-- Map Section -->
            <div class="map-container w-1/3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.566487753955!2d100.55690231534712!3d13.74649060139961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29edcfb15ae2b%3A0xb3f399fbdb9ddf6c!2sSukhumvit%20Road%2C%20Khlong%20Toei%2C%20Bangkok%2C%20Thailand!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        

       </div>
        Pagination
        <div class="pagination">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">4</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
    </main>

    
    <?php
    // Include the header
    include('../Component/footer.php');
    ?>

    <script>
        // Simple filter functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
                // In a real app, you would filter results here
            });
        });
        
        document.querySelector('.reset-btn').addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
        });
    </script>
</body>
</html>