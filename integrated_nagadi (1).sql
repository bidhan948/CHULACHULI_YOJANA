-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 04, 2022 at 06:55 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `integrated_nagadi`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `has_child` tinyint(1) NOT NULL DEFAULT '0',
  `pid` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_eng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `topic_number` int(11) DEFAULT NULL,
  `rate` double NOT NULL DEFAULT '0',
  `rate_type` int(11) DEFAULT NULL,
  `fiscal_year_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `has_child`, `pid`, `name`, `name_eng`, `topic_number`, `rate`, `rate_type`, `fiscal_year_id`) VALUES
(1, 1, NULL, 'घर बहाल', NULL, 1, 0, NULL, 1),
(2, 0, 1, 'asjd', NULL, NULL, 10, 1000, NULL),
(3, 1, NULL, 'ब्यबसाय कर', NULL, 2, 0, NULL, 1),
(4, 1, 3, 'किराना पसल', NULL, NULL, 0, 0, NULL),
(5, 0, 4, 'खुद्र', NULL, NULL, 2000, NULL, NULL),
(6, 1, 1, 'श्रोत', NULL, NULL, 0, NULL, NULL),
(7, 0, 6, 'परिचालन', NULL, NULL, 250, NULL, NULL),
(8, 0, 4, 'थोक', NULL, NULL, 10, 100, NULL),
(9, 1, NULL, 'सिफारिस', NULL, 3, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rasids`
--

DROP TABLE IF EXISTS `rasids`;
CREATE TABLE IF NOT EXISTS `rasids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fiscal_year_id` int(11) NOT NULL,
  `date_nep` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `date_eng` date DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pan_no` varchar(255) CHARACTER SET utf8 NOT NULL,
  `bill_no` int(11) DEFAULT NULL,
  `provience` int(11) NOT NULL,
  `district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gapa_napa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ward` int(11) NOT NULL,
  `grand_total` double NOT NULL,
  `recieved_amount` double DEFAULT NULL,
  `return_amount` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `payment_mode` int(11) DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cheque_number` int(11) DEFAULT NULL,
  `cancel_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancel_date_nep` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cancel_date_eng` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rasids`
--

INSERT INTO `rasids` (`id`, `fiscal_year_id`, `date_nep`, `date_eng`, `customer_name`, `pan_no`, `bill_no`, `provience`, `district`, `gapa_napa`, `ward`, `grand_total`, `recieved_amount`, `return_amount`, `status`, `payment_mode`, `bank`, `cheque_number`, `cancel_reason`, `cancel_date_nep`, `cancel_date_eng`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2078-12-24', '2022-04-07', 'नेपाल सरकार', '234', NULL, 1, '1', '1', 2, 10, 10, 0, 1, 1, NULL, NULL, 'sdf', '2078-12-24', '2022-04-07', 1, 1, '2022-04-07 08:39:22', '2022-04-07 09:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `rasid_details`
--

DROP TABLE IF EXISTS `rasid_details`;
CREATE TABLE IF NOT EXISTS `rasid_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_sirsak` int(11) NOT NULL,
  `upa_sirsak` int(11) NOT NULL,
  `sirsak` int(11) DEFAULT NULL,
  `anya_sirsak` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parimad` double NOT NULL,
  `rate` double NOT NULL,
  `rate_type` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `rasid_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rasid_id` (`rasid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rasid_details`
--

INSERT INTO `rasid_details` (`id`, `main_sirsak`, `upa_sirsak`, `sirsak`, `anya_sirsak`, `parimad`, `rate`, `rate_type`, `total`, `rasid_id`) VALUES
(1, 1, 2, NULL, NULL, 1000, 10, 1000, 10, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
