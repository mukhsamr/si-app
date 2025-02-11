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

-- Dumping structure for table si-sbt.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si-sbt.profiles: ~40 rows (approximately)
INSERT INTO `profiles` (`id`, `user_id`, `name`, `nickname`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Purwanto Abdul Ghaffar ', 'Ust. Purwanto ', NULL, NULL),
	(2, 2, 'Muhammad Irfan Ayyubi', 'Ust. Irfan', NULL, NULL),
	(3, 3, 'Al Husain Izzah', 'Ust. Husain', NULL, NULL),
	(4, 4, 'Ismail Efendi', 'Ust. Ismail', NULL, NULL),
	(5, 5, 'Lalu Faozan Hadi', 'Ust. Faozan Hadi', NULL, NULL),
	(6, 6, 'Feri Firmansyah', 'Ust. Feri', NULL, NULL),
	(7, 7, 'Suhermawan', 'Ust. Suhermawan', NULL, NULL),
	(8, 8, 'Suhendra Eko C', 'Ust. Suhendra', NULL, NULL),
	(9, 9, 'M. Asshalih Alfadzah', 'Ust. Muhammad Asshalih', NULL, NULL),
	(10, 10, 'Yusup Budiman', 'Ust. Yusup', NULL, NULL),
	(11, 11, 'Ade Erdin', 'Ust. Erdin', NULL, NULL),
	(12, 12, 'Muhammad Rofiq', 'Ust. Rofiq', NULL, NULL),
	(13, 13, 'Barrur Rhozi', 'Ust. Rhozi', NULL, NULL),
	(14, 14, 'M.Ahsanu Taqwim', 'Ust. Ahsan', NULL, NULL),
	(15, 15, 'Muhammad Mucklisin', 'Ust. Mucklis', NULL, NULL),
	(16, 16, 'Muhammad Adi', 'Ust. Adi', NULL, NULL),
	(17, 17, 'Doni Setiawan', 'Ust. Wawan', NULL, NULL),
	(18, 18, 'Syayyid Quthub Syaifullah ', 'Ust. Syayyid', NULL, NULL),
	(19, 19, 'Muh Khairun Arafah Mardin ', 'Ust. Arafah', NULL, NULL),
	(20, 20, 'Yaumi Kusuma Dewi ', 'Usth. Yaumi ', NULL, NULL),
	(21, 21, 'Nuraini', 'Usth. Nuraini', NULL, NULL),
	(22, 22, 'Durrotur Rosidah', 'Usth. Durrotur Rosidah', NULL, NULL),
	(23, 23, 'Alfi Hidayati Hikmah', 'Usth. Alfi', NULL, NULL),
	(24, 24, 'Fariza Salima Elvina', 'Usth. Fariza', NULL, NULL),
	(25, 25, 'Siti Suharni', 'Usth. Siti Suharni', NULL, NULL),
	(26, 26, 'Amalina Zuhrotul Ula ', 'Usth. Amalina', NULL, NULL),
	(27, 27, 'Sarah Sayyidah Rahmah', 'Usth. Rahmah', NULL, NULL),
	(28, 28, 'Fika Nafisat', 'Usth. Fika', NULL, NULL),
	(29, 29, 'Maswarni Tuti Ulya ', 'Usth. Maswarni Tuti Ulya ', NULL, NULL),
	(30, 30, 'Suryani Adinda Putri ', 'Usth. Dinda', NULL, NULL),
	(31, 31, 'Mukhlis Amrullah ', 'Ust. Amrullah ', NULL, NULL),
	(32, 32, 'Dzakiy Ihsan Syakur ', 'Ust. Dzakiy', NULL, NULL),
	(33, 33, 'Muhammad Fauzan A', 'Ust. Ghani', NULL, NULL),
	(34, 34, 'Alfiah Aulia ', 'Usth. Alfiah', NULL, NULL),
	(35, 35, 'Astuti Gultom ', 'Usth. Gultom ', NULL, NULL),
	(36, 36, 'Auliya Mujaddidsyah Mas\'ud', 'Ust. Auliya', NULL, NULL),
	(37, 37, 'Refianto Damai Darmawan', 'Ust. Damai', NULL, NULL),
	(38, 38, 'Siti Syarifah', 'Usth. Siti Syarifah', NULL, NULL),
	(39, 39, 'Muhammad Alwi', 'Ust. Alwi', NULL, NULL),
	(40, 40, 'Farhan Irfan Hakim', 'Ust. Farhan', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
