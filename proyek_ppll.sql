-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2025 at 04:17 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.27

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
-- Table structure for table `discoveries`
--

CREATE TABLE `discoveries` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `undertone` enum('warm','cool','neutral') NOT NULL,
  `depth` enum('light','medium','deep') NOT NULL,
  `skin_type` enum('normal','dry','oily','combination','sensitive') NOT NULL,
  `recommendation` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `discoveries`
--

INSERT INTO `discoveries` (`id`, `title`, `undertone`, `depth`, `skin_type`, `recommendation`, `created_at`) VALUES
(1, 'Fresh Glow Foundation', 'warm', 'light', 'normal', 'Rekomendasi untuk kulit warm-light dengan tekstur ringan dan hasil akhir glowing. Cocok digunakan untuk aktivitas harian.', '2025-11-30 12:48:19'),
(2, 'Deep Radiance Serum', 'cool', 'deep', 'dry', 'Serum ini cocok untuk undertone cool dan depth deep, memberikan hidrasi intens tanpa membuat kulit terasa berat.', '2025-11-30 12:48:19'),
(3, 'Soft Matte Cushion', 'neutral', 'medium', 'oily', 'Cushion dengan hasil matte yang cocok untuk kulit berminyak dengan undertone dan depth neutral-medium.', '2025-11-30 12:48:19'),
(4, 'Hydrabalance Cream', 'warm', 'medium', 'combination', 'Krim pelembab untuk kulit kombinasi dengan undertone warm. Membantu menyeimbangkan minyak dan kelembapan.', '2025-11-30 12:48:19'),
(5, 'Calming Skin Mist', 'cool', 'light', 'sensitive', 'Mist ringan untuk kulit sensitif dengan undertone cool-light. Membantu menenangkan iritasi dan memberikan sensasi dingin.', '2025-11-30 12:48:19'),
(6, 'Ultra Deep Hydration Gel', 'neutral', 'deep', 'dry', 'Gel pelembab intens untuk depth deep dan undertone neutral. Cocok untuk kulit kering yang membutuhkan hidrasi ekstra.', '2025-11-30 12:48:19'),
(7, 'Bright Tone Essence', 'warm', 'light', 'oily', 'Essence yang membantu mengontrol minyak berlebih dan mencerahkan tampilan kulit warm-light.', '2025-11-30 12:48:19'),
(8, 'Perfect Matte Primer', 'cool', 'medium', 'oily', 'Primer matte yang cocok untuk depth medium dan undertone cool. Membantu mengontrol minyak dan membuat makeup lebih tahan lama.', '2025-11-30 12:48:19'),
(9, 'Daily Repair Moisturizer', 'neutral', 'medium', 'normal', 'Moisturizer harian untuk kulit normal dengan undertone neutral-medium. Melembutkan dan meratakan tekstur kulit.', '2025-11-30 12:48:19'),
(10, 'Soothing Barrier Balm', 'warm', 'deep', 'sensitive', 'Balm perlindungan kulit untuk undertone warm dan depth deep yang sensitif. Membantu memperkuat skin barrier dan mengurangi kemerahan.', '2025-11-30 12:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `status` enum('Pending','Diproses','Dikirim','Selesai','Dibatalkan') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `total` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`, `name`, `phone`, `address`, `total`) VALUES
(1, 2, 140000, 'Pending', '2025-12-01 15:25:20', 'andi', '08891231231', 'adasd', 140000),
(2, 2, 120000, 'Pending', '2025-12-01 15:59:36', 'andi', '08891231231', 'perumahan graha mentari, bangkalan, jawa timur', 120000);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 7, 1, 140000),
(2, 2, 8, 1, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int DEFAULT '5'
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
-- Table structure for table `sharing`
--

CREATE TABLE `sharing` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sharing`
--

INSERT INTO `sharing` (`id`, `user_id`, `judul`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 5, 'Tips Merawat Kulit Kering', 'Perawatan kulit kering meliputi menjaga kelembapan dengan menggunakan pelembap secara rutin, menghindari air panas, dan memakai sabun berbahan lembut. Penting juga untuk minum air yang cukup, menggunakan tabir surya, dan melindungi kulit dari paparan sinar matahari serta udara dingin. Selain itu, gunakan pelembap udara (humidifier) dan pilih produk skincare dengan kandungan yang tepat.  \r\nPerawatan harian\r\nGunakan pelembap rutin: Oleskan pelembap setelah mandi dan sebelum tidur untuk menjaga kelembapan kulit. \r\nPilih sabun yang lembut: Gunakan sabun pembersih wajah atau sabun mandi yang tidak mengandung pewangi dan berbahan lembut. \r\nHindari air panas: Cuci muka atau mandi dengan air hangat atau suam-suam kuku, bukan air panas yang bisa menghilangkan minyak alami kulit. \r\nLindungi dari matahari: Gunakan tabir surya dengan minimal SPF 30 setiap kali beraktivitas di luar ruangan. \r\nMinum air cukup: Pastikan kebutuhan cairan tubuh terpenuhi dengan minum air putih yang cukup setiap hari. \r\nPerawatan tambahan\r\nGunakan pelembap udara (humidifier): Ini membantu menjaga kelembapan udara di dalam ruangan, terutama jika Anda berada di lingkungan ber-AC atau cuaca dingin. \r\nLindungi dari udara dingin: Gunakan pakaian tertutup untuk melindungi kulit dari paparan langsung udara dingin. \r\nLakukan eksfoliasi: Lakukan eksfoliasi secara rutin untuk mengangkat sel kulit mati, namun hindari menggosok kulit terlalu keras. \r\nPertimbangkan bahan alami: Beberapa bahan alami seperti minyak kelapa, madu, atau lidah buaya bisa membantu melembapkan kulit. \r\nPerawatan dari dalam\r\nPerbanyak konsumsi makanan sehat: Konsumsi makanan kaya antioksidan (seperti bluberi dan tomat) dan asam lemak omega-3 (seperti ikan salmon) dapat membantu menyehatkan kulit. \r\nPerhatikan kandungan skincare: Pilih produk yang mengandung bahan pelembap seperti niacinamide (vitamin B3), hyaluronic acid, atau ceramides. ', '1764580521_kulit kering.jpeg', '2025-12-01 16:15:21', '2025-12-01 16:15:21'),
(3, 5, 'Tips Merawat Kulit Wajah', 'Merawat kulit wajah melibatkan pembersihan rutin (pagi dan malam), penggunaan pelembap dan tabir surya (SPF 30 atau lebih), serta penerapan pola hidup sehat seperti minum air cukup, makan bergizi, istirahat cukup, dan olahraga teratur. Rutin melakukan eksfoliasi dan menggunakan serum juga membantu memperbaiki kondisi kulit.  \r\nPerawatan dasar harian\r\nBersihkan wajah dua kali sehari: Cuci wajah di pagi hari dan sebelum tidur untuk mengangkat kotoran dan minyak. Gunakan sabun pembersih yang sesuai dengan jenis kulit Anda. \r\nGunakan pelembap: Aplikasikan pelembap setelah mencuci muka untuk menjaga kelembapan kulit sepanjang hari. \r\nLindungi dengan tabir surya: Gunakan tabir surya khusus wajah dengan SPF minimal 30 setiap hari, bahkan saat cuaca mendung, untuk melindungi dari sinar UV. \r\nPerawatan tambahan\r\nEksfoliasi: Lakukan eksfoliasi secara rutin untuk mengangkat sel kulit mati yang menumpuk. \r\nGunakan serum: Serum, seperti yang mengandung vitamin C atau retinoid, dapat membantu menutrisi kulit, melawan radikal bebas, dan meremajakan kulit. \r\nHindari memencet jerawat: Hindari memencet jerawat karena dapat menyebabkan infeksi dan bekas luka yang permanen. \r\nGaya hidup sehat\r\nMinum air cukup: Konsumsi air yang cukup untuk menjaga hidrasi kulit. \r\nMakan makanan bergizi: Konsumsi makanan kaya vitamin, mineral, dan antioksidan untuk kesehatan kulit. \r\nIstirahat cukup: Tidur yang cukup sangat penting untuk proses regenerasi kulit. \r\nOlahraga teratur: Olahraga membantu meningkatkan sirkulasi darah ke kulit. \r\nHindari merokok: Merokok dapat merusak kolagen dan elastin kulit, membuatnya terlihat kusam dan lebih tua.', '1764580692_merawat kulit wajah.jpeg', '2025-12-01 16:18:12', '2025-12-01 16:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  `telpon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `nim`, `image`, `email`, `instagram`, `telpon`) VALUES
(1, 'Reyhan Aditya', '21 - 122', 'reyhan.jpg', 'reyhan@gmail.com', '@reyhan', '081234567001'),
(2, 'Rifan Afandi', '210411100128', '1764578446_5642.jpg', 'affandy@gmail.com', '@affandy', '081234567002'),
(3, 'Hasan Basri', '21 - 169', 'hasan.jpg', 'hasan@gmail.com', '@hasan', '081234567003'),
(4, 'Jaisyatul Mar’ah', '210411100209', '1764578481_4740.jpg', 'jaisyatul@gmail.com', '@jaisyatul', '081234567004'),
(5, 'Mochammad Ramadika A.P', '22 - 004', 'ramadika.jpg', 'ramadika@gmail.com', '@ramadika', '081234567005'),
(6, 'Vicky Ardiyanshah', '22 - 124', 'vicky.jpg', 'vicky@gmail.com', '@vicky', '081234567006'),
(7, 'Ahmad Andi Zainuri', '220411100176', '1764578655_2370.jpg', 'andizainuri5@gmail.com', '@andizaynury', '088989462277'),
(8, 'Aurellia Zhullvita Amanullah', '220411100200', '1764578610_3242.jpg', 'aurelliazhulvita@gmail.com', '@zazhu.io', '081234567008'),
(9, 'admin', '123123', '1764231862_1764231252_ppadmin.jpg', 'admin@gmail.com', 'admin', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indexes for table `discoveries`
--
ALTER TABLE `discoveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sharing`
--
ALTER TABLE `sharing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sharing_user` (`user_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
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
-- AUTO_INCREMENT for table `discoveries`
--
ALTER TABLE `discoveries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sharing`
--
ALTER TABLE `sharing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sharing`
--
ALTER TABLE `sharing`
  ADD CONSTRAINT `fk_sharing_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
