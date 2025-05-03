<?php

session_start();
include '../db.php';

$hotels = [];
$sql = "SELECT * FROM hotels ORDER BY hotel_name ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hotels[] = $row;
    }
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Not logged in
    header("Location: /myhotelbooking.com/login/login.php");
    exit;
}

// Only allow 'admin' role
if ($_SESSION["role"] !== 'admin') {
    echo "Access Denied. You do not have permission to access this page.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body class="flex min-h-screen min-h-0 font-sans bg-gray-100">

<!-- Sidebar -->
<aside class="w-64 bg-gray-900 text-white p-6 flex flex-col">
    <div class="text-2xl font-bold mb-10 text-center">
        <i class="fas fa-hotel mr-2"></i>My Hotel Booking
    </div>
    <ul class="space-y-4">
        <li><a href="#" class="hover:text-yellow-400 text-lg">Dashboard</a></li>
        <li><a href="#" class="hover:text-yellow-400 text-lg">Analytics</a></li>
        <li><a href="#" class="hover:text-yellow-400 text-lg">Settings</a></li>
        <li><a href="#" class="hover:text-yellow-400 text-lg">Users</a></li>
    </ul>
</aside>

<!-- Main Content -->
<main class="flex-1 p-6 overflow-y-hidden">
    <!-- Top Bar -->
    <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow mb-6">

            <!-- Display Success Message -->
            <?php if (isset($_SESSION['success_message'])): ?>
            <div class="p-4 mb-4 text-white bg-green-500 rounded-lg">
                <?= $_SESSION['success_message'] ?>
            </div>
            <?php unset($_SESSION['success_message']); // Remove the message after displaying it ?>
        <?php endif; ?>

        <h1 class="text-2xl font-bold">Dashboard</h1>
        <div class="flex items-center">
            <?php if (isset($_SESSION['name'])): ?>
                <span class="text-gray-600 font-medium mr-4">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></span>
                <a href="/myhotelbooking.com/Auth/logout.php" class="bg-red-500 text-white font-semibold px-4 py-2 rounded-full hover:bg-red-600 shadow inline-flex items-center">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            <?php else: ?>
                <a href="/myhotelbooking.com/Auth/login.html" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
                <a href="/myhotelbooking.com/Auth/register.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>

   <!-- Hotel Cards Container with Scroll -->
<div class="max-h-[600px] overflow-y-auto pr-2">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 w-full">
        <?php foreach ($hotels as $hotel): ?>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <img src="<?= htmlspecialchars($hotel['image_url'] ?: 'https://via.placeholder.com/300x150?text=No+Image') ?>" alt="Hotel Image" class="w-full h-40 object-cover">
            <div class="p-4">
                <h3 class="text-xl font-bold text-gray-800 mb-1"><?= htmlspecialchars($hotel['hotel_name']) ?></h3>
                <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($hotel['location']) ?></p>
                <p class="text-sm text-gray-700"><?= htmlspecialchars($hotel['description']) ?></p>
                <div class="mt-4 text-right">
                    <a href="/myhotelbooking.com/hotels/edit_hotel.php?id=<?= $hotel['id'] ?>" class="inline-block bg-blue-500 text-white text-sm px-4 py-2 rounded hover:bg-blue-600">Edit Hotel</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</main>

</body>
</html>
