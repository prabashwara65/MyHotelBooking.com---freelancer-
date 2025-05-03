<?php
include '../db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];

    // Delete the booking from the database
    $sql = "DELETE FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();

    // Redirect back to the main page with a success message
    $_SESSION['success_message'] = "Booking deleted successfully!";
    header("Location: /myhotelbooking.com/booking/view_booking.php"); // Adjust the redirect as per your needs
    exit();
}

$conn->close();
?>
