-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2026 at 05:30 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u386335356_adsense`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_section`
--

CREATE TABLE `about_section` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_first` varchar(255) NOT NULL,
  `image_second` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `button_text` varchar(255) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about_section1`
--

CREATE TABLE `about_section1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `stauts` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about_section2`
--

CREATE TABLE `about_section2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `image_first` varchar(255) NOT NULL,
  `image_second` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `user_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vinit Kumar', 'vinit.wd.ad@gmail.com', 'MDVGVUw9NiU4NEQlLT5EJVczVCRdLzBgYApgCg==', 'sadmin', '1', '2024-07-09 03:55:06', '2024-07-09 06:29:18'),
(2, 'Vinit', 'admin@gmail.com', 'MDQ1PTI9JiU3LTQlLT5EJVczVCRdLzBgYApgCg==', 'admin', '1', '2024-07-09 06:34:21', '2024-07-09 06:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `sub_title`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Banner Title 1', 'Banner Sub Title', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering,&nbsp;</p>', 'http://127.0.0.1:8000/uploads/banner/banner_1724227719.jpg', '1', '2024-08-01 02:58:16', '2024-08-21 02:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `publish_on` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs_category`
--

CREATE TABLE `blogs_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_logo` varchar(255) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `services` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `client_id`, `brand_name`, `brand_logo`, `website_url`, `status`, `services`, `created_at`, `updated_at`) VALUES
(1, 1, 'Devenergy', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401593.png', 'http://devenergy.hk/', '1', 'logo design, brand identity, website designing, digital marketing, print supply, lift branding, marketing colletrals, corporate gifting, brochure, catalogue, leaflet', '2024-08-03 00:04:08', '2024-08-23 08:26:33'),
(3, 3, 'Myhealthygenie', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401600.png', 'https://myhealthygenie.com/', '1', 'website designing, brochure, catalogue, leaflet, banners, hoardings, social media creatives', '2024-08-03 04:55:00', '2024-08-23 08:26:40'),
(4, 3, 'Mysmartgenie', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401606.png', 'https://www.mysmartgenie.in/', '1', 'website designing, brochure, catalogue, leaflet, banners, hoardings, social media creatives', '2024-08-03 04:55:56', '2024-08-23 08:26:46'),
(5, 4, 'Vibezzzz Mattress', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401618.png', NULL, '1', 'brand identity, digital marketing, print supply, event management, store interior & branding, auto branding, bus branding, corporate gifting, brochure, catalogue, leaflet, corporate presentation', '2024-08-23 00:37:45', '2024-08-23 08:26:58'),
(6, 5, 'Cargill Aqua Nutrition', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401628.png', NULL, '1', 'packaging design, brochure, catalogue, leaflet, banners, hoardings, store branding, social media creatives', '2024-08-23 00:40:56', '2024-08-23 08:27:08'),
(7, 6, 'SRS India', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401635.png', NULL, '1', 'logo, brand identity, website designing', '2024-08-23 00:43:02', '2024-08-23 08:27:15'),
(8, 7, 'Spedition', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401645.png', NULL, '1', 'logo, brand identity, website designing, digital marketing, print supply, corporate gifting, brochure, catalogue, leaflet, corporate presentation', '2024-08-23 00:46:23', '2024-08-23 08:27:25'),
(9, 8, 'StorForMe', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401657.png', NULL, '1', 'logo, brand identity, website designing, digital marketing, print supply, lift branding, marketing colletrals, corporate gifting, brochure, catalogue, leaflet', '2024-08-23 01:07:54', '2024-08-23 08:27:37'),
(10, 10, 'Drolia Chemical Works', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401671.png', NULL, '1', 'logo, brand identity, website designing, digital marketing, print supply, lift branding, marketing colletrals, corporate gifting, brochure, catalogue, leaflet', '2024-08-23 01:29:00', '2024-08-23 08:27:51'),
(11, 3, 'Swath Bhoomi', 'https://adsensedesigns.com/public/uploads/brand/logo_1724401683.png', NULL, '1', 'website designing, brochure, catalogue, leaflet, banners, hoardings, social media creatives', '2024-08-23 01:32:51', '2024-08-23 08:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_name`, `phone_number`, `email`, `company_name`, `website_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'devenergy HK', '0000000000', 'vinit.wd.ad@gmail.com', 'devenergy', 'http://devenergy.hk/', '1', '2024-08-02 02:16:47', '2024-08-22 06:57:02'),
(3, 'Swasth Bhoomi', '123456786', 'info@swasthbhoomi.com', 'Swasth Bhoomi Private Limitd', 'https://www.swasthbhoomi.com/', '1', '2024-08-03 04:53:14', '2024-08-22 06:59:56'),
(4, 'Vibezzzz Mattress', NULL, NULL, NULL, NULL, '1', '2024-08-22 06:47:52', '2024-08-22 06:47:52'),
(5, 'Cargill Aqua Nutrition', NULL, NULL, NULL, NULL, '1', '2024-08-22 06:48:43', '2024-08-22 06:48:43'),
(6, 'SRS India', NULL, NULL, NULL, NULL, '1', '2024-08-22 06:49:45', '2024-08-22 06:49:45'),
(7, 'Spedition', '+91 - 120 - 6971313', 'contact@speditionindia.com', 'Spedition', 'https://www.speditionindia.com/', '1', '2024-08-22 06:51:34', '2024-08-22 06:51:34'),
(8, 'StoreForMe', '+91-96256-78673', 'contact@storeforme.in', 'STOREFORME', 'https://www.storeforme.in/', '1', '2024-08-22 06:52:47', '2024-08-22 06:52:47'),
(9, 'devenergy In', '+91 11-47508800', 'info@devenergy.co.in', 'Dev Energy', 'https://www.devenergy.co.in/', '1', '2024-08-22 06:54:09', '2024-08-22 06:56:53'),
(10, 'Drolia Chemical Works', '+91 93349 76610', 'info@droliachemicalworks.com', 'Drolia Chemical Works', 'https://droliachemicalworks.com/', '1', '2024-08-22 06:56:18', '2024-08-22 06:56:18'),
(11, 'Swasth Bhoomi', '+91-8299229558', 'smartsoftware.india@gmail.com', 'Smart Genie', 'http://smartgenie.in/', '1', '2024-08-22 06:59:44', '2024-08-22 06:59:44'),
(12, 'Swasth Bhoomi', '011-48323232', 'genie@healthgenie.in', 'HealthGenie', 'https://www.healthgenie.in/', '1', '2024-08-22 07:01:31', '2024-08-22 07:01:31'),
(13, 'Dwarkapati Foods', NULL, 'dwarkapatifoodsllp@gmail.com', 'Dwarkapati Foods LLP', NULL, '1', '2024-08-22 07:03:51', '2024-08-22 07:03:51'),
(14, 'GVI', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:06:18', '2024-08-22 07:06:18'),
(15, 'LEON', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:08:36', '2024-08-22 07:08:36'),
(16, 'Nimbus Global Academy', '97114 77793', 'nimbusglobal.in@gmail.com', 'Nimbus Global Academy', 'https://nimbusglobal.in/', '1', '2024-08-22 07:09:50', '2024-08-22 07:09:50'),
(17, 'Jsm Energy Pvt. Ltd.', '9818242753', 'sales@jsmenergy.in', 'Jsm Energy Pvt. Ltd.', 'https://jsmenergy.in/', '1', '2024-08-22 07:11:02', '2024-08-22 07:11:02'),
(18, 'Spedtion Storage India Pvt. Ltd.', NULL, 'harpreetsingh@speditionindia.com', 'Spedtion Storage India Pvt. Ltd.', NULL, '1', '2024-08-22 07:14:20', '2024-08-22 07:14:20'),
(19, 'Haus Strom', '+971 4 589 9904', 'info@hausstrom.com', 'Hausstrom', 'https://hausstrom.com/', '1', '2024-08-22 07:16:34', '2024-08-22 07:16:34'),
(20, 'SUPPLEMENT SACK (MUSCLE FIBRE)', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:18:35', '2024-08-22 07:18:35'),
(21, 'SUPPLEMENT SACK (FYSIQ LAB)', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:18:52', '2024-08-22 07:18:52'),
(22, 'Byson Nutrition', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:20:32', '2024-08-22 07:20:32'),
(23, 'Candzey', '(+91) 120 4137462', 'customercare@shrindia.in', 'Candzey', 'https://candzey.com/', '1', '2024-08-22 07:21:56', '2024-08-22 07:21:56'),
(24, 'Tekaram', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:22:52', '2024-08-22 07:22:52'),
(25, 'Sweet Lane', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:24:46', '2024-08-22 07:24:46'),
(26, 'HAPPY GANG', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:26:10', '2024-08-22 07:26:10'),
(27, 'Otler', '+91 8527813220', 'info@otler.in', 'Otler', 'https://otler.in/', '1', '2024-08-22 07:28:14', '2024-08-22 07:28:14'),
(28, 'Mother\'s Choice', NULL, NULL, NULL, NULL, '1', '2024-08-22 07:31:38', '2024-08-22 07:31:38'),
(29, 'Giftz Mart', NULL, NULL, 'Giftz Mart', NULL, '1', '2024-08-22 07:32:24', '2024-08-22 07:32:24'),
(30, 'Gokul', NULL, NULL, 'Gokul', NULL, '1', '2024-08-22 07:32:59', '2024-08-22 07:32:59'),
(31, 'Oncodigicare', '+91-8899148149', 'care@oncodigicare.com', 'Oncodigicare', 'https://oncodigicare.com/', '1', '2024-08-22 07:34:15', '2024-08-22 07:34:15');

-- --------------------------------------------------------

--
-- Table structure for table `client_service`
--

CREATE TABLE `client_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `description_short` text NOT NULL,
  `description_long` longtext NOT NULL,
  `service_date` date NOT NULL,
  `service_end` date NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `meta_title` varchar(800) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_service`
--

INSERT INTO `client_service` (`id`, `client_id`, `brand_id`, `service_id`, `service_image`, `description_short`, `description_long`, `service_date`, `service_end`, `status`, `meta_title`, `meta_description`, `meta_keyword`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'http://127.0.0.1:8000/uploads/projects/project_1722940574.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p><img alt=\"\" src=\"file:///C:/xampp/htdocs/Vinit/modinatheme.com/html/azent-html/assets/img/service/details.jpg\" /><img alt=\"\" src=\"https://adsensedesigns.com/assets/img/service/details.jpg\" style=\"height:368px; width:740px\" /><img alt=\"\" src=\"file:///C:/xampp/htdocs/Vinit/modinatheme.com/html/azent-html/assets/img/service/details.jpg\" /></p>\r\n\r\n<h3>Cloud Service</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt. Maecenas tincidunt, velit ac porttitor pulvinar, tortor eros facilisis libero, vitae commodo nunc quam et ligula</p>\r\n\r\n<h3>Our Goals</h3>\r\n\r\n<ul>\r\n	<li>Aliquam accumsan et ante id</li>\r\n	<li>Lorem ipsum dolor sit dgdr</li>\r\n	<li>Maecenas varius tortor</li>\r\n</ul>\r\n\r\n<h3>The Challenges</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor finibus et. Aenean eu enim justo. Vestibulum</p>', '2024-08-09', '2025-08-14', '1', 'meta title', 'description', 'keyword', '2024-08-06 05:06:14', '2024-08-14 02:52:35'),
(2, 3, 3, 3, 'http://127.0.0.1:8000/uploads/projects/project_1723623862.png', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<h3>Cloud Service</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt. Maecenas tincidunt, velit ac porttitor pulvinar, tortor eros facilisis libero, vitae commodo nunc quam et ligula</p>\r\n\r\n<h3>Our Goals</h3>\r\n\r\n<ul>\r\n	<li>Aliquam accumsan et ante id</li>\r\n	<li>Lorem ipsum dolor sit dgdr</li>\r\n	<li>Maecenas varius tortor</li>\r\n</ul>\r\n\r\n<h3>The Challenges</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor finibus et. Aenean eu enim justo. Vestibulum</p>', '2024-08-01', '2024-09-27', '1', 'meta title', 'description', 'keyword', '2024-08-14 02:54:22', '2024-08-14 02:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_07_09_071719_create_admin_table', 1),
(7, '2024_07_13_111426_create_banner_table', 2),
(8, '2024_07_13_111519_create_blogs_category_table', 2),
(21, '2024_07_13_111542_create_blogs_table', 3),
(22, '2024_08_01_053725_create_client_table', 3),
(23, '2024_08_01_053747_create_brand_table', 3),
(24, '2024_08_01_062057_create_service_table', 4),
(25, '2024_08_01_070159_create_client_service_table', 4),
(26, '2024_08_21_093531_create_about_section_table', 5),
(27, '2024_08_21_093643_create_about_section1_table', 5),
(28, '2024_08_21_093653_create_about_section2_table', 5),
(29, '2024_08_21_114657_create_navmenu_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `navmenu`
--

CREATE TABLE `navmenu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `page_banner` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `parent_id` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `contant` enum('1','0') NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navmenu`
--

INSERT INTO `navmenu` (`id`, `name`, `slug`, `page_banner`, `banner_title`, `meta_title`, `meta_keyword`, `meta_description`, `parent_id`, `status`, `contant`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', NULL, NULL, 'meta title', 'meta keyword', 'meta description', '0', '0', '0', 1, '2024-08-22 00:24:02', '2024-08-22 04:02:11'),
(2, 'About Us', 'about-us', 'http://127.0.0.1:8000/uploads/page_banner/banner_1724312728.jpg', 'About Us', 'meta title', NULL, NULL, '0', '1', '0', 0, '2024-08-22 00:24:39', '2024-08-22 04:46:27'),
(3, 'Contact Us', 'contact-us', NULL, 'Contact Us', 'meta title', NULL, NULL, '0', '0', '0', 0, '2024-08-22 00:25:25', '2024-08-22 00:25:25'),
(4, 'Who We Are', 'who-we-are', NULL, NULL, NULL, NULL, NULL, '2', '1', '1', 0, '2024-08-22 04:49:03', '2024-08-22 04:49:03'),
(5, 'What We Do', 'what-we-do', NULL, NULL, NULL, NULL, NULL, '2', '1', '1', 0, '2024-08-22 04:49:30', '2024-08-22 04:49:30'),
(6, 'Why Choose Us', 'why-choose-us', NULL, NULL, NULL, NULL, NULL, '2', '1', '1', 0, '2024-08-22 04:49:52', '2024-08-22 04:49:52'),
(7, 'Testimonial', 'testimonial', NULL, NULL, NULL, NULL, NULL, '2', '1', '1', 0, '2024-08-22 04:50:14', '2024-08-22 04:50:14'),
(8, 'Case Studies', 'case-studies', NULL, NULL, NULL, NULL, NULL, '0', '1', '1', 0, '2024-08-22 04:50:54', '2024-08-22 04:50:54'),
(9, 'Services', 'services', NULL, NULL, NULL, NULL, NULL, '0', '1', '0', 0, '2024-08-22 04:51:48', '2024-08-22 04:51:48'),
(10, 'Digital Marketing', 'digital-marketing', NULL, NULL, NULL, NULL, NULL, '9', '1', '1', 0, '2024-08-22 04:52:07', '2024-08-22 04:52:07'),
(11, 'Web Development', 'web-development', NULL, NULL, NULL, NULL, NULL, '9', '1', '1', 0, '2024-08-22 04:52:26', '2024-08-22 04:52:26'),
(12, 'Graphics Design', 'graphics-design', NULL, NULL, NULL, NULL, NULL, '9', '1', '1', 0, '2024-08-22 04:52:53', '2024-08-22 04:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `description_short` text NOT NULL,
  `description_long` longtext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `service_title`, `slug`, `service_image`, `description_short`, `description_long`, `status`, `meta_title`, `meta_description`, `meta_keyword`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', 'https://adsensedesigns.com/public/uploads/services/service_1724401422.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p><img alt=\"\" src=\"https://adsensedesigns.com/assets/img/service/details.jpg\" style=\"height:368px; width:740px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Cloud Service</h1>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt. Maecenas tincidunt, velit ac porttitor pulvinar, tortor eros facilisis libero, vitae commodo nunc quam et ligula</p>\r\n\r\n<h3>Our Goals</h3>\r\n\r\n<ul>\r\n	<li>Aliquam accumsan et ante id</li>\r\n	<li>Lorem ipsum dolor sit dgdr</li>\r\n	<li>Maecenas varius tortor</li>\r\n</ul>\r\n\r\n<h3>The Challenges</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor finibus et. Aenean eu enim justo. Vestibulum</p>\r\n\r\n<p>&nbsp;</p>', '1', 'meta title', 'description', 'keyword', '2024-08-01 05:41:23', '2024-08-23 08:23:42'),
(3, 'Digital Marketing', 'digital-marketing', 'https://adsensedesigns.com/public/uploads/services/service_1724401454.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p><img alt=\"\" src=\"https://adsensedesigns.com/assets/img/service/details.jpg\" /></p>\r\n\r\n<h3>Cloud Service</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et. Aenean eu enim justo. Vestibulum aliquam hendrerit molestie. Mauris malesuada nisi sit amet augue accumsan tincidunt. Maecenas tincidunt, velit ac porttitor pulvinar, tortor eros facilisis libero, vitae commodo nunc quam et ligula</p>\r\n\r\n<h3>Our Goals</h3>\r\n\r\n<ul>\r\n	<li>Aliquam accumsan et ante id</li>\r\n	<li>Lorem ipsum dolor sit dgdr</li>\r\n	<li>Maecenas varius tortor</li>\r\n</ul>\r\n\r\n<h3>The Challenges</h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor finibus et. Aenean eu enim justo. Vestibulum</p>', '1', 'meta title', 'description', 'keyword', '2024-08-05 07:22:34', '2024-08-23 08:24:14'),
(4, 'Graphics Design', 'graphics-design', 'https://adsensedesigns.com/public/uploads/services/service_1724401460.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', 'meta title', 'meta description', 'keyword', '2024-08-22 05:28:33', '2024-08-23 08:24:20'),
(5, 'Motion Graphics', 'motion-graphics', 'https://adsensedesigns.com/public/uploads/services/service_1724401473.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', 'meta title', 'meta description', 'keyword', '2024-08-22 05:36:41', '2024-08-23 08:24:33'),
(6, 'Marketing Solutions', 'marketing-solutions-', 'https://adsensedesigns.com/public/uploads/services/service_1724401481.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', 'meta title', 'meta desc', 'keyword', '2024-08-22 05:37:37', '2024-08-23 08:24:41'),
(7, 'Logo Design', 'logo-design', 'https://adsensedesigns.com/public/uploads/services/service_1724401490.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', NULL, NULL, NULL, '2024-08-22 05:38:49', '2024-08-23 08:24:50'),
(8, 'Exhibitions', 'exhibitions', 'https://adsensedesigns.com/public/uploads/services/service_1724401498.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', NULL, NULL, NULL, '2024-08-22 05:41:59', '2024-08-23 08:24:58'),
(9, 'Interiors', 'interiors', 'https://adsensedesigns.com/public/uploads/services/service_1724401509.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', NULL, NULL, NULL, '2024-08-22 05:42:39', '2024-08-23 08:25:09'),
(10, 'Print Solution', 'print-solution-', 'https://adsensedesigns.com/public/uploads/services/service_1724401533.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', NULL, NULL, NULL, '2024-08-22 05:46:15', '2024-08-23 08:25:33'),
(11, 'Corporates Gifting', 'corporates-gifting', 'https://adsensedesigns.com/public/uploads/services/service_1724401550.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', NULL, NULL, NULL, '2024-08-22 05:47:17', '2024-08-23 08:25:50'),
(12, 'Indoor & Door Branding', 'indoor-&-door-branding', 'https://adsensedesigns.com/public/uploads/services/service_1724401559.jpg', 'We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.', '<p>We embrace holistic development and support for employees with the aim of being a first-choice employer within our sectors. Through a unique combination of engineering, construction and design disciplines and expertise.</p>', '1', NULL, NULL, NULL, '2024-08-22 05:48:09', '2024-08-23 08:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_section`
--
ALTER TABLE `about_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_section1`
--
ALTER TABLE `about_section1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_section2`
--
ALTER TABLE `about_section2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_category_id_foreign` (`category_id`);

--
-- Indexes for table `blogs_category`
--
ALTER TABLE `blogs_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_service`
--
ALTER TABLE `client_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_service_client_id_foreign` (`client_id`),
  ADD KEY `client_service_brand_id_foreign` (`brand_id`),
  ADD KEY `client_service_service_id_foreign` (`service_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navmenu`
--
ALTER TABLE `navmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_section`
--
ALTER TABLE `about_section`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `about_section1`
--
ALTER TABLE `about_section1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `about_section2`
--
ALTER TABLE `about_section2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs_category`
--
ALTER TABLE `blogs_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `client_service`
--
ALTER TABLE `client_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `navmenu`
--
ALTER TABLE `navmenu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `blogs_category` (`id`);

--
-- Constraints for table `client_service`
--
ALTER TABLE `client_service`
  ADD CONSTRAINT `client_service_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `client_service_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `client_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
