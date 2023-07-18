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


-- Dumping database structure for eclectic
CREATE DATABASE IF NOT EXISTS `eclectic` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `eclectic`;

-- Dumping structure for table eclectic.accounting
CREATE TABLE IF NOT EXISTS `accounting` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.accounting: ~1 rows (approximately)
DELETE FROM `accounting`;
INSERT INTO `accounting` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'Naumi. T. R', NULL, NULL);

-- Dumping structure for table eclectic.admin_cash_advance
CREATE TABLE IF NOT EXISTS `admin_cash_advance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_diajukan` date DEFAULT NULL,
  `tgl_diajukan2` date DEFAULT NULL,
  `judul_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` decimal(20,5) DEFAULT NULL,
  `pemohon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accounting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kasir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menyetujui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_approved` enum('rejected','pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rejected',
  `status_paid` enum('rejected','pending','paid') COLLATE utf8mb4_unicode_ci DEFAULT 'rejected',
  `tgl_approval` date DEFAULT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_cash_advance: ~27 rows (approximately)
DELETE FROM `admin_cash_advance`;
INSERT INTO `admin_cash_advance` (`id`, `no_doku`, `tgl_diajukan`, `tgl_diajukan2`, `judul_doku`, `curr`, `nominal`, `pemohon`, `accounting`, `kasir`, `menyetujui`, `no_telp`, `status_approved`, `status_paid`, `tgl_approval`, `alasan`, `created_at`, `updated_at`) VALUES
	(1, '23/VI/CA/00001', '2023-06-02', NULL, 'DL Telkom w/ Aris Ulama, NTT IT, ASG, GKM', 'IDR', 1000000.00000, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', '2023-06-05', NULL, NULL, NULL),
	(2, '23/VI/CA/00002', '2023-06-05', NULL, 'Tagihan Skyloft Soho 1678 Juni 2023', 'IDR', 1567954.00000, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-05', NULL, NULL, NULL),
	(3, '23/VI/CA/00003', '2023-06-05', NULL, 'Keperluan Kantor', 'IDR', 500000.00000, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-26', NULL, NULL, NULL),
	(4, '23/VI/CA/00004', '2023-06-05', NULL, 'Pembayaran Jaminan Pelakasanaan Pekerjaan Renewal SAP Support di PT Pindad', 'IDR', 146217.00000, 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, NULL),
	(5, '23/VI/CA/00005', '2023-06-10', NULL, 'Sewa 6 kamar project IJS & transportasi bulan Juni + Juli 2023', 'IDR', 15000000.00000, 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'approved', 'paid', '2023-06-08', NULL, NULL, NULL),
	(6, '23/VI/CA/00006', '2023-06-12', NULL, 'Operasional Driver', 'IDR', 700000.00000, 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-08', NULL, NULL, NULL),
	(7, '23/VI/CA/00007', '2023-06-12', NULL, 'GDE (GeoDipaEnergy), Migration Data & Go Live (Site), Koordination & Assesment new Project (Activate QM-PM Module)', 'IDR', 12500000.00000, 'Sujiono', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', '2023-06-08', NULL, NULL, NULL),
	(8, '23/VI/CA/00008', '2023-06-09', NULL, 'Cleaning Service', 'IDR', 100000.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, NULL),
	(9, '23/VI/CA/00009', '2023-06-16', NULL, 'Keperluan Kantor', 'IDR', 1000000.00000, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-26', NULL, NULL, NULL),
	(10, '23/VI/CA/00010', '2023-06-16', NULL, 'Cleaning Service', 'IDR', 100000.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-26', NULL, NULL, NULL),
	(11, '23/VI/CA/00011', '2023-06-23', NULL, 'PKB Kendaraan Toyota Vellfire L 0701 A', 'IDR', 8748500.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, NULL),
	(12, '23/VI/CA/00012', '2023-06-28', NULL, 'Operasional Driver', 'IDR', 700000.00000, 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-28', NULL, NULL, NULL),
	(13, '23/VI/CA/00013', '2023-06-28', NULL, 'Cleaning Service', 'IDR', 100000.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-28', NULL, NULL, NULL),
	(14, '23/VI/CA/00014', '2023-06-30', NULL, 'Keperluan Project APP 2023/07', 'IDR', 8000000.00000, 'Meliza Fatmawati', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-30', NULL, NULL, NULL),
	(15, '23/VI/CA/00015', '2023-06-30', NULL, 'Keperluan Project APP Bulan Juli 2023', 'IDR', 18000000.00000, 'Anang Fauzi Kurniawan', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, NULL),
	(16, '23/VII/CA/00003', '2023-07-03', NULL, 'Isi Kas dan Beli Meterai', 'IDR', 1000000.00000, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', '2023-07-04', NULL, NULL, NULL),
	(17, '23/VII/CA/00004', '2023-07-03', NULL, 'Biaya kost 1 bulan Project PwC', 'IDR', 3000000.00000, 'Puteri Amira Syifani', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, NULL),
	(18, '23/VII/CA/00005', '2023-07-03', NULL, 'Deposit Kost Project PwC (Selama ditempati)', 'IDR', 500000.00000, 'Puteri Amira Syifani', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, NULL),
	(32, '23/VII/CA/00001', '2023-07-12', NULL, 'Tagihan Skyloft Soho 1678 Juli 2023', 'IDR', 10741675.00000, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'pending', 'pending', NULL, NULL, NULL, NULL),
	(33, '23/VII/CA/00002', '2023-07-03', NULL, 'Sewa Kost Dokumen & Iuran Bulan Juli 2023', 'IDR', 361000.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', '2023-07-04', NULL, NULL, NULL),
	(34, '23/VII/CA/00006', '2023-07-05', NULL, 'AMS GDE (PT. Geo Dipa Energy)', 'IDR', 12500000.00000, 'Sujiono', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'pending', '2023-07-05', NULL, NULL, NULL),
	(35, '23/VII/CA/00007', '2023-07-07', NULL, 'Cleaning Service', 'IDR', 100000.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', '2023-07-07', NULL, NULL, NULL),
	(36, '23/VII/CA/00008', '2023-07-07', NULL, 'Pembayaran Polis PT. Asuransi Kredit Indoensia', 'IDR', 110790.44000, 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', '+62 881-3236-918', 'approved', 'pending', '2023-07-07', NULL, NULL, NULL),
	(37, '23/VII/CA/00009', '2023-07-10', NULL, 'Operasional Driver', 'IDR', 700000.00000, 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', '2023-07-10', NULL, NULL, NULL),
	(38, '23/VII/CA/00010', '2023-07-10', NULL, 'DL Fujitsu & XL 11/07/23 - 14/07/23', 'IDR', 1500000.00000, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, NULL),
	(39, '23/VII/CA/00011', '2023-07-12', NULL, 'Sewa 8 kamar project IJS bulan Juli+Agustus 2023 & Transportasi bulan Juli 2023', 'IDR', 15000000.00000, 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, NULL),
	(40, '23/VII/CA/00012', '2023-07-14', NULL, 'Cleaning Service 3 jam', 'IDR', 100000.00000, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'pending', 'pending', NULL, NULL, NULL, NULL);

-- Dumping structure for table eclectic.admin_cash_advance_report
CREATE TABLE IF NOT EXISTS `admin_cash_advance_report` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_diajukan` date DEFAULT NULL,
  `judul_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipe_ca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_ca` decimal(18,2) DEFAULT NULL,
  `pemohon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accounting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kasir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menyetujui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_approved` enum('rejected','pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rejected',
  `status_paid` enum('rejected','pending','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rejected',
  `tgl_persetujuan` date DEFAULT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_referensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_cash_advance_report: ~30 rows (approximately)
DELETE FROM `admin_cash_advance_report`;
INSERT INTO `admin_cash_advance_report` (`id`, `no_doku`, `tgl_diajukan`, `judul_doku`, `tipe_ca`, `nominal_ca`, `pemohon`, `accounting`, `kasir`, `menyetujui`, `no_telp`, `status_approved`, `status_paid`, `tgl_persetujuan`, `alasan`, `no_referensi`, `created_at`, `updated_at`) VALUES
	(1, '23/CAR/06/00001', '2023-06-10', 'Tagihan Skyloft Soho 1678 Juni 2023', '23/VI/CA/00002', 1567954.00, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-12', NULL, NULL, '2023-06-08 20:10:12', '2023-06-08 20:10:12'),
	(2, '23/CAR/06/00002', '2023-06-10', 'Sewa Kost Dokumen & Akomodasi SIDO, DL SAP', '23/V/CA/00015', 5000000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-12', NULL, NULL, '2023-06-08 20:20:35', '2023-06-08 20:20:35'),
	(3, '23/CAR/06/00003', '2023-06-05', 'Keperluan Kantor', '23/VI/CA/00003', 500000.00, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-03', NULL, NULL, '2023-06-08 20:27:58', '2023-06-08 20:27:58'),
	(4, '23/CAR/06/00004', '2023-06-05', 'DL Presales ASG, MTT, Lira Medika (02/05-05/05)', '23/IV/CA/00015', 2000000.00, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-12 09:20:58', '2023-06-12 09:21:01'),
	(5, '23/CAR/06/00005', '2023-06-05', 'DL Agung Sedayu, GKM, APP, Samara (15/05 - 22/03)', '23/V/CA/00012', 1500000.00, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(6, '23/CAR/06/00006', '2023-06-05', 'DL ASG, Nobel (23/05)', '23/V/CA/00017', 1500000.00, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(7, '23/CAR/06/00007', '2023-06-06', 'IJS GRESIK', '23/V/CA/00007', 12000000.00, 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'approved', 'paid', '2023-06-28', NULL, NULL, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(8, '23/CAR/06/00008', '2023-06-06', 'Apartment CH/17/10 Lira', '22/X/CA/00021', 12000000.00, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-12 21:02:58', '2023-06-12 21:02:58'),
	(9, '23/CAR/06/00009', '2023-06-12', 'Operasional Driver', '23/V/CA/00018', 700000.00, 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-12 21:08:46', '2023-06-12 21:08:46'),
	(10, '23/CAR/06/00010', '2023-06-09', 'Cleaning Service', '23/VI/CA/00008', 100000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-13 21:27:13', '2023-06-13 21:27:13'),
	(11, '23/CAR/06/00011', '2023-06-16', 'Keperluan Kantor', '23/VI/CA/00009', 1000000.00, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-15 23:07:58', '2023-06-15 23:07:58'),
	(12, '23/CAR/06/00012', '2023-06-16', 'Cleaning Service 3 jam', '23/VI/CA/00010', 100000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-26', NULL, NULL, '2023-06-15 23:18:53', '2023-06-15 23:18:53'),
	(13, '23/CAR/06/00013', '2023-06-20', 'Pembayaran Jaminan Pelakasanaan Pekerjaan Renewal SAP Support di PT Pindad', '23/VI/CA/00004', 146217.00, 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-19 23:22:34', '2023-06-19 23:22:34'),
	(14, '23/CAR/06/00014', '2023-06-23', 'PROJECT GDE ( 01.06.2023 - 30.06.2023 )', '23/VI/CA/00007', 12500000.00, 'Sujiono', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(15, '23/CAR/06/00015', '2023-06-26', 'PKB Kendaraan Toyota Vellfire L 0701 A	Tahun 2023', '23/VI/CA/00011', 8748500.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', '2023-06-28', NULL, NULL, '2023-06-25 23:05:36', '2023-06-25 23:05:36'),
	(16, '23/CAR/06/00016', '2023-06-28', 'Kep. LIRA', '23/V/CA/00008', 24000000.00, 'Stefanus Daniel', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-27 20:23:40', '2023-06-27 20:23:40'),
	(17, '23/CAR/06/00017', '2023-06-28', 'Operasional Driver', '23/VI/CA/00006', 700000.00, 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(18, '23/CAR/06/00018', '2023-06-28', 'APP Sinar Mas - Jakarta', '23/V/CA/00020', 18000000.00, 'Anang Fauzi Kurniawan', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-28 00:07:54', '2023-06-28 00:07:54'),
	(19, '23/CAR/06/00019', '2023-06-28', 'APP Sinar Mas - Jakarta', '23/V/CA/00019', 8000000.00, 'Meliza Fatmawati', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-28 00:10:56', '2023-06-28 00:10:56'),
	(20, '23/CAR/06/00020', '2023-06-28', 'Cleaning Service 3 jam', '23/VI/CA/00013', 100000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-28 01:29:02', '2023-06-28 01:29:02'),
	(21, '23/CAR/06/00021', '2023-06-28', 'Keperluan PwC', '22/XI/CA/00014', 3000000.00, 'Stefanus Daniel', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'paid', NULL, NULL, NULL, '2023-06-28 01:59:45', '2023-06-28 01:59:45'),
	(22, '23/CAR/07/00001', '2023-07-05', 'Keperluan Kantor', '23/VII/CA/00003', 1000000.00, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', '2023-07-05', NULL, NULL, '2023-07-04 20:57:09', '2023-07-04 20:57:09'),
	(23, '23/CAR/07/00002', '2023-07-05', 'Perjalanan Dinas Bulan Juni 2023', '23/VI/CA/00001', 1000000.00, 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, '2023-07-05 00:33:27', '2023-07-05 00:33:27'),
	(188, '23/CAR/07/00003', '2023-07-06', 'Sewa Kost Dokumen & Iuran Bulan Juli 2023', '23/VII/CA/00002', 361000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, '2023-07-06 01:59:17', '2023-07-06 01:59:17'),
	(189, '23/CAR/07/00004', '2023-07-07', 'Keperluan Kantor', '23/VII/CA/00007', 100000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, '2023-07-07 01:31:19', '2023-07-07 01:31:19'),
	(190, '23/CAR/07/00005', '2023-07-07', 'Pembayaran Polis PT. Asuransi Kredit Indoensia', '23/VII/CA/00008', 110790.44, 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', '+62 881-3236-918', 'approved', 'pending', NULL, NULL, NULL, '2023-07-07 02:16:41', '2023-07-07 02:16:41'),
	(191, '23/CAR/07/00006', '2023-07-11', 'IJS GRESIK Bulan Juni 2023', '23/VI/CA/00005', 15000000.00, 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '+62 881-3236-918', 'pending', 'pending', NULL, NULL, NULL, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(192, '23/CAR/07/00007', '2023-07-11', 'Operasional Driver', '23/VII/CA/00009', 700000.00, 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'pending', 'pending', NULL, NULL, NULL, '2023-07-10 22:37:27', '2023-07-10 22:37:27'),
	(194, '23/CAR/07/00008', '2023-07-12', 'Tagihan Skyloft Soho 1678 Juli 2023', '23/VII/CA/00001', 10741675.00, 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'pending', 'pending', NULL, NULL, NULL, '2023-07-11 23:23:53', '2023-07-11 23:23:53'),
	(195, '23/CAR/07/00009', '2023-07-14', 'Cleaning Service 3 jam', '23/VII/CA/00012', 100000.00, 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', '+62 881-3236-918', 'pending', 'pending', NULL, NULL, NULL, '2023-07-13 19:47:30', '2023-07-13 19:47:30');

-- Dumping structure for table eclectic.admin_cash_advance_report_detail
CREATE TABLE IF NOT EXISTS `admin_cash_advance_report_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_ca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` decimal(18,2) DEFAULT NULL,
  `tanggal_1` date DEFAULT NULL,
  `tanggal_2` date DEFAULT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_ca` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_cash_advance_report_detail_fk_ca_foreign` (`fk_ca`)
) ENGINE=InnoDB AUTO_INCREMENT=291 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_cash_advance_report_detail: ~196 rows (approximately)
DELETE FROM `admin_cash_advance_report_detail`;
INSERT INTO `admin_cash_advance_report_detail` (`id`, `deskripsi`, `bukti_ca`, `no_bukti`, `curr`, `nominal`, `tanggal_1`, `tanggal_2`, `keperluan`, `fk_ca`, `created_at`, `updated_at`) VALUES
	(1, 'Water PAM', NULL, 'UT23060750', 'IDR', 65500.00, '2023-04-20', '2023-05-20', NULL, 1, '2023-06-08 20:10:12', '2023-06-08 20:10:12'),
	(2, 'Air Mineral', NULL, 'SL23060192', 'IDR', 84000.00, '2023-04-20', '2023-05-20', NULL, 1, '2023-06-08 20:10:12', '2023-06-08 20:10:12'),
	(3, 'Token Listrik', NULL, NULL, 'IDR', 1500000.00, '2023-03-20', NULL, NULL, 1, '2023-06-08 20:10:12', '2023-06-08 20:10:12'),
	(4, 'Cleaning AC Cassete Upper, AC Cassete Lower, dan AC Split', NULL, 'MW23060095', 'IDR', 770000.00, NULL, NULL, NULL, 1, '2023-06-08 20:10:12', '2023-06-08 20:10:12'),
	(5, 'Refund PBB 2023', NULL, NULL, 'IDR', -851546.00, NULL, NULL, NULL, 1, '2023-06-08 20:10:12', '2023-06-08 20:10:12'),
	(6, 'Sewa Kost Dokumen & Iuran Bulan Juni 2023', NULL, '623', 'IDR', 361000.00, '2023-06-01', '2023-06-30', 'Eclectic', 2, '2023-06-08 20:20:35', '2023-06-08 20:20:35'),
	(7, 'Hotel Bergas Indah An Erwin', NULL, '444622378690907', 'IDR', 1257000.00, '2023-05-22', '2023-05-29', 'SIDO', 2, '2023-06-08 20:20:35', '2023-06-08 20:20:35'),
	(8, 'Hotel Bergas Indah An Erwin', NULL, '44462739063470', 'IDR', 720000.00, '2023-05-29', '2023-06-02', 'SIDO', 2, '2023-06-08 20:20:35', '2023-06-08 20:20:35'),
	(9, 'Meterai @10000 50 Pcs', NULL, '1', 'IDR', 500000.00, '2023-06-05', NULL, NULL, 3, '2023-06-08 20:27:58', '2023-06-08 20:27:58'),
	(10, 'Bluebird', NULL, 'AB270', 'IDR', 282060.00, '2023-05-02', NULL, 'Presales ASG', 4, '2023-06-13 04:22:02', '2023-06-13 04:22:13'),
	(11, 'ALL Fresh Apartment', NULL, 'SGST23050202111', 'IDR', 308086.00, '2023-05-02', NULL, 'Presales ASG', 4, '2023-06-13 04:22:04', '2023-06-13 04:22:14'),
	(12, 'Makan Siang ASG', NULL, '094557', 'IDR', 54560.00, '2023-05-02', NULL, 'Presales ASG', 4, '2023-06-13 04:22:04', '2023-06-13 04:22:15'),
	(13, 'ASG ke Samara', NULL, 'RB-163666', 'IDR\r\n', 108000.00, '2023-05-02', NULL, 'Presales ASG', 4, '2023-06-13 04:22:05', '2023-06-13 04:22:15'),
	(14, 'NTTDBS ke PIK', NULL, 'RB-153658', 'IDR', 166000.00, '2023-05-02', NULL, 'Presales ASG', 4, '2023-06-13 04:22:06', '2023-06-13 04:22:16'),
	(15, 'Levant untuk Apartement', NULL, '1ABNC9L', 'IDR', 95000.00, '2023-05-03', NULL, 'MTT', 4, '2023-06-13 04:22:06', '2023-06-13 04:22:17'),
	(16, 'Samakta ke MRT', NULL, 'RB-151343', 'IDR', 139000.00, '2023-05-03', NULL, 'MTT', 4, '2023-06-13 04:22:07', '2023-06-13 04:22:17'),
	(17, 'RSIA ke Samakta', NULL, 'RB-134901', 'IDR', 49000.00, '2023-05-03', NULL, 'MTT', 4, '2023-06-13 04:22:08', '2023-06-13 04:22:18'),
	(18, 'Levant ke RSIA', NULL, 'RB-185281', 'IDR', 103000.00, '2023-05-03', NULL, 'ASG', 4, '2023-06-13 04:22:09', '2023-06-13 04:22:19'),
	(19, 'MRT ke Levant', NULL, 'RB-196482', 'IDR', 15000.00, '2023-05-03', NULL, 'ASG', 4, '2023-06-13 04:22:20', '2023-06-13 04:22:19'),
	(20, 'Café Alfredo ke Benhill', NULL, 'A-4SQ85HTW', 'IDR', 29000.00, '2023-05-03', NULL, 'ASG', 4, '2023-06-13 04:22:21', '2023-06-13 04:22:20'),
	(21, 'MRT ke Samara', NULL, 'A-4SSBPGXWW', 'IDR', 22000.00, '2023-05-03', NULL, 'Samara', 4, '2023-06-13 04:22:22', '2023-06-13 04:22:29'),
	(22, 'MRT', NULL, 'MJ01723031000026', 'IDR', 50000.00, '2023-05-03', NULL, 'ASG', 4, '2023-06-13 04:22:22', '2023-06-13 04:22:29'),
	(23, 'Bluebird', NULL, 'KAR1917', 'IDR', 77080.00, '2023-05-04', NULL, 'Presales ASG', 4, '2023-06-13 04:22:23', '2023-06-13 04:22:30'),
	(24, 'Surcharge', NULL, '11115390', 'IDR', 10000.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:24', '2023-06-13 04:22:31'),
	(25, 'MRT', NULL, 'MJ01723031000026', 'IDR', 20000.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:24', '2023-06-13 04:22:32'),
	(26, 'RSIA ke MRT', NULL, 'RB-190438', 'IDR', 64000.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:25', '2023-06-13 04:22:32'),
	(27, 'MRT ke RSIA', NULL, 'RB-199482', 'IDR', 42000.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:26', '2023-06-13 04:22:33'),
	(28, 'Café Alfredo ke Benhill', NULL, 'A-4SUFQMDWW', 'IDR', 37500.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:27', '2023-06-13 04:22:34'),
	(29, 'Makan Siang di Halim', NULL, 'TR-230505-00009', 'IDR', 73427.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:27', '2023-06-13 04:22:34'),
	(30, 'Samara ke Halim', NULL, 'RB-160524', 'IDR', 44500.00, '2023-05-04', NULL, 'ASG', 4, '2023-06-13 04:22:28', '2023-06-13 04:22:35'),
	(31, 'ALL Fresh Apartment', NULL, 'SGST2305154155', 'IDR', 75990.00, '2023-05-15', NULL, 'Agung Sedayu', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(32, 'Makan Siang', NULL, '01CLERK01', 'IDR', 60000.00, '2023-05-15', NULL, 'Agung Sedayu', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(33, 'Meeting GKM', NULL, 'HAKA DIMSUM', 'IDR', 61000.00, '2023-05-15', NULL, 'GKM', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(34, 'ASTC ke Samara', NULL, 'RB-165961', 'IDR', 150500.00, '2023-05-15', NULL, 'GKM', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(35, 'Samakta ke ASTC', NULL, 'RB-176805', 'IDR', 48500.00, '2023-05-15', NULL, 'GKM', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(36, 'APP ke Samakta', NULL, 'RB-132924', 'IDR', 55500.00, '2023-05-15', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(37, 'Internet', NULL, '784421626373', 'IDR', 51500.00, '2023-05-15', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(38, 'Makan Pagi - Cibinong', NULL, '000055', 'IDR', 9500.00, '2023-05-16', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(39, 'Makan Siang di Halim', NULL, 'Kantin Dina', 'IDR', 95700.00, '2023-05-16', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(40, 'JLM ke Halim', NULL, 'RB-192742', 'IDR', 149500.00, '2023-05-16', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(41, 'Samara ke JLM', NULL, 'RB-107285', 'IDR', 164500.00, '2023-05-16', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(42, 'Makan Siang', NULL, '097430', 'IDR', 74360.00, '2023-05-22', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(43, 'ASG ke Samara', NULL, 'RB-145540', 'IDR', 144000.00, '2023-05-22', NULL, 'Samara', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(44, 'Soetta ke ASG', NULL, 'GRAB (60000)', 'IDR', 60000.00, '2023-05-22', NULL, 'ASG', 5, '2023-06-12 03:17:35', '2023-06-12 03:17:35'),
	(45, 'ALL Fresh Apartment', NULL, 'SGST23052304119', 'IDR', 110998.00, '2023-05-23', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(46, 'Lain-lain', NULL, '1', 'IDR', 274000.00, '2023-05-23', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(47, 'MRT', NULL, 'MJ01723031000026', 'IDR', 50000.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(48, 'Minum', NULL, '15369', 'IDR', 6500.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(49, 'RSIA ke MRT', NULL, 'RB-166670', 'IDR', 65000.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(50, 'MRT ke RSIA', NULL, 'RB-114222', 'IDR', 73500.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(51, 'MRT ke Samara', NULL, 'A-4VI5V3OG', 'IDR', 23000.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(52, 'Café Alfredo ke Benhill', NULL, 'A-4VGS7NOG', 'IDR', 29000.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(53, 'Makan Siang', NULL, 'TR-230525-00006', 'IDR', 184149.00, '2023-05-24', NULL, 'Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(54, 'Samara ke SAP Indo', NULL, 'RB-130944', 'IDR', 36000.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(55, 'Paxel kirim Doc ke APP', NULL, 'ENVUA2EM', 'IDR', 10500.00, '2023-05-24', NULL, 'ASG, Nobel', 6, '2023-06-12 15:37:02', '2023-06-12 15:37:02'),
	(56, 'Arbin & Hermes Sewa 1 kamar 212', NULL, '1', 'IDR', 2600000.00, '2023-06-01', '2023-06-30', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(57, 'Arbin & Hermes Sewa PLN kamar 212', NULL, '2', 'IDR', 403200.00, '2023-05-01', '2023-05-31', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(58, 'Mubin Sewa 1 kamar 305', NULL, '3', 'IDR', 1600000.00, '2023-05-18', '2023-06-18', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(59, 'Yoyok & Usman sewa 2 kamar A2&A6', NULL, '4', 'IDR', 2600000.00, '2023-05-18', '2023-06-17', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(60, 'Yoyok Pulsa PLN Kost 188 kamar D6/A2', NULL, '5', 'IDR', 206000.00, '2023-05-09', '2023-05-21', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(61, 'Doni BBM', NULL, '6', 'IDR', 923641.00, '2023-05-05', '2023-05-26', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(62, 'Mubin BBM Mobilio', NULL, '7', 'IDR', 1365720.00, '2023-05-04', '2023-05-29', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(63, 'Mubin Pulsa PLN Kost 188 kamar C5', NULL, '8', 'IDR', 102750.00, '2023-05-11', NULL, 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(64, 'Usman PLN Kost 188 kamar D5 & A6', NULL, '9', 'IDR', 155750.00, '2023-05-11', '2023-05-27', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(65, 'Dinas BBM', NULL, '10', 'IDR', 450030.00, '2023-05-02', '2023-05-12', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(66, 'Dimas Tol', NULL, '11', 'IDR', 123000.00, '2023-05-01', '2023-05-31', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(67, 'Christian BBM', NULL, '12', 'IDR', 1200000.00, '2023-05-03', '2023-05-19', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(68, 'Excel BBM', NULL, '13', 'IDR', 187300.00, '2023-05-15', '2023-05-29', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(69, 'Agus D.P Tol Sidoarjo ke IJS', NULL, '14', 'IDR', 200000.00, '2023-05-02', '2023-05-31', 'IJS', 7, '2023-06-12 20:32:52', '2023-06-12 20:32:52'),
	(70, 'Tagihan Listrik Hunian CH/17/10 ', NULL, 'WE00003722', 'IDR', 79631.44, NULL, NULL, 'Lira', 8, '2023-06-12 21:02:58', '2023-06-12 21:02:58'),
	(71, 'Tagihan Air Hunian CH/17/10 ', NULL, 'WE00003722', 'IDR', 63000.00, NULL, NULL, 'Lira', 8, '2023-06-12 21:02:58', '2023-06-12 21:02:58'),
	(72, 'Beli BBM', NULL, '952343', 'IDR', 450500.00, '2023-06-09', NULL, NULL, 9, '2023-06-12 21:08:46', '2023-06-12 21:08:46'),
	(73, 'Top Up E-Money', NULL, '0001938218', 'IDR', 301500.00, '2023-06-09', NULL, NULL, 9, '2023-06-12 21:08:47', '2023-06-12 21:08:47'),
	(74, '10 Parkir Karcis Ciputra World', NULL, '1', 'IDR', 50000.00, '2023-05-23', '2023-06-09', NULL, 9, '2023-06-12 21:08:47', '2023-06-12 21:08:47'),
	(75, 'Beli BBM', NULL, '05.05.21464', 'IDR', 55000.00, '2023-05-30', NULL, NULL, 9, '2023-06-12 21:08:47', '2023-06-12 21:08:47'),
	(76, 'Beli BBM', NULL, '04.01.20118', 'IDR', 55000.00, '2023-06-07', NULL, NULL, 9, '2023-06-12 21:08:47', '2023-06-12 21:08:47'),
	(77, 'Parkir', NULL, '2', 'IDR', 2000.00, NULL, NULL, NULL, 9, '2023-06-12 21:08:47', '2023-06-12 21:08:47'),
	(78, 'Hotel Prasada Mansion 2 malam A/N Loisa Christina', NULL, '1236631156', 'IDR', 675000.00, '2023-06-20', '2023-06-22', 'DL SAP', 2, '2023-06-13 10:24:21', '2023-06-13 10:24:22'),
	(79, 'Hotel Prasada Mansion 2 malam A/N Very Briliyanto', NULL, '1236231542', 'IDR', 585000.00, '2023-06-20', '2023-06-22', 'DL SAP', 2, NULL, NULL),
	(80, 'Cleaning Service 3 jam', NULL, '1', 'IDR', 100000.00, '2023-06-09', NULL, 'PT. Eclectic Consulting', 10, '2023-06-13 21:27:13', '2023-06-13 21:27:13'),
	(81, 'Beli Meterai @10000 50 pcs', NULL, '1', 'IDR', 500000.00, '2023-05-16', NULL, NULL, 11, '2023-06-15 23:07:58', '2023-06-15 23:07:58'),
	(82, 'Cleaning Service 3 jam', NULL, '1', 'IDR', 100000.00, '2023-05-16', NULL, NULL, 12, '2023-06-15 23:18:53', '2023-06-15 23:18:53'),
	(83, 'Tagihan Listrik Hunian CH/17/09 Juni 2023', NULL, 'WE00003737', 'IDR', 79631.44, NULL, NULL, 'Lira', 8, NULL, NULL),
	(84, 'Tagihan Air Hunian CH/17/09 Juni 2023', NULL, 'WE00003738', 'IDR', 63000.00, NULL, NULL, 'Lira', 8, NULL, NULL),
	(85, 'Wallpaper CH/17/09', NULL, '1', 'IDR', 600000.00, NULL, NULL, 'Lira', 8, NULL, NULL),
	(86, 'Kebersihan Unit CH/17/09', NULL, '2', 'IDR', 100000.00, NULL, NULL, 'Lira', 8, NULL, NULL),
	(87, 'Kunci CH/17/09', NULL, '3', 'IDR', 300000.00, NULL, NULL, 'Lira', 8, NULL, NULL),
	(88, 'Pembulatan', NULL, NULL, 'IDR', -631.44, NULL, NULL, NULL, 8, NULL, NULL),
	(89, 'Tagihan Listrik Hunian CH/01/08', NULL, 'WE00003894', 'IDR', 239814.00, NULL, NULL, 'Lira', 8, NULL, NULL),
	(90, 'Tagihan Air Hunian', NULL, 'WE00003894', 'IDR', 74760.00, NULL, NULL, 'Lira', 8, NULL, NULL),
	(91, 'Pembulatan', NULL, NULL, 'IDR', -74.40, NULL, NULL, NULL, 8, NULL, NULL),
	(92, 'Pembayaran Jaminan Pelakasanaan Pekerjaan Renewal SAP Support di PT Pindad', NULL, '1', 'IDR', 146217.00, '2023-06-15', NULL, NULL, 13, '2023-06-19 23:22:34', '2023-06-19 23:22:34'),
	(93, 'Tiket Team SUB-HLP ( 3 Orang - Yulianto, Dony, Tegar )', NULL, '1.1', 'IDR', 2353216.00, '2023-06-13', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(94, 'Tiket SUB-CGK', NULL, '1.2', 'IDR', 910018.00, '2023-06-14', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(95, 'Tiket HLP - SUB', NULL, '1.3', 'IDR', 847955.00, '2023-06-15', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(96, 'Tiket SUB-HLP', NULL, '1.4', 'IDR', 1107100.00, '2023-06-20', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(97, 'Tiket Team CGK-SUB ( 4 Orang - Sujiono, Yulianto, Dony, Tegar )', NULL, '1.5', 'IDR', 2952000.00, '2023-06-21', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(98, 'BBM', NULL, '1.6', 'IDR', 868270.00, '2023-06-06', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(99, 'Taxi Juanda', NULL, '1.7', 'IDR', 76350.00, '2023-06-14', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(100, 'Damri Bandara', NULL, '1.8', 'IDR', 95000.00, '2023-06-14', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(101, 'Grab GDE', NULL, '1.9', 'IDR', 13000.00, '2023-06-14', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(102, 'Grab Halim', NULL, '1.10', 'IDR', 59000.00, '2023-06-15', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(103, 'Taxi Juanda', NULL, '1.11', 'IDR', 72400.00, '2023-06-15', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(104, 'Grab Halim', NULL, '1.12', 'IDR', 106000.00, '2023-06-20', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(105, 'GoCar Halim-GDE ', NULL, '1.13', 'IDR', 85000.00, '2023-06-13', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(106, 'Fito Bandara Surcharge Taxi ', NULL, '1.13', 'IDR', 15000.00, '2023-06-13', NULL, 'GDE', 14, NULL, NULL),
	(107, 'Grab Hotel-GDE', NULL, '1.14', 'IDR', 48000.00, '2023-06-14', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(108, 'Grab GDE-Hotel', NULL, '1.15', 'IDR', 36000.00, '2023-06-14', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(109, 'Grab Hotel-GDE', NULL, '1.16', 'IDR', 47000.00, '2023-06-15', NULL, 'GDE', 14, '2023-06-22 23:31:58', '2023-06-22 23:31:58'),
	(110, 'Grab GDE-Hotel', NULL, '1.17', 'IDR', 24000.00, '2023-06-15', NULL, 'GDE', 14, NULL, NULL),
	(111, 'Grab Hotel-GDE', NULL, '1.18', 'IDR', 48000.00, '2023-06-16', NULL, 'GDE', 14, NULL, NULL),
	(112, 'Grab GDE-Hotel', NULL, '1.19', 'IDR', 39000.00, '2023-06-16', NULL, 'GDE', 14, NULL, NULL),
	(113, 'Grab Hotel-GDE', NULL, '1.20', 'IDR', 47000.00, '2023-06-20', NULL, 'GDE', 14, NULL, NULL),
	(114, 'Grab GDE-Hotel', NULL, '1.21', 'IDR', 24000.00, '2023-06-20', NULL, 'GDE', 14, NULL, NULL),
	(115, 'Grab Hotel-GDE', NULL, '1.22', 'IDR', 50000.00, '2023-06-21', NULL, 'GDE', 14, NULL, NULL),
	(116, 'Grab GDE-CGK', NULL, '1.23', 'IDR', 184000.00, '2023-06-21', NULL, 'GDE', 14, NULL, NULL),
	(117, 'Hotel 2 Kamar 4 Malam - (Yulianto+Aldo , Dony+Tegar)', NULL, '2.1', 'IDR', 2824316.00, '2023-06-13', '2023-06-17', 'GDE', 14, NULL, NULL),
	(118, 'Hotel - Sujiono', NULL, '2.2', 'IDR', 421276.00, '2023-06-14', NULL, 'GDE', 14, NULL, NULL),
	(119, 'Hotel 2 Kamar 4 Malam -  (Yulianto+Aldo , Dony+Tegar)', NULL, '2.3', 'IDR', 3120000.00, '2023-06-17', '2023-06-21', 'GDE', 14, NULL, NULL),
	(120, 'Hotel - Sujiono', NULL, '2.4', 'IDR', 426916.00, '2023-06-20', NULL, 'GDE', 14, NULL, NULL),
	(131, 'PKB Kendaraan Toyota Vellfire L 0701 A	Tahun 2023', NULL, '1669130187', 'IDR', 8748500.00, '2023-06-26', NULL, NULL, 15, '2023-06-25 23:05:36', '2023-06-25 23:05:36'),
	(132, 'Sewa 33-17', NULL, '1', 'IDR', 24000000.00, '2023-06-01', '2023-08-31', 'LIRA', 16, '2023-06-27 20:23:40', '2023-06-27 20:23:40'),
	(133, '19 Parkir Karcis Ciputra World', NULL, '1', 'IDR', 95000.00, '2023-06-13', '2023-06-26', NULL, 17, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(134, 'Parkir', NULL, '2', 'IDR', 3000.00, NULL, NULL, NULL, 17, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(135, 'Beli BBM', NULL, '2.1.003206', 'IDR', 50000.00, '2023-06-14', NULL, NULL, 17, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(136, 'Beli BBM', NULL, '2.1.014237', 'IDR', 50000.00, '2023-06-20', NULL, NULL, 17, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(137, 'Beli BBM', NULL, '04.02.00126', 'IDR', 392125.00, '2023-06-27', NULL, NULL, 17, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(138, 'Beli BBM', NULL, '05643', 'IDR', 40000.00, '2023-06-23', NULL, NULL, 17, '2023-06-27 22:33:08', '2023-06-27 22:33:08'),
	(139, 'Beli Kertas, Mika, dan Jilid Plakban Centro', NULL, 'TC-2306-01676', 'IDR', 10000.00, '2023-06-20', NULL, NULL, 17, '2023-06-28 05:42:07', NULL),
	(140, 'Potong Kertas Karsono', NULL, '3', 'IDR', 12000.00, '2023-06-16', NULL, NULL, 17, '2023-06-28 05:43:18', NULL),
	(141, 'Beli ATK Kwan', NULL, '2517', 'IDR', 183000.00, '2023-06-15', NULL, NULL, 17, NULL, NULL),
	(142, 'Fee Consultant APP', NULL, NULL, 'IDR', 18000000.00, '2023-05-29', '2023-05-31', 'Sinarmas', 18, '2023-06-28 00:07:54', '2023-06-28 00:07:54'),
	(143, 'Timesheet APP Sinarmas periode Mei 2023 signed', NULL, NULL, 'IDR', 8000000.00, '2023-05-29', '2023-05-31', 'Sinarmas', 19, '2023-06-28 00:10:56', '2023-06-28 00:10:56'),
	(144, 'Cleaning Service 3 Jam', NULL, NULL, 'IDR', 100000.00, '2023-06-28', NULL, NULL, 20, '2023-06-28 01:29:02', '2023-06-28 01:29:02'),
	(145, 'Air Listrik Chicago 36.09', NULL, NULL, 'IDR', 318357.00, NULL, NULL, NULL, 21, '2023-06-28 01:59:45', '2023-06-28 01:59:45'),
	(146, 'Air Listrik Chicago 07.07', NULL, NULL, 'IDR', 309280.00, NULL, NULL, NULL, 21, '2023-06-28 01:59:45', '2023-06-28 01:59:45'),
	(147, 'Beli Meterai 50 Pcs @10000', NULL, NULL, 'IDR', 500000.00, '2023-07-04', NULL, NULL, 22, '2023-07-04 20:57:09', '2023-07-04 20:57:09'),
	(148, 'Sabun Cuci Piring, Pembersih Kaca, Tissue', NULL, '074790', 'IDR', 39100.00, '2023-07-04', NULL, NULL, 22, '2023-07-04 20:57:09', '2023-07-04 20:57:09'),
	(149, 'Bluebird ke GKM', NULL, 'UK2783', 'IDR', 216440.00, '2023-06-15', NULL, 'GKM', 23, NULL, NULL),
	(151, 'Toll ', NULL, '603422', 'IDR', 33500.00, '2023-06-15', NULL, NULL, 23, NULL, NULL),
	(152, 'Bluebird ke SAP', NULL, 'RD855', 'IDR', 66280.00, '2023-06-05', NULL, 'SAP', 23, NULL, NULL),
	(153, 'Bluebird ke SAP', NULL, 'SYE1379', 'IDR', 67360.00, '2023-06-07', NULL, 'SAP', 23, NULL, NULL),
	(154, 'Bluebird ke ASG', NULL, 'RD2252', 'IDR', 103320.00, '2023-06-28', NULL, 'ASG', 23, NULL, NULL),
	(155, 'Makan siang', NULL, '01 CLERK 01', 'IDR', 59500.00, '2023-06-06', NULL, 'ASTC MRT', 23, NULL, NULL),
	(156, 'isi apartment', NULL, 'SGTS23060502095', 'IDR', 272502.00, '2023-06-05', NULL, NULL, 23, NULL, NULL),
	(157, 'makan siang di ASG', NULL, '1-20230628-4730', 'IDR', 299646.00, '2023-06-28', NULL, 'ASG', 23, NULL, NULL),
	(158, 'makan pagi dengan tim sigma di juanda', NULL, 'POS001', 'IDR', 108000.00, '2023-06-12', NULL, 'Sigma', 23, NULL, NULL),
	(160, 'print agreement sigma di mitra', NULL, 'MITRA', 'IDR', 44000.00, '2023-06-07', NULL, NULL, 23, NULL, NULL),
	(161, 'top flass toll', NULL, '9947', 'IDR', 30000.00, '2023-06-06', NULL, NULL, 23, NULL, NULL),
	(162, 'isi internet apartement', NULL, '582886283219', 'IDR', 51500.00, '2023-06-28', NULL, NULL, 23, NULL, NULL),
	(163, 'RSIA ke benhill', NULL, 'RB-117915', 'IDR', 26000.00, '2023-06-07', NULL, 'ASG', 23, NULL, NULL),
	(164, 'MRT ke telkom sigma BSD', NULL, 'RB-115541', 'IDR', 91000.00, '2023-06-06', NULL, 'TELKOM SIGMA', 23, NULL, NULL),
	(165, 'ASTC ke MRT', NULL, 'RB-120947', 'IDR', 132000.00, '2023-06-06', NULL, 'MRT', 23, NULL, NULL),
	(166, 'MRT ke ASTC', NULL, 'RB-137634', 'IDR', 144000.00, '2023-06-06', NULL, 'ASTC', 23, NULL, NULL),
	(167, 'samara ke halim', NULL, 'A-544R78NWWGGQ', 'IDR', 42500.00, '2023-06-29', NULL, NULL, 23, NULL, NULL),
	(168, 'bintaro ke samara', NULL, 'A-542PM86GWGMJ', 'IDR', 105000.00, '2023-06-28', NULL, 'ASG', 23, NULL, NULL),
	(169, 'PIK ke Bintaro', NULL, 'A-542FL4DGWFD4', 'IDR', 112000.00, '2023-06-28', NULL, 'ASG', 23, NULL, NULL),
	(170, 'samara ke halim', NULL, 'A-5XFWHCGWWFI9', 'IDR', 47000.00, '2023-06-08', NULL, 'LIRA', 23, NULL, NULL),
	(171, 'cafe ke benhill', NULL, '2', 'IDR', 13500.00, '2023-06-08', NULL, 'ASG', 23, NULL, NULL),
	(172, 'cafe ke satrio mall', NULL, 'A-5XEIEDJWWFPS', 'IDR', 18500.00, '2023-06-08', NULL, 'PRESALES AP2', 23, NULL, NULL),
	(173, 'satrio ke samara', NULL, 'A-5X8AEANWWHS9', 'IDR', 13500.00, '2023-06-06', NULL, 'PRESALES AP2', 23, NULL, NULL),
	(174, 'samara ke satrio mall', NULL, 'A-5X8224WWJWO', 'IDR', 17500.00, '2023-06-06', NULL, 'PRESALES AP3', 23, NULL, NULL),
	(175, 'benhill ke samara', NULL, 'GRAB(14500)', 'IDR', 14500.00, '2023-06-06', NULL, 'ASG', 23, NULL, NULL),
	(176, 'cafe ke benhill', NULL, 'GRAB(22500)', 'IDR', 22500.00, '2023-06-06', NULL, 'ASG', 23, NULL, NULL),
	(177, 'makan sore ', NULL, '1-230628-3036', 'IDR', 263670.00, '2023-06-28', NULL, 'ASG', 23, NULL, NULL),
	(259, 'sewa kost dokumen bulan juli 2023 & iuran bulan juli 2023', NULL, '1', 'IDR', 361000.00, '2023-07-06', NULL, NULL, 188, '2023-07-06 01:59:17', '2023-07-06 01:59:17'),
	(260, 'Cleaning Service 3 Jam', NULL, '0107', 'IDR', 100000.00, '2023-07-07', NULL, NULL, 189, '2023-07-07 01:31:19', '2023-07-07 01:31:19'),
	(261, 'ASKRINDO untuk pembayaran polis 1601.23.003.1.00069-4/00', NULL, '00135/MEM-03/05/2023', 'IDR', 110791.00, '2023-07-07', NULL, NULL, 190, '2023-07-07 02:16:41', '2023-07-07 02:16:41'),
	(262, 'Arbin & Hermes Sewa kamar 212', NULL, '30062023', 'IDR', 2600000.00, '2023-07-01', '2023-07-31', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(263, 'Arbin & Hermes PLN kamar 212', NULL, '30062023', 'IDR', 341600.00, '2023-06-01', '2023-06-30', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(264, 'Mubin Sewa 1 kamar 305', NULL, '17062023', 'IDR', 1600000.00, '2023-06-18', '2023-07-17', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(265, 'Mubin PLN kamar 305', NULL, '17062023', 'IDR', 302000.00, '2023-05-18', '2023-06-17', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(266, 'Yoyok & Usman sewa 2 kamar A2&A6', NULL, '2306171122849148791', 'IDR', 2600000.00, '2023-06-18', '2023-07-17', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(267, 'Jerry sewa kost 188 kamar C2', NULL, '2306051121789754396', 'IDR', 1300000.00, '2023-06-06', '2023-07-05', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(268, 'Yoyok Pulsa PLN Kost 188 kamar A2', NULL, '1664358444', 'IDR', 103000.00, '2023-06-21', NULL, 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(269, 'Usman PLN Kost 188 kamar A6', NULL, '8.21', 'IDR', 103000.00, '2023-06-21', NULL, 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(270, 'Jerry PLN Kost 188 kamar C2', NULL, '9.5', 'IDR', 102500.00, '2023-06-05', NULL, 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(271, 'Usman Grab dari Kost ke IJS (PP)', NULL, '10.1, 10.2, 10.3, 10.4', 'IDR', 146000.00, '2023-06-02', '2023-06-22', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(272, 'Doni BBM', NULL, '11.6', 'IDR', 353750.00, '2023-06-07', NULL, 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(273, 'Christian BBM', NULL, '12.5, 12.13, 12.17, 12.25', 'IDR', 468485.00, '2023-06-05', '2023-06-25', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(274, 'Excel BBM', NULL, '13.13, 13.19, 13.26', 'IDR', 150000.00, '2023-06-13', '2023-06-26', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(275, 'Mubin BBM Mobilio', NULL, '14.5, 14.13, 14.19, 14.26', 'IDR', 1352880.00, '2023-06-05', '2023-06-27', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(276, 'Ifa BBM', NULL, '15.20, 15.23, 15.28', 'IDR', 147000.00, '2023-06-20', '2023-06-28', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(277, 'Dimas BBM', NULL, '16.24, 16.5', 'IDR', 541680.00, '2023-05-24', '2023-06-05', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(278, 'Agus D.P. Tol Sidoarjo ke IJS', NULL, '17.1, 17.2, 17.3, 17.4', 'IDR', 180000.00, '2023-06-01', '2023-06-30', 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(279, 'Mubin service Mobilio', NULL, '2756/JL/UTM/0623', 'IDR', 530000.00, '2023-06-17', NULL, 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(280, 'Hermes grab dari kost ke IJS', NULL, 'A-54XWG$MWWIJS', 'IDR', 30500.00, '2023-06-28', NULL, 'IJS', 191, '2023-07-10 20:44:42', '2023-07-10 20:44:42'),
	(281, '7 karcis parkir ciputra world @5000', NULL, NULL, 'IDR', 35000.00, '2023-06-28', '2023-07-07', NULL, 192, '2023-07-10 22:37:27', '2023-07-10 22:37:27'),
	(282, 'isi bensin', NULL, '25715', 'IDR', 50000.00, '2023-06-28', NULL, NULL, 192, '2023-07-10 22:37:27', '2023-07-10 22:37:27'),
	(283, 'top up flazz BCA', NULL, '004298', 'IDR', 300000.00, '2023-07-04', NULL, NULL, 192, '2023-07-10 22:37:27', '2023-07-10 22:37:27'),
	(284, 'isi bensin', NULL, '05.05.25734', 'IDR', 50000.00, '2023-07-05', NULL, NULL, 192, '2023-07-10 22:37:27', '2023-07-10 22:37:27'),
	(285, 'isi bensin', NULL, '3635383', 'IDR', 445250.00, '2023-07-08', NULL, NULL, 192, '2023-07-10 22:37:27', '2023-07-10 22:37:27'),
	(286, 'PAM', NULL, 'UT23070824', 'IDR', 52000.00, '2023-05-20', '2023-06-20', NULL, 194, '2023-07-11 23:23:53', '2023-07-11 23:23:53'),
	(287, 'Tagihan Air Mineral', NULL, 'SL23070231', 'IDR', 105000.00, '2023-05-21', '2023-06-20', NULL, 194, '2023-07-11 23:23:53', '2023-07-11 23:23:53'),
	(288, 'Iuran Pengelolaan & dana Cadangan', NULL, 'SC23070311', 'IDR', 9084675.00, '2023-07-01', '2023-09-30', NULL, 194, '2023-07-11 23:23:53', '2023-07-11 23:23:53'),
	(289, 'Token Listrik', NULL, '1', 'IDR', 1500000.00, NULL, NULL, NULL, 194, '2023-07-11 23:23:53', '2023-07-11 23:23:53'),
	(290, 'Cleaning Service 3 Jam', NULL, '0207', 'IDR', 100000.00, '2023-07-14', NULL, NULL, 195, '2023-07-13 19:47:30', '2023-07-13 19:47:30');

-- Dumping structure for table eclectic.admin_purchase_order
CREATE TABLE IF NOT EXISTS `admin_purchase_order` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_purchasing` date DEFAULT NULL,
  `tipe_pr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemohon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accounting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kasir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menyetujui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_approved` enum('rejected','pending','approved') COLLATE utf8mb4_unicode_ci DEFAULT 'rejected',
  `status_paid` enum('rejected','pending','paid') COLLATE utf8mb4_unicode_ci DEFAULT 'rejected',
  `tgl_approval` date DEFAULT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_referensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_purchase_order: ~24 rows (approximately)
DELETE FROM `admin_purchase_order`;
INSERT INTO `admin_purchase_order` (`id`, `no_doku`, `tgl_purchasing`, `tipe_pr`, `supplier`, `pemohon`, `accounting`, `kasir`, `menyetujui`, `status_approved`, `status_paid`, `tgl_approval`, `alasan`, `no_referensi`, `created_at`, `updated_at`) VALUES
	(1, '01/PO/06/2023', '2023-06-02', '23/VI/PR/00001', 'PT. Padi Internet', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-05', NULL, NULL, '2023-06-19 08:07:32', '2023-06-19 08:07:32'),
	(2, '02/PO/06/2023', '2023-06-03', '23/VI/PR/00002', 'Harris Hotel Sentul City', 'Novi', 'Naumi. T. R', 'Suzy. A', 'Richard', 'approved', 'pending', '2023-06-05', NULL, NULL, '2023-06-19 20:28:05', '2023-06-19 20:28:05'),
	(3, '03/PO/06/2023', '2023-06-03', '23/VI/PR/00003', 'PT. Dharma Anugerah Wiratama', 'Novi', 'Naumi. T. R', 'Suzy. A', 'Richard', 'approved', 'pending', '2023-06-05', NULL, NULL, '2023-06-19 20:32:42', '2023-06-19 20:32:42'),
	(4, '04/PO/06/2023', '2023-06-01', '23/VI/PR/00004', 'Sri Wahyuni', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Sujiono', 'approved', 'pending', '2023-06-06', NULL, NULL, '2023-06-19 20:45:45', '2023-06-19 20:45:45'),
	(5, '05/PO/06/2023', '2023-06-13', '23/VI/PR/00005', 'Biznet', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', NULL, NULL, NULL, '2023-06-19 20:47:49', '2023-06-19 20:47:49'),
	(6, '06/PO/06/2023', '2023-06-05', '23/VI/PR/00006', 'Huawei Services (HONG KONG) Co., Limited', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-20', NULL, NULL, '2023-06-19 20:48:29', '2023-06-19 20:48:29'),
	(7, '07/PO/06/2023', '2023-06-08', '23/VI/PR/00007', 'Qualtrics, LLC', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-20', NULL, NULL, '2023-06-19 20:50:37', '2023-06-19 20:50:37'),
	(8, '08/PO/06/2023', '2023-06-19', '23/VI/PR/00008', 'PT ASTRA INT. Tbk (Auto 2000)', 'Supriyonggo', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-20', NULL, NULL, '2023-06-19 21:03:59', '2023-06-19 21:03:59'),
	(10, '09/PO/06/2023', '2023-06-20', '23/VI/PR/00009', 'LINK MICROSYSTEMS', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-27', NULL, NULL, '2023-06-20 00:49:58', '2023-06-20 00:49:58'),
	(11, '10/PO/06/2023', '2023-06-26', '23/VI/PR/00010', 'Resto Nine', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Sujiono', 'approved', 'pending', '2023-06-26', NULL, NULL, '2023-06-26 01:41:39', '2023-06-26 01:41:39'),
	(12, '11/PO/06/2023', '2023-06-26', '23/VI/PR/00011', 'PT. SAP Indonesia', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', NULL, NULL, NULL, '2023-06-26 03:01:47', '2023-06-26 03:01:47'),
	(13, '12/PO/06/2023', '2023-06-27', '23/VI/PR/00012', 'Flowernett Florist', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', NULL, NULL, NULL, '2023-06-27 03:01:46', '2023-06-27 03:01:46'),
	(14, '13/PO/06/2023', '2023-06-27', '23/VI/PR/00013', 'Syntesis Square', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-28', NULL, NULL, '2023-06-28 01:44:25', '2023-06-28 01:44:25'),
	(15, '14/PO/06/2023', '2023-06-26', '23/VI/PR/00014', 'NTT Data Business Solution', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-06-30', NULL, NULL, '2023-06-29 21:52:02', '2023-06-29 21:52:02'),
	(16, '01/PO/07/2023', '2023-07-03', '23/VII/PR/00001', 'PT. Padi Internet', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', NULL, NULL, NULL, '2023-07-04 00:26:46', '2023-07-04 00:26:46'),
	(17, '02/PO/07/2023', '2023-07-01', '23/VII/PR/00002', 'Sri Wahyuni', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', NULL, NULL, NULL, '2023-07-04 20:38:16', '2023-07-04 20:38:16'),
	(18, '03/PO/07/2023', '2023-07-05', '23/VII/PR/00003', 'Faiq Rukhulloh', 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', 'approved', 'pending', '2023-07-07', NULL, NULL, '2023-07-06 01:23:45', '2023-07-06 01:23:45'),
	(19, '04/PO/07/2023', '2023-07-07', '23/VII/PR/00004', 'TESKA Florist', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-07-07', NULL, NULL, '2023-07-06 20:22:05', '2023-07-06 20:22:05'),
	(20, '05/PO/07/2023', '2023-07-13', '23/VII/PR/00005', 'LINK MICROSYSTEMS', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-07 00:52:31', '2023-07-07 00:52:31'),
	(22, '06/PO/07/2023', '2023-07-10', '23/VI/PR/00005', 'Biznet', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'approved', 'pending', '2023-07-10', NULL, NULL, '2023-07-09 22:06:16', '2023-07-09 22:06:16'),
	(23, '07/PO/07/2023', '2023-07-10', '23/VII/PR/00007', 'PT. Smart Sertifikasi Indonesia', 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', 'approved', 'pending', '2023-07-10', NULL, NULL, '2023-07-09 22:11:03', '2023-07-09 22:11:03'),
	(24, '15/PO/06/2023', '2023-06-30', '23/VI/PR/00015', 'PT. Datacomm Diangraha', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-10 02:22:53', '2023-07-10 02:22:53'),
	(25, '16/PO/06/2023', '2023-06-30', '23/VI/PR/00016', 'PT. Datacomm Diangraha', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-10 02:27:05', '2023-07-10 02:27:05'),
	(26, '08/PO/07/2023', '2023-07-12', '23/VII/PR/00008', 'PT. Executive Center', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-12 00:04:54', '2023-07-12 00:04:54'),
	(27, '09/PO/07/2023', '2023-07-11', '23/VII/PR/00009', 'Sri Wahyuni', 'Stefanus Daniel', 'Naumi. T. R', 'Suzy. A', 'Sujiono', 'approved', 'pending', '2023-07-12', NULL, NULL, '2023-07-12 02:51:44', '2023-07-12 02:51:44'),
	(28, '10/PO/07/2023', '2023-07-05', '23/VII/PR/00010', 'Huawei Services (HONG KONG) Co., Limited', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-12 03:24:07', '2023-07-12 03:24:07'),
	(29, '11/PO/07/2023', '2023-07-13', '23/VII/PR/00011', 'Ahmad Fadilah', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-13 19:40:30', '2023-07-13 19:40:30'),
	(30, '12/PO/07/2023', '2023-07-17', '23/VII/PR/00012', 'PT. SAP SE', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-17 02:54:31', '2023-07-17 02:54:31'),
	(31, '13/PO/07/2023', '2023-07-05', '23/VII/PR/00013', 'PT. SAP Indonesia', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-17 03:06:06', '2023-07-17 03:06:06');

-- Dumping structure for table eclectic.admin_purchase_order_detail
CREATE TABLE IF NOT EXISTS `admin_purchase_order_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tgl_1` date DEFAULT NULL,
  `tgl_2` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` decimal(20,5) DEFAULT NULL,
  `PPN` int DEFAULT NULL,
  `PPH` int DEFAULT NULL,
  `PPH_4` int DEFAULT NULL,
  `PPH_21` int DEFAULT NULL,
  `diskon` int DEFAULT NULL,
  `ctm_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ctm_2` int DEFAULT NULL,
  `fk_po` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_purchase_order_detail_fk_po_foreign` (`fk_po`),
  CONSTRAINT `admin_purchase_order_detail_fk_po_foreign` FOREIGN KEY (`fk_po`) REFERENCES `admin_purchase_order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_purchase_order_detail: ~29 rows (approximately)
DELETE FROM `admin_purchase_order_detail`;
INSERT INTO `admin_purchase_order_detail` (`id`, `judul`, `tgl_1`, `tgl_2`, `jumlah`, `satuan`, `curr`, `nominal`, `PPN`, `PPH`, `PPH_4`, `PPH_21`, `diskon`, `ctm_1`, `ctm_2`, `fk_po`, `created_at`, `updated_at`) VALUES
	(1, 'Padi Colocation Server 2U Padi Enterprise 2 Mbps (Periode: Juni 2023)', NULL, NULL, 1, 'PC', 'IDR', 3200000.00000, 11, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-06-19 08:07:32', '2023-06-19 08:07:32'),
	(2, 'Harris Hotel Sentul City an Hermes', NULL, NULL, 1, 'PC', 'IDR', 3467500.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2023-06-19 20:28:05', '2023-06-19 20:28:05'),
	(3, 'Room Accomodation an Stefanus Daniel 5 day & Meeting Room 04-09/06/2023', NULL, NULL, 16, 'Pax', 'IDR', 76250000.00000, NULL, 2, NULL, NULL, NULL, NULL, NULL, 3, '2023-06-19 20:32:42', '2023-06-19 20:32:42'),
	(5, 'Apartment Transpark Unit C/12/12', NULL, NULL, 1, 'PC', 'IDR', 4500000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2023-06-19 20:45:45', '2023-06-19 20:45:45'),
	(6, 'Tagihan Biznet Bulan Juni', NULL, NULL, 1, 'PC', 'IDR', 360750.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2023-06-19 20:47:49', '2023-06-19 20:47:49'),
	(7, 'Huawei Cloud Service (Panarub)', NULL, NULL, 1, 'PC', 'SGD', 9170.08000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2023-06-19 20:48:29', '2023-06-19 20:48:29'),
	(8, 'Employee Experience 360 Feedback - Employee: up to 10000', NULL, NULL, 1, 'PC', 'IDR', 1449000000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2023-06-19 20:50:37', '2023-06-19 20:50:37'),
	(9, 'Servis Kendaraan Toyota VOXY L 1042 JQ', NULL, NULL, 1, 'Pcs', 'IDR', 36500.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2023-06-19 21:03:59', '2023-06-19 21:03:59'),
	(10, 'Barang (Spare Part) Kendaraan Toyota Voxy L 1042 JQ', NULL, NULL, 1, 'Pcs', 'IDR', 615317.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2023-06-19 21:03:59', '2023-06-19 21:03:59'),
	(11, 'Ganti Chip dan Pembuangan Printer CANON G3020', NULL, NULL, 1, 'Pcs', 'IDR', 350000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2023-06-20 00:49:58', '2023-06-20 00:49:58'),
	(21, 'Meeting Room Venue Western 2 @219.450', NULL, NULL, 15, 'Pax', 'IDR', 3291750.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, '2023-06-26 01:41:39', '2023-06-26 01:41:39'),
	(22, '7020501 PartnetEdge Program Fee 01/01/2023 - 31/12/2023 Rate: 3.700 EUR', NULL, NULL, 1, 'Pc', 'IDR', 59312443.00000, 11, 2, NULL, NULL, NULL, NULL, NULL, 12, '2023-06-26 03:01:47', '2023-06-26 03:01:47'),
	(23, 'Bunga Papan Pernikahan Adi & Rois', NULL, NULL, 1, 'Pc', 'IDR', 500000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '2023-06-27 03:01:46', '2023-06-27 03:01:46'),
	(24, 'Iuran Pengelolaan Lingkungan', '2023-07-01', '2023-09-30', 1, 'PC', 'IDR', 3327750.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2023-06-28 01:44:25', '2023-06-28 01:44:25'),
	(25, 'Sinking Fund ', '2023-07-01', '2023-09-30', 1, 'PC', 'IDR', 332775.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2023-06-28 01:44:25', '2023-06-28 01:44:25'),
	(26, 'Listrik', '2023-05-15', '2023-06-14', 1, 'PC', 'IDR', 257289.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2023-06-28 01:44:25', '2023-06-28 01:44:25'),
	(27, 'Air', '2023-05-15', '2023-06-14', 1, 'PC', 'IDR', 31238.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2023-06-28 01:44:25', '2023-06-28 01:44:25'),
	(28, 'Gas', '2023-05-15', '2023-06-14', 1, 'PC', 'IDR', 91350.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2023-06-28 01:44:25', '2023-06-28 01:44:25'),
	(29, 'Jasa Layanan Dukungan Aplikasi ERP Dwi Agustianto Mohammad & Cipto Wiranada Putra Wahardi PHE Periode Mei 2023 Jasa Layanan Dukungan Aplikasi ERP (PHE)', NULL, NULL, 1, 'PC', 'IDR', 79130000.00000, 11, 2, NULL, NULL, NULL, NULL, NULL, 15, '2023-06-29 21:52:02', '2023-06-29 21:52:02'),
	(30, 'Padi Colocation Server 2U Padi Enterprise 7 Mbps (Periode: Juli 2023)', NULL, NULL, 1, 'PC', 'IDR', 3200000.00000, 11, NULL, NULL, NULL, NULL, NULL, NULL, 16, '2023-07-04 00:26:46', '2023-07-04 00:26:46'),
	(41, 'Apartement Transpark Unit C/12/12', '2023-07-01', '2023-07-31', 1, 'PC', 'IDR', 4500000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, '2023-07-04 20:38:16', '2023-07-04 20:38:16'),
	(42, 'jasa pengurusan pembuatan NIB', NULL, NULL, 1, 'PC', 'IDR', 2000000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, '2023-07-06 01:23:45', '2023-07-06 01:23:45'),
	(43, 'Pesan Bunga Pernikahan Papan Printing A/N Septian & Fahmi', '2023-07-09', NULL, 1, 'PC', 'IDR', 500000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, '2023-07-06 20:22:05', '2023-07-06 20:22:05'),
	(44, 'Pembelian Asus Wireless AX Router RT-AX55 AX1800 Dual Band WiFi Router', NULL, NULL, 1, 'PC', 'IDR', 1800000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, '2023-07-07 00:52:31', '2023-07-07 00:52:31'),
	(46, 'Tagihan Biznet Bulan Juni', NULL, NULL, 1, 'PC', 'IDR', 360750.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, '2023-07-09 22:06:16', '2023-07-09 22:06:16'),
	(47, 'ISO 14001 - Sertifikasi ISO 14001:2015, Akreditasi IAS (AQSR), PT. Eclectic Consulting', NULL, NULL, 1, 'set', 'IDR', 8500000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, '2023-07-09 22:11:03', '2023-07-09 22:11:03'),
	(48, 'IaaS (Project IJS, Phase GO LIVE 1. VM Implementasi 6 Core, 256 GB RAM, 1024 GB HDD 2. VM Apps 6 Core, 32 GB RAM, 600 GB HDD 3. VM DB 16 Core, 256 GB RAM, 1024 GB HDD 4. VM SOLMAN 4 Core, 32 GB RAM, 614 GB HDD 5. VM DISPATCHER & FIORI 4 Core, 16 GB RAM, 614 GB HDD 1 IP IP Public)', NULL, NULL, 1, 'PC', 'IDR', 33000000.00000, 11, 2, NULL, NULL, NULL, NULL, NULL, 24, '2023-07-10 02:22:53', '2023-07-10 02:22:53'),
	(49, 'Iaas (Production 80% Phase Project Nobel BaaS 4 TB)', NULL, NULL, 1, 'PC', 'IDR', 41220000.00000, 11, 2, NULL, NULL, NULL, NULL, NULL, 25, '2023-07-10 02:27:05', '2023-07-10 02:27:05'),
	(50, 'Business Address & Call Handling Plan', '2023-08-01', '2024-07-31', 1, 'PC', 'IDR', 10800000.00000, 11, NULL, 10, NULL, NULL, NULL, NULL, 26, '2023-07-12 00:04:54', '2023-07-12 00:04:54'),
	(51, 'Apartment Transpark Unit C/36/09 A/N Erwin', '2023-07-18', '2023-07-28', 1, 'PC', 'IDR', 2600000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, '2023-07-12 02:51:44', '2023-07-12 02:51:44'),
	(52, 'Huawei Cloud Service (Panarub)', NULL, NULL, 1, 'PC', 'SGD', 7770.70000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 28, '2023-07-12 03:24:07', '2023-07-12 03:24:07'),
	(53, 'Konsultasi Penyusunan CSMS Pertamedika', NULL, NULL, 1, 'PC', 'IDR', 10000000.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 29, '2023-07-13 19:40:30', '2023-07-13 19:40:30'),
	(54, 'Cloud TD, SF Employee Central Payroll', NULL, NULL, 1, 'PC', 'EUR', 1350.00000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, '2023-07-17 02:54:31', '2023-07-17 02:54:31'),
	(55, '8012517 - RISE with S/4HANA CId, priv ed, base opt', NULL, NULL, 60, 'USR', 'IDR', 456455412.00000, 11, 2, NULL, NULL, NULL, NULL, NULL, 31, '2023-07-17 03:06:06', '2023-07-17 03:06:06');

-- Dumping structure for table eclectic.admin_purchase_request
CREATE TABLE IF NOT EXISTS `admin_purchase_request` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_diajukan` date DEFAULT NULL,
  `pemohon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menyetujui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_paid` enum('rejected','pending','paid') COLLATE utf8mb4_unicode_ci DEFAULT 'rejected',
  `status_approved` enum('rejected','pending','approved') COLLATE utf8mb4_unicode_ci DEFAULT 'rejected',
  `tgl_approval` date DEFAULT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_referensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_purchase_request: ~24 rows (approximately)
DELETE FROM `admin_purchase_request`;
INSERT INTO `admin_purchase_request` (`id`, `no_doku`, `tgl_diajukan`, `pemohon`, `menyetujui`, `status_paid`, `status_approved`, `tgl_approval`, `alasan`, `no_referensi`, `created_at`, `updated_at`) VALUES
	(1, '23/VI/PR/00001', '2023-06-01', 'Zhomi', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-06-13 20:22:02', '2023-06-13 20:22:02'),
	(2, '23/VI/PR/00002', '2023-06-03', 'Novi', 'Richard', 'pending', 'approved', NULL, NULL, NULL, '2023-06-14 00:43:47', '2023-06-14 00:43:47'),
	(3, '23/VI/PR/00003', '2023-06-03', 'Novi', 'Richard', 'pending', 'approved', '2023-06-28', NULL, NULL, '2023-06-14 00:56:14', '2023-06-14 00:56:14'),
	(4, '23/VI/PR/00004', '2023-06-01', 'Zhomi', 'Sujiono', 'pending', 'approved', NULL, NULL, NULL, '2023-06-14 01:01:13', '2023-06-14 01:01:13'),
	(5, '23/VI/PR/00005', '2023-06-14', 'Zhomi', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-06-15 02:58:54', '2023-06-15 02:58:54'),
	(6, '23/VI/PR/00006', '2023-06-19', 'Richard', 'Yacob', 'pending', 'approved', '2023-06-20', NULL, NULL, '2023-06-18 23:25:35', '2023-06-18 23:25:35'),
	(7, '23/VI/PR/00007', '2023-06-19', 'Richard', 'Yacob', 'pending', 'approved', '2023-06-20', NULL, NULL, '2023-06-18 23:55:20', '2023-06-18 23:55:20'),
	(8, '23/VI/PR/00008', '2023-06-19', 'Supriyonggo', 'Yacob', 'pending', 'approved', '2023-06-20', NULL, NULL, '2023-06-19 00:25:31', '2023-06-19 00:25:31'),
	(9, '23/VI/PR/00009', '2023-06-20', 'Zhomi', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-06-20 00:47:47', '2023-06-20 00:47:47'),
	(11, '23/VI/PR/00010', '2023-06-26', 'Suzy. A', 'Sujiono', 'pending', 'approved', '2023-06-26', NULL, NULL, '2023-06-26 01:38:48', '2023-06-26 01:38:48'),
	(12, '23/VI/PR/00011', '2023-06-26', 'Richard', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-06-26 02:59:45', '2023-06-26 02:59:45'),
	(13, '23/VI/PR/00012', '2023-06-27', 'Suzy. A', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-06-27 03:01:18', '2023-06-27 03:01:18'),
	(14, '23/VI/PR/00013', '2023-06-27', 'Suzy. A', 'Yacob', 'pending', 'approved', '2023-06-28', NULL, NULL, '2023-06-28 01:42:18', '2023-06-28 01:42:18'),
	(15, '23/VI/PR/00014', '2023-06-26', 'Richard', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-06-29 21:45:20', '2023-06-29 21:45:20'),
	(16, '23/VII/PR/00001', '2023-07-03', 'Zhomi', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-07-04 00:26:15', '2023-07-04 00:26:15'),
	(17, '23/VII/PR/00002', '2023-07-01', 'Zhomi', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-07-04 20:37:50', '2023-07-04 20:37:50'),
	(18, '23/VII/PR/00003', '2023-07-05', 'Devi', 'Richard', 'pending', 'approved', NULL, NULL, NULL, '2023-07-06 01:21:38', '2023-07-06 01:21:38'),
	(19, '23/VII/PR/00004', '2023-07-07', 'Suzy. A', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-07-06 20:20:45', '2023-07-06 20:20:45'),
	(20, '23/VII/PR/00005', '2023-07-13', 'Zhomi', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-07 00:51:45', '2023-07-07 00:51:45'),
	(21, '23/VII/PR/00006', '2023-07-10', 'Zhomi', 'Yacob', 'pending', 'approved', NULL, NULL, NULL, '2023-07-09 22:08:07', '2023-07-09 22:08:07'),
	(22, '23/VII/PR/00007', '2023-07-10', 'Devi', 'Richard', 'pending', 'approved', NULL, NULL, NULL, '2023-07-09 22:10:02', '2023-07-09 22:10:02'),
	(23, '23/VI/PR/00015', '2023-06-30', 'Richard', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-10 02:15:42', '2023-07-10 02:15:42'),
	(25, '23/VI/PR/00016', '2023-06-30', 'Richard', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-10 02:26:02', '2023-07-10 02:26:02'),
	(26, '23/VII/PR/00008', '2023-07-12', 'Suzy. A', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-12 00:03:41', '2023-07-12 00:03:41'),
	(27, '23/VII/PR/00009', '2023-07-11', 'Stefanus Daniel', 'Sujiono', 'pending', 'approved', '2023-07-12', NULL, NULL, '2023-07-12 02:35:13', '2023-07-12 02:35:13'),
	(28, '23/VII/PR/00010', '2023-07-05', 'Richard', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-12 03:23:37', '2023-07-12 03:23:37'),
	(29, '23/VII/PR/00011', '2023-07-13', 'Pamella', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-13 19:39:12', '2023-07-13 19:39:12'),
	(30, '23/VII/PR/00012', '2023-07-17', 'Richard', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-17 02:52:47', '2023-07-17 02:52:47'),
	(31, '23/VII/PR/00013', '2023-07-05', 'Richard', 'Yacob', 'pending', 'pending', NULL, NULL, NULL, '2023-07-17 03:03:18', '2023-07-17 03:03:18');

-- Dumping structure for table eclectic.admin_purchase_request_detail
CREATE TABLE IF NOT EXISTS `admin_purchase_request_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tgl_1` date DEFAULT NULL,
  `tgl_2` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `satuan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_pakai` date DEFAULT NULL,
  `project` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_pr` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_purchase_request_detail_fk_pr_foreign` (`fk_pr`),
  CONSTRAINT `admin_purchase_request_detail_fk_pr_foreign` FOREIGN KEY (`fk_pr`) REFERENCES `admin_purchase_request` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_purchase_request_detail: ~28 rows (approximately)
DELETE FROM `admin_purchase_request_detail`;
INSERT INTO `admin_purchase_request_detail` (`id`, `judul`, `tgl_1`, `tgl_2`, `jumlah`, `satuan`, `tgl_pakai`, `project`, `fk_pr`, `created_at`, `updated_at`) VALUES
	(1, 'Padi Colocation Server 2U Padi Enterprise 2 Mbps (Periode: Juni 2023)', NULL, NULL, 1, 'PC', '2023-06-01', NULL, 1, '2023-06-13 20:22:02', '2023-06-13 20:22:02'),
	(2, 'Harris Hotel Sentul City an Hermes', '2023-06-04', '2023-06-09', 1, 'PC', '2023-06-03', 'Training JOB Medco', 2, '2023-06-14 00:43:47', '2023-06-14 00:43:47'),
	(3, 'Room Accomodation an Stefanus Daniel & Meeting Room', NULL, NULL, 16, 'Pax', '2023-06-03', 'Pertamina Medco', 3, '2023-06-14 00:56:14', '2023-06-14 00:56:14'),
	(4, 'Apartment Transpark Unit C/12/12', '2023-06-01', '2023-06-30', 1, 'PC', '2023-06-01', 'Lira Medika', 4, '2023-06-14 01:01:13', '2023-06-14 01:01:13'),
	(5, 'Tagihan Biznet Bulan Juni', '2023-06-01', '2023-06-30', 1, 'PC', '2023-06-14', NULL, 5, '2023-06-15 02:58:54', '2023-06-15 02:58:54'),
	(7, 'Huawei Cloud Service', '2023-05-01', '2023-05-31', 1, 'PC', '2023-05-01', 'Panarub', 6, '2023-06-18 23:25:35', '2023-06-18 23:25:35'),
	(8, 'Employee Experience 360 Feedback - Employee: up to 10000', '2023-08-08', '2024-08-07', 1, 'PC', '2023-06-08', 'PT. Pegadaian', 7, '2023-06-18 23:55:20', '2023-06-18 23:55:20'),
	(9, 'Servis Kendaraan Toyota VOXY L 1042 JQ', NULL, NULL, 1, 'Pcs', '2023-06-19', NULL, 8, '2023-06-19 00:25:31', '2023-06-19 00:25:31'),
	(10, 'Ganti Chip dan Pembuangan Printer CANON G3020', NULL, NULL, 1, 'Pcs', '2023-06-20', NULL, 9, '2023-06-20 00:16:28', '2023-06-20 00:16:28'),
	(12, 'Meeting Room Venue Western 2', NULL, NULL, 15, 'Pax', '2023-06-27', 'GDE', 11, '2023-06-26 01:38:48', '2023-06-26 01:38:48'),
	(13, 'PartnetEdge Program Fee', '2023-01-01', '2023-12-31', 1, 'Pc', '2023-06-22', 'Eclectic', 12, '2023-06-26 02:59:45', '2023-06-26 02:59:45'),
	(14, 'Bunga Papan Pernikahan Adi & Rois', NULL, NULL, 1, 'Pc', '2023-07-02', NULL, 13, '2023-06-27 03:01:18', '2023-06-27 03:01:18'),
	(15, 'Iuran Pengelolaan Lingkungan', '2023-07-01', '2023-09-30', 1, 'PC', '2023-06-27', NULL, 14, '2023-06-28 01:42:18', '2023-06-28 01:42:18'),
	(16, 'Sinking Fund', '2023-07-01', '2023-09-30', 1, 'PC', '2023-06-27', NULL, 14, NULL, NULL),
	(17, 'Listrik', '2023-05-15', '2023-06-14', 1, 'PC', '2023-06-27', NULL, 14, NULL, NULL),
	(18, 'Air', '2023-05-15', '2023-06-14', 1, 'PC', '2023-06-27', NULL, 14, NULL, NULL),
	(19, 'Gas', '2023-05-15', '2023-06-14', 1, 'PC', '2023-06-27', NULL, 14, NULL, NULL),
	(20, 'Jasa Layanan Dukungan Aplikasi ERP Dwi Agustianto Mohammad & Cipto Wiranada Putra Wahardi PHE', NULL, NULL, 1, 'PC', '2023-06-26', 'PHE', 15, '2023-06-29 21:45:20', '2023-06-29 21:45:20'),
	(21, 'Padi Colocation Server 2U Padi Enterprise 7 Mbps (Periode: Juli 2023)', NULL, NULL, 1, 'PC', '2023-07-03', NULL, 16, '2023-07-04 00:26:15', '2023-07-04 00:26:15'),
	(22, 'Apartement Transpark Unit C/12/12', '2023-07-01', '2023-07-31', 1, 'PC', '2023-07-01', 'Lira Medika', 17, '2023-07-04 20:37:50', '2023-07-04 20:37:50'),
	(23, 'jasa pengurusan pembuatan NIB', NULL, NULL, 1, 'PC', '2023-07-05', NULL, 18, '2023-07-06 01:21:38', '2023-07-06 01:21:38'),
	(24, 'Pesan Bunga Pernikahan Papan Printing A/N Septian & Fahmi', NULL, NULL, 1, 'PC', '2023-07-09', NULL, 19, '2023-07-06 20:20:45', '2023-07-06 20:20:45'),
	(25, 'Pembelian Asus Wireless AX Router RT-AX55 AX1800 Dual Band WiFi Router', NULL, NULL, 1, 'PC', '2023-07-13', NULL, 20, '2023-07-07 00:51:45', '2023-07-07 00:51:45'),
	(26, 'Tagihan Biznet Bulan Juli', '2023-07-01', '2023-07-31', 1, 'PC', '2023-07-16', NULL, 21, '2023-07-09 22:08:07', '2023-07-09 22:08:07'),
	(27, 'ISO 14001 - Sertifikasi ISO 14001:2015, Akreditasi IAS (AQSR), PT. Eclectic Consulting', NULL, NULL, 1, 'set', '2023-08-09', NULL, 22, '2023-07-09 22:10:02', '2023-07-09 22:10:02'),
	(29, 'IaaS (Project IJS, Phase GO LIVE 1. VM Implementasi 6 Core, 256 GB RAM, 1024 GB HDD 2. VM Apps 6 Core, 32 GB RAM, 600 GB HDD 3. VM DB 16 Core, 256 GB RAM, 1024 GB HDD 4. VM SOLMAN 4 Core, 32 GB RAM, 614 GB HDD 5. VM DISPATCHER & FIORI 4 Core, 16 GB RAM, 614 GB HDD 1 IP IP Public)', NULL, NULL, 1, 'PC', '2023-06-30', 'IJS', 23, '2023-07-10 02:18:01', '2023-07-10 02:18:01'),
	(30, 'Iaas (Production 80% Phase Project Nobel BaaS 4 TB)', NULL, NULL, 1, 'PC', '2023-06-30', 'Nobel', 25, '2023-07-10 02:26:02', '2023-07-10 02:26:02'),
	(31, 'Business Address & Call Handling Plan', '2023-08-01', '2024-07-31', 1, 'PC', '2023-07-12', 'Eclectic', 26, '2023-07-12 00:03:41', '2023-07-12 00:03:41'),
	(32, 'Apartment Transpark Unit C/36/09', '2023-07-18', '2023-07-28', 1, 'PC', '2023-07-11', 'Bina Medika', 27, '2023-07-12 02:35:13', '2023-07-12 02:35:13'),
	(33, 'Huawei Cloud Service', NULL, NULL, 1, 'PC', '2023-07-05', 'Panarub', 28, '2023-07-12 03:23:37', '2023-07-12 03:23:37'),
	(34, 'Konsultasi Penyusunan CSMS Pertamedika', NULL, NULL, 1, 'PC', '2023-07-13', 'Pertamedika', 29, '2023-07-13 19:39:12', '2023-07-13 19:39:12'),
	(35, 'Cloud TD, SF Employee Central Payroll', '2023-07-17', '2023-10-16', 1, 'PC', '2023-07-17', 'Eclectic', 30, '2023-07-17 02:52:47', '2023-07-17 02:52:47'),
	(36, '8012517 - RISE with S/4HANA CId, priv ed, base opt', '2023-04-03', '2023-07-02', 60, 'USR', '2023-07-05', 'SSN', 31, '2023-07-17 03:03:18', '2023-07-17 03:03:18');

-- Dumping structure for table eclectic.admin_rb_detail
CREATE TABLE IF NOT EXISTS `admin_rb_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_reim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal` decimal(20,5) DEFAULT NULL,
  `tanggal_1` date DEFAULT NULL,
  `tanggal_2` date DEFAULT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fk_rb` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_rb_detail_fk_rb_foreign` (`fk_rb`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_rb_detail: ~148 rows (approximately)
DELETE FROM `admin_rb_detail`;
INSERT INTO `admin_rb_detail` (`id`, `deskripsi`, `bukti_reim`, `no_bukti`, `curr`, `nominal`, `tanggal_1`, `tanggal_2`, `keperluan`, `fk_rb`, `created_at`, `updated_at`) VALUES
	(1, 'Uang Makan Team Project Lira', '1686027140_0.png', '1', 'IDR', 425000.00000, '2023-05-29', '2023-05-31', 'Lira', 1, '2023-06-05 21:52:20', '2023-06-05 21:52:20'),
	(2, 'Uang Makan Team Project Lira', '1686027140_1.png', '2', 'IDR', 100000.00000, '2023-06-02', NULL, 'Lira', 1, '2023-06-05 21:52:20', '2023-06-05 21:52:20'),
	(3, 'Tiket Bus Jakarta - Semarang', '1686028347_0.png', '1', 'IDR', 285000.00000, '2023-05-22', NULL, 'PT. Sido Muncul', 2, '2023-06-05 22:12:27', '2023-06-05 22:12:27'),
	(4, 'Tiket Bus Semarang - Jakarta', '1686028347_1.png', '2', 'IDR', 300000.00000, '2023-05-27', NULL, 'PT. Sido Muncul', 2, '2023-06-05 22:12:27', '2023-06-05 22:12:27'),
	(5, 'Kirim 2 Cek BNI', 'NULL', '1', 'IDR', 2001.00000, '2023-05-30', NULL, 'NOBEL INDUSTRIES', 5, '2023-06-05 22:17:07', '2023-06-05 22:17:07'),
	(6, 'E-Toll Siang', '1686028627_1.png', '2', 'IDR', 18500.00000, '2023-05-02', NULL, 'Agung Sedayu', 3, '2023-06-05 22:17:07', '2023-06-05 22:17:07'),
	(7, 'Grab Malam', '1686028627_2.png', '3', 'IDR', 135000.00000, '2023-05-02', NULL, 'Agung Sedayu', 3, '2023-06-05 22:17:07', '2023-06-05 22:17:07'),
	(8, 'E-Toll Malam', '1686028627_3.png', '4', 'IDR', 18500.00000, '2023-05-02', NULL, 'Agung Sedayu', 3, '2023-06-05 22:17:07', '2023-06-05 22:17:07'),
	(9, 'Paxel', '1686028853_0.jpeg', 'EM.SOHH7DH04P-20230525-1-8KJ2PM', 'IDR', 31000.00000, '2023-05-25', '2023-05-26', 'Pindad', 4, '2023-06-05 22:20:53', '2023-06-05 22:20:53'),
	(10, '3 Karcis Bulan Mei 2023', '1686028853_1.png', '1', 'IDR', 30000.00000, '2023-05-04', '2023-05-30', 'Eclectic', 4, '2023-06-05 22:20:53', '2023-06-05 22:20:53'),
	(11, '19 Karcis Parkir Skyloft', 'NULL', '2', 'IDR', 95000.00000, '2023-05-01', '2023-05-31', '', 5, '2023-06-05 22:24:07', '2023-06-05 22:24:07'),
	(12, 'Ibis Sby City Center - Titus Obaja', '1686029381_0.pdf', '2', 'IDR', 1392795.00000, '2023-05-22', '2023-05-26', 'IJS', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(13, 'Ibis Sby City Center - Putri Nurfita Sari', '1686029381_1.pdf', '3', 'IDR', 925965.00000, '2023-05-21', '2023-05-24', 'IJS', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(14, 'Ibis Sby City Center - Very & Titus', '1686029381_2.pdf', '4', 'IDR', 1833967.00000, '2023-06-04', '2023-06-09', 'IJS', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(15, 'Ibis Sby City Center - Septian', '1686029381_3.pdf', '5', 'IDR', 1381675.00000, '2023-06-05', '2023-06-09', 'IJS', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(16, 'Parkir CW', '1686029381_4.pdf', '3839', 'IDR', 10000.00000, '2023-05-26', NULL, 'Eclectic', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(17, 'Toll Presales', '1686029381_5.pdf', '283462', 'IDR', 37000.00000, '2023-05-29', NULL, 'PT Berkat Ganda Sentosa', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(18, 'Bensin Presales', '1686029381_6.pdf', '3120075', 'IDR', 100000.00000, '2023-05-29', NULL, 'PT Berkat Ganda Sentosa', 6, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(19, 'Parkir ke Bank', NULL, '3', 'IDR', 5000.00000, '2023-05-16', NULL, NULL, 5, '2023-06-13 04:22:45', '2023-06-13 04:22:48'),
	(20, 'Parkir Bank Mandiri', NULL, '4', 'IDR', 8000.00000, '2023-05-03', '2023-05-25', NULL, 5, '2023-06-13 04:22:46', '2023-06-13 04:22:48'),
	(21, 'BBM Untuk Urusan Bank', NULL, '5', 'IDR', 35000.00000, '2023-05-30', '2023-06-06', NULL, 5, '2023-06-13 04:22:47', '2023-06-13 04:22:49'),
	(22, 'BNI - Meterai Pencarian Cek', NULL, '6', 'IDR', 10000.00000, '2023-05-26', NULL, NULL, 5, '2023-06-13 04:22:47', '2023-06-13 04:22:50'),
	(23, 'Casa Calma', '1686552901_0.pdf', '964808369', 'IDR', 766715.00000, '2023-05-26', '2023-05-29', 'Indorama Cilegon', 15, '2023-06-11 23:55:01', '2023-06-11 23:55:01'),
	(24, 'Tiket JackalHoliday Travel Jakarta - Bandung', '1686552901_1.pdf', 'TJH23053161WKF', 'IDR', 195000.00000, '2023-05-31', NULL, 'Indorama Cilegon', 15, '2023-06-11 23:55:01', '2023-06-11 23:55:01'),
	(25, 'Tiket JackalHoliday Travel Bandung - Tangerang', '1686552901_2.pdf', 'BJH230603KX1XS', 'IDR', 149000.00000, '2023-06-05', NULL, 'Indorama Cilegon', 15, '2023-06-11 23:55:01', '2023-06-11 23:55:01'),
	(26, 'Tiket JackalHoliday Travel Jakarta - Bandung', '1686552901_3.pdf', 'BJH230609DSTON', 'IDR', 129000.00000, '2023-06-10', NULL, 'Indorama Cilegon', 15, '2023-06-11 23:55:01', '2023-06-11 23:55:01'),
	(27, 'Uang Makan Team Project Lira', '1686556861_0.png', '1', 'IDR', 500000.00000, '2023-06-05', '2023-06-09', 'Lira', 16, '2023-06-12 01:01:01', '2023-06-12 01:01:01'),
	(28, 'Tiket Kereta Karawang - Surabaya', '1686557639_0.jpg', 'VAI67UF', 'IDR', 350000.00000, '2023-06-04', NULL, 'IJS', 17, '2023-06-12 01:13:59', '2023-06-12 01:13:59'),
	(29, 'Grab Stasiun Pasar Turi - Hotel Ibis B.Rahmat', '1686557639_1.jpg', 'A-5XXEH84GWFLO', 'IDR', 40000.00000, '2023-06-05', NULL, 'IJS', 17, '2023-06-12 01:13:59', '2023-06-12 01:13:59'),
	(30, 'Tiket Kereta Surabaya - Cikarang', '1686557639_2.jpg', 'IH16S7X', 'IDR', 515000.00000, '2023-06-09', NULL, 'IJS', 17, '2023-06-12 01:13:59', '2023-06-12 01:13:59'),
	(31, 'Grab Stasiun Cikarang - Karawang', NULL, 'A-5XM38UEGWE4G', 'IDR', 91000.00000, '2023-06-10', NULL, 'IJS', 17, NULL, NULL),
	(32, 'GRAB dari Omega Kost ke Bandara Juanda', '1686635587_0.pdf', 'A-5WH3EWOGWE14', 'IDR', 155000.00000, '2023-06-01', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(33, 'Travel LINTAS Bandara SH ke Bandung', '1686635587_1.pdf', 'LTN3DVI', 'IDR', 185000.00000, '2023-06-01', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(34, 'GRAB dari Ouma House Bandung ke Shuttle Day Trans Bandung', '1686635587_2.pdf', 'A-5WVXBMPWWGM4', 'IDR', 9000.00000, '2023-06-04', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(35, 'Travel Day Trans Bandung ke Bogor', '1686635587_3.pdf', 'S-1685607315734', 'IDR', 125000.00000, '2023-06-04', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(36, 'GOJEK dari Shuttle Day Trans Bogor ke Harris Sentul Bogor', '1686635587_4.pdf', 'RB-180943-4286392', 'IDR', 49000.00000, '2023-06-04', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(37, 'GOJEK dari Harris Sentul ke ASTON Lake Sentul', '1686635587_5.pdf', 'RB-117911-6046907', 'IDR', 16000.00000, '2023-06-05', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(38, 'GOJEK dari ASTON Lake ke Harris Sentul', '1686635587_6.pdf', 'RB-135027-8396067', 'IDR', 15500.00000, '2023-06-05', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(39, 'GOCAR dari Harris Sentul ke ASTON Lake Sentul (Bogor Hujan)', '1686635587_7.pdf', 'RB-119523-9229467', 'IDR', 28000.00000, '2023-06-06', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(40, 'GOCAR dari ASTON Lake ke Harris Sentul (Bogor Hujan)', '1686635587_8.pdf', 'A-5X7RRAJWWJTE', 'IDR', 27000.00000, '2023-06-06', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(41, 'GRAB dari Harris Sentul ke ASTON Lake Sentul', '1686635587_9.pdf', 'A-5XA43G4WWJST', 'IDR', 22500.00000, '2023-06-07', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(42, 'GRAB dari ASTON Lake Sentul ke Harris Sentul', '1686635587_10.pdf', 'A1', 'IDR', 23000.00000, '2023-06-07', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(43, 'GRAB dari Harris Sentul ke ASTON Lake Sentul  (Bogor Hujan)', '1686635587_11.pdf', 'A2', 'IDR', 26500.00000, '2023-06-08', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(44, 'GRAB dari ASTON Lake Sentul ke Harris Sentul', '1686635587_12.pdf', 'A-5XFPW7JGWH7E', 'IDR', 23000.00000, '2023-06-08', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(45, 'GRAB dari Harris Sentul ke ASTON Lake Sentul', '1686635587_13.pdf', 'A-5XICOPBGWG6X', 'IDR', 22500.00000, '2023-06-09', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(46, 'GRAB dari ASTON Lake Sentul ke Shuttle Day Trans Bogor', '1686635587_14.pdf', 'A-5XJEQIQGWGX7', 'IDR', 55000.00000, '2023-06-09', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(47, 'Travel Day Trans dari Bogor ke Bandung', '1686635587_15.pdf', 'S-1686194910107', 'IDR', 100000.00000, '2023-06-09', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(48, 'Tol Bogor', '1686635587_16.pdf', '426129', 'IDR', 7000.00000, '2023-06-04', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(49, 'KAI dari Bandung ke Surabaya', '1686635587_17.pdf', '6KV6RUB', 'IDR', 550000.00000, '2023-06-13', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(50, 'GRAB dari Ouma House Bandung ke Stasiun Bandung', '1686635587_18.pdf', 'A-5XSQE85WWGPA', 'IDR', 9000.00000, '2023-06-11', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(51, 'GRAB dari Stasiun Pasar Turi Surabaya ke OMEGA Kost', '1686635587_19.pdf', 'A-5XUT9O5WWGM2', 'IDR', 22000.00000, '2023-06-12', NULL, 'Medco', 18, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(52, 'paxel surabaya - bogor', '1686650398_0.jpg', 'BOVGH2', 'IDR', 15000.00000, '2023-06-06', NULL, 'Medco', 19, '2023-06-13 02:59:58', '2023-06-13 02:59:58'),
	(53, 'paxel surabaya - jakarta', '1686650398_1.jpg', '5MS4IL', 'IDR', 28000.00000, '2023-05-19', NULL, 'Tender Tapera', 19, '2023-06-13 02:59:58', '2023-06-13 02:59:58'),
	(54, 'paxel mandiri depparpostel - geodipa', '1686650398_2.jpg', '2AYOGD', 'IDR', 16000.00000, '2023-06-08', NULL, 'Change Request', 19, '2023-06-13 02:59:58', '2023-06-13 02:59:58'),
	(55, 'paxel mandiri depparpostel - geodipa', '1686650398_3.jpg', 'PHRFBJ', 'IDR', 18000.00000, '2023-06-07', NULL, 'Project System', 19, '2023-06-13 02:59:58', '2023-06-13 02:59:58'),
	(56, 'print sertifikat training job', NULL, '20230605/147', 'IDR', 27500.00000, '2023-06-05', NULL, 'Medco', 19, NULL, NULL),
	(57, 'Uang Makan Team Project Lira', '1687155054_0.png', '1', 'IDR', 675000.00000, '2023-06-12', '2023-06-16', 'Lira', 20, '2023-06-18 23:10:54', '2023-06-18 23:10:54'),
	(58, 'Parkir Soho Skyloft 22 Karcis', NULL, '1', 'IDR', 110000.00000, '2023-05-15', '2023-06-19', NULL, 21, '2023-06-19 20:07:50', '2023-06-19 20:07:50'),
	(59, 'Hypermart Konsumsi Telkom Sigma', NULL, '348 34802 7741', 'IDR', 77600.00000, '2023-06-08', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(60, 'Hypermart 2 pouch Cling Pembersih Kaca', NULL, '348 34802 7929', 'IDR', 8260.00000, '2023-06-08', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(61, 'Hypermart 2 pouch Superpel Pink', NULL, '348 34802 0982', 'IDR', 28300.00000, '2023-06-19', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(62, 'Hypermart 1 pouch Hand Soap Foam Refill Hijau', NULL, '348 34802 1623', 'IDR', 22460.00000, '2023-06-21', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(63, 'Hypermart 1 Pouch Hand Soap Foam Refill Merah', NULL, '348 34802 1623', 'IDR', 20660.00000, '2023-06-21', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(64, 'Telkomsel Kartu Halo 08113451678', NULL, '3685', 'IDR', 55500.00000, '2023-06-20', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(65, 'Telkomsel Kartu Halo 08113451678 Bea Admin', NULL, '3685', 'IDR', 2500.00000, '2023-06-21', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(66, 'Hypermart 8 roll Paseo toilet tissue', NULL, '348 34802 1623', 'IDR', 58330.00000, '2023-06-21', NULL, NULL, 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(67, 'Paxel kirim cek BNI CS752605', NULL, 'UAO50E', 'IDR', 15000.00000, '2023-06-20', NULL, 'Nobel Industries', 22, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(68, 'Kirim Dokumen BAST Eclectic - Haldin', NULL, 'FSCCNH', 'IDR', 28000.00000, '2023-06-21', NULL, 'Haldin', 23, '2023-06-20 22:12:47', '2023-06-20 22:12:47'),
	(77, 'Kirim Dokumen ke Panarub by Paxel', NULL, 'UIMSXJ', 'IDR', 42000.00000, '2023-06-22', NULL, 'Panarub', 24, '2023-06-22 01:20:05', '2023-06-22 01:20:05'),
	(78, 'Tiket JackalHoliday Travel Bandung - Jakarta', '1687426670.png', 'BJH230612TJUW5', 'IDR', 129000.00000, '2023-06-13', NULL, 'GDE', 25, '2023-06-22 02:37:50', '2023-06-22 02:37:50'),
	(79, 'Goride menuju hotel', '1687426670.png', 'RB-110872-7710849', 'IDR', 16000.00000, '2023-06-13', NULL, 'GDE', 25, '2023-06-22 02:37:50', '2023-06-22 02:37:50'),
	(80, 'Tiket Cititrans Jakarta - Bandung', '1687426670.png', 'BOWE23065347643', 'IDR', 160000.00000, '2023-06-21', NULL, 'GDE', 25, '2023-06-22 02:37:50', '2023-06-22 02:37:50'),
	(81, 'Grab ke hotel Prasada dekat WTC (berangkat)', NULL, '1', 'IDR', 81000.00000, '2023-06-20', NULL, 'GLX', 26, '2023-06-23 00:05:23', '2023-06-23 00:05:23'),
	(82, 'Grab ke Apartemen (pulang)', NULL, '2', 'IDR', 101000.00000, '2023-06-22', NULL, 'GLX', 26, '2023-06-23 00:05:23', '2023-06-23 00:05:23'),
	(83, 'Extra bed di hotel', NULL, '3', 'IDR', 300000.00000, '2023-06-22', NULL, 'GLX', 26, '2023-06-23 00:05:23', '2023-06-23 00:05:23'),
	(84, 'Etoll PP', NULL, '4', 'IDR', 32000.00000, '2023-06-20', '2023-06-22', 'GLX', 26, '2023-06-23 00:05:23', '2023-06-23 00:05:23'),
	(85, 'Uang Makan Team Project Lira', '1687747962.png', '1', 'IDR', 550000.00000, '2023-06-19', '2023-06-23', 'Lira', 27, '2023-06-25 19:52:42', '2023-06-25 19:52:42'),
	(86, 'Tiket Bus Rosalia Indah Solo ke Bekasi', '1687761618.jpg', '222-3-060014354', 'IDR', 295000.00000, '2023-06-19', NULL, NULL, 28, '2023-06-25 23:40:18', '2023-06-25 23:40:18'),
	(87, 'Grab ke Terminal', '1687761618.jpg', 'A-53A54KIWWJHU', 'IDR', 13500.00000, '2023-06-22', NULL, NULL, 28, '2023-06-25 23:40:18', '2023-06-25 23:40:18'),
	(88, 'Grab ke Stasiun', '1687761618.jpg', 'A-53A7EXDWWHM6', 'IDR', 31500.00000, '2023-06-22', NULL, NULL, 28, '2023-06-25 23:40:18', '2023-06-25 23:40:18'),
	(89, 'Tiket Kereta Mataram Bekasi ke Solo', '1687761618.jpg', 'DYO603Q', 'IDR', 310000.00000, '2023-06-22', NULL, NULL, 28, '2023-06-25 23:40:18', '2023-06-25 23:40:18'),
	(90, 'Pertamax - Karawang ke SAP Indonesia', NULL, '031097', 'IDR', 200000.00000, '2023-06-19', NULL, 'DL SAP', 29, '2023-06-26 20:41:56', '2023-06-26 20:41:56'),
	(91, 'Parkir Kendaraan di Gedung WTC 2', NULL, 'PP45-CAD EPSCC SHIFT 1', 'IDR', 45000.00000, '2023-06-20', NULL, 'DL SAP', 29, '2023-06-26 20:41:56', '2023-06-26 20:41:56'),
	(92, 'Gojek Rumah ke Kantor SAP', NULL, 'RB157407', 'IDR', 34500.00000, '2023-05-25', NULL, 'DL SAP', 30, '2023-06-26 20:59:38', '2023-06-26 20:59:38'),
	(93, 'Gojek Kantor SAP ke Rumah', NULL, 'RB178162', 'IDR', 42000.00000, '2023-05-25', NULL, 'DL SAP', 30, '2023-06-26 20:59:38', '2023-06-26 20:59:38'),
	(94, 'Pengiriman dokumen verifikasi ke Angkasa Pura 2 via JNE Yes', NULL, '14860013665523', 'IDR', 19000.00000, '2023-06-05', NULL, 'AP2', 31, '2023-06-26 21:01:07', '2023-06-26 21:01:07'),
	(95, 'Gojek Rumah ke RS Harapan Kita', NULL, 'RB139325', 'IDR', 38000.00000, '2023-06-07', NULL, 'HarKit', 32, '2023-06-26 21:02:32', '2023-06-26 21:02:32'),
	(96, 'Gojek RS Harapan Kita ke Rumah', NULL, 'RB116271', 'IDR', 31000.00000, '2023-06-07', NULL, 'HarKit', 32, '2023-06-26 21:02:32', '2023-06-26 21:02:32'),
	(97, 'Gojek Rumah ke Pertamina EP', NULL, 'RB116199', 'IDR', 40000.00000, '2023-06-12', NULL, 'KSO EC & NDBS', 33, '2023-06-26 21:04:10', '2023-06-26 21:04:10'),
	(98, 'Gojek Pertamina EP ke Rumah', NULL, 'RB169343', 'IDR', 32000.00000, '2023-06-12', NULL, 'KSO EC & NDBS', 33, '2023-06-26 21:04:10', '2023-06-26 21:04:10'),
	(99, 'Pengiriman Dokumen via JNE Yes', NULL, '14860014358523', 'IDR', 46000.00000, '2023-06-13', NULL, 'PKS Pertamina EP', 34, '2023-06-26 21:05:04', '2023-06-26 21:05:04'),
	(100, 'Pengiriman Dokumen NDA EC & Telkom Sigma ke kantor Eclectic', NULL, '14860015207523', 'IDR', 46000.00000, '2023-06-19', NULL, 'Telkom Sigma', 35, '2023-06-26 21:06:10', '2023-06-26 21:06:10'),
	(101, 'Gosend Bidbond dari Mandiri Keparpostel ke Rumah', NULL, 'GK9124494915', 'IDR', 41000.00000, '2023-06-21', NULL, 'TPPI', 36, '2023-06-26 21:08:27', '2023-06-26 21:08:27'),
	(102, 'Gojek Rumah ke kantor TPPI', NULL, 'RB190194', 'IDR', 20500.00000, '2023-06-21', NULL, 'TPPI', 37, '2023-06-26 21:09:45', '2023-06-26 21:09:45'),
	(103, 'Gojek TPPI ke Rumah', NULL, 'RB123391', 'IDR', 18000.00000, '2023-06-21', NULL, 'TPPI', 37, '2023-06-26 21:09:45', '2023-06-26 21:09:45'),
	(104, 'Ibis Sby City Center - Titus & Rofiq', NULL, 'MLDSDRNK', 'IDR', 1100380.00000, '2023-06-12', '2023-06-15', 'IJS', 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(105, 'Ibis Sby City Center - Titus', NULL, 'MLPSHRRX', 'IDR', 708795.00000, '2023-06-21', '2023-06-23', 'IJS', 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(106, 'Novotel Ngagel Sby - Titus', NULL, 'MLSSGPRV', 'IDR', 1050000.00000, '2023-06-25', '2023-06-28', 'IJS', 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(107, 'Ibis Sby City Center - Putri Nurfita Sari', NULL, 'MLVSCPZD', 'IDR', 750687.00000, '2023-06-25', '2023-06-27', 'BMI', 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(108, 'Fairfield by Marriott - Putri Nurfita Sari', NULL, '94752642', 'IDR', 700000.00000, '2023-07-04', '2023-07-06', 'IJS BMI', 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(109, 'Bluebird to Agung Sedayu', NULL, '62996972', 'IDR', 184700.00000, '2023-06-28', NULL, 'Agung Sedayu', 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(110, 'BlueBird to CGK Airport', NULL, '63005014', 'IDR', 83460.00000, '2023-06-28', NULL, NULL, 38, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(111, 'Grab Pagi', NULL, NULL, 'IDR', 71000.00000, '2023-06-20', NULL, 'SAP Workshop', 39, '2023-07-02 19:57:45', '2023-07-02 19:57:45'),
	(112, 'Grab Sore', NULL, NULL, 'IDR', 69000.00000, '2023-06-22', NULL, 'SAP Workshop', 39, '2023-07-02 19:57:45', '2023-07-02 19:57:45'),
	(113, 'uang makan team project lira', NULL, NULL, 'IDR', 450000.00000, '2023-06-26', '2023-06-30', 'Lira', 40, '2023-07-02 20:46:30', '2023-07-02 20:46:30'),
	(114, '19 Karcis Parkir Skyloft @5000', NULL, '1', 'IDR', 95000.00000, '2023-06-01', '2023-06-30', NULL, 41, '2023-07-03 01:22:49', '2023-07-03 01:22:49'),
	(115, 'BBM untuk keperluan kantor', NULL, '01662895', 'IDR', 25000.00000, '2023-06-01', '2023-06-30', NULL, 41, '2023-07-03 01:22:49', '2023-07-03 01:22:49'),
	(116, 'parkir bank mandiri', NULL, '3', 'IDR', 2000.00000, '2023-06-16', NULL, NULL, 41, '2023-07-03 01:22:49', '2023-07-03 01:22:49'),
	(117, 'pelunasan 12/PO/06/23 Flowernett Florist Salatiga', NULL, '0094570227', 'IDR', 200000.00000, '2023-07-02', NULL, NULL, 41, '2023-07-03 01:22:49', '2023-07-03 01:22:49'),
	(118, 'All Fresh Apartment', NULL, 'SGTS23052201136', 'IDR', 208191.00000, '2023-05-22', NULL, 'ASG, Nobel', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(119, 'Stasiun Railink Basoeta', NULL, 'L63J2VS', 'IDR', 50000.00000, '2023-06-05', NULL, 'Telkom, NTT IT, dan ASG', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(120, 'Monolog', NULL, 'Title:Ipad6', 'IDR', 136400.00000, '2023-06-05', NULL, 'Telkom, NTT IT', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(121, 'Coffee Bean & Tea Leaf', NULL, '07746-001-0127', 'IDR', 78500.00000, '2023-06-08', NULL, 'GKM', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(122, 'Bakerman One Satrio', NULL, 'A23000045081', 'IDR', 538000.00000, '2023-06-08', NULL, 'GKM', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(123, 'LinCafe-Ho', NULL, 'A23000010978', 'IDR', 654522.00000, '2023-06-12', NULL, NULL, 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(124, 'Tiket.com Hotel Omega Hotel Karawang', NULL, '1233657795', 'IDR', 902130.00000, '2023-05-24', '2023-05-26', 'ASG, Nobel', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(125, 'Tiket.com Tiket Pesawat Citilink HLP-SUB', NULL, '1233948932', 'IDR', 954149.00000, '2023-05-25', NULL, 'ASG, Nobel', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(126, 'Tiket.com Tiket Pesawat Super Air Jet SUB-CGK', NULL, '1234692860', 'IDR', 958557.00000, '2023-06-01', NULL, 'ASG', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(127, 'Tiket.com Batik Air SUB-CGK', NULL, '1235683425', 'IDR', 1491310.00000, '2023-06-05', NULL, 'Telkom', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(128, 'Tiket.com Tiket Pesawat Batik Air HLP-SUB', NULL, '1235806717', 'IDR', 858232.00000, '2023-06-08', NULL, 'GKM', 42, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(129, 'Beli Meterai @10000 3 Pcs', NULL, 'MA42-118-0706HK67', 'IDR', 36000.00000, '2023-06-07', NULL, 'Telkom Sigma', 46, '2023-07-04 23:57:54', '2023-07-04 23:57:54'),
	(130, 'Parkir RSAB Harapan Kita', NULL, '1875RKK', 'IDR', 4000.00000, '2023-06-07', NULL, 'RSAB Harapan Kita', 46, '2023-07-04 23:57:54', '2023-07-04 23:57:54'),
	(131, 'Very Brillyanto', NULL, '1', 'IDR', 1000000.00000, NULL, NULL, 'IJS', 54, '2023-07-05 00:39:45', '2023-07-05 00:39:45'),
	(132, 'Abdurrohman Ahmad Rofiq', NULL, '2', 'IDR', 1000000.00000, NULL, NULL, 'IJS', 54, '2023-07-05 00:39:45', '2023-07-05 00:39:45'),
	(133, 'Tiket Berangkat Project', NULL, '#1770318163669448679', 'IDR', 1269709.00000, '2023-07-06', NULL, 'PwC', 55, '2023-07-06 00:47:28', '2023-07-06 00:47:28'),
	(134, 'Bukti Transportasi ke Bandara KNO', NULL, '#1770320198224607207', 'IDR', 186500.00000, '2023-07-06', NULL, 'PwC', 55, '2023-07-06 00:47:28', '2023-07-06 00:47:28'),
	(135, 'Bukti Hotel di Jakarta (untuk cari kost-an)', NULL, '#1770320926689230282', 'IDR', 308750.00000, '2023-07-06', NULL, 'PwC', 55, '2023-07-06 00:47:28', '2023-07-06 00:47:28'),
	(136, 'Bukti Transportasi dari Bandara CGK ke Hotel Jkt', NULL, '#1770321421231226314', 'IDR', 158547.00000, '2023-07-06', NULL, 'PwC', 55, '2023-07-06 00:47:28', '2023-07-06 00:47:28'),
	(137, 'Gideon Pandu Winata', NULL, NULL, 'IDR', 142857.25000, '2023-06-02', NULL, 'SPINDO GS', 57, '2023-07-06 20:53:27', '2023-07-06 20:53:27'),
	(138, 'Gideon Pandu Winata', NULL, NULL, 'IDR', 142857.25000, '2023-06-06', NULL, 'Audit', 57, '2023-07-06 20:53:27', '2023-07-06 20:53:27'),
	(140, 'Gideon Pandu Winata ', NULL, NULL, 'IDR', 142857.25000, '2023-06-21', NULL, 'PCA', 57, '2023-07-06 20:53:27', '2023-07-06 20:53:27'),
	(142, 'Gideon Pandu Winata', NULL, NULL, 'IDR', 142857.25000, '2023-06-23', NULL, 'SF-IBM-DEMO', 57, '2023-07-06 20:53:27', '2023-07-06 20:53:27'),
	(145, '26 Karcis Parkir Skyloft Soho @10000', NULL, NULL, 'IDR', 260000.00000, '2023-05-31', '2023-07-07', 'Eclectic', 60, '2023-07-09 20:34:33', '2023-07-09 20:34:33'),
	(146, 'Uang Makan Team Project Lira', NULL, NULL, 'IDR', 675000.00000, '2023-07-03', '2023-07-07', 'Lira', 61, '2023-07-09 21:23:58', '2023-07-09 21:23:58'),
	(147, '7 Karcis Parkir Ciputra World @5000', NULL, NULL, 'IDR', 35000.00000, '2023-06-28', '2023-07-07', NULL, 62, '2023-07-09 22:00:47', '2023-07-09 22:00:47'),
	(148, 'Isi Bensin', NULL, '25715', 'IDR', 50000.00000, '2023-06-28', NULL, NULL, 62, '2023-07-09 22:00:47', '2023-07-09 22:00:47'),
	(149, 'Top Up Flazz BCA', NULL, '004298', 'IDR', 300000.00000, '2023-07-04', NULL, NULL, 62, '2023-07-09 22:00:47', '2023-07-09 22:00:47'),
	(150, 'Isi Bensin', NULL, '05.05.25734', 'IDR', 50000.00000, '2023-07-05', NULL, NULL, 62, '2023-07-09 22:00:47', '2023-07-09 22:00:47'),
	(151, 'Isi Bensin', NULL, '3635383', 'IDR', 445250.00000, '2023-07-08', NULL, NULL, 62, '2023-07-09 22:00:47', '2023-07-09 22:00:47'),
	(152, '2 Ballpoint untuk pak yacob TTD', NULL, '10183-03123005340', 'IDR', 68000.00000, '2023-07-10', NULL, NULL, 63, '2023-07-09 22:22:39', '2023-07-09 22:22:39'),
	(153, '1 kertas concorde untuk kwitansi', NULL, '10183-03123005340', 'IDR', 16000.00000, '2023-07-10', NULL, NULL, 63, '2023-07-09 22:22:39', '2023-07-09 22:22:39'),
	(154, 'Parkir Gramedia', NULL, 'PP31-SUCI', 'IDR', 5000.00000, '2023-07-10', NULL, NULL, 63, '2023-07-09 22:22:39', '2023-07-09 22:22:39'),
	(155, 'Paxel Kirim 2CEK BNI ke Nobel', NULL, 'OHPK57', 'IDR', 28000.00000, '2023-07-10', NULL, 'Nobel', 63, '2023-07-09 22:22:39', '2023-07-09 22:22:39'),
	(156, 'Tiket Arnes Travel Bandung - Purwakarta', NULL, 'BARN230704O7DL', 'IDR', 42000.00000, '2023-07-05', NULL, 'Indorama Purwakarta', 67, '2023-07-10 05:18:11', '2023-07-10 05:18:11'),
	(157, 'Tiket Arnes Travel Purwakarta - Bandung', NULL, 'BARN230707KZ5H', 'IDR', 42000.00000, '2023-07-07', NULL, 'Indorama Purwakarta', 67, '2023-07-10 05:18:11', '2023-07-10 05:18:11'),
	(158, 'Gocar', NULL, 'RB-174117-0218914', 'IDR', 105180.00000, '2023-07-07', NULL, 'Indorama Purwakarta', 67, '2023-07-10 05:18:11', '2023-07-10 05:18:11'),
	(159, 'Goride dari KPP madya dua ke CW', NULL, 'RB-131977', 'IDR', 7000.00000, '2023-07-10', NULL, 'KPP Madya Dua', 68, '2023-07-10 19:51:39', '2023-07-10 19:51:39'),
	(160, 'Goride dari KPP madya dua ke CW', NULL, 'RB-155482', 'IDR', 7500.00000, '2023-07-10', NULL, 'KPP Madya Dua', 68, '2023-07-10 19:51:39', '2023-07-10 19:51:39'),
	(161, 'Gocar Taman Kopo Indah 3 ke PT GDE Soreang', NULL, 'RB-154573-4869706', 'IDR', 60500.00000, '2023-07-11', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(162, 'Gocar PT GDE Soreang ke Taman Kopo Indah 3', NULL, 'RB-165135-3920478', 'IDR', 68000.00000, '2023-07-11', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(163, 'Gocar Taman Kopo Indah 3 ke PT GDE Soreang', NULL, 'RB-137210-3800957', 'IDR', 60500.00000, '2023-07-12', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(164, 'Gocar PT GDE Soreang ke Taman Kopo Indah 3', NULL, 'RB-122645-4889983', 'IDR', 66000.00000, '2023-07-12', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(165, 'Gocar Taman Kopo Indah 3 ke PT GDE Soreang', NULL, 'RB-107002-9825218', 'IDR', 60000.00000, '2023-07-13', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(166, 'Gocar PT GDE Soreang ke Taman Kopo Indah 3', NULL, 'RB-121007-1516941', 'IDR', 66500.00000, '2023-07-13', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(167, 'Gocar Taman Kopo Indah 3 ke PT GDE Soreang', NULL, 'RB-120939-0040904', 'IDR', 58500.00000, '2023-07-14', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(168, 'Gocar PT GDE Soreang ke Taman Kopo Indah 3', NULL, 'RB-139097-7658589', 'IDR', 68000.00000, '2023-07-14', NULL, 'GDE', 82, '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(169, 'uang makan team project lira', NULL, NULL, 'IDR', 500000.00000, '2023-07-10', '2023-07-14', 'Lira', 83, '2023-07-16 23:48:27', '2023-07-16 23:48:27');

-- Dumping structure for table eclectic.admin_reimbursement
CREATE TABLE IF NOT EXISTS `admin_reimbursement` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_diajukan` date DEFAULT NULL,
  `judul_doku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemohon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accounting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kasir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menyetujui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_timesheet_project` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_support_ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_support_lembur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `halaman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_approved` enum('rejected','pending','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rejected',
  `status_paid` enum('rejected','pending','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rejected',
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_persetujuan` date DEFAULT NULL,
  `no_referensi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp_direksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_reimbursement: ~60 rows (approximately)
DELETE FROM `admin_reimbursement`;
INSERT INTO `admin_reimbursement` (`id`, `no_doku`, `tgl_diajukan`, `judul_doku`, `pemohon`, `accounting`, `kasir`, `menyetujui`, `bukti_timesheet_project`, `bukti_support_ticket`, `bukti_support_lembur`, `halaman`, `status_approved`, `status_paid`, `alasan`, `tgl_persetujuan`, `no_referensi`, `no_telp_direksi`, `created_at`, `updated_at`) VALUES
	(1, '00001/RB/VI/23', '2023-06-06', 'Uang Makan Team Project Lira', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-05', NULL, NULL, '2023-06-05 21:52:20', '2023-06-05 21:52:20'),
	(2, '00002/RB/VI/23', '2023-06-06', 'Dinas Onsite PT. Sido Muncul', 'Ari Dwiyanto', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-06', NULL, NULL, '2023-06-05 22:12:27', '2023-06-05 22:12:27'),
	(3, '00003/RB/VI/23', '2023-06-06', 'Pre-Sales  Agung Sedayu Group', 'Galih Devi Saptarini', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-08', NULL, NULL, '2023-06-05 22:17:07', '2023-06-05 22:17:07'),
	(4, '00004/RB/VI/23', '2023-06-06', 'Kirim Dokumen & Parkir Skyloft Soho', 'Novi', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-26', NULL, NULL, '2023-06-05 22:20:53', '2023-06-05 22:20:53'),
	(5, '00005/RB/VI/23', '2023-06-06', 'Parkir Skyloft & DL Bank', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-06', NULL, NULL, '2023-06-05 22:24:07', '2023-06-05 22:24:07'),
	(6, '00006/RB/VI/23', '2023-06-06', 'DL IJS-Presales-Parkir CW', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-06', NULL, NULL, '2023-06-05 22:29:41', '2023-06-05 22:29:41'),
	(7, '00007/RB/VI/23', '2023-06-08', 'Timesheet Project PT. Geodipa Energi Mei 2023', 'Yulianto', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '1686198790_C:\\Users\\asus\\AppData\\Local\\Temp\\php4B7F.tmp.pdf', NULL, NULL, 'TS', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-07 21:33:10', '2023-06-07 21:33:10'),
	(8, '00008/RB/VI/23', '2023-06-08', 'Timesheet Project DSN Group Mei 2023', 'Anang Fauzi Kurniawan', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '1686202412.pdf', NULL, NULL, 'TS', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-07 22:33:32', '2023-06-07 22:33:32'),
	(9, '00009/RB/VI/23', '2023-06-08', 'Timesheet Project IJS Mei 2023', 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '1686205124.pdf', NULL, NULL, 'TS', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(10, '00010/RB/VI/23', '2023-06-08', 'Timesheet Project PT. Permata Husada Sentosa (PHS) Mei 2023', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '1686206844.pdf', NULL, NULL, 'TS', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(11, '00011/RB/VI/23', '2023-06-08', 'Timesheet PWC Mei 2023', 'Stefanus Daniel', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '1686207531.pdf', NULL, NULL, 'TS', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-07 23:58:51', '2023-06-07 23:58:51'),
	(12, '00012/RB/VI/23', '2023-06-08', 'Timesheet Project BIG-RPJ Mei 2023', 'Abdurrohman Ahmad Rofiq', 'Naumi. T. R', 'Suzy. A', 'Sujiono', '1686208986.pdf', NULL, NULL, 'TS', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-08 00:23:06', '2023-06-08 00:23:06'),
	(13, '00013/RB/VI/23', '2023-06-09', 'Timesheet Support Ticket Jarvies Mei 2023', 'Santo Suharyono', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, '1686288474.pdf', NULL, 'ST', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(14, '00014/RB/VI/23', '2023-06-09', 'Timesheet Support Lemburan Mei 2023', 'Santo Suharyono', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, '1686290002.pdf', NULL, 'SL', 'approved', 'paid', NULL, '2023-06-09', NULL, NULL, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(15, '00015/RB/VI/23', '2023-06-12', 'Dinas Onsite Go-Live Support for Indorama Cilegon 22 Mei 2023 - 9 Juli 2023', 'Daniel Rivaldo Gunawan', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-13', NULL, NULL, '2023-06-11 23:55:01', '2023-06-11 23:55:01'),
	(16, '00016/RB/VI/23', '2023-06-12', 'Uang Makan Team Project Lira 05/06-09/06', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-13', NULL, NULL, '2023-06-12 01:01:01', '2023-06-12 01:01:01'),
	(17, '00017/RB/VI/23', '2023-06-12', 'Dinas Onsite PT. Indra Jaya Swastika (IJS)', 'Very Briliyanto', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-13', NULL, NULL, '2023-06-12 01:13:59', '2023-06-12 01:13:59'),
	(18, '00018/RB/VI/23', '2023-06-12', 'Dinas Training PT MEDCO - PERTAMINA BOGOR 05 - 09 Juni 2023', 'Hermes Budi Setiawan', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-13', NULL, NULL, '2023-06-12 22:53:07', '2023-06-12 22:53:07'),
	(19, '00019/RB/VI/23', '2023-06-13', 'Kirim Dokumen Marketing', 'Devi', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-13 02:59:58', '2023-06-13 02:59:58'),
	(20, '00020/RB/VI/23', '2023-06-19', 'Uang Makan Team Project Lira 12/06-16/06', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-18 23:10:54', '2023-06-18 23:10:54'),
	(21, '00021/RB/VI/23', '2023-06-20', 'Parkir Skyloft Soho', 'Naumi. T. R', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-19 20:07:50', '2023-06-19 20:07:50'),
	(22, '00022/RB/VI/23', '2023-06-21', 'Konsumsi Tamu Telkom Sigma & Keperluan Kantor', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-20 22:06:12', '2023-06-20 22:06:12'),
	(23, '00023/RB/VI/23', '2023-06-21', 'Kirim Dokumen BAST', 'Angel', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-20 22:12:47', '2023-06-20 22:12:47'),
	(24, '00024/RB/VI/23', '2023-06-22', 'Kirim Dokumen', 'Angel', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-22 01:20:05', '2023-06-22 01:20:05'),
	(25, '00025/RB/VI/23', '2023-06-22', 'Dinas Onsite Go-Live Support for PT. Geo Dipa Energi 12 - 21 Juni 2023', 'Daniel Rivaldo Gunawan', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-22 02:37:49', '2023-06-22 02:37:49'),
	(26, '00026/RB/VI/23', '2023-06-23', 'Training SAP GLX Workshop 20-22 Juni 2023', 'Loisa Christina', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-23 00:05:23', '2023-06-23 00:05:23'),
	(27, '00027/RB/VI/23', '2023-06-26', 'Uang Makan Team Project Lira 19/06/2023 s/d 23/06/2023', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-25 19:52:42', '2023-06-25 19:52:42'),
	(28, '00028/RB/VI/23', '2023-06-26', 'Projek Training Pasar Jaya & Pre-Sale POC Tawada', 'Abdurrohman Ahmad Rofiq', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-25 23:40:18', '2023-06-25 23:40:18'),
	(29, '00029/RB/VI/23', '2023-06-27', 'Workshop SAP Public Cloud di SAP Indonesia WTC2 (20, 21, 22 Juni 2023)', 'Very Briliyanto', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'ST', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-26 20:41:56', '2023-06-26 20:41:56'),
	(30, '00030/RB/VI/23', '2023-06-27', 'SAP Enablement PI-PO Integration Suite, 25 Mei 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 20:59:38', '2023-06-26 20:59:38'),
	(31, '00031/RB/VI/23', '2023-06-27', 'Pengiriman Dokumen Administrasi  Verifikasi Tender AP2, 5 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:01:07', '2023-06-26 21:01:07'),
	(32, '00032/RB/VI/23', '2023-06-27', 'Presentasi Eclectic Consulting di RS Harapan Kita, 7 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:02:32', '2023-06-26 21:02:32'),
	(33, '00033/RB/VI/23', '2023-06-27', 'Pengambilan Dokumen PKS Pertamina EP - KSO EC & NDBS, 12 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:04:10', '2023-06-26 21:04:10'),
	(34, '00034/RB/VI/23', '2023-06-27', 'Pengiriman Dokumen PKS Pertamina EP ke kantor Eclectic, 13 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:05:04', '2023-06-26 21:05:04'),
	(35, '00035/RB/VI/23', '2023-06-27', 'Pengiriman Dokumen NDA EC & Telkom Sigma, 19 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:06:10', '2023-06-26 21:06:10'),
	(36, '00036/RB/VI/23', '2023-06-27', 'Pengiriman Surat Penawaran Harga Eclectic ke TPPI, 21 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:08:27', '2023-06-26 21:08:27'),
	(37, '00037/RB/VI/23', '2023-06-27', 'Pengiriman Surat Penawaran Harga Eclectic ke kantor TPPI, 21 Juni 2023', 'Pamella', 'Naumi. T. R', 'Suzy. A', 'Richard', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, '2023-06-27', NULL, NULL, '2023-06-26 21:09:45', '2023-06-26 21:09:45'),
	(38, '00038/RB/VI/23', '2023-06-30', 'Akomodasi DL IJS, BMI, dan Agung Sedayu', 'Richard', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'paid', NULL, NULL, NULL, NULL, '2023-06-29 20:29:46', '2023-06-29 20:29:46'),
	(39, '00004/RB/VII/23', '2023-07-03', 'SAP S4 Hana Cloud, Public Edition Workshop', 'Galih Devi Saptarini', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-07', NULL, NULL, '2023-07-02 19:57:45', '2023-07-02 19:57:45'),
	(40, '00001/RB/VII/23', '2023-07-03', 'Reimbursement uang Makan Team Project Lira 26/06/2023 s/d 30/06/2023', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-04', NULL, NULL, '2023-07-02 20:46:30', '2023-07-02 20:46:30'),
	(41, '00002/RB/VII/23', '2023-07-03', 'Keperluan Kantor', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-04', NULL, NULL, '2023-07-03 01:22:49', '2023-07-03 01:22:49'),
	(42, '00003/RB/VII/23', '2023-07-03', 'Akomodasi Dinas Luar 22/05/2023 - 08/06/2023', 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, NULL, NULL, NULL, '2023-07-03 02:49:39', '2023-07-03 02:49:39'),
	(43, '00005/RB/VII/23', '2023-07-04', 'Timesheet Project Lira Juni 2023', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'approved', 'pending', NULL, NULL, NULL, NULL, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(44, '00006/RB/VII/23', '2023-07-04', 'Timesheet Project IJS Juni 2023', 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'approved', 'pending', NULL, NULL, NULL, NULL, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(45, '00007/RB/VII/23', '2023-07-04', 'Timesheet Project GDE Juni 2023', 'Yulianto', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'approved', 'pending', NULL, NULL, NULL, NULL, '2023-07-04 03:36:39', '2023-07-04 03:36:39'),
	(46, '00008/RB/VII/23', '2023-07-05', 'Kepeluan Project Telkom Sigma dan RSAB Harapan Kita', 'Yacob', 'Naumi. T. R', 'Suzy. A', 'Aris', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-05', NULL, NULL, '2023-07-04 23:57:54', '2023-07-04 23:57:54'),
	(54, '00009/RB/VII/23', '2023-07-05', 'Start Project IJS', 'Abdul Mubin', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-05', NULL, NULL, '2023-07-05 00:39:45', '2023-07-05 00:39:45'),
	(55, '00010/RB/VII/23', '2023-07-06', 'Project Indorama (Support PwC)', 'Puteri Amira Syifani', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-07', NULL, NULL, '2023-07-06 00:47:28', '2023-07-06 00:47:28'),
	(56, '00011/RB/VII/23', '2023-07-07', 'TImesheet Project Training SAP Juni 2023', 'Titus Obaja', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'approved', 'pending', NULL, '2023-07-10', NULL, NULL, '2023-07-06 20:35:57', '2023-07-06 20:35:57'),
	(57, '00012/RB/VII/23', '2023-07-07', 'Timesheet Basis Juni 2023', 'Gideon Pandu Winata', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-10', NULL, NULL, '2023-07-06 20:53:27', '2023-07-06 20:53:27'),
	(58, '00013/RB/VII/23', '2023-07-07', 'Timesheet Project PwC Juni 2023', 'Stefanus Daniel', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'approved', 'pending', NULL, '2023-07-10', NULL, '+62 881-3236-918', '2023-07-06 23:03:42', '2023-07-06 23:03:42'),
	(59, '00014/RB/VII/23', '2023-07-07', 'Timesheet Project GDE Juni 2023', 'Stefanus Daniel', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'approved', 'pending', NULL, '2023-07-10', NULL, '+62 881-3236-918', '2023-07-06 23:05:17', '2023-07-06 23:05:17'),
	(60, '00015/RB/VII/23', '2023-07-10', 'Parkir Skyloft Soho', 'Zhomi', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-10', NULL, '+62 881-3236-918', '2023-07-09 20:34:33', '2023-07-09 20:34:33'),
	(61, '00016/RB/VII/23', '2023-07-10', 'Reimbursement uang Makan Team Project Lira 03/07/2023 s/d 07/07/2023', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-10', NULL, NULL, '2023-07-09 21:23:58', '2023-07-09 21:23:58'),
	(63, '00017/RB/VII/23', '2023-07-10', 'Keperluan Kantor', 'Suzy. A', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-10', NULL, NULL, '2023-07-09 22:22:39', '2023-07-09 22:22:39'),
	(65, '00018/RB/VII/23', '2023-07-10', 'Timesheet Support Ticket Jarvies Bulan Juni 2023', 'Santo Suharyono', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'ST', 'approved', 'pending', NULL, '2023-07-10', NULL, NULL, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(66, '00019/RB/VII/23', '2023-07-10', 'Timesheet Support Lemburan Bulan Juni 2023', 'Santo Suharyono', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'SL', 'approved', 'pending', NULL, '2023-07-10', NULL, NULL, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(67, '00020/RB/VII/23', '2023-07-10', 'Dinas Onsite Refresher Training for Indorama Purwakarta 5 Juli 2023 - 7 Juli 2023', 'Daniel Rivaldo Gunawan', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'pending', 'pending', NULL, '2023-07-11', NULL, NULL, '2023-07-10 05:18:11', '2023-07-10 05:18:11'),
	(68, '00021/RB/VII/23', '2023-07-10', 'Perjalanan Dinas ke KPP Madya Dua', 'Angelia Agatha', 'Naumi. T. R', 'Suzy. A', 'Yacob', NULL, NULL, NULL, 'RB', 'pending', 'pending', NULL, NULL, NULL, NULL, '2023-07-10 19:51:39', '2023-07-10 19:51:39'),
	(69, '00022/RB/VII/23', '2023-07-12', 'Timesheet Project DSN Group Juni 2023', 'Anang Fauzi Kurniawan', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'TS', 'pending', 'pending', NULL, NULL, NULL, '+62 881-3236-918', '2023-07-11 20:14:37', '2023-07-11 20:14:37'),
	(82, '00023/RB/VII/23', '2023-07-17', 'Dinas Onsite AMS PT. Geo Dipa Energi 11 - 14 Juli 2023', 'Daniel Rivaldo Gunawan', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-17', NULL, '+62 881-3236-918', '2023-07-16 20:32:25', '2023-07-16 20:32:25'),
	(83, '00024/RB/VII/23', '2023-07-17', 'Reimbursement Uang Makan Team Project Lira 10/07/2023 s/d 14/07/2023', 'Mohammad Fariz Hadian', 'Naumi. T. R', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, 'RB', 'approved', 'pending', NULL, '2023-07-17', NULL, '+62 881-3236-918', '2023-07-16 23:48:27', '2023-07-16 23:48:27');

-- Dumping structure for table eclectic.admin_support_lembur_detail
CREATE TABLE IF NOT EXISTS `admin_support_lembur_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aliases` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_awal` int DEFAULT NULL,
  `jam` float DEFAULT NULL,
  `fk_support_lembur` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_support_lembur_detail_fk_support_lembur_foreign` (`fk_support_lembur`),
  CONSTRAINT `admin_support_lembur_detail_fk_support_lembur_foreign` FOREIGN KEY (`fk_support_lembur`) REFERENCES `admin_reimbursement` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_support_lembur_detail: ~17 rows (approximately)
DELETE FROM `admin_support_lembur_detail`;
INSERT INTO `admin_support_lembur_detail` (`id`, `nama_karyawan`, `aliases`, `curr`, `nominal_awal`, `jam`, `fk_support_lembur`, `created_at`, `updated_at`) VALUES
	(1, 'Stefanus Daniel', 'GDE', 'IDR', 80000, 24.5, 14, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(2, 'Stefanus Daniel', 'PWC', 'IDR', 80000, 13, 14, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(3, 'Stefanus Daniel', 'Medco', 'IDR', 80000, 4, 14, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(4, 'Dony Setiawan', 'GDE', 'IDR', 80000, 123, 14, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(5, 'Tegar Muharyana Putra', 'GDE', 'IDR', 80000, 48, 14, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(6, 'Dimas Zaky', 'Lira Medika', 'IDR', 80000, 36, 14, '2023-06-08 22:53:22', '2023-06-08 22:53:22'),
	(7, 'Stefanus Daniel', 'Medco', 'IDR', 80000, 14, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(8, 'Stefanus Daniel', 'GDE', 'IDR', 80000, 31, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(9, 'Stefanus Daniel', 'IJS', 'IDR', 80000, 6, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(10, 'Bramila Ghina Luthfy', 'BGR', 'IDR', 80000, 24, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(11, 'Antonius Cahyadi Sutanto', 'Lira Medika', 'IDR', 80000, 68, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(12, 'Antonius Cahyadi Sutanto', 'IJS', 'IDR', 80000, 7, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(13, 'Dony Setiawan', 'GDE', 'IDR', 80000, 60, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(14, 'Galih Devi Saptarini', 'BLI', 'IDR', 80000, 10, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(16, 'Meliza Fatmawati', 'IJS', 'IDR', 80000, 26, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21'),
	(17, 'Tegar Muharyana Putra', 'GDE', 'IDR', 80000, 60, 66, '2023-07-09 23:06:21', '2023-07-09 23:06:21');

-- Dumping structure for table eclectic.admin_support_ticket_detail
CREATE TABLE IF NOT EXISTS `admin_support_ticket_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aliases` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_awal` int DEFAULT NULL,
  `jam` int DEFAULT NULL,
  `fk_support_ticket` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_support_ticket_detail_fk_support_ticket_foreign` (`fk_support_ticket`),
  CONSTRAINT `admin_support_ticket_detail_fk_support_ticket_foreign` FOREIGN KEY (`fk_support_ticket`) REFERENCES `admin_reimbursement` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_support_ticket_detail: ~33 rows (approximately)
DELETE FROM `admin_support_ticket_detail`;
INSERT INTO `admin_support_ticket_detail` (`id`, `nama_karyawan`, `aliases`, `curr`, `nominal_awal`, `jam`, `fk_support_ticket`, `created_at`, `updated_at`) VALUES
	(1, 'Ari Dwiyanto', 'SSN', 'IDR', 80000, 6, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(2, 'Ari Dwiyanto', 'Talasi', 'IDR', 80000, 1, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(3, 'Christian Indra Wijaya', 'Pindad', 'IDR', 80000, 6, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(4, 'Abdurrohman Ahmad Rofiq', 'Pindad', 'IDR', 80000, 8, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(5, 'Abdurrohman Ahmad Rofiq', 'Pasarjaya', 'IDR', 80000, 11, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(6, 'Arbin Hanley Saputra', 'SPN', 'IDR', 80000, 9, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(7, 'Arifatul Islamiyah', 'Haldin', 'IDR', 80000, 11, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(8, 'Bramila Ghina Luthfy', 'Pindad', 'IDR', 80000, 10, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(9, 'Dimas Zaky', 'Pindad', 'IDR', 80000, 12, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(10, 'Galih Devi Saptarini', 'Pindad', 'IDR', 80000, 8, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(11, 'Galih Devi Saptarini', 'SUPERNOVA', 'IDR', 80000, 4, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(12, 'Galih Devi Saptarini', 'Pasarjaya', 'IDR', 80000, 28, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(13, 'Loisa Christina', 'Talasi', 'IDR', 80000, 2, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(14, 'Loisa Christina', 'SUPERNOVA', 'IDR', 80000, 8, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(15, 'Nofi Ardini', 'SUPERNOVA', 'IDR', 80000, 6, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(16, 'Nofi Ardini', 'SPN', 'IDR', 80000, 19, 13, '2023-06-08 22:27:54', '2023-06-08 22:27:54'),
	(18, 'Loisa Christina', 'SUPERNOVA', 'IDR', 80000, 5, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(19, 'Loisa Christina', 'GDE', 'IDR', 80000, 3, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(20, 'Ari Dwiyanto', 'SSN', 'IDR', 80000, 8, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(21, 'Ari Dwiyanto', 'TALASI', 'IDR', 80000, 5, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(22, 'Abdurrohman Ahmad Rofiq', 'APF', 'IDR', 80000, 12, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(23, 'Abdurrohman Ahmad Rofiq', 'Tzu Chi Hospital', 'IDR', 80000, 4, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(24, 'Abdurrohman Ahmad Rofiq', 'Haldin', 'IDR', 80000, 6, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(25, 'Galih Devi Saptarini', 'SUPERNOVA', 'IDR', 80000, 17, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(26, 'Galih Devi Saptarini', 'APF', 'IDR', 80000, 14, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(27, 'Galih Devi Saptarini', 'Pasarjaya', 'IDR', 80000, 25, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(28, 'Gideon Pandu Winata', 'Pasarjaya', 'IDR', 80000, 12, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(29, 'Gideon Pandu Winata', 'SAKA', 'IDR', 80000, 14, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(30, 'Gideon Pandu Winata', 'GDE', 'IDR', 80000, 23, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(31, 'Meliza Fatmawati', 'APF', 'IDR', 80000, 24, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(32, 'Nofi Ardini', 'Pasarjaya', 'IDR', 80000, 34, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(33, 'Very Briliyanto', 'Talasi', 'IDR', 80000, 3, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18'),
	(34, 'Very Briliyanto', 'SSN', 'IDR', 80000, 3, 65, '2023-07-09 22:47:18', '2023-07-09 22:47:18');

-- Dumping structure for table eclectic.admin_timesheet_project_detail
CREATE TABLE IF NOT EXISTS `admin_timesheet_project_detail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_karyawan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `curr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_awal` int DEFAULT NULL,
  `hari_awal` int DEFAULT NULL,
  `hari` int DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  `fk_timesheet_project` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_timesheet_project_detail_fk_timesheet_project_foreign` (`fk_timesheet_project`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.admin_timesheet_project_detail: ~70 rows (approximately)
DELETE FROM `admin_timesheet_project_detail`;
INSERT INTO `admin_timesheet_project_detail` (`id`, `nama_karyawan`, `curr`, `nominal_awal`, `hari_awal`, `hari`, `nominal`, `fk_timesheet_project`, `created_at`, `updated_at`) VALUES
	(1, 'Yulianto', 'IDR', 3000000, 21, 21, 3000000, 7, '2023-06-07 21:33:10', '2023-06-07 21:33:10'),
	(2, 'Made Jeremy Bern Bryan', 'IDR', 3000000, 21, 14, 2000000, 7, '2023-06-07 21:33:10', '2023-06-07 21:33:10'),
	(3, 'Austine Faria Kusuma', 'IDR', 3000000, 21, 10, 1428571, 7, '2023-06-07 21:33:10', '2023-06-07 21:33:10'),
	(4, 'Galih Devi Saptarini', 'IDR', 3000000, 21, 11, 1571429, 8, '2023-06-07 22:33:32', '2023-06-07 22:33:32'),
	(5, 'Arifatul Islamiyah', 'IDR', 3000000, 21, 10, 1428571, 8, '2023-06-07 22:33:32', '2023-06-07 22:33:32'),
	(6, 'Abdul Mubin', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(7, 'Agus Dwi Priyono', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(8, 'Arbin Hanley Saputra', 'IDR', 3000000, 21, 20, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(9, 'Aziz Ihza Fauzan', 'IDR', 3000000, 21, 11, 1571429, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(10, 'Dimas Zaky', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(11, 'Dony Setiawan', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(12, 'Gideon Panduwinata', 'IDR', 3000000, 21, 16, 2285714, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(13, 'Hermes Budi Setiawan', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(14, 'Made Jeremy Bern Bryan', 'IDR', 3000000, 21, 2, 285714, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(15, 'Meliza Fatmawati', 'IDR', 3000000, 21, 6, 857143, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(16, 'Nofi Ardini', 'IDR', 3000000, 21, 8, 1142857, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(17, 'Tegar Muharyana Putra', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(18, 'Usman Adi Nugroho', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(19, 'Yoyok Aprilyanto', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(20, 'Christian Indra Wijaya', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-07 23:18:44', '2023-06-07 23:18:44'),
	(21, 'Mohammad Fariz Hadian', 'IDR', 3000000, 21, 21, 3000000, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(22, 'Antonius Cahyadi Sutanto', 'IDR', 3000000, 21, 14, 2000000, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(23, 'Basilia Manuela Arifin', 'IDR', 3000000, 21, 21, 3000000, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(24, 'Bramila Ghina Luthfy', 'IDR', 3000000, 21, 21, 3000000, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(25, 'Loisa Christina', 'IDR', 3000000, 21, 17, 2428571, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(26, 'Nofi Ardini', 'IDR', 3000000, 21, 12, 1714286, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(27, 'Stefanus Daniel', 'IDR', 3000000, 21, 21, 3000000, 10, '2023-06-07 23:47:24', '2023-06-07 23:47:24'),
	(28, 'Tjendrawasih Rau', 'IDR', 3000000, 21, 21, 3000000, 10, '2023-06-13 04:24:06', '2023-06-13 04:24:07'),
	(29, 'Daniel Rivaldo Gunawan', 'IDR', 3000000, 21, 19, 3000000, 11, '2023-06-07 23:58:51', '2023-06-07 23:58:51'),
	(30, 'Abdurrohman Ahmad Rofiq', 'IDR', 3000000, 21, 10, 1428571, 12, '2023-06-08 00:23:06', '2023-06-08 00:23:06'),
	(31, 'Galih Devi Saptarini', 'IDR', 3000000, 21, 10, 1428571, 12, '2023-06-08 00:23:06', '2023-06-08 00:23:06'),
	(32, 'Puteri Amira Syifani', 'IDR', 3000000, 21, 11, 1571429, 12, '2023-06-08 00:23:06', '2023-06-08 00:23:06'),
	(33, 'Ign Excel Ekaristi Verares', 'IDR', 3000000, 21, 21, 3000000, 9, '2023-06-16 06:13:12', '2023-06-16 06:13:13'),
	(34, 'Loisa Christina', 'IDR', 3000000, 21, 16, 2285714, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(35, 'Bramila Ghina Luthfy', 'IDR', 3000000, 21, 18, 2571429, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(36, 'Basilia Manuela Arifin', 'IDR', 3000000, 21, 19, 3000000, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(37, 'Tjendrawasih Rau', 'IDR', 3000000, 21, 19, 3000000, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(38, 'Stefanus Daniel', 'IDR', 3000000, 21, 19, 3000000, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(39, 'Mohammad Fariz Hadian', 'IDR', 3000000, 21, 19, 3000000, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(40, 'Nofi Ardini', 'IDR', 3000000, 21, 17, 2428571, 43, '2023-07-04 02:59:41', '2023-07-04 02:59:41'),
	(41, 'Abdul Mubin', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(42, 'Abdurrohman Ahmad Rofiq', 'IDR', 3000000, 21, 12, 1714286, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(43, 'Agus Dwi Priyono', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(44, 'Arbin Hanley Saputra', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(45, 'Arifatul Islamiyah', 'IDR', 3000000, 21, 18, 2571429, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(46, 'Aziz Ihza Fauzan', 'IDR', 3000000, 21, 14, 2000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(47, 'Christian Indra Wijaya', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(48, 'Dimas Zaky', 'IDR', 3000000, 21, 7, 1000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(49, 'Dony Setiawan', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(50, 'Gideon Pandu Winata', 'IDR', 3000000, 21, 17, 2428571, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(51, 'Hermes Budi Setiawan', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(52, 'Ign Excel Ekaristi Verares', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(53, 'Made Jeremy Bern Bryan', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(54, 'Nofi Ardini', 'IDR', 3000000, 21, 4, 571429, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(55, 'Septian Nur Indah Pramaishella', 'IDR', 3000000, 21, 10, 1428571, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(56, 'Tegar Muharyana Putra', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(57, 'Usman Adi Nugroho', 'IDR', 3000000, 21, 18, 2571429, 44, '2023-07-04 03:20:10', '2023-07-04 03:20:10'),
	(58, 'Very Briliyanto', 'IDR', 3000000, 21, 17, 2428571, 44, NULL, NULL),
	(59, 'Yoyok Apriliyanto', 'IDR', 3000000, 21, 20, 3000000, 44, '2023-07-04 10:29:20', NULL),
	(60, 'Yulianto', 'IDR', 3000000, 21, 20, 3000000, 45, '2023-07-04 03:36:39', '2023-07-04 03:36:39'),
	(61, 'Galih Devi Saptarini', 'IDR', 3000000, 21, 1, 142857, 44, NULL, NULL),
	(62, 'Galih Devi Saptarini', 'IDR', 3000000, 21, 3, 428571, 56, '2023-07-06 20:35:57', '2023-07-06 20:35:57'),
	(63, 'Bramila Ghina Luthfy', 'IDR', 3000000, 21, 3, 428571, 56, '2023-07-06 20:35:57', '2023-07-06 20:35:57'),
	(64, 'Very Briliyanto', 'IDR', 3000000, 21, 3, 428571, 56, '2023-07-06 20:35:57', '2023-07-06 20:35:57'),
	(65, 'Loisa Christina', 'IDR', 3000000, 21, 3, 428571, 56, '2023-07-06 20:35:57', '2023-07-06 20:35:57'),
	(66, 'Abdurrohman Ahmad Rofiq', 'IDR', 3000000, 21, 3, 428571, 56, '2023-07-06 20:35:57', '2023-07-06 20:35:57'),
	(68, 'Daniel Rivaldo Gunawan', 'IDR', 3000000, 21, 7, 1000000, 58, '2023-07-06 23:03:42', '2023-07-06 23:03:42'),
	(69, 'Daniel Rivaldo Gunawan', 'IDR', 3000000, 21, 10, 1428571, 59, '2023-07-06 23:05:17', '2023-07-06 23:05:17'),
	(70, 'Puteri Amira Syifani', 'IDR', 3000000, 21, 4, 571429, 58, '2023-07-06 23:05:17', '2023-07-06 23:05:17'),
	(71, 'Galih Devi Saptarini', 'IDR', 3000000, 21, 11, 1571429, 69, '2023-07-11 20:14:37', '2023-07-11 20:14:37');

-- Dumping structure for table eclectic.client
CREATE TABLE IF NOT EXISTS `client` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_project` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_perusahaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aliases` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.client: ~21 rows (approximately)
DELETE FROM `client`;
INSERT INTO `client` (`id`, `kode_project`, `nama_perusahaan`, `aliases`, `group`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'PT. Sewu Segar Nusantara', 'SSN', NULL, NULL, NULL),
	(2, NULL, 'PT. Asia Pacific Fibers, Tbk', 'APF', NULL, NULL, NULL),
	(3, NULL, 'PT. Indra Jaya Swastika', 'IJS', NULL, NULL, NULL),
	(4, NULL, 'PT. Surya Pertiwi Nusantara', 'SPN', NULL, NULL, NULL),
	(5, 'QT/05/IN/03042/2021', 'PT. Permata Husada Sentosa', 'PHS', NULL, NULL, NULL),
	(6, 'QT/08/IN/16086/2022', 'Panarub Industry Group', 'Panarub', NULL, NULL, NULL),
	(7, NULL, 'PT. Endo Indonesia', 'Endo', NULL, NULL, NULL),
	(8, NULL, 'PT TOYA KONSEP ALAM', 'Talasi', NULL, NULL, NULL),
	(9, NULL, 'PT. Supernova Flexible Packaging', 'SUPERNOVA', NULL, NULL, NULL),
	(10, NULL, 'PT. Ecogreen Oleochemicals', 'Ecogreen', NULL, NULL, NULL),
	(11, 'QT/02/IN/28023/2022', 'PERUMDA PASAR JAYA', 'Pasarjaya', NULL, NULL, NULL),
	(12, NULL, 'PT. Pindad (Persero)', 'Pindad', NULL, NULL, NULL),
	(13, 'QT/07/IN/13073/2022', 'PT. Haldin Pacific Semesta', 'Haldin', NULL, NULL, NULL),
	(14, NULL, 'PT Bina Selaras Medika', 'Lira Medika', NULL, NULL, NULL),
	(15, 'GL/01/SM/IN/17013/2023', 'PT. Geo Dipa Energi', 'GDE', NULL, NULL, NULL),
	(16, NULL, 'PwC', 'PWC', NULL, NULL, NULL),
	(17, NULL, 'Medco', 'Medco', NULL, NULL, NULL),
	(18, NULL, 'Tzu Chi Hospital', 'Tzu Chi Hospital', NULL, NULL, NULL),
	(19, NULL, 'SAKA INDONESIA PANGKAH LTD', 'Saka', NULL, NULL, NULL),
	(20, NULL, 'BGR', 'BGR', NULL, NULL, NULL),
	(21, NULL, 'BLI', 'BLI', NULL, NULL, NULL);

-- Dumping structure for table eclectic.failed_jobs
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

-- Dumping data for table eclectic.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table eclectic.fee_project
CREATE TABLE IF NOT EXISTS `fee_project` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nominal` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.fee_project: ~1 rows (approximately)
DELETE FROM `fee_project`;
INSERT INTO `fee_project` (`id`, `nominal`, `created_at`, `updated_at`) VALUES
	(1, 80000, NULL, NULL);

-- Dumping structure for table eclectic.fee_timesheet
CREATE TABLE IF NOT EXISTS `fee_timesheet` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hari` int DEFAULT NULL,
  `nominal` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.fee_timesheet: ~1 rows (approximately)
DELETE FROM `fee_timesheet`;
INSERT INTO `fee_timesheet` (`id`, `hari`, `nominal`, `created_at`, `updated_at`) VALUES
	(1, 21, 3000000, NULL, NULL);

-- Dumping structure for table eclectic.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `karyawan_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.karyawan: ~42 rows (approximately)
DELETE FROM `karyawan`;
INSERT INTO `karyawan` (`id`, `email`, `nama`, `jabatan`, `password`, `no_rekening`, `bank`, `signature`, `created_at`, `updated_at`) VALUES
	(1, 'fariz@eclectic.co.id', 'Mohammad Fariz Hadian', 'Project Manager', '$2y$10$PX1piYgculbDytxXqaqUw.y7lDDJQ/QKzcRrhPAlg2PrKLdF8C0Ki', '1360011797575', 'Mandiri', 'NULL', '2023-06-09 03:39:22', NULL),
	(2, 'ari.dwiyanto@eclectic.co.id', 'Ari Dwiyanto', 'Konsultan', '$2y$10$83oHMGFygwJVW6Qthz3osuS.JcG/uMhr9ME1YkHs1G9QicrBev5d2', NULL, NULL, NULL, NULL, NULL),
	(3, 'galih@eclectic.co.id', 'Galih Devi Saptarini', 'Konsultan', '$2y$10$8iPZnegyRoO81hR5AwS3dODXMzpWIXeZoVRAfucb7bbL88eiIknmi', NULL, NULL, NULL, NULL, NULL),
	(4, 'novi.anggreani@eclectic.co.id', 'Novi', 'Staff', '$2y$10$K/8DMtH40X1G4Z3iHZDtkuvtiBc6f2Gx5baUAe9BEDOQElyfDyh0m', NULL, NULL, NULL, NULL, NULL),
	(6, 'yulianto@eclectic.co.id', 'Yulianto', 'Project Manager', '$2y$10$vFtiP/EFIN67VYIfS8Obf.cPsSaSHe02JGg4mP5gIGy.3Vnfl4Y8G', NULL, NULL, NULL, NULL, NULL),
	(7, 'made.jeremy@eclectic.co.id', 'Made Jeremy Bern Bryan', 'Konsultan', '$2y$10$nd3Qsw6JBk.HRKrSUhVuReOJaQjrKBByc1L4FEQDJV.6m2iTnytWy', NULL, NULL, NULL, NULL, NULL),
	(8, 'austine.kusuma@eclectic.co.id', 'Austine Faria Kusuma', 'Konsultan', '$2y$10$E6Wu5wkCF7J/pQi9iOx7vuuS6fnOf/mOP/RpEoPEquGSnmGdnxWj.', NULL, NULL, NULL, NULL, NULL),
	(9, 'anang.fauzi@eclectic.co.id', 'Anang Fauzi Kurniawan', 'Project Manager', '$2y$10$F6mkqkPgyiR8t0xdtAceaOX4leSQDtpurhNVerttSFCDDgGqBb2AW', NULL, NULL, NULL, NULL, NULL),
	(10, 'arifatul@eclectic.co.id', 'Arifatul Islamiyah', 'Konsultan', '$2y$10$oZzZzKaOXK7fP3N8fMBeeO/2JSNh64fTA3Bb4GxN5GKX8Lwq.gdL2', NULL, NULL, NULL, NULL, NULL),
	(11, 'abdul@eclectic.co.id', 'Abdul Mubin', 'Project Manager', '$2y$10$k0QtJiX004kbsdVckjjxYuI6ePY5xqVjf8ZkThW9mLWYXk5su85fe', NULL, NULL, NULL, NULL, NULL),
	(12, 'agus@eclectic.co.id', 'Agus Dwi Priyono', 'Konsultan', '$2y$10$zSatVGfr/BYLVQ2B57.vFeiARBcz0L3HEBgiLCKDd9RIzrB5err/.', NULL, NULL, NULL, NULL, NULL),
	(13, 'arbin@eclectic.co.id', 'Arbin Hanley Saputra', 'Konsultan', '$2y$10$MymGyuUUwcFeeV6nM3Hgku6hhevnf3q/vpbVUD9sNnhCdE59C18hS', NULL, NULL, NULL, NULL, NULL),
	(14, 'dimas@eclectic.co.id', 'Dimas Zaky', 'Konsultan', '$2y$10$BmWowdbzEyge1dQmW1F/Au0qaM6y98EGsyGydIo4piIgy414yQwPC', NULL, NULL, NULL, NULL, NULL),
	(15, 'dony@eclectic.co.id', 'Dony Setiawan', 'Konsultan', '$2y$10$F.VtxHPDbh2PjFUECvXx4uTW1I8908Ev7fV5r3kJ.tDGNWPnmIjja', NULL, NULL, NULL, NULL, NULL),
	(16, 'gideon@eclectic.co.id', 'Gideon Panduwinata', 'Konsultan', '$2y$10$2WRlXGmx7NJr3Au1KwbMuOKpPQ/SDevsPvBZj1YsKVp73N0.9otX.', NULL, NULL, NULL, NULL, NULL),
	(18, 'meliza@eclectic.co.id', 'Meliza Fatmawati', 'Konsultan', '$2y$10$UsWxK0RUwtmwv1qkhVHI1eihokl9hce5m9tTS4Q5Pfglgu9bv1b3y', NULL, NULL, NULL, NULL, NULL),
	(19, 'nofi.ardini@eclectic.co.id', 'Nofi Ardini', 'Konsultan', '$2y$10$HwoUGR4yjz1z6gRTLXKXiekHb3Sncp8XudaXcHRjyAGrJe17Y5rVC', NULL, NULL, NULL, NULL, NULL),
	(20, 'tegar@eclectic.co.id', 'Tegar Muharyana Putra', 'Konsultan', '$2y$10$QjHxF1dzwejDq13uZh/3q.JMi3As7H.jUHjTYhEG9XhXa2huOOlIu', NULL, NULL, NULL, NULL, NULL),
	(21, 'usman@eclectic.co.id', 'Usman Adi Nugroho', 'Konsultan', '$2y$10$Na0v.nHcg107evKzNNs4ouoXzMJ/1iemE1gQYJ2QEV.ECLX9lknr6', NULL, NULL, NULL, NULL, NULL),
	(22, 'yoyok@eclectic.co.id', 'Yoyok Aprilyanto', 'Konsultan', '$2y$10$ITcUyEWlnRIOoqQDTkGZN./hla9rHmewpjUNg6rzqr6w3vklEhDEe', NULL, NULL, NULL, NULL, NULL),
	(23, 'christian.indra@eclectic.co.id', 'Christian Indra Wijaya', 'Konsultan', '$2y$10$C9MxTfa8J.1ZMuFIkOLyseAMHM48eFNaZYbrnVSHRN/lffAYZJpPq', NULL, NULL, NULL, NULL, NULL),
	(24, 'antonius.cahyadi@eclectic.co.id', 'Antonius Cahyadi Sutanto', 'Konsultan', '$2y$10$89.i58qYgSP1MaW.YoklyuW9pKn2VQtCPMzqvJiCtQeEDAyFq5GtW', NULL, NULL, NULL, NULL, NULL),
	(25, 'basilia@eclectic.co.id', 'Basilia Manuela Arifin', 'Konsultan', '$2y$10$UFizsc2LTQJEqPvt3ZvKLe2NzYyWUcxWpwXERo8x34OeNt3XRJGei', NULL, NULL, NULL, NULL, NULL),
	(26, 'bramila@eclectic.co.id', 'Bramila Ghina Luthfy', 'Konsultan', '$2y$10$H3lkiEjhWF3y9Xd2zx.upuQWxY8olxledoh6Pm1p1BKey7oJH5FmC', NULL, NULL, NULL, NULL, NULL),
	(27, 'loisa@eclectic.co.id', 'Loisa Christina', 'Konsultan', '$2y$10$Bpl9iDSaTSInPcOxyVvzjuCplvQ9AJVkQgAYz4OMjEgGiwktbkgX2', NULL, NULL, NULL, NULL, NULL),
	(28, 'stefanus@eclectic.co.id', 'Stefanus Daniel', 'Project Manager', '$2y$10$teTq2v3v5PKbRxQqHkn.eOnlghPnqzlTCI3amjbPTqlS0lHoJ17O6', NULL, NULL, NULL, NULL, NULL),
	(29, 'tjendarawasih.rau@eclectic.co.id', 'Tjendrawasih Rau', 'Konsultan', '$2y$10$toXaRSa3y/wFUokjSP2py.ttHtHzjJIxuwg/x2Hj5BJoisx.7YXWy', NULL, NULL, NULL, NULL, NULL),
	(30, 'aziz@eclectic.co.id', 'Aziz Ihza Fauzan', 'Konsultan', '$2y$10$44YGub2rrw2nOcPOi8xUKuRu3JrpTOnGSwWgHQpwZXXcqLnNJdmIC', NULL, NULL, NULL, NULL, NULL),
	(31, 'daniel.rivaldo@eclectic.co.id', 'Daniel Rivaldo Gunawan', 'Konsultan', '$2y$10$80aJu6HwP9cXIizx4/q.k./jogm5gVRxGGUvNn6mcIrKd2EltlP8q', NULL, NULL, NULL, NULL, NULL),
	(32, 'abdurrohman@eclectic.co.id', 'Abdurrohman Ahmad Rofiq', 'Project Manager', '$2y$10$g0qbSg2WALWw0HOCAJ7K3ODm0meWIuJ6McyGt0C4NpeSO265f4oaG', NULL, NULL, NULL, NULL, NULL),
	(33, 'puteri.amira@eclectic.co.id', 'Puteri Amira Syifani', 'Konsultan', '$2y$10$L1pcnFxzpCQ3IA/Oqh7uauyQRBM4./55DRJWzT.H.cd9V12DBg6Bm', NULL, NULL, NULL, NULL, NULL),
	(36, 'devi@eclectic.co.id', 'Devi', 'Staff', '$2y$10$o1c1h8v59fQji4Q1qPKPS.rpITMcFMLk5oV.Q5C.jBprwZVEdobxC', NULL, NULL, NULL, NULL, NULL),
	(38, 'santo@eclectic.co.id', 'Santo Suharyono', 'Support Manager', '$2y$10$is83QYYR1JL74Cq8I.RBKeVCZ3UTNELsm9femEnFvnoiyqAkIdNOi', NULL, NULL, NULL, NULL, NULL),
	(39, 'supriyonggo@eclectic.co.id', 'Supriyonggo', 'Konsultan', '$2y$10$ZJif.qTVDrZQdxBB6L4CLeQQUOXU8k.p3UZcKeUoSx8oNL.kcBxYe', NULL, NULL, NULL, NULL, NULL),
	(40, 'sujiono@eclectic.co.id', 'Sujiono', 'Project Manager', '$2y$10$nJdlcZWO0ESHz.iTMrotzOD9VqeiqDPDg/siN9St0kAOSmkGDF/w6', NULL, NULL, NULL, NULL, NULL),
	(41, 'very.briliyanto@eclectic.co.id', 'Very Briliyanto', 'Konsultan', '$2y$10$GF9T7WGjGd7/ljIJu83zFuksLAdpbKXrFzB3v0rTeJvVsFMAb7OoS', NULL, NULL, NULL, NULL, NULL),
	(42, 'hermes@eclectic.co.id', 'Hermes Budi Setiawan', 'Konsultan', '$2y$10$NC5Aw6OQliQTop9njgkJre8LOd2s2g3x.n1ZTgKwsvcQkBk1QcpqO', NULL, NULL, NULL, NULL, NULL),
	(43, 'naumi@eclectic.co.id', 'Naumi. T. R', 'Staff', '$2y$10$TwvF0/GXANzzWHg89aoQaud/MWCX2bxqWpHab.qE6mkNadwSyGt9K', NULL, NULL, NULL, NULL, NULL),
	(44, 'angel@eclectic.co.id', 'Angelia Agatha', 'Staff', '$2y$10$Vmci9l1eW2lqD/mrv0LBe.T/FG7IGrHi6SVDdUkoB/UWfKEsj1T0i', NULL, NULL, NULL, NULL, NULL),
	(45, 'pamella@eclectic.co.id', 'Pamella', 'Konsultan', '$2y$10$uYKFYIbrg0tkj8A5wHEtfuN12mPGTJApHC1IBDeuehkZfH4hgHt5K', NULL, NULL, NULL, NULL, NULL),
	(46, 'ign.excel@eclectic.co.id', 'Ign Excel Ekaristi Verares', 'Konsultan', '$2y$10$mxogN2ubyha1icGlUOPJ/Opua7ygc8cvF1la.RBL6XUuqYUQ.s15u', NULL, NULL, NULL, NULL, NULL),
	(47, 'titus@eclectic.co.id', 'Titus Obaja', 'Staff', '$2y$10$E3YX7eV.g8kNIZ1DD6lLd.NwpimyDzpBaWrY45TjxGK1yllJZWPXq', NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table eclectic.kasir
CREATE TABLE IF NOT EXISTS `kasir` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.kasir: ~1 rows (approximately)
DELETE FROM `kasir`;
INSERT INTO `kasir` (`id`, `email`, `password`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'suzy@eclectic.co.id', '$2y$10$H4hQuZdL/1bye3ABNxcy5uKJ48m34/v3MQE61q87N.lILWftEcdmm', 'Suzy. A', NULL, NULL);

-- Dumping structure for table eclectic.kurs
CREATE TABLE IF NOT EXISTS `kurs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mata_uang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.kurs: ~4 rows (approximately)
DELETE FROM `kurs`;
INSERT INTO `kurs` (`id`, `mata_uang`, `created_at`, `updated_at`) VALUES
	(1, 'IDR', NULL, NULL),
	(2, 'SGD', NULL, NULL),
	(3, 'USD', NULL, NULL),
	(4, 'EUR', NULL, NULL);

-- Dumping structure for table eclectic.master_po
CREATE TABLE IF NOT EXISTS `master_po` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `VAT` float DEFAULT NULL,
  `PPH` float DEFAULT NULL,
  `PPH_4` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.master_po: ~1 rows (approximately)
DELETE FROM `master_po`;
INSERT INTO `master_po` (`id`, `VAT`, `PPH`, `PPH_4`, `created_at`, `updated_at`) VALUES
	(1, 0.11, 0.02, 0.1, '2023-06-15 08:57:43', '2023-06-15 08:57:47');

-- Dumping structure for table eclectic.menyetujui
CREATE TABLE IF NOT EXISTS `menyetujui` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.menyetujui: ~4 rows (approximately)
DELETE FROM `menyetujui`;
INSERT INTO `menyetujui` (`id`, `email`, `nama`, `password`, `jabatan`, `signature`, `no_telp`, `created_at`, `updated_at`) VALUES
	(1, 'richard@eclectic.co.id', 'Richard', '$2y$10$tau2RcJRmMkDqUU8Q.WCL./MJ8MHGQXo2X.VQsPvuRRoERV4evdGq', 'Head of Business Development', NULL, '+62 881-3236-918', NULL, NULL),
	(2, 'yacob@eclectic.co.id', 'Yacob', '$2y$10$EKz5gzX95HcbvOH/ycEO5.foJjJph2psnEnfwfWwkMvWQVvKyuMuO', 'Direktur', NULL, '+62 881-3236-918', NULL, NULL),
	(4, 'aris@eclectic.co.id', 'Aris', '1234567', 'Direktur', NULL, '+62 881-3236-918', NULL, NULL),
	(5, 'sujiono@eclectic.co.id', 'Sujiono', '$2y$10$.ba3SzeaVP.Gt4Toi6r4u.4/KWI0rovyDb9dlqTL.ww/fdcOsiEYe', 'Direktur', NULL, '+62 881-3236-918', NULL, NULL);

-- Dumping structure for table eclectic.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.migrations: ~72 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(85, '2014_10_12_000000_create_users_table', 1),
	(86, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(87, '2019_08_19_000000_create_failed_jobs_table', 1),
	(88, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(89, '2023_05_08_061725_create_karyawan_table', 1),
	(90, '2023_05_08_140056_create_kurs_table', 1),
	(91, '2023_05_09_020235_create_accounting_table', 1),
	(92, '2023_05_09_042112_create_kasir_table', 1),
	(93, '2023_05_09_051830_create_menyetujui_table', 1),
	(94, '2023_05_09_074916_create_fee_timesheet_table', 1),
	(95, '2023_05_09_203700_create_fee_project_table', 1),
	(96, '2023_05_10_031453_create_supplier_table', 1),
	(97, '2023_05_10_123124_create_client_table', 1),
	(98, '2023_05_11_025743_create_admin_reimbursement_table', 1),
	(99, '2023_05_11_040810_create_admin_rb_detail_table', 1),
	(101, '2023_05_11_233607_create_admin_cash_advance_report_table', 1),
	(102, '2023_05_12_015503_create_admin_cash_advance_report_detail_table', 1),
	(103, '2023_05_14_041327_create_admin_timesheet_project_detail_table', 1),
	(104, '2023_05_15_020622_create_admin_support_ticket_detail_table', 1),
	(105, '2023_05_15_021725_create_admin_support_lembur_detail_table', 1),
	(106, '2023_05_16_033855_create_karyawan_reimbursement_table', 1),
	(107, '2023_05_16_033909_create_karyawan_rb_detail_table', 1),
	(108, '2023_05_16_070438_add_ttd_field_to_menyetujui', 1),
	(109, '2023_05_19_055531_add_group_field_to_client', 1),
	(110, '2023_05_22_064407_add_jabatan_field_to_karyawan', 1),
	(111, '2023_05_23_041305_add_halaman_field_to_admin_reimbursement', 1),
	(112, '2023_05_24_094416_add_halaman_field_to_karyawan_reimbursement', 1),
	(113, '2023_05_24_095109_create_karyawan_timesheet_project_detail', 1),
	(114, '2023_05_24_095209_create_karyawan_support_ticket_detail', 1),
	(115, '2023_05_24_095223_create_karyawan_support_lembur_detail', 1),
	(116, '2023_05_26_035704_add_bukti_timesheet_to_admin_timesheet_project_detail', 1),
	(117, '2023_05_26_040127_add_bukti_support_ticket_to_admin_support_ticket_detail', 1),
	(118, '2023_05_26_041033_add_bukti_support_lembur_to_admin_support_lembur_detail', 1),
	(119, '2023_05_29_043756_add_jabatan_field_to_users', 1),
	(120, '2023_05_29_080832_add_alasan_field_to_admin_reimbursement', 1),
	(121, '2023_05_30_073014_add_no_ref_field_to_admin_reimbursement', 1),
	(122, '2023_05_31_052524_add_tgl_persetujuan_field_to_admin_reimbursement', 1),
	(123, '2023_05_31_061429_add_no_rekening_field_to_users', 1),
	(124, '2023_05_31_061439_add_bank_field_to_users', 1),
	(125, '2023_05_31_093223_add_keperluan_field_to_admin_rb_detail', 1),
	(126, '2023_06_04_203616_add_status_paid_field_to_admin_cash_advance', 1),
	(127, '2023_06_06_042749_add_alasan_field_to_admin_cash_advance', 2),
	(128, '2023_06_06_043859_add_tgl_persetujuan_field_to_admin_cash_advance', 3),
	(129, '2023_06_07_045135_add_tgl_persetujuan_field_to_admin_cash_advance_report', 4),
	(130, '2023_06_07_045157_add_alasan_field_to_admin_cash_advance_report', 4),
	(131, '2023_06_07_045222_add_no_referensi_field_to_admin_cash_advance_report', 4),
	(132, '2023_06_07_045537_add_no_referensi_field_to_admin_cash_advance', 5),
	(133, '2023_05_11_214335_create_admin_cash_advance_table', 6),
	(134, '2023_06_09_030115_add_status_paid_field_to_admin_cash_advance2', 7),
	(135, '2023_06_09_032207_add_keperluan_field_to_admin_cash_advance_report_detail', 8),
	(136, '2023_06_12_024419_add_bukti_bank_field_to_karyawan', 9),
	(138, '2023_06_13_073250_create_admin_purchase_request_table', 10),
	(139, '2023_06_13_074809_create_admin_purchase_request_detail_table', 11),
	(142, '2023_06_13_083431_add_status_paid_field_to_admin_purchase_request', 12),
	(143, '2023_06_13_083440_add_status_approval_field_to_admin_purchase_request', 12),
	(144, '2023_06_15_022125_create_admin_purchase_order_table', 13),
	(145, '2023_06_15_071659_create_master__p_o_table', 13),
	(156, '2023_06_16_040328_create_admin_purchase_order_table', 14),
	(157, '2023_06_16_043734_create_admin_purchase_order_detail_table', 14),
	(158, '2023_06_19_023224_add_curr_field_to_admin_purchase_order_detail', 14),
	(159, '2023_06_19_035716_add_nominal_field_to_admin_purchase_order', 15),
	(161, '2023_06_20_041941_add_nominal_field_to_admin_timesheet_project_detail', 16),
	(162, '2023_06_26_015256_add_tgl_approval_field_to_admin_cash_advance', 17),
	(163, '2023_06_26_015307_add_alasan_field_to_admin_cash_advance', 17),
	(164, '2023_06_26_074333_add_tgl_approval_field_to_admin_purchase_order', 18),
	(165, '2023_06_26_074341_add_alasan_field_to_admin_purchase_order', 18),
	(166, '2023_06_26_075958_add_tgl_approval_field_to_admin_purchase_request', 19),
	(167, '2023_06_26_080003_add_alasan_field_to_admin_purchase_request', 19),
	(168, '2023_06_30_042454_add_no_ref_field_to_admin_purchase_request', 20),
	(169, '2023_06_30_042737_add_no_ref_field_to_admin_purchase_order', 21),
	(170, '2023_07_04_043308_add_nomor_field_to_admin_reimbursement', 22),
	(171, '2023_07_07_023928_add_no_telp_field_to_menyetujui', 23),
	(172, '2023_07_13_015350_add_project_field_to_admin_timesheet_project_detail', 24),
	(173, '2023_07_17_063920_add_no_telp_field_to_admin_cash_advance', 25),
	(174, '2023_07_17_065539_add_no_telp_field_to_admin_cash_advance_report', 26);

-- Dumping structure for table eclectic.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table eclectic.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping structure for table eclectic.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PIC` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menyetujui` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rekening` int DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemilik_bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.supplier: ~21 rows (approximately)
DELETE FROM `supplier`;
INSERT INTO `supplier` (`id`, `nama_supplier`, `PIC`, `menyetujui`, `no_rekening`, `bank`, `pemilik_bank`, `created_at`, `updated_at`) VALUES
	(1, 'PT. Padi Internet', 'Zhomi', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(2, 'Harris Hotel Sentul City', 'Novi', 'Richard', NULL, NULL, NULL, NULL, NULL),
	(3, 'Huawei Services (HONG KONG) Co., Limited', 'Richard', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(4, 'PT. Dharma Anugerah Wiratama', 'Novi', 'Richard', NULL, NULL, NULL, NULL, NULL),
	(5, 'Sri Wahyuni', 'Zhomi', 'Sujiono', NULL, NULL, NULL, NULL, NULL),
	(6, 'Biznet', 'Zhomi', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(7, 'Qualtrics, LLC', 'Richard', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(8, 'PT ASTRA INT. Tbk (Auto 2000)', 'Supriyonggo', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(9, 'Padi Rent Car', 'Zhomi', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(10, 'JNE Darmo Permai', 'Zhomi', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(11, 'LINK MICROSYSTEMS', 'Zhomi', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(12, 'Resto Nine', 'Suzy. A', 'Sujiono', NULL, NULL, NULL, NULL, NULL),
	(13, 'PT. SAP Indonesia', 'Richard', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(14, 'Flowernett Florist', 'Suzy. A', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(15, 'Syntesis Square', 'Suzy. A', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(16, 'NTT Data Business Solution', 'Richard', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(17, 'Faiq Rukhulloh', 'Devi', 'Richard', NULL, NULL, NULL, NULL, NULL),
	(18, 'TESKA Florist', 'Suzy. A', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(19, 'PT. Smart Sertifikasi Indonesia', 'Devi', 'Richard', NULL, NULL, NULL, NULL, NULL),
	(20, 'PT. Datacomm Diangraha', 'Richard', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(21, 'PT. Executive Center', 'Suzy. A', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(22, 'Ahmad Fadilah', 'Pamella', 'Yacob', NULL, NULL, NULL, NULL, NULL),
	(23, 'PT. SAP SE', 'Richard', 'Yacob', NULL, NULL, NULL, NULL, NULL);

-- Dumping structure for table eclectic.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Admin',
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table eclectic.users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `email`, `nama`, `password`, `jabatan`, `no_rekening`, `bank`, `created_at`, `updated_at`) VALUES
	(1, 'zhomi@eclectic.co.id', 'Zhomi', '$2y$10$0Mc0e7w/T26s3aHS9FEqTeFOmO1Aagd/KEZs98AUa3azm53WleelO', 'Admin', NULL, NULL, '2023-06-05 21:24:28', '2023-06-05 21:24:28');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
