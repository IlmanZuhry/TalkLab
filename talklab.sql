-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2026 pada 11.05
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
-- Database: `talklab`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `komunitas`
--

CREATE TABLE `komunitas` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Id_User` varchar(6) NOT NULL,
  `Isi` text NOT NULL,
  `Dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `Update_Post` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komunitas`
--

INSERT INTO `komunitas` (`Id`, `Id_User`, `Isi`, `Dibuat`, `Update_Post`) VALUES
(1, '7NA83J', 'Tes haha', '2026-05-09 15:59:59', '2026-05-09 16:02:03'),
(2, 'AGBI29', 'woy antek antek asheng', '2026-05-09 16:04:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `Id_User` varchar(6) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Tempat_Lahir` varchar(100) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`Id_User`, `Nama`, `Tempat_Lahir`, `Tanggal_Lahir`, `Username`, `Password`, `Foto`) VALUES
('7NA83J', 'Ilman Zuhry', 'Medan', '2007-10-26', 'LOL', '$2y$10$3ttwlV6cXL/JM.qWnWEiQu5yPbemGOmb8m1vALskfv2Furj7HISGC', ''),
('AGBI29', 'Wawak Sitompul', 'Binjai', '1990-07-06', 'Sitoms', '$2y$10$vRTbM7Tw5JSVt.X4uohy5uAKlxW/sFEvdQ2FhNSRcFoJJNac24zMq', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idx_user_id` (`Id_User`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_User`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  ADD CONSTRAINT `fk_community_user` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
