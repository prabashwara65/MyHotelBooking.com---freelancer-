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
<?php
    // Include the header
    include('../Component/header.php');
    ?>
<body class="bg-gray-100 text-gray-800 p-4">

<div class="container mx-auto mt-6 px-4 ">
    <div class="flex justify-between gap-5">
        <div class="hotel-banner mb-6 w-2/3 ">
            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['hotel_name']); ?>" class="rounded-lg shadow-lg">
        </div>

        <div class="w-1/3 bg-white p-8 rounded-2xl h-[400px]">
        <h2 class="text-3xl font-semibold text-gray-900"><?php echo htmlspecialchars($row['hotel_name']); ?></h2>
            <p class="text-lg text-gray-600 mt-2"><i class="fas fa-map-marker-alt text-red-500 mr-2"></i><?php echo htmlspecialchars($row['location']); ?></p>

            <div class="mt-3">
                <?php if ($row['is_best_seller']): ?>
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Best Seller</span>
                <?php endif; ?>
                <?php if ($row['is_eco_certified']): ?>
                    <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Eco Certified</span>
                <?php endif; ?>
            </div>
            <p class="mt-4 text-xl font-medium">Rating: <?php echo $row['rating']; ?> ★</p>
            <p class="text-xl font-medium mt-2">Price: AED <?php echo $row['price']; ?> / night</p>
            <p class="text-xl font-extralight mt-4 text-gray-600"> <?php echo $row['description']; ?> / night</p>
        </div>
    </div>

    <div class="mb-6">
        

        <div class="mt-6">
            <h4 class="text-2xl font-semibold text-gray-800">Features</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <?php 
                $features = explode(',', $row['features']);
                foreach ($features as $feature): 
                ?>
                    <div class="bg-white p-4 rounded-lg shadow-md text-center">
                        <i class="fas fa-check-circle text-green-500 text-2xl mb-2"></i>
                        <p class="text-gray-700"><?php echo trim($feature); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-6">
            <h4 class="text-2xl font-semibold text-gray-800">Available Room Types</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <?php 
                $roomTypes = explode(',', $row['room_types']);
                foreach ($roomTypes as $index => $room): 
                    $roomImage = "/myhotelbooking.com/images/rooms/" . strtolower(str_replace(' ', '_', trim($room))) . ".jpg";
                ?>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <img src="<?php echo $roomImage; ?>" alt="<?php echo trim($room); ?>" class="rounded-lg w-full h-48 object-cover mb-4">
                        <h5 class="text-xl font-semibold text-gray-800"><?php echo trim($room); ?></h5>
                        <a href="/myhotelbooking.com/rooms/book_room.php?hotel_id=<?php echo $hotelId; ?>&room=<?php echo urlencode(trim($room)); ?>" class="mt-3 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg text-center hover:bg-blue-600 transition duration-300">Book Now</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

</body>
</html>
