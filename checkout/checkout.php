<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Checkout</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Heroicons CDN -->
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-100">

<?php
include('../Component/header.php');
include '../db.php';

// Start the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hotelId = $_GET['hotel_id'] ?? null;
$room = $_GET['room'] ?? null;
$total = $_GET['total'] ?? null;

if (!$hotelId || !$room || !$total) {
    die("Missing booking data.");
}

// ✅ Get hotel details including the image URL from DB
$sql = "SELECT * FROM hotels WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotelId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the hotel exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check if image_url is set and not empty
    if (isset($row['image_url']) && !empty($row['image_url'])) {
        $hotelImageURL = $row['image_url']; // Assuming 'image_url' column stores the URL
    } else {
        // Set a default image or handle the case where there is no image URL
        $hotelImageURL = 'path/to/default/image.jpg'; // Default fallback image
    }
} else {
    die("Hotel not found.");
}

?>

<div class="flex flex-row gap-6 px-6 py-10">

  <!-- First Card: Payment Form -->
  <div class="w-2/3 bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Card Payment Details</h2>

    <form method="POST" action="process_checkout.php" class="space-y-5">
      <input type="hidden" name="hotel_id" value="<?php echo $hotelId; ?>">
      <input type="hidden" name="nights" value="<?php echo $nights; ?>">
      <input type="hidden" name="total" value="<?php echo $total; ?>">

      <div>
        <label class="block text-gray-600 mb-1 flex items-center gap-2">
          <i data-feather="credit-card"></i> Card Number
        </label>
        <input type="text" name="card_number" placeholder="1234 5678 9012 3456" class="w-full border border-gray-300 rounded-lg p-3" required>
      </div>

      <div class="flex gap-4">
        <div class="w-1/2">
          <label class="block text-gray-600 mb-1 flex items-center gap-2">
            <i data-feather="calendar"></i> Expiration Date
          </label>
          <input type="text" name="exp_date" placeholder="MM/YY" class="w-full border border-gray-300 rounded-lg p-3" required>
        </div>
        <div class="w-1/2">
          <label class="block text-gray-600 mb-1 flex items-center gap-2">
            <i data-feather="shield"></i> CVV
          </label>
          <input type="text" name="cvv" placeholder="123" class="w-full border border-gray-300 rounded-lg p-3" required>
        </div>
      </div>

      <div>
        <label class="block text-gray-600 mb-1 flex items-center gap-2">
          <i data-feather="user"></i> Cardholder Name
        </label>
        <input type="text" name="cardholder_name" class="w-full border border-gray-300 rounded-lg p-3" required>
      </div>

      <div>
        <label class="block text-gray-600 mb-1 flex items-center gap-2">
          <i data-feather="map-pin"></i> Billing Address
        </label>
        <textarea name="billing_address" rows="3" class="w-full border border-gray-300 rounded-lg p-3" required></textarea>
      </div>

      <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold w-full">
        Complete Payment
      </button>
    </form>
  </div>

  <!-- Second Card: Booking Summary -->
  <div class="w-1/3 bg-white rounded-2xl shadow-lg p-6 flex flex-col justify-between">
    <div>
     <!-- Display the hotel image -->
     <img src="<?php echo htmlspecialchars($hotelImageURL); ?>" alt="Hotel Image"
           class="rounded-xl mb-4 h-48 w-full object-cover border" />


      <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
        <i data-feather="home"></i> <?php echo htmlspecialchars($row['hotel_name'] ?? 'Hotel Name'); ?>
      </h3>
      <p class="text-gray-600 mt-1"><?php echo htmlspecialchars($row['location'] ?? 'Location'); ?></p>

      <div class="mt-4 border-t pt-4 space-y-2">
        <p class="text-gray-700"><i data-feather="dollar-sign" class="inline w-4"></i> <span class="font-medium">Price per Night:</span> AED <?php echo htmlspecialchars($row['price'] ?? '0'); ?></p>
        <p class="text-gray-700"><i data-feather="clock" class="inline w-4"></i> <span class="font-medium">Nights:</span> <?php echo $nights; ?></p>
        <p class="text-gray-900 font-semibold"><i data-feather="credit-card" class="inline w-4"></i> Total: AED <?php echo htmlspecialchars($total); ?></p>
      </div>
    </div>

    <div class="mt-6 border-t pt-4">
      <h4 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
        <i data-feather="help-circle"></i> Need Help?
      </h4>
      <p class="text-gray-600 text-sm mb-1"><i data-feather="phone" class="inline w-4"></i> Call: <span class="font-medium text-blue-600">+971 123 456 789</span></p>
      <p class="text-gray-600 text-sm"><i data-feather="mail" class="inline w-4"></i> Email: <span class="font-medium text-blue-600">support@hotelbooking.com</span></p>
    </div>
  </div>

</div>

<!-- Initialize icons -->
<script>
  feather.replace();
</script>

</body>
</html>
