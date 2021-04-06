-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2021 at 02:53 AM
-- Server version: 10.4.10-MariaDB-log
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `qty` double NOT NULL,
  `total_harga` double NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_paket`, `qty`, `total_harga`, `total_bayar`) VALUES
(16, 36, 20, 20, 44000, 500000),
(17, 37, 20, 50, 110000, 200000),
(18, 39, 21, 15, 21000, 25000),
(19, 40, 20, 10, 22000, 0),
(20, 41, 20, 10, 22000, 50000),
(21, 42, 20, 3, 6600, 6600),
(22, 48, 20, 3, 6600, 6600),
(23, 89, 20, 1, 2200, 0),
(24, 90, 20, 3, 6600, 0),
(25, 91, 20, 1, 2200, 2800),
(26, 92, 20, 1, 2200, 2200),
(27, 93, 20, 100, 220000, 220000);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `id_outlet` int(11) NOT NULL,
  `nama_outlet` varchar(228) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alamat_outlet` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `telp_outlet` varchar(15) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`id_outlet`, `nama_outlet`, `alamat_outlet`, `telp_outlet`) VALUES
(9, 'Outlet Merah', 'Yogyakarta, Indonesia', '08555555555'),
(10, 'Outlet Putih', 'Bantul, Yogyakarta, Indonesia', '081222222222'),
(11, 'Outlet Biru', 'Bengkulu', '081223446312'),
(12, 'Outlet Abu-abu', 'Bengkulu', '0826377453886'),
(19, 'Outlet Navy', 'Jl. Jalan', '0828293823');

-- --------------------------------------------------------

--
-- Table structure for table `paket_cuci`
--

CREATE TABLE `paket_cuci` (
  `id_paket` int(11) NOT NULL,
  `jenis_paket` enum('kiloan','selimut','bedcover','kaos','lain') NOT NULL,
  `nama_paket` varchar(228) NOT NULL,
  `harga` int(11) NOT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_cuci`
--

INSERT INTO `paket_cuci` (`id_paket`, `jenis_paket`, `nama_paket`, `harga`, `outlet_id`) VALUES
(20, 'selimut', 'Paket Wangi Tahan Lama', 2200, 9),
(21, 'kaos', 'Paket Cepat Kering', 1400, 10),
(22, 'selimut', 'Paket Harum', 1500, 11),
(23, 'kiloan', 'Paket Kering Wangi', 2500, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(228) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp_pelanggan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `jenis_kelamin`, `telp_pelanggan`) VALUES
(23, 'Lulu', 'Imogiri, ffff', 'P', '088888888888'),
(24, 'Lolo', 'Jl Bantul, Yogyakarta', 'L', '0821123311131'),
(25, 'Apip Luki', 'Imogiri, Bantul', 'L', '08123456244567');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `kode_invoice` varchar(228) CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl` datetime DEFAULT NULL,
  `batas_waktu` datetime DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL,
  `diskon` double DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `status` enum('baru','proses','selesai','diambil') CHARACTER SET utf8mb4 DEFAULT NULL,
  `status_bayar` enum('dibayar','belum') CHARACTER SET utf8mb4 DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `outlet_id`, `kode_invoice`, `id_pelanggan`, `tgl`, `batas_waktu`, `tgl_pembayaran`, `biaya_tambahan`, `diskon`, `pajak`, `status`, `status_bayar`, `id_user`) VALUES
(36, 9, 'CLN202009033737', 23, '2020-09-03 04:37:43', '2020-09-10 12:00:00', '2021-01-01 04:40:03', 0, 0, 0, 'baru', 'dibayar', NULL),
(37, 9, 'CLN202009035702', 23, '2020-09-03 05:03:37', '2020-09-10 12:00:00', '2021-01-20 05:08:28', 0, 0, 0, 'baru', 'dibayar', NULL),
(39, 10, 'CLN202009034317', 24, '2020-09-03 05:19:12', '2020-09-10 12:00:00', '2021-02-02 05:21:41', 0, 0, 0, 'baru', 'dibayar', 7),
(40, 9, 'CLN202009040521', 24, '2020-09-04 03:21:09', '2020-09-11 12:00:00', NULL, 0, 0, 0, 'baru', 'belum', NULL),
(41, 9, 'CLN202009040528', 25, '2020-09-04 03:28:21', '2020-09-11 12:00:00', '2021-03-10 03:29:00', 0, 0, 0, 'selesai', 'dibayar', NULL),
(42, 9, 'CLN202103232155', 25, '2021-03-23 11:55:40', '2021-03-30 12:00:00', '2021-03-23 11:57:06', 5, 5, 10, 'selesai', 'dibayar', NULL),
(48, 9, 'ELDY202103261303', 23, '2021-03-26 01:03:22', '2021-04-02 12:00:00', '2021-03-28 10:43:19', 0, 0, 0, 'baru', 'dibayar', NULL),
(89, 9, 'CLN202103274503', 24, '2021-03-27 04:03:54', '2021-04-03 12:00:00', NULL, 0, 0, 0, 'baru', 'belum', 9),
(90, 9, 'CLN202103270804', 25, '2021-03-27 04:04:21', '2021-04-03 12:00:00', NULL, 0, 0, 10, 'baru', 'belum', 9),
(91, 9, 'CLN202103285842', 23, '2021-03-28 10:43:02', '2021-04-04 12:00:00', '2021-03-28 12:37:03', 0, 0, 0, 'baru', 'dibayar', 9),
(92, 9, 'CLN202104022825', 23, '2021-04-02 03:25:31', '2021-04-09 12:00:00', '2021-04-02 03:25:44', 0, 0, 0, 'baru', 'dibayar', 14),
(93, 9, 'CLN202104020640', 23, '2021-04-02 04:40:12', '2021-04-09 12:00:00', '2021-04-02 04:40:29', 0, 0, 0, 'baru', 'dibayar', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(228) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(228) CHARACTER SET utf8mb4 DEFAULT NULL,
  `password` varchar(228) CHARACTER SET utf8mb4 DEFAULT NULL,
  `outlet_id` int(11) DEFAULT NULL,
  `role` enum('admin','kasir','owner') CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `outlet_id`, `role`) VALUES
(3, 'Owner', 'owner', '$2y$10$yrrnnVyFze2oPziCcPNck.lKr3sDIUx7iNnZL5HcEYMPZpq/TD9my', 10, 'owner'),
(6, 'Kasir Merah', 'kasirmerah', '$2y$10$h31rk9fts/0G2rw7YL1Sue3frlg0nPw5mUnQWEmhIX.VvV4qZQbgG', NULL, 'kasir'),
(7, 'Kasir Putih', 'kasirputih', '$2y$10$VaU8iE4Rvo5lnmLbtFCv..YlTesg1CcqHOQKF66qEVBlkBezMdXui', NULL, 'kasir'),
(9, 'Fawaz', 'fawaz', '$2y$10$hUWIATv9.PTeyvzV47riku72g1bGPUbkVN1ixAchcM14pESf8Coi6', NULL, 'admin'),
(14, 'Admin', 'admin', '$2y$10$mAwl0c3JADwoWIjJcHWG6uWSNPKRIy/.zd6KTrZayB79Itr7HYt9u', 9, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id_outlet`);

--
-- Indexes for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id_outlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_4` FOREIGN KEY (`id_paket`) REFERENCES `paket_cuci` (`id_paket`) ON UPDATE CASCADE;

--
-- Constraints for table `paket_cuci`
--
ALTER TABLE `paket_cuci`
  ADD CONSTRAINT `paket_cuci_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_cuci_ibfk_2` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_6` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`id_outlet`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
