-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2026 at 08:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `ai_feedback_history`
--

CREATE TABLE `ai_feedback_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `source_type` varchar(40) NOT NULL,
  `duration_seconds` int(10) UNSIGNED NOT NULL,
  `clarity_score` int(10) UNSIGNED NOT NULL,
  `fluency_score` int(10) UNSIGNED NOT NULL,
  `confidence_score` int(10) UNSIGNED NOT NULL,
  `consistency_score` int(10) UNSIGNED NOT NULL,
  `filler_count` int(10) UNSIGNED NOT NULL,
  `speaking_speed` int(10) UNSIGNED NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(180) NOT NULL,
  `author` varchar(120) NOT NULL,
  `pages` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `thumbnail_path` varchar(255) NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_ebook_title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `title`, `author`, `pages`, `thumbnail_path`, `pdf_path`, `created_at`, `updated_at`) VALUES
(1, '3 Teknik Mahir Berbicara Di Depan Publik', 'Hebbie Agus Kurnia', 32, 'assets/ebook/ebook1.png', 'assets/ebook/ebook1.pdf', current_timestamp(), NULL),
(2, 'Public Speaking Untuk Pemula', 'Rinna Raflina, S.Sos., M.I.Kom', 88, 'assets/ebook/ebook2.png', 'assets/ebook/ebook2.pdf', current_timestamp(), NULL),
(3, 'My Public Speaking', 'Hilbram Dunar', 180, 'assets/ebook/ebook3.png', 'assets/ebook/ebook3.pdf', current_timestamp(), NULL),
(4, 'Dasar Public Speaking', 'Dr. Mohamed Sudi, S.E., M.Si.', 116, 'assets/ebook/ebook4.png', 'assets/ebook/ebook4.pdf', current_timestamp(), NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE `komunitas` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Id_User` varchar(6) NOT NULL,
  `Isi` text NOT NULL,
  `Dibuat` datetime NOT NULL DEFAULT current_timestamp(),
  `Update_Post` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`Id`, `Id_User`, `Isi`, `Dibuat`, `Update_Post`) VALUES
(1, '7NA83J', 'Tes haha', '2026-05-09 15:59:59', '2026-05-09 16:02:03'),
(2, 'AGBI29', 'woy antek antek asheng', '2026-05-09 16:04:51', NULL),
(3, 'LB61P9', 'aku gabung disini sangat seru ternyata', '2026-05-12 12:06:36', '2026-05-23 11:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `mentor_accounts`
--

CREATE TABLE `mentor_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentor_reviews`
--

CREATE TABLE `mentor_reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `submission_id` int(10) UNSIGNED NOT NULL,
  `mentor_id` int(10) UNSIGNED NOT NULL,
  `articulation_score` int(10) UNSIGNED NOT NULL,
  `fluency_score` int(10) UNSIGNED NOT NULL,
  `confidence_score` int(10) UNSIGNED NOT NULL,
  `structure_score` int(10) UNSIGNED NOT NULL,
  `intonation_score` int(10) UNSIGNED NOT NULL,
  `final_score` int(10) UNSIGNED NOT NULL,
  `strengths` text NOT NULL,
  `improvements` text NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentor_submissions`
--

CREATE TABLE `mentor_submissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `practice_history_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `mentor_id` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'pending',
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practice_history`
--

CREATE TABLE `practice_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `duration_seconds` int(10) UNSIGNED NOT NULL,
  `audio_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practice_history`
--

INSERT INTO `practice_history` (`id`, `user_id`, `topic`, `duration_seconds`, `audio_path`, `created_at`) VALUES
(1, 'LB61P9', 'Perkenalkan diri kamu secara singkat dan percaya diri.', 4, 'uploads/practice_audio/LB61P9_20260512_070044_c045b54e.webm', '2026-05-12 12:00:44'),
(2, 'LB61P9', 'Ceritakan pengalaman pribadi yang membuat kamu belajar hal baru.', 5, 'uploads/practice_audio/LB61P9_20260512_070109_5d0a24cf.webm', '2026-05-12 12:01:09'),
(3, 'LB61P9', 'Sampaikan opini sederhana tentang pentingnya public speaking.', 30, 'uploads/practice_audio/LB61P9_20260514_150532_570a68e8.webm', '2026-05-14 20:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `speaking_challenge_history`
--

CREATE TABLE `speaking_challenge_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(6) NOT NULL,
  `challenge_type` varchar(60) NOT NULL,
  `level_name` varchar(30) NOT NULL,
  `prompt` text NOT NULL,
  `prep_seconds` int(10) UNSIGNED NOT NULL,
  `speak_seconds` int(10) UNSIGNED NOT NULL,
  `actual_seconds` int(10) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id_User` varchar(6) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Tempat_Lahir` varchar(100) NOT NULL,
  `Tanggal_Lahir` date NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `Bio` varchar(160) NOT NULL DEFAULT 'yang penting bicara aja dulu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id_User`, `Nama`, `Tempat_Lahir`, `Tanggal_Lahir`, `Username`, `Password`, `Foto`) VALUES
('7NA83J', 'Ilman Zuhry', 'Medan', '2007-10-26', 'LOL', '$2y$10$3ttwlV6cXL/JM.qWnWEiQu5yPbemGOmb8m1vALskfv2Furj7HISGC', ''),
('AGBI29', 'Wawak Sitompul', 'Binjai', '1990-07-06', 'Sitoms', '$2y$10$vRTbM7Tw5JSVt.X4uohy5uAKlxW/sFEvdQ2FhNSRcFoJJNac24zMq', ''),
('LB61P9', 'mamang ujang', 'palembang', '2002-02-06', 'aduhmamang', '$2y$10$0AnIL/8nzzaf9phtJgRkTOSP1puah5I8Y4fcAEz76vWBpJK.4rR3q', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ai_feedback_history`
--
ALTER TABLE `ai_feedback_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ai_feedback_user` (`user_id`);

--
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idx_user_id` (`Id_User`);

--
-- Indexes for table `mentor_accounts`
--
ALTER TABLE `mentor_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_mentor_username` (`username`);

--
-- Indexes for table `mentor_reviews`
--
ALTER TABLE `mentor_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_submission_review` (`submission_id`),
  ADD KEY `idx_mentor_review_mentor` (`mentor_id`);

--
-- Indexes for table `mentor_submissions`
--
ALTER TABLE `mentor_submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_practice_submission` (`practice_history_id`),
  ADD KEY `idx_mentor_submission_user` (`user_id`),
  ADD KEY `idx_mentor_submission_mentor` (`mentor_id`),
  ADD KEY `idx_mentor_submission_status` (`status`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`post_id`,`user_id`),
  ADD KEY `idx_post` (`post_id`),
  ADD KEY `idx_user` (`user_id`);

--
-- Indexes for table `practice_history`
--
ALTER TABLE `practice_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_practice_user` (`user_id`);

--
-- Indexes for table `speaking_challenge_history`
--
ALTER TABLE `speaking_challenge_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_challenge_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_User`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ai_feedback_history`
--
ALTER TABLE `ai_feedback_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mentor_accounts`
--
ALTER TABLE `mentor_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentor_reviews`
--
ALTER TABLE `mentor_reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentor_submissions`
--
ALTER TABLE `mentor_submissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `practice_history`
--
ALTER TABLE `practice_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `speaking_challenge_history`
--
ALTER TABLE `speaking_challenge_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ai_feedback_history`
--
ALTER TABLE `ai_feedback_history`
  ADD CONSTRAINT `fk_ai_feedback_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD CONSTRAINT `fk_community_user` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentor_reviews`
--
ALTER TABLE `mentor_reviews`
  ADD CONSTRAINT `fk_mentor_review_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentor_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mentor_review_submission` FOREIGN KEY (`submission_id`) REFERENCES `mentor_submissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mentor_submissions`
--
ALTER TABLE `mentor_submissions`
  ADD CONSTRAINT `fk_mentor_submission_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentor_accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mentor_submission_practice` FOREIGN KEY (`practice_history_id`) REFERENCES `practice_history` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mentor_submission_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `komunitas` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `fk_like_post` FOREIGN KEY (`post_id`) REFERENCES `komunitas` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE;

--
-- Constraints for table `practice_history`
--
ALTER TABLE `practice_history`
  ADD CONSTRAINT `fk_practice_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `speaking_challenge_history`
--
ALTER TABLE `speaking_challenge_history`
  ADD CONSTRAINT `fk_challenge_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Table structure for table `material_progress`
--
CREATE TABLE `material_progress` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(6) NOT NULL,
  `material_id` varchar(50) NOT NULL,
  `progress` int(10) unsigned NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_user_material` (`user_id`,`material_id`),
  CONSTRAINT `fk_progress_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id_User`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
