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



session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: /myhotelbooking.com/Auth/login.php?error=loginfirst");
  exit;
}


// Start the session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get data from query parameters
$hotelId = $_GET['hotel_id'] ?? null;
$roomType = $_GET['roomType'] ?? null;
$total = $_GET['total'] ?? null;
$nights = $_GET['nights'] ?? null; 
$qtyRooms = $_GET['qtyRooms'] ?? null;


$sql = "SELECT * FROM hotels WHERE id = $hotelId";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Hotel not found.";
    exit;
}

$row = $result->fetch_assoc();

$roomTypes = explode(',', $row['room_types']);
$roomDetails = [];
foreach ($roomTypes as $room) {
    $roomDetails[trim($room)] = [
        'description' => 'A cozy and modern room with top-notch amenities for your comfort.',
        'features' => ['Free High-Speed WiFi', 'rooftop infinity pool', '4 restaurants & bars', 'eforea spa', '24/7 fitness center','concierge service','business center','kids club'],
        'price' => rand(150, 300) 
    ];
}

if (!array_key_exists($roomType, $roomDetails)) {
    echo "Room type not found.";
    exit;
}

$roomData = $roomDetails[$roomType];


if (!$hotelId || !$roomType || !$total) {
    die("Missing booking data.");
}


$sql = "SELECT * FROM hotels WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotelId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (isset($row['image_url']) && !empty($row['image_url'])) {
        $hotelImageURL = $row['image_url']; 
    } else {
        $hotelImageURL = 'path/to/default/image.jpg'; 
    }
} else {
    die("Hotel not found.");
}

?>

<div class="flex flex-row gap-6 px-6 py-10">

  <!-- Payment Form -->
  <div class="w-2/3 bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Card Payment Details</h2>

    <form method="POST" action="/myhotelbooking.com/checkout/process_checkout.php" class="space-y-5">
      <input type="hidden" name="hotel_id" value="<?php echo $hotelId; ?>">
      <input type="hidden" name="nights" value="<?php echo $nights; ?>">
      <input type="hidden" name="total" value="<?php echo $total * 0.27; ?>">
      <input type="hidden" name="roomType" value="<?php echo $roomType; ?>">
      <input type="hidden" name="qtyRooms" value="<?php echo $qtyRooms; ?>">
      <input type="hidden" name="check_in_date" value="<?php echo $CheckInDate; ?>">
      <input type="hidden" name="check_out_date" value="<?php echo $CheckOutDate; ?>">
      <input type="hidden" name="features" value='<?php echo json_encode($roomData["features"]); ?>'>
      
      
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

      <!-- Date Picker Section -->
        <div class="mt-6 border-t pt-4 space-y-2">
        <div class="flex flex-row gap-4">
            <div class="flex-1">
            <label for="check_in_date" class="block text-gray-600 mb-1">Check-in Date</label>
            <input type="date" id="check_in_date" name="check_in_date"
                    value="<?php echo htmlspecialchars($CheckInDate); ?>"
                    class="w-full border border-gray-300 rounded-lg p-3" required>
            </div>
            <div class="flex-1">
            <label for="check_out_date" class="block text-gray-600 mb-1">Check-out Date</label>
            <input type="date" id="check_out_date" name="check_out_date"
                    value="<?php echo htmlspecialchars($CheckOutDate); ?>"
                    class="w-full border border-gray-300 rounded-lg p-3" required>
            </div>
        </div>
        </div>

        <div  class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-gray-800">
              <?php foreach ($roomData['features'] as $index => $feature): 
                  $featureId = 'feature_' . $index;
              ?>
                  <div class="flex items-center space-x-2">
                  <input 
                      type="checkbox" 
                      id="<?= $featureId ?>" 
                      name="selected_features[]" 
                      value="<?= htmlspecialchars($feature) ?>" 
                      class="form-checkbox text-indigo-600 w-5 h-5"
                  />
                      <label for="<?= $featureId ?>" class="text-gray-700"><?= htmlspecialchars($feature) ?></label>
                  </div>
              <?php endforeach; ?>
         </div>

      <button type="submit" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold w-full">
        Complete Booking
      </button>
    </form>
  </div>

  <!-- Booking Summary -->
<div class="w-1/3 bg-white rounded-2xl shadow-lg p-6 flex flex-col justify-between">
  <div>
    <!-- Display the hotel image -->
    <img src="<?php echo htmlspecialchars($hotelImageURL); ?>" alt="Hotel Image"
         class="rounded-xl mb-6 h-56 w-full object-cover border" />

    <h3 class="text-xl font-semibold text-gray-800 mt-8 flex items-center gap-2">
      <i data-feather="home"></i> <?php echo htmlspecialchars($row['hotel_name'] ?? 'Hotel Name'); ?>
    </h3>
    <p class="text-gray-600 mt-1"><?php echo htmlspecialchars($row['location'] ?? 'Location'); ?></p>

    <div class="mt-6 border-t pt-4 space-y-2 text-gray-700">
    <p>
        <i data-feather="dollar-sign" class="inline w-4 h-4 mr-1"></i>
        <span class="font-medium">Price per Night:</span> AED <?php echo htmlspecialchars($row['price'] ?? '0'); ?>
    </p>
    <p>
        <i data-feather="clock" class="inline w-4 h-4 mr-1"></i>
        <span class="font-medium">Nights:</span> <?php echo $nights; ?>
    </p>
    <p class="text-gray-900 font-semibold">
        <i data-feather="credit-card" class="inline w-4 h-4 mr-1"></i>
        Total: USD <?php echo number_format((float)($total * 0.27), 2); ?>
    </p>
    <p>
        <i data-feather="layers" class="inline w-4 h-4 mr-1"></i>
        <span class="font-medium">Rooms:</span> <?php echo htmlspecialchars($qtyRooms); ?>
    </p>
    <p>
        <i data-feather="home" class="inline w-4 h-4 mr-1"></i>
        <span class="font-medium">Room Type:</span> <?php echo htmlspecialchars($roomType); ?>
    </p>
</div>


<script>
    feather.replace();
</script>

  </div>


  <div class=" border-t pt-6">
    <h4 class="text-lg font-semibold text-gray-800 mb-2 flex items-center gap-2">
      <i data-feather="help-circle"></i> Need Help?
    </h4>
    <p class="text-gray-600 text-sm mb-1"><i data-feather="phone" class="inline w-4"></i> Call: <span class="font-medium text-blue-600">+971 123 456 789</span></p>
    <p class="text-gray-600 text-sm"><i data-feather="mail" class="inline w-4"></i> Email: <span class="font-medium text-blue-600">support@hotelbooking.com</span></p>
  </div>
</div>

<script>
  // Get today's date in YYYY-MM-DD format
  const today = new Date().toISOString().split('T')[0];

  // Set the check-in date to today's date
  document.getElementById('check_in_date').value = today;
</script>

</div>

<!-- Initialize icons -->
<script>
  feather.replace();
</script>

</body>
</html>
