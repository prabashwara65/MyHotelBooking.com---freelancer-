<?php
// Start the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (isset($_GET['error']) && $_GET['error'] === 'loginfirst') {
    echo '<div class="text-red-600 mb-2">Please login first to access that page.</div>';
}

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
        $sql = "SELECT id, name, email, role , password FROM users WHERE email = ?";

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
                    $stmt->bind_result($id, $name, $email, $role,  $stored_password);

                    if ($stmt->fetch()) {
                        // Check if the password is correct (without hashing)
                        if ($password == $stored_password) {
                            // Password is correct, start the session
                            session_start();

                            // Store session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["name"] = $name;
                            $_SESSION["role"] = $role;

                            if ($role === 'user') {
                                header("Location: /myhotelbooking.com/home/home.php");
                                exit;
                            } elseif ($role === 'admin') {
                                header("Location: /myhotelbooking.com/dashboard/dashboard.php");
                                exit;
                            } else {
                                // Optional: handle other roles or unknown roles
                                echo "Access denied. Unknown role.";
                                exit;
                            }
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
    <script src="https://cdn.tailwindcss.com"></script>

    <title>MyHotelBooking - Login</title>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

       <!-- Blue Card on the Left -->
        <div class="flex-1 bg-[#3D34C4] text-white p-10 flex">
            <div>
                <h2 class="text-4xl font-bold mb-4">Welcome Back!</h2>
                <p>Login to manage your bookings, save favorites, and access exclusive member deals.</p>
                <p>Your perfect stay awaits!</p>

                <h2 class="mt-80 ml-5">New to MyHotelBooking?</h2>
                <a href="register.php">
                    <button class="font-bold text-white bg-transparent border-2 border-white rounded-full p-6 mt-4 hover:bg-white hover:text-black hover:border-transparent transition">Create New Account</button>
                </a>
            </div>
        </div>

        <!-- Login Card on the Right -->
        <div class="flex-1 bg-white p-8 shadow-lg rounded-lg flex justify-center items-center">
            <div class="max-w-md w-full">
                <h2 class="text-2xl font-semibold text-center mb-6">Login to Your Account</h2>
                <form action="login.php" method="POST">
                    <div class="mb-4">
                        <label for="loginEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" id="loginEmail" name="email" required value="<?php echo $email; ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php if (!empty($email_err)) { echo '<span class="text-red-500 text-sm">' . $email_err . '</span>'; } ?>
                    </div>

                    <div class="mb-6">
                        <label for="loginPassword" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="loginPassword" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php if (!empty($password_err)) { echo '<span class="text-red-500 text-sm">' . $password_err . '</span>'; } ?>
                        <div class="text-right mt-2">
                            <a href="forgot-password.html" class="text-blue-500 text-sm">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Login
                    </button>
                </form>

                <div class="text-center mt-4">
                    Don't have an account? <a href="register.php" class="text-blue-500">Register here</a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
