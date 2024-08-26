-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 08:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `munaimprodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `greetings` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `hero_description` varchar(255) NOT NULL,
  `hero_image` varchar(100) NOT NULL,
  `about_description` text NOT NULL,
  `about_image` varchar(100) NOT NULL,
  `resume_link` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `greetings`, `full_name`, `designation`, `hero_description`, `hero_image`, `about_description`, `about_image`, `resume_link`, `email`, `phone`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Hi, I am', 'Munaim', 'Designation', 'Hero Description', 'কপোতাক্ষ_নদ.jpg', 'About description', '448776836_1623448114895206_2442884302277450570_n.jpg', 'term.pdf', 'email@gmail.com', '01826-116163', 'location', '2024-05-19 04:43:22', '2024-08-25 14:07:38'),
(2, 'Hi, I am', 'Munaim Khan', 'Web Developer', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', 'C:\\xampp\\tmp\\phpCDB0.tmp', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', 'C:\\xampp\\tmp\\phpCDB1.tmp', 'lorem ipsum dolor sit amet', '', '', '', '2024-05-19 06:34:34', '2024-05-19 06:34:34'),
(3, 'Hi, I am', 'Munaim Khan', 'Web Developer', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', '5.jpg', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', '3.jpg', 'lorem ipsum dolor sit amet', '', '', '', '2024-05-19 06:46:32', '2024-05-19 06:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `award_type` varchar(50) NOT NULL,
  `award_title` varchar(100) NOT NULL,
  `award_date` date NOT NULL,
  `award_provider` varchar(255) NOT NULL,
  `award_for` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `award_type`, `award_title`, `award_date`, `award_provider`, `award_for`, `created_at`, `updated_at`) VALUES
(3, 'Technical', 'Lorem Ipsum', '2024-08-07', 'Lorem Ipsum', 'Lorem Ipsum', '2024-08-04 09:04:33', '2024-08-04 09:34:49'),
(4, 'Programming', 'Award 2', '2024-08-16', 'Provider 2', 'Reason...', '2024-08-04 09:29:04', '2024-08-04 09:35:53'),
(5, 'Other', 'Lorem Ipsum', '2024-08-21', 'Award provider', 'Lorem Ipsum', '2024-08-04 09:29:23', '2024-08-04 09:36:09'),
(7, 'Technical', 'Test award', '2024-08-31', 'Award provider', '<p>AWARD REASON. Lorem ipsum dolor sit amet. AWARD REASON. Lorem ipsum dolor sit amet. AWARD REASON. Lorem ipsum dolor sit amet. AWARD REASON. Lorem ipsum dolor sit amet. AWARD REASON&nbsp;</p>', '2024-08-14 08:26:23', '2024-08-14 08:26:23'),
(8, 'Programming', 'Test award', '2024-08-16', 'Award provider', '<p>AWARD REASON. Lorem ipsum dolor sit amet. AWARD <strong>REASON. Lorem ipsum dolor </strong>sit amet. AWARD REASON. Lorem ipsum dolor sit amet.&nbsp;</p>', '2024-08-14 08:28:11', '2024-08-14 08:28:11'),
(9, 'Programming', 'Test award', '2024-08-23', 'Test provider', '<p>The <strong>award </strong>reason will be <em>here</em></p>', '2024-08-15 00:05:52', '2024-08-15 00:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('53HYz0CoMctLqNE7BQDs0rIS4cmlb59JBeN4vnl1', 'i:33;', 1724568848),
('edkN2cYuOaAti8YJICOrUP230XAAWpwnM4cVbht4', 's:2:\"26\";', 1724499719),
('Fs1neoiLu2tKPVBrKfpwroPtBxIKreCUUhhc3DfN', 'i:33;', 1724568653),
('hfZP45IzLdK1IhlNdoFR36CBtM379MJNlGequGKr', 's:2:\"26\";', 1724569231),
('R1LFly74XGYo3NS1cUbmcXGcsQwaqotIXpn3MAqu', 's:2:\"26\";', 1724569370),
('UunH2pfqKVPLUN1naYXu1TD7cv4qpoZwoqomKHFG', 's:2:\"26\";', 1724569504);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(4, 'Dynamic category 1', '2024-08-11 22:35:08', '2024-08-11 23:10:45'),
(7, 'Dynamic category 2', '2024-08-14 08:50:32', '2024-08-14 08:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `client_feedbacks`
--

CREATE TABLE `client_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_first_name` varchar(50) NOT NULL,
  `client_last_name` varchar(50) NOT NULL,
  `client_designation` varchar(100) NOT NULL,
  `client_image` varchar(100) NOT NULL,
  `client_feedback` text NOT NULL,
  `portfolio_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_feedbacks`
--

INSERT INTO `client_feedbacks` (`id`, `client_first_name`, `client_last_name`, `client_designation`, `client_image`, `client_feedback`, `portfolio_id`, `created_at`, `updated_at`) VALUES
(1, 'Jhon', 'Doe', '', 'image', '', 26, '2024-08-23 19:38:32', '2024-08-24 05:47:31'),
(2, 'First name', 'Last Name', 'Client designation', '04f8e-Capture6.PNG', 'Feedback', 26, '2024-08-24 04:59:32', '2024-08-24 04:59:32'),
(3, 'First name', 'Last Name', 'Client designation', 'fead6-surah al mulk bangla uccharon.jpg', 'Feedback', 26, '2024-08-24 08:38:08', '2024-08-24 08:38:08'),
(4, 'First name', 'Last Name', 'Client designation', 'c3442-surah al mulk bangla uccharon.jpg', 'Feedback', 26, '2024-08-24 08:38:27', '2024-08-24 08:38:27'),
(5, 'First name', 'Last Name', 'Client designation', '1987c-Capture5.PNG', 'Feedback', 26, '2024-08-24 08:41:06', '2024-08-24 08:41:06'),
(6, 'First name', 'Last Name', 'Client designation', 'c6bb3-surah al mulk bangla uccharon.jpg', 'Feedback', 26, '2024-08-24 08:44:53', '2024-08-24 08:44:53'),
(7, 'First name', 'Last Name', 'Client designation', 'f440b-surah al mulk bangla uccharon.jpg', 'Feedback', 26, '2024-08-24 08:50:21', '2024-08-24 08:50:21'),
(8, 'First name', 'Last Name', 'Client designation', '1e42a-surah al mulk bangla uccharon.jpg', 'fdfsdfds', 26, '2024-08-24 08:58:44', '2024-08-24 08:58:44'),
(9, 'First name', 'Last Name', 'Client designation', '74db3-surah al mulk bangla uccharon.jpg', 'Feedback', 26, '2024-08-24 23:57:32', '2024-08-24 23:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `education_type` varchar(100) NOT NULL,
  `education_starting_date` date NOT NULL,
  `education_ending_date` date DEFAULT NULL,
  `education_degree` varchar(100) NOT NULL,
  `education_institution` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `education_type`, `education_starting_date`, `education_ending_date`, `education_degree`, `education_institution`, `created_at`, `updated_at`) VALUES
(22, 'Academic', '2024-08-24', NULL, 'B.Sc in CSIT', 'Southern University Bangladesh', '2024-08-03 11:24:15', '2024-08-13 07:36:25'),
(23, 'Academic', '2024-08-01', NULL, 'M.Sc', 'PCIU', '2024-08-03 11:25:18', '2024-08-03 12:04:30'),
(24, 'Academic', '2024-08-01', NULL, 'HSC', 'Chittagong Port Authority College', '2024-08-03 11:25:58', '2024-08-03 12:04:52'),
(26, 'Technical', '2024-08-03', '2024-08-31', 'Web Design', 'Institution Name', '2024-08-03 11:57:12', '2024-08-04 01:29:55'),
(28, 'Academic', '2024-08-05', '2024-08-31', 'Software Engineering', 'Institution Name', '2024-08-03 12:15:04', '2024-08-04 01:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `experience_title` varchar(50) NOT NULL,
  `experience_institution` varchar(100) NOT NULL,
  `experience_starting_date` date NOT NULL,
  `experience_ending_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `experience_title`, `experience_institution`, `experience_starting_date`, `experience_ending_date`, `created_at`, `updated_at`) VALUES
(2, 'Junior Developer', 'Robust Inc', '2024-01-12', '2024-02-10', '2024-05-20 21:12:52', '2024-08-04 00:53:42'),
(3, 'Senior Software Engineer', 'Plaza Limited', '2024-08-01', NULL, '2024-08-04 00:02:03', '2024-08-04 01:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `interest_title` varchar(100) NOT NULL,
  `interest_icon` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `interest_title`, `interest_icon`, `created_at`, `updated_at`) VALUES
(3, 'Interest Topic', '<i class=\'fas fa-phone\'></i>', '2024-05-19 11:37:59', '2024-08-04 10:57:32'),
(4, 'Demo Interest', '<i class=\'fas fa-phone\'></i>', '2024-08-04 10:08:21', '2024-08-04 10:59:54'),
(7, 'Coding', '<i class=\'fas fa-phone\'></i>', '2024-08-04 11:00:36', '2024-08-04 11:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo`, `created_at`, `updated_at`) VALUES
(3, 'Methodology.png', '2024-05-22 02:57:47', '2024-08-21 22:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `message_status` enum('viewed','new','replied') NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `message_status`, `created_at`, `updated_at`) VALUES
(3, 'X Client', 'khanmail2599@gmail.com', 'Client message subject', 'lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. \nlorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet.', 'new', '2024-08-20 00:09:51', '2024-08-20 00:09:51'),
(4, 'X Client', 'khanmail2599@gmail.com', 'Client message subject', 'lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. \nlorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet.', 'new', '2024-08-26 00:03:32', '2024-08-26 00:03:32'),
(5, 'X Client', 'khanmail2599@gmail.com', 'Client message subject', 'lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. \nlorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet.', 'new', '2024-08-26 00:41:21', '2024-08-26 00:41:21');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2024_05_18_142236_create_categories_table', 1),
(4, '2024_05_18_142433_create_posts_table', 1),
(5, '2024_05_18_144559_create_abouts_table', 2),
(6, '2024_05_18_145400_create_services_table', 2),
(8, '2024_05_18_151735_create_skills_table', 2),
(9, '2024_05_18_151939_create_awards_table', 2),
(10, '2024_05_18_153813_create_experiences_table', 2),
(11, '2024_05_18_154628_create_interests_table', 2),
(12, '2024_05_18_154919_create_social_medias_table', 2),
(13, '2024_05_18_161721_create_messages_table', 2),
(14, '2024_05_18_181348_create_portfolios_table', 3),
(16, '2024_05_18_184043_create_visitor_informations_table', 3),
(17, '2024_05_18_184607_create_logos_table', 3),
(18, '2024_05_18_151501_create_educations_table', 4),
(20, '2024_05_18_183335_create_seoproperties_table', 6),
(22, '2024_08_08_041709_create_client_feedbacks_table', 7);

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
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_title` varchar(255) NOT NULL,
  `project_thumbnail` varchar(100) NOT NULL,
  `project_ui_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`project_ui_image`)),
  `project_type` varchar(100) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `project_description` text NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_designation` varchar(100) DEFAULT NULL,
  `project_starting_date` date NOT NULL,
  `project_ending_date` date DEFAULT NULL,
  `project_url` varchar(100) NOT NULL,
  `core_technology` varchar(100) NOT NULL,
  `project_view` int(11) DEFAULT 0,
  `project_status` enum('published','unpublished','running') NOT NULL DEFAULT 'running',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `project_title`, `project_thumbnail`, `project_ui_image`, `project_type`, `service_id`, `project_description`, `client_name`, `client_designation`, `project_starting_date`, `project_ending_date`, `project_url`, `core_technology`, `project_view`, `project_status`, `created_at`, `updated_at`) VALUES
(26, 'title', 'eb325-Methodology.png', '[]', 'type', 2, 'lorem', 'lorem', 'lorem', '2024-03-05', '2024-03-05', 'lorem', 'lorem', 0, 'published', '2024-08-17 23:14:52', '2024-08-17 23:14:52'),
(27, 'title', '8264f-Methodology.png', '[]', 'type', 2, 'lorem', 'lorem', 'lorem', '2024-03-05', '2024-03-05', 'lorem', 'lorem', 0, 'published', '2024-08-18 05:16:05', '2024-08-18 10:16:28'),
(28, 'title', 'd8fbc-Methodology.png', '[\"d8fbc-\\u0995\\u09aa\\u09cb\\u09a4\\u09be\\u0995\\u09cd\\u09b7_\\u09a8\\u09a6.jpg\"]', 'type', 2, 'lorem', 'lorem', 'lorem', '2024-03-05', '2024-03-05', 'lorem', 'lorem', 0, 'published', '2024-08-18 05:29:39', '2024-08-18 10:33:32'),
(29, 'title', 'd0c0b-Methodology.png', '[\"d0c0b-Methodology.png\",\"d0c0b-\\u0995\\u09aa\\u09cb\\u09a4\\u09be\\u0995\\u09cd\\u09b7_\\u09a8\\u09a6.jpg\"]', 'type', 2, 'lorem', 'lorem', 'lorem', '2024-03-05', '2024-03-05', 'lorem', 'lorem', 0, 'published', '2024-08-18 05:33:22', '2024-08-18 05:33:22'),
(30, 'title', '466ae-Methodology.png', '[\"466ae-download.jpeg\",\"220bf-dream_house.jpg\"]', 'type', 2, 'lorem', 'lorem', 'lorem', '2024-03-05', '2024-03-05', 'lorem', 'lorem', 0, 'published', '2024-08-18 05:35:51', '2024-08-18 05:35:51'),
(31, 'title', 'f7a26-Methodology.png', '[\"f7a26-\\u09ac\\u09bf\\u09b0\\u09bf\\u09b6\\u09bf\\u09b0\\u09bf_\\u09a8\\u09c7\\u09a4\\u09cd\\u09b0\\u0995\\u09cb\\u09a8\\u09be.jpg\",\"f7a26-munaim.jpg\"]', 'type', 2, 'lorem', 'lorem', 'lorem', '2024-03-05', '2024-03-05', 'lorem', 'lorem', 0, 'published', '2024-08-18 05:38:15', '2024-08-18 05:38:15'),
(32, 'Project title', 'a9da7-কপোতাক্ষ_নদ.jpg', '[\"a9da7-download.jpeg\"]', 'Project type', 2, '<p>Project details</p>', 'Client name', 'Client designation', '2024-08-15', NULL, 'Project url', 'Project technology', 0, 'running', '2024-08-18 06:09:10', '2024-08-18 10:28:10'),
(33, 'Project title', '6ac5b-Methodology.png', '[\"6ac5b-download.jpeg\"]', 'Project type', 2, '<p>Details</p>', 'Client name', 'Client designation', '2024-08-08', NULL, 'Project url', 'Project technology', 0, 'running', '2024-08-18 06:14:46', '2024-08-18 06:14:46'),
(34, 'Project title', '646a0-বিরিশিরি_নেত্রকোনা.jpg', '[\"ce955-download.jpeg\"]', 'Project type', 4, '<p>Description</p>', 'Client name', 'Client designation', '2024-08-14', NULL, 'Project url', 'Project technology', 0, 'running', '2024-08-18 07:00:38', '2024-08-19 02:32:32'),
(35, 'Project title', '63d59-Beautiful_New_York_in_Spring.jpg', '[\"63d59-448776836_1623448114895206_2442884302277450570_n.jpg\"]', 'Project type', 4, '<p>Description</p>', 'Client name', 'Client designation', '2024-08-12', '2024-08-20', 'Project url', 'Project technology', 0, 'running', '2024-08-18 22:46:40', '2024-08-18 22:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_heading` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `post_thumbnail` varchar(100) NOT NULL,
  `post_description` longtext NOT NULL,
  `post_view` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `publish_time` datetime NOT NULL DEFAULT current_timestamp(),
  `post_status` enum('published','unpublished','scheduled') NOT NULL DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_heading`, `post_slug`, `post_thumbnail`, `post_description`, `post_view`, `category_id`, `user_id`, `publish_time`, `post_status`, `created_at`, `updated_at`) VALUES
(10, 'Post heading', 'post_slug_wil_go_here', 'ab9d3-শীতের_সন্ধ্যায়_গ্রামের_প্রান্তর.jpg', '<p>Post <strong>details </strong>will go here</p>', 0, 7, 1, '2024-08-16 19:00:00', 'published', '2024-08-16 07:00:29', '2024-08-17 05:38:03'),
(11, 'Post heading', 'post slug', 'ec199-dream_house.jpg', '<p>Post detail</p>', 0, 4, 1, '2024-08-17 19:12:00', 'unpublished', '2024-08-16 07:12:27', '2024-08-17 12:35:24'),
(12, 'Post heading', 'post slug', '3a0fd-কপোতাক্ষ_নদ.jpg', '<p>Description</p>', 0, 7, 1, '2024-08-31 19:19:00', 'published', '2024-08-16 07:19:10', '2024-08-16 09:22:00'),
(13, 'Post heading', 'post slug', 'aa690-কপোতাক্ষ_নদ.jpg', '<p>Post details</p>', 0, 7, 1, '2024-08-16 21:19:00', 'published', '2024-08-16 09:18:32', '2024-08-16 09:22:00'),
(14, 'Post heading', 'post slug', '5cb1b-448776836_1623448114895206_2442884302277450570_n.jpg', '<p>Details</p>', 0, 7, 1, '2024-08-16 21:25:00', 'published', '2024-08-16 09:23:49', '2024-08-16 09:23:51'),
(15, 'Post heading', 'post slug', '91c89-কপোতাক্ষ_নদ.jpg', '<p>Post details</p>', 0, 7, 1, '2024-08-16 21:29:00', 'published', '2024-08-16 09:27:18', '2024-08-16 09:27:20'),
(17, 'Post heading', 'post slug', 'c2513-download.jpeg', '<p>Post details</p>', 0, 4, 1, '2024-08-16 22:02:00', 'published', '2024-08-16 09:46:04', '2024-08-16 10:02:05'),
(18, 'Post heading', 'post slug', 'e8e53-Beautiful_New_York_in_Spring.jpg', '<p>Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet. Post details will go here. Lorem ipsum dolor sit amet.&nbsp;</p>', 0, 4, 1, '2024-08-17 10:50:00', 'published', '2024-08-16 22:49:10', '2024-08-16 22:51:01'),
(19, 'Post heading', 'post slug', 'f3906-কপোতাক্ষ_নদ.jpg', '<p>Post description will be go here</p>', 0, 7, 1, '2024-08-17 20:20:00', 'published', '2024-08-17 08:19:16', '2024-08-17 08:20:59'),
(21, 'Post heading', 'post slug', '4504a-Methodology.png', '<p>Post details</p>', 0, 7, 1, '2024-08-18 00:17:29', 'published', '2024-08-17 12:17:29', '2024-08-17 12:17:29'),
(22, 'Post heading', 'post slug', '2e54c-Capture2.PNG', '<p>Post details</p>', 0, 7, 1, '2024-08-18 00:50:00', 'published', '2024-08-17 12:46:15', '2024-08-17 12:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `seoproperties`
--

CREATE TABLE `seoproperties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` enum('index','about','services','portfolio','portfolio_details','pricing','blog','blog_details','contact') NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_keywords` varchar(255) NOT NULL,
  `site_description` tinytext NOT NULL,
  `author` varchar(100) NOT NULL,
  `og_site_name` varchar(100) NOT NULL,
  `og_url` varchar(100) NOT NULL,
  `og_title` varchar(100) NOT NULL,
  `og_description` tinytext NOT NULL,
  `og_type` enum('website','article','video.movie','video.episode','video.tv_show','video.other','music.song','music.album','profile','product') NOT NULL,
  `og_image` varchar(100) NOT NULL,
  `twitter_card` enum('summary','summary_large_image','app','player') NOT NULL,
  `twitter_title` varchar(100) NOT NULL,
  `twitter_description` tinytext NOT NULL,
  `twitter_image` varchar(100) NOT NULL,
  `robots` enum('index, follow','noindex, follow','index, nofollow','noindex, nofollow','noarchive','nosnippet','noodp','noimageindex','nocache') NOT NULL,
  `canonical_url` varchar(100) NOT NULL,
  `application_name` varchar(100) NOT NULL,
  `theme_color` varchar(100) NOT NULL,
  `google_site_verification` varchar(100) DEFAULT NULL,
  `referrer` enum('no-referrer','no-referrer-when-downgrade','origin','origin-when-cross-origin','same-origin','strict-origin','strict-origin-when-cross-origin','unsafe-url') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seoproperties`
--

INSERT INTO `seoproperties` (`id`, `page_name`, `site_title`, `site_keywords`, `site_description`, `author`, `og_site_name`, `og_url`, `og_title`, `og_description`, `og_type`, `og_image`, `twitter_card`, `twitter_title`, `twitter_description`, `twitter_image`, `robots`, `canonical_url`, `application_name`, `theme_color`, `google_site_verification`, `referrer`, `created_at`, `updated_at`) VALUES
(1, 'index', 'Munaim Personal Website', 'keyword 1, keyword 2, keyword 3', 'Website Description', 'Website Author', 'Open Graph Website Name', 'Open Graph Website URL', 'Open Graph Website Title', 'Open Graph Website Description', 'website', 'eee23-শীতের_সন্ধ্যায়_গ্রামের_প্রান্তর.jpg', 'summary', 'Twitter Title', 'Twitter Description', '25bc6-শীতের_সন্ধ্যায়_গ্রামের_প্রান্তর.jpg', 'index, follow', 'Canonical URL', 'Application Name', '#33c73d', 'Google Site Verification - 2342d55x4', 'origin', '2024-08-21 10:56:00', '2024-08-21 21:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_icon` varchar(255) NOT NULL,
  `service_title` varchar(100) NOT NULL,
  `service_description` text NOT NULL,
  `service_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_icon`, `service_title`, `service_description`, `service_status`, `created_at`, `updated_at`) VALUES
(2, '<i class=\'fas fa-phone\'></i>', 'Service name', 'Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet.', 1, '2024-05-20 21:08:56', '2024-08-07 23:28:59'),
(4, '<i class=\'fas fa-phone\'></i>', 'Service 2', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', 1, '2024-08-07 23:30:20', '2024-08-21 23:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('A5lgObVPVef8Rc6tgrjUcWIg72vTpre8DChSMyVa', NULL, '127.0.0.1', 'PostmanRuntime/7.41.2', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjNVbkh6Umw2WW1hb0ZxVHhBem5pNzdPN1FCVE1oeTJlbldVZU5IeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbi9zaWduaW4iO319', 1724655183),
('vUAR4dq4G07oD2PTPwXIcBrA75EYzWckewFAWijY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzN4YXlEbU1DNkswWmpnbGZ4WVZueXA4QjNYQ0x1MWJvb01EQXZEOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXRyaWV2ZUFsbFZpc2l0b3JJbmZvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1724651788);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skill_type` varchar(50) NOT NULL,
  `skill_name` varchar(50) NOT NULL,
  `skill_percentage` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_type`, `skill_name`, `skill_percentage`, `created_at`, `updated_at`) VALUES
(2, 'Lorem', 'Lorem', 90, '2024-05-20 21:28:28', '2024-05-20 21:28:28'),
(3, 'Technical', 'New skill', 88, '2024-08-04 07:42:24', '2024-08-04 08:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `social_medias`
--

CREATE TABLE `social_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social_media_title` varchar(100) NOT NULL,
  `social_media_link` varchar(100) NOT NULL,
  `social_media_icon` varchar(50) NOT NULL,
  `global_social_media` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_medias`
--

INSERT INTO `social_medias` (`id`, `social_media_title`, `social_media_link`, `social_media_icon`, `global_social_media`, `created_at`, `updated_at`) VALUES
(4, 'facebook', 'https://facebook.com/munaim', '<i class=\'fab fa-facebook\'></i>', 1, '2024-08-04 22:52:40', '2024-08-26 06:44:42'),
(5, 'linkedin', 'https://linkedin.com/in/munaimpro', '<i class=\'fab fa-linkedin\'></i>', 1, '2024-08-04 22:54:58', '2024-08-26 06:44:51'),
(6, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-04 23:40:03', '2024-08-04 23:40:03'),
(7, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-04 23:40:52', '2024-08-04 23:40:52'),
(8, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-04 23:48:15', '2024-08-04 23:48:15'),
(9, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:01:16', '2024-08-05 00:01:16'),
(10, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:03:02', '2024-08-05 00:03:02'),
(11, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:03:19', '2024-08-05 00:03:19'),
(12, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:05:10', '2024-08-05 00:05:10'),
(13, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:06:37', '2024-08-05 00:06:37'),
(14, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:07:42', '2024-08-05 00:07:42'),
(15, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:09:55', '2024-08-05 00:09:55'),
(16, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 1, '2024-08-05 00:22:33', '2024-08-05 00:22:33'),
(17, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:23:06', '2024-08-05 00:23:06'),
(18, 'Lorem', 'Lorem Ipsum', '<i class=\'fas fa-phone\'></i>', 1, '2024-08-05 00:23:35', '2024-08-05 00:23:35'),
(19, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:28:28', '2024-08-05 00:28:28'),
(20, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 1, '2024-08-05 00:28:55', '2024-08-05 00:28:55'),
(21, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 00:31:22', '2024-08-05 00:31:22'),
(22, 'Lorem Ipsum', 'Lorem Ipsum', '<i class=\'fas fa-phone\'></i>', 1, '2024-08-05 00:32:53', '2024-08-05 07:05:54'),
(23, 'Lorem', 'Lorem', '<i class=\'fas fa-phone\'></i>', 0, '2024-08-05 07:05:06', '2024-08-05 07:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `email_verified_at`, `password`, `profile_picture`, `otp`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Munaim', 'Khan', '01826-116163', 'khanmail2599@gmail.com', NULL, '$2y$12$cvgvszt.S.5QV0F./8XNA.ooLlPrj89I/f4H3Su4kjlSlZ7aEULqm', '695a4-munaim.jpg', '0', 'admin', NULL, '2024-05-18 23:14:28', '2024-08-25 22:41:43'),
(6, 'Rashedul', 'Karim', '', 'rashed@gmail.com', NULL, '$2y$12$nwLv2b0IW/UA66VSdmS5RuDBCGKGUYDSkgnjLlIMovHrnuIUTAOWG', NULL, '0', 'user', NULL, '2024-05-20 21:45:49', '2024-08-25 02:01:10'),
(8, 'Rashedul', 'Karim', '', 'rafi@gmail.com', NULL, '$2y$12$eNEWqikMLZVjyRgDGflx5OeXOFoeeRH7cQH93B08E8IpK6NwyR6LK', 'C:\\xampp\\tmp\\php3069.tmp', '0', 'user', NULL, '2024-05-20 21:51:55', '2024-08-25 02:01:50'),
(26, 'First Name', 'Last Name', '01826-116163', 'test@gmail.com', NULL, '$2y$12$cI4kxoAtkEnbOo8kWl05d.8yy/ZYm.R/2HmV8FjyfwGRLBw7NkK2.', NULL, '0', 'user', NULL, '2024-08-25 08:18:29', '2024-08-25 08:18:29'),
(27, 'First Name', 'Last Name', '01826116163', 'test-2@gmail.com', NULL, '$2y$12$BGWfgQT2fSLscdDfBrDWFOwRf.OUBEEd6Omju9onn/JDxnrh.sgjm', 'e197b-Capture2.PNG', '0', 'user', NULL, '2024-08-25 08:21:30', '2024-08-25 08:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_informations`
--

CREATE TABLE `visitor_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `visitor_country` varchar(100) NOT NULL,
  `visitor_browser` varchar(100) NOT NULL,
  `total_visit` int(11) NOT NULL DEFAULT 0,
  `last_visiting_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitor_informations`
--

INSERT INTO `visitor_informations` (`id`, `ip_address`, `visitor_country`, `visitor_browser`, `total_visit`, `last_visiting_time`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'India', 'Chrome', 3, '2024-08-22 06:42:42', '2024-08-22 06:42:42', '2024-08-22 06:42:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_feedbacks`
--
ALTER TABLE `client_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_feedbacks_portfolio_id_foreign` (`portfolio_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolios_service_id_foreign` (`service_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `seoproperties`
--
ALTER TABLE `seoproperties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_medias`
--
ALTER TABLE `social_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visitor_informations`
--
ALTER TABLE `visitor_informations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `client_feedbacks`
--
ALTER TABLE `client_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `seoproperties`
--
ALTER TABLE `seoproperties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_medias`
--
ALTER TABLE `social_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `visitor_informations`
--
ALTER TABLE `visitor_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_feedbacks`
--
ALTER TABLE `client_feedbacks`
  ADD CONSTRAINT `client_feedbacks_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`);

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
