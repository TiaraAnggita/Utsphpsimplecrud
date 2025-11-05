-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_simplecrud
CREATE DATABASE IF NOT EXISTS `db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_simplecrud`;

-- Dumping structure for table db_simplecrud.tb_pegawai
CREATE TABLE IF NOT EXISTS `tb_pegawai` (
  `id_pgw` int(11) NOT NULL AUTO_INCREMENT,
  `nik_pgw` char(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_pgw` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `jabatan_pgw` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `departemen` mediumint(3) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status_pgw` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_mhs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_pegawai: ~0 rows (approximately)

-- Dumping structure for table db_simplecrud.tb_jabatan
CREATE TABLE IF NOT EXISTS `tb_jabatan` (
  `kode_jabatan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jabatan` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_jabatan: ~9 rows (approximately)
INSERT INTO `tb_jabatan` (`kode_jabatan`, `nama_jabatan`) VALUES
	('DU', 'Direktur Utama'),
	('MK', 'Manajer Keuangan'),
	('MO', 'Manajer Operasional'),
	('SP', 'Supervisor Pemasaran'),
	('ADS', 'Analisis Data Senior'),
	('SA', 'Staff Administrasi'),
	('SAK', 'Staff Akuntansi'),
	('TI', 'Teknisi IT'),
	('PL', 'Petugas Lapangan');

-- Dumping structure for table db_simplecrud.tb_departemen
CREATE TABLE IF NOT EXISTS `tb_departemen` (
  `id_departemen` smallint(3) NOT NULL AUTO_INCREMENT,
  `nama_departemen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_departemen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_departemen: ~6 rows (approximately)
INSERT INTO `tb_departemen` (`id_departemen`, `nama_departemen`) VALUES
	(1, 'Keuangan'),
	(2, 'Sumber Daya Manusia(HRD)'),
	(3, 'Teknologi Informasi'),
	(4, 'Pemasaran dan Penjualan'),
	(5, 'Operasional dan Logistik'),
	(6, 'Administrasi Umum');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
