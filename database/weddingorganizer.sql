-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 07:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weddingorganizer`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `services_name` varchar(40) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_name`, `email`, `event_date`, `services_name`, `status`) VALUES
(1, 'Bella', 'rico.putra1733@gmail.com', '2024-06-15', 'Paket Wedding 1', 'Approved'),
(2, 'Rico Putra', 'inyourdream171@gmail.com', '2024-06-25', 'Paket Wedding 2', 'Requested');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` text NOT NULL,
  `time_cr` timestamp NOT NULL DEFAULT current_timestamp(),
  `time_up` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `img` varchar(255) DEFAULT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `note`, `time_cr`, `time_up`, `img`, `harga`) VALUES
(1, 'Paket Wedding 1', 'Paket yang disediakan :<br />\r\n1. Tamu yang dapat hadir 300 undangan<br />\r\n2. Pondok makanan terdiri dari 3 pondok<br />\r\n3. Makanan pada pondok dapat dipilih (bakso , siomay, es krim)<br />\r\n4. Untuk penjaga tamu terdapat 6 orang (3 laki-laki 3 perempuan)<br />\r\n5. Untuk bagian penunggu buku tamu terdapat 4 orang<br />\r\n6. Tidak terdapat orgen tunggal', '2024-06-15 07:49:07', '2024-06-15 13:11:05', 'wedding.jpg', '55.000.000'),
(2, 'Paket Wedding 2', 'Paket yang disediakan :<br>\r\n1. Tamu yang dapat hadir 500 undangan<br>\r\n2. Pondok makanan terdiri dari 4 pondok<br>\r\n3. Makanan pada pondok dapat dipilih ( Bakso, sate kulit, es krim, buah buahan)<br>\r\n4. Untuk penjaga tamu terdapat 6 orang (3 laki-laki 3 perempuan)<br>\r\n5. Untuk bagian penunggu buku tamu terdapat 4 orang', '2024-06-15 13:16:32', '2024-06-15 14:34:56', 'wo1.png', '65.000.000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'dewarinjani', '4297f44b13955235245b2497399d7a93'),
(2, 'ricoputra17', 'ad48af6a529daac1566ed6bd8cf21128');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
