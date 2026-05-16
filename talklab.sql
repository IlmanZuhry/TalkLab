-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Bulan Mei 2026 pada 07.30
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
-- Basis data: `talklab`
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
-- Struktur dari tabel `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 'AGBI29', 'woyyyyyy', '2026-05-16 12:29:55', NULL),
(2, 2, '7NA83J', 'apa kau', '2026-05-16 12:30:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(1, 2, '7NA83J', '2026-05-16 12:19:49');

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
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idx_user_id` (`Id_User`);

--
-- Indeks untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indeks untuk tabel `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`post_id`,`user_id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

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
-- AUTO_INCREMENT untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komunitas`
--
ALTER TABLE `komunitas`
  ADD CONSTRAINT `fk_community_user` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `komunitas` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `fk_like_post` FOREIGN KEY (`post_id`) REFERENCES `komunitas` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
