<?php
include '../db.php';
include('../Component/header.php');

$sql = "SELECT * FROM bookings ORDER BY booking_date DESC";
$result = $conn->query($sql);
$defaultImage = 'https://via.placeholder.com/150?text=No+Image';




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking Cards</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .hotel-img {
            width: 100%;
            height: auto;
            border-radius: 6px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Hotel Booking Cards</h2>
    <div class="row g-4">

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="row g-0 h-100">
                            <div class="col-7 p-3">
                                <h5 class="card-title"><?= htmlspecialchars($row['customer_name']) ?> (Hotel #<?= $row['hotel_id'] ?>)</h5>
                                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($row['customer_email']) ?></p>
                                <p class="card-text"><strong>Room:</strong> <?= htmlspecialchars($row['roomType']) ?> | <?= $row['qtyRooms'] ?> rooms for <?= $row['nights'] ?> night(s)</p>
                                <p class="card-text"><strong>Check-in:</strong> <?= $row['check_in_date'] ?><br><strong>Check-out:</strong> <?= $row['check_out_date'] ?></p>
                                <p class="card-text"><strong>Total:</strong> $<?= number_format($row['total'], 2) ?></p>
                                <hr>
                                <p class="card-text"><strong>Cardholder:</strong> <?= htmlspecialchars($row['cardholder_name']) ?></p>
                                <p class="card-text"><strong>Billing:</strong> <?= htmlspecialchars($row['billing_address']) ?></p>
                                <p class="card-text"><small class="text-muted">Booked on <?= $row['booking_date'] ?></small></p>
                            </div>
                            <div class="col-5 d-flex align-items-center p-2">
                                <img src="<?= htmlspecialchars($row['hotel_image']) ?: $defaultImage ?>" alt="Hotel Image" class="hotel-img">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">No bookings found.</div>
            </div>
        <?php endif; ?>

    </div>
</div>
</body>
</html>

<?php $conn->close(); ?>
