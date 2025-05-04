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
   
<?php
    // Include the header
    include('../Component/header.php');
    ?>

    <!-- Main Content -->
    <main class="container">
       
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
        <!-- Pagination -->
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