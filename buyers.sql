-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 08:20 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buyer_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `items` varchar(255) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `buyer_ip` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hash_key` varchar(20) NOT NULL,
  `entry_at` date NOT NULL,
  `entry_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES
(1, 10, 'Rajesh 2', 'recthree', 'a:3:{i:0;s:3:\"one\";i:1;s:3:\"two\";i:2;s:5:\"three\";}', 'rajeshkuet@gmail.com', '::1', 'excellent', 'Katiadi Kishoreganj', '1742924486', '05f70341078acf6a06d4', '2021-06-17', 101),
(2, 20, 'Ashik', 'rectwo', 'a:1:{i:0;s:3:\"one\";}', 'ashik027@gmail.com', '::1', 'best deal', 'Khulna', '1676094501', '05f70341078acf6a06d4', '2021-06-17', 201),
(3, 10, 'Rajesh', 'recthree', 'a:3:{i:0;s:3:\"one\";i:1;s:3:\"two\";i:2;s:5:\"three\";}', 'rajeshkuet@gmail.com', '::1', 'excellent', 'Katiadi Kishoreganj', '1742924486', '05f70341078acf6a06d4', '2021-06-18', 101),
(4, 20, 'Ashik 2', 'rectwo', 'a:1:{i:0;s:3:\"one\";}', 'ashik027@gmail.com', '::1', 'best deal', 'Khulna', '1676094501', '05f70341078acf6a06d4', '2021-06-18', 201),
(5, 100, 'XpeedStudio', 'recone', 'a:2:{i:0;s:3:\"one\";i:1;s:3:\"two\";}', 'info@xpeedstudio.com', '::1', 'good one', 'Dhaka', '1912999999', '05f70341078acf6a06d4', '2021-06-19', 1001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
