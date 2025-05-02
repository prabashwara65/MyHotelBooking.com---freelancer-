<?php
include '../db.php';

if (!isset($_GET['hotel_id']) || !isset($_GET['room'])) {
    echo "Hotel or Room type not selected.";
    exit;
}

$hotelId = intval($_GET['hotel_id']);
$roomType = trim($_GET['room']);

$sql = "SELECT * FROM hotels WHERE id = $hotelId";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Hotel not found.";
    exit;
}

$row = $result->fetch_assoc();

$roomTypes = explode(',', $row['room_types']);
$roomDetails = [];
foreach ($roomTypes as $room) {
    $roomDetails[trim($room)] = [
        'description' => 'A cozy and modern room with top-notch amenities for your comfort.',
        'features' => ['Free Wi-Fi', 'Air Conditioning', '24/7 Room Service', 'Flat-Screen TV', 'Mini Bar'],
        'price' => rand(150, 300) // AED
    ];
}

if (!array_key_exists($roomType, $roomDetails)) {
    echo "Room type not found.";
    exit;
}

$roomData = $roomDetails[$roomType];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book <?php echo htmlspecialchars($roomType); ?> - <?php echo htmlspecialchars($row['hotel_name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
</head>

<div class="bg-red-500">
<?php
// Include the header
include('../Component/header.php');
?>
</div>

<body class="bg-gradient-to-r from-blue-50 via-white to-purple-50 min-h-screen">
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const qtyInput = document.getElementById('roomQty');
        const price = <?php echo $roomData['price']; ?>;
        const taxRate = 0.05;
        const AED_TO_USD = 0.27;

        const hotelId = <?php echo json_encode($hotelId); ?>;
        const roomType = <?php echo json_encode($roomType); ?>;

        let totalPrice = 0;

        function updatePrice() {
            const qty = parseInt(qtyInput.value) || 1;
            const tax = qty * price * taxRate;
            totalPrice = qty * price + tax;
            const usd = totalPrice * AED_TO_USD;

            document.getElementById('taxAmount').textContent = tax.toFixed(2);
            document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
            document.getElementById('usdPrice').textContent = usd.toFixed(2);

            document.getElementById('bookingLink').href =
                `/myhotelbooking.com/checkout/checkout.php?hotel_id=${hotelId}&room=${encodeURIComponent(roomType)}&total=${totalPrice.toFixed(2)}`;
        }

        qtyInput.addEventListener('input', updatePrice);
        updatePrice();
    });
</script>

<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Hotel Header -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-800"><?php echo htmlspecialchars($row['hotel_name']); ?></h1>
        <p class="text-gray-500 text-lg mt-2">
            <i class="fas fa-map-marker-alt text-red-500 mr-1"></i>
            <?php echo htmlspecialchars($row['location']); ?>
        </p>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Room Image and Details -->
        <div class="w-full md:w-[70%]">
            <img src="/myhotelbooking.com/images/rooms/<?php echo strtolower(str_replace(' ', '_', $roomType)); ?>.jpg"
                 alt="<?php echo htmlspecialchars($roomType); ?>"
                 class="rounded-xl shadow-2xl w-full object-cover h-[400px]">
            <!-- Room Description -->
            <div class="bg-white shadow-lg rounded-xl mt-6 p-6">
                <h2 class="text-2xl font-semibold mb-4">
                    <i class="fas fa-bed text-indigo-500 mr-2"></i><?php echo htmlspecialchars($roomType); ?> Features
                </h2>
                <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($roomData['description'])); ?></p>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-gray-800">
                    <?php foreach ($roomData['features'] as $feature): ?>
                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i><?php echo htmlspecialchars($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Booking and Price Section -->
        <div class="w-full md:w-[30%] space-y-6">
            <!-- Price Calculator -->
            <div class="bg-white shadow-xl rounded-xl p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">
                    <i class="fas fa-calculator mr-2 text-blue-600"></i>Price Calculator
                </h3>
                <label for="roomQty" class="block mb-2 text-gray-700 font-medium">Number of Rooms:</label>
                <input type="number" id="roomQty" value="1" min="1"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 mb-4 focus:ring-2 focus:ring-blue-400">

                <div class="space-y-2 text-sm text-gray-600">
                    <p><strong>Price per Night:</strong> AED <?php echo number_format($roomData['price'], 2); ?></p>
                    <p><strong>Tax (5%):</strong> AED <span id="taxAmount">0.00</span></p>
                    <p><strong>Total Price:</strong> AED <span id="totalPrice">0.00</span></p>
                    <p><strong>Total in USD:</strong> $<span id="usdPrice">0.00</span> <small class="text-gray-400">(Approx)</small></p>
                </div>

                <a id="bookingLink"
   class="mt-5 block bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 px-4 rounded-lg font-semibold transition">
    <i class="fas fa-arrow-right mr-2"></i>Proceed to Book
</a>


            </div>

            <!-- Why Book With Us -->
            <div class="bg-white shadow-xl rounded-xl p-6">
                <h3 class="text-xl font-bold mb-4 text-gray-800">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>Why Book With Us?
                </h3>
                <ul class="space-y-2 text-gray-700">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Best Price Guarantee</li>
                    <li><i class="fas fa-lock text-blue-500 mr-2"></i>Secure & Easy Booking</li>
                    <li><i class="fas fa-eye-slash text-gray-600 mr-2"></i>No Hidden Charges</li>
                    <li><i class="fas fa-headset text-indigo-600 mr-2"></i>24/7 Customer Support</li>
                    <li><i class="fas fa-users text-pink-500 mr-2"></i>Trusted by Thousands</li>
                    <li><i class="fas fa-clock text-orange-500 mr-2"></i>Early Check-in & Late Check-out</li>
                </ul>
            </div>
        </div>
    </div>
</div>


</body>
</html>
