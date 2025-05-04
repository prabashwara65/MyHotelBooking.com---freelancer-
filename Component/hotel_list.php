<?php
// Include the database connection file
include '../db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<?php
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="max-w-7xl mx-auto px-4 ">';
    echo '<div class="grid grid-cols-1 sm:grid-cols-2  gap-6">';
    
    while ($row = $result->fetch_assoc()) {
        echo '<div class="bg-white rounded-lg shadow hover:shadow-xl transition p-4 relative">';
        
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

        echo '</div>'; 
        echo '</div>'; 
    }

    echo '</div>'; 
    echo '</div>';
} else {
    echo "<div class='max-w-4xl mx-auto py-8 text-center text-gray-600 text-lg'>No hotels found.</div>";
}
?>

</body>
</html>
