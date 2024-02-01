/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telepon` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `tb_admin`;
INSERT INTO `tb_admin` (`id_admin`, `nama`, `email`, `no_telepon`, `password`) VALUES
	(1, 'ONLINE', '', '', ''),
	(2, 'Iriana Mulyani M.Kom.', 'tania40@mayasari.co', '0301 4823 224', 'T@R#zd4;/'),
	(3, 'Cemplunk Wibowo', 'kemal96@haryanti.net', '(+62) 362 569', 'Mv67$j\'('),
	(4, 'Cindy Rahmawati S.Sos', 'lpradana@iswahyudi.web.id', '(+62) 253 567', 'dAW3uP{F'),
	(5, 'Taufik Sirait', 'Taufik1234@gmail.com', '(+62) 23 9490', 'Taufik1234'),
	(6, 'admin', 'admin@gmail.com', '0813234567890', 'admin123');





CREATE TABLE IF NOT EXISTS `tb_tamu` (
  `id_tamu` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telepon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_tamu`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `tb_tamu`;
INSERT INTO `tb_tamu` (`id_tamu`, `nama`, `email`, `no_telepon`, `alamat`, `password`) VALUES
	(1, 'Back End G', 'backEndG@gmail.com', '081345678987', 'UTY Kampus 1', 'pbeG_123'),
	(2, 'Bagus', 'bagusaja@gmail.com', '088134567812', 'Jalan Maju Mundur ', 'bagus12'),
	(3, 'prab', 'prabowo@gmail.com', '08976435', 'adfgadgafasdfas', 'prabowomenang');





CREATE TABLE IF NOT EXISTS `tb_tipe_kamar` (
  `id_tipe_kamar` int NOT NULL AUTO_INCREMENT,
  `nama_tipe` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_kasur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sarapan` tinyint NOT NULL DEFAULT '0',
  `televisi` tinyint NOT NULL DEFAULT '0',
  `area_merokok` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tipe_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `tb_tipe_kamar`;
INSERT INTO `tb_tipe_kamar` (`id_tipe_kamar`, `nama_tipe`, `tipe_kasur`, `sarapan`, `televisi`, `area_merokok`) VALUES
	(1, 'Baginda Raja', 'Double Bed', 1, 1, 1),
	(2, 'Panglima', 'Twin Bed', 1, 1, 0),
	(3, 'Prajurit', 'Single Bed', 0, 0, 1);




CREATE TABLE IF NOT EXISTS `tb_kamar` (
  `id_kamar` int NOT NULL AUTO_INCREMENT,
  `id_tipe_kamar` int NOT NULL,
  `no_kamar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kamar`),
  KEY `id_tipe` (`id_tipe_kamar`) USING BTREE,
  CONSTRAINT `tipe_kamar` FOREIGN KEY (`id_tipe_kamar`) REFERENCES `tb_tipe_kamar` (`id_tipe_kamar`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `tb_kamar`;
INSERT INTO `tb_kamar` (`id_kamar`, `id_tipe_kamar`, `no_kamar`, `harga`) VALUES
	(1, 1, '301', '1500000'),
	(2, 1, '302', '1500000'),
	(3, 1, '303', '1500000'),
	(4, 2, '201', '750000'),
	(5, 2, '202', '750000'),
	(6, 2, '203', '750000'),
	(7, 3, '101', '200000'),
	(8, 3, '102', '200000'),
	(9, 3, '103', '200000');





CREATE TABLE IF NOT EXISTS `tb_reservasi` (
  `id_reservasi` int NOT NULL AUTO_INCREMENT,
  `kode_reservasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_admin` int DEFAULT NULL,
  `id_tamu` int DEFAULT NULL,
  `total_kamar` int DEFAULT NULL,
  `durasi_inap` int DEFAULT NULL,
  `tgl_checkin` datetime DEFAULT NULL,
  `tgl_checkout` datetime DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  `total_harga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bank` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `va_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `snap_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_payment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_reservasi`),
  UNIQUE KEY `kode_reservasi` (`kode_reservasi`),
  KEY `id_admin` (`id_admin`),
  KEY `id_tamu` (`id_tamu`),
  CONSTRAINT `admin` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`),
  CONSTRAINT `tamu` FOREIGN KEY (`id_tamu`) REFERENCES `tb_tamu` (`id_tamu`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `tb_reservasi`;
INSERT INTO `tb_reservasi` (`id_reservasi`, `kode_reservasi`, `id_admin`, `id_tamu`, `total_kamar`, `durasi_inap`, `tgl_checkin`, `tgl_checkout`, `tgl_pesan`, `total_harga`, `payment_type`, `bank`, `va_number`, `snap_token`, `status_payment`) VALUES
	(1, '20230607135609-1', 1, 1, 1, 1, '2023-06-07 14:00:00', '2023-06-08 12:00:00', '2023-06-07 13:56:14', '200000', 'bank_transfer', 'bni', '9885544550760639', NULL, 'PAID'),
	(4, '20230607224401-1', 1, 1, 1, 1, '2023-06-07 14:00:00', '2023-06-08 12:00:00', '2023-06-07 22:44:07', '750000', 'bank_transfer', 'bni', '9885544544742648', 'dcdd1cf9-ff1a-4d8f-86f1-5964475547f1', 'PENDING'),
	(5, '20230608100841-2', 1, 2, 1, 1, '2023-06-08 14:00:00', '2023-06-09 12:00:00', '2023-06-08 10:09:14', '200000', 'bank_transfer', 'bni', '9885544587756260', 'f877ecd9-5791-4b2e-afa2-1663aa342b5a', 'PAID'),
	(6, '20230608101007-3', 1, 3, 1, 1, '2023-06-08 14:00:00', '2023-06-09 12:00:00', '2023-06-08 10:10:50', '200000', 'bank_transfer', 'bri', '554458802711762418', 'bec6f39f-4eb1-474f-82a0-014b02cc6f04', 'PAID'),
	(7, '20230608102052-2', 1, 2, 1, 1, '2023-06-08 14:00:00', '2023-06-09 12:00:00', '2023-06-08 10:20:56', '750000', 'bank_transfer', 'bni', '9885544504652415', 'a97eaa71-2b17-4747-a0a8-e53a9a880c1c', 'PAID'),
	(8, '20230608102113-3', 1, 3, 1, 1, '2023-06-08 14:00:00', '2023-06-09 12:00:00', '2023-06-08 10:21:27', '750000', 'bank_transfer', 'bni', '9885544540944394', 'aea350c5-e88f-4df4-af09-b5e1d3830de7', 'PAID'),
	(9, '20230608104931-2', 1, 2, 1, 2, '2023-06-30 14:00:00', '2023-07-02 12:00:00', '2023-06-08 10:49:35', '400000', 'bank_transfer', 'bni', '9885544562517021', 'ba88c16a-4f32-4e20-8bcc-45a091419c27', 'PAID');





CREATE TABLE IF NOT EXISTS `tb_detail_reservasi` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `kode_reservasi` varchar(50) DEFAULT NULL,
  `id_kamar` int DEFAULT NULL,
  `nik_t1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_t1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik_t2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_t2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `kode_reservasi` (`kode_reservasi`),
  KEY `id_kamar` (`id_kamar`),
  CONSTRAINT `kamar_detail` FOREIGN KEY (`id_kamar`) REFERENCES `tb_kamar` (`id_kamar`),
  CONSTRAINT `reservasi_detail` FOREIGN KEY (`kode_reservasi`) REFERENCES `tb_reservasi` (`kode_reservasi`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DELETE FROM `tb_detail_reservasi`;
INSERT INTO `tb_detail_reservasi` (`id_detail`, `kode_reservasi`, `id_kamar`, `nik_t1`, `nama_t1`, `nik_t2`, `nama_t2`) VALUES
	(1, '20230607135609-1', 7, '001', 'Bayu', '', ''),
	(4, '20230607224401-1', 4, '001-1', 'Panglima 1-1', '', ''),
	(5, '20230608100841-2', 7, '0009', 'Bagus', '', ''),
	(6, '20230608101007-3', 8, '1234352123', 'prab', '', ''),
	(7, '20230608102052-2', 4, '0009', 'Bagus', '0010', 'Istri Bagus'),
	(8, '20230608102113-3', 5, '5435435', 'bvcgh', '6545478', 'bvc'),
	(9, '20230608104931-2', 7, '0009', 'Bagus', '', '');


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
