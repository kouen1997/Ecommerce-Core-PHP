-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2017 at 04:38 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ejv_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `record_id` int(11) NOT NULL,
  `user_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `form_record` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_logout` datetime NOT NULL,
  `activity` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `record_id`, `user_id`, `full_name`, `form_record`, `date_login`, `last_logout`, `activity`) VALUES
(30, 2, '1321111', 'LeeMinho', 'Customer', '2017-03-31 11:03:20', '2017-03-31 18:04:18', '[[null],{"date":"2017-03-31 18:03:32","act":"Yey"}]'),
(31, 1, '132190203', 'JiYong', 'Customer', '2017-03-31 11:04:34', '2017-03-31 18:08:21', '[["[[null],{"date":"2017-03-31 18:07:32","act":"Yey"}]"],{"date":"2017-03-31 18:08:06","act":"Yey"}]'),
(32, 2, '1321111', 'LeeMinho', 'Customer', '2017-03-31 11:08:28', '2017-03-31 18:28:37', '[["[{"date":"2017-03-31 18:08:28","act":"Logged In"}]"],{"date":"2017-03-31 18:08:43","act":"Yey"}]'),
(33, 2, '1321111', 'LeeMinho', 'Customer', '2017-03-31 11:28:44', '2017-03-31 18:38:00', '[{"date":"2017-03-31 18:28:44","act":"Logged In"}]'),
(34, 2, '1321111', 'LeeMinho', 'Customer', '2017-03-31 11:38:16', '2017-03-31 18:39:30', '[null,{"date":"2017-03-31 18:38:36","act":"Yey"}]'),
(35, 2, '1321111', 'LeeMinho', 'Customer', '2017-03-31 11:39:56', '0000-00-00 00:00:00', '["["[{"date":"2017-03-31 18:39:56","act":"Logged In"}]",{"date":"2017-03-31 18:40:10","act":"Yey"}]",{"date":"2017-03-31 18:41:47","act":"Yey"}]');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(250) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `items`, `expire_date`, `paid`, `shipped`) VALUES
(16, 132190203, '[{"id":"2","size":"medium","quantity":"2"}]', '2017-03-14 08:41:39', 0, 0),
(18, 1321111, '[{"id":"1","size":"large","quantity":"1"}]', '2017-03-14 09:48:24', 1, 1),
(19, 1321111, '[{"id":"1","size":"small","quantity":"2"},{"id":"2","size":"medium","quantity":"2"}]', '2017-03-14 10:03:48', 1, 1),
(20, 1321111, '[{"id":"2","size":"large","quantity":"2"},{"id":"1","size":"medium","quantity":"2"}]', '2017-04-16 11:50:46', 1, 1),
(21, 0, '[{"id":"1","size":"medium","quantity":"2"},{"id":"2","size":"medium","quantity":"1"}]', '2017-03-14 14:22:02', 1, 1),
(22, 132190203, '[{"id":"1","size":"small","quantity":"1"}]', '2017-03-14 14:22:20', 1, 1),
(23, 132190203, '[{"id":"2","size":"large","quantity":"2"}]', '2017-03-14 15:28:07', 1, 1),
(24, 132190203, '[{"id":"8","size":"large","quantity":"1"}]', '2017-03-14 15:31:31', 0, 0),
(25, 132190203, '[{"id":"1","size":"medium","quantity":"1"}]', '2017-03-31 15:33:56', 0, 0),
(26, 132190203, '[{"id":"1","size":"small","quantity":"1"}]', '2017-03-31 16:11:01', 0, 0),
(27, 132190203, '[{"id":"2","size":"large","quantity":"1"}]', '2017-03-14 16:19:49', 0, 0),
(28, 132190203, '[{"id":"2","size":"large","quantity":"2"}]', '2017-03-14 16:28:02', 0, 0),
(29, 1321111, '[{"id":"2","size":"large","quantity":"1"}]', '2017-03-14 16:28:53', 0, 0),
(30, 1321111, '[{"id":"6","size":"small","quantity":"1"}]', '2017-03-14 16:30:37', 1, 1),
(31, 1321111, '[{"id":"8","size":"large","quantity":"1"}]', '2017-03-14 17:39:41', 0, 0),
(32, 1321111, '[{"id":"1","size":"small","quantity":"1"}]', '2017-03-14 17:46:12', 0, 0),
(33, 1321111, '[{"id":"2","size":"medium","quantity":"1"}]', '2017-03-14 17:47:08', 0, 0),
(34, 1321111, '[{"id":"1","size":"large","quantity":"2"}]', '2017-03-14 18:06:58', 0, 0),
(35, 0, '[{"id":"1","size":"small","quantity":"1"}]', '2017-03-15 06:22:55', 1, 1),
(36, 1321111, '[{"id":"8","size":"medium","quantity":1}]', '2017-03-15 06:26:21', 1, 1),
(37, 1321111, '[{"id":"8","size":"medium","quantity":"2"}]', '2017-04-01 06:27:34', 1, 1),
(38, 0, '[{"id":"1","size":"medium","quantity":"2"}]', '2017-03-17 09:26:25', 1, 1),
(39, 1321111, '[{"id":"2","size":"large","quantity":"2"}]', '2017-03-17 09:29:16', 1, 1),
(46, 1321111, '[{"id":"2","size":"medium","quantity":"2"}]', '2017-02-22 11:33:40', 0, 0),
(48, 132190203, '[{"id":"8","size":"medium","quantity":"1"},{"id":"6","size":"medium","quantity":"2"}]', '2017-03-28 05:09:39', 1, 1),
(49, 132190203, '[{"id":"8","size":"small","quantity":"1"},{"id":"2","size":"medium","quantity":5}]', '2017-03-28 05:12:34', 0, 0),
(50, 132190203, '[{"id":"8","size":"medium","quantity":"1"},{"id":"1","size":"medium","quantity":"1"}]', '2017-03-28 05:18:56', 0, 0),
(51, 132190203, '[{"id":"6","size":"medium","quantity":"1"}]', '2017-03-28 05:19:56', 0, 0),
(52, 132190203, '[{"id":"1","size":"large","quantity":2},{"id":"2","size":"small","quantity":"1"},{"id":"2","size":"large","quantity":2}]', '2017-03-28 17:59:38', 0, 0),
(53, 1321111, '[{"id":"2","size":"large","quantity":"1"}]', '2017-04-04 05:28:51', 0, 0),
(54, 1321111, '[{"id":"1","size":"large","quantity":"2"}]', '2017-04-08 06:18:30', 0, 0),
(55, 1321111, '[{"id":"1","size":"large","quantity":"1"}]', '2017-04-11 06:51:37', 0, 0),
(56, 132190203, '[{"id":"1","size":"large","quantity":"1"}]', '2017-04-11 14:45:29', 0, 0),
(57, 0, '[{"id":"1","size":"medium","quantity":"1"}]', '2017-04-13 03:18:11', 0, 0),
(58, 0, '[{"id":"2","size":"small","quantity":"1"}]', '2017-04-25 03:39:39', 0, 0),
(59, 0, '[{"id":"2","size":"large","quantity":"1"},{"id":"1","size":"large","quantity":"1"}]', '2017-04-29 15:16:33', 1, 1),
(60, 1321111, '[{"id":"8","size":"large","quantity":"2"}]', '2017-04-29 15:26:42', 1, 1),
(61, 132190203, '[{"id":"8","size":"small","quantity":"1"}]', '2017-04-29 15:28:26', 1, 1),
(62, 0, '[{"id":"2","size":"large","quantity":"1"}]', '2017-04-30 10:31:43', 0, 0),
(63, 0, '[{"id":"8","size":"small","quantity":"1"}]', '2017-04-30 11:48:48', 1, 1),
(64, 132190203, '[{"id":"6","size":"small","quantity":"1"}]', '2017-04-30 17:34:08', 0, 0),
(65, 1321111, '[{"id":"1","size":"medium","quantity":"1"}]', '2017-04-30 17:55:34', 0, 0),
(66, 1321111, '[{"id":"6","size":"large","quantity":"1"}]', '2017-04-30 18:08:39', 0, 0),
(67, 1321111, '[{"id":"8","size":"large","quantity":"1"}]', '2017-04-30 18:38:32', 0, 0),
(68, 1321111, '[{"id":"8","size":"small","quantity":"1"}]', '2017-04-30 18:40:06', 0, 0),
(69, 1321111, '[{"id":"8","size":"small","quantity":"1"}]', '2017-04-30 19:15:08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(2, 'Soap', 0),
(3, 'Vitamins', 0),
(5, 'anti-bacterial', 2),
(6, 'injectables', 3),
(7, 'Oral', 3),
(18, 'Multivitamins', 3),
(20, 'Shampoo', 0),
(21, 'deodorizer', 20);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `user_id` int(250) NOT NULL,
  `email` varchar(260) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `user_id`, `email`, `full_name`, `password`, `contact`, `address`, `join_date`, `last_login`, `status`) VALUES
(1, 132190203, 'gdragon@yahoo.com', 'JiYong', '$2y$10$Zy4ZZiXPb1czRBU7GeHU4.w5fJ4kuhlPahszuZPxJJjadYNl3z3kO', '09262397154', 'San Mateo', '2017-02-15 03:15:21', '2017-03-31 18:04:34', 'Active'),
(2, 1321111, 'norman_marasigan@yahoo.com', 'LeeMinho', '$2y$10$UqBFM2IK8tDvivHnl/Twb.RE5hxwxARrE3y5xTdgxqsDdAhbx7Ety', '09056165060', 'Marikina', '2017-02-14 08:25:22', '2017-03-31 18:39:56', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `convo`
--

CREATE TABLE IF NOT EXISTS `convo` (
  `convo_id` int(11) NOT NULL AUTO_INCREMENT,
  `convo_sub` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`convo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `convo_member`
--

CREATE TABLE IF NOT EXISTS `convo_member` (
  `convo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `convo_last_view` int(11) NOT NULL,
  `convo_deleted` int(1) NOT NULL,
  PRIMARY KEY (`convo_id`),
  KEY `convo_id` (`convo_id`,`user_id`),
  KEY `convo_id_2` (`convo_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `convo_messages`
--

CREATE TABLE IF NOT EXISTS `convo_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `convo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `categories` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `qty` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `categories`, `image`, `description`, `qty`, `featured`, `deleted`) VALUES
(1, 'Kytooh', '200', '100.00', '21', '/ejventerprises/images/products/b29a61bcbdccf77172e0238ac27a55a1.jpg', 'yehey bumili na po kayo murang mura lng bes', 'small:0,medium:-5,large:0', 1, 0),
(2, 'Shampu', '10000', '199.00', '18', '/ejventerprises/images/products/bd2d09f2b6e3044010be3576b97a08cd.jpg', 'Kytooh Multivitamins!!', 'small:0,medium:0,large:0', 0, 0),
(3, 'haha', '3', '100.00', '6', '/ejventerprises/images/products/product1.jpg', '', '5', 0, 0),
(6, 'Vitamis C', '234', '32523.00', '18', '/ejventerprises/images/products/9defc623fd467e29f88fd567119cdc87.jpg', 'fsdgsdgsdgs', 'small:0,medium:2,large:5', 1, 0),
(7, 'Yhana', '1400', '200.00', '7', '/ejventerprises/images/products/05dfee4fa41aa11bbd0e69e136b85160.jpg', 'hehe', 'small:1,large:2', 1, 1),
(8, 'Kytooh soap', '100', '120.00', '5', '/ejventerprises/images/products/0a2b44a31f18f6ff491935a2aec3dba1.jpg', 'Safegaurd', 'small:4,medium:4,large:4', 1, 0),
(9, 'sfsd', '12233', '444.00', '21', '/ejventerprises/images/products/5de3e5aeb40b3cda0099e9d036282055.jpg', 'gdfgh', 'small:12,large:7', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `last` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `current` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `month`, `last`, `current`) VALUES
(22, '', '0', '459001.94');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=68 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `cart_id`, `user_id`, `full_name`, `email`, `address`, `contact`, `sub_total`, `tax`, `total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 0, 0, '', '', '', 0, '0.00', '0.00', '0.00', '', 'Cash On Delivery', '2017-02-12 02:44:13'),
(2, 17, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '20000.00', '1.00', '20001.00', '2', 'Cash On Delivery', '2017-02-12 02:46:13'),
(3, 18, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '200.00', '17.40', '217.40', '1', 'Cash On Delivery', '2017-02-12 02:48:29'),
(4, 19, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '20400.00', '1.00', '20401.00', '4item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 03:03:54'),
(5, 20, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '400.00', '34.80', '434.80', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 03:53:40'),
(6, 21, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '10400.00', '904.80', '11304.80', '3 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 07:22:08'),
(7, 22, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 07:22:24'),
(8, 23, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '20000.00', '1.00', '20001.00', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 08:28:11'),
(15, 30, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 09:30:42'),
(16, 35, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 23:23:58'),
(17, 36, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '100.00', '8.70', '108.70', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-12 23:26:32'),
(18, 37, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '200.00', '17.40', '217.40', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-01 23:27:37'),
(19, 0, 0, '', '', '', 0, '0.00', '0.00', '0.00', '', 'Cash On Delivery', '2017-02-13 23:30:34'),
(20, 38, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '400.00', '34.80', '434.80', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-15 02:27:29'),
(21, 39, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '20000.00', '1.00', '20001.00', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-15 02:46:10'),
(22, 40, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '210000.00', '18.00', '210018.00', '21 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-16 23:53:56'),
(23, 0, 0, '', '', '', 0, '0.00', '0.00', '0.00', '', 'Cash On Delivery', '2017-02-16 23:54:13'),
(24, 0, 0, '', '', '', 0, '0.00', '0.00', '0.00', '', 'Cash On Delivery', '2017-02-16 23:55:09'),
(25, 41, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '1000.00', '87.00', '1087.00', '5 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-16 23:58:21'),
(26, 42, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '1000.00', '87.00', '1087.00', '5 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-16 23:59:19'),
(27, 43, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '41600.00', '3.00', '41603.00', '12 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-17 00:06:23'),
(30, 0, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '0.00', '0.00', '0.00', '0 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-25 22:08:15'),
(31, 48, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '568.00', '49.42', '617.42', '3 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-25 22:09:47'),
(32, 49, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '50100.00', '4.00', '50104.00', '6 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-25 22:14:53'),
(33, 50, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '300.00', '26.10', '326.10', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-25 22:19:39'),
(34, 51, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-02-25 22:30:43'),
(35, 2, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '0.00', '0.00', '0.00', '0 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-04 22:28:41'),
(36, 3, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '0.00', '0.00', '0.00', '0 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-08 23:16:24'),
(37, 4, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '0.00', '0.00', '0.00', '0 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-08 23:18:22'),
(38, 5, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '0.00', '0.00', '0.00', '0 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-11 23:51:26'),
(39, 55, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-11 23:51:41'),
(40, 6, 132190203, 'JiYong', '', 'Jones St', 926397154, '2998.00', '0.00', '2998.00', '6 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-12 08:29:23'),
(41, 6, 132190203, 'JiYong', '', 'Jones St', 926397154, '2998.00', '0.00', '2998.00', '6 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-12 08:30:12'),
(42, 56, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-12 08:45:36'),
(43, 20, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '20400.00', '1.00', '20401.00', '4 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-17 05:56:34'),
(44, 58, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '10000.00', '870.00', '10870.00', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-25 20:42:14'),
(45, 59, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '10200.00', '887.40', '11087.40', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-30 08:17:04'),
(46, 60, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'dfgdfgdfgdf', 92119000, '200.00', '17.40', '217.40', '2 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-30 08:26:52'),
(47, 61, 132190203, 'JiYong', 'gdragon@yahoo.com', 'Jones St', 926397154, '100.00', '8.70', '108.70', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-30 08:28:30'),
(48, 62, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '10000.00', '870.00', '10870.00', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 03:32:33'),
(49, 63, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '100.00', '8.70', '108.70', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 04:49:42'),
(50, 64, 132190203, 'JiYong', 'gdragon@yahoo.com', 'San Mateo', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:35:48'),
(51, 64, 132190203, 'JiYong', 'gdragon@yahoo.com', 'San Mateo', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:41:33'),
(52, 64, 132190203, 'JiYong', 'gdragon@yahoo.com', 'San Mateo', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:45:45'),
(53, 64, 132190203, 'JiYong', 'gdragon@yahoo.com', 'San Mateo', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:52:23'),
(54, 64, 132190203, 'JiYong', 'gdragon@yahoo.com', 'San Mateo', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:52:45'),
(55, 64, 132190203, 'JiYong', 'gdragon@yahoo.com', 'San Mateo', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:54:46'),
(56, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 10:55:38'),
(57, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:00:09'),
(58, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:00:51'),
(59, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:02:10'),
(60, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:03:32'),
(61, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:04:46'),
(62, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:07:32'),
(63, 65, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '200.00', '17.40', '217.40', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:08:06'),
(64, 66, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '234.00', '20.36', '254.36', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:08:43'),
(65, 67, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '100.00', '8.70', '108.70', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:38:36'),
(66, 68, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '100.00', '8.70', '108.70', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:40:10'),
(67, 68, 1321111, 'LeeMinho', 'norman_marasigan@yahoo.com', 'Marikina', 2147483647, '100.00', '8.70', '108.70', '1 item(s) from EJV Enterprises', 'Cash On Delivery', '2017-03-31 11:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Norman', 'gdragon88@yahoo.com', '$2y$10$BTKXos.dKYmaAFWyaK08FOscLHCMB7YCKTzuTq7n5VF.JHOR84cbS', '2017-02-06 04:27:35', '2017-03-31 11:35:41', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
