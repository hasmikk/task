-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2021 at 06:25 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_hasmik`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_accounts`
--

CREATE TABLE `email_accounts` (
  `id` int(11) NOT NULL,
  `email_address` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_from` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` tinyint(3) DEFAULT 0,
  `host` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `port` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `encryption` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_accounts`
--

INSERT INTO `email_accounts` (`id`, `email_address`, `send_from`, `is_default`, `host`, `port`, `password`, `username`, `encryption`) VALUES
(1, 'bhaushalt.ysell@gmail.com', 'Test System', 1, 'smtp.googlemail.com', '465', 'vaxzmvozaprqvxvt', 'bhaushalt.ysell@gmail.com', 'ssl');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `body`, `created_at`) VALUES
(1, 'Template 1', 'Hello World ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. ', NULL),
(2, 'Templete 2 ', 'Test 123', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 1616780952),
(3, 'Templete 3', 'Dummy Text ', 'Here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', 1616781042),
(5, 'Templete 4', 'Some text', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1616938397);

-- --------------------------------------------------------

--
-- Table structure for table `mail_queue`
--

CREATE TABLE `mail_queue` (
  `id` int(11) NOT NULL,
  `from` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT 1,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mail_queue`
--

INSERT INTO `mail_queue` (`id`, `from`, `to`, `subject`, `body`, `status`, `created_at`, `updated_at`) VALUES
(3, 'bhaushalt.ysell@gmail.com', 'hasmik.softler@gmail.com', 'Hello World ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. ', 2, 1616936746, 1616948185);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1616775473),
('m130524_201442_init', 1616775480),
('m190124_110200_add_verification_token_column_to_user_table', 1616775480),
('m210326_161915_addUser', 1616777041),
('m210326_172528_email_templates_table', 1616780018),
('m210326_175428_students_table', 1616781691),
('m210328_103918_mail_queue_table', 1616928308),
('m210328_143759_email_accounts_table', 1616947418);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'Hasmik', 'Stepanyan', 'hasmik_stepanyan', '$2y$13$HPOB8zkdYgkIUiKCTtdxse22ywHgmiZUye1zdi0Elo2FJzCMktG.G', 'hasmik.softler@gmail.com', NULL),
(2, 'Sofia', 'Makaryan', 'Sofia_Makaryan', '$2y$13$MK3Sc297QcaZXh6RNuawB.N/wW4HwRsDyWcNGNuJFHOMDOT5BxUEO', 'hasmik.karakashyan@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(300, 'admin', 'nmJL51O6urbQ70BkNAZSuvuqN0km5l1t', '$2y$13$YWEDbViOeyjUaAFADkcQYeZd1pX7dmpl1oswE.RHck/uEwPXPElJm', '', 'hasmik.karakashyan@gmail.com', 10, 2147483647, 2147483647, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_accounts`
--
ALTER TABLE `email_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `mail_queue`
--
ALTER TABLE `mail_queue`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject` (`subject`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_accounts`
--
ALTER TABLE `email_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mail_queue`
--
ALTER TABLE `mail_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
