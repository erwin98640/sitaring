-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 06:26 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maping`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_program`
--

CREATE TABLE `data_program` (
  `id_program` int(11) NOT NULL,
  `nama_program` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_program`
--

INSERT INTO `data_program` (`id_program`, `nama_program`) VALUES
(1, 'Program Pelayanan Administrasi Perkantoran'),
(2, 'Program Peningkatan Sarana Dan Prasarana Aparatur'),
(4, 'Program peningkatan Disiplin Aparatur'),
(5, 'Program Peningkatan Pengembangan Sistem Pelaporan Capaian Kinerja dan Keuangan SKPD'),
(6, 'Program Lingkungan Sehat Perumahan'),
(7, 'Program Pembangunan Saluran Drainase / Gorong-gorong'),
(8, 'Program Peningkatan Infrastruktur Pendukung Kawasan Perkotaan dan Perdesaan'),
(9, 'Program Pengelolaan Areal Pemakaman'),
(10, 'Program Pengelolaan Ruang Terbuka Hijau (RTH)'),
(11, 'Program Penyediaan dan Pengolahan Air Baku'),
(12, 'Program Pengembangan Kinerja Pengelolaan Air Minum dan Air Limbah'),
(13, 'Program Pengembangan Wilayah Startegis dan Cepat Tumbuh'),
(14, 'Program Pembangunan Infrastruktur Perdesaan'),
(15, 'Program Pengaturan dan Pemberdayaan Masyarakat Jasa Konstruksi'),
(16, 'Program Perencanaan Tata Ruang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_program`
--
ALTER TABLE `data_program`
  ADD PRIMARY KEY (`id_program`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_program`
--
ALTER TABLE `data_program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
