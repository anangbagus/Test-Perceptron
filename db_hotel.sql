-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 08:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `gambar_kamar`
--

CREATE TABLE `gambar_kamar` (
  `ID_gambar` int(11) NOT NULL,
  `gambar` varchar(20) NOT NULL,
  `ID_tipe_kamar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kamar_hotel`
--

CREATE TABLE `kamar_hotel` (
  `ID_kamar` int(11) NOT NULL,
  `ID_tipe_kamar` int(11) NOT NULL,
  `status_kamar` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar_hotel`
--

INSERT INTO `kamar_hotel` (`ID_kamar`, `ID_tipe_kamar`, `status_kamar`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 1, 0),
(4, 1, 0),
(5, 2, 0),
(6, 2, 0),
(7, 2, 0),
(8, 2, 0),
(9, 3, 0),
(10, 3, 0),
(11, 3, 0),
(12, 3, 0),
(13, 4, 0),
(14, 4, 0),
(15, 4, 0),
(16, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_kamar`
--

CREATE TABLE `reservasi_kamar` (
  `ID_reservasi` int(11) NOT NULL,
  `ID_kamar` int(11) NOT NULL,
  `tgl_checkin` datetime NOT NULL,
  `tgl_checkout` datetime NOT NULL,
  `nama_customer` varchar(35) NOT NULL,
  `NIK_customer` char(16) NOT NULL,
  `email` varchar(35) NOT NULL,
  `nomor_hp` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservasi_kamar`
--

INSERT INTO `reservasi_kamar` (`ID_reservasi`, `ID_kamar`, `tgl_checkin`, `tgl_checkout`, `nama_customer`, `NIK_customer`, `email`, `nomor_hp`) VALUES
(5, 1, '2021-06-01 23:10:28', '2021-06-02 23:10:28', 'Alim Ikegami', '1908561046', 'alimikegami1@gmail.com', '081239990127'),
(6, 1, '2021-06-03 23:10:28', '2021-06-04 23:10:28', 'Alim Ikegami', '1908561046', 'alimikegami1@gmail.com', '081239990127'),
(7, 1, '2021-06-05 23:18:21', '2021-06-06 23:18:21', 'Alim Ikegami', '1908561046', 'alimikegami1@gmail.com', '081239990127');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `ID_tipe_kamar` int(11) NOT NULL,
  `tipe` varchar(25) NOT NULL,
  `harga_per_malam` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`ID_tipe_kamar`, `tipe`, `harga_per_malam`, `kapasitas`) VALUES
(1, 'standart', 20000, 100),
(2, 'superior', 30000, 100),
(3, 'junior suite', 50000, 100),
(4, 'deluxe', 40000, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gambar_kamar`
--
ALTER TABLE `gambar_kamar`
  ADD PRIMARY KEY (`ID_gambar`),
  ADD KEY `ID_tipe_kamar` (`ID_tipe_kamar`);

--
-- Indexes for table `kamar_hotel`
--
ALTER TABLE `kamar_hotel`
  ADD PRIMARY KEY (`ID_kamar`),
  ADD KEY `ID_tipe_kamar` (`ID_tipe_kamar`);

--
-- Indexes for table `reservasi_kamar`
--
ALTER TABLE `reservasi_kamar`
  ADD PRIMARY KEY (`ID_reservasi`),
  ADD KEY `ID_kamar` (`ID_kamar`);

--
-- Indexes for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`ID_tipe_kamar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gambar_kamar`
--
ALTER TABLE `gambar_kamar`
  MODIFY `ID_gambar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar_hotel`
--
ALTER TABLE `kamar_hotel`
  MODIFY `ID_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reservasi_kamar`
--
ALTER TABLE `reservasi_kamar`
  MODIFY `ID_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `ID_tipe_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gambar_kamar`
--
ALTER TABLE `gambar_kamar`
  ADD CONSTRAINT `gambar_kamar_ibfk_1` FOREIGN KEY (`ID_tipe_kamar`) REFERENCES `tipe_kamar` (`ID_tipe_kamar`);

--
-- Constraints for table `kamar_hotel`
--
ALTER TABLE `kamar_hotel`
  ADD CONSTRAINT `kamar_hotel_ibfk_1` FOREIGN KEY (`ID_tipe_kamar`) REFERENCES `tipe_kamar` (`ID_tipe_kamar`);

--
-- Constraints for table `reservasi_kamar`
--
ALTER TABLE `reservasi_kamar`
  ADD CONSTRAINT `reservasi_kamar_ibfk_2` FOREIGN KEY (`ID_kamar`) REFERENCES `kamar_hotel` (`ID_kamar`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
