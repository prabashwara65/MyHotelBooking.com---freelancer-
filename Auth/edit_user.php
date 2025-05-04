<?php
include '../db.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission and update the user in the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('sssi', $name, $email, $role, $user_id);
    $stmt->execute();

    header("Location: /myhotelbooking.com/dashboard/dashboard.php"); // Redirect back to the users list
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit User</title>
</head>
<body class="bg-gray-50 font-sans">

<div class="max-w-4xl mx-auto my-10 p-8 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Edit User Details</h2>

    <form method="POST" action="" class="space-y-6">
        <div>
            <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required 
                   class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required 
                   class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="role" class="block text-lg font-medium text-gray-700">Role</label>
            <input type="text" id="role" name="role" value="<?= htmlspecialchars($user['role']) ?>" required 
                   class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition ease-in-out duration-300">
            Save Changes
        </button>
    </form>
</div>

</body>
</html>
