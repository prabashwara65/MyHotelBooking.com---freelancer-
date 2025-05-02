<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels | MyHotelBooking</title>
    <link rel="stylesheet" href="hotels.css">
    <style>
        
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php
    // Include the header
    include('../Component/header.php');
    ?>

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

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>MyHotelBooking</h3>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="careers.html">Careers</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="press.html">Press</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="faq.html">FAQs</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                        <li><a href="privacy.html">Privacy Policy</a></li>
                        <li><a href="terms.html">Terms of Service</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Destinations</h3>
                    <ul>
                        <li><a href="destinations.html#thailand">Thailand</a></li>
                        <li><a href="destinations.html#france">France</a></li>
                        <li><a href="destinations.html#japan">Japan</a></li>
                        <li><a href="destinations.html#italy">Italy</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Business</h3>
                    <ul>
                        <li><a href="partners.html">Hotel Partners</a></li>
                        <li><a href="affiliate.html">Affiliate Program</a></li>
                        <li><a href="developers.html">Developer API</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2023 MyHotelBooking. All rights reserved.</p>
            </div>
        </div>
    </footer>

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