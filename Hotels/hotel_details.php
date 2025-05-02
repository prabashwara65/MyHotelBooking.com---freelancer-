<?php
include '../db.php';

if (!isset($_GET['id'])) {
    echo "No hotel ID provided.";
    exit;
}

$hotelId = intval($_GET['id']);
$sql = "SELECT * FROM hotels WHERE id = $hotelId";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Hotel not found.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['hotel_name']); ?> - Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="hotel_details.css">

    <style>
        .hotel-banner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        .badge-custom {
            margin-right: 10px;
            font-size: 0.9rem;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="hotel-banner mb-3">
        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['hotel_name']); ?>">
    </div>

    <h2><?php echo htmlspecialchars($row['hotel_name']); ?></h2>
    <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($row['location']); ?></p>

    <?php if ($row['is_best_seller']): ?>
        <span class="badge badge-success badge-custom">Best Seller</span>
    <?php endif; ?>
    <?php if ($row['is_eco_certified']): ?>
        <span class="badge badge-info badge-custom">Eco Certified</span>
    <?php endif; ?>

    <div class="mt-3">
        <p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
        <p><strong>Rating:</strong> <?php echo $row['rating']; ?> ★</p>
        <p><strong>Price:</strong> AED <?php echo $row['price']; ?> / night</p>

        <!-- Features Section -->
        <h4 class="mt-4">Features</h4>
        <div class="row">
            <?php 
            $features = explode(',', $row['features']);
            foreach ($features as $feature): 
            ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <?php echo trim($feature); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Room Types Section -->
        <h4 class="mt-4">Available Room Types</h4>
        <div class="row">
            <?php 
            $roomTypes = explode(',', $row['room_types']); // Room types as a comma-separated list
            foreach ($roomTypes as $index => $room): 
                $roomImage = "/myhotelbooking.com/images/rooms/" . strtolower(str_replace(' ', '_', trim($room))) . ".jpg"; // Assuming the image is stored as room_name.jpg
            ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="<?php echo $roomImage; ?>" alt="<?php echo trim($room); ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo trim($room); ?></h5>

                            <a href="book_room.php?room=<?php echo urlencode(trim($room)); ?>" class="btn btn-primary mt-3">Book Now</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <a href="hotel_list.php" class="btn btn-secondary mt-3">← Back to List</a>
</div>

</body>
</html>
