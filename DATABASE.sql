-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 03:12 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'admin@admin.com', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `Newindex` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `Oldindex` int(11) NOT NULL,
  `KW` int(11) NOT NULL,
  `klw` int(11) NOT NULL,
  `rentalbill` int(11) NOT NULL,
  `total_to_pay` int(11) NOT NULL,
  `to_pay_before` date NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`Newindex`, `id`, `Oldindex`, `KW`, `klw`, `rentalbill`, `total_to_pay`, `to_pay_before`, `tenant_id`, `email`) VALUES
(10, 41, 7, 100, 300, 12000, 12300, '2023-09-06', 10, 'lion@gmail.com'),
(865, 42, 852, 100, 1300, 20000, 21300, '2023-09-06', 12, 'black@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `deletetenant`
--

CREATE TABLE `deletetenant` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deletetenant`
--

INSERT INTO `deletetenant` (`id`, `email`, `deltime`) VALUES
(26, 'lion@gmail.com', '2023-08-30 13:52:07'),
(27, 'lion@gmail.com', '2023-08-30 13:52:25'),
(28, 'lion@gmail.com', '2023-08-30 13:52:31'),
(29, 'lion@gmail.com', '2023-08-30 13:55:10'),
(30, 'black@gmail.com', '2023-08-30 15:29:51'),
(31, 'black@gmail.com', '2023-09-01 10:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `sender`, `reciver`, `title`, `feedbackdata`, `attachment`) VALUES
(1, 'lion@gmail.com', 'Admin', 'Payment bill', '20000XAF', '1tympnnocqb21.jpg'),
(2, 'Admin', 'lion@gmail.com', '', 'Payment received', '');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notiuser`, `notireciver`, `notitype`, `time`) VALUES
(1, 'thierry@gmail.com', 'Admin', 'Create Account', '2023-08-14 19:04:00'),
(2, 'lion@gmail.com', 'Admin', 'Send Feedback', '2023-08-15 10:38:41'),
(3, 'black@gmail.com', 'Admin', 'Create Account', '2023-08-25 12:20:20'),
(4, 'black@gmail.com', 'Admin', 'Create Account', '2023-08-25 13:06:46'),
(5, 'black@gmail.com', 'Admin', 'Create Account', '2023-08-25 13:08:20'),
(6, 'lion@gmail.com', 'Admin', 'Create Account', '2023-08-25 14:59:04'),
(7, 'Admin', 'lion@gmail.com', 'Send Message', '2023-08-27 23:08:24'),
(8, 'black@gmail.com', 'Admin', 'Create Account', '2023-08-30 09:36:36'),
(9, 'black@gmail.com', 'Admin', 'Create Account', '2023-08-30 09:46:49'),
(10, 'lion@gmail.com', 'Admin', 'Create Account', '2023-08-30 13:27:07'),
(11, 'black@gmail.com', 'Admin', 'Create Account', '2023-08-30 15:29:43'),
(12, 'black@gmail.com', 'Admin', 'Create Account', '2023-09-01 10:16:07'),
(13, 'black@gmail.com', 'Admin', 'Create Account', '2023-09-01 10:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_type` varchar(255) NOT NULL,
  `room_price` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `roomtype` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `name`, `roomname`, `email`, `password`, `gender`, `mobile`, `roomtype`, `status`) VALUES
(10, 'Lion', 'B2', 'lion@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Male', '677764537', 'Simple', 1),
(12, 'Big Cork Black', 'C3', 'black@gmail.com', '4a7d1ed414474e4033ac29ccb8653d9b', 'Male', '654323488', 'Modern', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `deletetenant`
--
ALTER TABLE `deletetenant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`),
  ADD UNIQUE KEY `tenant_id` (`tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `deletetenant`
--
ALTER TABLE `deletetenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
