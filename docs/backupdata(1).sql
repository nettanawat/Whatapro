-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2015 at 08:17 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `EBusiness`
--

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) DEFAULT NULL,
  `product_category` int(11) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_description` text,
  `product_thumbnail_image` varchar(255) DEFAULT NULL,
  `product_image1` varchar(255) DEFAULT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id`, `product_name`, `product_category`, `product_price`, `product_description`, `product_thumbnail_image`, `product_image1`, `product_image2`, `product_image3`, `product_image4`) VALUES
(4, 'GRIM TIM COLD CRISP', 3, '6900.00', 'Full of contrast, with a really nice blue tone and beautiful indigo depots. Long evident ring effects. It’s been coated to bring out some really nice 3D effects. Orange threads all over and organic copper trims. Made with Italian 11.5 oz. red cast denim. 98% organic cotton and 2% elastane. Made in Italy.', 'images/upload/small.jpg', 'images/upload/520.jpg', 'images/upload/520-1.jpg', 'images/upload/520-2.jpg', 'images/upload/520-3.jpg');
--
-- Database: `Lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_price` float NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`) VALUES
('id00001', 'First product', 'This is description of the first product. This is description of the first product', 300.54),
('id00002', 'Second product', 'This is description of the second product. This is description of the second product.', 1111),
('id0003', 'Third product', 'This is description of the third product. This is description of the third product.', 444.39),
('id0004', 'Forth product', 'This is description of the forth product. This is description of the forth product.', 0);
--
-- Database: `Messages`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(45) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `msgDate` date NOT NULL,
  `msgBody` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `author`, `subject`, `msgDate`, `msgBody`) VALUES
(5, 'sdf', 'sdfs', '2014-12-16', 'sdfsdf');
--
-- Database: `ParkingReservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_time` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `booked_time` datetime DEFAULT NULL,
  `booking_column` varchar(45) DEFAULT NULL,
  `booking_row` varchar(45) DEFAULT NULL,
  `booking_code` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`),
  KEY `fk_bookings_users_idx` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=600 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_time`, `booking_date`, `booked_time`, `booking_column`, `booking_row`, `booking_code`, `users_id`) VALUES
(589, 2, '2014-11-25', '2014-11-24 10:19:02', 'A', '2', '', 1),
(590, 5, '2014-11-25', '2014-11-24 10:19:02', 'A', '2', '', 1),
(597, 3, '2014-11-28', '2014-11-26 19:56:17', 'A', '1', '', 2),
(598, 4, '2014-11-28', '2014-11-26 19:56:17', 'A', '1', '', 2),
(599, 5, '2014-11-28', '2014-11-26 19:56:17', 'A', '1', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `cmu_id` varchar(45) DEFAULT NULL,
  `citizen_id` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `cmu_id`, `citizen_id`, `phone_number`) VALUES
(1, 'Tanawat', 'Sitthitan', 'nettanawat@gmail.com', '1111', 'u522115027', '1509900608961', '0882537135'),
(2, 'Anan', 'Chanyong', 'anan@gmail.com', '1234', '552115086', '1509900608999', '0899991904'),
(3, 'Test a', 'A test', 'test@gmail.com', '1234', '522115027', '1509900608999', '0882538135');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `Tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'nettanawat@gmail.com', '2222', 'Tanawat', 'Sitthitan'),
(2, 'test@gmail.com', '2222', 'Test', NULL);
--
-- Database: `WAP`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE IF NOT EXISTS `Accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL DEFAULT 'user',
  `join_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`id`, `email`, `password`, `role`, `join_date`, `status`) VALUES
(1, 'nettanawat@gmail.com', 'c09e487ab20c68cdc5c21dce226b0426', 'admin', '2015-08-08 00:00:00', 1),
(2, 'admin1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-08-08 00:00:00', 1),
(3, 'admin2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-08-08 00:00:00', 1),
(4, 'admin3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-08-08 00:00:00', 1),
(5, 'iamadmin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '2015-08-08 00:00:00', 1),
(6, 'camp@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-08-08 13:00:09', 1),
(7, 'coffeeman@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-08-08 13:04:16', 1),
(8, 'warmup@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-08-08 13:07:39', 1),
(9, 'coffeesmith@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', '2015-08-08 13:10:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Codes`
--

CREATE TABLE IF NOT EXISTS `Codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `point_amount` int(11) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `barcode_path` varchar(100) DEFAULT NULL,
  `generate_date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `MobileUsers`
--

CREATE TABLE IF NOT EXISTS `MobileUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(250) DEFAULT NULL,
  `totalPoint` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PromotionImage`
--

CREATE TABLE IF NOT EXISTS `PromotionImage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promotion_id` int(11) NOT NULL,
  `image_path` varchar(250) DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_PromotionImage_Promotions1_idx` (`promotion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `PromotionImage`
--

INSERT INTO `PromotionImage` (`id`, `promotion_id`, `image_path`, `add_date`) VALUES
(1, 1, 'user_upload/6/promotions/1/amazon.jpg', '2015-08-08 13:13:54'),
(2, 2, 'user_upload/7/promotions/2/converse.png', '2015-08-08 13:15:08'),
(3, 3, 'user_upload/8/promotions/3/chia.jpg', '2015-08-08 13:16:19'),
(4, 4, 'user_upload/9/promotions/4/givenchy.png', '2015-08-08 13:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `Promotions`
--

CREATE TABLE IF NOT EXISTS `Promotions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` text,
  `shared` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Promotions_ShopInformations1_idx` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Promotions`
--

INSERT INTO `Promotions` (`id`, `shop_id`, `name`, `description`, `shared`, `start_date`, `end_date`, `status`) VALUES
(1, 6, '10% off', '10% off for you <3', 0, '2015-08-08 00:00:00', '2015-08-18 00:00:00', 1),
(2, 7, 'Buy 1 get 1 free', 'This promotion available from 1.00PM - 3.00PM everyday', 0, '2015-08-19 00:00:00', '2015-08-28 00:00:00', 1),
(3, 8, 'Free mixer', 'Free mixer when you buy a Swing', 0, '2015-08-19 00:00:00', '2015-08-31 00:00:00', 1),
(4, 9, 'Free delivery', 'Free delivery around suthep area', 0, '2015-08-13 00:00:00', '2015-08-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `RequestingSignup`
--

CREATE TABLE IF NOT EXISTS `RequestingSignup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `sub_district` varchar(45) DEFAULT NULL,
  `latitude` decimal(12,10) DEFAULT NULL,
  `longtitude` decimal(12,10) DEFAULT NULL,
  `address` text,
  `open_time` text,
  `description` text,
  `request_date` datetime DEFAULT NULL,
  `approve_date` datetime DEFAULT NULL,
  `manage_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ShopImage`
--

CREATE TABLE IF NOT EXISTS `ShopImage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_id` int(11) NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `image_path` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ShopImage_ShopInformations1_idx` (`shop_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ShopImage`
--

INSERT INTO `ShopImage` (`id`, `shop_id`, `added_date`, `image_path`) VALUES
(1, 6, '2015-08-08 13:00:09', 'user_upload/6/shop_images/home.png'),
(2, 7, '2015-08-08 13:04:16', 'user_upload/7/shop_images/home.png'),
(3, 8, '2015-08-08 13:07:39', 'user_upload/8/shop_images/home.png'),
(4, 9, '2015-08-08 13:10:47', 'user_upload/9/shop_images/home.png');

-- --------------------------------------------------------

--
-- Table structure for table `ShopInformations`
--

CREATE TABLE IF NOT EXISTS `ShopInformations` (
  `accounts_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `sub_district` varchar(45) DEFAULT NULL,
  `latitude` decimal(12,10) DEFAULT NULL,
  `longitude` decimal(12,10) DEFAULT NULL,
  `open_time` text,
  `description` text,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`accounts_id`),
  KEY `fk_ShopInformations_Accounts1_idx` (`accounts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ShopInformations`
--

INSERT INTO `ShopInformations` (`accounts_id`, `name`, `address`, `phone_number`, `sub_district`, `latitude`, `longitude`, `open_time`, `description`, `category`) VALUES
(6, 'CAMP', 'Nimman Soi 13', '053 333 456', '2', '18.7855796992', '98.9657449722', 'Everyday', 'The best chilling place', NULL),
(7, 'Coffee man', 'Angkaew CMU', '053 234 432', '3', '18.7912676993', '98.9645862579', 'Mon - Sat', 'The best coffee shop in CMU', NULL),
(8, 'Warm up cafe', 'Nimman road ', '053222345', '3', '18.7950460503', '98.9651441574', 'Everyday from 17.00 - 01.00', 'Nice place to hang out', NULL),
(9, 'Coffee smith', 'Suthep road', '0899991904', '4', '18.7913895829', '98.9592647552', 'Everyday from 6.00AM - 11.00PM', 'Coffee shop for pretty girl', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `PromotionImage`
--
ALTER TABLE `PromotionImage`
  ADD CONSTRAINT `fk_PromotionImage_Promotions1` FOREIGN KEY (`promotion_id`) REFERENCES `Promotions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Promotions`
--
ALTER TABLE `Promotions`
  ADD CONSTRAINT `fk_Promotions_ShopInformations1` FOREIGN KEY (`shop_id`) REFERENCES `ShopInformations` (`accounts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ShopImage`
--
ALTER TABLE `ShopImage`
  ADD CONSTRAINT `fk_ShopImage_ShopInformations1` FOREIGN KEY (`shop_id`) REFERENCES `ShopInformations` (`accounts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ShopInformations`
--
ALTER TABLE `ShopInformations`
  ADD CONSTRAINT `fk_ShopInformations_Accounts1` FOREIGN KEY (`accounts_id`) REFERENCES `Accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `WebA`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_revenue`
--

CREATE TABLE IF NOT EXISTS `expense_revenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `expense_revenue`
--

INSERT INTO `expense_revenue` (`id`, `amount`, `type`) VALUES
(1, 350000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) DEFAULT NULL,
  `product_description` text,
  `product_amount` int(11) DEFAULT NULL,
  `product_category` int(11) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_amount`, `product_category`, `product_price`) VALUES
(1, 'Monitor', 'Monitor of laptop.', 72000, 1, 2000),
(2, 'Keyboard', 'Laptop keyboard', 7000, 1, 700),
(3, 'Touchpad', 'Laptop touchpad', 19500, 1, 1500),
(4, 'HDD', 'Harddisk samsung 1 Tb', 15000, 1, 1700),
(5, 'asdads', 'asdasd`', 1000000, 1, 9000),
(6, 'Mac', 'macbook pro', 200000, 2, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_amount` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `transaction_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `fk_transactions_products_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `product_amount`, `total_price`, `receive_date`, `transaction_type`, `status`, `product_id`, `id`) VALUES
(1, 500, 350000, '2014-12-16', 0, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '1234');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `WebB`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_revenue`
--

CREATE TABLE IF NOT EXISTS `expense_revenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `expense_revenue`
--

INSERT INTO `expense_revenue` (`id`, `amount`, `type`) VALUES
(1, 350000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) DEFAULT NULL,
  `product_description` text,
  `product_amount` int(11) DEFAULT NULL,
  `product_category` int(11) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_amount`, `product_category`, `product_price`) VALUES
(1, 'Plate', 'AAA plate', 14000, 2, 49),
(2, 'Spoon', 'Silver spoon', 39000, 2, 30),
(3, 'Fork', 'Silver fork', 38000, 1, 30),
(4, 'Blow', 'Ceramic blow', 56000, 2, 70);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_amount` int(11) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `transaction_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `id` int(10) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `fk_transactions_products_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `product_amount`, `total_price`, `receive_date`, `transaction_type`, `status`, `product_id`, `id`) VALUES
(2, 500, 350000, '2014-12-16', 1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '1234');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transactions_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `cdcol`
--

-- --------------------------------------------------------

--
-- Table structure for table `cds`
--

CREATE TABLE IF NOT EXISTS `cds` (
  `titel` varchar(200) DEFAULT NULL,
  `interpret` varchar(200) DEFAULT NULL,
  `jahr` int(11) DEFAULT NULL,
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cds`
--

INSERT INTO `cds` (`titel`, `interpret`, `jahr`, `id`) VALUES
('Beauty', 'Ryuichi Sakamoto', 1990, 1),
('Goodbye Country (Hello Nightclub)', 'Groove Armada', 2001, 4),
('Glee', 'Bran Van 3000', 1997, 5);
--
-- Database: `flyhigh`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `short_description` varchar(200) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `detail` text,
  `image_thumbnail` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) NOT NULL,
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `unit` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `total_price` double DEFAULT NULL,
  `shipping_method` varchar(45) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `tracking_number` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 = waiting payment\n0 = paid',
  `chia_seed12oz` int(11) DEFAULT NULL,
  `chia_seed16oz` int(11) DEFAULT NULL,
  `natrol10unit` int(11) DEFAULT NULL,
  `natrol30unit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `first_name`, `last_name`, `address`, `district`, `province`, `zip_code`, `phone_number`, `total_price`, `shipping_method`, `day`, `month`, `year`, `tracking_number`, `status`, `chia_seed12oz`, `chia_seed16oz`, `natrol10unit`, `natrol30unit`) VALUES
(2, '2903152', 'ธนวัฒน์', 'สิทธิตัน', 'เลขที่ 3199 อาคารมาลีนนท์ทาวเวอร์ ถนนพระราม 4 แขวงคลองตัน ', 'เขตคลองเตย ', 'กรุงเทพฯ ', '10110', '0882537135', 1550, 'EMS', 29, 3, 15, 'EJ683901749TH', 0, 3, 0, 0, 0),
(3, '2903153', 'สมชาย', 'ใจดี', '14 หมู่ 1 ธารทิพย์การ์เด้นเพลส, ตำบลสุเทพ', ' อำเภอเมืองเชียงใหม่ ', 'เชียงใหม่', '50200', '0888888888', 2530, 'EMS', 29, 3, 15, 'EJ683901752TH', 0, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE IF NOT EXISTS `product_detail` (
  `id` int(11) NOT NULL,
  `topic` varchar(45) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `size` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `image1` text,
  `image2` text,
  `image3` text,
  `imageCertificate1` text,
  `imageCertificate2` text,
  `imageCertificate3` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `size`, `status`, `image1`, `image2`, `image3`, `imageCertificate1`, `imageCertificate2`, `imageCertificate3`) VALUES
(1, 'chia', 123, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'natrol', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `revenue`
--

CREATE TABLE IF NOT EXISTS `revenue` (
  `id` int(11) NOT NULL,
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review_amazon`
--

CREATE TABLE IF NOT EXISTS `review_amazon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `star` int(11) DEFAULT NULL,
  `reviewer` varchar(45) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `review` text,
  `link` text,
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_review_amazon_products1_idx` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `review_general`
--

CREATE TABLE IF NOT EXISTS `review_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reviewer` varchar(45) DEFAULT NULL,
  `detail` text,
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_review_general_products1_idx` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submit_payment`
--

CREATE TABLE IF NOT EXISTS `submit_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` double DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `attached_img` text,
  `status` int(11) DEFAULT '1' COMMENT '1 = waiting\n0 = accepted',
  `orders_id` int(11) NOT NULL,
  `order_orderId` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_submit_payment_orders1_idx` (`orders_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `submit_payment`
--

INSERT INTO `submit_payment` (`id`, `amount`, `day`, `month`, `year`, `hour`, `minute`, `attached_img`, `status`, `orders_id`, `order_orderId`) VALUES
(1, 1550, 30, 3, 2558, 1, 8, 'resources/payment_attached/ooo.png', 0, 2, '2903152'),
(2, 2530, 23, 4, 2558, 9, 4, 'resources/payment_attached/10928541_1023217201025091_1222457243_n.jpg', 0, 3, '2903153');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `review_amazon`
--
ALTER TABLE `review_amazon`
  ADD CONSTRAINT `fk_review_amazon_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review_general`
--
ALTER TABLE `review_general`
  ADD CONSTRAINT `fk_review_general_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `submit_payment`
--
ALTER TABLE `submit_payment`
  ADD CONSTRAINT `fk_submit_payment_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE IF NOT EXISTS `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) DEFAULT NULL,
  `product_category` int(11) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_description` text,
  `product_thumbnail_image` varchar(255) DEFAULT NULL,
  `product_image1` varchar(255) DEFAULT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_07_17_070238_crate_promotions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE IF NOT EXISTS `promotions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'FREE BAR', 'hey as;ldada asidjaidjasdasdaldjad', '2015-07-17 00:26:22', '2015-07-17 00:26:22'),
(2, 'COOL', 'hey as;ldada asidjaidjasdasdaldjad', '2015-07-17 00:28:38', '2015-07-17 00:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Net', 'nettanawat@gmail.com', '$2y$10$IpyUGp8.X5gf/80jNf6Eau7Z4L.t.4eVwMtIAJ4bqgXct1QVDjRZK', NULL, '2015-07-24 12:14:30', '2015-07-24 12:14:30');
--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE IF NOT EXISTS `pma__bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE IF NOT EXISTS `pma__column_info` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin' AUTO_INCREMENT=42 ;

--
-- Dumping data for table `pma__column_info`
--

INSERT INTO `pma__column_info` (`id`, `db_name`, `table_name`, `column_name`, `comment`, `mimetype`, `transformation`, `transformation_options`) VALUES
(1, 'WAP', 'promotions', 'start_date', '', '', '_', ''),
(2, 'WAP', 'promotions', 'end_date', '', '', '_', ''),
(3, 'WAP', 'promotions', 'status', '', '', '_', ''),
(4, 'WAP', 'Accounts', 'join_date', '', '', '_', ''),
(5, 'WAP', 'promotions', 'id', '', '', '_', ''),
(6, 'WAP', 'shopinformations', 'id', '', '', '_', ''),
(7, 'WAP', 'ShopInformations', 'id', '', '', '_', ''),
(8, 'WAP', 'Promotions', 'status', '', '', '_', ''),
(9, 'WAP', 'Promotions', 'id', '', '', '_', ''),
(10, 'EBusiness', 'Products', 'product_price', '', '', '_', ''),
(26, 'Messages', 'messages', 'subject', '', '', '_', ''),
(25, 'Messages', 'messages', 'author', '', '', '_', ''),
(24, 'Messages', 'messages', 'id', '', '', '_', ''),
(23, 'WebA', 'transactions', 'id', '', '', '_', ''),
(22, 'WebB', 'transactions', 'id', '', '', '_', ''),
(21, 'WebA', 'transactions', 'transaction_id', '', '', '_', ''),
(20, 'se301', 'account', 'password', '', '', '_', ''),
(19, 'se301', 'account', 'username', '', '', '_', ''),
(27, 'Messages', 'messages', 'msgDate', '', '', '_', ''),
(28, 'Messages', 'messages', 'msgBody', '', '', '_', ''),
(29, 'flyhigh', 'review_amazon', 'title', '', '', '_', ''),
(30, 'flyhigh', 'blogs', 'id', '', '', '_', ''),
(31, 'flyhigh', 'blogs', 'detail', '', '', '_', ''),
(32, 'flyhigh', 'submit_payment', 'order_orderId', '', '', '_', ''),
(33, 'WAP', 'Accounts', 'status', '', '', '_', ''),
(35, 'WAP', 'ShopInformations', 'category', '', '', '_', ''),
(36, 'WAP', 'RequestingSignup', 'longitude', '', '', '_', ''),
(37, 'Tutorial', 'accounts', 'id', '', '', '_', ''),
(38, 'Tutorial', 'accounts', 'email', '', '', '_', ''),
(39, 'Tutorial', 'accounts', 'password', '', '', '_', ''),
(40, 'Tutorial', 'accounts', 'first_name', '', '', '_', ''),
(41, 'Tutorial', 'accounts', 'last_name', '', '', '_', '');

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma__designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE IF NOT EXISTS `pma__history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE IF NOT EXISTS `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{"db":"WAP","table":"Accounts"},{"db":"Tutorial","table":"accounts"},{"db":"WAP","table":"RequestingSignup"},{"db":"WAP","table":"ShopImage"},{"db":"WAP","table":"ShopInformations"},{"db":"WAP","table":"Promotions"},{"db":"WAP","table":"Logs"},{"db":"WAP","table":"MobileUsers"},{"db":"WAP","table":"PromotionImage"},{"db":"Liveinfo","table":"owner"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE IF NOT EXISTS `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE IF NOT EXISTS `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE IF NOT EXISTS `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE IF NOT EXISTS `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`,`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'WAP', 'Accounts', '[]', '2015-08-06 17:45:32'),
('root', 'WebB', 'transactions', '{"sorted_col":"`transaction_type` DESC"}', '2014-12-15 11:07:26'),
('root', 'flyhigh', 'submit_payment', '{"sorted_col":"`order_orderId` ASC"}', '2015-03-28 07:46:09'),
('root', 'WAP', 'PromotionImage', '{"sorted_col":"`promotion_id` ASC"}', '2015-07-29 06:37:52'),
('root', 'WAP', 'ShopInformations', '{"sorted_col":"`ShopInformations`.`accounts_id` ASC"}', '2015-07-29 06:58:25'),
('root', 'WAP', 'RequestingSignup', '{"sorted_col":"`RequestingSignup`.`approve_date` DESC"}', '2015-07-10 07:06:18');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE IF NOT EXISTS `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE IF NOT EXISTS `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2014-07-11 07:30:48', '{"collation_connection":"utf8mb4_general_ci"}');
--
-- Database: `se301`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`) VALUES
('net', '1234');
--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
