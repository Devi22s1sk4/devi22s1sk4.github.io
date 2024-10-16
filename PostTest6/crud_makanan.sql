-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Okt 2024 pada 15.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_makanan`
--
CREATE DATABASE IF NOT EXISTS `crud_makanan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crud_makanan`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep_db`
--

CREATE TABLE `resep_db` (
  `id` int(11) NOT NULL,
  `nama_resep` varchar(255) NOT NULL,
  `bahan` text NOT NULL,
  `langkah` text NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `resep_db`
--

INSERT INTO `resep_db` (`id`, `nama_resep`, `bahan`, `langkah`, `gambar`) VALUES
(1, 'qqqqqqqqqqq', 'ooooooooo', 'ggggggggggggg', 'uploads/default_image.jpg'),
(4, 'zlvkjdkafljas', 'aldnfaj', 'jknkjnas', 'uploads/default_image.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `resep_db`
--
ALTER TABLE `resep_db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `resep_db`
--
ALTER TABLE `resep_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
