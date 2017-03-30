-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 26, 2017 at 11:47 PM
-- Server version: 5.7.16
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiwi`
--

-- --------------------------------------------------------
DROP TABLE IF EXISTS `history`;
DROP TABLE IF EXISTS `parts`;
DROP TABLE IF EXISTS `robots`;
DROP TABLE IF EXISTS `properties`;
--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `timestamp` datetime NOT NULL,
  `transactionType` varchar(20) NOT NULL,
  `item` varchar(20) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `fromPlant` varchar(20) NOT NULL,
  `toPlant` varchar(20) NOT NULL,
  `line` varchar(20) NULL,
  `model` varchar(20) NULL,
  `piece` varchar(20) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`timestamp`, `transactionType`, `item`, `cost`, `fromPlant`, `toPlant`, `line`, `model`, `piece`) VALUES
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Household', 'A', 'Top'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Butler', 'M', 'Top'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Household', 'C', 'Torso'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Household', 'F', 'Bottom'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Household', 'H', 'Top'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Companion', 'Y', 'Torso'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Household', 'L', 'Bottom'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Companion', 'Z', 'Top'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Butler', 'N', 'Torso'),
('2013-08-30 19:05:00', 'Purchase', 'Box of Parts', 10.00, 'PRC', 'kiwi', 'Butler', 'P', 'Torso'),
('2017-01-13 8:30:00', 'Return', 'Part', 7.00, 'kiwi', 'PRC', 'Butler', 'P', 'Torso'),
('2017-01-13 8:30:00', 'Built', 'Part', 0.00, 'PRC', 'kiwi', 'Household', 'B', 'Top'),
('2017-01-13 8:30:00', 'Purchase', 'Part', 7.00, 'apple', 'kiwi', 'Household', 'F', 'Bottom'),
('2017-01-13 8:30:00', 'Sold', 'Part', 15.00, 'kiwi', 'apple', 'Butler', 'O', 'Top'),
('2017-01-13 8:30:00', 'Sold', 'Assembled Bot', 15.00, 'kiwi', 'PRC', 'Butler', 'M', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `caCode` varchar(20) NOT NULL,
  `partCode` varchar(16) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `plant` varchar(20) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`caCode`, `partCode`, `amount`, `plant`, `timestamp`) VALUES
('28nf37', 'a1', '2.00', 'Berry', '2013-08-30 20:05:00'),
('37vn56', 'a2', '1.00', 'Apple', '2013-08-30 20:05:00'),
('93ng67', 'a3', '5.00', 'Banana', '2013-08-30 20:05:00'),
('44fj99', 'b1', '5.00', 'Berry', '2013-08-30 20:05:00'),
('85bv73', 'b2', '5.00', 'Apple', '2013-08-30 20:05:00'),
('85vn27', 'b3', '5.00', 'Banana', '2013-08-30 20:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `robots`
--

CREATE TABLE `robots` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `partCodes` varchar(30) NOT NULL,
  `caCodes` varchar(30) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `robots`
--

INSERT INTO `robots` (`partCodes`, `caCodes`, `amount`) VALUES
('a1,a2,a3', '32cc94,73bc91,92ud74', '8.00'),
('b1,b2,b3', '84bd92,29fk26,27fm05', '15.00');


-- --------------------------------------------------------

--
-- Table structure for table `robots`
--

CREATE TABLE `properties` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `apikey` varchar(10) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
