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

-- Dumping structure for table si-app.plps
CREATE TABLE IF NOT EXISTS `plps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `plp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` enum('TAHFIDZ','IT','BAHASA','KARAKTER') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plps_plp_unit_unique` (`plp`,`unit`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si-app.plps: ~11 rows (approximately)
INSERT INTO `plps` (`id`, `plp`, `unit`) VALUES
	(11, 'ODT', 'IT'),
	(1, 'PLP 0', 'TAHFIDZ'),
	(2, 'PLP 1', 'TAHFIDZ'),
	(3, 'PLP 2', 'TAHFIDZ'),
	(4, 'PLP 3', 'TAHFIDZ'),
	(5, 'PLP 4', 'TAHFIDZ'),
	(6, 'PLP 5', 'TAHFIDZ'),
	(9, 'Reguler Comic', 'IT'),
	(8, 'Reguler DKV', 'IT'),
	(7, 'Reguler Programming', 'IT'),
	(10, 'Reguler Videografi', 'IT');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
