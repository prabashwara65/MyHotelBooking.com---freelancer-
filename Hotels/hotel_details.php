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
        <div class="hotel-banner mb-4 w-2/3 ">
            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo htmlspecialchars($row['hotel_name']); ?>" class="rounded-lg shadow-lg ">
        </div>

        <div class="w-1/3 bg-white p-6 rounded-2xl h-[400px] ">
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
            <p class="mt-4 text-lg font-medium">Rating: <?php echo $row['rating']; ?> ★</p>
            <p class="text-lg font-medium mt-1">Price: AED <?php echo $row['price']; ?> / night</p>
            <p class="text-sm font-extralight mt-3 text-gray-600"> <?php echo $row['description']; ?> </p>
        </div>
    </div>

    <div class="mb-6">
        

    <div class="mt-6">
    <h4 class="text-2xl font-semibold text-gray-800">Features</h4>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        <?php 
        $features = explode(',', $row['features']);

        // Map keywords to Font Awesome icons
        $iconMap = [
            'free high-speed wifi' => 'fa-wifi',
            'rooftop infinity pool' => 'fa-swimming-pool',
            '4 restaurants & bars' => 'fa-utensils',
            'eforea spa' => 'fa-spa',
            '24/7 fitness center' => 'fa-dumbbell',
            'concierge service' => 'fa-concierge-bell',
            'business center' => 'fa-business-time',
            'kids club' => 'fa-child'
        ];

        foreach ($features as $feature): 
            $trimmed = strtolower(trim($feature));
            $icon = $iconMap[$trimmed] ?? 'fa-check-circle'; // Default icon
        ?>
            <div class="flex gap-4 items-center bg-white p-4 rounded-lg shadow-md ">
                <i class="fas <?= $icon ?> text-black text-2xl mb-2"></i>
                <p class="text-black capitalize"><?= htmlspecialchars($trimmed) ?></p>
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
        <div class="w-full mt-6">
            <h4 class="text-2xl font-semibold text-gray-800 mb-4">Hotel Location on Map</h4>
            <!-- Map Section -->
            <div class="w-full h-80 rounded-lg overflow-hidden shadow-md">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.566487753955!2d100.55690231534712!3d13.74649060139961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29edcfb15ae2b%3A0xb3f399fbdb9ddf6c!2sSukhumvit%20Road%2C%20Khlong%20Toei%2C%20Bangkok%2C%20Thailand!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
                    class="w-full h-full border-0"
                    allowfullscreen="true"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
    </div>
</div>


    </div>
    
</div>

<?php
    // Include the footer
    include('../Component/footer.php');
    ?>
   </div>
</body>


</html>
