-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2018 at 02:08 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tops`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_id` int(2) UNSIGNED NOT NULL,
  `SKU` int(2) UNSIGNED NOT NULL,
  `Order_Qty` int(3) NOT NULL,
  `Order_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_id`, `SKU`, `Order_Qty`, `Order_Date`) VALUES
(1, 1, 30, '2018-07-30'),
(2, 2, 40, '2018-08-08'),
(3, 3, 40, '2018-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `SKU` int(2) UNSIGNED NOT NULL,
  `Title` varchar(30) NOT NULL,
  `Quantity` int(3) NOT NULL,
  `Price` double(6,2) NOT NULL,
  `Max_Price` double(6,2) NOT NULL,
  `Min_Price` double(6,2) NOT NULL,
  `Buying_Price` double(6,2) NOT NULL,
  `Total_Estimated_Sales` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`SKU`, `Title`, `Quantity`, `Price`, `Max_Price`, `Min_Price`, `Buying_Price`, `Total_Estimated_Sales`) VALUES
(1, 'Shoe', 5, 5000.00, 7000.00, 5000.00, 5000.00, 30),
(2, 'Rice', 5, 2572.30, 1800.00, 1200.00, 1200.00, 20),
(3, 'Vegetable', 4, 1072.15, 1200.00, 800.00, 900.00, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `fk_orders` (`SKU`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`SKU`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `SKU` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders` FOREIGN KEY (`SKU`) REFERENCES `product` (`SKU`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
