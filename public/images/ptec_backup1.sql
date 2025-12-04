-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2025 at 06:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptec`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `status` enum('active','unactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `institute_id`, `name`, `email`, `phone`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '687686', '$2y$12$ChrOEACntN7.NAtIsnXzveizWlLqRL5MPcU4Tkj2sAtYvDkddPe6e', 'admin', 'active', '2025-11-01 20:00:27', '2025-11-01 20:00:27'),
(2, 2, 'Arifmashal', 'arifmashal@gmail.com', '03451113812', '$2y$12$c9llfYFgqmmn7sE/0dTBcOwSlKtK46.4jWZH90lK1EL1u5pGU0nr6', 'admin', 'active', '2025-11-03 19:33:08', '2025-11-03 19:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `diplomaID` bigint(20) UNSIGNED NOT NULL,
  `sessionID` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `student_id`, `diplomaID`, `sessionID`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'approved', '2025-11-03 18:05:19', '2025-11-03 19:28:36'),
(2, 1, 2, 1, 'rejected', '2025-11-03 19:28:22', '2025-11-03 19:43:31'),
(3, 3, 3, 2, 'approved', '2025-11-03 19:43:14', '2025-11-03 19:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseName`, `created_at`, `updated_at`) VALUES
(1, 'Testing-1', '2025-11-01 20:03:00', '2025-11-01 20:03:00'),
(2, 'Testing-2', '2025-11-01 20:03:11', '2025-11-01 20:03:11'),
(3, 'Testing-3', '2025-11-01 20:03:19', '2025-11-01 20:03:19'),
(4, 'testingg-1', '2025-11-01 20:03:36', '2025-11-01 20:03:36'),
(5, 'testingg-2', '2025-11-01 20:03:41', '2025-11-01 20:03:41'),
(6, 'testingg-3', '2025-11-01 20:03:47', '2025-11-01 20:03:47'),
(7, 'Diploma in Commerce', '2025-11-03 19:34:49', '2025-11-03 19:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `diplomas`
--

CREATE TABLE `diplomas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `SessionID` bigint(20) UNSIGNED NOT NULL,
  `DiplomaName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diplomas`
--

INSERT INTO `diplomas` (`id`, `SessionID`, `DiplomaName`, `created_at`, `updated_at`) VALUES
(1, 1, 'Testing-1 Diploma', '2025-11-01 20:04:10', '2025-11-01 20:04:10'),
(2, 1, 'Testing-2 Diploma', '2025-11-01 20:04:33', '2025-11-01 20:04:33'),
(3, 2, 'Diploma in E-Commerce', '2025-11-03 19:35:17', '2025-11-03 19:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `diplomawise_courses`
--

CREATE TABLE `diplomawise_courses` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `diplomaID` bigint(20) UNSIGNED NOT NULL,
  `courseID` bigint(20) UNSIGNED NOT NULL,
  `semesterID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diplomawise_courses`
--

INSERT INTO `diplomawise_courses` (`ID`, `diplomaID`, `courseID`, `semesterID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-11-01 20:04:54', '2025-11-01 20:04:54'),
(2, 1, 2, 1, '2025-11-01 20:04:54', '2025-11-01 20:04:54'),
(3, 1, 3, 1, '2025-11-01 20:04:54', '2025-11-01 20:04:54'),
(4, 2, 4, 1, '2025-11-01 20:05:09', '2025-11-01 20:05:09'),
(5, 2, 5, 1, '2025-11-01 20:05:09', '2025-11-01 20:05:09'),
(6, 2, 6, 1, '2025-11-01 20:05:09', '2025-11-01 20:05:09'),
(7, 3, 7, 2, '2025-11-03 19:35:36', '2025-11-03 19:35:36'),
(8, 3, 7, 3, '2025-11-03 19:36:18', '2025-11-03 19:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `examination_criteria`
--

CREATE TABLE `examination_criteria` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `DiplomawiseCourseID` bigint(20) UNSIGNED NOT NULL,
  `sessionID` bigint(20) UNSIGNED NOT NULL,
  `TheoryMarks` int(11) NOT NULL,
  `PracticalMarks` int(11) DEFAULT NULL,
  `TotalMarks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `examination_criteria`
--

INSERT INTO `examination_criteria` (`ID`, `DiplomawiseCourseID`, `sessionID`, `TheoryMarks`, `PracticalMarks`, `TotalMarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 50, 20, 70, '2025-11-01 20:05:25', '2025-11-01 20:05:25'),
(2, 2, 1, 70, 30, 100, '2025-11-01 20:05:37', '2025-11-01 20:05:37'),
(3, 3, 1, 35, 15, 50, '2025-11-01 20:05:59', '2025-11-01 20:05:59'),
(4, 4, 1, 60, 40, 100, '2025-11-01 20:06:18', '2025-11-01 20:06:18'),
(5, 5, 1, 100, 50, 150, '2025-11-01 20:06:25', '2025-11-01 20:06:25'),
(6, 6, 1, 65, 35, 100, '2025-11-01 20:06:38', '2025-11-01 20:06:38'),
(7, 7, 2, 75, 25, 100, '2025-11-03 19:37:22', '2025-11-03 19:37:22'),
(8, 8, 2, 75, 25, 100, '2025-11-03 19:41:38', '2025-11-03 19:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grade` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `institute_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `institute_name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Brilliant Coaching Academy', NULL, '2025-11-01 20:00:12', '2025-11-01 20:00:12'),
(2, 'Mashal Institute of Computer Sciences (MICS)', 'Afghanistan', '2025-11-03 19:32:15', '2025-11-03 19:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_id` bigint(20) UNSIGNED NOT NULL,
  `marks` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_05_140021_create_institutes_table', 1),
(5, '2025_10_06_073733_create_admins_table', 1),
(6, '2025_10_06_113449_create_super_admins_table', 1),
(7, '2025_10_08_090715_create_mysessions_table', 1),
(8, '2025_10_09_103959_create_courses_table', 1),
(9, '2025_10_11_133259_create_students_table', 1),
(10, '2025_10_17_162731_create_grades_table', 1),
(11, '2025_10_19_060153_create_subjects_table', 1),
(12, '2025_10_19_095212_create_diplomas_table', 1),
(13, '2025_10_19_104113_create_semesters_table', 1),
(14, '2025_10_19_110004_create_diplomawise_courses_table', 1),
(15, '2025_10_20_074827_create_marks_table', 1),
(16, '2025_10_20_101233_create_student_diplomas_table', 1),
(17, '2025_10_20_152030_create_student_courses_table', 1),
(18, '2025_10_23_095315_create_examination_criteria_table', 1),
(19, '2025_10_25_144125_create_results_table', 1),
(20, '2025_10_30_050813_create_certificates_table', 1),
(21, '2025_11_01_125308_add_diploma_i_d__to_table_name_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mysessions`
--

CREATE TABLE `mysessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mysessions`
--

INSERT INTO `mysessions` (`id`, `session`, `created_at`, `updated_at`) VALUES
(1, 'Testing 2025-2026', '2025-11-01 20:00:39', '2025-11-01 20:00:39'),
(2, '2040-2041', '2025-11-03 19:33:59', '2025-11-03 19:33:59');

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
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ExaminationCriteriaID` bigint(20) UNSIGNED NOT NULL,
  `StudentID` bigint(20) UNSIGNED NOT NULL,
  `diplomaID` bigint(20) UNSIGNED NOT NULL,
  `sessionID` bigint(20) UNSIGNED NOT NULL,
  `semesterID` varchar(10) NOT NULL,
  `TheoryTotalMarks` int(11) NOT NULL,
  `TheoryMarks` int(11) NOT NULL,
  `PracticalTotalMarks` int(11) NOT NULL,
  `PracticalMarks` int(11) NOT NULL,
  `PassingMarks` int(11) NOT NULL,
  `TotalMarks` int(11) NOT NULL,
  `ObtainedMarks` int(11) NOT NULL,
  `Grade` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `ExaminationCriteriaID`, `StudentID`, `diplomaID`, `sessionID`, `semesterID`, `TheoryTotalMarks`, `TheoryMarks`, `PracticalTotalMarks`, `PracticalMarks`, `PassingMarks`, `TotalMarks`, `ObtainedMarks`, `Grade`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '', 50, 50, 20, 10, 35, 70, 60, 'A', 'Pass', NULL, NULL),
(2, 2, 1, 1, 1, '', 70, 50, 30, 20, 50, 100, 70, 'B', 'Pass', NULL, NULL),
(3, 3, 1, 1, 1, '', 35, 25, 15, 10, 25, 50, 35, 'B', 'Pass', NULL, NULL),
(4, 4, 1, 2, 1, '', 60, 40, 40, 10, 50, 100, 50, 'D', 'Pass', NULL, NULL),
(5, 5, 1, 2, 1, '', 100, 50, 50, 25, 75, 150, 75, 'D', 'Pass', NULL, NULL),
(6, 6, 1, 2, 1, '', 65, 30, 35, 15, 50, 100, 45, 'F', 'Fail', NULL, NULL),
(9, 7, 3, 3, 2, '2', 75, 70, 25, 10, 50, 100, 80, 'A', 'Pass', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semesterName` varchar(255) NOT NULL,
  `Duration` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semesterName`, `Duration`, `created_at`, `updated_at`) VALUES
(1, 'Testing Semester-1', '6 months', '2025-11-01 20:02:18', '2025-11-01 20:02:18'),
(2, 'Semester -I', '6 Months', '2025-11-03 19:34:27', '2025-11-03 19:34:27'),
(3, 'Semester-II', '6 Months', '2025-11-03 19:35:56', '2025-11-03 19:35:56');

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

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `instituteId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `fatherName` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Others') NOT NULL,
  `joiningDate` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `image`, `instituteId`, `name`, `fatherName`, `phone`, `cnic`, `dob`, `email`, `gender`, `joiningDate`, `address`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'testing-1 Student', 'testing-1 Father', '6786846', '11111-1111111-1', '2010-10-10', 'testing1@gmail.com', 'Male', '2025-11-01', NULL, '2025-11-01 20:08:36', '2025-11-01 20:08:36'),
(2, NULL, 1, 'testing-2 Student', 'testing-2 Father', '37289', '22222-2222222-2', '2000-02-01', 'testing2@gmail.com', 'Male', '2025-11-01', NULL, '2025-11-01 20:09:36', '2025-11-01 20:09:36'),
(3, NULL, 1, 'Muneer Khan', 'Alam Gul', '+1 (407) 42', '17301-1123132-1', '1997-01-10', 'infoosamaaziz@gmail.com', 'Male', '2025-11-03', 'Tempor perferendis o', '2025-11-03 19:38:20', '2025-11-03 19:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `StudentDiplomaID` bigint(20) UNSIGNED NOT NULL,
  `DiplomawiseCourseID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `StudentDiplomaID`, `DiplomawiseCourseID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-11-01 20:10:06', '2025-11-01 20:10:06'),
(2, 1, 2, '2025-11-01 20:10:06', '2025-11-01 20:10:06'),
(3, 1, 3, '2025-11-01 20:10:06', '2025-11-01 20:10:06'),
(4, 2, 4, '2025-11-01 21:54:45', '2025-11-01 21:54:45'),
(5, 2, 5, '2025-11-01 21:54:45', '2025-11-01 21:54:45'),
(6, 2, 6, '2025-11-01 21:54:45', '2025-11-01 21:54:45'),
(7, 3, 7, '2025-11-03 19:39:01', '2025-11-03 19:39:01'),
(8, 3, 8, '2025-11-03 19:39:01', '2025-11-03 19:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `student_diplomas`
--

CREATE TABLE `student_diplomas` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `diploma_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `issue_diploma` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_diplomas`
--

INSERT INTO `student_diplomas` (`ID`, `student_id`, `diploma_id`, `semester_id`, `issue_diploma`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, '2025-11-01 20:10:06', '2025-11-01 20:10:06'),
(2, 1, 2, 1, 0, '2025-11-01 21:54:45', '2025-11-01 21:54:45'),
(3, 3, 3, 2, 0, '2025-11-03 19:39:01', '2025-11-03 19:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `super_admins`
--

CREATE TABLE `super_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super-admin','admin') NOT NULL DEFAULT 'super-admin',
  `status` enum('active','unactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `super_admins`
--

INSERT INTO `super_admins` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'super', 'super@gmail.com', '$2y$12$8wR28nn57mc7SUvKl7nyu./QyUTnbSGOYfJO2Utbn/WBfzKN9N9nG', 'super-admin', 'active', NULL, '2025-11-03 17:41:08');

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
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_institute_id_foreign` (`institute_id`);

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
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificates_student_id_foreign` (`student_id`),
  ADD KEY `certificates_diplomaid_foreign` (`diplomaID`),
  ADD KEY `certificates_sessionid_foreign` (`sessionID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_coursename_unique` (`courseName`);

--
-- Indexes for table `diplomas`
--
ALTER TABLE `diplomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diplomas_sessionid_foreign` (`SessionID`);

--
-- Indexes for table `diplomawise_courses`
--
ALTER TABLE `diplomawise_courses`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `diplomawise_courses_diplomaid_foreign` (`diplomaID`),
  ADD KEY `diplomawise_courses_courseid_foreign` (`courseID`),
  ADD KEY `diplomawise_courses_semesterid_foreign` (`semesterID`);

--
-- Indexes for table `examination_criteria`
--
ALTER TABLE `examination_criteria`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `examination_criteria_diplomawisecourseid_foreign` (`DiplomawiseCourseID`),
  ADD KEY `examination_criteria_sessionid_foreign` (`sessionID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `grades_grade_unique` (`grade`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institutes_institute_name_unique` (`institute_name`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marks_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mysessions`
--
ALTER TABLE `mysessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semesterID` (`semesterID`,`ExaminationCriteriaID`,`StudentID`,`diplomaID`,`sessionID`),
  ADD KEY `results_examinationcriteriaid_foreign` (`ExaminationCriteriaID`),
  ADD KEY `results_studentid_foreign` (`StudentID`),
  ADD KEY `results_diplomaid_foreign` (`diplomaID`),
  ADD KEY `results_sessionid_foreign` (`sessionID`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`),
  ADD UNIQUE KEY `students_cnic_unique` (`cnic`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_instituteid_foreign` (`instituteId`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_courses_studentdiplomaid_foreign` (`StudentDiplomaID`),
  ADD KEY `student_courses_diplomawisecourseid_foreign` (`DiplomawiseCourseID`);

--
-- Indexes for table `student_diplomas`
--
ALTER TABLE `student_diplomas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `student_diplomas_student_id_foreign` (`student_id`),
  ADD KEY `student_diplomas_diploma_id_foreign` (`diploma_id`),
  ADD KEY `student_diplomas_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_admins`
--
ALTER TABLE `super_admins`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `diplomas`
--
ALTER TABLE `diplomas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diplomawise_courses`
--
ALTER TABLE `diplomawise_courses`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `examination_criteria`
--
ALTER TABLE `examination_criteria`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `mysessions`
--
ALTER TABLE `mysessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_diplomas`
--
ALTER TABLE `student_diplomas`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `super_admins`
--
ALTER TABLE `super_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_diplomaid_foreign` FOREIGN KEY (`diplomaID`) REFERENCES `diplomas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificates_sessionid_foreign` FOREIGN KEY (`sessionID`) REFERENCES `mysessions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certificates_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diplomas`
--
ALTER TABLE `diplomas`
  ADD CONSTRAINT `diplomas_sessionid_foreign` FOREIGN KEY (`SessionID`) REFERENCES `mysessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diplomawise_courses`
--
ALTER TABLE `diplomawise_courses`
  ADD CONSTRAINT `diplomawise_courses_courseid_foreign` FOREIGN KEY (`courseID`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diplomawise_courses_diplomaid_foreign` FOREIGN KEY (`diplomaID`) REFERENCES `diplomas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diplomawise_courses_semesterid_foreign` FOREIGN KEY (`semesterID`) REFERENCES `semesters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `examination_criteria`
--
ALTER TABLE `examination_criteria`
  ADD CONSTRAINT `examination_criteria_diplomawisecourseid_foreign` FOREIGN KEY (`DiplomawiseCourseID`) REFERENCES `diplomawise_courses` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `examination_criteria_sessionid_foreign` FOREIGN KEY (`sessionID`) REFERENCES `mysessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_diplomaid_foreign` FOREIGN KEY (`diplomaID`) REFERENCES `diplomas` (`id`),
  ADD CONSTRAINT `results_examinationcriteriaid_foreign` FOREIGN KEY (`ExaminationCriteriaID`) REFERENCES `examination_criteria` (`ID`),
  ADD CONSTRAINT `results_sessionid_foreign` FOREIGN KEY (`sessionID`) REFERENCES `mysessions` (`id`),
  ADD CONSTRAINT `results_studentid_foreign` FOREIGN KEY (`StudentID`) REFERENCES `students` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_instituteid_foreign` FOREIGN KEY (`instituteId`) REFERENCES `institutes` (`id`);

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_diplomawisecourseid_foreign` FOREIGN KEY (`DiplomawiseCourseID`) REFERENCES `diplomawise_courses` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_courses_studentdiplomaid_foreign` FOREIGN KEY (`StudentDiplomaID`) REFERENCES `student_diplomas` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `student_diplomas`
--
ALTER TABLE `student_diplomas`
  ADD CONSTRAINT `student_diplomas_diploma_id_foreign` FOREIGN KEY (`diploma_id`) REFERENCES `diplomas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_diplomas_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_diplomas_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
