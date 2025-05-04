<?php
include '../db.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

     // Redirect back to the users list
    header("Location: /myhotelbooking.com/dashboard/dashboard.php");
    exit;
}
?>
