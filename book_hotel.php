<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay - MyHotelBooking</title>
    <style>
        /* ===== Global Styles ===== */
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #f72585;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --eco-green: #2ecc71;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --border-radius: 8px;
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
            padding: 20px 0;
        }

        /* ===== Header ===== */
        header {
            background: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 900;

        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;

        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        .logo i {
            margin-right: 10px;
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* ===== Booking Form Styles ===== */
        .booking-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2.5rem;
            margin: 2rem auto;
            max-width: 900px;
        }
        
        .booking-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .booking-header h1 {
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .booking-header p {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .booking-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.2rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .form-group input[readonly] {
            background-color: var(--light-gray);
            cursor: not-allowed;
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            grid-column: 1 / -1;
            background: var(--primary);
            color: white;
            border: none;
            padding: 14px;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Confirmation Messages */
        .confirmation-message {
            text-align: center;
            padding: 2rem;
            margin: 2rem auto;
            border-radius: var(--border-radius);
            font-size: 1.1rem;
            max-width: 800px;
        }
        
        .success {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--eco-green);
            border: 1px solid var(--eco-green);
        }
        
        .error {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }

        /* ===== Footer ===== */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0;
            margin-top: 3rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .footer-col h3 {
            margin-bottom: 1.2rem;
            font-size: 1.2rem;
            color: white;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col li {
            margin-bottom: 0.5rem;
        }

        .footer-col a {
            color: #aaa;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-col a:hover {
            color: var(--accent);
        }

        .copyright {
            text-align: center;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid #444;
            color: #777;
            font-size: 0.9rem;
        }

        /* ===== Responsive ===== */
        @media (max-width: 768px) {
            .booking-container {
                padding: 1.5rem;
            }
            
            .booking-header h1 {
                font-size: 1.8rem;
            }
            
            .booking-form {
                grid-template-columns: 1fr;
            }
            
            nav {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <a href="index.html" class="logo">
                    <i class="fas fa-hotel"></i>
                    <span>MyHotelBooking</span>
                </a>
                
                <div class="nav-links">
                    <a href="home.php">Home</a>
                    <a href="hotel_list.html">Hotels</a>
                    <a href="#">Destinations</a>
                    <a href="#">Deals</a>
                    <a href="#">About</a>
                </div>
                
                <div>
                    <a href="login.html" class="btn btn-outline">Login</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <?php include 'db.php'; ?>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotel_id = $_POST['hotel_id'];
            $name = $_POST['customer_name'];
            $email = $_POST['customer_email'];
            $checkin = $_POST['check_in_date'];
            $checkout = $_POST['check_out_date'];
            $guests = $_POST['num_guests'];
            $requests = $_POST['special_requests'];

            $stmt = $conn->prepare("INSERT INTO bookings (hotel_id, customer_name, customer_email, check_in_date, check_out_date, num_guests, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssis", $hotel_id, $name, $email, $checkin, $checkout, $guests, $requests);

            if ($stmt->execute()) {
                echo '<div class="confirmation-message success">
                        <i class="fas fa-check-circle"></i>
                        <h2>Booking Successful!</h2>
                        <p>We\'ve sent a confirmation email to <strong>'.$email.'</strong> with your booking details.</p>
                        <p>Thank you for choosing MyHotelBooking!</p>
                        <a href="home.php" class="btn btn-outline" style="margin-top: 1rem;">Back to Home</a>
                    </div>';
            } else {
                echo '<div class="confirmation-message error">
                        <i class="fas fa-exclamation-circle"></i>
                        <h2>Oops! Something went wrong</h2>
                        <p>Please try again or contact our support team if the problem persists.</p>
                        <button onclick="window.history.back()" class="btn btn-outline" style="margin-top: 1rem;">Try Again</button>
                    </div>';
            }

            $stmt->close();
            $conn->close();
        }
        ?>

        <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($show_form)): ?>
        <div class="booking-container">
            <div class="booking-header">
                <h1><i class="fas fa-calendar-check"></i> Book Your Stay</h1>
                <p>Fill out the form below to reserve your perfect hotel experience</p>
            </div>
            
            <form action="book_hotel.php" method="POST" class="booking-form">
                <div class="form-group">
                    <label for="hotel_id"><i class="fas fa-hotel"></i> Hotel ID</label>
                    <input 
                        type="number" 
                        name="hotel_id" 
                        id="hotel_id" 
                        required 
                        placeholder="Enter hotel ID"
                        value="<?php echo isset($_GET['hotel_id']) ? htmlspecialchars($_GET['hotel_id']) : ''; ?>"
                        <?php echo isset($_GET['hotel_id']) ? 'readonly' : ''; ?>
                    >
                </div>
                
                <div class="form-group">
                    <label for="customer_name"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="customer_name" id="customer_name" required placeholder="Your full name">
                </div>
                
                <div class="form-group">
                    <label for="customer_email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="customer_email" id="customer_email" required placeholder="your@email.com">
                </div>
                
                <div class="form-group">
                    <label for="check_in_date"><i class="fas fa-calendar-day"></i> Check-In</label>
                    <input type="date" name="check_in_date" id="check_in_date" required>
                </div>
                
                <div class="form-group">
                    <label for="check_out_date"><i class="fas fa-calendar-day"></i> Check-Out</label>
                    <input type="date" name="check_out_date" id="check_out_date" required>
                </div>
                
                <div class="form-group">
                    <label for="num_guests"><i class="fas fa-users"></i> Guests</label>
                    <input type="number" name="num_guests" id="num_guests" min="1" required placeholder="Number of guests">
                </div>
                
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label for="special_requests"><i class="fas fa-star"></i> Special Requests</label>
                    <textarea name="special_requests" id="special_requests" placeholder="Any special requirements?"></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-lock"></i> Confirm Booking
                </button>
            </form>
        </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>MyHotelBooking</h3>
                    <p>Your trusted platform for seamless hotel reservations across Asia and Europe.</p>
                </div>
                
                <div class="footer-col">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Press</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2023 MyHotelBooking. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>