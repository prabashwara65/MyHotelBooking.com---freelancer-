<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1); 

// Connect to the database
include '../db.php'; 

$registrationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone = $conn->real_escape_string($_POST['phone']);
  
  // Store password as plain text (Not recommended for production)
  $password = $_POST['password'];

  // Insert into users table
  $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
  }

  $stmt->bind_param("ssss", $name, $email, $phone, $password);

  if ($stmt->execute()) {
    $registrationMessage = "<p class='success'>Registration successful!</p>";
  } else {
    $registrationMessage = "<p class='error'>Error: " . $stmt->error . "</p>";
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <style>
    /* Your CSS styles here */
    /* ===== Global Styles ===== */
    :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #f72585;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --eco-green: #2ecc71;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
  </style>
</head>
<body>
  <div class="container">
    <h2>Register</h2>
    <?php echo $registrationMessage; ?>
    <form method="POST" action="">
      <label for="name">Name</label>
      <input type="text" name="name" required>

      <label for="email">Email</label>
      <input type="email" name="email" required>

      <label for="phone">Phone</label>
      <input type="text" name="phone" required>

      <label for="password">Password</label>
      <input type="password" name="password" required>

      <button type="submit">Register</button>
    </form>
  </div>
</body>
</html>
