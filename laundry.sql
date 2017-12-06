-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2017 at 07:45 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

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
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(255) NOT NULL,
  `oauth_provider` varchar(8) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `oauth_provider`, `email`, `password`, `nama`, `alamat`, `no_telp`) VALUES
('', 'local', 'santoso.db@gmail.com', '7d49e40f4b3d8f68c19406a58303f826', 'Dimas Bagus Santoso', 'Gresik', '928289'),
('1', 'local', 'foo@example.com', 'acbd18db4cc2f85cedef654fccc4a4d8', 'foo', 'Jl. Kusuma Bangsa no 38, Surabaya', '082257775888'),
('1940081209540417', 'Facebook', 'magnoliagrandiflora.kf@gmail.com', '', 'Kurniatul Faiqoh', '', ''),
('3', 'local', 'law@heartp.com', '829a56cc8ffa56209e3a10b80d0bbdf8', 'Trafalgar Law', '', ''),
('4', 'local', 'kei@gmail.com', 'f81ddf1b248decf35aad5d26687cf6c6', 'Kei Takebuchi', ' Surabaya\r\n                    ', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(25) NOT NULL,
  `nama_layanan` varchar(25) DEFAULT NULL,
  `biaya_layanan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `biaya_layanan`) VALUES
(1, 'Laundry Cleaning', 15000),
(2, 'Dry Cleaning', 20000),
(4, 'Cuci Jas', 27000);

-- --------------------------------------------------------

--
-- Table structure for table `list_order`
--

CREATE TABLE `list_order` (
  `id_order` int(255) NOT NULL,
  `no_nota` varchar(25) NOT NULL,
  `id_layanan` int(25) DEFAULT NULL,
  `id_pegawai` int(255) DEFAULT NULL,
  `id_user` varchar(255) DEFAULT NULL,
  `berat` int(255) NOT NULL,
  `tgl_order` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu',
  `bayar` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_order`
--

INSERT INTO `list_order` (`id_order`, `no_nota`, `id_layanan`, `id_pegawai`, `id_user`, `berat`, `tgl_order`, `tgl_selesai`, `status`, `bayar`) VALUES
(1, 'TR001', 1, 7, '1', 10, '2017-01-25', '2017-01-28', 'Selesai', 200000),
(3, 'TR002', 1, 7, '1', 12, '2017-02-25', '2017-02-28', 'Selesai', 150000),
(7, 'TR003', 2, 11, '1', 4, '2017-03-02', '0000-03-00', 'Selesai', 10000),
(10, 'TR005', 2, 11, '1940081209540417', 2, '2017-05-03', '2017-05-06', 'Selesai', 50000),
(11, 'TR006', 1, 7, '4', 3, '2017-06-10', '2017-06-13', 'Selesai', 50000),
(12, 'TR007', 2, 7, '1', 2, '2017-07-10', '2017-07-13', 'Selesai', 50000),
(13, 'TR008', 1, 7, '3', 2, '2017-08-10', '2017-08-13', 'Selesai', 30000),
(14, 'TR009', 1, 7, '1940081209540417', 5, '2017-09-10', '2017-09-13', 'Selesai', 100000),
(15, 'TR010', 1, 7, '1', 2, '2017-10-10', '2017-10-13', 'Selesai', 30000),
(16, 'TR011', 2, 7, '1', 5, '2017-11-10', '2017-11-13', 'Selesai', 100000),
(17, 'TR012', 1, 7, '4', 2, '2017-12-10', '2017-12-13', 'Selesai', 50000),
(18, 'TR013', 1, 7, '3', 2, '2017-12-10', '2017-12-13', 'Selesai', 50000),
(19, 'TR014', 2, 7, '1940081209540417', 3, '2017-07-10', '2017-07-13', 'Selesai', 60000),
(20, 'TR015', 2, 7, '1940081209540417', 2, '2017-07-10', '2017-07-13', 'Selesai', 50000),
(21, 'TR016', 2, 7, '3', 6, '2017-07-10', '2017-07-13', 'Proses', 0),
(22, 'TR017', 1, 7, '4', 4, '2017-07-10', '2017-07-13', 'Menunggu', 0),
(23, 'TR018', 2, 7, '3', 2, '2017-07-10', '2017-07-13', 'Menunggu', 0),
(25, 'TR020', 1, 7, '1940081209540417', 2, '2017-07-10', '2017-07-13', 'Menunggu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tipe` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `nama`, `tipe`) VALUES
(7, 'admin', 'fdb28763c569927d644fc081c598ac09', 'Administrator', 1),
(8, 'paijo', 'd94c6b366ceadf6e683cab25c8d59dba', 'Paijo Paimin', 2),
(10, 'paimin', '0259c44563bb74e14efe6d4e30688a34', 'Paimin ', 3),
(11, 'astuti', 'accc56e8022c3d25865b0680f58f3477', 'Astuti', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pegawai`
--

CREATE TABLE `tipe_pegawai` (
  `id` int(8) NOT NULL,
  `tipe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_pegawai`
--

INSERT INTO `tipe_pegawai` (`id`, `tipe`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `list_order`
--
ALTER TABLE `list_order`
  ADD PRIMARY KEY (`id_order`),
  ADD UNIQUE KEY `no_nota` (`no_nota`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `tipe_order` (`id_layanan`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `email` (`username`),
  ADD KEY `tipe` (`tipe`);

--
-- Indexes for table `tipe_pegawai`
--
ALTER TABLE `tipe_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `list_order`
--
ALTER TABLE `list_order`
  MODIFY `id_order` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tipe_pegawai`
--
ALTER TABLE `tipe_pegawai`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_order`
--
ALTER TABLE `list_order`
  ADD CONSTRAINT `list_order_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `list_order_ibfk_3` FOREIGN KEY (`id_layanan`) REFERENCES `layanan` (`id_layanan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `list_order_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`tipe`) REFERENCES `tipe_pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
