<?php
session_start(); // Start the session

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../db.php'; // Database connection

// Retrieve the customer details from the session
$customerName = $_SESSION['name'] ?? null;
$customerEmail = $_SESSION['email'] ?? null;

// Retrieve and sanitize other form data
$hotelId = filter_var($_POST['hotel_id'], FILTER_SANITIZE_NUMBER_INT);
$room = filter_var($_POST['room'], FILTER_SANITIZE_NUMBER_INT); // Assuming you pass the room as a hidden field
$total = filter_var($_POST['total'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$nights = filter_var($_POST['nights'], FILTER_SANITIZE_NUMBER_INT);
$cardNumber = filter_var($_POST['card_number'], FILTER_SANITIZE_STRING);
$expDate = filter_var($_POST['exp_date'], FILTER_SANITIZE_STRING);
$cvv = filter_var($_POST['cvv'], FILTER_SANITIZE_STRING);
$cardholderName = filter_var($_POST['cardholder_name'], FILTER_SANITIZE_STRING);
$billingAddress = filter_var($_POST['billing_address'], FILTER_SANITIZE_STRING);
$qtyRooms = filter_var($_POST['qtyRooms'], FILTER_SANITIZE_STRING);

// Format and validate the check-in and check-out dates
$checkInDate = date('Y-m-d', strtotime($_POST['check_in_date']));
$checkOutDate = date('Y-m-d', strtotime($_POST['check_out_date']));

// Validate date formats (check if valid date)
if (!DateTime::createFromFormat('Y-m-d', $checkInDate)) {
    echo "<p>Error: Invalid check-in date format. Please use YYYY-MM-DD.</p>";
    exit();
}

if (!DateTime::createFromFormat('Y-m-d', $checkOutDate)) {
    echo "<p>Error: Invalid check-out date format. Please use YYYY-MM-DD.</p>";
    exit();
}

// Show received values (for debugging or confirmation)
echo "<h3>Received Booking Information</h3>";
echo "<p><strong>Hotel ID:</strong> $hotelId</p>";
echo "<p><strong>Name:</strong> $customerName</p>";
echo "<p><strong>Email:</strong> $customerEmail</p>";
echo "<p><strong>Room:</strong> $qtyRooms</p>";
echo "<p><strong>Total:</strong> $total</p>";
echo "<p><strong>Nights:</strong> $nights</p>";
echo "<p><strong>Card Number:</strong> **** **** **** " . substr($cardNumber, -4) . "</p>";
echo "<p><strong>Expiration Date:</strong> $expDate</p>";
echo "<p><strong>CVV:</strong> [Hidden]</p>";
echo "<p><strong>Cardholder Name:</strong> $cardholderName</p>";
echo "<p><strong>Billing Address:</strong> $billingAddress</p>";
echo "<p><strong>Check-in Date:</strong> $checkInDate</p>";
echo "<p><strong>Check-out Date:</strong> $checkOutDate</p>";

// Prepare the SQL query
$stmt = $conn->prepare("INSERT INTO bookings (
    hotel_id, customer_name, customer_email, card_number, exp_date, cvv, cardholder_name, billing_address,
    check_in_date, check_out_date, num_nights, room, total, booking_date
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP())");

// Check if the statement preparation was successful
if ($stmt === false) {
    die('SQL prepare error: ' . $conn->error);
}

// Bind parameters
$stmt->bind_param(
    "issssssssssss",
    $hotelId,
    $customerName,
    $customerEmail,
    $cardNumber,
    $expDate,
    $cvv,
    $cardholderName,
    $billingAddress,
    $checkInDate,
    $checkOutDate,
    $nights,
    $room,
    $total
);

// Execute the query and check for success
if ($stmt->execute()) {
    echo "<p style='color: green;'>Booking successful!</p>";
} else {
    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>
