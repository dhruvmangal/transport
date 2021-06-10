-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 02:14 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(200) NOT NULL,
  `city_zone` varchar(10) NOT NULL,
  `city_time` time NOT NULL,
  `city_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `city_zone`, `city_time`, `city_date`) VALUES
(2, 'Delhi', 'N', '06:47:46', '2020-08-20'),
(3, 'Noida', 'N', '06:50:00', '2020-08-20'),
(4, 'Gaziabad', 'N', '06:50:18', '2020-08-20'),
(5, 'Jaipur', 'NW', '06:51:16', '2020-08-20'),
(6, 'Ajmer', 'NW', '06:51:28', '2020-08-20'),
(7, 'Jodhpur', 'NW', '06:51:42', '2020-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `consigner`
--

CREATE TABLE `consigner` (
  `consigner_id` int(11) NOT NULL,
  `consigner_name` varchar(200) NOT NULL,
  `consigner_addr1` varchar(200) NOT NULL,
  `consigner_addr2` varchar(200) NOT NULL,
  `consigner_cft` int(11) NOT NULL,
  `consigner_fsc` int(11) NOT NULL,
  `consigner_rov` int(11) NOT NULL,
  `consigner_oda` int(11) NOT NULL,
  `consigner_time` time NOT NULL,
  `consigner_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consigner`
--

INSERT INTO `consigner` (`consigner_id`, `consigner_name`, `consigner_addr1`, `consigner_addr2`, `consigner_cft`, `consigner_fsc`, `consigner_rov`, `consigner_oda`, `consigner_time`, `consigner_date`) VALUES
(10, 'Dhruv Mangal', 'sakjcbkj', 'jksabjk', 10, 10, 10, 10, '08:10:07', '2020-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `rate_id` int(11) NOT NULL,
  `consigner_id` int(11) NOT NULL,
  `transport_rate` int(11) NOT NULL,
  `logistics_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`rate_id`, `consigner_id`, `transport_rate`, `logistics_rate`) VALUES
(2, 10, 12, 13);

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `transport_id` int(11) NOT NULL,
  `transport_company` varchar(200) NOT NULL,
  `transport_time` time NOT NULL,
  `transport_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`transport_id`, `transport_company`, `transport_time`, `transport_date`) VALUES
(1, 'Delhivery', '18:12:26', '2020-08-19'),
(2, 'ATDC', '18:44:54', '2020-08-19'),
(3, 'ECart', '18:45:09', '2020-08-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `consigner`
--
ALTER TABLE `consigner`
  ADD PRIMARY KEY (`consigner_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`transport_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `consigner`
--
ALTER TABLE `consigner`
  MODIFY `consigner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transport`
--
ALTER TABLE `transport`
  MODIFY `transport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
