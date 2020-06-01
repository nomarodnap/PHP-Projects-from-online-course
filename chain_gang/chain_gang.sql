-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 04:06 PM
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
-- Database: `chain_gang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `username`, `hashed_password`) VALUES
(1, 'Kongkiat', 'Aramkhachondej', 'infrezz@gmail.com', 'kongkiat', '$2y$10$v/TOoUuLK5TFeDmrt9UC4OCUqrv3bVhBVcwLV.xcOo1lOc2jL5Oi.');

-- --------------------------------------------------------

--
-- Table structure for table `bicycles`
--

CREATE TABLE `bicycles` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `category` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `weight_kg` decimal(9,5) NOT NULL,
  `condition_id` tinyint(3) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bicycles`
--

INSERT INTO `bicycles` (`id`, `brand`, `model`, `year`, `category`, `gender`, `color`, `price`, `weight_kg`, `condition_id`, `description`) VALUES
(1, 'Trek', 'Emonda', 2017, 'Hybrid', 'Unisex', 'black', '1495.00', '1.50000', 5, ''),
(2, 'Cannondale', 'Synapse', 2016, 'Road', 'Unisex', 'matte black', '1999.00', '1.00000', 5, ''),
(3, 'Schwinn', 'Cutter', 2016, 'City', 'Unisex', 'white', '450.00', '18.00000', 4, ''),
(4, 'Mongoose', 'Switchback Sport', 2015, 'Mountain', 'Mens', 'blue', '399.00', '24.00000', 2, ''),
(5, 'Diamondback', 'Overdrive', 2016, 'Mountain', 'Unisex', 'dark green', '565.00', '23.70000', 3, ''),
(7, 'test', 'test', 2001, 'Road', 'Mens', 'tses', '120.00', '100.00000', 3, 'ttte'),
(8, 'fasdas', 'test', 2002, 'Road', 'Womens', 'xdad', '111.00', '11.00000', 3, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bicycles`
--
ALTER TABLE `bicycles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bicycles`
--
ALTER TABLE `bicycles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
