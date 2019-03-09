-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2019 at 10:59 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giloo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permissions` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`b_id`, `name`, `image`) VALUES
(1, 'Apple', NULL),
(2, 'Samsung', NULL),
(3, 'HP', NULL),
(4, 'Dell', NULL),
(5, 'Lenovo', NULL),
(6, 'Acer', NULL),
(7, 'Motorolla', NULL),
(8, 'Infinix', NULL),
(9, 'Huawei', NULL),
(10, 'Tecno', NULL),
(11, 'MSI', NULL),
(12, 'Razer', NULL),
(13, 'Nokia', NULL),
(16, 'Toshiba', NULL),
(19, 'LG', NULL),
(20, 'Updated from Midea', NULL),
(21, 'Nasco', NULL),
(23, 'Sony', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(25) NOT NULL,
  `uid` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `color` varchar(25) DEFAULT 'N/A',
  `size` varchar(25) DEFAULT 'N/A',
  `expire_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `delivered` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `parent` int(100) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `name`, `parent`, `description`, `image`) VALUES
(2, 'Electronics', 0, 'Gadgets, Tvs &amp; more.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text,
  `p_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `p_id`, `name`) VALUES
(1, '02.jpg', 1, '02.jpg'),
(2, '03.jpg', 2, '03.jpg'),
(3, '01.jpg', 1, '04.jpg'),
(4, '01.jpg', 1, '03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

DROP TABLE IF EXISTS `misc`;
CREATE TABLE IF NOT EXISTS `misc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(255) DEFAULT NULL,
  `contact` varchar(150) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items` text NOT NULL,
  `ip_add` varchar(15) NOT NULL,
  `uid` tinyint(4) NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `delivered` tinyint(4) NOT NULL DEFAULT '0',
  `note_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET latin1 NOT NULL,
  `price` varchar(10) NOT NULL,
  `list_price` varchar(10) DEFAULT NULL,
  `b_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `image` varchar(150) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `keywords` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sizes` varchar(50) CHARACTER SET latin1 NOT NULL,
  `color` varchar(25) CHARACTER SET latin1 NOT NULL,
  `memory` varchar(100) NOT NULL,
  `tags` varchar(100) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `included` text,
  `features` text,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `title`, `price`, `list_price`, `b_id`, `c_id`, `image`, `description`, `quantity`, `keywords`, `sizes`, `color`, `memory`, `tags`, `status`, `included`, `features`, `deleted`) VALUES
(1, 'Samsung Galaxy S9', '1500', '3500', 2, 2, '02.jpg', 'short description about the product', 4, 'samsung galaxy s9 ', '', 'white,gold,black,blue', '32GB,64GB,128GB', 'featured', NULL, 'earpiece\r\ncase\r\napparels\r\n', 'extended features of the product', 0),
(2, 'Apple Iphone X', '1500', '3500', 2, 2, '03.jpg', 'short description about the product', 4, 'apple iphone x', '', 'white,gold,black,blue', '32GB,64GB,128GB', 'featured', NULL, 'earpiece\r\ncase\r\napparels\r\n', 'extended features of the product', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `rating` varchar(10) NOT NULL,
  `p_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `uid`, `subject`, `review`, `rating`, `p_id`, `status`) VALUES
(1, 1, 'Best Smartphone Ever', 'I really loved the display', '5', 1, 1),
(2, 2, 'Best Laptop Ever', 'Brought out an impressive gaming experience', '5', 1, 1),
(3, 1, 'Testing Raw Data', 'Raw Data Tested', '5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `feature` varchar(100) NOT NULL,
  `tagline` varchar(25) NOT NULL,
  `price` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_id` varchar(255) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `uid` tinyint(4) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(150) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joined_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hash` varchar(255) CHARACTER SET latin1 NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

DROP TABLE IF EXISTS `user_token`;
CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `token` varchar(80) NOT NULL,
  `timemodified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `uid`, `token`, `timemodified`) VALUES
(1, 3, 'syaIpmD78v', '2019-01-06 23:58:01'),
(2, 4, 'xowFGNgmkJ', '2019-01-07 00:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `w_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  PRIMARY KEY (`w_id`),
  UNIQUE KEY `p_id` (`p_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
