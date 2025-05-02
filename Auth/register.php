<?php
include 'db.php'; // Connect to the database

$registrationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone = $conn->real_escape_string($_POST['phone']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Securely hash password

  // Insert into users table
  $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
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
    body {
      background: #f0f2f5;
      font-family: Arial, sans-serif;
    }

    .container {
      width: 100%;
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .success {
      color: green;
      text-align: center;
      margin-bottom: 15px;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
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
