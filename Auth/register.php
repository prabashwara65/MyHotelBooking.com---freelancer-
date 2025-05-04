<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db.php';

$registrationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone = $conn->real_escape_string($_POST['phone']);
  $password = $_POST['password']; 

  $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
  }

  $stmt->bind_param("ssss", $name, $email, $phone, $password);

  if ($stmt->execute()) {
    $registrationMessage = "<p class='text-green-500 text-sm text-center font-medium'>✔️ Registration successful!</p>";
    header("Location: /myhotelbooking.com/Auth/login.php");
  } else {
    $registrationMessage = "<p class='text-red-500 text-sm text-center font-medium'>❌ " . $stmt->error . "</p>";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-200">

  <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
    <h2 class="text-3xl font-bold text-indigo-600 text-center mb-4">Create an Account</h2>
    
    <?php echo $registrationMessage; ?>

    <form method="POST" class="space-y-4 mt-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
        <input type="text" name="name" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
        <input type="email" name="email" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
        <input type="text" name="phone" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" required
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <button type="submit"
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
        Sign Up
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
      Already have an account?
      <a href="login.php" class="text-indigo-600 font-medium hover:underline">Login</a>
    </p>
  </div>

</body>
</html>
