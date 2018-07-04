-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2018 at 09:18 AM
-- Server version: 5.7.22
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--
CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camagru`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` char(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `description` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `description`, `url`, `user_id`) VALUES
(3, 'natali', 'resources/users_photo/natalie.jpg', 1),
(4, 'marlen', 'resources/users_photo/marlen.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` char(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` char(25) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `verified`, `token`) VALUES
(1, 'admin', 'admin', 'admin@i.ua', 1, ''),
(2, 'newone11', 'teteste', 'testy', 0, 'tokkk'),
(7, 'qwerty', '$2y$10$ihvOj95UZQPD2/oP1re3fujtEEFe.Z3./X0szhmTX1oqyR1ZXx6ju', 'tqwqts@gmail.com', 1, 'registered'),
(8, 'qwerty1', '$2y$10$YJxAXVLRUlNVl188Tn5N7e3EdKxUCjJ55YsbAM1Ilsx0.iSnUnFYy', 'tqwqts@gmail.com', 1, 'registered');

-- --------------------------------------------------------

--
-- Table structure for table `user_liked_photo`
--

CREATE TABLE `user_liked_photo` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_liked_photo`
--

INSERT INTO `user_liked_photo` (`id`, `user_id`, `photo_id`) VALUES
(106, 8, 3),
(112, 8, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Indexes for table `user_liked_photo`
--
ALTER TABLE `user_liked_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photo_id` (`photo_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_liked_photo`
--
ALTER TABLE `user_liked_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_liked_photo`
--
ALTER TABLE `user_liked_photo`
  ADD CONSTRAINT `user_liked_photo_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`),
  ADD CONSTRAINT `user_liked_photo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
