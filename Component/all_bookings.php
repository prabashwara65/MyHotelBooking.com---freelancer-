<?php
session_start();
include '../db.php'; 


$bookings = [];

$sql = "SELECT * FROM bookings  ORDER BY booking_date DESC";
$result = $conn->query($sql);

$result = $conn->query($sql);  
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;  
    }
} else {
    $bookings = [];  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Bookings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow p-6">
     
        <h1 class="text-2xl font-bold mb-6">All Hotel Bookings</h1>
        
        <!-- Table displaying the bookings -->
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Booking ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hotel ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check-in</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Check-out</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (count($bookings) > 0): ?>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $booking['booking_id'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($booking['customer_name']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($booking['hotel_id']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= date("F j, Y", strtotime($booking['check_in_date'])) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= date("F j, Y", strtotime($booking['check_out_date'])) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date("F j, Y", strtotime($booking['booking_date'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
