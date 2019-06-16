-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2019 at 07:40 AM
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
-- Table structure for table `data_pekerjaan`
--

CREATE TABLE `data_pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `program` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `nama_pekerjaan` text NOT NULL,
  `tahun_perolehan` int(4) NOT NULL,
  `pagu_anggaran` int(11) NOT NULL,
  `nomor_kontrak` varchar(30) NOT NULL,
  `nilai_kontrak` int(11) NOT NULL,
  `pelaksana` varchar(255) NOT NULL,
  `panjang` int(11) NOT NULL,
  `lebar` int(11) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `satuan` int(11) NOT NULL,
  `jenis_pengadaan` int(11) NOT NULL,
  `waktu_pelaksanaan` varchar(100) NOT NULL,
  `status_kepemilikan` varchar(255) NOT NULL,
  `harga_perolehan` int(11) NOT NULL,
  `realisasi_keuangan` int(11) NOT NULL,
  `realisasi_fisik` int(3) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `koordinat_x` varchar(100) NOT NULL,
  `koordinat_y` varchar(100) NOT NULL,
  `penanggung_jawab` int(11) NOT NULL,
  `image_1` varchar(255) NOT NULL,
  `image_2` varchar(255) NOT NULL,
  `image_3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pekerjaan`
--

INSERT INTO `data_pekerjaan` (`id_pekerjaan`, `kode`, `program`, `kegiatan`, `nama_pekerjaan`, `tahun_perolehan`, `pagu_anggaran`, `nomor_kontrak`, `nilai_kontrak`, `pelaksana`, `panjang`, `lebar`, `tinggi`, `satuan`, `jenis_pengadaan`, `waktu_pelaksanaan`, `status_kepemilikan`, `harga_perolehan`, `realisasi_keuangan`, `realisasi_fisik`, `lokasi`, `koordinat_x`, `koordinat_y`, `penanggung_jawab`, `image_1`, `image_2`, `image_3`) VALUES
(1, '1.03.1.03.02.02.22', 16, 'Berkala Gedung Kantor', 'Pemeliharaan dan Rehab ...', 2019, 10000000, '001', 10000000, 'Computer Media Utama', 10, 5, 7, 2, 1, '30 hari kalender', 'dcktr', 9900000, 9900000, 50, 'Kotabaru', '-3.236536515731504', '116.22798402786407', 2, 'Tulips.jpg', 'b', 'a'),
(2, '1.03.1.03.02.02.22', 16, 'Berkala Gedung Kantor', 'Pemeliharaan dan Rehab ...', 2019, 10000000, '001', 10000000, 'Computer Media Utama', 10, 5, 7, 2, 1, '30 hari kalender', 'dcktr', 9900000, 9900000, 50, 'Kotabaru', '-3.236536515731504', '116.22798402786407', 2, 'Tulips.jpg', 'b', 'a'),
(3, '1.03.1.03.02.02.22', 16, 'Berkala Gedung Kantor', 'Pemeliharaan dan Rehab ...', 2019, 10000000, '001', 10000000, 'Computer Media Utama', 10, 5, 7, 2, 1, '30 hari kalender', 'dcktr', 9900000, 9900000, 50, 'Kotabaru', '-3.236536515731504', '116.22798402786407', 1, 'Tulips.jpg', 'b', 'a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`),
  ADD KEY `penanggung_jawab` (`penanggung_jawab`),
  ADD KEY `jenis_pengadaan` (`jenis_pengadaan`),
  ADD KEY `satuan` (`satuan`),
  ADD KEY `program` (`program`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_pekerjaan`
--
ALTER TABLE `data_pekerjaan`
  ADD CONSTRAINT `data_pekerjaan_ibfk_1` FOREIGN KEY (`satuan`) REFERENCES `data_satuan` (`id_satuan`),
  ADD CONSTRAINT `data_pekerjaan_ibfk_2` FOREIGN KEY (`penanggung_jawab`) REFERENCES `data_bidang` (`id_bidang`),
  ADD CONSTRAINT `data_pekerjaan_ibfk_3` FOREIGN KEY (`jenis_pengadaan`) REFERENCES `data_jenis_pengadaan` (`id_jenis_pengadaan`),
  ADD CONSTRAINT `data_pekerjaan_ibfk_4` FOREIGN KEY (`program`) REFERENCES `data_program` (`id_program`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
