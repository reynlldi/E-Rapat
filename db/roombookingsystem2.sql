-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2022 pada 14.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `NIDN` varchar(10) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`NIDN`, `UserID`) VALUES
('', 60),
('', 61);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `jenisFasilitas` varchar(30) NOT NULL,
  `IDFasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_ruangan`
--

CREATE TABLE `fasilitas_ruangan` (
  `IDFasilRuangan` int(11) NOT NULL,
  `IDFasilitas` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `IDPeminjaman` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjam`
--

CREATE TABLE `peminjam` (
  `NIM` varchar(10) DEFAULT NULL,
  `NIDN` varchar(10) DEFAULT NULL,
  `IDProdi` int(11) DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjam`
--

INSERT INTO `peminjam` (`NIM`, `NIDN`, `IDProdi`, `UserID`) VALUES
('', '', 2, 63);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman_ruangan`
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
-- Dumping data untuk tabel `peminjaman_ruangan`
--

INSERT INTO `peminjaman_ruangan` (`IDPeminjaman`, `jamPinjam`, `jamSelesai`, `lamaPinjam`, `keperluan`, `tglPinjam`, `tglSelesai`, `persetujuan`, `tglPersetujuan`, `UserID`, `IDRuangan`) VALUES
(39, '14:29:00', '16:00:00', '01:31:00', 'Rapat', '2022-05-30', '2022-05-30', 'Belum disetujui', '2022-07-07 07:08:02', 62, 38),
(40, '09:00:00', '16:00:00', '07:00:00', 'Rapat', '2022-05-31', '2022-05-31', 'Disetujui', '2022-05-31 00:58:37', 62, 39),
(46, '09:00:00', '12:00:00', '03:00:00', 'Rapat', '2022-05-31', '2022-05-31', 'Disetujui', '2022-05-31 06:42:09', 62, 40),
(48, '15:49:00', '15:50:00', '00:01:00', 'Rapat', '2022-07-07', '2022-07-07', 'Disetujui', '2022-07-07 08:46:15', 63, 38);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `IDProdi` int(11) NOT NULL,
  `namaProdi` varchar(100) NOT NULL,
  `kaprodi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`IDProdi`, `namaProdi`, `kaprodi`) VALUES
(2, 'Bidang Ekonomi,Sumber Daya Alam dan Infrastruktur Wilayah', 'Dulfikar Ali Achmad, ST, MT'),
(3, 'Bidang Pemerintahan dan Pembangunan Manusia', 'Rany Angraini,S.AP'),
(4, 'Bidang Perencanaan,Pengendalian Dan Evaluasi Pembangunan', 'Harry Sulispriady S,IP'),
(6, 'Bidang Penelitian Dan Pengembangan', 'Umi Habibie, ST'),
(7, 'Sekretariat', 'Silvia Widyaswari, SE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
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
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`IDRuangan`, `namaRuangan`, `kapasitas`, `lantai`, `fotoRuangan`, `UserID`) VALUES
(38, 'Ruang Rapat Bawah', 25, 1, 'Ruang Rapat Bawah.jpg', 60),
(39, 'Ruang Rapat Studio', 15, 2, 'Ruang Rapat Studio.jpeg', 60),
(40, 'Ruang Rapat Atas', 50, 1, 'Ruang Rapat Atas.jpeg', 60);

-- --------------------------------------------------------

--
-- Struktur dari tabel `userruangan`
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
-- Dumping data untuk tabel `userruangan`
--

INSERT INTO `userruangan` (`UserID`, `nama`, `email`, `password`, `alamat`, `role`, `noTelp`, `gender`) VALUES
(60, 'Admin Ruang', 'adminruang@gmail.com', '$2y$10$XCUwm7Ih1Eem.OYuJiIcUeo70W0PCeTlNry6e3N6HMLf9lqrzetIu', 'Jalan Gendut Doni', 'Admin', '077129647', 'F'),
(61, 'Bidang Ruang', 'bidangruang@gmail.com', '$2y$10$5HjslWsHEmKX1.S/fo3u7O2JNKFCOpTfUOsh.xYdj8C9h4AAt4w7i', 'Jalan Bambang Pamungkas', 'Kabid', '77129727', 'F'),
(63, 'Staf Ruangan', 'stafruang@gmail.com', '$2y$10$UqznJq4J9f1Cdi/eD1GJIuu4Ni07V6UjZtmDRGaGQsKSBF5Bz3pNG', 'Jalan Budi Sudarsono', 'Staf', '082197514228', 'M');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`UserID`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`IDFasilitas`);

--
-- Indeks untuk tabel `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD PRIMARY KEY (`IDFasilRuangan`),
  ADD KEY `fk_IDFasilitasRuangan` (`IDFasilitas`),
  ADD KEY `fk_IDPeminjamanFasilitas` (`IDPeminjaman`);

--
-- Indeks untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `fk_IDProdiPeminjam` (`IDProdi`);

--
-- Indeks untuk tabel `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD PRIMARY KEY (`IDPeminjaman`),
  ADD KEY `fk_UserIDPeminjamanRuangan` (`UserID`),
  ADD KEY `fk_IDRuanganPeminjaman` (`IDRuangan`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`IDProdi`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`IDRuangan`),
  ADD KEY `fk_UserIDRuangan` (`UserID`);

--
-- Indeks untuk tabel `userruangan`
--
ALTER TABLE `userruangan`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `IDFasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  MODIFY `IDFasilRuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  MODIFY `IDPeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `IDProdi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `IDRuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `userruangan`
--
ALTER TABLE `userruangan`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_UserIDAdmin` FOREIGN KEY (`UserID`) REFERENCES `userruangan` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `fasilitas_ruangan`
--
ALTER TABLE `fasilitas_ruangan`
  ADD CONSTRAINT `fk_IDFasilitasRuangan` FOREIGN KEY (`IDFasilitas`) REFERENCES `fasilitas` (`IDFasilitas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_IDPeminjamanFasilitas` FOREIGN KEY (`IDPeminjaman`) REFERENCES `peminjaman_ruangan` (`IDPeminjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjam`
--
ALTER TABLE `peminjam`
  ADD CONSTRAINT `fk_IDProdiPeminjam` FOREIGN KEY (`IDProdi`) REFERENCES `prodi` (`IDProdi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UserIDPeminjam` FOREIGN KEY (`UserID`) REFERENCES `userruangan` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `peminjaman_ruangan`
--
ALTER TABLE `peminjaman_ruangan`
  ADD CONSTRAINT `fk_IDRuanganPeminjaman` FOREIGN KEY (`IDRuangan`) REFERENCES `ruangan` (`IDRuangan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `fk_UserIDRuangan` FOREIGN KEY (`UserID`) REFERENCES `admin` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
