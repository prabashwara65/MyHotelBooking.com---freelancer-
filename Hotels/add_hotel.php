<?php
// Include database connection
include '../db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- Insert Hotel ---
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

    // Insert query
    $insert = "INSERT INTO hotels (hotel_name, location, description, price, rating, image_url, is_best_seller, is_eco_certified, link, room_types, features)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("sssdsssssss", $hotel_name, $location, $description, $price, $rating, $image_url, $is_best_seller, $is_eco_certified, $link, $room_types, $features);

    if ($stmt->execute()) {
        // Redirect on success
        header("Location: /myhotelbooking.com/dashboard/dashboard.php");
        exit;
    } else {
        die("Error adding hotel: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">Add New Hotel</h1>
        <form method="POST">
            <div class="space-y-6">

                <!-- Hotel Name -->
                <div class="flex flex-col">
                    <label for="hotel_name" class="text-lg text-gray-600 mb-2">Hotel Name</label>
                    <input type="text" name="hotel_name" id="hotel_name" required class="p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Location -->
                <div class="flex flex-col">
                    <label for="location" class="text-lg text-gray-600 mb-2">Location</label>
                    <input type="text" name="location" id="location" required class="p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Description -->
                <div class="flex flex-col">
                    <label for="description" class="text-lg text-gray-600 mb-2">Description</label>
                    <textarea name="description" id="description" required class="p-3 border border-gray-300 rounded-lg"></textarea>
                </div>

                <!-- Price -->
                <div class="flex flex-col">
                    <label for="price" class="text-lg text-gray-600 mb-2">Price</label>
                    <input type="number" step="0.01" name="price" id="price" required class="p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Rating -->
                <div class="flex flex-col">
                    <label for="rating" class="text-lg text-gray-600 mb-2">Rating</label>
                    <input type="number" step="0.1" name="rating" id="rating" required class="p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Image URL -->
                <div class="flex flex-col">
                    <label for="image_url" class="text-lg text-gray-600 mb-2">Image URL</label>
                    <input type="text" name="image_url" id="image_url" required class="p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Link -->
                <div class="flex flex-col">
                    <label for="link" class="text-lg text-gray-600 mb-2">Website Link</label>
                    <input type="text" name="link" id="link" required class="p-3 border border-gray-300 rounded-lg">
                </div>

                <!-- Room Types -->
                <div class="flex flex-col">
                    <label for="room_types" class="text-lg text-gray-600 mb-2">Room Types</label>
                    <textarea name="room_types" id="room_types" class="p-3 border border-gray-300 rounded-lg"></textarea>
                </div>

                <!-- Features -->
                <div class="flex flex-col">
                    <label for="features" class="text-lg text-gray-600 mb-2">Features</label>
                    <textarea name="features" id="features" class="p-3 border border-gray-300 rounded-lg"></textarea>
                </div>

                <!-- Best Seller and Eco Certified -->
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_best_seller" class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">Best Seller</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_eco_certified" class="form-checkbox h-5 w-5 text-green-600">
                        <span class="ml-2 text-gray-700">Eco Certified</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">Add Hotel</button>
                </div>

            </div>
        </form>
    </div>
</body>
</html>
