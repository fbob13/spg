-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 09, 2022 at 06:33 AM
-- Server version: 8.0.29
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spgedung`
--

-- --------------------------------------------------------

--
-- Table structure for table `as_nonrutin`
--

CREATE TABLE `as_nonrutin` (
  `id_nonrutin` bigint NOT NULL,
  `id_teknisi` int DEFAULT NULL,
  `id_pembuat` int NOT NULL,
  `id_gedung` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `id_item` int NOT NULL,
  `prioritas` tinyint DEFAULT '1',
  `tanggal_laporan` date NOT NULL,
  `tanggal_perbaikan` date DEFAULT NULL,
  `status_pekerjaan` tinyint DEFAULT '0',
  `keluhan` text COLLATE utf8mb4_general_ci,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `as_nonrutin`
--

INSERT INTO `as_nonrutin` (`id_nonrutin`, `id_teknisi`, `id_pembuat`, `id_gedung`, `id_ruangan`, `id_item`, `prioritas`, `tanggal_laporan`, `tanggal_perbaikan`, `status_pekerjaan`, `keluhan`, `keterangan`, `created_at`) VALUES
(26, 2, 1, 1, 9, 135, 1, '2022-07-13', '2022-07-15', 5, 'Kedap Kedip', 'Super User : Bohlam sudah diganti\r\n------------------\r\nSuper User : \r\n------------------\r\n', '2022-07-13 00:23:52'),
(27, 3, 1, 3, 46, 138, 2, '2022-07-13', '2022-07-15', 1, 'Patah', 'Super User : Keran Ganti Baru\r\n------------------\r\nSuper User : belum terganti\r\n------------------\r\n', '2022-07-13 00:24:41'),
(28, 2, 1, 4, 64, 140, 3, '2022-07-13', NULL, 2, 'Dinding gipsum bolong', 'Super User : Tunggu bahan\r\n------------------\r\n', '2022-07-13 00:25:33'),
(29, NULL, 1, 1, 10, 80, 3, '2022-07-17', NULL, 0, 'Berbuyi tanpa henti', NULL, '2022-07-17 04:35:58'),
(30, 2, 1, 2, 132, 136, 3, '2022-07-17', '2022-07-17', 3, 'bocor', 'Super User : Sudah ditambal\r\n------------------\r\n', '2022-07-17 04:37:25'),
(31, 2, 1, 3, 47, 135, 2, '2022-07-21', '2022-07-21', 5, 'lampu di kamar saya kedap kedip', 'Super User : sudah ganti lampu\n\r------------------\n\rSuper User : lampu masih tidak menyala\n\r------------------\n\rSuper User : sdh ditangani dan menyala\n\r------------------\n\rSuper User : \n\r------------------\n\r', '2022-07-21 00:33:59'),
(32, 2, 1, 4, 65, 138, 2, '2022-07-24', '2022-07-24', 5, 'keran air di kamar mandi lepas', 'Super User : keran telah diganti\n\r------------------\n\rSuper User : telah diganti, dan sudah bagus\n\r------------------\n\r', '2022-07-24 04:23:23'),
(33, 2, 1, 4, 66, 135, 2, '2022-07-24', '2022-07-24', 5, 'Lampu di kamar mandi tidak menyala', 'Super User : lampu putus dan sudah diganti dengan yang baru\n\r------------------\n\rSuper User : lampu telah menyala\n\r------------------\n\r', '2022-07-24 13:40:00'),
(34, 3, 1, 3, 49, 138, 2, '2022-07-25', '2022-07-25', 5, 'keran di toiliet patah', 'Super User : keran telah diganti\n\r------------------\n\rSuper User : telah diganti\n\r------------------\n\r', '2022-07-25 03:31:27'),
(35, NULL, 7, 4, 64, 135, 1, '2022-07-25', NULL, 0, 'Lampu dikamar kedap kedip', NULL, '2022-07-25 03:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `as_rutin`
--

CREATE TABLE `as_rutin` (
  `id_rutin` bigint NOT NULL,
  `id_user` int NOT NULL,
  `id_pembuat` int NOT NULL,
  `id_gedung` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `id_item` int NOT NULL,
  `id_pkrutin` int NOT NULL,
  `tanggal_jadwal` date NOT NULL,
  `tanggal_realisasi` date DEFAULT NULL,
  `status_pekerjaan` tinyint DEFAULT '0',
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `pk` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arus_r` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arus_s` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arus_t` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_r` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_s` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_t` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_v` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `psi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `oli` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `solar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `radiator` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eng_hours` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `accu` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temp` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kap` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `noice` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vol` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_kadaluarsa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `as_rutin`
--

INSERT INTO `as_rutin` (`id_rutin`, `id_user`, `id_pembuat`, `id_gedung`, `id_ruangan`, `id_item`, `id_pkrutin`, `tanggal_jadwal`, `tanggal_realisasi`, `status_pekerjaan`, `keterangan`, `created_at`, `pk`, `arus_r`, `arus_s`, `arus_t`, `teg_r`, `teg_s`, `teg_t`, `teg_v`, `psi`, `oli`, `solar`, `radiator`, `eng_hours`, `accu`, `temp`, `kap`, `noice`, `qty`, `vol`, `tgl_kadaluarsa`, `kondisi`, `tindakan`) VALUES
(28, 2, 1, 1, 8, 81, 8, '2022-07-13', NULL, 1, 'sementara dikerjakan', '2022-07-12 23:45:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 2, 1, 2, 131, 106, 4, '2022-07-13', NULL, 2, 'masih banyak pekerjaan', '2022-07-12 23:45:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 2, 1, 1, 5, 133, 8, '2022-07-13', NULL, 3, 'done', '2022-07-12 23:45:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 2, 1, 1, 6, 89, 5, '2022-07-13', NULL, 3, 'Super User : Berfungsi dengan baik\r\n------------------\r\n', '2022-07-12 23:45:19', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(32, 2, 1, 1, 126, 121, 9, '2022-07-13', NULL, 0, NULL, '2022-07-12 23:45:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 2, 1, 1, 11, 84, 5, '2022-07-13', NULL, 0, NULL, '2022-07-13 05:58:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 3, 1, 1, 5, 81, 8, '2022-07-17', NULL, 5, 'Super User : Normal\r\n------------------\r\nSuper User : done\r\n------------------\r\n', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 3, 999999, 1, 5, 81, 8, '2022-08-16', NULL, 0, NULL, '2022-07-17 04:33:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 2, 1, 2, 132, 81, 8, '2022-07-18', NULL, 3, 'Super User : Semua Normal\r\n------------------\r\n', '2022-07-18 08:02:26', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 3, 1, 1, 8, 81, 8, '2022-07-21', '2022-07-21', 5, 'Super User : semua normal\n\r------------------\n\rSuper User : \n\r------------------\n\r', '2022-07-21 00:26:40', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(38, 3, 999999, 1, 8, 81, 8, '2022-08-20', NULL, 0, NULL, '2022-07-21 00:32:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 2, 1, 1, 8, 81, 8, '2022-07-24', NULL, 0, NULL, '2022-07-24 02:41:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 2, 1, 1, 10, 81, 8, '2022-07-24', '2022-07-24', 5, 'Super User : Semua Normal\n\r------------------\n\rSuper User : gambar buram\n\r------------------\n\rSuper User : sudah normal, gambar sudah jernih\n\r------------------\n\rSuper User : sudah normal\n\r------------------\n\rSuper User : sudah sesuai\n\r------------------\n\r', '2022-07-24 04:19:09', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(41, 2, 999999, 1, 10, 81, 8, '2022-08-23', NULL, 0, NULL, '2022-07-24 04:22:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 2, 1, 1, 10, 79, 7, '2022-07-24', '2022-07-24', 5, 'Super User : kondisi ok\n\r------------------\n\rSuper User : kondisi kotor\n\r------------------\n\rSuper User : kondisi telah bersih\n\r------------------\n\rSuper User : Seusi yang diharapkan\n\r------------------\n\r', '2022-07-24 13:36:42', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 2, 999999, 1, 10, 79, 7, '2022-08-23', NULL, 0, NULL, '2022-07-24 13:39:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 2, 1, 1, 9, 81, 8, '2022-07-25', '2022-07-25', 5, 'Super User : Telah dibersihkan, berfungsi normal\n\r------------------\n\rSuper User : gambar tidak muncul\n\r------------------\n\rSuper User : gambar sudah muncul\n\r------------------\n\rSuper User : sudah bagus\n\r------------------\n\r', '2022-07-25 03:27:34', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, 2, 999999, 1, 9, 81, 8, '2022-08-24', NULL, 0, NULL, '2022-07-25 03:29:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `as_rutin_draft`
--

CREATE TABLE `as_rutin_draft` (
  `id_rutin_draft` bigint NOT NULL,
  `id_user` int NOT NULL,
  `id_pembuat` int NOT NULL,
  `id_gedung` int NOT NULL,
  `id_ruangan` int NOT NULL,
  `id_item` int NOT NULL,
  `id_pkrutin` int NOT NULL,
  `tanggal_jadwal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `as_rutin_draft`
--

INSERT INTO `as_rutin_draft` (`id_rutin_draft`, `id_user`, `id_pembuat`, `id_gedung`, `id_ruangan`, `id_item`, `id_pkrutin`, `tanggal_jadwal`) VALUES
(17, 3, 1, 7, 62, 99, 6, '2022-07-19'),
(18, 3, 1, 2, 132, 80, 5, '2022-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `mst_akses_detail`
--

CREATE TABLE `mst_akses_detail` (
  `id_majabatan` int NOT NULL,
  `spc` int NOT NULL,
  `kode_halaman` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `vw` tinyint DEFAULT '0',
  `edt` tinyint DEFAULT '0',
  `del` tinyint DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_akses_detail`
--

INSERT INTO `mst_akses_detail` (`id_majabatan`, `spc`, `kode_halaman`, `vw`, `edt`, `del`) VALUES
(1, 99, 'MST_KAT', 1, 1, 1),
(2, 99, 'MST_GED', 1, 1, 1),
(3, 99, 'MST_RUA', 1, 1, 1),
(4, 99, 'MST_ITE', 1, 1, 1),
(5, 99, 'MST_PEK', 1, 1, 1),
(6, 99, 'RUTIN_INPUT', 1, 1, 1),
(7, 99, 'RUTIN_DATA', 1, 1, 1),
(8, 99, 'NRUTIN_INPUT', 1, 1, 1),
(9, 99, 'NRUTIN_DATA', 1, 1, 1),
(10, 99, 'ADM_USER', 1, 1, 1),
(11, 99, 'ADM_AKSES', 1, 1, 1),
(16, 0, 'MST_KAT', 1, 0, 0),
(17, 0, 'MST_GED', 1, 0, 0),
(18, 0, 'MST_RUA', 1, 0, 0),
(19, 0, 'MST_ITE', 1, 0, 0),
(20, 0, 'MST_PEK', 1, 0, 0),
(21, 0, 'RUTIN_INPUT', 0, 0, 0),
(22, 0, 'RUTIN_DATA', 1, 1, 0),
(23, 0, 'NRUTIN_INPUT', 0, 0, 0),
(24, 0, 'NRUTIN_DATA', 1, 1, 0),
(25, 0, 'ADM_USER', 0, 0, 0),
(26, 0, 'ADM_AKSES', 0, 0, 0),
(31, 1, 'MST_KAT', 1, 1, 1),
(32, 1, 'MST_GED', 1, 1, 1),
(33, 1, 'MST_RUA', 1, 1, 1),
(34, 1, 'MST_ITE', 1, 1, 1),
(35, 1, 'MST_PEK', 1, 1, 1),
(36, 1, 'RUTIN_INPUT', 1, 1, 1),
(37, 1, 'RUTIN_DATA', 1, 1, 1),
(38, 1, 'NRUTIN_INPUT', 1, 1, 1),
(39, 1, 'NRUTIN_DATA', 1, 1, 1),
(40, 1, 'ADM_USER', 0, 0, 0),
(41, 1, 'ADM_AKSES', 0, 0, 0),
(46, 2, 'MST_KAT', 0, 0, 0),
(47, 2, 'MST_GED', 0, 0, 0),
(48, 2, 'MST_RUA', 0, 0, 0),
(49, 2, 'MST_ITE', 0, 0, 0),
(50, 2, 'MST_PEK', 0, 0, 0),
(51, 2, 'RUTIN_INPUT', 0, 0, 0),
(52, 2, 'RUTIN_DATA', 0, 0, 0),
(53, 2, 'NRUTIN_INPUT', 1, 1, 1),
(54, 2, 'NRUTIN_DATA', 1, 0, 0),
(55, 2, 'ADM_USER', 0, 0, 0),
(56, 2, 'ADM_AKSES', 0, 0, 0),
(61, 0, 'MST_RUA_ITE', 1, 0, 0),
(62, 1, 'MST_RUA_ITE', 1, 1, 1),
(63, 2, 'MST_RUA_ITE', 0, 0, 0),
(64, 99, 'MST_RUA_ITE', 1, 1, 1),
(65, 99, 'MST_SUBKAT', 1, 1, 1),
(66, 0, 'MST_SUBKAT', 1, 0, 0),
(67, 1, 'MST_SUBKAT', 1, 1, 1),
(68, 2, 'MST_SUBKAT', 0, 0, 0),
(69, 3, 'MST_KAT', 0, 0, 0),
(70, 3, 'MST_GED', 0, 0, 0),
(71, 3, 'MST_RUA', 0, 0, 0),
(72, 3, 'MST_ITE', 0, 0, 0),
(73, 3, 'MST_PEK', 0, 0, 0),
(74, 3, 'RUTIN_INPUT', 0, 0, 0),
(75, 3, 'RUTIN_DATA', 0, 0, 0),
(76, 3, 'NRUTIN_INPUT', 0, 0, 0),
(77, 3, 'NRUTIN_DATA', 0, 0, 0),
(78, 3, 'ADM_USER', 0, 0, 0),
(79, 3, 'ADM_AKSES', 0, 0, 0),
(81, 3, 'MST_RUA_ITE', 0, 0, 0),
(82, 3, 'MST_SUBKAT', 0, 0, 0),
(84, 99, 'REP_PKR', 0, 0, 0),
(85, 99, 'REP_KRS', 0, 0, 0),
(86, 99, 'REP_PMR', 0, 0, 0),
(87, 0, 'REP_PKR', 0, 0, 0),
(88, 0, 'REP_KRS', 0, 0, 0),
(89, 0, 'REP_PMR', 0, 0, 0),
(90, 1, 'REP_PKR', 0, 0, 0),
(91, 1, 'REP_KRS', 0, 0, 0),
(92, 1, 'REP_PMR', 0, 0, 0),
(93, 2, 'REP_PKR', 0, 0, 0),
(94, 2, 'REP_KRS', 0, 0, 0),
(95, 2, 'REP_PMR', 0, 0, 0),
(96, 3, 'REP_PKR', 0, 0, 0),
(97, 3, 'REP_KRS', 0, 0, 0),
(98, 3, 'REP_PMR', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mst_akses_halaman`
--

CREATE TABLE `mst_akses_halaman` (
  `id_mahalaman` int NOT NULL,
  `kode_halaman` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_halaman` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_akses_halaman`
--

INSERT INTO `mst_akses_halaman` (`id_mahalaman`, `kode_halaman`, `deskripsi_halaman`) VALUES
(1, 'MST_KAT', 'Master Kategori'),
(2, 'MST_GED', 'Master Gedung'),
(3, 'MST_RUA', 'Master Ruangan'),
(4, 'MST_ITE', 'Master Item'),
(5, 'MST_PEK', 'Master Pekerjaan'),
(6, 'RUTIN_INPUT', 'Input Jadwal Perawatan Rutin'),
(7, 'RUTIN_DATA', 'Lihat / Edit Jadwal Perawatan Rutin'),
(8, 'NRUTIN_INPUT', 'Input Kerusakan'),
(9, 'NRUTIN_DATA', 'Lihat / Edit Data Kerusakan'),
(10, 'ADM_USER', 'Buat User Aplikasi'),
(11, 'ADM_AKSES', 'Rubah Hak Akses'),
(13, 'MST_RUA_ITE', 'Master Ruangan Item'),
(14, 'MST_SUBKAT', 'Master Subkategori'),
(15, 'REP_PKR', 'Laporan Pekerjaan Rutin'),
(16, 'REP_KRS', 'Laporan Kerusakan'),
(17, 'REP_PMR', 'Laporan Pemeliharaan Rutin');

-- --------------------------------------------------------

--
-- Table structure for table `mst_akses_spc`
--

CREATE TABLE `mst_akses_spc` (
  `id_maspc` int NOT NULL,
  `spc` int NOT NULL,
  `deskripsi_spc` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_akses_spc`
--

INSERT INTO `mst_akses_spc` (`id_maspc`, `spc`, `deskripsi_spc`) VALUES
(1, 0, 'Teknisi'),
(2, 1, 'Admin'),
(3, 2, 'User'),
(4, 99, 'Super User');

-- --------------------------------------------------------

--
-- Table structure for table `mst_gedung`
--

CREATE TABLE `mst_gedung` (
  `id_gedung` int NOT NULL,
  `nama_gedung` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_gedung`
--

INSERT INTO `mst_gedung` (`id_gedung`, `nama_gedung`, `keterangan`, `created_at`) VALUES
(1, 'KANTOR', 'Kantor', '2022-06-17 00:51:57'),
(2, 'AUDITORIUM', 'Auditorium', '2022-06-17 01:06:23'),
(3, 'MESS 1', 'Mess 1', '2022-06-17 01:06:43'),
(4, 'MESS 2', 'MESS 2', '2022-06-21 04:12:42'),
(5, 'MESS 3', 'MESS 3', '2022-06-21 23:00:47'),
(6, 'RUMAH JABATAN', 'RUMAH JABATAN', '2022-06-26 23:07:30'),
(7, 'RUMAH KALAN', 'RUMAH KALAN', '2022-06-26 23:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `mst_item`
--

CREATE TABLE `mst_item` (
  `id_item` int NOT NULL,
  `nama_item` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `merek_item` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_item` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_kategori` int NOT NULL,
  `id_subkategori` int DEFAULT '0',
  `status_item` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_item`
--

INSERT INTO `mst_item` (`id_item`, `nama_item`, `merek_item`, `tipe_item`, `id_kategori`, `id_subkategori`, `status_item`, `created_at`) VALUES
(78, 'APAR 3.5 Kg', 'Yamato', '3.5 Kg', 3, 4, 1, '2022-07-12 01:20:18'),
(79, 'APAR 6 Kg', 'Viking', '6 Kg', 3, 4, 1, '2022-07-12 01:21:44'),
(80, 'Bell Alaram', '-', '-', 3, 2, 1, '2022-07-12 04:34:55'),
(81, 'CCTV', 'Avtech', '16 ch', 4, 5, 1, '2022-07-12 04:36:58'),
(82, 'Emergency Button', '-', '-', 3, 1, 1, '2022-07-12 04:38:10'),
(83, 'Emergency Lamp Signal', '-', '-', 3, 1, 1, '2022-07-12 04:39:06'),
(84, 'Heat Detector', '-', '-', 3, 2, 1, '2022-07-12 04:42:29'),
(85, 'PABX Module', 'Panasonic', 'TDA', 4, 6, 1, '2022-07-12 04:43:53'),
(86, 'Panel Listrik PP Mess I . II', '-', '-', 4, 8, 1, '2022-07-12 04:45:58'),
(87, 'Panel Listrik PP Mess III', '-', '-', 4, 8, 1, '2022-07-12 04:50:25'),
(88, 'Pompa Transfer Kantor I', 'Shimizu', 'PK', 3, 3, 1, '2022-07-12 04:51:12'),
(89, 'Smoke Detector', '-', '-', 3, 2, 1, '2022-07-12 04:51:50'),
(90, 'Pesawat Telepon', 'Panasonic', 'KX', 4, 6, 1, '2022-07-12 05:07:16'),
(91, 'Pompa Transfer kantor II', '-', '-', 3, 3, 1, '2022-07-12 07:38:02'),
(92, 'Pompa Transfer Mess I', '-', '-', 3, 3, 1, '2022-07-12 07:39:07'),
(93, 'Pompa Transfer Mess II', '-', '-', 3, 3, 1, '2022-07-12 07:39:37'),
(94, 'Pompa Transfer Mess III', '-', '-', 3, 3, 1, '2022-07-12 07:40:48'),
(95, 'Pompa Transfer Rumah kalan', '-', '-', 3, 3, 1, '2022-07-12 07:41:37'),
(96, 'Pompa Transfer Rumah Dinas', '-', '-', 3, 3, 1, '2022-07-12 07:41:56'),
(97, 'Jockey Pump', '-', '-', 3, 3, 1, '2022-07-12 07:42:50'),
(98, 'Fire Pump', '-', '-', 3, 3, 1, '2022-07-12 07:43:14'),
(99, 'Pompa Pendorong R. kalan', '-', '-', 3, 3, 1, '2022-07-12 07:43:47'),
(100, 'Pendorong Rumdin B', '-', '-', 3, 3, 1, '2022-07-12 07:44:41'),
(101, 'Pendorong Mess II', '-', '-', 3, 3, 1, '2022-07-12 07:45:15'),
(102, 'Pendorong Mess III', '-', '-', 3, 3, 1, '2022-07-12 07:45:45'),
(103, 'Submersible Kantor', '-', '-', 3, 3, 1, '2022-07-12 07:46:02'),
(104, 'Submersible Mess', '-', '-', 3, 3, 1, '2022-07-12 07:46:35'),
(105, 'Panel PP Auditorium', '-', '-', 4, 8, 1, '2022-07-12 07:52:23'),
(106, 'Panel AC lt. 1 Auditorium', '-', '-', 4, 8, 1, '2022-07-12 07:53:00'),
(107, 'Panel AC Auditorium', '-', '-', 4, 8, 1, '2022-07-12 07:53:59'),
(108, 'Panel SDP Auditorium ', '-', '-', 4, 8, 1, '2022-07-12 07:54:34'),
(109, 'Panel Penerangan 2', '-', '-', 4, 8, 1, '2022-07-12 07:55:23'),
(110, 'Panel Penerangan 1', '-', '-', 4, 8, 1, '2022-07-12 07:56:04'),
(111, 'Panel Lift', '-', '-', 4, 8, 1, '2022-07-12 07:56:35'),
(112, 'Panel AC 3', '-', '-', 4, 8, 1, '2022-07-12 07:57:14'),
(113, 'Panel PP 3', '-', '-', 4, 8, 1, '2022-07-12 07:57:32'),
(114, 'Panel AC 2', '-', '-', 4, 8, 1, '2022-07-12 07:57:55'),
(115, 'Panel PP 2', '-', '-', 4, 8, 1, '2022-07-12 07:58:56'),
(116, 'Panel AC 1', '-', '-', 4, 8, 1, '2022-07-12 07:59:23'),
(117, 'Panel PP 1', '-', '-', 4, 8, 1, '2022-07-12 07:59:44'),
(118, 'Panel MDP', '-', '-', 4, 8, 1, '2022-07-12 08:00:16'),
(119, 'Panel LVMMDP', '-', '-', 4, 8, 1, '2022-07-12 08:00:44'),
(120, 'Panel LSA', '-', '-', 4, 6, 1, '2022-07-12 08:03:02'),
(121, 'Intercom Komunikasi Lift', '-', '-', 3, 1, 1, '2022-07-12 08:07:39'),
(122, 'Motor Penggerak', '-', '-', 3, 1, 1, '2022-07-12 08:09:37'),
(123, 'Panel Kontrol', '-', '-', 3, 1, 1, '2022-07-12 08:10:19'),
(124, 'Panel Power', '-', '-', 3, 1, 1, '2022-07-12 08:11:33'),
(125, 'Penerangan Kabin', '-', '-', 3, 1, 1, '2022-07-12 08:12:02'),
(126, 'Pintu Lift', '-', '-', 3, 1, 1, '2022-07-12 08:12:25'),
(127, 'Ruang Kabin Lift', '-', '-', 3, 1, 1, '2022-07-12 08:12:43'),
(128, 'Ruang Luncur', '-', '-', 3, 2, 1, '2022-07-12 08:13:17'),
(129, 'Stabilizer Tegangan', '-', '-', 3, 1, 1, '2022-07-12 08:13:38'),
(130, 'Tali Baja', '-', '-', 3, 1, 1, '2022-07-12 08:16:19'),
(131, 'Tombol Emergency', '-', '-', 3, 1, 1, '2022-07-12 08:16:38'),
(132, 'Tombol Operasi', '-', '-', 3, 1, 1, '2022-07-12 08:16:58'),
(133, 'Layar Monitor', '-', '-', 4, 5, 1, '2022-07-12 11:46:11'),
(134, 'Pintu', '-', '-', 1, 9, 1, '2022-07-13 00:18:44'),
(135, 'Lampu Downlight', '-', '-', 4, 13, 1, '2022-07-13 00:20:15'),
(136, 'Plafon', '-', '-', 1, 11, 1, '2022-07-13 00:20:51'),
(137, 'Saklar', '-', '-', 4, 14, 1, '2022-07-13 00:21:14'),
(138, 'Keran', '-', '-', 3, 16, 1, '2022-07-13 00:22:20'),
(139, 'Atap', '-', '-', 2, 12, 1, '2022-07-13 00:22:48'),
(140, 'Dinding', '-', '-', 2, 10, 1, '2022-07-13 00:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategori`
--

CREATE TABLE `mst_kategori` (
  `id_kategori` int NOT NULL,
  `kode_kategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uraian_kategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_kategori`
--

INSERT INTO `mst_kategori` (`id_kategori`, `kode_kategori`, `uraian_kategori`) VALUES
(1, '001', 'ARSITEKTURAL'),
(2, '002', 'STRUKTURAL'),
(3, '003', 'MEKANIKAL'),
(4, '004', 'ELEKTRIKAL');

-- --------------------------------------------------------

--
-- Table structure for table `mst_pkrutin`
--

CREATE TABLE `mst_pkrutin` (
  `id_pkrutin` int NOT NULL,
  `jenis_pekerjaan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uraian_pekerjaan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_kategori` int NOT NULL,
  `id_subkategori` int DEFAULT '0',
  `interval_hari` int DEFAULT '0',
  `pengali` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_pkrutin`
--

INSERT INTO `mst_pkrutin` (`id_pkrutin`, `jenis_pekerjaan`, `uraian_pekerjaan`, `id_kategori`, `id_subkategori`, `interval_hari`, `pengali`, `created_at`) VALUES
(4, 'Pengecekan Panel Listrik', 'Mengukur Pengukuran Tegangan (F - N), Amper dan Suhu', 4, 8, 1, 7, '2022-06-27 02:17:40'),
(5, 'Pengecekan & Pembersihan Fire Alaram', 'Melakukan Cek Dan Cleaning', 3, 2, 2, 7, '2022-06-27 02:27:00'),
(6, 'Melakukan Pengukuran dan Pembersihan Pompa Air', 'Melakukan Pengukuran Tegangan (F - N), Amper dan Pembersihan', 3, 3, 1, 7, '2022-06-27 02:37:14'),
(7, 'Cek & Periksa Kadaluarsa Tabung Apar', 'Melakukan Pengecekan volume dan tanggal kadaluarsa', 3, 4, 1, 30, '2022-06-27 02:37:58'),
(8, 'Pengecekan & Pembersihan CCTV', 'Melakukan Pengecekan dan Pembersihan', 4, 5, 1, 30, '2022-06-27 02:47:06'),
(9, 'Melakukan Pengukuran & Pembersihan Lift', 'Melakukan Pengukuran tegangan dan arus listrik, serta pembersihan', 3, 1, 1, 30, '2022-06-27 02:52:13'),
(10, 'Cek & Pembersihan PABX', 'Melakukan Cek, test dan cleaning', 4, 6, 1, 30, '2022-06-27 02:57:50'),
(11, 'Cek & Pembersihan Genset', 'Melakukan Pengecekan Oli, Solar, Tegangan Aki dan Pembersihan', 4, 7, 1, 7, '2022-06-27 02:58:21');

-- --------------------------------------------------------

--
-- Table structure for table `mst_ruangan`
--

CREATE TABLE `mst_ruangan` (
  `id_ruangan` int NOT NULL,
  `id_gedung` int DEFAULT NULL,
  `kode_ruangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uraian_ruangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_ruangan` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_ruangan`
--

INSERT INTO `mst_ruangan` (`id_ruangan`, `id_gedung`, `kode_ruangan`, `uraian_ruangan`, `keterangan`, `status_ruangan`, `created_at`) VALUES
(5, 1, '001', 'POS JAGA SATPAM KANTOR', 'POS JAGA SATPAM KANTOR', 1, '2022-06-26 23:30:05'),
(6, 1, '002', 'RUANG ARSIP SDM DAN HUMAS', 'RUANG ARSIP SDM DAN HUMAS', 1, '2022-06-26 23:30:05'),
(7, 1, '003', 'RUANG LOBBY LANTAI 1', 'RUANG LOBBY LANTAI 1', 1, '2022-06-26 23:30:05'),
(8, 1, '004', 'RUANG SUB BAGIAN UMUM', 'RUANG SUB BAGIAN UMUM', 1, '2022-06-26 23:30:05'),
(9, 1, '005', 'RUANG SUB BAGIAN SDM', 'RUANG SUB BAGIAN SDM', 1, '2022-06-26 23:30:05'),
(10, 1, '006', 'RUANG SUB BAGIAN HUKUM', 'RUANG SUB BAGIAN HUKUM', 1, '2022-06-26 23:30:05'),
(11, 1, '007', 'RUANG SERVER & PERANGKAT TI', 'RUANG SERVER & PERANGKAT TI', 1, '2022-06-26 23:30:05'),
(12, 1, '008', 'RUANG ATK', 'RUANG ATK', 1, '2022-06-26 23:30:05'),
(13, 1, '009', 'RUANG GUDANG DAN PERALATAN', 'RUANG GUDANG DAN PERALATAN', 1, '2022-06-26 23:30:05'),
(14, 1, '011', 'RUANG POLIKLINIK UMUM', 'RUANG POLIKLINIK UMUM', 1, '2022-06-26 23:30:05'),
(15, 1, '012', 'RUANG PANEL LISTRIK LANTAI 1', 'RUANG PANEL LISTRIK LANTAI 1', 1, '2022-06-26 23:30:05'),
(16, 1, '014', 'RUANG GENSET DAN GUDANG', 'RUANG GENSET DAN GUDANG', 1, '2022-06-26 23:30:05'),
(17, 1, '015', 'RUANG VIP LANTAI 1', 'RUANG VIP LANTAI 1', 1, '2022-06-26 23:30:05'),
(18, 1, '016', 'RUANG LOBBY LANTAI 2', 'RUANG LOBBY LANTAI 2', 1, '2022-06-26 23:30:05'),
(19, 1, '017', 'RUANG SUB BAGIAN KEUANGAN', 'RUANG SUB BAGIAN KEUANGAN', 1, '2022-06-26 23:30:05'),
(20, 1, '018', 'RUANG KEPALA SETLAN', 'RUANG KEPALA SETLAN', 1, '2022-06-26 23:30:05'),
(21, 1, '019', 'RUANG SUBBAGIAN HUMAS DAN TU', 'RUANG SUBBAGIAN HUMAS DAN TU', 1, '2022-06-26 23:30:05'),
(22, 1, '020', 'RUANG KEPALA PERWAKILAN', 'RUANG KEPALA PERWAKILAN', 1, '2022-06-26 23:30:05'),
(23, 1, '021', 'RUANG RAPAT KALAN', 'RUANG RAPAT KALAN', 1, '2022-06-26 23:30:05'),
(24, 1, '022', 'RUANG VIP LANTAI 2', 'RUANG VIP LANTAI 2', 1, '2022-06-26 23:30:05'),
(25, 1, '023', 'RUANG PERPUSTAKAAN DAN PIK', 'RUANG PERPUSTAKAAN DAN PIK', 1, '2022-06-26 23:30:05'),
(26, 1, '024', 'RUANG PANTRY LANTAI 2', 'RUANG PANTRY LANTAI 2', 1, '2022-06-26 23:30:05'),
(27, 1, '026', 'RUANG PENGENDALI TEKNIS 1', 'RUANG PENGENDALI TEKNIS 1', 1, '2022-06-26 23:30:05'),
(28, 1, '027', 'RUANG AUDITORAT', 'RUANG AUDITORAT', 1, '2022-06-26 23:30:05'),
(29, 1, '028', 'RUANG KEPALA SUB AUDITORAT 1', 'RUANG KEPALA SUB AUDITORAT 1', 1, '2022-06-26 23:30:05'),
(30, 1, '031', 'RUANG KEPALA SUB AUDITORAT 2', 'RUANG KEPALA SUB AUDITORAT 2', 1, '2022-06-26 23:30:05'),
(31, 1, '034', 'RUANG PENGENDALI TEKNIS 2', 'RUANG PENGENDALI TEKNIS 2', 1, '2022-06-26 23:30:05'),
(32, 1, '035', 'RUANG ARSIP LANTAI 3', 'RUANG ARSIP LANTAI 3', 1, '2022-06-26 23:30:05'),
(33, 1, '036', 'RUANG PANTRY LANTAI 3', 'RUANG PANTRY LANTAI 3', 1, '2022-06-26 23:30:05'),
(34, 1, '038', 'RUANG GUDANG LANTAI 3', 'RUANG GUDANG LANTAI 3', 1, '2022-06-26 23:30:05'),
(35, 1, '040', 'RUMAH KEPALA PERWAKILAN', 'RUMAH KEPALA PERWAKILAN', 1, '2022-06-26 23:30:05'),
(36, 6, '041', 'RUMAH JABATAN TIPE 70 NO. B1', 'RUMAH JABATAN TIPE 70 NO. B1', 1, '2022-06-26 23:30:05'),
(37, 6, '042', 'RUMAH JABATAN TIPE 70 NO. B2', 'RUMAH JABATAN TIPE 70 NO. B2', 1, '2022-06-26 23:30:05'),
(38, 6, '043', 'RUMAH JABATAN TIPE 70 NO. B3', 'RUMAH JABATAN TIPE 70 NO. B3', 1, '2022-06-26 23:30:05'),
(39, 6, '044', 'RUMAH JABATAN TIPE 50 NO. C7', 'RUMAH JABATAN TIPE 50 NO. C7', 1, '2022-06-26 23:30:05'),
(40, 6, '045', 'RUMAH JABATAN TIPE 50 NO. C6', 'RUMAH JABATAN TIPE 50 NO. C6', 1, '2022-06-26 23:30:05'),
(41, 6, '046', 'RUMAH JABATAN TIPE 50 NO. C1', 'RUMAH JABATAN TIPE 50 NO. C1', 1, '2022-06-26 23:30:05'),
(42, 6, '047', 'RUMAH JABATAN TIPE 50 NO. C2', 'RUMAH JABATAN TIPE 50 NO. C2', 1, '2022-06-26 23:30:05'),
(43, 6, '048', 'RUMAH JABATAN TIPE 50 NO. C3', 'RUMAH JABATAN TIPE 50 NO. C3', 1, '2022-06-26 23:30:05'),
(44, 6, '049', 'RUMAH JABATAN TIPE 50 NO. C4', 'RUMAH JABATAN TIPE 50 NO. C4', 1, '2022-06-26 23:30:05'),
(45, 6, '050', 'RUMAH JABATAN TIPE 50 NO. C5', 'RUMAH JABATAN TIPE 50 NO. C5', 1, '2022-06-26 23:30:05'),
(46, 3, '051', 'Mess D1', 'Mess D1', 1, '2022-06-26 23:30:05'),
(47, 3, '052', 'Mess D2', 'Mess D2', 1, '2022-06-26 23:30:05'),
(48, 3, '053', 'Mess D3', 'Mess D3', 1, '2022-06-26 23:30:05'),
(49, 3, '054', 'Mess D4', 'Mess D4', 1, '2022-06-26 23:30:05'),
(50, 3, '055', 'Mess D5', 'Mess D5', 1, '2022-06-26 23:30:05'),
(51, 3, '056', 'RUANG PANEL LISTRIK MESS', 'RUANG PANEL LISTRIK MESS', 1, '2022-06-26 23:30:05'),
(52, 3, '057', 'Mess D6', 'Mess D6', 1, '2022-06-26 23:30:05'),
(53, 3, '058', 'Mess D7', 'Mess D7', 1, '2022-06-26 23:30:05'),
(54, 3, '059', 'Mess D8', 'Mess D8', 1, '2022-06-26 23:30:05'),
(55, 3, '060', 'Mess D9', 'Mess D9', 1, '2022-06-26 23:30:05'),
(56, 3, '061', 'RUANG DAPUR MESS 1', 'RUANG DAPUR MESS 1', 1, '2022-06-26 23:30:05'),
(57, 3, '062', 'Mess D10', 'Mess D10', 1, '2022-06-26 23:30:05'),
(58, 3, '063', 'Mess D11', 'Mess D11', 1, '2022-06-26 23:30:05'),
(59, 1, '067', 'RUANG KONFERENSI PERS', 'RUANG KONFERENSI PERS', 1, '2022-06-26 23:30:05'),
(60, 2, '068', 'AUDITORIUM ', 'AUDITORIUM ', 1, '2022-06-26 23:30:05'),
(61, 3, '069', 'RUANG GENSET MESS', 'RUANG GENSET MESS', 1, '2022-06-26 23:30:05'),
(62, 7, '070', 'POS JAGA SATPAM RUMAH KALAN', 'POS JAGA SATPAM RUMAH KALAN', 1, '2022-06-26 23:30:05'),
(63, 6, '071', 'RUMAH JABATAN TIPE 50 NO. C8', 'RUMAH JABATAN TIPE 50 NO. C8', 1, '2022-06-26 23:30:05'),
(64, 4, '072', 'Mess E1', 'Mess E1', 1, '2022-06-26 23:30:05'),
(65, 4, '073', 'Mess E2', 'Mess E2', 1, '2022-06-26 23:30:05'),
(66, 4, '074', 'Mess E3', 'Mess E3', 1, '2022-06-26 23:30:05'),
(67, 4, '075', 'Mess E4', 'Mess E4', 1, '2022-06-26 23:30:05'),
(68, 4, '076', 'Mess E5', 'Mess E5', 1, '2022-06-26 23:30:05'),
(69, 4, '077', 'Mess E6', 'Mess E6', 1, '2022-06-26 23:30:05'),
(70, 4, '078', 'Mess E7', 'Mess E7', 1, '2022-06-26 23:30:05'),
(71, 4, '079', 'Mess E8', 'Mess E8', 1, '2022-06-26 23:30:05'),
(72, 4, '080', 'Mess E9', 'Mess E9', 1, '2022-06-26 23:30:05'),
(73, 4, '081', 'Mess E11', 'Mess E11', 1, '2022-06-26 23:30:05'),
(74, 4, '082', 'Mess E10', 'Mess E10', 1, '2022-06-26 23:30:05'),
(75, 1, '084', 'RUANG LORONG LANTAI 1', 'RUANG LORONG LANTAI 1', 1, '2022-06-26 23:30:05'),
(76, 4, '087', 'DAPUR MESS II', 'DAPUR MESS II', 1, '2022-06-26 23:30:05'),
(77, 1, '090', 'RUANG KOPERASI, KANTIN, DAN KKP', 'RUANG KOPERASI, KANTIN, DAN KKP', 1, '2022-06-26 23:30:05'),
(78, 1, '123', 'RUANG MEDIA CENTER', 'RUANG MEDIA CENTER', 1, '2022-06-26 23:30:05'),
(79, 3, '124', 'POS JAGA MESS I', 'POS JAGA MESS I', 1, '2022-06-26 23:30:05'),
(80, 5, '125', 'Mess F1', 'Mess F1', 1, '2022-06-26 23:30:05'),
(81, 5, '126', 'Mess F2', 'Mess F2', 1, '2022-06-26 23:30:05'),
(82, 5, '127', 'Mess F3', 'Mess F3', 1, '2022-06-26 23:30:05'),
(83, 5, '128', 'Mess F4', 'Mess F4', 1, '2022-06-26 23:30:05'),
(84, 5, '129', 'Mess F5', 'Mess F5', 1, '2022-06-26 23:30:05'),
(85, 5, '130', 'Mess F6', 'Mess F6', 1, '2022-06-26 23:30:05'),
(86, 5, '131', 'Mess F7', 'Mess F7', 1, '2022-06-26 23:30:05'),
(87, 5, '132', 'Mess F8', 'Mess F8', 1, '2022-06-26 23:30:05'),
(88, 5, '133', 'Mess F9', 'Mess F9', 1, '2022-06-26 23:30:05'),
(89, 5, '134', 'Mess F10', 'Mess F10', 1, '2022-06-26 23:30:05'),
(90, 5, '135', 'Mess F11', 'Mess F11', 1, '2022-06-26 23:30:05'),
(91, 5, '136', 'Mess F12', 'Mess F12', 1, '2022-06-26 23:30:05'),
(92, 5, '137', 'Mess F13', 'Mess F13', 1, '2022-06-26 23:30:05'),
(93, 5, '138', 'POS JAGA MESS III', 'POS JAGA MESS III', 1, '2022-06-26 23:30:05'),
(94, 5, '139', 'DAPUR MESS III', 'DAPUR MESS III', 1, '2022-06-26 23:30:05'),
(95, 1, '159', 'MUSHOLLA LANTAI 3', 'MUSHOLLA LANTAI 3', 1, '2022-06-26 23:30:05'),
(96, 1, '160', 'MUSHOLLA LANTAI 1', 'MUSHOLLA LANTAI 1', 1, '2022-06-26 23:30:05'),
(97, 1, '161', 'RUANG POMPA', 'RUANG POMPA', 1, '2022-06-26 23:30:05'),
(98, 1, '162', 'RUANG DRIVER', 'RUANG DRIVER', 1, '2022-06-26 23:30:05'),
(99, 1, '170', 'Gerbang Depan', 'Gerbang Depan', 1, '2022-06-26 23:30:05'),
(100, 1, '171', 'Halaman samping', 'Halaman samping', 1, '2022-06-26 23:30:05'),
(101, 1, '172', 'Kantor I', 'Kantor I', 1, '2022-06-26 23:30:05'),
(102, 1, '173', 'Kantor II', 'Kantor II', 1, '2022-06-26 23:30:05'),
(103, 1, '174', 'Koridor Lt.1', 'Koridor Lt.1', 1, '2022-06-26 23:30:05'),
(104, 1, '175', 'koridor Lt.1 dekat mesin absen', 'koridor Lt.1 dekat mesin absen', 1, '2022-06-26 23:30:05'),
(105, 1, '176', 'Koridor Lt.1 depan lift', 'Koridor Lt.1 depan lift', 1, '2022-06-26 23:30:05'),
(106, 1, '177', 'Koridor Lt.1 depan mushola', 'Koridor Lt.1 depan mushola', 1, '2022-06-26 23:30:05'),
(107, 1, '178', 'Koridor Lt.1 depan perpusatkaan', 'Koridor Lt.1 depan perpusatkaan', 1, '2022-06-26 23:30:05'),
(108, 1, '179', 'Koridor Lt.1 depan ruang driver', 'Koridor Lt.1 depan ruang driver', 1, '2022-06-26 23:30:05'),
(109, 1, '180', 'Koridor Lt.1 depan subbag umum', 'Koridor Lt.1 depan subbag umum', 1, '2022-06-26 23:30:05'),
(110, 1, '181', 'Koridor Lt.2', 'Koridor Lt.2', 1, '2022-06-26 23:30:05'),
(111, 1, '182', 'Koridor Lt.2 Depan subbag keuangan', 'Koridor Lt.2 Depan subbag keuangan', 1, '2022-06-26 23:30:05'),
(112, 1, '183', 'Lobby belakang depan VIP', 'Lobby belakang depan VIP', 1, '2022-06-26 23:30:05'),
(113, 1, '184', 'Lobby belakang Lt.2', 'Lobby belakang Lt.2', 1, '2022-06-26 23:30:05'),
(114, 1, '185', 'Lobby depan Lt.2', 'Lobby depan Lt.2', 1, '2022-06-26 23:30:05'),
(115, 1, '186', 'Lobby depan Lt.2 depan lift', 'Lobby depan Lt.2 depan lift', 1, '2022-06-26 23:30:05'),
(116, 1, '187', 'Lobby depan Lt.2 depan ruang rapat', 'Lobby depan Lt.2 depan ruang rapat', 1, '2022-06-26 23:30:05'),
(117, 1, '188', 'lobby Lt.1', 'lobby Lt.1', 1, '2022-06-26 23:30:05'),
(118, 1, '189', 'Lt.3 belakang', 'Lt.3 belakang', 1, '2022-06-26 23:30:05'),
(119, 1, '190', 'Lt.3 depan', 'Lt.3 depan', 1, '2022-06-26 23:30:05'),
(120, 1, '191', 'Pos satpam 03', 'Pos satpam 03', 1, '2022-06-26 23:30:05'),
(121, 1, '192', 'Pos Satpam 04', 'Pos Satpam 04', 1, '2022-06-26 23:30:05'),
(122, 1, '193', 'Pos satpam 05', 'Pos satpam 05', 1, '2022-06-26 23:30:05'),
(123, 1, '194', 'Recepcionist', 'Recepcionist', 1, '2022-06-26 23:30:05'),
(124, 1, '195', 'Ruang gudang SDM', 'Ruang gudang SDM', 1, '2022-06-26 23:30:05'),
(125, 1, '196', 'Ruang kasubbag umum', 'Ruang kasubbag umum', 1, '2022-06-26 23:30:05'),
(126, 1, '197', 'Ruang Lift', 'Ruang Lift', 1, '2022-06-26 23:30:05'),
(127, 1, '198', 'Ruang Panel Lt. 2', 'Ruang Panel Lt. 2', 1, '2022-06-26 23:30:05'),
(128, 1, '199', 'Ruang Panel Lt. 3', 'Ruang Panel Lt. 3', 1, '2022-06-26 23:30:05'),
(129, 1, '200', 'Ruang Staff PB 1', 'Ruang Staff PB 1', 1, '2022-06-26 23:30:05'),
(130, 1, '201', 'Parkiran Mobil', 'Parkiran Mobil', 1, '2022-06-26 23:30:05'),
(131, 2, '202', 'Auditorium Lt. 1', 'Auditorium Lt. 1', 1, '2022-06-26 23:30:05'),
(132, 2, '203', 'Auditorium Lt. 2', 'Auditorium Lt. 2', 1, '2022-06-26 23:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `mst_ruangan_item`
--

CREATE TABLE `mst_ruangan_item` (
  `id_ruangan_item` int NOT NULL,
  `id_item` int DEFAULT NULL,
  `id_gedung` int DEFAULT NULL,
  `id_ruangan` int DEFAULT NULL,
  `tahun_pengadaan` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mst_subkategori`
--

CREATE TABLE `mst_subkategori` (
  `id_subkategori` int NOT NULL,
  `id_kategori` int DEFAULT NULL,
  `kode_subkategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uraian_subkategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pk` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arus_r` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arus_s` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arus_t` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_r` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_s` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_t` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `teg_v` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `psi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `oli` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `solar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `radiator` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eng_hours` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `accu` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `temp` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kap` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `noice` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vol` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_kadaluarsa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kondisi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_subkategori`
--

INSERT INTO `mst_subkategori` (`id_subkategori`, `id_kategori`, `kode_subkategori`, `uraian_subkategori`, `pk`, `arus_r`, `arus_s`, `arus_t`, `teg_r`, `teg_s`, `teg_t`, `teg_v`, `psi`, `oli`, `solar`, `radiator`, `eng_hours`, `accu`, `temp`, `kap`, `noice`, `qty`, `vol`, `tgl_kadaluarsa`, `kondisi`, `tindakan`) VALUES
(1, 3, 'K001', 'LIFT', '1', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 3, 'K002', 'FIRE ALARM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'K003', 'POMPA AIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'K004', 'SISTEM PAMADAM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, 'K005', 'CCTV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, 'K006', 'PABX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 4, 'K007', 'GENSET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 4, 'K008', 'PANEL LISTRIK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 'K009', 'PINTU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 2, 'K010', 'DINDING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 'K011', 'PLAFON', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 2, 'K012', 'ATAP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 4, 'K013', 'LAMPU', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 4, 'K014', 'SAKLAR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 3, 'K015', 'SANITAIR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 3, 'K016', 'PLUMBING', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id_user` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `spc` tinyint(1) DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `j_kelamin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id_user`, `username`, `nip`, `nama`, `spc`, `password`, `alamat`, `jabatan`, `j_kelamin`, `telepon`, `email`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'superuser', '1', 'Super User', 99, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'husni', '2', 'Husni', 0, 'e10adc3949ba59abbe56e057f20f883e', '', 'Teknisi', 'l', '', '', NULL, '2022-06-23 13:53:07', NULL),
(3, 'edwin', '3', 'Edwin', 0, 'e10adc3949ba59abbe56e057f20f883e', '', 'Teknisi', 'l', '', '', NULL, '2022-06-24 05:43:55', NULL),
(4, 'aslam', '11', 'Aslam', 2, 'e10adc3949ba59abbe56e057f20f883e', '', 'Cpns', 'l', '', '', NULL, '2022-07-07 05:35:41', NULL),
(5, 'pute', '11', 'pute', 1, 'e10adc3949ba59abbe56e057f20f883e', '', 'Admin', 'l', '', '', NULL, '2022-07-21 00:22:58', NULL),
(6, 'user', '22', 'user', 2, 'e10adc3949ba59abbe56e057f20f883e', '', 'user', 'l', '', '', NULL, '2022-07-21 00:23:15', NULL),
(7, 'aryani', '1222', 'aryani', 2, 'e10adc3949ba59abbe56e057f20f883e', 'Sowi Gunung', 'pegawai', 'p', '', '', NULL, '2022-07-25 03:46:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint NOT NULL,
  `id_user` int NOT NULL,
  `flag_icon` tinyint NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `flag_buka` tinyint NOT NULL DEFAULT '0',
  `flag_android` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_akses`
-- (See below for the actual view)
--
CREATE TABLE `view_akses` (
`del` tinyint
,`deskripsi_halaman` varchar(255)
,`edt` tinyint
,`id_user` int
,`kode_halaman` varchar(255)
,`nama` varchar(255)
,`spc` tinyint(1)
,`username` varchar(255)
,`vw` tinyint
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_akses_spc`
-- (See below for the actual view)
--
CREATE TABLE `view_akses_spc` (
`del` tinyint
,`deskripsi_halaman` varchar(255)
,`edt` tinyint
,`kode_halaman` varchar(255)
,`spc` int
,`vw` tinyint
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_item`
-- (See below for the actual view)
--
CREATE TABLE `view_item` (
`created_at` timestamp
,`id_item` int
,`id_kategori` int
,`id_subkategori` int
,`kode_kategori` varchar(255)
,`kode_subkategori` varchar(255)
,`merek_item` varchar(255)
,`nama_item` varchar(255)
,`status_item` tinyint
,`tipe_item` varchar(255)
,`uraian_kategori` varchar(255)
,`uraian_subkategori` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_nonrutin`
-- (See below for the actual view)
--
CREATE TABLE `view_nonrutin` (
`id_gedung` int
,`id_item` int
,`id_nonrutin` bigint
,`id_pembuat` int
,`id_ruangan` int
,`id_teknisi` int
,`keluhan` text
,`keterangan` text
,`nama_gedung` varchar(255)
,`nama_item` text
,`nama_pembuat` varchar(255)
,`nama_ruangan` text
,`nama_teknisi` varchar(255)
,`prioritas` tinyint
,`prioritas_text` varchar(8)
,`status_pekerjaan` tinyint
,`status_pekerjaan_text` varchar(16)
,`tanggal_laporan` date
,`tanggal_perbaikan` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pkrutin`
-- (See below for the actual view)
--
CREATE TABLE `view_pkrutin` (
`id_kategori` int
,`id_pkrutin` int
,`id_subkategori` int
,`interval_hari` int
,`jenis_pekerjaan` varchar(255)
,`kode_kategori` varchar(255)
,`kode_subkategori` varchar(255)
,`pengali` int
,`uraian_kategori` varchar(255)
,`uraian_pekerjaan` varchar(255)
,`uraian_subkategori` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ruangan`
-- (See below for the actual view)
--
CREATE TABLE `view_ruangan` (
`id_gedung` int
,`id_ruangan` int
,`keterangan` varchar(255)
,`kode_ruangan` varchar(255)
,`nama_gedung` varchar(255)
,`status_ruangan` tinyint
,`uraian_ruangan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ruangan_item`
-- (See below for the actual view)
--
CREATE TABLE `view_ruangan_item` (
`id_gedung` int
,`id_item` int
,`id_kategori` int
,`id_ruangan` int
,`id_ruangan_item` int
,`kode_kategori` varchar(255)
,`kode_ruangan` varchar(255)
,`merek_item` varchar(255)
,`nama_gedung` varchar(255)
,`nama_item` varchar(255)
,`tahun_pengadaan` year
,`tipe_item` varchar(255)
,`uraian_kategori` varchar(255)
,`uraian_ruangan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_rutin`
-- (See below for the actual view)
--
CREATE TABLE `view_rutin` (
`accu` varchar(255)
,`arus_r` varchar(255)
,`arus_s` varchar(255)
,`arus_t` varchar(255)
,`eng_hours` varchar(255)
,`id_gedung` int
,`id_item` int
,`id_kategori` int
,`id_pembuat` int
,`id_pkrutin` int
,`id_ruangan` int
,`id_rutin` bigint
,`id_subkategori` int
,`id_user` int
,`jenis_pekerjaan` varchar(255)
,`kap` varchar(255)
,`keterangan` text
,`kondisi` varchar(255)
,`nama_gedung` varchar(255)
,`nama_item` text
,`nama_pembuat` varchar(255)
,`nama_ruangan` text
,`nama_teknisi` varchar(255)
,`noice` varchar(255)
,`oli` varchar(255)
,`pk` varchar(255)
,`psi` varchar(255)
,`qty` varchar(255)
,`radiator` varchar(255)
,`solar` varchar(255)
,`status_pekerjaan` tinyint
,`status_pekerjaan_text` varchar(16)
,`tanggal_jadwal` date
,`tanggal_realisasi` date
,`teg_r` varchar(255)
,`teg_s` varchar(255)
,`teg_t` varchar(255)
,`teg_v` varchar(255)
,`temp` varchar(255)
,`tgl_kadaluarsa` varchar(255)
,`tindakan` varchar(255)
,`uraian_pekerjaan` varchar(255)
,`vol` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_rutin_draft`
-- (See below for the actual view)
--
CREATE TABLE `view_rutin_draft` (
`id_gedung` int
,`id_item` int
,`id_pembuat` int
,`id_pkrutin` int
,`id_ruangan` int
,`id_rutin_draft` bigint
,`id_user` int
,`jenis_pekerjaan` varchar(255)
,`nama_gedung` varchar(255)
,`nama_item` text
,`nama_pembuat` varchar(255)
,`nama_ruangan` text
,`nama_teknisi` varchar(255)
,`tanggal_jadwal` date
,`uraian_pekerjaan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_subkategori`
-- (See below for the actual view)
--
CREATE TABLE `view_subkategori` (
`accu` varchar(255)
,`arus_r` varchar(255)
,`arus_s` varchar(255)
,`arus_t` varchar(255)
,`eng_hours` varchar(255)
,`id_kategori` int
,`id_subkategori` int
,`kap` varchar(255)
,`kode_kategori` varchar(255)
,`kode_subkategori` varchar(255)
,`kondisi` varchar(255)
,`noice` varchar(255)
,`oli` varchar(255)
,`pk` varchar(255)
,`psi` varchar(255)
,`qty` varchar(255)
,`radiator` varchar(255)
,`solar` varchar(255)
,`teg_r` varchar(255)
,`teg_s` varchar(255)
,`teg_t` varchar(255)
,`teg_v` varchar(255)
,`temp` varchar(255)
,`tgl_kadaluarsa` varchar(255)
,`tindakan` varchar(255)
,`uraian_kategori` varchar(255)
,`uraian_subkategori` varchar(255)
,`vol` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_user`
-- (See below for the actual view)
--
CREATE TABLE `view_user` (
`alamat` varchar(255)
,`created_at` timestamp
,`deskripsi_spc` varchar(255)
,`email` varchar(255)
,`foto` varchar(255)
,`id_user` int
,`j_kelamin` varchar(255)
,`j_kelamin_text` varchar(9)
,`jabatan` varchar(255)
,`nama` varchar(255)
,`nip` varchar(255)
,`spc` tinyint(1)
,`telepon` varchar(255)
,`updated_at` timestamp
,`username` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_akses`
--
DROP TABLE IF EXISTS `view_akses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_akses`  AS SELECT `a`.`id_user` AS `id_user`, `a`.`username` AS `username`, `a`.`nama` AS `nama`, `a`.`spc` AS `spc`, `d`.`kode_halaman` AS `kode_halaman`, `d`.`deskripsi_halaman` AS `deskripsi_halaman`, `c`.`vw` AS `vw`, `c`.`edt` AS `edt`, `c`.`del` AS `del` FROM (((`mst_user` `a` left join `mst_akses_spc` `b` on((`a`.`spc` = `b`.`spc`))) left join `mst_akses_detail` `c` on((`a`.`spc` = `c`.`spc`))) left join `mst_akses_halaman` `d` on((`c`.`kode_halaman` = `d`.`kode_halaman`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_akses_spc`
--
DROP TABLE IF EXISTS `view_akses_spc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_akses_spc`  AS SELECT `a`.`spc` AS `spc`, `d`.`kode_halaman` AS `kode_halaman`, `d`.`deskripsi_halaman` AS `deskripsi_halaman`, `a`.`vw` AS `vw`, `a`.`edt` AS `edt`, `a`.`del` AS `del` FROM (`mst_akses_detail` `a` left join `mst_akses_halaman` `d` on((`a`.`kode_halaman` = `d`.`kode_halaman`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_item`
--
DROP TABLE IF EXISTS `view_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_item`  AS SELECT `a`.`id_item` AS `id_item`, `a`.`nama_item` AS `nama_item`, `a`.`merek_item` AS `merek_item`, `a`.`tipe_item` AS `tipe_item`, `a`.`id_kategori` AS `id_kategori`, `b`.`kode_kategori` AS `kode_kategori`, `b`.`uraian_kategori` AS `uraian_kategori`, `a`.`id_subkategori` AS `id_subkategori`, `c`.`kode_subkategori` AS `kode_subkategori`, `c`.`uraian_subkategori` AS `uraian_subkategori`, `a`.`status_item` AS `status_item`, `a`.`created_at` AS `created_at` FROM ((`mst_item` `a` left join `mst_kategori` `b` on((`a`.`id_kategori` = `b`.`id_kategori`))) left join `mst_subkategori` `c` on((`a`.`id_subkategori` = `c`.`id_subkategori`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_nonrutin`
--
DROP TABLE IF EXISTS `view_nonrutin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_nonrutin`  AS SELECT `a`.`id_nonrutin` AS `id_nonrutin`, `a`.`id_teknisi` AS `id_teknisi`, `d`.`nama` AS `nama_teknisi`, `a`.`id_pembuat` AS `id_pembuat`, `c`.`nama` AS `nama_pembuat`, `a`.`tanggal_laporan` AS `tanggal_laporan`, `a`.`tanggal_perbaikan` AS `tanggal_perbaikan`, `a`.`id_gedung` AS `id_gedung`, `e`.`nama_gedung` AS `nama_gedung`, `a`.`id_ruangan` AS `id_ruangan`, concat_ws(' / ',`f`.`kode_ruangan`,`f`.`uraian_ruangan`) AS `nama_ruangan`, `a`.`id_item` AS `id_item`, concat_ws(' / ',`g`.`nama_item`,`g`.`merek_item`,`g`.`tipe_item`) AS `nama_item`, `a`.`prioritas` AS `prioritas`, (case when (`a`.`prioritas` = 0) then 'Rendah' when (`a`.`prioritas` = 1) then 'Rendah' when (`a`.`prioritas` = 2) then 'Menengah' when (`a`.`prioritas` = 3) then 'Tinggi' when (`a`.`prioritas` = 4) then 'Urgent' end) AS `prioritas_text`, `a`.`keluhan` AS `keluhan`, `a`.`status_pekerjaan` AS `status_pekerjaan`, (case when (`a`.`status_pekerjaan` = 0) then 'Belum Dikerjakan' when (`a`.`status_pekerjaan` = 1) then 'Progres' when (`a`.`status_pekerjaan` = 2) then 'Pending' when (`a`.`status_pekerjaan` = 3) then 'Selesai' when (`a`.`status_pekerjaan` = 4) then 'Tidak Dikerjakan' when (`a`.`status_pekerjaan` = 5) then 'Approved' end) AS `status_pekerjaan_text`, `a`.`keterangan` AS `keterangan` FROM (((((`as_nonrutin` `a` left join `mst_user` `c` on((`a`.`id_pembuat` = `c`.`id_user`))) left join `mst_user` `d` on((`a`.`id_teknisi` = `d`.`id_user`))) left join `mst_gedung` `e` on((`a`.`id_gedung` = `e`.`id_gedung`))) left join `mst_ruangan` `f` on((`a`.`id_ruangan` = `f`.`id_ruangan`))) left join `mst_item` `g` on((`a`.`id_item` = `g`.`id_item`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_pkrutin`
--
DROP TABLE IF EXISTS `view_pkrutin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pkrutin`  AS SELECT `a`.`id_pkrutin` AS `id_pkrutin`, `a`.`jenis_pekerjaan` AS `jenis_pekerjaan`, `a`.`uraian_pekerjaan` AS `uraian_pekerjaan`, `a`.`id_kategori` AS `id_kategori`, `b`.`kode_kategori` AS `kode_kategori`, `b`.`uraian_kategori` AS `uraian_kategori`, `a`.`id_subkategori` AS `id_subkategori`, `c`.`kode_subkategori` AS `kode_subkategori`, `c`.`uraian_subkategori` AS `uraian_subkategori`, `a`.`interval_hari` AS `interval_hari`, `a`.`pengali` AS `pengali` FROM ((`mst_pkrutin` `a` left join `mst_kategori` `b` on((`a`.`id_kategori` = `b`.`id_kategori`))) left join `mst_subkategori` `c` on((`a`.`id_subkategori` = `c`.`id_subkategori`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_ruangan`
--
DROP TABLE IF EXISTS `view_ruangan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ruangan`  AS SELECT `a`.`id_ruangan` AS `id_ruangan`, `a`.`id_gedung` AS `id_gedung`, `b`.`nama_gedung` AS `nama_gedung`, `a`.`kode_ruangan` AS `kode_ruangan`, `a`.`uraian_ruangan` AS `uraian_ruangan`, `a`.`keterangan` AS `keterangan`, `a`.`status_ruangan` AS `status_ruangan` FROM (`mst_ruangan` `a` left join `mst_gedung` `b` on((`a`.`id_gedung` = `b`.`id_gedung`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_ruangan_item`
--
DROP TABLE IF EXISTS `view_ruangan_item`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ruangan_item`  AS SELECT `a`.`id_ruangan_item` AS `id_ruangan_item`, `a`.`id_item` AS `id_item`, `b`.`nama_item` AS `nama_item`, `b`.`merek_item` AS `merek_item`, `b`.`tipe_item` AS `tipe_item`, `b`.`id_kategori` AS `id_kategori`, `d`.`kode_kategori` AS `kode_kategori`, `d`.`uraian_kategori` AS `uraian_kategori`, `a`.`id_gedung` AS `id_gedung`, `e`.`nama_gedung` AS `nama_gedung`, `a`.`id_ruangan` AS `id_ruangan`, `c`.`kode_ruangan` AS `kode_ruangan`, `c`.`uraian_ruangan` AS `uraian_ruangan`, `a`.`tahun_pengadaan` AS `tahun_pengadaan` FROM ((((`mst_ruangan_item` `a` left join `mst_item` `b` on((`a`.`id_item` = `b`.`id_item`))) left join `mst_ruangan` `c` on((`a`.`id_ruangan` = `c`.`id_ruangan`))) left join `mst_kategori` `d` on((`b`.`id_kategori` = `d`.`id_kategori`))) left join `mst_gedung` `e` on((`a`.`id_gedung` = `e`.`id_gedung`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_rutin`
--
DROP TABLE IF EXISTS `view_rutin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rutin`  AS SELECT `a`.`id_rutin` AS `id_rutin`, `a`.`id_user` AS `id_user`, `d`.`nama` AS `nama_teknisi`, `a`.`id_pembuat` AS `id_pembuat`, `c`.`nama` AS `nama_pembuat`, `a`.`tanggal_jadwal` AS `tanggal_jadwal`, `a`.`id_gedung` AS `id_gedung`, `e`.`nama_gedung` AS `nama_gedung`, `a`.`id_ruangan` AS `id_ruangan`, concat_ws(' / ',`f`.`kode_ruangan`,`f`.`uraian_ruangan`) AS `nama_ruangan`, `a`.`id_item` AS `id_item`, concat_ws(' / ',`g`.`nama_item`,`g`.`merek_item`,`g`.`tipe_item`) AS `nama_item`, `a`.`id_pkrutin` AS `id_pkrutin`, `h`.`jenis_pekerjaan` AS `jenis_pekerjaan`, `h`.`uraian_pekerjaan` AS `uraian_pekerjaan`, `a`.`status_pekerjaan` AS `status_pekerjaan`, (case when (`a`.`status_pekerjaan` = 0) then 'Belum Dikerjakan' when (`a`.`status_pekerjaan` = 1) then 'Progres' when (`a`.`status_pekerjaan` = 2) then 'Pending' when (`a`.`status_pekerjaan` = 3) then 'Selesai' when (`a`.`status_pekerjaan` = 4) then 'Tidak Dikerjakan' when (`a`.`status_pekerjaan` = 5) then 'Approved' end) AS `status_pekerjaan_text`, `a`.`keterangan` AS `keterangan`, `a`.`tanggal_realisasi` AS `tanggal_realisasi`, `g`.`id_kategori` AS `id_kategori`, `g`.`id_subkategori` AS `id_subkategori`, `a`.`pk` AS `pk`, `a`.`arus_r` AS `arus_r`, `a`.`arus_s` AS `arus_s`, `a`.`arus_t` AS `arus_t`, `a`.`teg_r` AS `teg_r`, `a`.`teg_s` AS `teg_s`, `a`.`teg_t` AS `teg_t`, `a`.`teg_v` AS `teg_v`, `a`.`psi` AS `psi`, `a`.`oli` AS `oli`, `a`.`solar` AS `solar`, `a`.`radiator` AS `radiator`, `a`.`eng_hours` AS `eng_hours`, `a`.`accu` AS `accu`, `a`.`temp` AS `temp`, `a`.`kap` AS `kap`, `a`.`noice` AS `noice`, `a`.`qty` AS `qty`, `a`.`vol` AS `vol`, `a`.`tgl_kadaluarsa` AS `tgl_kadaluarsa`, `a`.`kondisi` AS `kondisi`, `a`.`tindakan` AS `tindakan` FROM ((((((`as_rutin` `a` left join `mst_user` `c` on((`a`.`id_pembuat` = `c`.`id_user`))) left join `mst_user` `d` on((`a`.`id_user` = `d`.`id_user`))) left join `mst_gedung` `e` on((`a`.`id_gedung` = `e`.`id_gedung`))) left join `mst_ruangan` `f` on((`a`.`id_ruangan` = `f`.`id_ruangan`))) left join `mst_item` `g` on((`a`.`id_item` = `g`.`id_item`))) left join `mst_pkrutin` `h` on((`a`.`id_pkrutin` = `h`.`id_pkrutin`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_rutin_draft`
--
DROP TABLE IF EXISTS `view_rutin_draft`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rutin_draft`  AS SELECT `a`.`id_rutin_draft` AS `id_rutin_draft`, `a`.`id_user` AS `id_user`, `d`.`nama` AS `nama_teknisi`, `a`.`id_pembuat` AS `id_pembuat`, `c`.`nama` AS `nama_pembuat`, `a`.`tanggal_jadwal` AS `tanggal_jadwal`, `a`.`id_gedung` AS `id_gedung`, `e`.`nama_gedung` AS `nama_gedung`, `a`.`id_ruangan` AS `id_ruangan`, concat_ws(' / ',`f`.`kode_ruangan`,`f`.`uraian_ruangan`) AS `nama_ruangan`, `a`.`id_item` AS `id_item`, concat_ws(' / ',`g`.`nama_item`,`g`.`merek_item`,`g`.`tipe_item`) AS `nama_item`, `a`.`id_pkrutin` AS `id_pkrutin`, `h`.`jenis_pekerjaan` AS `jenis_pekerjaan`, `h`.`uraian_pekerjaan` AS `uraian_pekerjaan` FROM ((((((`as_rutin_draft` `a` left join `mst_user` `c` on((`a`.`id_pembuat` = `c`.`id_user`))) left join `mst_user` `d` on((`a`.`id_user` = `d`.`id_user`))) left join `mst_gedung` `e` on((`a`.`id_gedung` = `e`.`id_gedung`))) left join `mst_ruangan` `f` on((`a`.`id_ruangan` = `f`.`id_ruangan`))) left join `mst_item` `g` on((`a`.`id_item` = `g`.`id_item`))) left join `mst_pkrutin` `h` on((`a`.`id_pkrutin` = `h`.`id_pkrutin`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_subkategori`
--
DROP TABLE IF EXISTS `view_subkategori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_subkategori`  AS SELECT `a`.`id_subkategori` AS `id_subkategori`, `b`.`id_kategori` AS `id_kategori`, `b`.`kode_kategori` AS `kode_kategori`, `b`.`uraian_kategori` AS `uraian_kategori`, `a`.`kode_subkategori` AS `kode_subkategori`, `a`.`uraian_subkategori` AS `uraian_subkategori`, `a`.`pk` AS `pk`, `a`.`arus_r` AS `arus_r`, `a`.`arus_s` AS `arus_s`, `a`.`arus_t` AS `arus_t`, `a`.`teg_r` AS `teg_r`, `a`.`teg_s` AS `teg_s`, `a`.`teg_t` AS `teg_t`, `a`.`teg_v` AS `teg_v`, `a`.`psi` AS `psi`, `a`.`oli` AS `oli`, `a`.`solar` AS `solar`, `a`.`radiator` AS `radiator`, `a`.`eng_hours` AS `eng_hours`, `a`.`accu` AS `accu`, `a`.`temp` AS `temp`, `a`.`kap` AS `kap`, `a`.`noice` AS `noice`, `a`.`qty` AS `qty`, `a`.`vol` AS `vol`, `a`.`tgl_kadaluarsa` AS `tgl_kadaluarsa`, `a`.`kondisi` AS `kondisi`, `a`.`tindakan` AS `tindakan` FROM (`mst_subkategori` `a` left join `mst_kategori` `b` on((`a`.`id_kategori` = `b`.`id_kategori`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `view_user`
--
DROP TABLE IF EXISTS `view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_user`  AS SELECT `a`.`id_user` AS `id_user`, `a`.`username` AS `username`, `a`.`nip` AS `nip`, `a`.`nama` AS `nama`, `a`.`spc` AS `spc`, `b`.`deskripsi_spc` AS `deskripsi_spc`, `a`.`alamat` AS `alamat`, `a`.`jabatan` AS `jabatan`, `a`.`j_kelamin` AS `j_kelamin`, (case when (`a`.`j_kelamin` = 'l') then 'Laki-laki' when (`a`.`j_kelamin` = 'p') then 'Perempuan' end) AS `j_kelamin_text`, `a`.`telepon` AS `telepon`, `a`.`email` AS `email`, `a`.`foto` AS `foto`, `a`.`created_at` AS `created_at`, `a`.`updated_at` AS `updated_at` FROM (`mst_user` `a` join `mst_akses_spc` `b`) WHERE (`a`.`spc` = `b`.`spc`)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `as_nonrutin`
--
ALTER TABLE `as_nonrutin`
  ADD PRIMARY KEY (`id_nonrutin`);

--
-- Indexes for table `as_rutin`
--
ALTER TABLE `as_rutin`
  ADD PRIMARY KEY (`id_rutin`);

--
-- Indexes for table `as_rutin_draft`
--
ALTER TABLE `as_rutin_draft`
  ADD PRIMARY KEY (`id_rutin_draft`);

--
-- Indexes for table `mst_akses_detail`
--
ALTER TABLE `mst_akses_detail`
  ADD PRIMARY KEY (`id_majabatan`);

--
-- Indexes for table `mst_akses_halaman`
--
ALTER TABLE `mst_akses_halaman`
  ADD PRIMARY KEY (`id_mahalaman`);

--
-- Indexes for table `mst_akses_spc`
--
ALTER TABLE `mst_akses_spc`
  ADD PRIMARY KEY (`id_maspc`);

--
-- Indexes for table `mst_gedung`
--
ALTER TABLE `mst_gedung`
  ADD PRIMARY KEY (`id_gedung`);

--
-- Indexes for table `mst_item`
--
ALTER TABLE `mst_item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `mst_pkrutin`
--
ALTER TABLE `mst_pkrutin`
  ADD PRIMARY KEY (`id_pkrutin`);

--
-- Indexes for table `mst_ruangan`
--
ALTER TABLE `mst_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `mst_ruangan_item`
--
ALTER TABLE `mst_ruangan_item`
  ADD PRIMARY KEY (`id_ruangan_item`);

--
-- Indexes for table `mst_subkategori`
--
ALTER TABLE `mst_subkategori`
  ADD PRIMARY KEY (`id_subkategori`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `as_nonrutin`
--
ALTER TABLE `as_nonrutin`
  MODIFY `id_nonrutin` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `as_rutin`
--
ALTER TABLE `as_rutin`
  MODIFY `id_rutin` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `as_rutin_draft`
--
ALTER TABLE `as_rutin_draft`
  MODIFY `id_rutin_draft` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mst_akses_detail`
--
ALTER TABLE `mst_akses_detail`
  MODIFY `id_majabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `mst_akses_halaman`
--
ALTER TABLE `mst_akses_halaman`
  MODIFY `id_mahalaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mst_akses_spc`
--
ALTER TABLE `mst_akses_spc`
  MODIFY `id_maspc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_gedung`
--
ALTER TABLE `mst_gedung`
  MODIFY `id_gedung` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mst_item`
--
ALTER TABLE `mst_item`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `mst_kategori`
--
ALTER TABLE `mst_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mst_pkrutin`
--
ALTER TABLE `mst_pkrutin`
  MODIFY `id_pkrutin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mst_ruangan`
--
ALTER TABLE `mst_ruangan`
  MODIFY `id_ruangan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `mst_ruangan_item`
--
ALTER TABLE `mst_ruangan_item`
  MODIFY `id_ruangan_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `mst_subkategori`
--
ALTER TABLE `mst_subkategori`
  MODIFY `id_subkategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
