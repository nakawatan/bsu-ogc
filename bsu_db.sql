-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 11:32 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bsu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `id` int(11) NOT NULL,
  `banner_img` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`id`, `banner_img`, `date_uploaded`) VALUES
(6, 'banner-990x240-red.jpg', '2021-10-17 03:08:49'),
(7, 'banner-990x240-blue.jpg', '2021-10-17 03:08:49'),
(8, 'banner-990x240-green.jpg', '2021-10-17 03:08:49'),
(9, 'sample-banner.jpg', '2021-10-17 03:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointment`
--

CREATE TABLE `tbl_appointment` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `appointment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forms`
--

CREATE TABLE `tbl_forms` (
  `id` int(11) NOT NULL,
  `form_title` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_file` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_options`
--

CREATE TABLE `tbl_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_options`
--

INSERT INTO `tbl_options` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'announcement', ''),
(2, 'disable_hour', 's:63:\"[\"7:00 am - 8:00 am\",\"8:00 am - 9:00 am\",\"11:00 am - 12:00 pm\"]\";'),
(3, 'disable_day', 's:25:\"[\"1\",\"12\",\"13\",\"16\",\"24\"]\";'),
(4, 'disable_month', 's:23:\"[\"November\",\"December\"]\";');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_cgmc_job_application`
--

CREATE TABLE `tbl_request_cgmc_job_application` (
  `id` int(11) NOT NULL,
  `receipt_number` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tor_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tor_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_cgmc_ojt`
--

CREATE TABLE `tbl_request_cgmc_ojt` (
  `id` int(11) NOT NULL,
  `registration_form_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_form_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_form_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `career_advising_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `career_advising_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_cgmc_rnu_rep`
--

CREATE TABLE `tbl_request_cgmc_rnu_rep` (
  `id` int(11) NOT NULL,
  `registration_form_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_cgmc_scholarship`
--

CREATE TABLE `tbl_request_cgmc_scholarship` (
  `id` int(11) NOT NULL,
  `receipt_number` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `application_form_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `application_form_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `registration_form_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `grades_from_prev_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grades_from_prev_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_cgmc_tosa_app`
--

CREATE TABLE `tbl_request_cgmc_tosa_app` (
  `id` int(11) NOT NULL,
  `receipt_number` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tosa_app_form_of_scholarship_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `tosa_app_form_of_scholarship_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `registration_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `registration_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `proof_of_app_of_ha_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `proof_of_app_of_ha_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_cgmc_transferee`
--

CREATE TABLE `tbl_request_cgmc_transferee` (
  `id` int(11) NOT NULL,
  `receipt_number` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `exit_interview_form_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `exit_interview_form_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cgmc_file` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `suffixes` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` datetime NOT NULL,
  `department` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `course` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`student_id`, `first_name`, `last_name`, `middle_name`, `suffixes`, `birthdate`, `department`, `course`) VALUES
(1, 'Ronald', 'Bee', 'Test', 'Jr.', '1990-11-16 18:31:50', 'Informatics and Computing Sciences', 'BS Information Technology'),
(2, 'John', 'Doe', 'A', '', '2000-10-04 21:05:12', 'Informatics and Computing Sciences', 'BS Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_level` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `email`, `student_id`, `user_level`, `created_date`, `last_login`) VALUES
(1, 'super_admin', '656c19427c33d7b048b4a98017bc0299', '', '', 'administrator', '0000-00-00 00:00:00', '2021-11-21 22:07:28'),
(3, '18-01990', '656c19427c33d7b048b4a98017bc0299', 'ron.fastmedia@gmail.com', '1', 'student', '0000-00-00 00:00:00', '2021-11-22 09:41:37'),
(4, '18-01991', '656c19427c33d7b048b4a98017bc0299', 'ron.fastmedia@gmail.com', '2', 'student', '0000-00-00 00:00:00', '2021-10-17 09:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `role`, `created_date`) VALUES
(1, 'administrator', '2021-09-18 06:12:00'),
(2, 'student', '2021-09-18 06:12:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forms`
--
ALTER TABLE `tbl_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_options`
--
ALTER TABLE `tbl_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_request_cgmc_job_application`
--
ALTER TABLE `tbl_request_cgmc_job_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_cgmc_ojt`
--
ALTER TABLE `tbl_request_cgmc_ojt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_cgmc_rnu_rep`
--
ALTER TABLE `tbl_request_cgmc_rnu_rep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_cgmc_scholarship`
--
ALTER TABLE `tbl_request_cgmc_scholarship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_cgmc_tosa_app`
--
ALTER TABLE `tbl_request_cgmc_tosa_app`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_request_cgmc_transferee`
--
ALTER TABLE `tbl_request_cgmc_transferee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_appointment`
--
ALTER TABLE `tbl_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_forms`
--
ALTER TABLE `tbl_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_options`
--
ALTER TABLE `tbl_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_request_cgmc_job_application`
--
ALTER TABLE `tbl_request_cgmc_job_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_request_cgmc_ojt`
--
ALTER TABLE `tbl_request_cgmc_ojt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_request_cgmc_rnu_rep`
--
ALTER TABLE `tbl_request_cgmc_rnu_rep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_request_cgmc_scholarship`
--
ALTER TABLE `tbl_request_cgmc_scholarship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_request_cgmc_tosa_app`
--
ALTER TABLE `tbl_request_cgmc_tosa_app`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_request_cgmc_transferee`
--
ALTER TABLE `tbl_request_cgmc_transferee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
