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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="hotel_details.css">
    <style>
        .hotel-banner img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-book-now {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            color: white;
        }
        .btn-book-now:hover {
            background: linear-gradient(to right, #feb47b, #ff7e5f);
        }
        .feature-card {
            transition: transform 0.3s ease-in-out;
        }
        .feature-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-white">

<div class="container mx-auto mt-10 px-4">
    <div class="hotel-banner mb-8">
        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['hotel_name']); ?>" class="rounded-lg shadow-xl">
    </div>

    <div class="text-center mb-8">
        <h2 class="text-4xl font-extrabold text-white"><?php echo htmlspecialchars($row['hotel_name']); ?></h2>
        <p class="text-lg mt-2"><i class="fas fa-map-marker-alt text-red-300 mr-2"></i><?php echo htmlspecialchars($row['location']); ?></p>

        <div class="mt-4">
            <?php if ($row['is_best_seller']): ?>
                <span class="inline-block bg-green-600 text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg">Best Seller</span>
            <?php endif; ?>
            <?php if ($row['is_eco_certified']): ?>
                <span class="inline-block bg-blue-500 text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg">Eco Certified</span>
            <?php endif; ?>
        </div>

        <p class="mt-4 text-2xl font-semibold">Rating: <?php echo $row['rating']; ?> ★</p>
        <p class="text-xl font-medium mt-2">Price: AED <?php echo $row['price']; ?> / night</p>
    </div>

    <!-- Features Section -->
    <div class="mt-10">
        <h3 class="text-3xl text-center font-semibold mb-6">Features</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            $features = explode(',', $row['features']);
            foreach ($features as $feature): 
            ?>
                <div class="feature-card bg-white p-6 rounded-lg shadow-xl hover:scale-105 transition-all">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                    </div>
                    <p class="text-gray-700 text-xl font-medium text-center"><?php echo trim($feature); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Room Types Section -->
    <div class="mt-10">
        <h3 class="text-3xl text-center font-semibold mb-6">Available Room Types</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            $roomTypes = explode(',', $row['room_types']);
            foreach ($roomTypes as $index => $room): 
                $roomImage = "/myhotelbooking.com/images/rooms/" . strtolower(str_replace(' ', '_', trim($room))) . ".jpg";
            ?>
                <div class="card bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <img src="<?php echo $roomImage; ?>" alt="<?php echo trim($room); ?>" class="rounded-lg w-full h-48 object-cover mb-4">
                    <h5 class="text-2xl font-semibold text-gray-800"><?php echo trim($room); ?></h5>
                    <a href="/myhotelbooking.com/rooms/book_room.php?hotel_id=<?php echo $hotelId; ?>&room=<?php echo urlencode(trim($room)); ?>" class="btn-book-now mt-4 px-6 py-2 rounded-lg text-center hover:bg-gradient-to-l transition duration-300">Book Now</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="text-center mt-10">
        <a href="hotel_list.php" class="bg-gray-800 text-white px-6 py-3 rounded-full text-lg hover:bg-gray-700 transition duration-300">← Back to List</a>
    </div>
</div>

</body>
</html>
