-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 06:01 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NAMA_ADMIN` varchar(50) DEFAULT NULL,
  `USERNAME_ADMIN` varchar(20) DEFAULT NULL,
  `EMAIL_ADMIN` varchar(50) DEFAULT NULL,
  `PASSWORD_ADMIN` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `NAMA_ADMIN`, `USERNAME_ADMIN`, `EMAIL_ADMIN`, `PASSWORD_ADMIN`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `ID_JABATAN` int(11) NOT NULL,
  `JABATAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`ID_JABATAN`, `JABATAN`) VALUES
(1, 'Kepala Bidang'),
(2, 'Kepala Seksi'),
(3, 'Staf'),
(4, 'Kepala Dinas');

-- --------------------------------------------------------

--
-- Table structure for table `masa_skp`
--

CREATE TABLE `masa_skp` (
  `ID` int(11) NOT NULL,
  `ID_STATUS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masa_skp`
--

INSERT INTO `masa_skp` (`ID`, `ID_STATUS`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kerja`
--

CREATE TABLE `nilai_kerja` (
  `ID_PENILAIAN` int(11) NOT NULL,
  `NIP` varchar(50) DEFAULT NULL,
  `ORIENTASI_PELAYANAN` float DEFAULT NULL,
  `INTEGRITAS` float DEFAULT NULL,
  `KOMITMEN` float DEFAULT NULL,
  `DISIPLIN` float DEFAULT NULL,
  `KERJASAMA` float DEFAULT NULL,
  `KEPEMIMPINAN` float DEFAULT NULL,
  `JUMLAH` float DEFAULT NULL,
  `NILAI_RATA` float DEFAULT NULL,
  `TGL_NILAI` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_kerja`
--

INSERT INTO `nilai_kerja` (`ID_PENILAIAN`, `NIP`, `ORIENTASI_PELAYANAN`, `INTEGRITAS`, `KOMITMEN`, `DISIPLIN`, `KERJASAMA`, `KEPEMIMPINAN`, `JUMLAH`, `NILAI_RATA`, `TGL_NILAI`) VALUES
(3, '197705272010011003', 80, 80, 80, 80, 80, 0, 400, 80, '2018-07-10'),
(4, '197602022006041018', 80, 80, 80, 80, 80, 80, 480, 96, '2018-07-11'),
(5, '196510131986031008', 80, 80, 80, 80, 80, 80, 480, 96, '2018-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `ID_PANGKAT` int(11) NOT NULL,
  `JENIS_PANGKAT` varchar(50) DEFAULT NULL,
  `GOLONGAN` varchar(10) DEFAULT NULL,
  `RUANG` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`ID_PANGKAT`, `JENIS_PANGKAT`, `GOLONGAN`, `RUANG`) VALUES
(1, 'Pembina Utama', 'IV', 'e'),
(2, 'Pembina Utama Madya', 'IV', 'd'),
(3, 'Pembina Utama Muda', 'IV', 'c'),
(4, 'Pembina Tingkat I', 'IV', 'b'),
(5, 'Pembina', 'IV', 'a'),
(6, 'Penata Tingkat I', 'III', 'd'),
(7, 'Penata', 'III', 'c'),
(8, 'Penata Muda Tingkat I', 'III', 'b'),
(9, 'Penata Muda', 'III', 'a'),
(10, 'Pengatur Tingkat I', 'II', 'd'),
(11, 'Pengatur', 'II', 'c'),
(12, 'Pengatur Muda Tingkat I', 'II', 'b'),
(13, 'Pengatur Muda', 'II', 'a'),
(14, 'Juru Tingkat I', 'I', 'd'),
(15, 'Juru', 'I', 'c'),
(16, 'Juru Muda Tingkat I', 'I', 'b'),
(17, 'Juru Muda', 'I', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `posisi_jabatan`
--

CREATE TABLE `posisi_jabatan` (
  `ID_POSISI_JABATAN` int(11) NOT NULL,
  `POSISI_JABATAN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posisi_jabatan`
--

INSERT INTO `posisi_jabatan` (`ID_POSISI_JABATAN`, `POSISI_JABATAN`) VALUES
(1, 'Bidang Pengelolaan Informasi Adm. Kependudukan'),
(2, 'Sistem Informasi Administrasi Kependudukan'),
(3, 'Pengelolaan dan Penyajian Data Kependudukan'),
(4, 'Tata Kelola dan SDM Tekno, Info dan Komunikasi'),
(5, 'Dinas Kependudukan & Pencatatan Sipil Kab. Bangkalan');

-- --------------------------------------------------------

--
-- Table structure for table `realisasi`
--

CREATE TABLE `realisasi` (
  `ID_REALISASI` int(11) NOT NULL,
  `ID_STATUS` int(11) DEFAULT NULL,
  `ID_SKP` int(11) DEFAULT NULL,
  `NIP` varchar(50) DEFAULT NULL,
  `R_AK` int(11) DEFAULT NULL,
  `R_KUANT_OUTPUT` varchar(10) DEFAULT NULL,
  `R_KUAL_MUTU` varchar(4) DEFAULT NULL,
  `R_WAKTU` varchar(10) DEFAULT NULL,
  `R_BIAYA` varchar(10) DEFAULT NULL,
  `PENGHITUNGAN` float DEFAULT NULL,
  `NILAI_CAPAI_SKP` float DEFAULT NULL,
  `TGL_REALISASI` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realisasi`
--

INSERT INTO `realisasi` (`ID_REALISASI`, `ID_STATUS`, `ID_SKP`, `NIP`, `R_AK`, `R_KUANT_OUTPUT`, `R_KUAL_MUTU`, `R_WAKTU`, `R_BIAYA`, `PENGHITUNGAN`, `NILAI_CAPAI_SKP`, `TGL_REALISASI`) VALUES
(3, 7, 4, '197705272010011003', 0, '50 Kali', '85%', '8 Bulan', '0', 290.487, 96.8291, '2018-07-10'),
(4, 7, 5, '197705272010011003', 0, '50 Kali', '85%', '8 Bulan', '0', 290.487, 96.8291, '2018-07-10'),
(5, 7, 6, '197602022006041018', 0, '52 Kali', '100%', '12 Bulan', '0', 276, 92, '2018-07-11'),
(6, 7, 7, '196510131986031008', 0, '52 Kali', '100%', '12 Bulan', '0', 276, 92, '2018-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_admin`
--

CREATE TABLE `riwayat_admin` (
  `ID_ADMIN` int(11) DEFAULT NULL,
  `AKTIVITAS_ADMIN` varchar(150) DEFAULT NULL,
  `TGL_RIWAYAT_ADMIN` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skp`
--

CREATE TABLE `skp` (
  `ID_SKP` int(11) NOT NULL,
  `ID_STATUS` int(11) DEFAULT NULL,
  `NIP` varchar(50) DEFAULT NULL,
  `KEGIATAN` varchar(255) DEFAULT NULL,
  `AK` int(11) DEFAULT NULL,
  `KUANT_OUTPUT` varchar(10) DEFAULT NULL,
  `KUAL_MUTU` varchar(4) DEFAULT NULL,
  `WAKTU` varchar(10) DEFAULT NULL,
  `BIAYA` varchar(10) DEFAULT NULL,
  `TGL_SKP` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skp`
--

INSERT INTO `skp` (`ID_SKP`, `ID_STATUS`, `NIP`, `KEGIATAN`, `AK`, `KUANT_OUTPUT`, `KUAL_MUTU`, `WAKTU`, `BIAYA`, `TGL_SKP`) VALUES
(4, 2, '197705272010011003', 'data1', 0, '52 Kali', '100%', '12 Bulan', '0', '2018-07-10'),
(5, 2, '197705272010011003', 'data2', 0, '52 Kali', '100%', '12 Bulan', '0', '2018-07-10'),
(6, 2, '197602022006041018', 'data1', 0, '52 Kali', '100%', '12 Bulan', '0', '2018-07-11'),
(7, 2, '196510131986031008', 'dataskp1', 0, '52 Kali', '100%', '12 Bulan', '0', '2018-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID_STATUS` int(11) NOT NULL,
  `STATUS` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID_STATUS`, `STATUS`) VALUES
(1, 'Belum ada status'),
(2, 'Diterima'),
(3, 'Ditolak'),
(4, 'Tidak diketahui'),
(5, 'SKP aktif'),
(6, 'SKP nonaktif'),
(7, 'Sudah dinilai');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `NIP` varchar(50) NOT NULL,
  `ID_PANGKAT` int(11) DEFAULT NULL,
  `ID_JABATAN` int(11) DEFAULT NULL,
  `ID_POSISI_JABATAN` int(11) DEFAULT NULL,
  `NAMA` varchar(50) DEFAULT NULL,
  `UNIT_KERJA` varchar(50) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`NIP`, `ID_PANGKAT`, `ID_JABATAN`, `ID_POSISI_JABATAN`, `NAMA`, `UNIT_KERJA`, `USERNAME`, `EMAIL`, `PASSWORD`) VALUES
('196008231986031015', 6, 2, 4, 'Abdul Hamed', 'DISPENDUK &amp; PENCAPIL KAB. BANGKALAN', 'kasi3', 'kasi3@gmail.com', '0dcd0880b3afc5afa4ce0dee113751415961aed8b8bc6ef09a3e3da2cab1b31f'),
('196212311981121018', 5, 1, 1, 'Syamsul Bakri, SH, MM.', 'DISPENDUK &amp; PENCAPIL KAB. BANGKALAN', 'kabidd', 'kabid@gmail.com', 'cb6fa7e5fe5f44780bd935ec9cb84bc76a8798c2b795afa35be18733e4e40fe2'),
('196510131986031008', 6, 2, 3, 'Salamet Riyadi, S.Sos.', 'DISPENDUK &amp; PENCAPIL KAB. BANGKALAN', 'kasi', 'kasi2@gmail.com', '1f2410e16b43853dc1a60fedfd90d5a3dc0d5d75abdc38688b2e65173154449f'),
('197405131993021001', 4, 4, 5, 'Rudiyanto, S.Sos, MM.', 'DISPENDUK &amp; PENCAPIL KAB. BANGKALAN', 'Kadis', 'kadis@gmail.com', '6b01bc75b34b72327279d17a606be97c5fe1667341d33101d770bcc4f9228e11'),
('197602022006041018', 6, 2, 2, 'Anang Afandi, S.Kom.', 'DISPENDUK &amp; PENCAPIL KAB. BANGKALAN', 'kasi1', 'kasi1@gmail.com', '5cc798a66238744a7b5f0bb78c5c03573eda3137aab1414bcb5f4e6b2fdecb7a'),
('197705272010011003', 8, 3, 2, 'Bachtiar Arief Budiman, SH.MM.', 'DISPENDUK &amp; PENCAPIL KAB. BANGKALAN', 'staf', 'staf1@gmail.com', '921713b90740f1d81d1b863650b20f43edf424005838232f154bb255b0558abd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`ID_JABATAN`);

--
-- Indexes for table `masa_skp`
--
ALTER TABLE `masa_skp`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_MASA_SKP_PUNYA_STATUS` (`ID_STATUS`);

--
-- Indexes for table `nilai_kerja`
--
ALTER TABLE `nilai_kerja`
  ADD PRIMARY KEY (`ID_PENILAIAN`),
  ADD KEY `FK_MEMBERI_NILAI` (`NIP`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`ID_PANGKAT`);

--
-- Indexes for table `posisi_jabatan`
--
ALTER TABLE `posisi_jabatan`
  ADD PRIMARY KEY (`ID_POSISI_JABATAN`);

--
-- Indexes for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD PRIMARY KEY (`ID_REALISASI`),
  ADD KEY `FK_MENILAI_REALISASI` (`NIP`),
  ADD KEY `FK_REALISASI_PUNYA_STATUS` (`ID_STATUS`),
  ADD KEY `FK_SKP_UNTUK_NILAI_REALISASI` (`ID_SKP`);

--
-- Indexes for table `riwayat_admin`
--
ALTER TABLE `riwayat_admin`
  ADD KEY `FK_ADMIN_PUNYA_RIWAYAT` (`ID_ADMIN`);

--
-- Indexes for table `skp`
--
ALTER TABLE `skp`
  ADD PRIMARY KEY (`ID_SKP`),
  ADD KEY `FK_SKP_PUNYA_STATUS` (`ID_STATUS`),
  ADD KEY `FK_USER_ISI_SKP` (`NIP`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_STATUS`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `FK_USER_MEMPUNYAI_JABATAN` (`ID_JABATAN`),
  ADD KEY `FK_USER_PUNYA_PANGKAT` (`ID_PANGKAT`),
  ADD KEY `FK_USER_PUNYA_POSISI_JABATAN` (`ID_POSISI_JABATAN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `ID_JABATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nilai_kerja`
--
ALTER TABLE `nilai_kerja`
  MODIFY `ID_PENILAIAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `ID_PANGKAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `posisi_jabatan`
--
ALTER TABLE `posisi_jabatan`
  MODIFY `ID_POSISI_JABATAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `realisasi`
--
ALTER TABLE `realisasi`
  MODIFY `ID_REALISASI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `skp`
--
ALTER TABLE `skp`
  MODIFY `ID_SKP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ID_STATUS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `masa_skp`
--
ALTER TABLE `masa_skp`
  ADD CONSTRAINT `FK_MASA_SKP_PUNYA_STATUS` FOREIGN KEY (`ID_STATUS`) REFERENCES `status` (`ID_STATUS`);

--
-- Constraints for table `nilai_kerja`
--
ALTER TABLE `nilai_kerja`
  ADD CONSTRAINT `FK_MEMBERI_NILAI` FOREIGN KEY (`NIP`) REFERENCES `user` (`NIP`);

--
-- Constraints for table `realisasi`
--
ALTER TABLE `realisasi`
  ADD CONSTRAINT `FK_MENILAI_REALISASI` FOREIGN KEY (`NIP`) REFERENCES `user` (`NIP`),
  ADD CONSTRAINT `FK_REALISASI_PUNYA_STATUS` FOREIGN KEY (`ID_STATUS`) REFERENCES `status` (`ID_STATUS`),
  ADD CONSTRAINT `FK_SKP_UNTUK_NILAI_REALISASI` FOREIGN KEY (`ID_SKP`) REFERENCES `skp` (`ID_SKP`);

--
-- Constraints for table `riwayat_admin`
--
ALTER TABLE `riwayat_admin`
  ADD CONSTRAINT `FK_ADMIN_PUNYA_RIWAYAT` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Constraints for table `skp`
--
ALTER TABLE `skp`
  ADD CONSTRAINT `FK_SKP_PUNYA_STATUS` FOREIGN KEY (`ID_STATUS`) REFERENCES `status` (`ID_STATUS`),
  ADD CONSTRAINT `FK_USER_ISI_SKP` FOREIGN KEY (`NIP`) REFERENCES `user` (`NIP`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_MEMPUNYAI_JABATAN` FOREIGN KEY (`ID_JABATAN`) REFERENCES `jabatan` (`ID_JABATAN`),
  ADD CONSTRAINT `FK_USER_PUNYA_PANGKAT` FOREIGN KEY (`ID_PANGKAT`) REFERENCES `pangkat` (`ID_PANGKAT`),
  ADD CONSTRAINT `FK_USER_PUNYA_POSISI_JABATAN` FOREIGN KEY (`ID_POSISI_JABATAN`) REFERENCES `posisi_jabatan` (`ID_POSISI_JABATAN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
