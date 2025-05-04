<?php
session_start();
include '../db.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== 'admin') {
    header("Location: /myhotelbooking.com/login/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['hotel_id'])) {
    $hotel_id = intval($_POST['hotel_id']);

    $stmt = $conn->prepare("DELETE FROM hotels WHERE id = ?");
    $stmt->bind_param("i", $hotel_id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Hotel deleted successfully.";
    } else {
        $_SESSION['success_message'] = "Failed to delete hotel.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: /myhotelbooking.com/dashboard/dashboard.php");
exit;
?>
