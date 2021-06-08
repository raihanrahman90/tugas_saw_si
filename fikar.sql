-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jun 2021 pada 04.28
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fikar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`) VALUES
(9, 'Ganesha Operation (GO)'),
(10, 'Primagama'),
(11, 'An-Nahl Study Club');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif_bobot`
--

CREATE TABLE `alternatif_bobot` (
  `id_alternatif` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif_bobot`
--

INSERT INTO `alternatif_bobot` (`id_alternatif`, `kode_kriteria`, `id_sub_kriteria`) VALUES
(10, 'C1', 51),
(9, 'C1', 52),
(11, 'C1', 53),
(9, 'C2', 55),
(11, 'C2', 57),
(10, 'C2', 58),
(9, 'C3', 60),
(10, 'C3', 60),
(11, 'C3', 61),
(10, 'C4', 62),
(9, 'C4', 63),
(11, 'C4', 64);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `tipe` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `bobot`, `tipe`) VALUES
('C1', 'Biaya', 7, 'Cost'),
('C2', 'lokasi', 6, 'Cost'),
('C3', 'Fasilitas', 5, 'Benefit'),
('C4', 'Kualitas Pengajar', 4, 'Benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3'),
('admin1', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(50) NOT NULL,
  `nama_sub_kriteria` varchar(30) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_sub_kriteria`, `kode_kriteria`, `nama_sub_kriteria`, `nilai`) VALUES
(51, 'C1', '<= 1.500.000', 2),
(52, 'C1', '1.500.000 - 2.500.000', 3),
(53, 'C1', '2.500.000 - 3.500.000', 4),
(54, 'C1', '>= 3.500.000', 5),
(55, 'C2', '<= 5 km', 2),
(56, 'C2', '5 - 10 km', 3),
(57, 'C2', '>= 15 km', 5),
(58, 'C2', '10 - 15 km', 4),
(59, 'C3', 'Tidak Lengkap', 1),
(60, 'C3', 'Cukup Lengkap', 3),
(61, 'C3', 'Sangat Lengkap', 5),
(62, 'C4', 'Lulusan D1/D2/D3', 3),
(63, 'C4', 'Lulusan S1', 4),
(64, 'C4', 'Lulusan S2', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `alternatif_bobot`
--
ALTER TABLE `alternatif_bobot`
  ADD UNIQUE KEY `id_alternatif` (`id_alternatif`,`kode_kriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`),
  ADD KEY `id_sub_kriteria` (`id_sub_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `kode_kriteria` (`kode_kriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif_bobot`
--
ALTER TABLE `alternatif_bobot`
  ADD CONSTRAINT `alternatif_bobot_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternatif_bobot_ibfk_2` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriteria` (`kode_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternatif_bobot_ibfk_3` FOREIGN KEY (`id_sub_kriteria`) REFERENCES `subkriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`kode_kriteria`) REFERENCES `kriteria` (`kode_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
