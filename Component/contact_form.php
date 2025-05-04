<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Change this to the actual email
    $hotelEmail = "hotel@example.com"; 

    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Basic validation
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fullMessage = "From: $name <$email>\n\n$message";
        $headers = "From: $email";

        if (mail($hotelEmail, $subject, $fullMessage, $headers)) {
            $success = "Your message has been sent successfully.";
        } else {
            $error = "There was a problem sending your message.";
        }
    } else {
        $error = "Please fill in all fields correctly.";
    }
}
?>

<!-- Contact form HTML -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Hotel</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="flex justify-center items-center bg-gray-100 ml-16 mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Contact Hotel</h2>

        <!-- Successor Error Messages -->
        <?php if (!empty($success)) echo "<p class='text-green-500 mb-4'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p class='text-red-500 mb-4'>$error</p>"; ?>

        <!-- Form  -->
        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="name" class="block text-gray-700">Your Name</label>
                <input type="text" name="name" required class="w-full p-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your name">
            </div>
            <div>
                <label for="email" class="block text-gray-700">Your Email</label>
                <input type="email" name="email" required class="w-full p-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email">
            </div>
            <div>
                <label for="subject" class="block text-gray-700">Subject</label>
                <input type="text" name="subject" required class="w-full p-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Subject of your message">
            </div>
            <div>
                <label for="message" class="block text-gray-700">Your Message</label>
                <textarea name="message" rows="4" required class="w-full p-2 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your message"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="w-full py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Send Message
                </button>
            </div>
        </form>

    </div>
</div>
