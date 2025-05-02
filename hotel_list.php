<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel List</title>
</head>
<body>
    <h1>Available Hotels</h1>
    <div>
        <?php
        $sql = "SELECT * FROM hotels";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($hotel = $result->fetch_assoc()) {
                echo "<div style='border:1px solid #ccc; margin-bottom:15px; padding:10px;'>";
                echo "<h2>{$hotel['name']}</h2>";
                echo "<p>Location: {$hotel['location']}</p>";
                echo "<p>Price: \${$hotel['price']} / night</p>";
                echo "<p>Rating: {$hotel['rating']} stars</p>";
                echo $hotel['eco_certified'] ? "<p><strong>Eco Certified 🌿</strong></p>" : "";
                echo "</div>";
            }
        } else {
            echo "No hotels found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
