<?php
session_start();
include '../db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MyHotelBooking - Find Your Perfect Stay</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="home.css" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
</head>
<body class="bg-gray-50 text-gray-800">

<?php include('../Component/header.php'); ?>

<!-- Hero Section -->
<section class="h-[70vh] bg-[url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80')] bg-cover bg-center flex items-center text-white text-center relative">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/50"></div>

  <!-- Content -->
  <div class="relative w-full px-4">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-4xl md:text-5xl font-bold mt-40 mb-4">Discover Your Perfect Stay</h1>
      <p class="text-lg md:text-xl mb-8">Book from over 10,000 hotels across Asia and Europe. Best price guarantee and eco-friendly options available.</p>

      <!-- Search Form -->
      <form class="grid mt-37 h-[200px] md:grid-cols-5 gap-4 bg-white shadow-xl p-6 rounded-lg text-gray-800 ">
        <div class="flex flex-col ">
          <label for="destination" class="font-semibold mb-1">Destination</label>
          <input type="text" id="destination" placeholder="Where are you going?" class="p-2 rounded-lg border border-gray-300" />
        </div>
        <div class="flex flex-col">
          <label for="check-in" class="font-semibold mb-1">Check-in</label>
          <input type="date" id="check-in" class="p-2 rounded border border-gray-300" />
        </div>
        <div class="flex flex-col">
          <label for="check-out" class="font-semibold mb-1">Check-out</label>
          <input type="date" id="check-out" class="p-2 rounded border border-gray-300" />
        </div>
        <div class="flex flex-col">
          <label for="guests" class="font-semibold mb-1">Guests</label>
          <select id="guests" class="p-2 rounded border border-gray-300">
            <option value="1">1 Guest</option>
            <option value="2">2 Guests</option>
            <option value="3">3 Guests</option>
            <option value="4">4 Guests</option>
            <option value="5+">5+ Guests</option>
          </select>
        </div>
        <div class="flex items-end">
          <a href="/myhotelbooking.com/hotels/hotels.php" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-center">
            Hotels
          </a>
        </div>
      </form>
    </div>
  </div>
</section>


<!-- Featured Hotels -->
<section class="py-16 bg-gray-100">
  <div class="container mx-auto px-6">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold">Featured Hotels</h2>
      <p class="text-gray-600 mt-2">Top-rated accommodations from our partners</p>
    </div>

     <!-- Hotel Listing -->
     <?php
        $sql = "SELECT * FROM hotels LIMIT 3"; // Only fetch 3 hotels
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="max-w-7xl mx-auto px-4 ">';
            echo '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">';
            
            while ($row = $result->fetch_assoc()) {
                echo '<div class="bg-white rounded-lg shadow hover:shadow-xl transition p-4 relative">';
                
                // Image and badges
                echo '<div class="relative">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['hotel_name'] . '" class="rounded-md h-48 w-full object-cover">';
                if ($row['is_best_seller']) {
                    echo '<span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded">Best Seller</span>';
                }
                if ($row['is_eco_certified']) {
                    echo '<span class="absolute top-2 right-2 bg-green-600 text-white text-xs font-semibold px-2 py-1 rounded">Eco Certified</span>';
                }
                echo '</div>';

                // Info section
                echo '<div class="mt-4">';
                echo '<h3 class="text-lg font-semibold text-gray-800 hover:text-blue-600 transition"><a href="' . $row['link'] . '">' . $row['hotel_name'] . '</a></h3>';
                
                echo '<div class="text-sm text-gray-500 flex items-center mt-1"><i class="fas fa-map-marker-alt mr-1"></i>' . $row['location'] . '</div>';
                
                echo '<p class="text-sm text-gray-600 mt-2 line-clamp-3">' . $row['description'] . '</p>';
                
                echo '<div class="flex justify-between items-center mt-4">';
                echo '<span class="text-yellow-600 font-semibold text-sm">' . $row['rating'] . ' ★</span>';
                echo '<span class="text-gray-800 font-bold">AED ' . $row['price'] . ' <span class="text-sm font-normal text-gray-500">/ night</span></span>';
                echo '</div>';

                echo '<a href="/myhotelbooking.com/hotels/hotel_details.php?id=' . $row['id'] . '" class="mt-4 inline-block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded w-full text-sm font-medium">View Hotel</a>';

                echo '</div>'; // Close .mt-4
                echo '</div>'; // Close .hotel-card
            }

            echo '</div>'; // Close grid
            echo '</div>'; // Close container
        } else {
            echo "<div class='max-w-4xl mx-auto py-8 text-center text-gray-600 text-lg'>No hotels found.</div>";
        }
        ?>
  </div>
</section>

<?php include('../Component/footer.php'); ?>
</body>
</html>
