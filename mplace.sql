-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 08:35 PM
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
-- Database: `mplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `senderid` int(30) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `recipientid` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `senderid`, `Content`, `is_read`, `recipientid`, `created`) VALUES
(29, 20, 'what about the airpods pro 2', 0, '19', '2025-03-10 17:28:53'),
(30, 19, 'tell me about it', 0, '20', '2025-03-10 17:29:15'),
(31, 20, 'final price\r\n', 0, '19', '2025-03-10 17:29:32'),
(32, 19, '30 ngwiziz', 0, '20', '2025-03-10 17:29:52'),
(33, 20, 'dgdg\r\n', 0, '20', '2025-03-10 17:46:07'),
(34, 20, 'sure\r\n', 0, '19', '2025-03-10 18:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `posterid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `tags`, `detail`, `pic`, `created`, `posterid`) VALUES
(1, 'merc benx c200', 'sunroof red leather', 'default-image_450.png', '2025-02-02 19:02:35', 1),
(2, 'audi q5', 'black interior sunroof', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(3, 'bmw x5', 'leather seats, heated', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(4, 'tesla model x', 'autopilot, white leather', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(5, 'honda civic', 'manual, sunroof', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(6, 'ford mustang', 'v8 engine, red exterior', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(7, 'chevy camaro', 'yellow exterior, leather seats', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(8, 'toyota corolla', 'eco, sunroof', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(9, 'volvo xc90', 'hybrid, leather trim', 'default-image_450.png', '2025-02-02 19:04:26', 1),
(10, 'mercedes benz e-class', 'heated seats, sunroof', 'default-image_450.png', '2025-02-02 19:04:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `creatorid` int(11) NOT NULL,
  `tag` varchar(1000) NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `creatorid`, `tag`, `detail`, `price`, `created`) VALUES
(13, 19, 'airpods pro 2', 'The H2-powered AirPods Pro 2 feature Adaptive Audio, automatically prioritizing sounds that need your attention as you move through the world.', 32000, '2025-03-10 17:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `profile_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `profile_pic`) VALUES
(7, 'g@g.com', 'awfev', '32250170a0dca92d53ec9624f336ca24', ''),
(8, 'test@test.com', 'walai', '32250170a0dca92d53ec9624f336ca24', ''),
(9, 'two@two.com', 'two', '32250170a0dca92d53ec9624f336ca24', ''),
(10, 'three@three.com', 'form', '32250170a0dca92d53ec9624f336ca24', ''),
(19, 'four@four.com', 'walai', '32250170a0dca92d53ec9624f336ca24', 'images/users/67cf1f9adce0d7.06527051.webp'),
(20, 'five@five.com', 'five', '32250170a0dca92d53ec9624f336ca24', 'images/users/67cf21300e2108.78477861.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
