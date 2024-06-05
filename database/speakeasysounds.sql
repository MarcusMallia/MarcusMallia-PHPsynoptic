-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 02:29 PM
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
-- Database: `speakeasysounds`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_status`
--

CREATE TABLE `activity_status` (
  `activity_status_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `last_active` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(12, 16, 12, 'How about Collard Greens by ScHoolboy Q and Kendrick i think it would fit in the playlist perfectly', '2024-06-05 13:47:10', '2024-06-05 13:47:10'),
(13, 17, 13, 'LOVEEEEE this song great pick', '2024-06-05 13:57:14', '2024-06-05 13:57:14'),
(14, 18, 13, 'wow thanks for the share', '2024-06-05 13:57:50', '2024-06-05 13:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `follower_user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follower_id`, `user_id`, `follower_user_id`, `created_at`) VALUES
(36, 14, 12, '2024-06-05 13:46:16'),
(37, 14, 12, '2024-06-05 13:46:16'),
(38, 13, 12, '2024-06-05 13:47:46'),
(39, 13, 12, '2024-06-05 13:47:46'),
(40, 12, 13, '2024-06-05 13:56:42'),
(41, 12, 13, '2024-06-05 13:56:42'),
(42, 14, 13, '2024-06-05 13:58:04'),
(43, 14, 13, '2024-06-05 13:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `post_id`, `user_id`, `created_at`) VALUES
(40, 16, 12, '2024-06-05 13:46:10'),
(41, 17, 12, '2024-06-05 13:46:11'),
(42, 15, 12, '2024-06-05 13:47:33'),
(43, 18, 13, '2024-06-05 13:56:40'),
(44, 16, 13, '2024-06-05 13:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `link_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `type`, `message`, `is_read`, `created_at`) VALUES
(33, 14, 'like', 'Jazzlover42 liked your post.', 1, '2024-06-05 13:46:10'),
(34, 14, 'like', 'Jazzlover42 liked your post.', 1, '2024-06-05 13:46:11'),
(35, 14, 'comment', 'Jazzlover42 commented on your post.', 1, '2024-06-05 13:47:10'),
(36, 13, 'like', 'Jazzlover42 liked your post.', 0, '2024-06-05 13:47:33'),
(37, 12, 'like', 'MusicManiac liked your post.', 0, '2024-06-05 13:56:40'),
(38, 14, 'comment', 'MusicManiac commented on your post.', 0, '2024-06-05 13:57:14'),
(39, 14, 'like', 'MusicManiac liked your post.', 1, '2024-06-05 13:57:29'),
(40, 12, 'comment', 'MusicManiac commented on your post.', 0, '2024-06-05 13:57:50');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `content`, `link`, `created_at`, `updated_at`, `title`, `tags`) VALUES
(15, 13, 'Banging house song, Bayside always gets me up in the morning!', 'https://open.spotify.com/track/7hYW4hKuPkfaLbzTpg9hQB?si=e4da5639a2ce4e97', '2024-06-05 13:34:25', '2024-06-05 13:34:25', 'Bayside - Radio Edit: Obskur', NULL),
(16, 14, 'Hey Everyone!\r\nHeres my hype rap playlists called Menace 2 Society.\r\nHope you enjoy!\r\nComment any songs you think i should add.', 'https://open.spotify.com/playlist/4Ba1KJAEPdu4JjTyMJ8wbX?si=7317ca1c533442f3', '2024-06-05 13:39:00', '2024-06-05 13:39:00', 'Gangsta Rap Playlist', NULL),
(17, 14, 'YES YOU CAN! Spending this beautiful day with some chill tribe called quest featuring J.Cole. Kicking it back.', 'https://open.spotify.com/track/0GmhAVyyHwaX6jfCbPmaoB?si=16a00845c34e4bd7', '2024-06-05 13:42:04', '2024-06-05 13:42:04', 'CAN I KICK IT?', NULL),
(18, 12, 'Berlioz always supplying the goodness and those jazzy vibes heres one of my personal favourites, hot house.', 'https://open.spotify.com/track/2Fk1WNNBK7If8eRUDwlja0', '2024-06-05 13:45:54', '2024-06-05 13:45:54', 'Hot House', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `post_tag_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`post_tag_id`, `post_id`, `tag_id`) VALUES
(21, 15, 13),
(22, 15, 14),
(23, 16, 15),
(24, 16, 16),
(25, 16, 17),
(26, 17, 18),
(27, 17, 19),
(28, 17, 20),
(29, 18, 21),
(30, 18, 22),
(31, 18, 13),
(32, 18, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
(13, 'House'),
(14, 'Obskur'),
(15, 'Rap'),
(16, '90sHiphop'),
(17, 'GangstaRap'),
(18, 'TribeCalledQuest'),
(19, 'TCQ'),
(20, 'J.Cole'),
(21, 'Berlioz'),
(22, 'Jazz'),
(23, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `profile_picture`, `bio`, `created_at`, `updated_at`) VALUES
(12, 'Jazzlover42', 'Jazz42@email.com', '$2y$10$SxHY8Uh5ATM55/QUcZoYFeWPmVd58LfzXOMwc16P0zkTuIs28OqCW', '../uploads/maxresdefault.jpg', 'Jazz is King', '2024-06-05 13:26:37', '2024-06-05 13:53:22'),
(13, 'MusicManiac', 'maniac@email.com', '$2y$10$BBvIQuwuMev.Z.h73cIxFuEH8ZsidZtliLAFYLVnSpEIhKjzUGJoG', '../uploads/_21_bojack-horseman-wallpapers_And-the-Award-for-Best-Netflix-Original-goes-to....-BoJack-.jpg', 'Crazy for those tunes!!', '2024-06-05 13:32:28', '2024-06-05 14:14:06'),
(14, 'RapStarr', 'rapstar@email.com', '$2y$10$vtQNF9m5Fqrq5EHpHWC9j.erax3KD40mkajmHqD8FOdPV69kFKv9S', '../uploads/1750e9486a0b2f9cbd2dd262c9ff7905.jpg', 'GanngStarr one of the best yet', '2024-06-05 13:36:15', '2024-06-05 13:59:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_status`
--
ALTER TABLE `activity_status`
  ADD PRIMARY KEY (`activity_status_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follower_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `follower_user_id` (`follower_user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_tag_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_status`
--
ALTER TABLE `activity_status`
  MODIFY `activity_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `follower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `post_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_status`
--
ALTER TABLE `activity_status`
  ADD CONSTRAINT `activity_status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follower_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
