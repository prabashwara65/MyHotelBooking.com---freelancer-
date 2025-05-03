<?php
session_start();

if (isset($_SESSION['success_message'])) {
    echo "<div class='text-green-600 font-semibold text-center py-2'>" . $_SESSION['success_message'] . "</div>";
    unset($_SESSION['success_message']);
}

include '../db.php';
include('../Component/header.php');

$sql = "SELECT * FROM bookings ORDER BY booking_date DESC";
$result = $conn->query($sql);
$defaultImage = 'https://via.placeholder.com/150?text=No+Image';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking Cards</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Hotel Booking Cards</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col">
                        <div class="flex flex-col sm:flex-row">
                            <div class="flex-1 p-4 space-y-2">
                                <h3 class="text-lg font-semibold text-gray-800">Customer: <?= htmlspecialchars($row['customer_name']) ?></h3>
                                <p class="text-sm text-gray-600"><strong>Booking ID:</strong> <?= $row['booking_id'] ?></p>
                                <p class="text-sm text-gray-600"><strong>Hotel ID:</strong> <?= $row['hotel_id'] ?></p>
                                <p class="text-sm text-gray-600"><strong>Email:</strong> <?= htmlspecialchars($row['customer_email']) ?></p>
                                <p class="text-sm text-gray-600">
                                    <strong>Room:</strong> <?= htmlspecialchars($row['roomType']) ?> |
                                    <?= $row['qtyRooms'] ?> room(s) for <?= $row['nights'] ?> night(s)
                                </p>
                                <p class="text-sm text-gray-600">
                                    <strong>Check-in:</strong> <?= $row['check_in_date'] ?><br>
                                    <strong>Check-out:</strong> <?= $row['check_out_date'] ?>
                                </p>
                                <p class="text-sm text-gray-600"><strong>Total:</strong> $<?= number_format($row['total'], 2) ?></p>
                                <hr class="my-2">
                                <p class="text-sm text-gray-600"><strong>Cardholder:</strong> <?= htmlspecialchars($row['cardholder_name']) ?></p>
                                <p class="text-sm text-gray-600"><strong>Billing Address:</strong> <?= htmlspecialchars($row['billing_address']) ?></p>
                                <p class="text-xs text-gray-500">Booked on <?= $row['booking_date'] ?></p>
                            </div>
                            <div class="sm:w-40 sm:h-auto flex items-center justify-center p-4">
                                <img src="<?= htmlspecialchars($row['hotel_image']) ?: $defaultImage ?>" alt="Hotel" class="rounded-md object-cover w-full h-40">
                            </div>
                        </div>
                        <div class="flex justify-between p-4">
                            <a href="view_booking.php?booking_id=<?= $row['booking_id'] ?>" class="text-white bg-blue-500 hover:bg-blue-600 rounded-full px-4 py-2 text-sm">View</a>
                            <form method="POST" action=" /myhotelbooking.com/booking/delete_booking.php" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                                <button type="submit" class="text-white bg-red-500 hover:bg-red-600 rounded-full px-4 py-2 text-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-3 text-center text-gray-500 text-lg">No bookings found.</div>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
