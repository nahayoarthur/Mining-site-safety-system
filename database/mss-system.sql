-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 07:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mss-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `site-1`
--

CREATE TABLE `site-1` (
  `id` int(11) NOT NULL,
  `lpg` float NOT NULL,
  `smoke` float NOT NULL,
  `alcohol` float NOT NULL,
  `propane` float NOT NULL,
  `hydrogen` float NOT NULL,
  `methane` float NOT NULL,
  `carbon` float NOT NULL,
  `temp` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site-1`
--

INSERT INTO `site-1` (`id`, `lpg`, `smoke`, `alcohol`, `propane`, `hydrogen`, `methane`, `carbon`, `temp`, `status`, `time`) VALUES
(2, 54, 23, 23, 433, 234, 453, 345, 654, 0, '2022-11-09 00:19:11'),
(3, 543, 543, 245, 5345, 54343, 5345, 2356, 654, 0, '2022-11-17 21:09:35'),
(4, 2345, 654, 5564, 765, 4346, 6534, 65434, 34553, 0, '2022-11-17 21:09:35'),
(5, 543, 543, 543, 5434, 534, 65, 654, 675, 0, '2022-11-18 14:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `phone`) VALUES
(1, 'Admin', 'Admin@123', '0786983762'),
(4, 'mustapha', '123', '7453943348');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `site-1`
--
ALTER TABLE `site-1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `site-1`
--
ALTER TABLE `site-1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
