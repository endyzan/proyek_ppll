-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2025 at 05:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_ppll`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `rating`) VALUES
(1, 'Hydrating Facial Cleanser', 85000, 'Pembersih wajah dengan formula lembut untuk menjaga kelembapan kulit.', 'skincare1.jpg', 5),
(2, 'Brightening Serum Vitamin C', 125000, 'Serum dengan Vitamin C untuk mencerahkan kulit dan meratakan warna kulit.', 'skincare2.jpg', 5),
(3, 'Moisturizer Aloe Vera Gel', 65000, 'Gel aloe vera untuk menenangkan dan melembapkan kulit sensitif.', 'skincare3.jpg', 4),
(4, 'Sunscreen SPF 50 PA++++', 99000, 'Tabir surya perlindungan tinggi untuk penggunaan sehari-hari.', 'skincare4.jpg', 5),
(5, 'Niacinamide 10% Treatment', 115000, 'Serum niacinamide untuk mengurangi minyak berlebih dan pori-pori besar.', 'skincare5.jpg', 4),
(6, 'Anti Acne Spot Gel', 77000, 'Gel khusus untuk mengatasi jerawat dan mengurangi kemerahan.', 'skincare6.jpg', 4),
(7, 'Retinol Night Cream', 140000, 'Krim malam dengan retinol untuk memperbaiki tekstur kulit.', 'skincare7.jpg', 5),
(8, 'Hyaluronic Acid Hydration Booster', 120000, 'Booster pelembap dengan hyaluronic acid untuk kulit ekstra kering.', 'skincare8.jpg', 5),
(9, 'Soothing Toner Chamomile', 69000, 'Toner dengan ekstrak chamomile untuk menenangkan kulit iritasi.', 'skincare9.jpg', 4),
(10, 'Makeup Remover Micellar Water', 55000, 'Pembersih micellar yang lembut untuk menghapus makeup secara efektif.', 'skincare5.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `photo`, `address`, `phone`, `password`, `created_at`, `role`) VALUES
(2, 'andi', 'andi@gmail.com', '1764231862_1764231252_ppadmin.jpg', 'perumahan graha mentari, bangkalan, jawa timur', '08891231231', '$2y$10$5Xnn1nQ7/C3u8p.KrpeKaOfO8zvqX3YHxEASSrFMKs42N.H7iDidy', '2025-11-27 07:33:20', 'user'),
(5, 'adminkeceboy', 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$p3bhtxKMgZHVaxUiEkKnsO86FSojGQxZvCROMHBpQh1ipEtCzQufu', '2025-11-27 07:44:46', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
