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
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="hotel_list.css">
    <!-- Optional: Include Bootstrap CSS for additional styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Include FontAwesome for icons (like stars) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php
// Assuming you have a valid database connection stored in $conn
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container mt-4">';
    echo '<div class="hotel-grid">';
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="hotel-card">';
        echo '<div class="hotel-img">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['hotel_name'] . '">';
        if ($row['is_best_seller']) {
            echo '<div class="hotel-badge">Best Seller</div>';
        }
        if ($row['is_eco_certified']) {
            echo '<div class="eco-badge">Eco Certified</div>';
        }
        echo '</div>';
        echo '<div class="hotel-info">';
        echo '<h3><a href="' . $row['link'] . '">' . $row['hotel_name'] . '</a></h3>';
        echo '<div class="hotel-location">';
        echo '<i class="fas fa-map-marker-alt"></i>';
        echo '<span>' . $row['location'] . '</span>';
        echo '</div>';
        echo '<div class="hotel-description">' . $row['description'] . '</div>';
        echo '<div class="hotel-meta">';
        echo '<div class="rating">' . $row['rating'] . ' ★</div>';
        echo '<div class="price">AED ' . $row['price'] . ' <span>/ night</span></div>';
        echo '</div>';
        echo '<a href="/myhotelbooking.com/hotels/hotel_details.php?id=' . $row['id'] . '" class="btn btn-primary mt-2">View Hotel</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>'; // close .hotel-grid
    echo '</div>'; // close .container
} else {
    echo "<div class='container mt-4'><p>No hotels found.</p></div>";
}
?>
