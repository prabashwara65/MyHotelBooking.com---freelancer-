<?php
// Start the session
session_start();

// Connect to the database
include '../db.php'; 

// Initialize variables for email and password
$email = $password = "";
$email_err = $password_err = "";

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // If there are no errors, attempt to log the user in
    if (empty($email_err) && empty($password_err)) {
        // Prepare a SQL query to check the user's credentials
        $sql = "SELECT id, email, password FROM users WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind the email parameter to the SQL query
            $stmt->bind_param("s", $param_email);

            // Set the parameter
            $param_email = $email;

            // Execute the query
            if ($stmt->execute()) {
                $stmt->store_result();

                // Check if the email exists in the database
                if ($stmt->num_rows == 1) {
                    // Bind the result to variables
                    $stmt->bind_result($id, $email, $stored_password);

                    if ($stmt->fetch()) {
                        // Check if the password is correct (without hashing)
                        if ($password == $stored_password) {
                            // Password is correct, start the session
                            session_start();

                            // Store session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect the user to their bookings page
                            header("location: /myhotelbooking.com/home/home.php");
                        } else {
                            $password_err = "The password you entered is incorrect.";
                        }
                    }
                } else {
                    $email_err = "No account found with that email address.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close the statement
            $stmt->close();
        }
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHotelBooking - Login</title>
    <!-- Add your styles here -->
</head>
<body>
    <!-- Your header and other content here -->

    <div class="container">
        <div class="auth-container">
            <div class="auth-form">
                <h2>Login to Your Account</h2>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="loginEmail">Email Address</label>
                        <input type="email" id="loginEmail" name="email" required value="<?php echo $email; ?>">
                        <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="password" required>
                        <span class="error"><?php echo $password_err; ?></span>
                        <div class="password-requirements">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
                </form>

                <div class="form-toggle">
                    Don't have an account? <a href="register.php">Register here</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Your footer here -->
</body>
</html>
