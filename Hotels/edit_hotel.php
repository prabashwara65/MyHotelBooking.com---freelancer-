<?php
// Include the database connection file
include '../db.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- Fetch Hotel ---
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Hotel ID is required.");
}

// Ensure $conn (MySQLi) is available and valid
if (!$conn) {
    die("Database connection is not available.");
}

// Fetch hotel details from the database
$query = "SELECT * FROM hotels WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();

if (!$hotel) {
    die("Hotel not found.");
}

// --- Update Hotel ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $hotel_name = $_POST['hotel_name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $image_url = $_POST['image_url'];
    $is_best_seller = isset($_POST['is_best_seller']) ? 1 : 0;
    $is_eco_certified = isset($_POST['is_eco_certified']) ? 1 : 0;
    $link = $_POST['link'];
    $room_types = $_POST['room_types'];
    $features = $_POST['features'];

    // Update query
    $update = "UPDATE hotels SET hotel_name=?, location=?, description=?, price=?, rating=?, image_url=?, is_best_seller=?, is_eco_certified=?, link=?, room_types=?, features=? WHERE id=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("sssdsssssssi", $hotel_name, $location, $description, $price, $rating, $image_url, $is_best_seller, $is_eco_certified, $link, $room_types, $features, $id);
    
    if ($stmt->execute()) {

         // Set session variable for success message
         $_SESSION['success_message'] = "Hotel details updated successfully!";

        // Redirect to dashboard if update is successful
        header("Location: /myhotelbooking.com/dashboard/dashboard.php");
        exit;
    } else {
        die("Error updating hotel: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">Edit Hotel Details</h1>
        <form method="POST">
            <div class="space-y-6">
                <!-- Hotel Name -->
                <div class="flex flex-col">
                    <label for="hotel_name" class="text-lg text-gray-600 mb-2">Hotel Name</label>
                    <input type="text" name="hotel_name" value="<?= htmlspecialchars($hotel['hotel_name']) ?>" id="hotel_name" placeholder="Enter Hotel Name" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Location -->
                <div class="flex flex-col">
                    <label for="location" class="text-lg text-gray-600 mb-2">Location</label>
                    <input type="text" name="location" value="<?= htmlspecialchars($hotel['location']) ?>" id="location" placeholder="Enter Hotel Location" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Description -->
                <div class="flex flex-col">
                    <label for="description" class="text-lg text-gray-600 mb-2">Description</label>
                    <textarea name="description" id="description" placeholder="Enter Hotel Description" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($hotel['description']) ?></textarea>
                </div>

                <!-- Price -->
                <div class="flex flex-col">
                    <label for="price" class="text-lg text-gray-600 mb-2">Price</label>
                    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($hotel['price']) ?>" id="price" placeholder="Enter Hotel Price" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Rating -->
                <div class="flex flex-col">
                    <label for="rating" class="text-lg text-gray-600 mb-2">Rating</label>
                    <input type="number" step="0.1" name="rating" value="<?= htmlspecialchars($hotel['rating']) ?>" id="rating" placeholder="Enter Hotel Rating" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Image URL -->
                <div class="flex flex-col">
                    <label for="image_url" class="text-lg text-gray-600 mb-2">Image URL</label>
                    <input type="text" name="image_url" value="<?= htmlspecialchars($hotel['image_url']) ?>" id="image_url" placeholder="Enter Image URL" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Link -->
                <div class="flex flex-col">
                    <label for="link" class="text-lg text-gray-600 mb-2">Website Link</label>
                    <input type="text" name="link" value="<?= htmlspecialchars($hotel['link']) ?>" id="link" placeholder="Enter Hotel Website Link" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Room Types -->
                <div class="flex flex-col">
                    <label for="room_types" class="text-lg text-gray-600 mb-2">Room Types</label>
                    <textarea name="room_types" id="room_types" placeholder="Enter Room Types (comma separated)" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($hotel['room_types']) ?></textarea>
                </div>

                <!-- Features -->
                <div class="flex flex-col">
                    <label for="features" class="text-lg text-gray-600 mb-2">Features</label>
                    <textarea name="features" id="features" placeholder="Enter Features (comma separated)" class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($hotel['features']) ?></textarea>
                </div>

                <!-- Best Seller Checkbox -->
                <div class="flex items-center space-x-4">
                    <input type="checkbox" name="is_best_seller" class="h-5 w-5 text-blue-600" <?= $hotel['is_best_seller'] ? 'checked' : '' ?>>
                    <label for="is_best_seller" class="text-lg text-gray-600">Best Seller</label>
                </div>

                <!-- Eco Certified Checkbox -->
                <div class="flex items-center space-x-4">
                    <input type="checkbox" name="is_eco_certified" class="h-5 w-5 text-green-600" <?= $hotel['is_eco_certified'] ? 'checked' : '' ?>>
                    <label for="is_eco_certified" class="text-lg text-gray-600">Eco Certified</label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-8">
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none">Update Hotel</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
