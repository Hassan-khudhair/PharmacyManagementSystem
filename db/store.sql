-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 11:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic` varchar(111) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `details` varchar(333) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `pic`, `details`, `date`) VALUES
(34, 'كبسول', 'capsollll.jpg', '', '2023-02-22 10:09:20'),
(35, 'حبوب', 'hopooop.jpg', '', '2023-02-22 10:11:27'),
(37, 'حقن', 'opperrrr.jpg', '', '2023-05-10 17:32:21'),
(38, 'تجميل', 'pexels-valeriia-miller-3685530.jpg', '', '2023-05-10 17:38:38');

-- --------------------------------------------------------

--
-- Table structure for table `inventeries`
--

CREATE TABLE `inventeries` (
  `id` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `generic_name` varchar(50) NOT NULL,
  `medicine_name` varchar(50) NOT NULL,
  `barcode` varchar(20) DEFAULT NULL,
  `expdate` varchar(25) NOT NULL,
  `supplier` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unit` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `pic` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company` varchar(111) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inventeries`
--

INSERT INTO `inventeries` (`id`, `catId`, `generic_name`, `medicine_name`, `barcode`, `expdate`, `supplier`, `unit`, `price`, `quantity`, `pic`, `description`, `company`, `date`) VALUES
(61, 34, 'Tylenol', 'Acetaminophen	', '123456789012', '2024-05-31	', 'belgrahm', '500 mg', '6500', 95, '', 'no thing', 'Johnson & Johnson	', '2023-05-10 17:44:12'),
(62, 35, 'Lipitor', 'Atorvastatin', '123456789012', '2023-12-31	', 'belgrahm', '40 mg', '4000', 90, '', '..', 'Pfizer', '2023-05-10 17:53:56'),
(63, 37, 'Crestor', 'Rosuvastatin', '234567890123', '2023-09-30	', 'belgrahm', '10 mg', '6800', 50, '', '..', 'AstraZeneca', '2023-05-10 17:55:01'),
(64, 37, 'Zestril', 'Lisinopril', '345678901234', '2024-02-28	', 'hassan', '10 mg', '11400', 30, '', '..', 'AstraZeneca', '2023-05-10 17:56:05'),
(65, 37, 'Norvasc', 'Amlodipine', '456789012345', '2023-11-30	', 'belgrahm', '5 mg', '23400', 90, '', '..', 'Pfizer', '2023-05-10 17:57:18'),
(66, 34, 'Cozaar', 'Losartan', '567890123456', '2023-08-31	', 'belgrahm', '50 mg', '3400', 25, '', '..', 'Merck', '2023-05-10 17:58:19'),
(67, 34, 'Altace', 'Ramipril', '678901234567', '2021-06-30	', 'hassan', '10 mg', '3000', 100, '', ',,', 'Monarch', '2023-05-10 17:59:26'),
(68, 35, 'Lopressor', 'Metoprolol', '789012345678', '2024-01-31	', 'belgrahm', '25 mg', '34800', 20, '', '..', 'Novartis', '2023-05-10 18:00:40'),
(69, 38, 'Tenormin', 'Atenolol', '890123456789', '2023-05-31	', 'belgrahm', '50 mg', '4000', 100, '', '..', 'AstraZeneca', '2023-05-10 18:27:43'),
(70, 35, 'Coumadin', 'Warfarin', '901234567890', '2023-11-30	', 'hassan', '5 mg', '15000', 30, '', '..', 'Bristol-Myers Squibb	', '2023-05-10 18:28:55'),
(71, 37, 'Plavix', 'Clopidogrel', '012345678901', '2023-10-31	', 'belgrahm', '75 mg', '34000', 28, '', '..', 'Sanofi', '2023-05-10 18:31:13'),
(72, 37, 'Pradaxa', 'Dabigatran', '123456789012', '2024-02-28	', 'belgrahm', '150 mg', '279000', 60, '', '..', 'Boehringer Ingelheim	', '2023-05-10 18:32:40'),
(73, 34, 'Xarelto', 'Rivaroxaban', '234567890123', '2023-06-30	', 'belgrahm', '20 mg', '299000', 20, '', '..', 'Bayer', '2023-05-10 18:33:35'),
(74, 35, 'Eliquis', 'Apixaban', '345678901234', '2021-06-30	', 'belgrahm', '20 mg', '24400', 20, '', '..', 'Bayer', '2023-05-10 18:34:47'),
(75, 38, 'Humalog', 'Insulin lispro	', '456789012345', '2023-12-31	', 'hassan', '100 units', '99000', 30, '', '..', 'Eli Lilly	', '2023-05-10 18:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `title` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `title`, `name`) VALUES
(1, 'Pharmacy Management System', 'صيدلية الرحمة');

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

CREATE TABLE `sold` (
  `id` int(11) NOT NULL,
  `item` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `amount` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`id`, `item`, `amount`, `userId`, `date`) VALUES
(39, '2', '11', 2, '2023-02-21 12:46:55'),
(40, '3', '16', 2, '2023-02-21 12:49:42'),
(41, '2', '11', 2, '2023-02-21 17:54:50'),
(42, '1', '5', 4, '2023-02-23 12:49:22'),
(43, '1', '-5', 4, '2023-03-30 22:49:03'),
(44, '0', '0', 4, '2023-03-31 14:44:15'),
(45, '0', '0', 4, '2023-03-31 14:45:53'),
(46, '0', '0', 4, '2023-03-31 14:46:31'),
(47, '0', '0', 4, '2023-03-31 14:47:02'),
(48, '0', '0', 4, '2023-03-31 14:51:42'),
(49, '0', '0', 4, '2023-03-31 14:51:52'),
(50, '0', '0', 4, '2023-03-31 14:53:25'),
(51, '0', '0', 4, '2023-03-31 14:55:22'),
(52, '0', '0', 4, '2023-03-31 14:55:27'),
(53, '0', '0', 4, '2023-03-31 14:55:31'),
(54, '0', '0', 4, '2023-03-31 14:56:01'),
(55, '0', '0', 4, '2023-03-31 14:56:28'),
(56, '0', '0', 4, '2023-03-31 17:18:23'),
(57, '1', '60', 4, '2023-04-01 17:56:54'),
(58, '1', '60', 4, '2023-04-01 18:07:42'),
(59, '2', '120', 4, '2023-05-04 23:19:07'),
(60, '2', '120', 4, '2023-05-04 23:20:08'),
(61, '6', '360', 4, '2023-05-04 23:22:15'),
(62, '12', '720', 4, '2023-05-05 10:49:29'),
(63, '11', '360', 4, '2023-05-10 12:57:02'),
(64, '5', '32500', 4, '2023-05-11 09:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` text NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cnic` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `name` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pic` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `number` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `pic`, `number`, `date`) VALUES
(4, 'hassan@gmail.com', '1234', 'hassan', 'pngwing.png', '07831928333', '2023-02-01 06:50:09'),
(5, 'hothefa@gmail.com', '1234', 'hothefa', '', '024989274', '2023-05-12 08:05:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventeries`
--
ALTER TABLE `inventeries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold`
--
ALTER TABLE `sold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `inventeries`
--
ALTER TABLE `inventeries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sold`
--
ALTER TABLE `sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
