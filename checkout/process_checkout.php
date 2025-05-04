<?php
session_start(); 
ob_start(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
include '../db.php'; 


// Retrieve the customer details from the session
$customerName = $_SESSION['name'] ?? null;
$customerEmail = $_SESSION['email'] ?? null;

// Retrieve and sanitize other form data
$hotelId = filter_var($_POST['hotel_id'], FILTER_SANITIZE_NUMBER_INT);
$roomType = filter_var($_POST['roomType'], FILTER_SANITIZE_NUMBER_INT); 
$total = filter_var($_POST['total'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$nights = filter_var($_POST['nights'], FILTER_SANITIZE_NUMBER_INT);
$cardNumber = filter_var($_POST['card_number'], FILTER_SANITIZE_STRING);
$expDate = filter_var($_POST['exp_date'], FILTER_SANITIZE_STRING);
$cvv = filter_var($_POST['cvv'], FILTER_SANITIZE_STRING);
$cardholderName = filter_var($_POST['cardholder_name'], FILTER_SANITIZE_STRING);
$billingAddress = filter_var($_POST['billing_address'], FILTER_SANITIZE_STRING);
$qtyRooms = filter_var($_POST['qtyRooms'], FILTER_SANITIZE_STRING);


if (isset($_POST['selected_features'])) {
    $selectedFeatures = $_POST['selected_features'];  
} else {
    $selectedFeatures = []; 
}

// Convert the features array to a JSON string
$featuresJson = json_encode($selectedFeatures);

// Check if the JSON conversion was successful
if ($featuresJson === false) {
    echo "<p>Error encoding features into JSON format: " . json_last_error_msg() . "</p>";
    ob_end_flush();
    exit();
}


if (empty($selectedFeatures)) {
    $featuresJson = null;  
}

// Format and validate the check-in and check-out dates
$checkInDate = date('Y-m-d', strtotime($_POST['check_in_date']));
$checkOutDate = date('Y-m-d', strtotime($_POST['check_out_date']));

if (!DateTime::createFromFormat('Y-m-d', $checkInDate)) {
    echo "<p>Error: Invalid check-in date format. Please use YYYY-MM-DD.</p>";
    ob_end_flush();
    exit();
}

if (!DateTime::createFromFormat('Y-m-d', $checkOutDate)) {
    echo "<p>Error: Invalid check-out date format. Please use YYYY-MM-DD.</p>";
    ob_end_flush();
    exit();
}


echo "<p><strong>Check-in Date:</strong> $checkInDate</p>";
echo "<p><strong>Check-out Date:</strong> $checkOutDate</p>";

// Show received values 
echo "<h3>Received Booking Information</h3>";
echo "<p><strong>Hotel ID:</strong> $hotelId</p>";
echo "<p><strong>Name:</strong> $customerName</p>";
echo "<p><strong>Room Type:</strong> $roomType</p>";
echo "<p><strong>Email:</strong> $customerEmail</p>";
echo "<p><strong>Room:</strong> $qtyRooms</p>";
echo "<p><strong>Total:</strong> $total</p>";
echo "<p><strong>Nights:</strong> $nights</p>";
echo "<p><strong>Card Number:</strong> **** **** **** " . substr($cardNumber, -4) . "</p>";
echo "<p><strong>Expiration Date:</strong> $expDate</p>";
echo "<p><strong>CVV:</strong> [Hidden]</p>";
echo "<p><strong>Cardholder Name:</strong> $cardholderName</p>";
echo "<p><strong>Billing Address:</strong> $billingAddress</p>";
echo "<p><strong>Features:</strong> $featuresJson</p>";

// SQL query
$stmt = $conn->prepare("INSERT INTO bookings (
    hotel_id, customer_name, customer_email, card_number, exp_date, cvv, cardholder_name, billing_address,
    check_in_date, check_out_date, nights, roomType, qtyRooms, total, features, booking_date
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP())");

if ($stmt === false) {
    echo "<p style='color: red;'>SQL prepare error: " . $conn->error . "</p>";
    ob_end_flush();
    exit();
}

$stmt->bind_param("isssssssssiiids",
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
    $roomType,
    $qtyRooms,
    $total,
    $featuresJson
);

if ($stmt->execute()) {
    $bookingId = $stmt->insert_id; 
    $_SESSION['success_message'] = "Booking added successfully! (Booking ID: $bookingId)";
    $stmt->close();
    $conn->close();
    header("Location: /myhotelbooking.com/booking/bookings.php");
    exit();
} else {
    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
    $stmt->close();
    $conn->close();
    ob_end_flush();
    exit();
}
?>
