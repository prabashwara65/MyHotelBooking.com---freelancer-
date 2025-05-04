<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['success_message'])) {
    echo "<div class='text-green-600 font-semibold text-center py-2'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']);
}

include '../db.php';
include('../Component/header.php');

if (!isset($_SESSION['email'])) {
    echo "<div class='text-red-600 font-semibold text-center py-2'>Please login.</div>";
    exit;
}

$user_email = $_SESSION['email'];
$sql = "SELECT * FROM bookings WHERE customer_email = '$user_email' ORDER BY booking_date DESC";
$result = $conn->query($sql);
$defaultImage = 'https://via.placeholder.com/150?text=No+Image';

$featureIcons = [
    'free high-speed wifi' => 'fa-wifi',
    'rooftop infinity pool' => 'fa-swimming-pool',
    '4 restaurants & bars' => 'fa-utensils',
    'eforea spa' => 'fa-spa',
    '24/7 fitness center' => 'fa-dumbbell',
    'concierge service' => 'fa-concierge-bell',
    'business center' => 'fa-business-time',
    'kids club' => 'fa-child'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bookings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto px-4 py-10">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Your Hotel Bookings</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                $hotel_id = $row['hotel_id'];
                $hotel_sql = "SELECT image_url FROM hotels WHERE id = $hotel_id";
                $hotel_result = $conn->query($hotel_sql);
                $hotel_image = $defaultImage;

                if ($hotel_result->num_rows > 0) {
                    $hotel_row = $hotel_result->fetch_assoc();
                    $hotel_image = $hotel_row['image_url'] ?: $defaultImage;
                }

                $features = [];
                if (!empty($row['features'])) {
                    $raw = $row['features'];
                    $decoded = json_decode($raw, true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $features = $decoded;
                    } else {
                        $features = explode(',', $raw);
                    }
                }
                ?>

            <div class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col h-full">
                <!-- Image and main content -->
                <div class="flex flex-col sm:flex-row flex-grow">
                    <!-- Hotel Image -->
                    <div class="sm:w-40 p-4">
                        <img src="<?= htmlspecialchars($hotel_image) ?>" alt="Hotel Image"
                            class="rounded-md object-cover w-full h-40">
                            </div>

                            <!-- Booking Details -->
                            <div class="flex-1 p-4 space-y-2">
                                <h3 class="text-lg font-semibold text-gray-800">Customer: <?= htmlspecialchars($row['customer_name']) ?></h3>
                                <p class="text-sm text-gray-600"><strong>Booking ID:</strong> <?= $row['booking_id'] ?></p>
                                <p class="text-sm text-gray-600"><strong>Hotel ID:</strong> <?= $row['hotel_id'] ?></p>
                                <p class="text-sm text-gray-600"><strong>Email:</strong> <?= htmlspecialchars($row['customer_email']) ?></p>
                                <p class="text-sm text-gray-600"><strong>Room:</strong> <?= htmlspecialchars($row['roomType']) ?></p>
                                <p class="text-sm text-gray-600"><?= $row['qtyRooms'] ?> room(s) for <?= $row['nights'] ?> night(s)</p>
                                <p class="text-sm text-gray-600"><strong>Check-in:</strong> <?= $row['check_in_date'] ?></p>
                                <p class="text-sm text-gray-600"><strong>Check-out:</strong> <?= $row['check_out_date'] ?></p>
                                <p class="text-sm text-gray-600"><strong>Total:</strong> $<?= number_format($row['total'], 2) ?></p>
                                <hr class="my-2">
                                <p class="text-sm text-gray-600"><strong>Cardholder:</strong> <?= htmlspecialchars($row['cardholder_name']) ?></p>
                                <p class="text-sm text-gray-600"><strong>Billing Address:</strong> <?= htmlspecialchars($row['billing_address']) ?></p>
                                <p class="text-xs text-gray-500">Booked on <?= $row['booking_date'] ?></p>
                            </div>
                        </div>

                        <!-- Features Section -->
                        <div class="features px-4 py-2 flex flex-wrap gap-2 border-t">
                            <?php
                            foreach ($features as $feature):
                                $feature = strtolower(trim($feature));
                                $iconClass = $featureIcons[$feature] ?? 'fa-check-circle';
                            ?>
                                <span class="inline-flex items-center bg-gray-100 text-gray-700 text-xs font-medium px-2 py-1 rounded-full">
                                    <i class="fas <?= $iconClass ?> mr-1"></i> <?= htmlspecialchars($feature) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>

                <!-- Bottom Buttons -->
                <div class="flex justify-center items-center p-4 border-t mt-auto">
                    <!--  -->

                    <form method="POST" action="/myhotelbooking.com/booking/delete_booking.php"
                        onsubmit="return confirm('Are you sure you want to delete this booking?');">
                        <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                        <button type="submit"
                                class="text-white bg-red-500 hover:bg-red-600 rounded-full px-4 py-2 text-sm">
                            Cancel Booking
                        </button>
                    </form>
                </div>
            </div>

            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-3 text-center text-gray-500 text-lg">You don't have any bookings.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
