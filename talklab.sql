-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 07:07 AM
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
(3, 'LB61P9', 'anak kntl', '2026-05-12 12:06:36', NULL);

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
(2, 'LB61P9', 'Ceritakan pengalaman pribadi yang membuat kamu belajar hal baru.', 5, 'uploads/practice_audio/LB61P9_20260512_070109_5d0a24cf.webm', '2026-05-12 12:01:09');

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

--
-- Dumping data for table `speaking_challenge_history`
--

INSERT INTO `speaking_challenge_history` (`id`, `user_id`, `challenge_type`, `level_name`, `prompt`, `prep_seconds`, `speak_seconds`, `actual_seconds`, `score`, `completed`, `created_at`) VALUES
(1, 'LB61P9', 'Random Topic Challenge', 'Beginner', 'Bagaimana cara menghadapi rasa grogi?', 20, 45, 45, 100, 1, '2026-05-11 21:27:57');

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
  `Foto` varchar(255) NOT NULL
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
