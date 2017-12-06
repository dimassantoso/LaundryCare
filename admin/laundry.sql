-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2017 at 04:31 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
  `id_customer` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `email`, `password`, `nama`, `alamat`, `no_telp`) VALUES
(1, 'foo@example.com', 'foo', 'foo', 'Jl. Kusuma Bangsa no 38, Surabaya', '082257775888'),
(2, 'bar@example.com', 'bar', 'bar', 'Jl. Ambengan no 55, Surabaya', '0882222227');

-- --------------------------------------------------------

--
-- Table structure for table `list_order`
--

CREATE TABLE `list_order` (
  `id_order` int(255) NOT NULL,
  `no_nota` varchar(25) NOT NULL,
  `tipe_order` int(25) DEFAULT NULL,
  `id_pegawai` int(255) DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL,
  `berat` int(255) NOT NULL,
  `tgl_order` date NOT NULL,
  `tg_selesai` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `biaya` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `tipe` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `nama`, `alamat`, `no_telp`, `tipe`) VALUES
(2, 'magno@example.com', 'magno', 'magno', 'Jl. Emerald, no 55', '083123456789', 1),
(3, 'kfaiqoh@outlook.com', '123', 'faiqoh', 'Jl. Emerald no 25', '088888888888', 3),
(4, 'dbsantoso@gmail.com', '123', 'samid', 'Jl. Topaz no 56', '088234567876', 3),
(5, 'kyrie@example.com', 'kyrie', 'kyrie', 'Jl. Amethyst no 10', '021123456', 2),
(6, 'default@laundry.com', 'def', 'default', 'xyz', '000', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_order`
--

CREATE TABLE `tipe_order` (
  `id` int(25) NOT NULL,
  `tipe` varchar(25) DEFAULT NULL,
  `harga_per_kg` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipe_order`
--

INSERT INTO `tipe_order` (`id`, `tipe`, `harga_per_kg`) VALUES
(1, 'Laundry Cleaning', 15000),
(2, 'Dry Cleaning', 20000);

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
-- Indexes for table `list_order`
--
ALTER TABLE `list_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `tipe_order` (`tipe_order`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `email` (`username`),
  ADD KEY `tipe` (`tipe`);

--
-- Indexes for table `tipe_order`
--
ALTER TABLE `tipe_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipe_pegawai`
--
ALTER TABLE `tipe_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `list_order`
--
ALTER TABLE `list_order`
  MODIFY `id_order` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tipe_order`
--
ALTER TABLE `tipe_order`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  ADD CONSTRAINT `list_order_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `list_order_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `list_order_ibfk_3` FOREIGN KEY (`tipe_order`) REFERENCES `tipe_order` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`tipe`) REFERENCES `tipe_pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
