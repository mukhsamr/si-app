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

-- Dumping structure for table si-sbt.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int unsigned NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si-sbt.users: ~40 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'purwanto.abdul.ghaffar', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 3, NULL, NULL, NULL),
	(2, 'muhammad.irfan.ayyubi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 2, NULL, NULL, NULL),
	(3, 'al.husain.izzah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(4, 'ismail.efendi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 2, NULL, NULL, NULL),
	(5, 'lalu.faozan.hadi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(6, 'feri.firmansyah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(7, 'suhermawan', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(8, 'suhendra.eko.c', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(9, 'm.asshalih.alfadzah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(10, 'yusup.budiman', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(11, 'ade.erdin', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(12, 'muhammad.rofiq', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(13, 'barrur.rhozi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(14, 'm.ahsanu.taqwim', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(15, 'muhammad.mucklisin', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(16, 'muhammad.adi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 2, NULL, NULL, NULL),
	(17, 'doni.setiawan', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(18, 'syayyid.quthub.syaifullah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(19, 'muh.khairun.arafah.mardin', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(20, 'yaumi.kusuma.dewi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(21, 'nuraini', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(22, 'durrotur.rosidah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(23, 'alfi.hidayati.hikmah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(24, 'fariza.salima.elvina', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(25, 'siti.suharni', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(26, 'amalina.zuhrotul.ula', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(27, 'sarah.sayyidah.rahmah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(28, 'fika.nafisat', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(29, 'maswarni.tuti.ulya', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(30, 'suryani.adinda.putri', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(31, 'mukhlis.amrullah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(32, 'dzakiy.ihsan.syakur', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(33, 'muhammad.fauzan.a', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(34, 'alfiah.aulia', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(35, 'astuti.gultom', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(36, 'auliya.mujaddidsyah.mas\'ud', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(37, 'refianto.damai.darmawan', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(38, 'siti.syarifah', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(39, 'muhammad.alwi', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL),
	(40, 'farhan.irfan.hakim', '$2y$10$dchMMMe4arMt3WDAlCmGqewSZY2l/uJdni8NNz7xyH7XbQlleHgoW', 1, NULL, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
