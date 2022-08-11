-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2022 at 12:32 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roombookingsystem2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `NIDN` varchar(10) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`NIDN`, `UserID`) VALUES
('', 60),
('', 93),
('', 105);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `jenisFasilitas` varchar(30) NOT NULL,
  `IDFasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_ruangan`
--

CREATE TABLE `fasilitas_ruangan` (
  `IDFasilRuangan` int(11) NOT NULL,
  `IDFasilitas` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `IDPeminjaman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `NIM` varchar(10) DEFAULT NULL,
  `NIDN` varchar(10) DEFAULT NULL,
  `IDProdi` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`NIM`, `NIDN`, `IDProdi`, `UserID`) VALUES
('', '', 2, 107);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_ruangan`
--

CREATE TABLE `peminjaman_ruangan` (
  `IDPeminjaman` int(11) NOT NULL,
  `jamPinjam` time NOT NULL,
  `jamSelesai` time NOT NULL,
  `lamaPinjam` time NOT NULL,
  `keperluan` varchar(350) NOT NULL,
  `tglPinjam` date NOT NULL,
  `tglSelesai` date NOT NULL,
  `persetujuan` varchar(20) NOT NULL DEFAULT 'Belum disetujui',
  `tglPersetujuan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UserID` int(11) DEFAULT NULL,
  `IDRuangan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman_ruangan`
--

INSERT INTO `peminjaman_ruangan` (`IDPeminjaman`, `jamPinjam`, `jamSelesai`, `lamaPinjam`, `keperluan`, `tglPinjam`, `tglSelesai`, `persetujuan`, `tglPersetujuan`, `UserID`, `IDRuangan`) VALUES
(92, '12:48:00', '14:49:00', '02:01:00', 'Rapat Inovasi', '2022-07-20', '2022-07-20', 'Disetujui', '2022-08-03 08:48:17', 67, 51),
(93, '14:49:00', '16:49:00', '02:00:00', 'Rapat Keuangan', '2022-07-20', '2022-07-20', 'Disetujui', '2022-08-03 08:47:18', 67, 52),
(94, '17:50:00', '20:51:00', '03:01:00', 'Rapat Pimpinan Bidang', '2022-07-20', '2022-07-20', 'Disetujui', '2022-07-20 04:52:11', 67, 50),
(97, '13:52:00', '18:55:00', '05:03:00', 'Rapat', '2022-07-27', '2022-07-27', 'Disetujui', '2022-07-27 06:52:06', 92, 52),
(153, '10:55:00', '14:53:00', '03:58:00', 's', '2022-08-05', '2022-08-05', 'Belum disetujui', '2022-08-05 03:54:22', 0, 52),
(167, '12:39:00', '18:39:00', '06:00:00', 'tes', '2022-08-08', '2022-08-08', 'Belum disetujui', '2022-08-08 05:39:42', 107, 50),
(168, '14:39:00', '16:40:00', '02:01:00', 'tes', '2022-08-08', '2022-08-08', 'Belum disetujui', '2022-08-08 05:40:17', 107, 50);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `IDProdi` int(11) NOT NULL,
  `namaProdi` varchar(100) NOT NULL,
  `kaprodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`IDProdi`, `namaProdi`, `kaprodi`) VALUES
(2, 'Bidang Ekonomi,Sumber Daya Alam dan Infrastruktur Wilayah', 'Dulfikar Ali Achmad, ST, MT'),
(3, 'Bidang Pemerintahan dan Pembangunan Manusia', 'Rany Angraini,S.AP'),
(4, 'Bidang Perencanaan,Pengendalian Dan Evaluasi Pembangunan', 'Harry Sulispriady S,IP'),
(6, 'Bidang Penelitian Dan Pengembangan', 'Umi Habibie, ST'),
(7, 'Sekretariat', 'Silvia Widyaswari, SE'),
(11, 'ganda', 'ganda');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `IDRuangan` int(11) NOT NULL,
  `namaRuangan` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `lantai` int(11) NOT NULL,
  `fotoRuangan` varchar(40) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`IDRuangan`, `namaRuangan`, `kapasitas`, `lantai`, `fotoRuangan`, `UserID`) VALUES
(50, 'Ruang Rapat Bawah', 25, 1, 'Ruang Rapat Bawah.jpg', 60),
(51, 'Ruang Rapat Studio', 15, 2, 'Ruang Rapat Studio.jpeg', 60),
(52, 'Ruang Rapat Atas', 50, 3, 'Ruang Rapat Atas.jpeg', 60);

-- --------------------------------------------------------

--
-- Table structure for table `userruangan`
--

CREATE TABLE `userruangan` (
  `UserID` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `noTelp` varchar(13) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userruangan`
--

INSERT INTO `userruangan` (`UserID`, `nama`, `email`, `password`, `alamat`, `role`, `noTelp`, `gender`) VALUES
(60, 'Admin Ruang', 'adminruang@gmail.com', '$2y$10$MfcubjnnSh5OBZHl6sWPyuVg6zJoZI5CaCqiLtd88E2hzJFx/aix6', 'Jalan Kuantan', 'Admin', '077129647', 'F'),
(93, 'Subbag Umum', 'bapelitbangbintan@bapelitbang.bintankab.go.id', '$2y$10$IdjxwN2N09qUtrh3jx8dS.54usET2LuyNdVftXUcdGsn6Uz.7q2aW', 'Jalan Ahmad Yani No 5', 'Admin', '081270177788', 'F'),
(105, 'admin2', 'admin@gmail.com', '$2y$10$wpPqJTVYwbhbHBUAmOdtkePE41u3hU1E211DwgUlb.uXHNKN.ncq6', 'admin2', 'Admin', '082171099955', 'M'),
(107, 'stafruang', 'stafruang@gmail.com', '$2y$10$VDGsyilLbiPYEQTCVyUt9Ol6ybnuBE6mKOJAWU0ShenMCvcLpwz0e', 'staf', 'Staf', '082171099955', 'M');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`IDFasilitas`);

--
-- Indexes for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD PRIMARY KEY (`IDFasilRuangan`),
  ADD KEY `fk_IDFasilitasRuangan` (`IDFasilitas`),
  ADD KEY `fk_IDPeminjamanFasilitas` (`IDPeminjaman`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `fk_IDProdiPeminjam` (`IDProdi`);

--
-- Indexes for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`IDPeminjaman`),
  ADD KEY `fk_UserIDPeminjamanRuangan` (`UserID`),
  ADD KEY `fk_IDRuanganPeminjaman` (`IDRuangan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`IDProdi`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`IDRuangan`),
  ADD KEY `fk_UserIDRuangan` (`UserID`);

--
-- Indexes for table `userruangan`
--
ALTER TABLE `userruangan`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `IDFasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  MODIFY `IDFasilRuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `IDPeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `IDProdi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `IDRuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `userruangan`
--
ALTER TABLE `userruangan`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_UserIDAdmin` FOREIGN KEY (`UserID`) REFERENCES `userruangan` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD CONSTRAINT `fk_IDFasilitasRuangan` FOREIGN KEY (`IDFasilitas`) REFERENCES `fasilitas` (`IDFasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_IDPeminjamanFasilitas` FOREIGN KEY (`IDPeminjaman`) REFERENCES `peminjaman_ruangan` (`IDPeminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD CONSTRAINT `fk_IDProdiPeminjam` FOREIGN KEY (`IDProdi`) REFERENCES `prodi` (`IDProdi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UserIDPeminjam` FOREIGN KEY (`UserID`) REFERENCES `userruangan` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD CONSTRAINT `fk_IDRuanganPeminjaman` FOREIGN KEY (`IDRuangan`) REFERENCES `ruangan` (`IDRuangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `fk_UserIDRuangan` FOREIGN KEY (`UserID`) REFERENCES `admin` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
