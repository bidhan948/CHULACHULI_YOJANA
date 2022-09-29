-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2022 at 06:33 AM
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
-- Database: `integrated_shared`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci,
  `name_eng` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `name_eng`, `address`, `created_at`, `updated_at`) VALUES
(1, 'एन .आइ.सी  एसिया', 'NIC ASIA', 'प्रदेश नं १ , मोरङ  बिराटनगर', '2022-04-25 08:07:44', '2022-04-25 08:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_years`
--

DROP TABLE IF EXISTS `fiscal_years`;
CREATE TABLE IF NOT EXISTS `fiscal_years` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fiscal_years`
--

INSERT INTO `fiscal_years` (`id`, `name`, `is_current`) VALUES
(1, '2077/078', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_25_131659_create_banks_table', 2),
(6, '2022_05_27_124953_create_permission_tables', 3),
(7, '2022_06_05_135947_create_other_bibaran_details_table', 4),
(8, '2022_06_07_103421_create_institutional_committees_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ADD_ROLE', 'web', '2022-06-01 06:30:44', '2022-06-01 06:30:44'),
(2, 'VIEW_ROLE', 'web', '2022-06-01 06:38:24', '2022-06-01 06:38:24'),
(3, 'ADD_PERMISSION', 'web', '2022-06-01 06:51:10', '2022-06-01 06:51:10'),
(4, 'VIEW_PERMISSION', 'web', '2022-06-01 06:51:18', '2022-06-01 06:51:18'),
(5, 'PERMISSION_MANAGEMENT', 'web', '2022-06-01 06:55:48', '2022-06-01 06:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'web', NULL, '2022-06-01 05:52:04', '2022-06-01 05:52:04'),
(3, 'pis', 'web', NULL, '2022-06-09 05:39:51', '2022-06-09 05:39:51'),
(4, 'cao', 'web', 3, '2022-06-09 05:39:51', '2022-06-09 05:39:51'),
(5, 'yojana', 'web', NULL, '2022-06-09 06:22:02', '2022-06-09 06:22:02'),
(6, 'nagadi', 'web', NULL, '2022-06-09 06:22:32', '2022-06-09 06:22:32'),
(7, 'malpot', 'web', NULL, '2022-06-09 06:22:56', '2022-06-09 06:22:56'),
(9, 'admin', 'web', 3, '2022-06-09 06:32:45', '2022-06-09 06:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setup_addr_districts`
--

DROP TABLE IF EXISTS `setup_addr_districts`;
CREATE TABLE IF NOT EXISTS `setup_addr_districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` longtext,
  `nep_name` longtext,
  `note` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setup_addr_districts`
--

INSERT INTO `setup_addr_districts` (`id`, `pid`, `name`, `nep_name`, `note`) VALUES
(1, 1, 'Bhojpur', 'भोजपुर', ''),
(2, 1, 'Dhankuta', 'धनकुटा', ''),
(3, 1, 'Ilam', 'इलाम', ''),
(4, 1, 'Jhapa', 'झापा', ''),
(5, 1, 'Khotang', 'खोटाङ', ''),
(6, 1, 'Morang', 'मोरङ', ''),
(7, 1, 'Okhaldhunga', 'ओखलढुंगा', ''),
(8, 1, 'Panchthar', 'पाँचथर', ''),
(9, 1, 'Panchthar ', 'पाँचथर', ''),
(10, 1, 'Sankhuwasabha', 'संखुवासभा', ''),
(11, 1, 'Solukhumbu', 'सोलुखुम्बु', ''),
(12, 1, 'Sunsari', 'सुनसरी', ''),
(13, 1, 'Taplejung', 'ताप्लेजुङ', ''),
(14, 1, 'Terhathum', 'तेह्रथुम', ''),
(15, 1, 'Udayapur', 'उदयपुर', ''),
(16, 2, 'Bara', 'बारा', ''),
(17, 2, 'Dhanusha', 'धनुषा', ''),
(18, 2, 'Mahottari', 'महोत्तरी', ''),
(19, 2, 'Parsa', 'पर्सा', ''),
(20, 2, 'Rautahat', 'रौतहट', ''),
(21, 2, 'Saptari', 'सप्तरी', ''),
(22, 2, 'Sarlahi', 'सर्लाही', ''),
(23, 2, 'Siraha', 'सिराहा', ''),
(24, 3, 'Chitwan', 'चितवन', ''),
(25, 3, 'Dhading', 'धादिङ', ''),
(26, 3, 'Dolakha', 'दोलखा', ''),
(27, 3, 'Kavrepalanchok', 'काभ्रेपलाञ्चोक', ''),
(28, 3, 'Kathmandu', 'काठमाण्डौं', ''),
(29, 3, 'Bhaktapur', 'भक्तपुर', ''),
(30, 3, 'Lalitpur', 'ललितपुर', ''),
(31, 3, 'Makwanpur', 'मकवानपुर', ''),
(32, 3, 'Nuwakot', 'नुवाकोट', ''),
(33, 3, 'Ramechhap', 'रामेछाप', ''),
(34, 3, 'Rasuwa', 'रसुवा', ''),
(35, 3, 'Sindhuli', 'सिन्धुली', ''),
(36, 3, 'Sindhupalchok', 'सिन्धुपाल्चोक', ''),
(37, 4, 'Baglung', 'बाग्लुङ', ''),
(38, 4, 'Gorkha', 'गोरखा', ''),
(39, 4, 'Kaski', 'कास्की', ''),
(40, 4, 'Lamjung', 'लमजुङ', ''),
(41, 4, 'Manang', 'मनाङ', ''),
(42, 4, 'Mustang', 'मुस्ताङ', ''),
(43, 4, 'Myagdi', 'म्याग्दी', ''),
(44, 4, 'Nawalparasi East', 'नवलपरासी (बर्दघाट सुस्ता पूर्व)', ''),
(45, 4, 'Parbat', 'पर्वत', ''),
(46, 4, 'Syangja', 'स्याङजा', ''),
(47, 4, 'Tanahun', 'तनहुँ', ''),
(48, 5, 'Arghakhanchi', 'अर्घाखाँची', ''),
(49, 5, 'Banke', 'बाँके', ''),
(50, 5, 'Bardiya', 'बर्दिया', ''),
(51, 5, 'Dang', 'दाङ', ''),
(52, 5, 'Gulmi', 'गुल्मी', ''),
(53, 5, 'Kapilvastu', 'कपिलबस्तु', ''),
(54, 5, 'Nawalparasi West', 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)', ''),
(55, 5, 'Palpa', 'पाल्पा', ''),
(56, 5, 'Pyuthan', 'प्यूठान', ''),
(57, 5, 'Rolpa', 'रोल्पा', ''),
(58, 5, 'Eastern Rukum', 'पुर्व रुकुम', ''),
(59, 5, 'Rupandehi', 'रूपन्देही', ''),
(60, 6, 'Dailekh', 'दैलेख', ''),
(61, 6, 'Dolpa', 'डोल्पा', ''),
(62, 6, 'Humla', 'हुम्ला', ''),
(63, 6, 'Jajarkot', 'जाजरकोट', ''),
(64, 6, 'Jumla', 'जुम्ला', ''),
(65, 6, 'Kalikot', 'कालिकोट', ''),
(66, 6, 'Mugu', 'मुगु', ''),
(67, 6, 'Western Rukum', 'पश्चिम रुकुम', ''),
(68, 6, 'Salyan', 'सल्यान', ''),
(69, 6, 'Surkhet', 'सुर्खेत', ''),
(70, 7, 'Achham', 'अछाम', ''),
(71, 7, 'Baitadi', 'बैतडी', ''),
(72, 7, 'Bajhang', 'बझाङ', ''),
(73, 7, 'Bajura', 'बाजुरा', ''),
(74, 7, 'Dadeldhura', 'डडेल्धुरा', ''),
(75, 7, 'Darchula', 'दार्चुला', ''),
(76, 7, 'Doti', 'डोटी', ''),
(77, 7, 'Kailali', 'कैलाली', ''),
(78, 7, 'Kanchanpur', 'कञ्चनपुर', '');

-- --------------------------------------------------------

--
-- Table structure for table `setup_addr_municipalities`
--

DROP TABLE IF EXISTS `setup_addr_municipalities`;
CREATE TABLE IF NOT EXISTS `setup_addr_municipalities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `nep_type` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `name` longtext,
  `nep_name` longtext,
  `note` longtext,
  `total_wards` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=754 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setup_addr_municipalities`
--

INSERT INTO `setup_addr_municipalities` (`id`, `did`, `nep_type`, `type`, `name`, `nep_name`, `note`, `total_wards`) VALUES
(1, 1, 'गाउँपालिका', 'Rural Municipality', 'Hatuwagadhi', 'हतुवागढी', '', 9),
(2, 1, 'गाउँपालिका', 'Rural Municipality', 'Ramprasad Rai', 'रामप्रसाद राई', '', 8),
(3, 1, 'गाउँपालिका', 'Rural Municipality', 'Aamchok', 'आमचोक', '', 10),
(4, 1, 'गाउँपालिका', 'Rural Municipality', 'Tyamke Maiyum', 'ट्याम्केमैयुम', '', 9),
(5, 1, 'गाउँपालिका', 'Rural Municipality', 'Arun', 'अरुण', '', 7),
(6, 1, 'गाउँपालिका', 'Rural Municipality', 'Pauwadungma', 'पौवादुङमा', '', 6),
(7, 1, 'गाउँपालिका', 'Rural Municipality', 'Salpasilichho', 'साल्पासिलिछो', '', 6),
(8, 1, 'नगरपालिका', 'Municipality', 'Bhojpur', 'भोजपुर', '', 12),
(9, 1, 'नगरपालिका', 'Municipality', 'Shadananda', 'षडानन्द', '', 14),
(10, 2, 'गाउँपालिका', 'Rural Municipality', 'Sangurighadi', 'सागुरीगढी', '', 10),
(11, 2, 'गाउँपालिका', 'Rural Municipality', 'Chaubise', 'चौविसे', '', 8),
(12, 2, 'गाउँपालिका', 'Rural Municipality', 'Sahidbhumi', 'सहीदभूमि', '', 7),
(13, 2, 'गाउँपालिका', 'Rural Municipality', 'Chhathar Jorpati', 'छथर जोरपाटी', '', 6),
(14, 2, 'नगरपालिका', 'Municipality', 'Dhankuta', 'धनकुटा', '', 10),
(15, 2, 'नगरपालिका', 'Municipality', 'Pakhribas', 'पाख्रिवास', '', 10),
(16, 2, 'नगरपालिका', 'Municipality', 'Mahalaxmi', 'महालक्ष्मी', '', 9),
(17, 3, 'गाउँपालिका', 'Rural Municipality', 'Phakphokthum', 'फाकफोकथुम', '', 7),
(18, 3, 'गाउँपालिका', 'Rural Municipality', 'Mai Jogmai', 'माईजोगमाई', '', 6),
(19, 3, 'गाउँपालिका', 'Rural Municipality', 'Chulachuli', 'चुलाचुली', '', 6),
(20, 3, 'गाउँपालिका', 'Rural Municipality', 'Rong', 'रोङ', '', 6),
(21, 3, 'गाउँपालिका', 'Rural Municipality', 'Mangsebung', 'माङसेबुङ', '', 6),
(22, 3, 'गाउँपालिका', 'Rural Municipality', 'Sandakpur', 'सन्दकपुर', '', 5),
(23, 3, 'नगरपालिका', 'Municipality', 'Ilam', 'ईलाम', '', 12),
(24, 3, 'नगरपालिका', 'Municipality', 'Deumai', 'देउमाई', '', 9),
(25, 3, 'नगरपालिका', 'Municipality', 'Mai', 'माई', '', 10),
(26, 3, 'नगरपालिका', 'Municipality', 'Suryodaya', 'सुर्योदय', '', 14),
(27, 4, 'गाउँपालिका', 'Rural Municipality', 'Kamal', 'कमल', '', 7),
(28, 4, 'गाउँपालिका', 'Rural Municipality', 'Buddha Shanti', 'बुद्धशान्ति', '', 7),
(29, 4, 'गाउँपालिका', 'Rural Municipality', 'Kachankawal', 'कचनकवल', '', 7),
(30, 4, 'गाउँपालिका', 'Rural Municipality', 'Jhapa', 'झापा', '', 7),
(31, 4, 'गाउँपालिका', 'Rural Municipality', 'Barhadashi', 'बाह्रदशी', '', 7),
(32, 4, 'गाउँपालिका', 'Rural Municipality', 'Gaurigunj', 'गौरीगंज', '', 6),
(33, 4, 'गाउँपालिका', 'Rural Municipality', 'Haldibari', 'हल्दीवारी', '', 5),
(34, 4, 'नगरपालिका', 'Municipality', 'Arjundhara', 'अर्जुनधारा', '', 11),
(35, 4, 'नगरपालिका', 'Municipality', 'Kankai', 'कन्काई', '', 9),
(36, 4, 'नगरपालिका', 'Municipality', 'Gauradaha', 'गौरादह', '', 9),
(37, 4, 'नगरपालिका', 'Municipality', 'Damak', 'दमक', '', 10),
(38, 4, 'नगरपालिका', 'Municipality', 'Birtamode', 'विर्तामोड', '', 10),
(39, 4, 'नगरपालिका', 'Municipality', 'Bhadrapur', 'भद्रपुर', '', 10),
(40, 4, 'नगरपालिका', 'Municipality', 'Mechinagar', 'मेचीनगर', '', 15),
(41, 4, 'नगरपालिका', 'Municipality', 'Shivasatakshi', 'शिवसताक्षी', '', 11),
(42, 5, 'गाउँपालिका', 'Rural Municipality', 'Khotehang', 'खोटेहाङ', '', 9),
(43, 5, 'गाउँपालिका', 'Rural Municipality', 'Diprung Chuichumma', 'दिप्रुङ चुइचुम्मा', '', 7),
(44, 5, 'गाउँपालिका', 'Rural Municipality', 'Aiselukharka', 'ऐसेलुखर्क', '', 7),
(45, 5, 'गाउँपालिका', 'Rural Municipality', 'Jantedhunga', 'जन्तेढुंगा', '', 6),
(46, 5, 'गाउँपालिका', 'Rural Municipality', 'Kepilasgadhi', 'केपिलासगढी', '', 7),
(47, 5, 'गाउँपालिका', 'Rural Municipality', 'Barahpokhari', 'बराहपोखरी', '', 6),
(48, 5, 'गाउँपालिका', 'Rural Municipality', 'Rawabesi', 'रावाबेसी', '', 6),
(49, 5, 'गाउँपालिका', 'Rural Municipality', 'Sakela', 'साकेला', '', 5),
(50, 5, 'नगरपालिका', 'Municipality', 'Diktel Rupakot Majhuwagadhi', 'दिक्तेल रुपाकोट मझुवागढी', '', 15),
(51, 5, 'नगरपालिका', 'Municipality', 'Halesi Tuwachung', 'हलेसी तुवाचुङ', '', 11),
(52, 6, 'गाउँपालिका', 'Rural Municipality', 'Jahada', 'जहदा', '', 7),
(53, 6, 'गाउँपालिका', 'Rural Municipality', 'Budhiganga', 'बुढीगंगा', '', 7),
(54, 6, 'गाउँपालिका', 'Rural Municipality', 'Katahari', 'कटहरी', '', 7),
(55, 6, 'गाउँपालिका', 'Rural Municipality', 'Dhanpalthan', 'धनपालथान', '', 7),
(56, 6, 'गाउँपालिका', 'Rural Municipality', 'Kanepokhari', 'कानेपोखरी', '', 7),
(57, 6, 'गाउँपालिका', 'Rural Municipality', 'Gramthan', 'ग्रामथान', '', 7),
(58, 6, 'गाउँपालिका', 'Rural Municipality', 'Kerabari', 'केरावारी', '', 10),
(59, 6, 'गाउँपालिका', 'Rural Municipality', 'Miklajung', 'मिक्लाजुङ', '', 9),
(60, 6, 'नगरपालिका', 'Municipality', 'Urlabari', 'उर्लाबारी', '', 9),
(61, 6, 'नगरपालिका', 'Municipality', 'Pathri Sanischare', 'पथरी शनिश्चरे', '', 10),
(62, 6, 'नगरपालिका', 'Municipality', 'Belbari', 'बेलवारी', '', 11),
(63, 6, 'नगरपालिका', 'Municipality', 'Rangeli', 'रंगेली', '', 9),
(64, 6, 'नगरपालिका', 'Municipality', 'Ratuwamai', 'रतुवामाई', '', 10),
(65, 6, 'नगरपालिका', 'Municipality', 'Letang', 'लेटाङ', '', 9),
(66, 6, 'नगरपालिका', 'Municipality', 'Sunbarshi', 'सुनवर्षी', '', 9),
(67, 6, 'नगरपालिका', 'Municipality', 'Sundarharaicha', 'सुन्दर हरैचा', '', 12),
(68, 6, 'महानगरपालिका', 'Metropolitan City', 'Biratnagar', 'विराटनगर ', '', 19),
(69, 7, 'गाउँपालिका', 'Rural Municipality', 'Manebhanjyang', 'मानेभञ्ज्याङ', '', 9),
(70, 7, 'गाउँपालिका', 'Rural Municipality', 'Champadevi', 'चम्पादेवी', '', 10),
(71, 7, 'गाउँपालिका', 'Rural Municipality', 'Sunkoshi', 'सुनकोशी', '', 10),
(72, 7, 'गाउँपालिका', 'Rural Municipality', 'Molung', 'मोलुङ', '', 8),
(73, 7, 'गाउँपालिका', 'Rural Municipality', 'Chisankhugadhi', 'चिशंखुगढी', '', 8),
(74, 7, 'गाउँपालिका', 'Rural Municipality', 'Khiji Demba', 'खिजिदेम्बा', '', 9),
(75, 7, 'गाउँपालिका', 'Rural Municipality', 'Likhu', 'लिखु', '', 9),
(76, 7, 'नगरपालिका', 'Municipality', 'Siddhicharan', 'सिद्धिचरण', '', 12),
(77, 8, 'गाउँपालिका', 'Rural Municipality', 'Miklajung', 'मिक्लाजुङ', '', 8),
(78, 8, 'गाउँपालिका', 'Rural Municipality', 'Phalgunanda', 'फाल्गुनन्द', '', 7),
(79, 8, 'गाउँपालिका', 'Rural Municipality', 'Hilihang', 'हिलिहाङ', '', 7),
(80, 8, 'गाउँपालिका', 'Rural Municipality', 'Phalelung', 'फालेलुङ', '', 8),
(81, 8, 'गाउँपालिका', 'Rural Municipality', 'Yangwarak', 'याङवरक', '', 6),
(82, 8, 'गाउँपालिका', 'Rural Municipality', 'Kummayak', 'कुम्मायक', '', 5),
(83, 9, 'गाउँपालिका', 'Rural Municipality', 'Tumbewa', 'तुम्बेवा', '', 5),
(84, 9, 'नगरपालिका', 'Municipality', 'Phidim', 'फिदिम', '', 14),
(85, 10, 'गाउँपालिका', 'Rural Municipality', 'Makalu', 'मकालु', '', 6),
(86, 10, 'गाउँपालिका', 'Rural Municipality', 'Silichong', 'सिलीचोङ', '', 5),
(87, 10, 'गाउँपालिका', 'Rural Municipality', 'Sabhapokhari', 'सभापोखरी', '', 6),
(88, 10, 'गाउँपालिका', 'Rural Municipality', 'Chichila', 'चिचिला', '', 5),
(89, 10, 'गाउँपालिका', 'Rural Municipality', 'Bhot Khola', 'भोटखोला', '', 5),
(90, 10, 'नगरपालिका', 'Municipality', 'Khadbari', 'खाँदवारी', '', 11),
(91, 10, 'नगरपालिका', 'Municipality', 'Chainpur', 'चैनपुर', '', 11),
(92, 10, 'नगरपालिका', 'Municipality', 'Dharmadevi', 'धर्मदेवी', '', 9),
(93, 10, 'नगरपालिका', 'Municipality', 'Panchkhapan', 'पाँचखपन', '', 9),
(94, 10, 'नगरपालिका', 'Municipality', 'Madi', 'मादी', '', 9),
(95, 11, 'गाउँपालिका', 'Rural Municipality', 'Thulung Dudhkoshi', 'थुलुङ दुधकोशी', '', 9),
(96, 11, 'गाउँपालिका', 'Rural Municipality', 'Necha Salyan', 'नेचासल्यान', '', 5),
(97, 11, 'गाउँपालिका', 'Rural Municipality', 'Mapya Dudhkoshi', 'माप्य दुधकोशी', '', 7),
(98, 11, 'गाउँपालिका', 'Rural Municipality', 'Maha Kulung', 'महाकुलुङ', '', 5),
(99, 11, 'गाउँपालिका', 'Rural Municipality', 'Sotang', 'सोताङ', '', 5),
(100, 11, 'गाउँपालिका', 'Rural Municipality', 'Khumbu Pasang Lhamu', 'खुम्बु पासाङल्हमु', '', 5),
(101, 11, 'गाउँपालिका', 'Rural Municipality', 'Likhu Pike', 'लिखुपिके', '', 5),
(102, 11, 'नगरपालिका', 'Municipality', 'Solududhkunda', 'सोलुदुधकुण्ड', '', 11),
(103, 12, 'गाउँपालिका', 'Rural Municipality', 'Koshi', 'कोशी', '', 8),
(104, 12, 'गाउँपालिका', 'Rural Municipality', 'Harinagara', 'हरिनगरा', '', 7),
(105, 12, 'गाउँपालिका', 'Rural Municipality', 'Bhokraha Narsingha', 'भोक्राहा नरसिंह', '', 8),
(106, 12, 'गाउँपालिका', 'Rural Municipality', 'Dewanganj', 'देवानगन्ज', '', 7),
(107, 12, 'गाउँपालिका', 'Rural Municipality', 'Gadhi', 'गढी', '', 6),
(108, 12, 'गाउँपालिका', 'Rural Municipality', 'Barju', 'बर्जु', '', 6),
(109, 12, 'नगरपालिका', 'Municipality', 'Inaruwa', 'इनरुवा', '', 10),
(110, 12, 'नगरपालिका', 'Municipality', 'Duhabi', 'दुहवी', '', 12),
(111, 12, 'नगरपालिका', 'Municipality', 'Barakshetra', 'बराहक्षेत्र', '', 11),
(112, 12, 'नगरपालिका', 'Municipality', 'Ramdhuni', 'रामधुनी', '', 9),
(113, 12, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Itahari', 'इटहरी', '', 20),
(114, 12, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Dharan', 'धरान', '', 20),
(115, 13, 'गाउँपालिका', 'Rural Municipality', 'Sirijangha', 'सिरीजङ्घा', '', 8),
(116, 13, 'गाउँपालिका', 'Rural Municipality', 'Aathrai Triveni', 'आठराई त्रिवेणी', '', 5),
(117, 13, 'गाउँपालिका', 'Rural Municipality', 'Pathibhara Yangwarak', 'पाथीभरा याङवरक', '', 6),
(118, 13, 'गाउँपालिका', 'Rural Municipality', 'Meringden', 'मेरिङदेन', '', 6),
(119, 13, 'गाउँपालिका', 'Rural Municipality', 'Sidingwa', 'सिदिङ्वा', '', 7),
(120, 13, 'गाउँपालिका', 'Rural Municipality', 'Phaktanglung', 'फक्ताङलुङ', '', 7),
(121, 13, 'गाउँपालिका', 'Rural Municipality', 'Maiwa Khola', 'मैवाखोला', '', 6),
(122, 13, 'गाउँपालिका', 'Rural Municipality', 'Mikwa Khola', 'मिक्वाखोला', '', 5),
(123, 13, 'नगरपालिका', 'Municipality', 'Phungling', 'फुङलिङ', '', 11),
(124, 14, 'गाउँपालिका', 'Rural Municipality', 'Aathrai', 'आठराई', '', 7),
(125, 14, 'गाउँपालिका', 'Rural Municipality', 'Phedap', 'फेदाप', '', 5),
(126, 14, 'गाउँपालिका', 'Rural Municipality', 'Chhathar', 'छथर', '', 6),
(127, 14, 'गाउँपालिका', 'Rural Municipality', 'Menchayayem', 'मेन्छयायेम', '', 6),
(128, 14, 'नगरपालिका', 'Municipality', 'Myanglung', 'म्याङलुङ', '', 10),
(129, 14, 'नगरपालिका', 'Municipality', 'Laligurans', 'लालीगुराँस', '', 9),
(130, 15, 'गाउँपालिका', 'Rural Municipality', 'Udayapurgadhi', 'उदयपुरगढी', '', 8),
(131, 15, 'गाउँपालिका', 'Rural Municipality', 'Rautamai', 'रौतामाई', '', 8),
(132, 15, 'गाउँपालिका', 'Rural Municipality', 'Tapli', 'ताप्ली', '', 5),
(133, 15, 'गाउँपालिका', 'Rural Municipality', 'Limchungbung', 'लिम्चुङबुङ', '', 5),
(134, 15, 'नगरपालिका', 'Municipality', 'Katari', 'कटारी', '', 14),
(135, 15, 'नगरपालिका', 'Municipality', 'Chaudandigadhi', 'चौदण्डीगढी', '', 10),
(136, 15, 'नगरपालिका', 'Municipality', 'Triyuga', 'त्रियुगा', '', 16),
(137, 15, 'नगरपालिका', 'Municipality', 'Belka', 'वेलका', '', 9),
(138, 16, 'गाउँपालिका', 'Rural Municipality', 'Suwarna', 'सुवर्ण ', '', 8),
(139, 16, 'गाउँपालिका', 'Rural Municipality', 'Adarsha Kotwal', 'आदर्श कोतवाल', '', 8),
(140, 16, 'गाउँपालिका', 'Rural Municipality', 'Baragadhi', 'बारागढी', '', 6),
(141, 16, 'गाउँपालिका', 'Rural Municipality', 'Pheta', 'फेटा', '', 7),
(142, 16, 'गाउँपालिका', 'Rural Municipality', 'Karaiyamai', 'करैयामाई', '', 8),
(143, 16, 'गाउँपालिका', 'Rural Municipality', 'Prasauni', 'प्रसौनी', '', 7),
(144, 16, 'गाउँपालिका', 'Rural Municipality', 'Bishrampur', 'विश्रामपुर', '', 5),
(145, 16, 'गाउँपालिका', 'Rural Municipality', 'Devtal', 'देवताल', '', 7),
(146, 16, 'गाउँपालिका', 'Rural Municipality', 'Parwanipur', 'परवानीपुर', '', 5),
(147, 16, 'नगरपालिका', 'Municipality', 'Kolhawi', 'कोल्हवी', '', 11),
(148, 16, 'नगरपालिका', 'Municipality', 'Nijgadh', 'निजगढ', '', 13),
(149, 16, 'नगरपालिका', 'Municipality', 'Mahagadimai', 'महागढीमाई', '', 11),
(150, 16, 'नगरपालिका', 'Municipality', 'Simraungadh', 'सिम्रौनगढ', '', 11),
(151, 16, 'नगरपालिका', 'Municipality', 'Pacharauta', 'पचरौता', '', 9),
(152, 16, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Kalaiya', 'कलैया', '', 27),
(153, 16, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Jitpur', 'जितपुर-सिमरा', '', 24),
(154, 17, 'गाउँपालिका', 'Rural Municipality', 'Lakshminya', 'लक्ष्मीनिया', '', 7),
(155, 17, 'गाउँपालिका', 'Rural Municipality', 'Mukhiyapatti Musharniya', 'मुखियापट्टी मुसहरमिया', '', 6),
(156, 17, 'गाउँपालिका', 'Rural Municipality', 'Janaknandini', 'जनकनन्दिनी', '', 6),
(157, 17, 'गाउँपालिका', 'Rural Municipality', 'Aurahi', 'औरही', '', 6),
(158, 17, 'गाउँपालिका', 'Rural Municipality', 'Bateshwar', 'बटेश्वर', '', 5),
(159, 17, 'गाउँपालिका', 'Rural Municipality', 'Dhanauji', 'धनौजी', '', 5),
(160, 17, 'नगरपालिका', 'Municipality', 'Khireshwornath', 'क्षिरेश्वरनाथ', '', 10),
(161, 17, 'नगरपालिका', 'Municipality', 'Ganeshman Charnath', 'गणेशमान चारनाथ', '', 11),
(162, 17, 'नगरपालिका', 'Municipality', 'Dhanushadham', 'धनुषाधाम', '', 9),
(163, 17, 'नगरपालिका', 'Municipality', 'Nagarain', 'नगराइन', '', 9),
(164, 17, 'नगरपालिका', 'Municipality', 'Mithila', 'मिथिला', '', 11),
(165, 17, 'नगरपालिका', 'Municipality', 'Bideha', 'विदेह', '', 9),
(166, 17, 'नगरपालिका', 'Municipality', 'Sabaila', 'सबैला', '', 13),
(167, 17, 'नगरपालिका', 'Municipality', 'Sahidnagar', 'शहिदनगर', '', 9),
(168, 17, 'नगरपालिका', 'Municipality', 'Kamala', 'कमला', '', 9),
(169, 17, 'नगरपालिका', 'Municipality', 'Mithila bihari', 'मिथिला विहारी', '', 10),
(170, 17, 'नगरपालिका', 'Municipality', 'Hansapur', 'हंसपुर', '', 9),
(171, 17, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Janakpurdham', 'जनकपुरधाम', '', 25),
(172, 18, 'गाउँपालिका', 'Rural Municipality', 'Sonama', 'सोनमा', '', 8),
(173, 18, 'गाउँपालिका', 'Rural Municipality', 'Pipra', 'पिपरा', '', 7),
(174, 18, 'गाउँपालिका', 'Rural Municipality', 'Samsi', 'साम्सी', '', 7),
(175, 18, 'गाउँपालिका', 'Rural Municipality', 'Ekdara', 'एकडारा', '', 6),
(176, 18, 'गाउँपालिका', 'Rural Municipality', 'Mahottari', 'महोत्तरी', '', 6),
(177, 18, 'नगरपालिका', 'Municipality', 'Gaushala', 'गौशाला', '', 12),
(178, 18, 'नगरपालिका', 'Municipality', 'Jaleshwar', 'जलेश्वर', '', 12),
(179, 18, 'नगरपालिका', 'Municipality', 'Bardibas', 'बर्दिबास', '', 14),
(180, 18, 'नगरपालिका', 'Municipality', 'Aurahi', 'औरही', '', 9),
(181, 18, 'नगरपालिका', 'Municipality', 'Balwa', 'बलवा', '', 11),
(182, 18, 'नगरपालिका', 'Municipality', 'Bhangaha', 'भँगाहा', '', 9),
(183, 18, 'नगरपालिका', 'Municipality', 'Matihani', 'मटिहानी', '', 9),
(184, 18, 'नगरपालिका', 'Municipality', 'Manara Sisawa', 'मनरा शिसवा', '', 10),
(185, 18, 'नगरपालिका', 'Municipality', 'Ramgopalpur', 'रामगोपालपुर', '', 9),
(186, 18, 'नगरपालिका', 'Municipality', 'loharpatti', 'लोहरपट्टी', '', 9),
(187, 19, 'गाउँपालिका', 'Rural Municipality', 'Sakhuwa Prasauni', 'सखुवा प्रसौनी', '', 6),
(188, 19, 'गाउँपालिका', 'Rural Municipality', 'Jagarnathpur', 'जगरनाथपुर', '', 6),
(189, 19, 'गाउँपालिका', 'Rural Municipality', 'Chhipahrmai', 'छिपहरमाई', '', 5),
(190, 19, 'गाउँपालिका', 'Rural Municipality', 'Bindabasini', 'बिन्दबासिनी', '', 5),
(191, 19, 'गाउँपालिका', 'Rural Municipality', 'Paterwa Sugauli', 'पटेर्वा सुगौली', '', 5),
(192, 19, 'गाउँपालिका', 'Rural Municipality', 'Jirabhawani', 'जिरा भवानी', '', 5),
(193, 19, 'गाउँपालिका', 'Rural Municipality', 'Kalikamai', 'कालिकामाई', '', 5),
(194, 19, 'गाउँपालिका', 'Rural Municipality', 'Pakaha Mainpur', 'पकाहा मैनपुर', '', 5),
(195, 19, 'गाउँपालिका', 'Rural Municipality', 'Thori', 'ठोरी', '', 5),
(196, 19, 'गाउँपालिका', 'Rural Municipality', 'Dhobini', 'धोबीनी', '', 5),
(197, 19, 'नगरपालिका', 'Municipality', 'Pokhariya', 'पोखरिया', '', 10),
(198, 19, 'नगरपालिका', 'Municipality', 'Parsagadhi', 'पर्सागढी', '', 9),
(199, 19, 'नगरपालिका', 'Municipality', 'Bahudarmai', 'बहुदरमाई', '', 9),
(200, 19, 'महानगरपालिका', 'Metropolitan City', 'Birgunj', 'वीरगञ्ज', '', 32),
(201, 20, 'गाउँपालिका', 'Rural Municipality', 'Durga Bhagawati', 'दुर्गा भगवती', '', 5),
(202, 20, 'गाउँपालिका', 'Rural Municipality', 'Yamunamai', 'यमुनामाई', '', 5),
(203, 20, 'नगरपालिका', 'Municipality', 'Garuda', 'गरुडा', '', 9),
(204, 20, 'नगरपालिका', 'Municipality', 'Gaur', 'गौर', '', 9),
(205, 20, 'नगरपालिका', 'Municipality', 'Chandrapur', 'चन्द्रपुर', '', 10),
(206, 20, 'नगरपालिका', 'Municipality', 'Rajdevi', 'राजदेवी', '', 9),
(207, 20, 'नगरपालिका', 'Municipality', 'Ishnath', 'ईशनाथ', '', 9),
(208, 20, 'नगरपालिका', 'Municipality', 'Katahariya', 'कटहरीया', '', 9),
(209, 20, 'नगरपालिका', 'Municipality', 'Gadhimai', 'गढीमाई', '', 9),
(210, 20, 'नगरपालिका', 'Municipality', 'Gujara', 'गुजरा', '', 9),
(211, 20, 'नगरपालिका', 'Municipality', 'Debahi Gonahi', 'देवाही गोनाही', '', 9),
(212, 20, 'नगरपालिका', 'Municipality', 'Paroha', 'परोहा', '', 9),
(213, 20, 'नगरपालिका', 'Municipality', 'Fatuwa Bijaypur', 'फतुवा विजयपुर', '', 11),
(214, 20, 'नगरपालिका', 'Municipality', 'Baudhimai', 'बौधीमाई', '', 9),
(215, 20, 'नगरपालिका', 'Municipality', 'Madhavnarayan', 'माधवनारायण', '', 9),
(216, 20, 'नगरपालिका', 'Municipality', 'Maulapur', 'मौलापुर', '', 9),
(217, 20, 'नगरपालिका', 'Municipality', 'Rajpur', 'राजपुर', '', 9),
(218, 20, 'नगरपालिका', 'Municipality', 'Brindaban', 'वृन्दावन', '', 9),
(219, 21, 'गाउँपालिका', 'Rural Municipality', 'Tilathi Koiladi', 'तिलाठी कोईलाडी', '', 8),
(220, 21, 'गाउँपालिका', 'Rural Municipality', 'Rajgadh', 'राजगढ', '', 6),
(221, 21, 'गाउँपालिका', 'Rural Municipality', 'Chhinnamasta', 'छिन्नमस्ता', '', 7),
(222, 21, 'गाउँपालिका', 'Rural Municipality', 'Mahadeva', 'महादेवा', '', 6),
(223, 21, 'गाउँपालिका', 'Rural Municipality', 'Agnisaira Krishnasavaran', 'अग्निसाइर कृष्णासवरन', '', 6),
(224, 21, 'गाउँपालिका', 'Rural Municipality', 'Rupani', 'रुपनी', '', 6),
(225, 21, 'गाउँपालिका', 'Rural Municipality', 'Balan-Bihul', 'बलान-बिहुल', '', 6),
(226, 21, 'गाउँपालिका', 'Rural Municipality', 'Bishnupur', 'बिष्णुपुर', '', 7),
(227, 21, 'गाउँपालिका', 'Rural Municipality', 'Tirhut', 'तिरहुत', '', 5),
(228, 21, 'नगरपालिका', 'Municipality', 'Kanchanrup', 'कञ्चनरुप', '', 12),
(229, 21, 'नगरपालिका', 'Municipality', 'Khadak', 'खडक', '', 11),
(230, 21, 'नगरपालिका', 'Municipality', 'Dakneshwari', 'डाक्नेश्वरी', '', 10),
(231, 21, 'नगरपालिका', 'Municipality', 'Rajbiraj', 'राजविराज', '', 16),
(232, 21, 'नगरपालिका', 'Municipality', 'Bodebarsain', 'बोदेबरसाईन', '', 10),
(233, 21, 'नगरपालिका', 'Municipality', 'Shambhunath', 'शम्भुनाथ', '', 12),
(234, 21, 'नगरपालिका', 'Municipality', 'Surunga', 'सुरुगां', '', 11),
(235, 21, 'नगरपालिका', 'Municipality', 'Hanumannagar Kankalini', 'हनुमाननगर कंकालिनी', '', 14),
(236, 21, 'नगरपालिका', 'Municipality', 'Saptakoshi', 'सप्तकोशी', '', 11),
(237, 22, 'गाउँपालिका', 'Rural Municipality', 'Chandranagar', 'चन्द्रनगर', '', 7),
(238, 22, 'गाउँपालिका', 'Rural Municipality', 'Brahampuri', 'ब्रह्मपुरी', '', 7),
(239, 22, 'गाउँपालिका', 'Rural Municipality', 'Ramnagar', 'रामनगर', '', 7),
(240, 22, 'गाउँपालिका', 'Rural Municipality', 'Chakraghatta', 'चक्रघट्टा', '', 9),
(241, 22, 'गाउँपालिका', 'Rural Municipality', 'Kaudena', 'कौडेना', '', 7),
(242, 22, 'गाउँपालिका', 'Rural Municipality', 'Dhankaul', 'धनकौल', '', 7),
(243, 22, 'गाउँपालिका', 'Rural Municipality', 'Bishnu', 'विष्णु', '', 8),
(244, 22, 'गाउँपालिका', 'Rural Municipality', 'Basbariya', 'बसबरिया', '', 6),
(245, 22, 'गाउँपालिका', 'Rural Municipality', 'Parsa', 'पर्सा', '', 6),
(246, 22, 'नगरपालिका', 'Municipality', 'Ishwarpur', 'ईश्वरपुर', '', 15),
(247, 22, 'नगरपालिका', 'Municipality', 'Godaita', 'गोडैटा', '', 12),
(248, 22, 'नगरपालिका', 'Municipality', 'Malangawa', 'मलंगवा', '', 12),
(249, 22, 'नगरपालिका', 'Municipality', 'Lalbandi', 'लालबन्दी', '', 17),
(250, 22, 'नगरपालिका', 'Municipality', 'Barahathawa', 'बरहथवा', '', 18),
(251, 22, 'नगरपालिका', 'Municipality', 'Balara', 'बलरा', '', 11),
(252, 22, 'नगरपालिका', 'Municipality', 'Bagmati', 'बागमती', '', 12),
(253, 22, 'नगरपालिका', 'Municipality', 'Haripur', 'हरिपुर', '', 9),
(254, 22, 'नगरपालिका', 'Municipality', 'Hriwan', 'हरिवन', '', 11),
(255, 22, 'नगरपालिका', 'Municipality', 'Haripurwa', 'हरिपुर्वा', '', 9),
(256, 22, 'नगरपालिका', 'Municipality', 'Kabilasi', 'कबिलासी', '', 10),
(257, 23, 'गाउँपालिका', 'Rural Municipality', 'Laksmipur Patari', 'लक्ष्मीपुर पतारी', '', 6),
(258, 23, 'गाउँपालिका', 'Rural Municipality', 'Bariyarpatti', 'बरियारपट्टी', '', 5),
(259, 23, 'गाउँपालिका', 'Rural Municipality', 'Aurahi', 'औरही', '', 5),
(260, 23, 'गाउँपालिका', 'Rural Municipality', 'Arnama', 'अर्नमा', '', 5),
(261, 23, 'गाउँपालिका', 'Rural Municipality', 'Bhagwanpur', 'भगवानपुर', '', 5),
(262, 23, 'गाउँपालिका', 'Rural Municipality', 'Naraha', 'नरहा', '', 5),
(263, 23, 'गाउँपालिका', 'Rural Municipality', 'Navarajpur', 'नवराजपुर', '', 5),
(264, 23, 'गाउँपालिका', 'Rural Municipality', 'Sakhuwanankarkatti', 'सखुवानान्कारकट्टी', '', 5),
(265, 23, 'गाउँपालिका', 'Rural Municipality', 'Bishnupur', 'विष्णुपुर', '', 5),
(266, 23, 'नगरपालिका', 'Municipality', 'Kalyanpur', 'कल्याणपुर', '', 12),
(267, 23, 'नगरपालिका', 'Municipality', 'Golbazar', 'गोलबजार', '', 13),
(268, 23, 'नगरपालिका', 'Municipality', 'Dhangadhimai', 'धनगढीमाई', '', 14),
(269, 23, 'नगरपालिका', 'Municipality', 'Mirchaiya', 'मिर्चैया', '', 12),
(270, 23, 'नगरपालिका', 'Municipality', 'Lahan', 'लहान', '', 24),
(271, 23, 'नगरपालिका', 'Municipality', 'Siraha', 'सिरहा', '', 22),
(272, 23, 'नगरपालिका', 'Municipality', 'Sukhipur', 'सुखीपुर', '', 10),
(273, 23, 'नगरपालिका', 'Municipality', 'Karjanha', 'कर्जन्हा', '', 11),
(274, 24, 'गाउँपालिका', 'Rural Municipality', 'Ichchhakamana', 'इच्छाकामना', '', 7),
(275, 24, 'नगरपालिका', 'Municipality', 'Kalika', 'कालिका', '', 11),
(276, 24, 'नगरपालिका', 'Municipality', 'Khairhani', 'खैरहनी', '', 13),
(277, 24, 'नगरपालिका', 'Municipality', 'Madi', 'माडी', '', 9),
(278, 24, 'नगरपालिका', 'Municipality', 'Ratnanagar', 'रत्ननगर', '', 16),
(279, 24, 'नगरपालिका', 'Municipality', 'Rapti', 'राप्ती', '', 13),
(280, 24, 'महानगरपालिका', 'Metropolitan City', 'Bharatpur', 'भरतपुर', '', 29),
(281, 25, 'गाउँपालिका', 'Rural Municipality', 'Thakre', 'थाक्रे', '', 11),
(282, 25, 'गाउँपालिका', 'Rural Municipality', 'Benighat Rorang', 'बेनीघाट रोराङ्ग', '', 10),
(283, 25, 'गाउँपालिका', 'Rural Municipality', 'Galchhi', 'गल्छी', '', 8),
(284, 25, 'गाउँपालिका', 'Rural Municipality', 'Gajuri', 'गजुरी', '', 8),
(285, 25, 'गाउँपालिका', 'Rural Municipality', 'Jwalamukhi', 'ज्वालामूखी', '', 7),
(286, 25, 'गाउँपालिका', 'Rural Municipality', 'Siddhalekh', 'सिद्धलेक', '', 7),
(287, 25, 'गाउँपालिका', 'Rural Municipality', 'Tripurasundari', 'त्रिपुरासुन्दरी', '', 7),
(288, 25, 'गाउँपालिका', 'Rural Municipality', 'Gangajamuna', 'गङ्गाजमुना', '', 7),
(289, 25, 'गाउँपालिका', 'Rural Municipality', 'Netrawati Dabjong', 'नेत्रावती डबजोङ', '', 5),
(290, 25, 'गाउँपालिका', 'Rural Municipality', 'Khaniyabas', 'खनियाबास', '', 5),
(291, 25, 'गाउँपालिका', 'Rural Municipality', 'Rubi Valley', 'रुवी भ्याली', '', 6),
(292, 25, 'नगरपालिका', 'Municipality', 'Dhunibeshi', 'धुनीबेंसी', '', 9),
(293, 25, 'नगरपालिका', 'Municipality', 'Nilkantha', 'नीलकण्ठ', '', 14),
(294, 26, 'गाउँपालिका', 'Rural Municipality', 'Kalinchok', 'कालिन्चोक', '', 9),
(295, 26, 'गाउँपालिका', 'Rural Municipality', 'Melung', 'मेलुङ', '', 7),
(296, 26, 'गाउँपालिका', 'Rural Municipality', 'Shailung', 'शैलुङ', '', 8),
(297, 26, 'गाउँपालिका', 'Rural Municipality', 'Baiteshwar', 'वैतेश्वर', '', 8),
(298, 26, 'गाउँपालिका', 'Rural Municipality', 'Tamakoshi', 'तामाकोशी', '', 7),
(299, 26, 'गाउँपालिका', 'Rural Municipality', 'Bigu', 'विगु', '', 8),
(300, 26, 'गाउँपालिका', 'Rural Municipality', 'Gaurishankar', 'गौरिशंकर', '', 9),
(301, 26, 'नगरपालिका', 'Municipality', 'Jiri', 'जिरी', '', 9),
(302, 26, 'नगरपालिका', 'Municipality', 'Bhimeshwar', 'भिमेश्वर', '', 9),
(303, 27, 'गाउँपालिका', 'Rural Municipality', 'Roshi', 'रोशी', '', 12),
(304, 27, 'गाउँपालिका', 'Rural Municipality', 'Temal', 'तेमाल', '', 9),
(305, 27, 'गाउँपालिका', 'Rural Municipality', 'Chaunri Deurali', 'चौंरी देउराली', '', 9),
(306, 27, 'गाउँपालिका', 'Rural Municipality', 'Bhumlu', 'भुम्लु', '', 10),
(307, 27, 'गाउँपालिका', 'Rural Municipality', 'Mahabharat', 'महाभारत', '', 8),
(308, 27, 'गाउँपालिका', 'Rural Municipality', 'Bethanchok', 'बेथानचोक', '', 6),
(309, 27, 'गाउँपालिका', 'Rural Municipality', 'Khanikhola', 'खानीखोला', '', 7),
(310, 27, 'नगरपालिका', 'Municipality', 'Dhulikhel', 'धुलिखेल', '', 12),
(311, 27, 'नगरपालिका', 'Municipality', 'Namobuddha', 'नमोबुद्ध', '', 11),
(312, 27, 'नगरपालिका', 'Municipality', 'Panauti', 'पनौती', '', 12),
(313, 27, 'नगरपालिका', 'Municipality', 'Panchkhal', 'पांचखाल', '', 13),
(314, 27, 'नगरपालिका', 'Municipality', 'Banepa', 'बनेपा', '', 14),
(315, 27, 'नगरपालिका', 'Municipality', 'Mandandeupur', 'मण्डनदेउपुर', '', 12),
(316, 28, 'नगरपालिका', 'Municipality', 'Kageshwari Manohara', 'कागेश्वरी–मनोहरा', '', 9),
(317, 28, 'नगरपालिका', 'Municipality', 'Kirtipur', 'कीर्तिपुर', '', 10),
(318, 28, 'नगरपालिका', 'Municipality', 'Gokarneshwor', 'गोकर्णेश्वर', '', 9),
(319, 28, 'नगरपालिका', 'Municipality', 'Chandragiri', 'चन्द्रागिरी', '', 15),
(320, 28, 'नगरपालिका', 'Municipality', 'Tokha', 'टोखा', '', 11),
(321, 28, 'नगरपालिका', 'Municipality', 'Tarkeshwar', 'तारकेश्वर', '', 11),
(322, 28, 'नगरपालिका', 'Municipality', 'Dakshinkali', 'दक्षिणकाली', '', 9),
(323, 28, 'नगरपालिका', 'Municipality', 'Nagarjun', 'नागार्जुन', '', 10),
(324, 28, 'नगरपालिका', 'Municipality', 'Budhanilkantha', 'बुढानिलकण्ठ', '', 13),
(325, 28, 'नगरपालिका', 'Municipality', 'Shankharapur', 'शंखरापुर', '', 9),
(326, 28, 'महानगरपालिका', 'Metropolitan City', 'Kathmandu', 'काठमाण्डौं', '', 32),
(327, 29, 'नगरपालिका', 'Municipality', 'Changunarayan', 'चाँगुनारायण', '', 9),
(328, 29, 'नगरपालिका', 'Municipality', 'Bhaktapur', 'भक्तपुर', '', 10),
(329, 29, 'नगरपालिका', 'Municipality', 'Madhyapur', 'मध्यपुर थिमी', '', 9),
(330, 29, 'नगरपालिका', 'Municipality', 'Suryabinayak', 'सूर्यविनायक', '', 10),
(331, 30, 'गाउँपालिका', 'Rural Municipality', 'Bagmati', 'बाग्मती', '', 7),
(332, 30, 'गाउँपालिका', 'Rural Municipality', 'Konjyosom', 'कोन्ज्योसोम', '', 5),
(333, 30, 'गाउँपालिका', 'Rural Municipality', 'Mahankal', 'महाङ्काल', '', 6),
(334, 30, 'नगरपालिका', 'Municipality', 'Godawari', 'गोदावरी', '', 14),
(335, 30, 'नगरपालिका', 'Municipality', 'Mahalaxmi', 'महालक्ष्मी', '', 10),
(336, 30, 'महानगरपालिका', 'Metropolitan City', 'Lalitpur', 'ललितपुर', '', 29),
(337, 31, 'गाउँपालिका', 'Rural Municipality', 'Bakaiya', 'बकैया', '', 12),
(338, 31, 'गाउँपालिका', 'Rural Municipality', 'Manahari', 'मनहरी', '', 9),
(339, 31, 'गाउँपालिका', 'Rural Municipality', 'Bagmati', 'बाग्मती', '', 9),
(340, 31, 'गाउँपालिका', 'Rural Municipality', 'Raksirang', 'राक्सिराङ्ग', '', 9),
(341, 31, 'गाउँपालिका', 'Rural Municipality', 'Makawanpurgadhi', 'मकवानपुरगढी', '', 8),
(342, 31, 'गाउँपालिका', 'Rural Municipality', 'Kailash', 'कैलाश', '', 10),
(343, 31, 'गाउँपालिका', 'Rural Municipality', 'Bhimphedi', 'भीमफेदी', '', 9),
(344, 31, 'गाउँपालिका', 'Rural Municipality', 'Indrasarowar', 'ईन्द्र सरोवर', '', 5),
(345, 31, 'नगरपालिका', 'Municipality', 'Ihaha', 'थाहा', '', 12),
(346, 31, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Hetauda', 'हेटौंडा', '', 19),
(347, 32, 'गाउँपालिका', 'Rural Municipality', 'Kakani', 'ककनी', '', 8),
(348, 32, 'गाउँपालिका', 'Rural Municipality', 'Dupcheshwar', 'दुप्चेश्वर', '', 7),
(349, 32, 'गाउँपालिका', 'Rural Municipality', 'Shivapuri', 'शिवपुरी', '', 8),
(350, 32, 'गाउँपालिका', 'Rural Municipality', 'Tadi', 'तादी', '', 6),
(351, 32, 'गाउँपालिका', 'Rural Municipality', 'Likhu', 'लिखु', '', 6),
(352, 32, 'गाउँपालिका', 'Rural Municipality', 'Suryagadhi', 'सुर्यगढी', '', 5),
(353, 32, 'गाउँपालिका', 'Rural Municipality', 'Panchakanya', 'पञ्चकन्या', '', 5),
(354, 32, 'गाउँपालिका', 'Rural Municipality', 'Tarkeshwar', 'तारकेश्वर', '', 6),
(355, 32, 'गाउँपालिका', 'Rural Municipality', 'Kispang', 'किस्पाङ', '', 5),
(356, 32, 'गाउँपालिका', 'Rural Municipality', 'Myagang', 'म्यागङ', '', 6),
(357, 32, 'नगरपालिका', 'Municipality', 'Bidur', 'विदुर', '', 13),
(358, 32, 'नगरपालिका', 'Municipality', 'Belkotgadhi', 'बेलकोटगढी', '', 13),
(359, 33, 'गाउँपालिका', 'Rural Municipality', 'Khandadevi', 'खाँडादेवी', '', 9),
(360, 33, 'गाउँपालिका', 'Rural Municipality', 'Likhu Tamakoshi', 'लिखु तामाकोशी', '', 7),
(361, 33, 'गाउँपालिका', 'Rural Municipality', 'Doramba Sailung', 'दोरम्बा शैलुङ', '', 7),
(362, 33, 'गाउँपालिका', 'Rural Municipality', 'Gokulganga', 'गोकुलगङ्गा', '', 6),
(363, 33, 'गाउँपालिका', 'Rural Municipality', 'Sunapati', 'सुनापती', '', 5),
(364, 33, 'गाउँपालिका', 'Rural Municipality', 'Umakunda', 'उमाकुण्ड', '', 7),
(365, 33, 'नगरपालिका', 'Municipality', 'Manthali', 'मन्थली', '', 14),
(366, 33, 'नगरपालिका', 'Municipality', 'Ramechhap', 'रामेछाप', '', 9),
(367, 34, 'गाउँपालिका', 'Rural Municipality', 'Naukunda', 'नौकुण्ड', '', 6),
(368, 34, 'गाउँपालिका', 'Rural Municipality', 'Kalika', 'कालिका', '', 5),
(369, 34, 'गाउँपालिका', 'Rural Municipality', 'Uttargaya', 'उत्तरगया', '', 5),
(370, 34, 'गाउँपालिका', 'Rural Municipality', 'Gosaikund', 'गोसाईकुण्ड', '', 6),
(371, 34, 'गाउँपालिका', 'Rural Municipality', 'Aamachodingmo', 'आमाछोदिङमो', '', 5),
(372, 35, 'गाउँपालिका', 'Rural Municipality', 'Tinpatan', 'तिनपाटन', '', 11),
(373, 35, 'गाउँपालिका', 'Rural Municipality', 'Marin', 'मरिण', '', 7),
(374, 35, 'गाउँपालिका', 'Rural Municipality', 'Hariharpurgadhi', 'हरिहरपुरगढी', '', 8),
(375, 35, 'गाउँपालिका', 'Rural Municipality', 'Sunkoshi', 'सुनकोशी', '', 7),
(376, 35, 'गाउँपालिका', 'Rural Municipality', 'Golanjor', 'गोलन्जोर', '', 7),
(377, 35, 'गाउँपालिका', 'Rural Municipality', 'Phikkal', 'फिक्कल', '', 6),
(378, 35, 'गाउँपालिका', 'Rural Municipality', 'Ghyanglekh', 'घ्याङलेख', '', 5),
(379, 35, 'नगरपालिका', 'Municipality', 'Kamalamai', 'कमलामाई', '', 14),
(380, 35, 'नगरपालिका', 'Municipality', 'Dudhauli', 'दुधौली', '', 14),
(381, 36, 'गाउँपालिका', 'Rural Municipality', 'Indrawati', 'ईन्द्रावती', '', 12),
(382, 36, 'गाउँपालिका', 'Rural Municipality', 'Panchpokhari Thangpal', 'पाँचपोखरी थाङपाल', '', 8),
(383, 36, 'गाउँपालिका', 'Rural Municipality', 'Jugal', 'जुगल', '', 7),
(384, 36, 'गाउँपालिका', 'Rural Municipality', 'Balephi', 'बलेफी', '', 8),
(385, 36, 'गाउँपालिका', 'Rural Municipality', 'Helambu', 'हेलम्बु', '', 7),
(386, 36, 'गाउँपालिका', 'Rural Municipality', 'Bhotekoshi', 'भोटेकोशी', '', 5),
(387, 36, 'गाउँपालिका', 'Rural Municipality', 'Sunkoshi', 'सुनकोशी', '', 7),
(388, 36, 'गाउँपालिका', 'Rural Municipality', 'Lisankhu Pakhar', 'लिसंखु पाखर', '', 7),
(389, 36, 'गाउँपालिका', 'Rural Municipality', 'Tripurasundari', 'त्रिपुरासुन्दरी', '', 6),
(390, 36, 'नगरपालिका', 'Municipality', 'Chautara Sagachokgadhi', 'चौतारा सागाचोकगढी', '', 14),
(391, 36, 'नगरपालिका', 'Municipality', 'Melamchi', 'मेलम्ची', '', 13),
(392, 36, 'नगरपालिका', 'Municipality', 'Barhabise', 'वाह्रविसे', '', 9),
(393, 37, 'गाउँपालिका', 'Rural Municipality', 'Badigad', 'वडिगाड', '', 10),
(394, 37, 'गाउँपालिका', 'Rural Municipality', 'Kathekhola', 'काठेखोला', '', 8),
(395, 37, 'गाउँपालिका', 'Rural Municipality', 'Nisikhola', 'निसीखोला', '', 7),
(396, 37, 'गाउँपालिका', 'Rural Municipality', 'Bareng', 'वरेङ', '', 5),
(397, 37, 'गाउँपालिका', 'Rural Municipality', 'Tarakhola', 'ताराखोला', '', 5),
(398, 37, 'गाउँपालिका', 'Rural Municipality', 'Tamankhola', 'तमानखोला', '', 6),
(399, 37, 'नगरपालिका', 'Municipality', 'Galkot', 'गल्कोट', '', 11),
(400, 37, 'नगरपालिका', 'Municipality', 'Jaimuni', 'जैमुनी', '', 10),
(401, 37, 'नगरपालिका', 'Municipality', 'Dhorpatan', 'ढोरपाटन', '', 9),
(402, 37, 'नगरपालिका', 'Municipality', 'Baglung', 'बाग्लुङ', '', 14),
(403, 38, 'गाउँपालिका', 'Rural Municipality', 'Shahid Lakhan', 'शहिद लखन', '', 9),
(404, 38, 'गाउँपालिका', 'Rural Municipality', 'Barpak Sulikot', 'बारपाक सुलीकोट', '', 8),
(405, 38, 'गाउँपालिका', 'Rural Municipality', 'Aarughat', 'आरूघाट', '', 10),
(406, 38, 'गाउँपालिका', 'Rural Municipality', 'Siranchowk', 'सिरानचोक', '', 8),
(407, 38, 'गाउँपालिका', 'Rural Municipality', 'Gandaki', 'गण्डकी', '', 8),
(408, 38, 'गाउँपालिका', 'Rural Municipality', 'Bhimsen Thapa', 'भिमसेनथापा', '', 8),
(409, 38, 'गाउँपालिका', 'Rural Municipality', 'Ajirkot', 'अजिरकोट', '', 5),
(410, 38, 'गाउँपालिका', 'Rural Municipality', 'Dharche', 'धार्चे', '', 7),
(411, 38, 'गाउँपालिका', 'Rural Municipality', 'Tsumnubri', 'चुमनुव्री', '', 7),
(412, 38, 'नगरपालिका', 'Municipality', 'Gorkha', 'गोरखा', '', 14),
(413, 38, 'नगरपालिका', 'Municipality', 'Palungtar', 'पालुङटार', '', 10),
(414, 39, 'गाउँपालिका', 'Rural Municipality', 'Annapurna', 'अन्नपुर्ण', '', 11),
(415, 39, 'गाउँपालिका', 'Rural Municipality', 'Machhapuchhre', 'माछापुछ्रे', '', 9),
(416, 39, 'गाउँपालिका', 'Rural Municipality', 'Madi', 'मादी', '', 12),
(417, 39, 'गाउँपालिका', 'Rural Municipality', 'Rupa', 'रूपा', '', 7),
(418, 39, 'महानगरपालिका', 'Metropolitan City', 'Pokhara', 'पोखरा', '', 33),
(419, 40, 'गाउँपालिका', 'Rural Municipality', 'Marsyangdi', 'मर्स्याङदी', '', 9),
(420, 40, 'गाउँपालिका', 'Rural Municipality', 'Dordi', 'दोर्दी', '', 9),
(421, 40, 'गाउँपालिका', 'Rural Municipality', 'Dudhpokhari', 'दूधपोखरी', '', 6),
(422, 40, 'गाउँपालिका', 'Rural Municipality', 'Kwaholasothar', 'क्व्होलासोथार', '', 9),
(423, 40, 'नगरपालिका', 'Municipality', 'Besishahar', 'बेसीशहर', '', 11),
(424, 40, 'नगरपालिका', 'Municipality', 'Madhyanepal', 'मध्यनेपाल', '', 10),
(425, 40, 'नगरपालिका', 'Municipality', 'Rainas', 'राईनास', '', 10),
(426, 40, 'नगरपालिका', 'Municipality', 'Sundarbazar', 'सुन्दरबजार', '', 11),
(427, 41, 'गाउँपालिका', 'Rural Municipality', 'Manang Disyang', 'मनाङ डिस्याङ', '', 9),
(428, 41, 'गाउँपालिका', 'Rural Municipality', 'Nason', 'नासोँ', '', 9),
(429, 41, 'गाउँपालिका', 'Rural Municipality', 'Chame', 'चामे', '', 5),
(430, 41, 'गाउँपालिका', 'Rural Municipality', 'Narpa Bhumi', 'नार्पा भूमी', '', 5),
(431, 42, 'गाउँपालिका', 'Rural Municipality', 'Gharapjhong', 'घरपझोङ', '', 5),
(432, 42, 'गाउँपालिका', 'Rural Municipality', 'Thasang', 'थासाङ', '', 5),
(433, 42, 'गाउँपालिका', 'Rural Municipality', 'Baragung Muktichhetra', 'बारागुङ मुक्तिक्षेत्र', '', 5),
(434, 42, 'गाउँपालिका', 'Rural Municipality', 'Lomanthang', 'लोमन्थाङ', '', 5),
(435, 42, 'गाउँपालिका', 'Rural Municipality', 'Lo-Ghekar Damodarkunda', 'लो-घेकर दामोदरकुण्ड', '', 5),
(436, 43, 'गाउँपालिका', 'Rural Municipality', 'Malika', 'मालिका', '', 7),
(437, 43, 'गाउँपालिका', 'Rural Municipality', 'Mangala', 'मंगला', '', 5),
(438, 43, 'गाउँपालिका', 'Rural Municipality', 'Raghuganga', 'रघुगंगा', '', 8),
(439, 43, 'गाउँपालिका', 'Rural Municipality', 'Dhaulagiri', 'धवलागिरी', '', 7),
(440, 43, 'गाउँपालिका', 'Rural Municipality', 'Annapurna', 'अन्नपुर्ण', '', 8),
(441, 43, 'नगरपालिका', 'Municipality', 'Beni', 'बेनी', '', 10),
(442, 44, 'नगरपालिका', 'Municipality', 'Kawasoti', 'कावासोती', '', 17),
(443, 44, 'नगरपालिका', 'Municipality', 'Gaidakot', 'गैंडाकोट', '', 18),
(444, 44, 'नगरपालिका', 'Municipality', 'Debchuli', 'देवचुली', '', 17),
(445, 44, 'नगरपालिका', 'Municipality', 'Madhyabindu', 'मध्यविन्दु', '', 15),
(446, 44, 'गाउँपालिका', 'Rural Municipality', 'Hupsekot', 'हुप्सेकोट', '', 6),
(447, 44, 'गाउँपालिका', 'Rural Municipality', 'Binayi Triveni', 'विनयी त्रिवेणी', '', 7),
(448, 44, 'गाउँपालिका', 'Rural Municipality', 'Bulingtar', 'बुलिङटार', '', 6),
(449, 44, 'गाउँपालिका', 'Rural Municipality', 'Baudikali', 'बौदीकाली', '', 6),
(450, 45, 'गाउँपालिका', 'Rural Municipality', 'Jaljala', 'जलजला', '', 9),
(451, 45, 'गाउँपालिका', 'Rural Municipality', 'Modi', 'मोदी', '', 8),
(452, 45, 'गाउँपालिका', 'Rural Municipality', 'Paiyun', 'पैयूं', '', 7),
(453, 45, 'गाउँपालिका', 'Rural Municipality', 'Bihadi', 'विहादी', '', 6),
(454, 45, 'गाउँपालिका', 'Rural Municipality', 'Mahashila', 'महाशिला', '', 6),
(455, 45, 'नगरपालिका', 'Municipality', 'Kushma', 'कुश्मा', '', 14),
(456, 45, 'नगरपालिका', 'Municipality', 'Phalewas', 'फलेवास', '', 11),
(457, 46, 'गाउँपालिका', 'Rural Municipality', 'Kaligandaki', 'कालीगण्डकी', '', 7),
(458, 46, 'गाउँपालिका', 'Rural Municipality', 'Biruwa', 'विरुवा', '', 8),
(459, 46, 'गाउँपालिका', 'Rural Municipality', 'Harinas', 'हरीनास', '', 7),
(460, 46, 'गाउँपालिका', 'Rural Municipality', 'Aandhikhola', 'आँधीखोला', '', 6),
(461, 46, 'गाउँपालिका', 'Rural Municipality', 'Arjun Chaupari', 'अर्जुन चौपारी', '', 6),
(462, 46, 'गाउँपालिका', 'Rural Municipality', 'Phedikhola', 'फेदीखोला', '', 5),
(463, 46, 'नगरपालिका', 'Municipality', 'Galyang', 'गल्याङ', '', 11),
(464, 46, 'नगरपालिका', 'Municipality', 'Chapakot', 'चापाकोट', '', 10),
(465, 46, 'नगरपालिका', 'Municipality', 'Putalibazar', 'पुतलीबजार', '', 14),
(466, 46, 'नगरपालिका', 'Municipality', 'Bhirkot', 'भीरकोट', '', 9),
(467, 46, 'नगरपालिका', 'Municipality', 'Waling', 'वालिङ', '', 14),
(468, 47, 'गाउँपालिका', 'Rural Municipality', 'Rishing', 'ऋषिङ्ग', '', 8),
(469, 47, 'गाउँपालिका', 'Rural Municipality', 'Myagde', 'म्याग्दे', '', 7),
(470, 47, 'गाउँपालिका', 'Rural Municipality', 'Aanbu Khaireni', 'आँबुखैरेनी', '', 6),
(471, 47, 'गाउँपालिका', 'Rural Municipality', 'Bandipur', 'बन्दिपुर', '', 6),
(472, 47, 'गाउँपालिका', 'Rural Municipality', 'Ghiring', 'घिरिङ', '', 5),
(473, 47, 'गाउँपालिका', 'Rural Municipality', 'Devghat', 'देवघाट', '', 5),
(474, 47, 'नगरपालिका', 'Municipality', 'Bhanu', 'भानु', '', 13),
(475, 47, 'नगरपालिका', 'Municipality', 'Bhimad', 'भिमाद', '', 9),
(476, 47, 'नगरपालिका', 'Municipality', 'Byas', 'व्यास', '', 14),
(477, 47, 'नगरपालिका', 'Municipality', 'Suklagandaki', 'शुक्लागण्डकी', '', 12),
(478, 48, 'गाउँपालिका', 'Rural Municipality', 'Malarani', 'मालारानी', '', 9),
(479, 48, 'गाउँपालिका', 'Rural Municipality', 'Panini', 'पाणिनी', '', 8),
(480, 48, 'गाउँपालिका', 'Rural Municipality', 'Chhatradev', 'छत्रदेव', '', 8),
(481, 48, 'नगरपालिका', 'Municipality', 'Bhumikasthan', 'भुमिकास्थान', '', 10),
(482, 48, 'नगरपालिका', 'Municipality', 'Sitaganga', 'शितगंगा', '', 14),
(483, 48, 'नगरपालिका', 'Municipality', 'Sandhikharka', 'सन्धिखर्क', '', 12),
(484, 49, 'गाउँपालिका', 'Rural Municipality', 'Raptisonari', 'राप्ती सोनारी', '', 9),
(485, 49, 'गाउँपालिका', 'Rural Municipality', 'Baijanath', 'वैजनाथ', '', 8),
(486, 49, 'गाउँपालिका', 'Rural Municipality', 'Khajura', 'खजुरा', '', 8),
(487, 49, 'गाउँपालिका', 'Rural Municipality', 'Janaki', 'जानकी', '', 6),
(488, 49, 'गाउँपालिका', 'Rural Municipality', 'Duduwa', 'डुडुवा', '', 6),
(489, 49, 'गाउँपालिका', 'Rural Municipality', 'Narainapur', 'नरैनापुर', '', 6),
(490, 49, 'नगरपालिका', 'Municipality', 'Kohalpur', 'कोहलपुर', '', 15),
(491, 49, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Nepalgunj', 'नेपालगञ्ज', '', 23),
(492, 50, 'गाउँपालिका', 'Rural Municipality', 'Badhaiyatal', 'बढैयाताल', '', 9),
(493, 50, 'गाउँपालिका', 'Rural Municipality', 'Geruwa', 'गेरुवा', '', 6),
(494, 50, 'नगरपालिका', 'Municipality', 'Gulariya', 'गुलरिया', '', 12),
(495, 50, 'नगरपालिका', 'Municipality', 'Thakurbaba', 'ठाकुरबाबा', '', 9),
(496, 50, 'नगरपालिका', 'Municipality', 'Bansagadhi', 'बाँसगढी', '', 9),
(497, 50, 'नगरपालिका', 'Municipality', 'Madhuban', 'मधुवन', '', 9),
(498, 50, 'नगरपालिका', 'Municipality', 'Rajapur', 'राजापुर', '', 10),
(499, 50, 'नगरपालिका', 'Municipality', 'Barbardiya', 'बारबर्दिया', '', 11),
(500, 51, 'गाउँपालिका', 'Rural Municipality', 'Rapti', 'राप्ती', '', 9),
(501, 51, 'गाउँपालिका', 'Rural Municipality', 'Gadhawa', 'गढवा', '', 8),
(502, 51, 'गाउँपालिका', 'Rural Municipality', 'Babai', 'बबई', '', 7),
(503, 51, 'गाउँपालिका', 'Rural Municipality', 'Shantinagar', 'शान्तिनगर', '', 7),
(504, 51, 'गाउँपालिका', 'Rural Municipality', 'Rajpur', 'राजपुर', '', 7),
(505, 51, 'गाउँपालिका', 'Rural Municipality', 'Banglachuli', 'वंगलाचुली', '', 8),
(506, 51, 'गाउँपालिका', 'Rural Municipality', 'Dangisharan', 'दंगीशरण', '', 7),
(507, 51, 'नगरपालिका', 'Municipality', 'Lamahi', 'लमही', '', 9),
(508, 51, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Ghorahi', 'घोराही', '', 19),
(509, 51, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Tulsipur', 'तुल्सीपुर', '', 19),
(510, 52, 'गाउँपालिका', 'Rural Municipality', 'Satyawati', 'सत्यवती', '', 8),
(511, 52, 'गाउँपालिका', 'Rural Municipality', 'Dhurkot', 'धुर्कोट', '', 7),
(512, 52, 'गाउँपालिका', 'Rural Municipality', 'Gulmi Darbar', 'गुल्मीदरवार', '', 7),
(513, 52, 'गाउँपालिका', 'Rural Municipality', 'Madane', 'मदाने', '', 7),
(514, 52, 'गाउँपालिका', 'Rural Municipality', 'Chandrakot', 'चन्द्रकोट', '', 8),
(515, 52, 'गाउँपालिका', 'Rural Municipality', 'Malika', 'मालिका', '', 8),
(516, 52, 'गाउँपालिका', 'Rural Municipality', 'Chhatrakot', 'छत्रकोट', '', 6),
(517, 52, 'गाउँपालिका', 'Rural Municipality', 'Isma', 'ईस्मा', '', 6),
(518, 52, 'गाउँपालिका', 'Rural Municipality', 'Kaligandaki', 'कालीगण्डकी', '', 7),
(519, 52, 'गाउँपालिका', 'Rural Municipality', 'Ruru', 'रुरु', '', 6),
(520, 52, 'नगरपालिका', 'Municipality', 'Musikot', 'मुसिकोट', '', 9),
(521, 52, 'नगरपालिका', 'Municipality', 'Resunga', 'रेसुंगा', '', 14),
(522, 53, 'गाउँपालिका', 'Rural Municipality', 'Mayadevi', 'मायादेवी', '', 8),
(523, 53, 'गाउँपालिका', 'Rural Municipality', 'Suddhodhan', 'शुद्धोधन', '', 6),
(524, 53, 'गाउँपालिका', 'Rural Municipality', 'Yasodhara', 'यसोधरा', '', 8),
(525, 53, 'गाउँपालिका', 'Rural Municipality', 'Bijaynagar', 'विजयनगर', '', 7),
(526, 53, 'नगरपालिका', 'Municipality', 'Kapilbastu', 'कपिलवस्तु', '', 12),
(527, 53, 'नगरपालिका', 'Municipality', 'Krishnagar', 'कृष्णनगर', '', 12),
(528, 53, 'नगरपालिका', 'Municipality', 'Banganga', 'बाणगंगा', '', 11),
(529, 53, 'नगरपालिका', 'Municipality', 'Buddhabhumi', 'बुद्धभुमी', '', 10),
(530, 53, 'नगरपालिका', 'Municipality', 'Maharajgunj', 'महाराजगञ्ज', '', 11),
(531, 53, 'नगरपालिका', 'Municipality', 'Shivraj', 'शिवराज', '', 11),
(532, 54, 'गाउँपालिका', 'Rural Municipality', 'Susta', 'सुस्ता', '', 5),
(533, 54, 'गाउँपालिका', 'Rural Municipality', 'Pratappur', 'प्रतापपुर', '', 9),
(534, 54, 'गाउँपालिका', 'Rural Municipality', 'Sarawal', 'सरावल', '', 7),
(535, 54, 'गाउँपालिका', 'Rural Municipality', 'Palhinandan', 'पाल्हीनन्दन', '', 6),
(536, 54, 'नगरपालिका', 'Municipality', 'Bardaghat', 'बर्दघाट', '', 16),
(537, 54, 'नगरपालिका', 'Municipality', 'Ramgram', 'रामग्राम', '', 18),
(538, 54, 'नगरपालिका', 'Municipality', 'Sunwal', 'सुनवल', '', 13),
(539, 55, 'गाउँपालिका', 'Rural Municipality', 'Rainadevi Chhahara', 'रैनादेवी छहरा', '', 8),
(540, 55, 'गाउँपालिका', 'Rural Municipality', 'Mathagadhi', 'माथागढी', '', 8),
(541, 55, 'गाउँपालिका', 'Rural Municipality', 'Nisdi', 'निस्दी', '', 7),
(542, 55, 'गाउँपालिका', 'Rural Municipality', 'Bagnaskali', 'वगनासकाली', '', 9),
(543, 55, 'गाउँपालिका', 'Rural Municipality', 'Rambha', 'रम्भा', '', 5),
(544, 55, 'गाउँपालिका', 'Rural Municipality', 'Purbakhola', 'पूर्वखोला', '', 6),
(545, 55, 'गाउँपालिका', 'Rural Municipality', 'Tinau', 'तिनाउ', '', 6),
(546, 55, 'गाउँपालिका', 'Rural Municipality', 'Ribdikot', 'रिब्दीकोट', '', 8),
(547, 55, 'नगरपालिका', 'Municipality', 'Tansen', 'तानसेन', '', 14),
(548, 55, 'नगरपालिका', 'Municipality', 'Rampur', 'रामपुर', '', 10),
(549, 56, 'गाउँपालिका', 'Rural Municipality', 'Naubahini', 'नौबहिनी', '', 8),
(550, 56, 'गाउँपालिका', 'Rural Municipality', 'Jhimruk', 'झिमरुक', '', 8),
(551, 56, 'गाउँपालिका', 'Rural Municipality', 'Gaumukhi', 'गौमुखी', '', 7),
(552, 56, 'गाउँपालिका', 'Rural Municipality', 'Airawati', 'ऐरावती', '', 6),
(553, 56, 'गाउँपालिका', 'Rural Municipality', 'Sarumarani', 'सरुमारानी', '', 6),
(554, 56, 'गाउँपालिका', 'Rural Municipality', 'Mallarani', 'मल्लरानी', '', 5),
(555, 56, 'गाउँपालिका', 'Rural Municipality', 'Mandavi', 'माण्डवी', '', 5),
(556, 56, 'नगरपालिका', 'Municipality', 'pyuthan', 'प्यूठान', '', 10),
(557, 56, 'नगरपालिका', 'Municipality', 'Swargadwari', 'स्वर्गद्वारी', '', 9),
(558, 57, 'गाउँपालिका', 'Rural Municipality', 'Sunilsmriti', 'सुनिलस्मृति', '', 8),
(559, 57, 'गाउँपालिका', 'Rural Municipality', 'Runtigadhi', 'रुन्टीगढी', '', 9),
(560, 57, 'गाउँपालिका', 'Rural Municipality', 'Lungri', 'लुङ्ग्री', '', 7),
(561, 57, 'गाउँपालिका', 'Rural Municipality', 'Triveni', 'त्रिवेणी', '', 7),
(562, 57, 'गाउँपालिका', 'Rural Municipality', 'Paribartan', 'परिवर्तन', '', 6),
(563, 57, 'गाउँपालिका', 'Rural Municipality', 'Gangadev', 'गंगादेव', '', 7),
(564, 57, 'गाउँपालिका', 'Rural Municipality', 'Madi', 'माडी', '', 6),
(565, 57, 'गाउँपालिका', 'Rural Municipality', 'Sunchhahari', 'सुनछहरी', '', 6),
(566, 57, 'गाउँपालिका', 'Rural Municipality', 'Thabang', 'थवाङ', '', 5),
(567, 57, 'नगरपालिका', 'Municipality', 'Rolpa', 'रोल्पा', '', 10),
(568, 58, 'गाउँपालिका', 'Rural Municipality', 'Bhume', 'भूमे', '', 9),
(569, 58, 'गाउँपालिका', 'Rural Municipality', 'Putha Uttarganga', 'पुथा उत्तरगंगा', '', 14),
(570, 58, 'गाउँपालिका', 'Rural Municipality', 'Sisne', 'सिस्ने', '', 8),
(571, 59, 'गाउँपालिका', 'Rural Municipality', 'Gaidhawa', 'गैडहवा', '', 9),
(572, 59, 'गाउँपालिका', 'Rural Municipality', 'Mayadevi', 'मायादेवी', '', 8),
(573, 59, 'गाउँपालिका', 'Rural Municipality', 'Kotahimai', 'कोटहीमाई', '', 7),
(574, 59, 'गाउँपालिका', 'Rural Municipality', 'Marchawari', 'मर्चवारी', '', 7),
(575, 59, 'गाउँपालिका', 'Rural Municipality', 'Siyari', 'सियारी', '', 7),
(576, 59, 'गाउँपालिका', 'Rural Municipality', 'Sammarimai', 'सम्मरीमाई', '', 7),
(577, 59, 'गाउँपालिका', 'Rural Municipality', 'Rohini', 'रोहिणी', '', 7),
(578, 59, 'गाउँपालिका', 'Rural Municipality', 'Shuddhodhan', 'शुद्धोधन', '', 7),
(579, 59, 'गाउँपालिका', 'Rural Municipality', 'Omsatiya', 'ओमसतीया', '', 6),
(580, 59, 'गाउँपालिका', 'Rural Municipality', 'Kanchan', 'कञ्चन', '', 5),
(581, 59, 'नगरपालिका', 'Municipality', 'Tilottama', 'तिलोत्तमा', '', 17),
(582, 59, 'नगरपालिका', 'Municipality', 'Devdaha', 'देवदह', '', 12),
(583, 59, 'नगरपालिका', 'Municipality', 'Lumbini Sanskritik', 'लुम्विनी सांस्कृतिक', '', 13),
(584, 59, 'नगरपालिका', 'Municipality', 'Siddharthanagar', 'सिद्धार्थनगर', '', 13),
(585, 59, 'नगरपालिका', 'Municipality', 'Sainamaina', 'सैनामैना', '', 11),
(586, 59, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Butwal', 'बुटवल', '', 19),
(587, 60, 'गाउँपालिका', 'Rural Municipality', 'Gurans', 'गुराँस', '', 8),
(588, 60, 'गाउँपालिका', 'Rural Municipality', 'Bhairabi', 'भैरवी', '', 7),
(589, 60, 'गाउँपालिका', 'Rural Municipality', 'Naumule', 'नौमुले', '', 8),
(590, 60, 'गाउँपालिका', 'Rural Municipality', 'Mahabu', 'महावु', '', 6),
(591, 60, 'गाउँपालिका', 'Rural Municipality', 'Thantikandh', 'ठाँटीकाँध', '', 6),
(592, 60, 'गाउँपालिका', 'Rural Municipality', 'Bhagawatimai', 'भगवतीमाई', '', 7),
(593, 60, 'गाउँपालिका', 'Rural Municipality', 'Dungeshwar', 'डुंगेश्वर', '', 6),
(594, 60, 'नगरपालिका', 'Municipality', 'Aathbis', 'आठबीस', '', 9),
(595, 60, 'नगरपालिका', 'Municipality', 'Chamunda Bindrasaini', 'चामुण्डा बिन्द्रासैनी', '', 9),
(596, 60, 'नगरपालिका', 'Municipality', 'Dullu', 'दुल्लु', '', 13),
(597, 60, 'नगरपालिका', 'Municipality', 'Narayan', 'नारायण', '', 11),
(598, 61, 'गाउँपालिका', 'Rural Municipality', 'Mudkechula', 'मुड्केचुला', '', 9),
(599, 61, 'गाउँपालिका', 'Rural Municipality', 'Kaike', 'काईके', '', 7),
(600, 61, 'गाउँपालिका', 'Rural Municipality', 'She Phoksundo', 'शे फोक्सुन्डो', '', 9),
(601, 61, 'गाउँपालिका', 'Rural Municipality', 'Jagadulla', 'जगदुल्ला', '', 6),
(602, 61, 'गाउँपालिका', 'Rural Municipality', 'Dolpo Buddha', 'डोल्पो बुद्ध', '', 6),
(603, 61, 'गाउँपालिका', 'Rural Municipality', 'Chharka Tangsong', 'छार्का ताङसोङ', '', 6),
(604, 61, 'नगरपालिका', 'Municipality', 'Thulibheri', 'ठूलीभेरी', '', 11),
(605, 61, 'नगरपालिका', 'Municipality', 'Tripura Sundari', 'त्रिपुरासुन्दरी', '', 11),
(606, 62, 'गाउँपालिका', 'Rural Municipality', 'Simkot', 'सिमकोट', '', 8),
(607, 62, 'गाउँपालिका', 'Rural Municipality', 'Sarkegad', 'सर्केगाड', '', 8),
(608, 62, 'गाउँपालिका', 'Rural Municipality', 'Adanchuli', 'अदानचुली', '', 6),
(609, 62, 'गाउँपालिका', 'Rural Municipality', 'Kharpunath', 'खार्पुनाथ', '', 5),
(610, 62, 'गाउँपालिका', 'Rural Municipality', 'Tanjakot', 'ताँजाकोट', '', 5),
(611, 62, 'गाउँपालिका', 'Rural Municipality', 'Chankheli', 'चंखेली', '', 6),
(612, 62, 'गाउँपालिका', 'Rural Municipality', 'Namkha', 'नाम्खा', '', 7),
(613, 63, 'गाउँपालिका', 'Rural Municipality', 'Junichande', 'जुनीचाँदे', '', 11),
(614, 63, 'गाउँपालिका', 'Rural Municipality', 'Kushe', 'कुसे', '', 9),
(615, 63, 'गाउँपालिका', 'Rural Municipality', 'Barekot', 'बारेकोट', '', 9),
(616, 63, 'गाउँपालिका', 'Rural Municipality', 'Shivalaya', 'शिवालय', '', 9),
(617, 63, 'नगरपालिका', 'Municipality', 'Chhedagaad', 'छेडागाड', '', 13),
(618, 63, 'नगरपालिका', 'Municipality', 'Nalgaad', 'नलगाड', '', 13),
(619, 63, 'नगरपालिका', 'Municipality', 'Bheri', 'भेरी', '', 13),
(620, 64, 'गाउँपालिका', 'Rural Municipality', 'Tatopani', 'तातोपानी', '', 8),
(621, 64, 'गाउँपालिका', 'Rural Municipality', 'Patarasi', 'पातारासी', '', 7),
(622, 64, 'गाउँपालिका', 'Rural Municipality', 'Tila', 'तिला', '', 9),
(623, 64, 'गाउँपालिका', 'Rural Municipality', 'Kankasundari', 'कनकासुन्दरी', '', 8),
(624, 64, 'गाउँपालिका', 'Rural Municipality', 'Sinja', 'सिंजा', '', 6),
(625, 64, 'गाउँपालिका', 'Rural Municipality', 'Hima', 'हिमा', '', 7),
(626, 64, 'गाउँपालिका', 'Rural Municipality', 'Guthichaur', 'गुठिचौर', '', 5),
(627, 64, 'नगरपालिका', 'Municipality', 'Chandannath', 'चन्दननाथ', '', 10),
(628, 65, 'गाउँपालिका', 'Rural Municipality', 'Narharinath', 'नरहरिनाथ', '', 9),
(629, 65, 'गाउँपालिका', 'Rural Municipality', 'Palata', 'पलाता', '', 9),
(630, 65, 'गाउँपालिका', 'Rural Municipality', 'Shubha Kalika', 'शुभ कालिका', '', 8),
(631, 65, 'गाउँपालिका', 'Rural Municipality', 'Sanni Triveni', 'सान्नी त्रिवेणी', '', 9),
(632, 65, 'गाउँपालिका', 'Rural Municipality', 'Pachaljharana', 'पचालझरना', '', 9),
(633, 65, 'गाउँपालिका', 'Rural Municipality', 'Mahawai', 'महावै', '', 7),
(634, 65, 'नगरपालिका', 'Municipality', 'Khadachakra', 'खाँडाचक्र', '', 11),
(635, 65, 'नगरपालिका', 'Municipality', 'Tilagufa', 'तिलागुफा', '', 11),
(636, 65, 'नगरपालिका', 'Municipality', 'Raskot', 'रास्कोट', '', 9),
(637, 66, 'गाउँपालिका', 'Rural Municipality', 'Khatyad', 'खत्याड', '', 11),
(638, 66, 'गाउँपालिका', 'Rural Municipality', 'Soru', 'सोरु', '', 11),
(639, 66, 'गाउँपालिका', 'Rural Municipality', 'Mugum Karmarong', 'मुगुम कार्मारोंग', '', 9),
(640, 66, 'नगरपालिका', 'Municipality', 'Chhayanath Rara', 'छायाँनाथ रारा', '', 14),
(641, 67, 'गाउँपालिका', 'Rural Municipality', 'Sani Bheri', 'सानीभेरी', '', 11),
(642, 67, 'गाउँपालिका', 'Rural Municipality', 'Tribeni', 'त्रिवेणी', '', 10),
(643, 67, 'गाउँपालिका', 'Rural Municipality', 'Banphikot', 'बाँफिकोट', '', 10),
(644, 67, 'नगरपालिका', 'Municipality', 'Aathbiskot', 'आठबिसकोट', '', 14),
(645, 67, 'नगरपालिका', 'Municipality', 'Chaurjahari', 'चौरजहारी', '', 14),
(646, 67, 'नगरपालिका', 'Municipality', 'Musikot', 'मुसिकोट', '', 14),
(647, 68, 'गाउँपालिका', 'Rural Municipality', 'Kumakh', 'कुमाख', '', 7),
(648, 68, 'गाउँपालिका', 'Rural Municipality', 'Kalimati', 'कालीमाटी', '', 7),
(649, 68, 'गाउँपालिका', 'Rural Municipality', 'Chhatreshwari', 'छत्रेश्वरी', '', 7),
(650, 68, 'गाउँपालिका', 'Rural Municipality', 'Darma', 'दार्मा', '', 6),
(651, 68, 'गाउँपालिका', 'Rural Municipality', 'Kapurkot', 'कपुरकोट', '', 6),
(652, 68, 'गाउँपालिका', 'Rural Municipality', 'Tribeni', 'त्रिवेणी', '', 6),
(653, 68, 'गाउँपालिका', 'Rural Municipality', 'Siddha Kumakh', 'सिद्ध कुमाख', '', 5),
(654, 68, 'नगरपालिका', 'Municipality', 'Baghchaur', 'बागचौर', '', 12),
(655, 68, 'नगरपालिका', 'Municipality', 'Bangaad Kupinde', 'बनगाँड कुपिण्डे', '', 12),
(656, 68, 'नगरपालिका', 'Municipality', 'Sharda', 'शारदा', '', 15),
(657, 69, 'गाउँपालिका', 'Rural Municipality', 'Barahatal', 'बराहताल', '', 10),
(658, 69, 'गाउँपालिका', 'Rural Municipality', 'Simta', 'सिम्ता', '', 9),
(659, 69, 'गाउँपालिका', 'Rural Municipality', 'Chaukune', 'चौकुने', '', 10),
(660, 69, 'गाउँपालिका', 'Rural Municipality', 'Chingad', 'चिङ्गाड', '', 6),
(661, 69, 'नगरपालिका', 'Municipality', 'Gurbhakot', 'गुर्भाकोट', '', 14),
(662, 69, 'नगरपालिका', 'Municipality', 'Panchapuri', 'पञ्चपुरी', '', 11),
(663, 69, 'नगरपालिका', 'Municipality', 'Bheriganga', 'भेरीगंगा', '', 13),
(664, 69, 'नगरपालिका', 'Municipality', 'Lekbesi', 'लेकबेसी', '', 10),
(665, 69, 'नगरपालिका', 'Municipality', 'Birendranagar', 'बीरेन्द्रनगर', '', 16),
(666, 70, 'गाउँपालिका', 'Rural Municipality', 'Bannigadi Jayagad', 'बान्नीगडीजैगड', '', 6),
(667, 70, 'नगरपालिका', 'Municipality', 'Kamalbazar', 'कमलबजार', '', 10);
INSERT INTO `setup_addr_municipalities` (`id`, `did`, `nep_type`, `type`, `name`, `nep_name`, `note`, `total_wards`) VALUES
(668, 70, 'नगरपालिका', 'Municipality', 'Panchadewal Binayak', 'पंचदेवल विनायक', '', 9),
(669, 70, 'नगरपालिका', 'Municipality', 'Mangalsen', 'मंगलसेन', '', 14),
(670, 70, 'नगरपालिका', 'Municipality', 'Sanfebagar', 'साँफेवगर', '', 14),
(671, 70, 'गाउँपालिका', 'Rural Municipality', 'Chaurpati', 'चौरपाटी ', '', 7),
(672, 70, 'गाउँपालिका', 'Rural Municipality', 'Dhakari', 'ढकारी ', '', 8),
(673, 70, 'गाउँपालिका', 'Rural Municipality', 'Tumrakhad', 'तुर्माखाँद ', '', 8),
(674, 70, 'गाउँपालिका', 'Rural Municipality', 'Mellekh', 'मेल्लेख ', '', 8),
(675, 70, 'गाउँपालिका', 'Rural Municipality', 'Ramarosan', 'रामारोशन ', '', 7),
(676, 71, 'गाउँपालिका', 'Rural Municipality', 'Dogdakedar', 'दोगडाकेदार', '', 8),
(677, 71, 'गाउँपालिका', 'Rural Municipality', 'Dilashaini', 'डिलाशैनी', '', 7),
(678, 71, 'गाउँपालिका', 'Rural Municipality', 'Sigas', 'सिगास', '', 9),
(679, 71, 'गाउँपालिका', 'Rural Municipality', 'Pancheshwar', 'पञ्चेश्वर', '', 6),
(680, 71, 'गाउँपालिका', 'Rural Municipality', 'Surnaya', 'सुर्नया', '', 8),
(681, 71, 'गाउँपालिका', 'Rural Municipality', 'Shivanath', 'शिवनाथ', '', 6),
(682, 71, 'नगरपालिका', 'Municipality', 'Dasrathchand', 'दशरथचन्द', '', 11),
(683, 71, 'नगरपालिका', 'Municipality', 'Patan', 'पाटन', '', 10),
(684, 71, 'नगरपालिका', 'Municipality', 'Purchaudi', 'पुर्चौडी', '', 10),
(685, 71, 'नगरपालिका', 'Municipality', 'Melauli', 'मेलौली', '', 9),
(686, 72, 'गाउँपालिका', 'Rural Municipality', 'Kedarsyu', 'केदारस्यु', '', 9),
(687, 72, 'गाउँपालिका', 'Rural Municipality', 'Thalara', 'थलारा', '', 9),
(688, 72, 'गाउँपालिका', 'Rural Municipality', 'Bitthadchir', 'बित्थडचिर', '', 9),
(689, 72, 'गाउँपालिका', 'Rural Municipality', 'Chhabis Pathibhera', 'छब्बीसपाथिभेरा', '', 7),
(690, 72, 'गाउँपालिका', 'Rural Municipality', 'Khaptad Chhanna', 'खप्तड छान्ना', '', 7),
(691, 72, 'गाउँपालिका', 'Rural Municipality', 'Masta', 'मष्टा', '', 7),
(692, 72, 'गाउँपालिका', 'Rural Municipality', 'Durgathali', 'दुर्गाथली', '', 7),
(693, 72, 'गाउँपालिका', 'Rural Municipality', 'Talkot', 'तलकोट', '', 7),
(694, 72, 'गाउँपालिका', 'Rural Municipality', 'Surma', 'सुर्मा', '', 5),
(695, 72, 'गाउँपालिका', 'Rural Municipality', 'Saipal', 'सइपाल', '', 5),
(696, 72, 'नगरपालिका', 'Municipality', 'Jayprithivi', 'जयपृथ्वी', '', 11),
(697, 72, 'नगरपालिका', 'Municipality', 'Bungal', 'बुंगल', '', 11),
(698, 73, 'गाउँपालिका', 'Rural Municipality', 'Khaptad Chhededaha', 'खप्तड छेडेदह', '', 7),
(699, 73, 'गाउँपालिका', 'Rural Municipality', 'Swami Kartik Khapar', 'स्वामिकार्तिक खापर', '', 5),
(700, 73, 'गाउँपालिका', 'Rural Municipality', 'Jagannath', 'जगन्नाथ', '', 6),
(701, 73, 'गाउँपालिका', 'Rural Municipality', 'Himali', 'हिमाली', '', 7),
(702, 73, 'गाउँपालिका', 'Rural Municipality', 'Gaumul', 'गौमुल', '', 6),
(703, 73, 'नगरपालिका', 'Municipality', 'Tribeni', 'त्रिवेणी', '', 9),
(704, 73, 'नगरपालिका', 'Municipality', 'Badimalika', 'बडिमालिका', '', 9),
(705, 73, 'नगरपालिका', 'Municipality', 'Budhiganga', 'बुढीगंगा', '', 10),
(706, 73, 'नगरपालिका', 'Municipality', 'Budhinanda', 'बुढीनन्दा', '', 10),
(707, 74, 'गाउँपालिका', 'Rural Municipality', 'Navadurga', 'नवदुर्गा', '', 5),
(708, 74, 'गाउँपालिका', 'Rural Municipality', 'Aalitaal', 'आलिताल', '', 8),
(709, 74, 'गाउँपालिका', 'Rural Municipality', 'Ganyapadhura', 'गन्यापधुरा', '', 5),
(710, 74, 'गाउँपालिका', 'Rural Municipality', 'Bhageshwar', 'भागेश्वर', '', 5),
(711, 74, 'गाउँपालिका', 'Rural Municipality', 'Ajaymeru', 'अजयमेरु', '', 6),
(712, 74, 'नगरपालिका', 'Municipality', 'Amargadhi', 'अमरगढी', '', 11),
(713, 74, 'नगरपालिका', 'Municipality', 'Parshuram', 'परशुराम', '', 12),
(714, 75, 'गाउँपालिका', 'Rural Municipality', 'Naugad', 'नौगाड', '', 6),
(715, 75, 'गाउँपालिका', 'Rural Municipality', 'Malikarjun', 'मालिकार्जुन', '', 8),
(716, 75, 'गाउँपालिका', 'Rural Municipality', 'Marma', 'मार्मा', '', 6),
(717, 75, 'गाउँपालिका', 'Rural Municipality', 'Lekam', 'लेकम', '', 6),
(718, 75, 'गाउँपालिका', 'Rural Municipality', 'Duhun', 'दुहु', '', 5),
(719, 75, 'गाउँपालिका', 'Rural Municipality', 'Vyans (Byans)', 'ब्याँस', '', 6),
(720, 75, 'गाउँपालिका', 'Rural Municipality', 'Api Himal', 'अपि हिमाल', '', 6),
(721, 75, 'नगरपालिका', 'Municipality', 'Mahakali', 'महाकाली', '', 9),
(722, 75, 'नगरपालिका', 'Municipality', 'Sailyashikhar', 'शैल्यशिखर', '', 9),
(723, 76, 'गाउँपालिका', 'Rural Municipality', 'Aadarsha', 'आदर्श', '', 7),
(724, 76, 'गाउँपालिका', 'Rural Municipality', 'Purbichauki', 'पूर्वीचौकी', '', 7),
(725, 76, 'गाउँपालिका', 'Rural Municipality', 'K.I. Singh', 'केआईसिंह', '', 7),
(726, 76, 'गाउँपालिका', 'Rural Municipality', 'Jorayal', 'जोरायल', '', 6),
(727, 76, 'गाउँपालिका', 'Rural Municipality', 'Sayal', 'सायल', '', 6),
(728, 76, 'गाउँपालिका', 'Rural Municipality', 'Bogatan-Phudsil', 'वोगटान–फुड्सिल', '', 7),
(729, 76, 'गाउँपालिका', 'Rural Municipality', 'Badikedar', 'बड्डी केदार', '', 5),
(730, 76, 'नगरपालिका', 'Municipality', 'Diyapal Silgadhi', 'दिपायल सिलगढी', '', 9),
(731, 76, 'नगरपालिका', 'Municipality', 'Shikhar', 'शिखर', '', 11),
(732, 77, 'गाउँपालिका', 'Rural Municipality', 'Janaki', 'जानकी', '', 9),
(733, 77, 'गाउँपालिका', 'Rural Municipality', 'Kailari', 'कैलारी', '', 9),
(734, 77, 'गाउँपालिका', 'Rural Municipality', 'Joshipur', 'जोशीपुर', '', 7),
(735, 77, 'गाउँपालिका', 'Rural Municipality', 'Bardagoriya', 'बर्गगोरिया', '', 6),
(736, 77, 'गाउँपालिका', 'Rural Municipality', 'Mohanyal', 'मोहन्याल', '', 7),
(737, 77, 'गाउँपालिका', 'Rural Municipality', 'Chure', 'चुरे', '', 6),
(738, 77, 'नगरपालिका', 'Municipality', 'Godabari', 'गोदावरी', '', 12),
(739, 77, 'नगरपालिका', 'Municipality', 'Gauriganga', 'गौरीगंगा', '', 11),
(740, 77, 'नगरपालिका', 'Municipality', 'Ghodaghodi', 'घोडाघोडी', '', 12),
(741, 77, 'नगरपालिका', 'Municipality', 'Tikapur', 'टिकापुर', '', 9),
(742, 77, 'नगरपालिका', 'Municipality', 'Bhajani', 'भजनी', '', 9),
(743, 77, 'नगरपालिका', 'Municipality', 'Lamkichuha', 'लम्किचुहा', '', 10),
(744, 77, 'उप-महानगरपालिका', 'Sub Metropolitan City', 'Dhangadi', 'धनगढी', '', 19),
(745, 78, 'गाउँपालिका', 'Rural Municipality', 'Laljhadi', 'लालझाँडी', '', 6),
(746, 78, 'गाउँपालिका', 'Rural Municipality', 'Beldandi', 'बेलडाँडी', '', 5),
(747, 78, 'नगरपालिका', 'Municipality', 'Krishna Pur', 'कृष्णपुर', '', 9),
(748, 78, 'नगरपालिका', 'Municipality', 'Punarbas', 'पुनर्वास', '', 11),
(749, 78, 'नगरपालिका', 'Municipality', 'Bedkota', 'बेदकोट', '', 10),
(750, 78, 'नगरपालिका', 'Municipality', 'Belauri', 'बेलौरी', '', 10),
(751, 78, 'नगरपालिका', 'Municipality', 'Bhimdatta', 'भिमदत्त', '', 19),
(752, 78, 'नगरपालिका', 'Municipality', 'Dodhara Chandani', 'दोधारा चाँदनी', '', 10),
(753, 78, 'नगरपालिका', 'Municipality', 'Shuklaphanta', 'शुक्लाफाँट', '', 12);

-- --------------------------------------------------------

--
-- Table structure for table `setup_addr_provinces`
--

DROP TABLE IF EXISTS `setup_addr_provinces`;
CREATE TABLE IF NOT EXISTS `setup_addr_provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext,
  `nep_name` longtext,
  `note` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setup_addr_provinces`
--

INSERT INTO `setup_addr_provinces` (`id`, `name`, `nep_name`, `note`) VALUES
(1, '1', '१', ''),
(2, '2', '२', ''),
(3, '3', '३', ''),
(4, '4', '४', ''),
(5, '5', '५', ''),
(6, '6', '६', ''),
(7, '7', '७', '');

-- --------------------------------------------------------

--
-- Table structure for table `setup_main_app`
--

DROP TABLE IF EXISTS `setup_main_app`;
CREATE TABLE IF NOT EXISTS `setup_main_app` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `has_yojana` tinyint(1) NOT NULL DEFAULT '0',
  `has_nagadi` tinyint(1) NOT NULL DEFAULT '0',
  `has_sampatikar` tinyint(1) NOT NULL DEFAULT '0',
  `has_dainik` tinyint(1) NOT NULL DEFAULT '0',
  `has_krishi` tinyint(1) NOT NULL DEFAULT '0',
  `has_apangata` tinyint(1) NOT NULL DEFAULT '0',
  `has_naksa` tinyint(1) NOT NULL DEFAULT '0',
  `has_byabasaye` tinyint(1) NOT NULL DEFAULT '0',
  `has_malpot` tinyint(1) NOT NULL DEFAULT '0',
  `has_pis` tinyint(1) NOT NULL DEFAULT '0',
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_ward` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setup_main_app`
--

INSERT INTO `setup_main_app` (`id`, `has_yojana`, `has_nagadi`, `has_sampatikar`, `has_dainik`, `has_krishi`, `has_apangata`, `has_naksa`, `has_byabasaye`, `has_malpot`, `has_pis`, `site_name`, `number_of_ward`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 'PDMT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `setup_settings`
--

DROP TABLE IF EXISTS `setup_settings`;
CREATE TABLE IF NOT EXISTS `setup_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_eng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `has_child` tinyint(1) NOT NULL DEFAULT '0',
  `cascading_parent_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_yojana` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_nagadi` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_sampatikar` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_dainik` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_krishi` tinyint(1) DEFAULT '0',
  `can_be_updated_in_apangata` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_naksa` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_byabasaye` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_malpot` tinyint(1) NOT NULL DEFAULT '0',
  `can_be_updated_in_pis` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setup_settings`
--

INSERT INTO `setup_settings` (`id`, `name`, `name_eng`, `slug`, `has_child`, `cascading_parent_id`, `is_deleted`, `can_be_updated_in_yojana`, `can_be_updated_in_nagadi`, `can_be_updated_in_sampatikar`, `can_be_updated_in_dainik`, `can_be_updated_in_krishi`, `can_be_updated_in_apangata`, `can_be_updated_in_naksa`, `can_be_updated_in_byabasaye`, `can_be_updated_in_malpot`, `can_be_updated_in_pis`) VALUES
(1, 'कर्मचारी समुह', NULL, 'setup_office_groups', 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(2, 'कर्मचारी उप-समुह', NULL, 'setup_office_subgroups', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(3, 'जात/जाती', NULL, 'setup_ethnicities', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(4, ' कर्मचारीको मुख्य प्रकार', NULL, 'setup_staff_category', 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(5, ' कर्मचारीको सहप्रकार', NULL, 'setup_staff_subcategory', 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(6, ' धर्म', NULL, 'setup_religions', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(7, 'अपांगता', NULL, 'setup_physicals', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(8, 'हुलिया', NULL, 'setup_faces', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(9, 'रक्त समूह', NULL, 'setup_bgroups', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(10, 'पेशा', NULL, 'setup_occupations', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(11, 'मातृभाषा', NULL, 'setup_languages', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(12, 'विदेशी भाषा', NULL, 'setup_f_languages', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(13, 'कर्मचारी सेवा', NULL, 'setup_services', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(14, 'कर्मचारी तह', NULL, 'setup_levels', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(15, 'कर्मचारी पद', NULL, 'setup_positions', 0, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(16, 'शैक्षिक योग्यता/उपाधी', NULL, 'setup_edu_qualifications', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(17, ' शैक्षिक विषय', NULL, 'setup_edu_subjects', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(18, 'शैक्षिक श्रेणी', NULL, 'setup_edu_positions', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(19, 'शैक्षिक संस्था', NULL, 'setup_edu_institutes', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(20, 'विभागीय सजाय', NULL, 'setup_punishments', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(21, 'लिंग', NULL, 'setup_gender', 0, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(22, 'खर्च किसिम', NULL, 'expense-type', 0, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, 'बिषयगत क्षेत्र', NULL, 'topic', 1, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, 'शिर्षकगत किसिम', NULL, 'topic-area-type', 0, 24, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(26, 'योजनाको अनुदानको किसिम', NULL, 'type-of-grant', 0, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(27, 'योजनाको विनियोजन किसिम', NULL, 'type-of-plan-allocation', 0, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(28, 'समितको पद', NULL, 'samiti-post', 0, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(29, 'राष्ट्रियता', NULL, 'setup_nationality', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(30, 'नाता', NULL, 'setup_relations', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(31, 'संस्थाको प्रकार', NULL, 'setup_organization_types', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(32, 'जग्गाको क्षेत्रगत किसिम', NULL, 'setup_land_area_types', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(33, 'जग्गाको वर्गीकरण', NULL, 'setup_land_category_types', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(34, 'जग्गाको श्रेणी', NULL, 'setup_land_types', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(35, 'सडकको नाम', NULL, 'setup_road_name', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setup_setting_values`
--

DROP TABLE IF EXISTS `setup_setting_values`;
CREATE TABLE IF NOT EXISTS `setup_setting_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_eng` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_id` int(11) NOT NULL,
  `cascading_parent_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setup_setting_values`
--

INSERT INTO `setup_setting_values` (`id`, `name`, `name_eng`, `note`, `setting_id`, `cascading_parent_id`, `is_deleted`) VALUES
(1, 'सामान्या प्रशासन समुह', NULL, NULL, 1, NULL, 0),
(2, 'राजपत्राङ्कित द्वितीय श्रेणी', NULL, NULL, 2, 1, 0),
(3, 'राजपत्राङ्कित तृतीय श्रेणी', NULL, NULL, 2, 1, 0),
(4, 'कर्मचारी', NULL, NULL, 4, NULL, 0),
(5, 'निजामती कर्मचारी', NULL, NULL, 5, 4, 0),
(6, 'कृषी', NULL, NULL, 10, NULL, 0),
(7, 'डाक्टर', NULL, NULL, 10, NULL, 0),
(8, 'व्यापार', NULL, NULL, 10, NULL, 0),
(9, 'शिक्षक', NULL, NULL, 10, NULL, 0),
(10, 'सरकारी सेवा', NULL, NULL, 10, NULL, 0),
(11, 'महिला', NULL, NULL, 21, NULL, 0),
(12, 'पुरुष', NULL, NULL, 21, NULL, 0),
(13, 'हिन्दु', NULL, NULL, 6, NULL, 0),
(14, 'क्रिस्टियन', NULL, NULL, 6, NULL, 0),
(15, 'Brahmin', NULL, NULL, 3, NULL, 0),
(16, 'B+', NULL, NULL, 9, NULL, 0),
(17, 'A+', NULL, NULL, 9, NULL, 0),
(18, 'पुँजीगत खर्च', NULL, NULL, 22, NULL, 0),
(19, 'चालु खर्च', NULL, NULL, 22, NULL, 0),
(20, 'योजना', NULL, NULL, 23, NULL, 0),
(21, 'कार्यक्रम', NULL, NULL, 23, NULL, 0),
(22, 'पूर्वाधार विकास', NULL, NULL, 24, NULL, 0),
(23, 'आर्थिक विकास', NULL, NULL, 24, NULL, 0),
(24, 'कालो पत्रे , स्थानीय सडक', NULL, NULL, 25, 22, 0),
(25, 'नगर स्तरीय', NULL, NULL, 27, NULL, 0),
(26, 'वडा स्तरीय', NULL, NULL, 27, NULL, 0),
(27, 'प्रमुख प्रशासकीय अधिकृत', 'Adhikrit', NULL, 15, NULL, 0),
(28, 'योजना शाखा प्रमुख', '', NULL, 15, NULL, 0),
(29, 'कम्प्यूटर अपरेटर	', 'C.O', NULL, 15, NULL, 0),
(30, 'का स	', NULL, NULL, 15, NULL, 0),
(31, 'जिन्सी प्रमुख', NULL, NULL, 15, NULL, 0),
(32, 'सूचना प्रबिधि अधिकृत', NULL, NULL, 15, NULL, 0),
(33, 'आर्थिक प्रशासन शाखा प्रमुख', NULL, NULL, 15, NULL, 0),
(34, 'इन्जिनियर', NULL, NULL, 15, NULL, 0),
(35, 'वडा सचिब', NULL, NULL, 15, NULL, 0),
(36, 'वडा अध्यक्ष', NULL, NULL, 15, NULL, 0),
(37, 'MIS OFFICER', NULL, NULL, 15, NULL, 0),
(38, 'प्रा वि प्रथम	', NULL, NULL, 15, NULL, 0),
(39, 'मा वि तृतिय	', NULL, NULL, 15, NULL, 0),
(40, 'मा वि द्वितिय	', NULL, NULL, 15, NULL, 0),
(41, 'मा.वि. प्रथम	', NULL, NULL, 15, NULL, 0),
(42, 'सचिव	', NULL, NULL, 15, NULL, 0),
(43, 'सह सचिव	', NULL, NULL, 15, NULL, 0),
(44, 'सदस्य', NULL, NULL, 15, NULL, 0),
(45, 'कोषाध्यक्ष', NULL, NULL, 15, NULL, 0),
(46, 'उपाध्यक्ष', NULL, NULL, 15, NULL, 0),
(47, 'अध्यक्ष', NULL, NULL, 28, NULL, 0),
(48, 'उपाध्यक्ष', NULL, NULL, 28, NULL, 0),
(49, 'सचिब', NULL, NULL, 28, NULL, 0),
(50, 'कोषाध्यक्ष', NULL, NULL, 28, NULL, 0),
(51, 'संयोजक', NULL, NULL, 28, NULL, 0),
(52, 'सदस्य', NULL, NULL, 28, NULL, 0),
(53, 'नेपाली', NULL, NULL, 29, NULL, 0),
(54, 'अमेरिचन', NULL, NULL, 29, NULL, 0),
(55, 'आमा', NULL, NULL, 30, NULL, 0),
(56, 'बुवा', NULL, NULL, 30, NULL, 0),
(57, 'प्रालि', NULL, NULL, 31, NULL, 0),
(58, 'बारी', NULL, NULL, 32, NULL, 0),
(59, 'खेत', NULL, NULL, 32, NULL, 0),
(60, '१-५ रोपनी', NULL, NULL, 33, NULL, 0),
(61, '६-१५ रोपनि', NULL, NULL, 33, NULL, 0),
(62, 'अब्बल प्रति रोपनी', NULL, NULL, 34, NULL, 0),
(63, 'दोयम प्रति रोपनी', NULL, NULL, 34, NULL, 0),
(64, 'भवानीपुर मुख्य व्यपारिक क्षेत्र', NULL, NULL, 35, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active_app` enum('yojana','nagadi','sampatikar','dainik','krishi','apangata','naksa','byabasaye','malpot','pis') COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `active_app`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Amit', 'ameatkhanal@gmail.com', NULL, '$2y$10$sKu/XMVXoSMOzJiK5pXnNOc1ZdERDbUPS0W7G6RKHJRZrk6xfHNae', 'pis', NULL, '2022-03-30 04:05:46', '2022-03-31 03:44:10'),
(2, 'superadmin', 'superadmin@pdmt.com', '2022-04-17 05:04:26', '$2y$10$PSghtikq9hTRZLQncBfNz.p3lAg4oR3qaSaMVM4ASu.piWpZjs.C.', 'yojana', 'V293e9lHxQ', '2022-04-17 05:04:27', '2022-04-17 05:04:27'),
(6, 'cao test', 'cao@gmail.com', NULL, '$2y$10$tGkyDjLOxycMy5qm0GV/WOI5UM9U5v45VNBKGqQyvTqhvHPdQGk3O', NULL, NULL, '2022-06-09 06:06:36', '2022-06-09 06:06:36');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
