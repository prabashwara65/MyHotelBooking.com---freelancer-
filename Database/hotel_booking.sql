-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2025 at 08:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `roomType` varchar(25) NOT NULL,
  `check_in_date` varchar(23) DEFAULT NULL,
  `check_out_date` varchar(23) DEFAULT NULL,
  `nights` int(11) DEFAULT NULL,
  `exp_date` int(11) NOT NULL,
  `qtyRooms` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `cardholder_name` varchar(100) DEFAULT NULL,
  `billing_address` text DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `features` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `hotel_id`, `customer_name`, `customer_email`, `roomType`, `check_in_date`, `check_out_date`, `nights`, `exp_date`, `qtyRooms`, `total`, `card_number`, `cvv`, `cardholder_name`, `billing_address`, `booking_date`, `features`) VALUES
(36, 4, 'admin', 'admin@gmail.com', '0', '2025-05-04', '2025-05-13', 2, 3424, 1, 90, '324242', '434', 'dfsfds', 'fgd', '2025-05-04 03:55:08', '[\"Free High-Speed WiFi\",\"4 restaurants & bars\"]'),
(39, 6, 'admin', 'admin@gmail.com', '0', '2025-05-04', '2025-05-14', 10, 4545, 10, 8392, '45435', '4534', '4535', '453', '2025-05-04 04:12:21', '[\"Free High-Speed WiFi\"]'),
(42, 3, 'name1', 'name1@gmail.com', '0', '2025-05-04', '2025-05-06', 1, 34535, 1, 43, '34343', '4353', 'dsfs', 'dsfs', '2025-05-04 05:52:16', '[\"4 restaurants & bars\",\"eforea spa\",\"concierge service\"]'),
(43, 3, 'john', 'john@gmail.com', '0', '2025-05-04', '2025-05-14', 3, 225, 2, 417, '1234234545674567', '123', 'john', 'john,home', '2025-05-04 05:55:40', '[\"Free High-Speed WiFi\",\"rooftop infinity pool\",\"4 restaurants & bars\"]'),
(44, 6, 'john', 'john@gmail.com', '0', '2025-05-04', '2025-05-14', 1, 325, 5, 240, '3467263587645638', '345', 'john', 'john, home', '2025-05-04 05:56:52', '[\"24\\/7 fitness center\",\"business center\",\"kids club\"]'),
(45, 4, 'jenny', 'jenny@gmail.com', '0', '2025-05-04', '2025-05-28', 2, 1225, 2, 284, '6746537287536541', '456', 'jenny', 'jenny, home', '2025-05-04 05:58:51', '[\"Free High-Speed WiFi\",\"4 restaurants & bars\",\"eforea spa\",\"concierge service\"]');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `is_eco_certified` tinyint(1) NOT NULL DEFAULT 0,
  `link` varchar(255) NOT NULL,
  `room_types` text DEFAULT NULL,
  `features` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `location`, `description`, `price`, `rating`, `image_url`, `is_best_seller`, `is_eco_certified`, `link`, `room_types`, `features`) VALUES
(3, 'Marriott Grand Bangkok', 'Sukhumvit Road, Bangkok, Thailand', 'A premier 5-star destination nestled in the heart of the city\'s bustling commercial and cultural hub. Enjoy luxurious accommodations with breathtaking skyline views, indulge in award-winning dining, and unwind with world-class amenities. With convenient access to the BTS Skytrain, you\'re just moments away from Bangkok’s top attractions, shopping, and nightlife.', 120.00, 4.8, 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80', 0, 1, 'https://example.com/city-luxe-hotel', 'Deluxe Room, Executive Suite, Presidential Suite', 'Free High-Speed WiFi, Rooftop Infinity Pool, 4 Restaurants & Bars, Eforea Spa, 24/7 Fitness Center, Concierge Service, Business Center, Kids Club'),
(4, 'Four Seasons', 'Chidlom, Bangkok', 'An eco-friendly urban sanctuary seamlessly blending nature with contemporary elegance. Nestled in the heart of the city, this lush resort features expansive tropical gardens, three stunning outdoor pools, and serene riverside views. Designed with sustainability in mind, the hotel promotes green tourism through innovative eco-conscious practices. ', 250.00, 5.0, 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=8', 0, 1, 'https://example.com/eco-lodge', 'Deluxe Room, Executive Suite, Presidential Suite', 'Free WiFi, Pool, Spa, Eco-Friendly Restaurant'),
(5, 'Hyatt Regency', 'Riverside, Bangkok', 'This stunning riverside retreat offers a perfect blend of elegance, comfort, and Thai charm. Enjoy panoramic river views from beautifully appointed rooms, indulge in world-class dining at award-winning restaurants, and unwind with rejuvenating treatments at a full-service spa. Whether you\'re relaxing in lush gardens or exploring the vibrant heart of Bangkok just moments away, this riverside haven promises a truly unforgettable stay.', 180.00, 4.9, 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80', 1, 0, 'https://example.com/beachfront-paradise', 'Deluxe Room, Executive Suite, Presidential Suite', 'Free High-Speed WiFi, Rooftop Infinity Pool, 4 Restaurants & Bars, Eforea Spa, 24/7 Fitness Center, Concierge Service, Business Center, Kids Club'),
(6, 'Hilton Sukhumvit', 'Sukhumvit, Bangkok', 'Nestled in the heart of Bangkok\'s vibrant Sukhumvit district, Hilton Sukhumvit offers a sophisticated urban retreat with sleek modern design, world-class amenities, and warm Thai hospitality. Guests can enjoy rooftop dining, a stunning infinity pool, and easy access to shopping, nightlife, and the BTS Skytrain, making it perfect for both business and leisure travelers.', 95.00, 4.6, 'https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80', 1, 0, 'https://example.com/desert-oasis-hotel', 'Deluxe Room, Executive Suite, Presidential Suite', 'Free High-Speed WiFi, Rooftop Infinity Pool, 4 Restaurants & Bars, Eforea Spa, 24/7 Fitness Center, Concierge Service, Business Center, Kids Club');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`) VALUES
(3, 'name1', 'name1@gmail.com', '54645645', 'name1', 'user'),
(4, 'admin', 'admin@gmail.com', '45456456', 'admin', 'admin'),
(6, 'john', 'john@gmail.com', '1111111111', 'john', 'user'),
(9, 'jenny', 'jenny@gmail.com', '1234567893', 'jenny', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
