-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2022 at 06:35 AM
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
-- Database: `integrated_yojana`
--

-- --------------------------------------------------------

--
-- Table structure for table `amanats`
--

DROP TABLE IF EXISTS `amanats`;
CREATE TABLE IF NOT EXISTS `amanats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED DEFAULT NULL,
  `cit_no` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_district` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('female','male','other') COLLATE utf8_unicode_ci DEFAULT NULL,
  `entered_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `amanats`
--

INSERT INTO `amanats` (`id`, `name`, `ward_no`, `cit_no`, `issue_district`, `mobile_no`, `gender`, `entered_by`, `deleted_at`, `created_at`, `updated_at`, `address`, `plan_id`, `fullname`) VALUES
(1, 'this is test amanat', 17, NULL, NULL, NULL, NULL, 2, NULL, '2022-06-08 06:21:17', '2022-06-08 06:39:41', 'Hathkhola,Morang', 5, 'bidhan baniya');

-- --------------------------------------------------------

--
-- Table structure for table `anugaman_detail_plans`
--

DROP TABLE IF EXISTS `anugaman_detail_plans`;
CREATE TABLE IF NOT EXISTS `anugaman_detail_plans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `anugaman_samiti_detail_id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anugaman_detail_plans`
--

INSERT INTO `anugaman_detail_plans` (`id`, `anugaman_samiti_detail_id`, `plan_id`, `created_at`, `updated_at`) VALUES
(1, 11, 3, '2022-05-17 07:32:49', '2022-05-17 07:32:49'),
(2, 12, 3, '2022-05-17 07:32:49', '2022-05-17 07:32:49'),
(3, 13, 3, '2022-05-17 09:30:38', '2022-05-17 09:30:38'),
(18, 3, 2, '2022-06-06 10:41:40', '2022-06-06 10:41:40'),
(17, 2, 2, '2022-06-06 10:41:40', '2022-06-06 10:41:40'),
(16, 3, 2, '2022-06-06 10:37:48', '2022-06-06 10:37:48'),
(13, 2, 2, '2022-06-06 10:37:38', '2022-06-06 10:37:38'),
(14, 3, 2, '2022-06-06 10:37:38', '2022-06-06 10:37:38'),
(15, 2, 2, '2022-06-06 10:37:48', '2022-06-06 10:37:48'),
(19, 14, 4, '2022-06-07 08:21:25', '2022-06-07 08:21:25'),
(20, 15, 4, '2022-06-07 08:21:25', '2022-06-07 08:21:25'),
(21, 16, 4, '2022-06-07 08:23:28', '2022-06-07 08:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `anugaman_plans`
--

DROP TABLE IF EXISTS `anugaman_plans`;
CREATE TABLE IF NOT EXISTS `anugaman_plans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `anugaman_samiti_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anugaman_plans`
--

INSERT INTO `anugaman_plans` (`id`, `plan_id`, `type_id`, `anugaman_samiti_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 6, '2022-05-17 07:32:49', '2022-05-17 09:30:38'),
(3, 2, 2, 1, '2022-06-06 10:09:06', '2022-06-06 10:41:40'),
(4, 4, 3, 9, '2022-06-07 08:21:25', '2022-06-07 08:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `anugaman_samitis`
--

DROP TABLE IF EXISTS `anugaman_samitis`;
CREATE TABLE IF NOT EXISTS `anugaman_samitis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `anugaman_samiti_type_id` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_useable` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anugaman_samitis`
--

INSERT INTO `anugaman_samitis` (`id`, `name`, `ward_no`, `anugaman_samiti_type_id`, `deleted_at`, `created_at`, `updated_at`, `is_useable`) VALUES
(1, 'गा.प अनुगमन समिति', 0, 1, NULL, '2022-05-04 08:57:21', '2022-05-04 08:57:21', 1),
(2, 'this is test wada stariya samiti', 1, 0, NULL, '2022-05-04 10:20:17', '2022-05-04 10:20:17', 1),
(9, 'test anugaman samiti', 0, NULL, NULL, '2022-06-07 08:21:25', '2022-06-07 08:21:25', 0),
(6, 'बाटो बनाउने अनुगमन समिति (updated)', 0, NULL, NULL, '2022-05-17 07:32:49', '2022-05-17 09:30:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `anugaman_samiti_details`
--

DROP TABLE IF EXISTS `anugaman_samiti_details`;
CREATE TABLE IF NOT EXISTS `anugaman_samiti_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `anugaman_samiti_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('female','male','other','') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ward_no` int(10) UNSIGNED DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anugaman_samiti_details`
--

INSERT INTO `anugaman_samiti_details` (`id`, `anugaman_samiti_id`, `name`, `post_id`, `gender`, `created_at`, `updated_at`, `status`, `ward_no`, `mobile_no`) VALUES
(1, 1, 'बिधान बनिया', 51, 'male', '2022-05-04 08:57:21', '2022-05-04 10:14:57', 0, NULL, NULL),
(2, 1, 'बिधान बनिया 2', 52, 'male', '2022-05-04 08:57:21', '2022-05-04 08:57:21', 1, NULL, NULL),
(3, 1, 'बिधान बनिया', 51, 'male', '2022-05-04 10:18:27', '2022-05-04 10:18:27', 1, NULL, NULL),
(4, 2, 'सुबास बानिया', 51, 'male', '2022-05-04 10:20:17', '2022-05-04 10:20:17', 1, NULL, NULL),
(5, 2, 'सुबास बानियाँ', 52, 'male', '2022-05-04 10:20:17', '2022-05-04 10:20:17', 1, NULL, NULL),
(6, 2, 'सुबास बानिया २', 52, 'male', '2022-05-04 10:31:30', '2022-05-06 06:08:29', 1, NULL, NULL),
(13, 6, 'बिशाल', 52, 'male', '2022-05-17 09:30:38', '2022-05-17 09:30:38', 1, 17, '9815386000'),
(12, 6, 'प्रदिप', 52, 'male', '2022-05-17 07:32:49', '2022-05-17 07:32:49', 1, NULL, '9815386000'),
(11, 6, 'अन्जेश', 51, 'male', '2022-05-17 07:32:49', '2022-05-17 07:32:49', 1, NULL, '9815386000'),
(14, 9, 'अन्जेश', 47, 'male', '2022-06-07 08:21:25', '2022-06-07 08:21:25', 1, 9, '9815386000'),
(15, 9, 'बिशाल', 48, 'male', '2022-06-07 08:21:25', '2022-06-07 08:21:25', 1, 17, '9815386000'),
(16, 9, 'बिधान बनिया', 50, 'male', '2022-06-07 08:23:28', '2022-06-07 08:23:28', 1, 18, '9815386000');

-- --------------------------------------------------------

--
-- Table structure for table `anugamen`
--

DROP TABLE IF EXISTS `anugamen`;
CREATE TABLE IF NOT EXISTS `anugamen` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `anugamanable_id` int(11) NOT NULL,
  `anugamanable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `budget_sources`
--

DROP TABLE IF EXISTS `budget_sources`;
CREATE TABLE IF NOT EXISTS `budget_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fiscal_year_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `budget_sources`
--

INSERT INTO `budget_sources` (`id`, `name`, `fiscal_year_id`) VALUES
(2, 'नेपाल सरकार समानीकरण', 1),
(3, 'प्रदेश सरकार ससर्त', 1),
(4, 'राजस्व बाँडफाँड-प्रदेश सरकार', 1),
(5, 'आन्तरिक श्रोत', 1);

-- --------------------------------------------------------

--
-- Table structure for table `budget_source_deposits`
--

DROP TABLE IF EXISTS `budget_source_deposits`;
CREATE TABLE IF NOT EXISTS `budget_source_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `amount` double(15,3) NOT NULL,
  `entry_index` int(11) NOT NULL,
  `entry_date_eng` date NOT NULL,
  `entry_date_nep` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fiscal_year_id` int(11) DEFAULT NULL,
  `budget_source_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_source_deposits_fiscal_year_id_index` (`fiscal_year_id`),
  KEY `budget_source_deposits_budget_source_id_index` (`budget_source_id`),
  KEY `budget_source_deposits_parent_id_index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budget_source_deposits`
--

INSERT INTO `budget_source_deposits` (`id`, `amount`, `entry_index`, `entry_date_eng`, `entry_date_nep`, `remarks`, `status`, `created_at`, `updated_at`, `fiscal_year_id`, `budget_source_id`, `parent_id`) VALUES
(1, 80000.000, 1, '2022-04-17', '2079-01-04', 'this is test', 1, '2022-04-17 10:52:39', '2022-04-17 10:52:39', 1, 2, NULL),
(2, 20000.000, 2, '2022-04-17', '2079-01-04', 'this is test', 1, '2022-04-17 11:02:36', '2022-04-17 11:02:36', 1, 2, NULL),
(3, 200000.000, 1, '2022-04-20', '2079-01-07', 'मिति २०७८-०१-०७ गतेको दिन प्रदेश सरकारबाट रु २००००० -/ बजेट प्राप्त भएको |', 1, '2022-04-20 09:19:46', '2022-04-20 09:19:46', 1, 3, NULL),
(4, 100000.000, 1, '2022-04-21', '2079-01-08', 'this is test', 1, '2022-04-21 08:13:42', '2022-04-21 08:13:42', 1, 4, NULL),
(5, 50000.000, 1, '2022-04-21', '2079-01-08', 'this is kaifiyat', 1, '2022-04-21 10:21:12', '2022-04-21 10:21:12', 1, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budget_source_plans`
--

DROP TABLE IF EXISTS `budget_source_plans`;
CREATE TABLE IF NOT EXISTS `budget_source_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `budget_source_id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_split` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `budget_source_plans`
--

INSERT INTO `budget_source_plans` (`id`, `budget_source_id`, `plan_id`, `amount`, `created_at`, `updated_at`, `is_split`) VALUES
(1, 2, 1, 80000.00, '2022-04-20 09:48:05', '2022-04-20 09:48:05', 0),
(2, 3, 1, 100000.00, '2022-04-20 09:48:05', '2022-04-20 09:48:05', 0),
(3, 2, 2, 50000.00, '2022-04-22 08:12:50', '2022-04-22 08:12:50', 1),
(4, 3, 2, 0.00, '2022-04-22 08:12:50', '2022-04-22 08:12:50', 1),
(5, 3, 3, 20000.00, '2022-04-26 11:04:19', '2022-04-26 11:04:19', 0),
(6, 2, 4, 15000.00, '2022-06-07 05:50:27', '2022-06-07 05:50:27', 0),
(7, 5, 5, 20000.00, '2022-06-07 10:09:25', '2022-06-07 10:09:25', 0),
(8, 4, 5, 50000.00, '2022-06-07 10:09:25', '2022-06-07 10:09:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `consumers`
--

DROP TABLE IF EXISTS `consumers`;
CREATE TABLE IF NOT EXISTS `consumers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `entered_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `consumers`
--

INSERT INTO `consumers` (`id`, `name`, `ward_no`, `plan_id`, `entered_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 'tukraune 1 उपभोक्ता समिति (updated)', 15, 2, 2, NULL, '2022-06-06 08:39:56', '2022-06-06 08:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `consumer_details`
--

DROP TABLE IF EXISTS `consumer_details`;
CREATE TABLE IF NOT EXISTS `consumer_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `consumer_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('male','female','other','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `cit_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `issue_district` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `consumer_details`
--

INSERT INTO `consumer_details` (`id`, `consumer_id`, `post_id`, `name`, `gender`, `ward_no`, `cit_no`, `issue_district`, `contact_no`, `deleted_at`, `created_at`, `updated_at`) VALUES
(4, 3, 48, 'सुनिता डंगोल', 'female', 18, '870', 'मोरङ', '9815386000', NULL, '2022-06-06 08:45:01', '2022-06-06 08:45:01'),
(3, 3, 47, 'बिधान बानिया', 'male', 18, '4578', 'मोरङ', '9815386000', NULL, '2022-06-06 08:45:01', '2022-06-06 08:45:01');

-- --------------------------------------------------------

--
-- Table structure for table `contingencies`
--

DROP TABLE IF EXISTS `contingencies`;
CREATE TABLE IF NOT EXISTS `contingencies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `percent` float UNSIGNED DEFAULT NULL,
  `fiscal_year_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contingencies`
--

INSERT INTO `contingencies` (`id`, `percent`, `fiscal_year_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, '2022-04-27 08:28:26', '2022-04-27 08:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `institutional_committees`
--

DROP TABLE IF EXISTS `institutional_committees`;
CREATE TABLE IF NOT EXISTS `institutional_committees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `entered_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `institutional_committees`
--

INSERT INTO `institutional_committees` (`id`, `name`, `ward_no`, `entered_by`, `deleted_at`, `created_at`, `updated_at`, `plan_id`) VALUES
(1, 'this is test संस्था समिति', 16, 2, NULL, '2022-06-07 07:08:04', '2022-06-07 07:08:04', 4);

-- --------------------------------------------------------

--
-- Table structure for table `institutional_committee_details`
--

DROP TABLE IF EXISTS `institutional_committee_details`;
CREATE TABLE IF NOT EXISTS `institutional_committee_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `institutional_committee_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `gender` enum('female','male','other') COLLATE utf8_unicode_ci NOT NULL,
  `cit_no` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_district` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `institutional_committee_details`
--

INSERT INTO `institutional_committee_details` (`id`, `institutional_committee_id`, `post_id`, `name`, `ward_no`, `gender`, `cit_no`, `issue_district`, `mobile_no`, `created_at`, `updated_at`) VALUES
(9, 1, 48, 'name 4', 16, 'female', '870', 'मोरङ', '9815386000', '2022-06-07 08:02:31', '2022-06-07 08:02:31'),
(8, 1, 48, 'name 2', 17, 'male', '870', 'मोरङ', '9815386000', '2022-06-07 08:02:31', '2022-06-07 08:02:31'),
(7, 1, 47, 'name 1', 18, 'female', '870', 'मोरङ', '9815386000', '2022-06-07 08:02:31', '2022-06-07 08:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `kul_lagats`
--

DROP TABLE IF EXISTS `kul_lagats`;
CREATE TABLE IF NOT EXISTS `kul_lagats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `napa_amount` double(8,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `napa_contingency` double DEFAULT NULL,
  `other_office_con` double DEFAULT NULL,
  `other_office_con_contingency` double DEFAULT NULL,
  `other_office_con_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_office_agreement` double DEFAULT NULL,
  `other_agreement_contingency` double DEFAULT NULL,
  `other_contingency_con_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_agreement` double DEFAULT NULL,
  `customer_agreement_contingency` double DEFAULT NULL,
  `work_order_budget` double DEFAULT NULL,
  `consumer_budget` double NOT NULL DEFAULT '0',
  `total_investment` double DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kul_lagats`
--

INSERT INTO `kul_lagats` (`id`, `napa_amount`, `deleted_at`, `created_at`, `updated_at`, `plan_id`, `napa_contingency`, `other_office_con`, `other_office_con_contingency`, `other_office_con_name`, `other_office_agreement`, `other_agreement_contingency`, `other_contingency_con_name`, `customer_agreement`, `customer_agreement_contingency`, `work_order_budget`, `consumer_budget`, `total_investment`, `type_id`) VALUES
(1, 20000.00, NULL, '2022-04-29 07:55:38', '2022-04-29 07:55:38', 3, 5, 1000, NULL, NULL, 2000, NULL, NULL, 1500, 4, 23440, 5000, 28440, 1),
(3, 50000.00, NULL, '2022-06-06 05:20:54', '2022-06-06 05:20:54', 2, 4, 10000, NULL, 'this is test', 12000, NULL, 'this is test2', 4000, NULL, 73600, 5000, 78600, 2),
(4, 15000.00, NULL, '2022-06-07 06:13:01', '2022-06-07 06:13:01', 4, 4, 10000, NULL, 'anya shrot', 20000, NULL, 'this is test', 14000, 4, 57440, 12000, 69440, 3),
(5, 70000.00, NULL, '2022-06-08 04:31:07', '2022-06-08 04:31:07', 5, 4, 2000, NULL, 'anya shrot', 1000, NULL, 'this is test', 2000, NULL, 72080, 2000, 74080, 4);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_04_18_162530_add_fiscal_year_id_to_budget_sources_table', 1),
(2, '2022_04_18_162358_create_plans_table', 2),
(3, '2022_04_18_165521_create_budget_source_plans_table', 3),
(4, '2022_04_18_165948_create_plan_ward_details_table', 4),
(5, '2022_04_22_125734_add_plan_id_to_plans_table', 5),
(6, '2022_04_22_152437_add_is_split_to_budget_source_plans_table', 6),
(7, '2022_04_22_164813_create_tole_bikas_samitis_table', 7),
(8, '2022_04_24_103310_create_tole_bikas_samiti_details_table', 8),
(9, '2022_04_24_143559_add_exp_date_nep_to_tole_bikas_samitis_table', 9),
(10, '2022_04_26_154426_create_kul_lagats_table', 10),
(11, '2022_04_27_123534_create_contingencies_table', 11),
(14, '2022_04_27_144037_add_fields_to_kul_lagats_table', 14),
(13, '2022_04_29_120743_create_plan_operates_table', 13),
(15, '2022_05_01_141549_create_consumers_table', 15),
(16, '2022_05_01_142252_create_consumer_details_table', 16),
(17, '2022_05_02_103142_add_type_id_to_kul_lagats_table', 17),
(18, '2022_05_02_114628_create_types_table', 18),
(19, '2022_05_02_134706_add_fiscal_year_id_to_types_table', 19),
(20, '2022_05_02_163952_create_anugaman_samitis_table', 20),
(22, '2022_05_02_164409_create_anugaman_samiti_details_table', 21),
(23, '2022_05_04_154650_add_status_to_anugaman_samiti_details_table', 22),
(24, '2022_05_06_113320_add_gender_to_anugaman_samiti_details_table', 23),
(25, '2022_05_06_161220_add_is_useable_to_anugaman_samitis_table', 24),
(26, '2022_05_08_104151_create_anugamen_table', 25),
(27, '2022_05_08_105943_create_anugaman_detail_plans_table', 26),
(28, '2022_05_17_124518_create_anugaman_plans_table', 27),
(29, '2022_05_17_161754_create_other_bibarans_table', 28),
(30, '2022_06_05_135947_create_other_bibaran_details_table', 29),
(31, '2022_06_07_103421_create_institutional_committees_table', 30),
(32, '2022_06_07_105221_create_institutional_committee_details_table', 31),
(33, '2022_06_07_121037_add_plan_id_to_institutional_committees_table', 32),
(35, '2022_06_07_153723_create_amanats_table', 33),
(37, '2022_06_08_104107_add_address_to_amanat_table', 34);

-- --------------------------------------------------------

--
-- Table structure for table `other_bibarans`
--

DROP TABLE IF EXISTS `other_bibarans`;
CREATE TABLE IF NOT EXISTS `other_bibarans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `formation_start_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formation_start_date_eng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date_eng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date_eng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `committee_count` int(10) UNSIGNED DEFAULT NULL,
  `house_family_count` int(10) UNSIGNED NOT NULL,
  `female` int(10) UNSIGNED NOT NULL,
  `male` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `other_bibarans`
--

INSERT INTO `other_bibarans` (`id`, `plan_id`, `type_id`, `formation_start_date`, `formation_start_date_eng`, `start_date`, `start_date_eng`, `end_date`, `end_date_eng`, `committee_count`, `house_family_count`, `female`, `male`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2079-02-23', '2022-06-6', '2079-02-25', '2022-06-8', '2079-02-26', '2022-06-9', 20, 14, 50, 22, 2, NULL, '2022-06-05 09:49:30', '2022-06-05 09:49:30'),
(2, 2, 2, '2079-02-23', '2022-06-6', '2079-02-10', '2022-05-24', '2079-02-24', '2022-06-7', 20, 14, 50, 22, 2, NULL, '2022-06-06 10:54:32', '2022-06-06 10:54:32'),
(3, 4, 3, '2079-02-17', '2022-05-31', '2079-02-17', '2022-05-31', '2079-02-31', '2022-06-17', 20, 20, 87, 88, 2, NULL, '2022-06-07 08:31:43', '2022-06-07 08:31:43'),
(4, 5, 4, NULL, NULL, '2079-02-24', '2022-06-7', '2079-02-31', '2022-06-17', NULL, 14, 12, 19, 2, NULL, '2022-06-08 08:07:45', '2022-06-08 08:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `other_bibaran_details`
--

DROP TABLE IF EXISTS `other_bibaran_details`;
CREATE TABLE IF NOT EXISTS `other_bibaran_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `other_bibaran_id` int(10) UNSIGNED NOT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_eng` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `other_bibaran_details`
--

INSERT INTO `other_bibaran_details` (`id`, `other_bibaran_id`, `date`, `date_eng`, `staff_id`, `post_id`, `created_at`, `updated_at`) VALUES
(6, 1, '2079-02-27', '2022-06-10', 2, 10, '2022-06-05 10:20:33', '2022-06-05 10:20:33'),
(5, 1, '2079-02-30', '2022-06-16', 25, 9, '2022-06-05 10:20:33', '2022-06-05 10:20:33'),
(7, 1, '2079-02-30', '2022-06-16', 3, 27, '2022-06-05 10:20:33', '2022-06-05 10:20:33'),
(11, 2, '2079-02-31', '2022-06-17', 2, 10, '2022-06-06 10:56:45', '2022-06-06 10:56:45'),
(10, 2, '2079-02-31', '2022-06-17', 25, 9, '2022-06-06 10:56:45', '2022-06-06 10:56:45'),
(17, 3, '2079-02-30', '2022-06-16', 3, 27, '2022-06-07 08:32:04', '2022-06-07 08:32:04'),
(16, 3, '2079-02-25', '2022-06-8', 25, 9, '2022-06-07 08:32:04', '2022-06-07 08:32:04'),
(21, 4, '2079-02-31', '2022-06-17', 3, 27, '2022-06-08 08:11:57', '2022-06-08 08:11:57'),
(20, 4, '2079-02-30', '2022-06-16', 25, 9, '2022-06-08 08:11:57', '2022-06-08 08:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reg_no` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci,
  `fiscal_year_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `expense_type_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `topic_area_type_id` int(10) UNSIGNED NOT NULL,
  `topic_id` int(10) UNSIGNED NOT NULL,
  `type_of_allocation_id` int(10) UNSIGNED NOT NULL,
  `grant_amount` double(8,2) NOT NULL,
  `first_installment` double(8,2) DEFAULT NULL,
  `second_installment` double(8,2) DEFAULT NULL,
  `third_installment` double(8,2) DEFAULT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `is_cancel` tinyint(1) NOT NULL DEFAULT '0',
  `added_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `reg_no`, `name`, `fiscal_year_id`, `expense_type_id`, `type_id`, `topic_area_type_id`, `topic_id`, `type_of_allocation_id`, `grant_amount`, `first_installment`, `second_installment`, `third_installment`, `detail`, `is_cancel`, `added_by`, `deleted_at`, `created_at`, `updated_at`, `plan_id`) VALUES
(1, 1, 'this is test', 1, 18, 0, 24, 22, 26, 180000.00, 50000.00, 60000.00, 70000.00, 'this is test yojana', 0, NULL, NULL, '2022-04-20 09:48:05', '2022-04-20 09:48:05', NULL),
(2, 2, 'tukraune 1', 1, 18, 0, 24, 22, 25, 50000.00, 10000.00, 10000.00, 30000.00, 'test bakhya', 0, NULL, NULL, '2022-04-22 08:12:50', '2022-04-22 08:12:50', 1),
(3, 3, 'Molestias quo dolore', 1, 18, 0, 24, 22, 26, 20000.00, 4000.00, 2000.00, 14000.00, 'Beatae iure exercita', 0, NULL, NULL, '2022-04-26 11:04:19', '2022-04-26 11:04:19', NULL),
(4, 4, 'this is test', 1, 18, 0, 24, 22, 25, 15000.00, 5000.00, 5000.00, 5000.00, 'test bakhya', 0, NULL, NULL, '2022-06-07 05:50:27', '2022-06-07 05:50:27', NULL),
(5, 5, 'कालीदेबी आधारभूत बिद्यालय', 1, 18, 0, 24, 22, 25, 70000.00, 50000.00, 10000.00, 10000.00, 'testtt', 0, NULL, NULL, '2022-06-07 10:09:25', '2022-06-07 10:09:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_operates`
--

DROP TABLE IF EXISTS `plan_operates`;
CREATE TABLE IF NOT EXISTS `plan_operates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `entered_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan_operates`
--

INSERT INTO `plan_operates` (`id`, `plan_id`, `type_id`, `entered_by`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2, '2022-04-29 07:56:08', '2022-04-29 07:56:08'),
(2, 2, 2, 2, '2022-06-06 05:20:54', '2022-06-06 05:20:54'),
(3, 4, 3, 2, '2022-06-07 06:13:01', '2022-06-07 06:13:01'),
(4, 5, 4, 2, '2022-06-08 04:31:07', '2022-06-08 04:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `plan_ward_details`
--

DROP TABLE IF EXISTS `plan_ward_details`;
CREATE TABLE IF NOT EXISTS `plan_ward_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) UNSIGNED NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plan_ward_details`
--

INSERT INTO `plan_ward_details` (`id`, `plan_id`, `ward_no`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2022-04-20 09:48:05', '2022-04-20 09:48:05'),
(2, 1, 2, 0, '2022-04-20 09:48:05', '2022-04-20 09:48:05'),
(3, 1, 5, 0, '2022-04-20 09:48:05', '2022-04-20 09:48:05'),
(4, 1, 6, 0, '2022-04-20 09:48:05', '2022-04-20 09:48:05'),
(5, 2, 1, 0, '2022-04-22 08:12:50', '2022-04-22 08:12:50'),
(6, 3, 16, 1, '2022-04-26 11:04:19', '2022-04-26 11:04:19'),
(7, 3, 2, 0, '2022-04-26 11:04:19', '2022-04-26 11:04:19'),
(8, 3, 3, 0, '2022-04-26 11:04:19', '2022-04-26 11:04:19'),
(9, 4, 1, 0, '2022-06-07 05:50:27', '2022-06-07 05:50:27'),
(10, 4, 2, 0, '2022-06-07 05:50:27', '2022-06-07 05:50:27'),
(11, 5, 1, 0, '2022-06-07 10:09:25', '2022-06-07 10:09:25'),
(12, 5, 2, 0, '2022-06-07 10:09:25', '2022-06-07 10:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `tole_bikas_samitis`
--

DROP TABLE IF EXISTS `tole_bikas_samitis`;
CREATE TABLE IF NOT EXISTS `tole_bikas_samitis` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `date_nep` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_eng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `former_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `former_ward_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entered_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `exp_date_nep` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exp_date_eng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_no` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tole_bikas_samitis`
--

INSERT INTO `tole_bikas_samitis` (`id`, `name`, `ward_no`, `date_nep`, `date_eng`, `former_address`, `former_ward_no`, `entered_by`, `deleted_at`, `created_at`, `updated_at`, `exp_date_nep`, `exp_date_eng`, `reg_no`) VALUES
(1, 'सेरेजा टोल विकास संस्था', 2, '2079-01-11', '2022-04-24', 'बिराटनगर', '18', 2, NULL, '2022-04-24 09:53:11', '2022-04-24 09:53:11', '2081-01-01', '2024-04-13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tole_bikas_samiti_details`
--

DROP TABLE IF EXISTS `tole_bikas_samiti_details`;
CREATE TABLE IF NOT EXISTS `tole_bikas_samiti_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tole_bikas_samiti_id` int(10) UNSIGNED NOT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ward_no` int(10) UNSIGNED NOT NULL,
  `gender` enum('female','male','other','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `cit_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_district` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tole_bikas_samiti_details`
--

INSERT INTO `tole_bikas_samiti_details` (`id`, `tole_bikas_samiti_id`, `position`, `name`, `ward_no`, `gender`, `cit_no`, `issue_district`, `contact_no`, `created_at`, `updated_at`) VALUES
(20, 1, 47, 'राम खत्री', 16, 'male', '0', 'मोरङ', '9811373961', '2022-04-24 11:35:51', '2022-04-24 11:35:51'),
(19, 1, 48, 'बिधान बानियाँ', 17, 'male', '45-78', 'मोरङ', '9815386000', '2022-04-24 11:35:51', '2022-04-24 11:35:51'),
(18, 1, 52, 'सुनिता वि क', 17, 'female', '870', 'मोरङ', '9845678910', '2022-04-24 11:35:51', '2022-04-24 11:35:51');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `typeable_id` int(11) NOT NULL,
  `typeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plan_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fiscal_year_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `typeable_id`, `typeable_type`, `plan_id`, `created_at`, `updated_at`, `fiscal_year_id`) VALUES
(1, 1, 'App\\Models\\YojanaModel\\setting\\tole_bikas_samiti', '3', '2022-05-02 10:01:52', '2022-05-02 10:01:52', 1),
(2, 3, 'App\\Models\\YojanaModel\\consumer', '2', '2022-06-06 10:01:52', '2022-06-06 10:01:52', 1),
(4, 1, 'App\\Models\\YojanaModel\\setting\\institutional_committee', '4', '2022-06-07 07:08:04', '2022-06-07 07:08:04', 1),
(5, 1, 'App\\Models\\YojanaModel\\setting\\amanat', '5', '2022-06-08 06:21:17', '2022-06-08 06:21:17', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
