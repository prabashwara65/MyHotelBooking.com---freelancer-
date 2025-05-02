<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyHotelBooking - Find Your Perfect Stay</title>
    <style>
        /* Global Styles */
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --eco-green: #2ecc71;
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
        }
        
        .container {
            width: 90%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            color: var(--accent);
        }
        
        .nav-links {
            display: flex;
            gap: 2rem;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            color: var(--accent);
        }
        
        .auth-buttons .btn {
            margin-left: 1rem;
        }
        
        /* Hero Section */
        .hero {
            height: 80vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
            position: relative;
        }
        
        .hero-content {
            width: 100%;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }
        
        /* Search Form */
        .search-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            max-width: 1000px;
            margin: 0 auto;
            transform: translateY(50%);
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 500;
        }
        
        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .search-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: flex-end;
        }
        
        .search-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }
        
        /* Featured Section */
        .featured {
            padding: 8rem 0 4rem;
            background: white;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }
        
        .section-title p {
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        .hotel-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .hotel-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .hotel-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        
        .hotel-img {
            height: 200px;
            overflow: hidden;
        }
        
        .hotel-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .hotel-card:hover .hotel-img img {
            transform: scale(1.1);
        }
        
        .hotel-info {
            padding: 1.5rem;
        }
        
        .hotel-info h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }
        
        .hotel-location {
            color: #666;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .hotel-location i {
            margin-right: 5px;
        }
        
        .hotel-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
        
        .rating {
            background: var(--primary);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .price {
            font-size: 1.3rem;
            font-weight: 700;
        }
        
        .price span {
            font-size: 1rem;
            font-weight: 400;
            color: #666;
        }
        
        .eco-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--eco-green);
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        /* Sustainability Section */
        .sustainability {
            padding: 4rem 0;
            background: #f0f8ff;
        }
        
        .eco-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .eco-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .eco-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .eco-card i {
            font-size: 2.5rem;
            color: var(--eco-green);
            margin-bottom: 1rem;
        }
        
        .eco-card h3 {
            margin-bottom: 1rem;
        }
        
        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 4rem 0 2rem;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .footer-col h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-col h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--accent);
        }
        
        .footer-col ul {
            list-style: none;
        }
        
        .footer-col ul li {
            margin-bottom: 10px;
        }
        
        .footer-col ul li a {
            color: #ddd;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-col ul li a:hover {
            color: var(--accent);
            padding-left: 5px;
        }
        
        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #444;
            color: #aaa;
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .nav-links {
                display: none;
            }
            
            .search-form {
                transform: translateY(20%);
                padding: 1.5rem;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
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
                <div class="logo">
                    <i class="fas fa-hotel"></i>
                    <span>MyHotelBooking</span>
                </div>
                <div class="nav-links">
                    <a href="home.php">Home</a>
                    <a href="hotel_list.html">Hotels</a>
                    <a href="#">Destinations</a>
                    <a href="#">Deals</a>
                    <a href="#">About</a>
                </div>
                <div class="auth-buttons">
                    <a href="#" class="btn"> <a href="/myhotelbooking.com/Auth/login.html">   Login </a>
                    <a href="/myhotelbooking.com/Auth/register.php" class="btn"> Sign Up</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Your Perfect Stay</h1>
                <p>Book from over 10,000 hotels across Asia and Europe. Best price guarantee and eco-friendly options available.</p>
                
                <!-- Search Form -->
                <div class="search-form">
                    <form>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <input type="text" id="destination" placeholder="Where are you going?">
                            </div>
                            <div class="form-group">
                                <label for="check-in">Check-in</label>
                                <input type="date" id="check-in">
                            </div>
                            <div class="form-group">
                                <label for="check-out">Check-out</label>
                                <input type="date" id="check-out">
                            </div>
                            <div class="form-group">
                                <label for="guests">Guests</label>
                                <select id="guests">
                                    <option value="1">1 Guest</option>
                                    <option value="2">2 Guests</option>
                                    <option value="3">3 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="5+">5+ Guests</option>
                                </select>
                            </div>
                            <button type="submit" class="search-btn"> <a href="hotel_list.html">  Hotels </a> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Hotels -->
    <section class="featured">
        <div class="container">
            <div class="section-title">
                <h2>Featured Hotels</h2>
                <p>Top-rated accommodations from our partners</p>
            </div>
            
            <div class="hotel-grid">
                <!-- Hotel 1 -->
                <div class="hotel-card">
                    <div class="hotel-img">
                        <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" alt="Marriott Hotel">
                        <div class="eco-badge">Eco Certified</div>
                    </div>
                    <div class="hotel-info">
                        <h3>Marriott Grand</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bangkok, Thailand</span>
                        </div>
                        <div class="hotel-meta">
                            <div class="rating">4.8 ★</div>
                            <div class="price">AED 120 <span>/ night</span></div>
                        </div>
                    </div>
                </div>
                
                <!-- Hotel 2 -->
                <div class="hotel-card">
                    <div class="hotel-img">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" alt="Hilton Hotel">
                    </div>
                    <div class="hotel-info">
                        <h3>Hilton Paradise</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Bali, Indonesia</span>
                        </div>
                        <div class="hotel-meta">
                            <div class="rating">4.9 ★</div>
                            <div class="price">AED 210 <span>/ night</span></div>
                        </div>
                    </div>
                </div>
                
                <!-- Hotel 3 -->
                <div class="hotel-card">
                    <div class="hotel-img">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" alt="Hyatt Hotel">
                        <div class="eco-badge">Eco Certified</div>
                    </div>
                    <div class="hotel-info">
                        <h3>Hyatt Riverside</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Paris, France</span>
                        </div>
                        <div class="hotel-meta">
                            <div class="rating">4.7 ★</div>
                            <div class="price">AED 180 <span>/ night</span></div>
                        </div>
                    </div>
                </div>

                <div class="hotel-card">
                    <div class="hotel-img">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" alt="Hyatt Hotel">
                        <div class="eco-badge">Eco Certified</div>
                    </div>
                    <div class="hotel-info">
                        <h3>Four Seasons</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Chidlom, Bangkok</span>
                        </div>
                        <div class="hotel-meta">
                            <div class="rating">5 ★</div>
                            <div class="price">AED 250 <span>/ night</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <!-- Sustainability Section -->
    <section class="sustainability">
        <div class="container">
            <div class="section-title">
                <h2>Travel Sustainably</h2>
                <p>Earn reward points for eco-friendly choices and help reduce your carbon footprint</p>
            </div>
            
            <div class="eco-features">
                <div class="eco-card">
                    <i class="fas fa-leaf"></i>
                    <h3>Green Stays</h3>
                    <p>Filter for hotels with solar power, recycling programs, and water conservation.</p>
                </div>
                
                <div class="eco-card">
                    <i class="fas fa-coins"></i>
                    <h3>Earn Rewards</h3>
                    <p>Get 5% bonus points when you book eco-certified accommodations.</p>
                </div>
                
                <div class="eco-card">
                    <i class="fas fa-taxi"></i>
                    <h3>Carbon Offset</h3>
                    <p>Option to offset your flight emissions during checkout.</p>
                </div>
            </div>
        </div>
    </section>

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
                
                <div class="footer-col">
                    <h3>Newsletter</h3>
                    <p>Subscribe for exclusive deals and travel tips.</p>
                    <form>
                        <input type="email" placeholder="Your Email" style="padding: 10px; width: 100%; margin-top: 10px;">
                        <button type="submit" style="background: var(--accent); color: white; border: none; padding: 10px 15px; margin-top: 10px; cursor: pointer;">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2023 MyHotelBooking. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>