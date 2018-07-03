-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2018 at 05:04 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_dan_meredith_php_car_rental`
--
CREATE DATABASE IF NOT EXISTS `cr11_dan_meredith_php_car_rental` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cr11_dan_meredith_php_car_rental`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `zip` int(11) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `area` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `zip`, `city`, `country`, `area`) VALUES
(1, 1030, 'Wien', 'Österreich', 'Petrusgasse 18'),
(2, 4203, 'Linz', 'Österreich', 'Reichenauer Str. 4'),
(3, 5020, 'Salzburg', 'Österreich', 'Getreidegasse 9'),
(4, 8010, 'Graz', 'Österreich', 'Hans-Sachs-Gasse 14');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(11) NOT NULL,
  `car_name` varchar(40) DEFAULT NULL,
  `car_type` varchar(40) DEFAULT NULL,
  `status` enum('available','reserved') DEFAULT NULL,
  `fk_office_id` int(11) DEFAULT NULL,
  `module` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `car_name`, `car_type`, `status`, `fk_office_id`, `module`) VALUES
(1, 'TESLA Model S', 'EV', 'available', 1, '2017'),
(2, 'Range Rover ', 'SUV', 'available', 1, '2015'),
(3, 'Range Rover Sport', 'SUV', 'reserved', 2, '2018'),
(4, 'Bentley Continental', 'GT', 'reserved', 1, '2016'),
(5, 'Jaguar i-Pace', 'EV', 'available', 1, '2017'),
(6, 'Audi A4', 'Saloon', 'reserved', 2, '2016'),
(7, 'Vauxhall Astra', 'Hatchback', 'reserved', 2, '2013'),
(8, 'BMW M4', 'Coupe', 'available', 2, '2012'),
(9, 'Bugatti Chiron', 'Hypercar', 'available', 2, '2018'),
(10, 'McLaren Senna', 'Supercar', 'reserved', 3, '2017'),
(11, 'Maserati Quattroporte', 'Saloon', 'available', 3, '2018'),
(12, 'Mercedes G-Class', 'SUV', 'reserved', 3, '2016'),
(13, 'Subaru Impreza WRX', 'Saloon', 'available', 3, '2012'),
(14, 'Jeep Wrangler', 'SUV', 'reserved', 4, '2016'),
(15, 'Mercedes S-Class', 'Saloon', 'available', 4, '2011'),
(16, 'Mercedes S65', 'Coupe', 'available', 4, '2016'),
(17, 'Porsche Cayenne', 'SUV', 'available', 4, '2014'),
(18, 'Porsche Macan', 'SUV', 'reserved', 4, '2017'),
(19, 'Ferrari LaFerrari', 'Hypercar', 'available', 3, '2014'),
(20, 'Ferrari 488 Pista', 'Supercar', 'reserved', 1, '2017');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `location` varchar(40) DEFAULT NULL,
  `fk_car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `location`, `fk_car_id`) VALUES
(1, 'Landstrasse-Hauptstrasse  1/1', 20),
(2, 'Landstrasse-Hauptstrasse  1/1', 12),
(3, 'Petrusgasse 20', 10),
(4, 'Fickeystrasse 12', 7),
(5, 'Kettenbruckengasse 23', 6),
(6, 'Kettenbruckengasse 23', 18),
(7, 'Fickeystrasse 12', 4),
(8, 'Petrusgasse 20', 3),
(9, 'Rudegasse 8', 14);

-- --------------------------------------------------------

--
-- Table structure for table `php_car_rental_agency`
--

CREATE TABLE `php_car_rental_agency` (
  `id` int(11) NOT NULL,
  `office_name` varchar(40) DEFAULT NULL,
  `fk_address_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `php_car_rental_agency`
--

INSERT INTO `php_car_rental_agency` (`id`, `office_name`, `fk_address_id`, `fk_user_id`) VALUES
(1, 'Rip-Off-Rentals', 1, NULL),
(2, 'Rip-Off-Rentals', 2, NULL),
(3, 'Rip-Off-Rentals', 3, NULL),
(4, 'Rip-Off-Rentals', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(8, 'Testy', 'McTestface', 'test@gmail.com', 'd3613b478a6d44c7d7c9cccda9dcf94b9fea0ffc832aa4ea2ae84cbd4da69ef5'),
(9, 'Dan', 'Med', 'dan@gmail.com', 'd3613b478a6d44c7d7c9cccda9dcf94b9fea0ffc832aa4ea2ae84cbd4da69ef5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_office_id` (`fk_office_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `fk_car_id` (`fk_car_id`);

--
-- Indexes for table `php_car_rental_agency`
--
ALTER TABLE `php_car_rental_agency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_address_id` (`fk_address_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `php_car_rental_agency`
--
ALTER TABLE `php_car_rental_agency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `php_car_rental_agency` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`fk_car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `php_car_rental_agency`
--
ALTER TABLE `php_car_rental_agency`
  ADD CONSTRAINT `php_car_rental_agency_ibfk_1` FOREIGN KEY (`fk_address_id`) REFERENCES `address` (`address_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
