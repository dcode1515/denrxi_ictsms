-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for denrxi_ictsms_db
CREATE DATABASE IF NOT EXISTS `u157160704_ictsms_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `u157160704_ictsms_db`;

-- Dumping structure for table denrxi_ictsms_db.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table denrxi_ictsms_db.head_office_tbl
CREATE TABLE IF NOT EXISTS `head_office_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `head_of_office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.head_office_tbl: ~18 rows (approximately)
REPLACE INTO `head_office_tbl` (`id`, `head_of_office`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Regional Office', 'active', '2026-01-20 22:10:44', '2026-01-21 17:12:50', NULL),
	(2, 'PENRO Davao Occidental', 'active', '2026-01-20 22:12:20', '2026-01-20 22:12:20', NULL),
	(3, 'PENRO Davao del Sur', 'active', '2026-01-20 22:12:26', '2026-01-20 22:12:26', NULL),
	(4, 'PENRO Davao de Oro', 'active', '2026-01-20 22:12:31', '2026-01-20 22:12:31', NULL),
	(5, 'PENRO Davao del Norte', 'active', '2026-01-20 22:12:36', '2026-01-20 22:12:36', NULL),
	(6, 'PENRO Davao Oriental', 'active', '2026-01-20 22:12:40', '2026-01-20 22:12:40', NULL),
	(7, 'CENRO Malalag', 'active', '2026-01-20 22:12:48', '2026-01-20 22:12:48', NULL),
	(8, 'CENRO Digos', 'active', '2026-01-20 22:12:52', '2026-01-20 22:12:52', NULL),
	(9, 'CENRO Davao', 'active', '2026-01-20 22:12:56', '2026-01-20 22:12:56', NULL),
	(10, 'CENRO Panabo', 'active', '2026-01-20 22:13:00', '2026-01-20 22:24:15', NULL),
	(11, 'CENRO New Corella', 'active', '2026-01-20 22:13:04', '2026-01-20 22:13:04', NULL),
	(12, 'CENRO Maco', 'active', '2026-01-20 22:13:08', '2026-01-20 22:13:08', NULL),
	(13, 'CENRO Monkayo', 'active', '2026-01-20 22:13:12', '2026-01-20 22:13:12', NULL),
	(14, 'CENRO Lupon', 'active', '2026-01-20 22:13:16', '2026-01-20 22:13:16', NULL),
	(15, 'CENRO Mati', 'active', '2026-01-20 22:13:20', '2026-01-20 22:13:20', NULL),
	(16, 'CENRO Manay', 'active', '2026-01-20 22:13:25', '2026-01-20 22:13:25', NULL),
	(17, 'CENRO Baganga', 'active', '2026-01-20 22:13:28', '2026-01-20 22:13:28', NULL),
	(18, 'dasdsa', 'active', '2026-01-20 22:42:17', '2026-01-20 22:42:17', '2026-01-20 22:42:17');

-- Dumping structure for table denrxi_ictsms_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.migrations: ~31 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_01_19_080307_add_role_to_users_table', 2),
	(7, '2026_01_19_080729_add_status_to_users_table', 3),
	(8, '2026_01_19_081019_change_default_status_in_users_table', 4),
	(9, '2026_01_19_081727_add_some_colums_to_users_table', 5),
	(10, '2026_01_20_071531_create_head_office_tbl_table', 6),
	(11, '2026_01_21_070751_add_deleted_at_to_head_of_office_table', 7),
	(12, '2026_01_21_081303_create_office_tbl', 8),
	(13, '2026_01_22_013042_create_ticket_type_tbl_table', 9),
	(14, '2026_01_22_074638_add_fields_to_users_table', 10),
	(15, '2026_01_22_083331_add_approval_status_to_users_table', 11),
	(16, '2026_01_26_005853_add_name_columns_to_users_table', 12),
	(17, '2026_01_26_005945_drop_name_column_from_users_table', 13),
	(18, '2026_01_26_033447_create_module_assign_table', 14),
	(19, '2026_01_26_045400_add_module_assign_to_users_table', 15),
	(20, '2026_01_26_062112_change_module_assign_column_in_users_table', 16),
	(21, '2026_01_27_003836_create_ticket_category_tbl_table', 17),
	(22, '2026_01_27_025457_add_photo_to_users_table', 18),
	(23, '2026_01_28_010443_create_ticket_tbl_table', 19),
	(24, '2026_01_28_010827_add_helpdesk_no_to_ticket_tbl', 20),
	(25, '2026_01_28_015441_add_agree_terms_to_ticket_tbl', 21),
	(26, '2026_01_28_050037_add_token_to_ticket_tbl', 22),
	(27, '2026_01_28_050414_add_token_to_ticket_tbl', 23),
	(28, '2026_01_29_013504_add_receive_columns_to_ticket_tbl', 24),
	(29, '2026_01_29_052545_add_date_acted_and_resolution_to_ticket_tbl', 25),
	(30, '2026_02_02_085538_add_feedback_columns_to_ticket_tbl', 26),
	(31, '2026_02_02_085955_create_rate_tbl', 27),
	(32, '2026_02_02_141949_modify_rate_column_in_rate_tbl_table', 28);

-- Dumping structure for table denrxi_ictsms_db.module_assign
CREATE TABLE IF NOT EXISTS `module_assign` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_assign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_assign_module_assign_index` (`module_assign`),
  KEY `module_assign_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.module_assign: ~1 rows (approximately)
REPLACE INTO `module_assign` (`id`, `module_assign`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Helpdesk', '2026-01-26 03:35:37', '2026-01-21 00:44:24', NULL);

-- Dumping structure for table denrxi_ictsms_db.office_tbl
CREATE TABLE IF NOT EXISTS `office_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `head_office_id` bigint unsigned DEFAULT NULL,
  `office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.office_tbl: ~12 rows (approximately)
REPLACE INTO `office_tbl` (`id`, `head_office_id`, `office`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'Regulating and Permitting Section', 'active', '2026-01-21 00:23:20', '2026-01-21 17:15:28', NULL),
	(2, 1, 'Planning and Management Division', 'active', '2026-01-21 00:31:25', '2026-01-21 00:31:25', NULL),
	(3, 1, 'Administrative Division', 'active', '2026-01-21 00:31:41', '2026-01-21 00:31:41', NULL),
	(4, 1, 'Finance Division', 'active', '2026-01-21 00:40:47', '2026-01-21 00:40:47', NULL),
	(5, 1, 'Legal Division', 'active', '2026-01-21 00:41:32', '2026-01-21 00:41:32', NULL),
	(6, 1, 'Licenses Patents and Deeds Division', 'active', '2026-01-21 00:42:27', '2026-01-21 00:42:27', NULL),
	(7, 1, 'Conservation and Development Division', 'active', '2026-01-21 00:42:41', '2026-01-21 00:42:41', NULL),
	(8, 1, 'Survey and Mapping Division', 'active', '2026-01-21 00:42:56', '2026-01-21 00:42:56', NULL),
	(9, 1, 'Enforcement Division', 'active', '2026-01-21 00:43:12', '2026-01-21 00:43:12', NULL),
	(10, 1, 'Office of the Regional Executive Division', 'active', '2026-01-21 00:43:33', '2026-01-21 00:43:33', NULL),
	(11, 1, 'ARD - Management Division', 'active', '2026-01-21 00:44:09', '2026-01-21 00:44:09', NULL),
	(12, 1, 'ARD - Technical Division', 'active', '2026-01-21 00:44:24', '2026-01-21 00:44:24', NULL);

-- Dumping structure for table denrxi_ictsms_db.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.password_resets: ~0 rows (approximately)

-- Dumping structure for table denrxi_ictsms_db.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table denrxi_ictsms_db.rate_tbl
CREATE TABLE IF NOT EXISTS `rate_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint unsigned NOT NULL COMMENT 'Reference to ticket_tbl',
  `rate` enum('E','VS','S','BS') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'User rating: E-Excellent, VS-Very Satisfactory, S-Satisfactory, BS-Below Satisfactory',
  `feedback_remarks` longtext COLLATE utf8mb4_unicode_ci COMMENT 'User feedback remarks',
  `date_feedback` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date and time feedback was submitted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.rate_tbl: ~0 rows (approximately)

-- Dumping structure for table denrxi_ictsms_db.ticket_category_tbl
CREATE TABLE IF NOT EXISTS `ticket_category_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_type_id` bigint unsigned NOT NULL,
  `ticket_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_category_tbl_ticket_type_id_foreign` (`ticket_type_id`),
  CONSTRAINT `ticket_category_tbl_ticket_type_id_foreign` FOREIGN KEY (`ticket_type_id`) REFERENCES `ticket_type_tbl` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.ticket_category_tbl: ~29 rows (approximately)

-- Dumping structure for table denrxi_ictsms_db.ticket_tbl
CREATE TABLE IF NOT EXISTS `ticket_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `receive_technician_id` bigint unsigned DEFAULT NULL,
  `date_receive` datetime DEFAULT NULL,
  `ticket_type_id` bigint unsigned NOT NULL,
  `ticket_category_id` bigint unsigned NOT NULL,
  `helpdesk_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_acted` timestamp NULL DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_initial` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `head_office_id` bigint unsigned DEFAULT NULL,
  `office_id` bigint unsigned DEFAULT NULL,
  `issue_concern` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agree_terms` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_tbl_token_unique` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.ticket_tbl: ~8 rows (approximately)

-- Dumping structure for table denrxi_ictsms_db.ticket_type_tbl
CREATE TABLE IF NOT EXISTS `ticket_type_tbl` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ticket_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.ticket_type_tbl: ~2 rows (approximately)
REPLACE INTO `ticket_type_tbl` (`id`, `ticket_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Software', 'active', '2026-01-26 16:34:26', '2026-01-26 16:34:26', NULL),
	(2, 'Hardware', 'active', '2026-01-26 16:34:31', '2026-01-26 16:34:31', NULL),
	(3, 'Information System', 'active', '2026-01-26 16:34:36', '2026-01-26 16:34:36', NULL);

-- Dumping structure for table denrxi_ictsms_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_initial` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `head_office_id` bigint unsigned DEFAULT NULL,
  `office_id` bigint unsigned DEFAULT NULL,
  `agree_and_terms_condition` tinyint(1) NOT NULL DEFAULT '0',
  `information_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `approval_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_assign` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_email_status_index` (`email`,`status`),
  KEY `users_role_status_index` (`role`,`status`),
  KEY `users_head_office_id_foreign` (`head_office_id`),
  KEY `users_office_id_foreign` (`office_id`),
  CONSTRAINT `users_head_office_id_foreign` FOREIGN KEY (`head_office_id`) REFERENCES `head_office_tbl` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `office_tbl` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table denrxi_ictsms_db.users: ~10 rows (approximately)
REPLACE INTO `users` (`id`, `firstname`, `middle_initial`, `lastname`, `extension`, `email`, `photo`, `contact_number`, `position`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `head_office_id`, `office_id`, `agree_and_terms_condition`, `information_confirmed`, `approval_status`, `module_assign`) VALUES
	(1, 'danrick', 'c', 'tekiko', NULL, 'admin@gmail.com', NULL, '', NULL, 'admin', 'Active', NULL, '$2y$10$2RB55qPWSBqmm2XlCfrN7uTrRCARx4Px3Z9z6hhkBjs.2lX.g40Xe', NULL, NULL, NULL, NULL, NULL, 1, 1, 'Approved', NULL),
	(2, 'Danrick', 'S', 'Tekiko', 'N/A', 'dcode0516@gmail.com', '2026-DANRICK_C_TEKIKO-09199533529.jpg', '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$2RB55qPWSBqmm2XlCfrN7uTrRCARx4Px3Z9z6hhkBjs.2lX.g40Xe', NULL, '2026-01-25 17:57:16', '2026-01-26 22:37:14', 1, 2, 1, 1, 'Approved', 1),
	(3, 'Bryan', 'E', 'Loreto', 'N/A', 'bryan.e.loretoweqewq@gmail.com', NULL, '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 17:58:10', '2026-01-25 22:28:04', 1, 2, 1, 1, 'Approved', 1),
	(26, 'Peachy', 'P', 'Enano', 'N/A', 'ppenano@gmail.com', NULL, '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 18:01:32', '2026-01-25 22:41:17', 1, 2, 1, 1, 'Approved', 1),
	(27, 'Albert', 'M', 'Bandiola', 'N/A', 'adbandiola@gmail.com', NULL, '09199533529', 'Information System Analyst I', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 18:03:49', '2026-01-25 23:50:05', 1, 2, 1, 1, 'Approved', 1),
	(28, 'Danrick', 'C', 'Tekiko', 'N/A', 'dantekiko15@gmail.com', NULL, '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 18:08:14', '2026-01-25 18:08:14', 1, 2, 1, 1, 'Pending', NULL),
	(29, 'test', 'C', 'tes', 'N/A', 'dsadasdsZ@gmail.com', NULL, '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 18:12:13', '2026-01-25 18:12:13', 1, 2, 1, 1, 'Pending', NULL),
	(30, 'TEST', 'C', 'TEST', 'N/A', 'dcode051dasdsa6@gmail.com', NULL, '09199533529', 'cOMPUTER pROGRAMEMR II', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 18:14:06', '2026-01-25 18:14:06', 1, 2, 1, 1, 'Pending', NULL),
	(31, 'sample', 'C', 'sample', 'N/A', 'dcode0516dasdas@gmail.com', NULL, '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$Ule5WodU588R9x74pFMEOuHyotYdKrAVV214fY1WEH.sfQlXfdw16', NULL, '2026-01-25 18:19:51', '2026-01-25 18:19:51', 1, 2, 1, 1, 'Pending', NULL),
	(32, 'Danrick', 'C', 'tEKIKO', 'N/A', 'dasdas@gmail.com', '2026-DANRICK_C_TEKIKO-09199533529.png', '09199533529', 'Computer Programmer II', 'user', 'Active', NULL, '$2y$10$ZC.ng9EDTDLlydfyHHAmaOPTouU/b3Oy5odlaDupU0p8.w32nqFta', NULL, '2026-01-27 23:54:50', '2026-01-27 23:57:56', 1, 2, 1, 1, 'Approved', 1),
	(33, 'Bryan', 'E', 'Loreto', 'N/A', 'bryan.e.loreto@gmail.com', '2026-BRYAN_E_LORETO-09199533529.png', '09199533529', 'Assistant Statistician', 'user', 'Active', NULL, '$2y$10$dKCkdui2evYMLkJDx0lIl.mqVQel.kUvqzaftGT9v720k1Fw2unRe', NULL, '2026-02-03 00:27:13', '2026-02-03 00:28:32', 1, 2, 1, 1, 'Approved', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
