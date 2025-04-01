-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2025 at 05:16 PM
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
(2, 2, 'Can I get a discount on this?', 0, '1', '2025-02-03 18:12:50'),
(3, 2, 'What’s the battery life like on this model?', 0, '1', '2025-02-03 18:12:50'),
(4, 2, 'Is there a warranty for this phone?', 0, '1', '2025-02-03 18:12:50'),
(5, 2, 'Are these noise-cancelling?', 0, '1', '2025-02-03 18:12:50'),
(6, 2, 'Can I upgrade the RAM on this laptop?', 0, '1', '2025-02-03 18:12:50'),
(7, 2, 'What’s the range on a full charge?', 0, '1', '2025-02-03 18:12:50'),
(8, 2, 'Does this have GPS tracking?', 0, '1', '2025-02-03 18:12:50'),
(9, 2, 'Is there an offer if I trade in my old console?', 0, '1', '2025-02-03 18:12:50'),
(10, 2, 'What’s the lens compatibility?', 0, '1', '2025-02-03 18:12:50'),
(11, 2, 'Can I use this underwater?', 0, '1', '2025-02-03 18:12:50'),
(12, 1, 'Hey, how are you doing?', 0, '2', '2025-02-05 13:41:29'),
(13, 1, 'Just wanted to check if you received the report I sent yesterday.', 0, '2', '2025-02-05 13:41:29'),
(14, 1, 'Let me know if you need any help with the presentation.', 1, '2', '2025-02-05 13:41:29'),
(15, 1, 'I’ll be in a meeting for the next couple of hours, but feel free to text me!', 1, '2', '2025-02-05 13:41:29'),
(16, 1, 'sfsaf;asgved\r\n', 0, '2', '2025-02-05 13:48:03'),
(17, 1, 'sauvjldsvd', 0, '2', '2025-02-05 13:48:16');

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
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `creatorid`, `tag`, `detail`, `created`) VALUES
(1, 1, '', '', '2025-02-04 17:35:32'),
(2, 1, 'sauvcjmas,vkadml', 'aksldmv. dsl;zx,v.deasslx;,', '2025-02-04 17:36:47'),
(3, 1, 'sauvcjmas,vkadml', 'aksldmv. dsl;zx,v.deasslx;,', '2025-02-04 17:42:01'),
(4, 1, 'sauvcjmas,vkadml', 'aksldmv. dsl;zx,v.deasslx;,', '2025-02-04 17:44:07'),
(5, 1, 'sauvcjmas,vkadml', 'aksldmv. dsl;zx,v.deasslx;,', '2025-02-04 17:47:47'),
(6, 1, 'sauvcjmas,vkadml', 'aksldmv. dsl;zx,v.deasslx;,', '2025-02-04 17:51:09'),
(7, 1, 'sauvcjmas,vkadml', 'aksldmv. dsl;zx,v.deasslx;,', '2025-02-04 17:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(7, 'g@g.com', 'awfev', '32250170a0dca92d53ec9624f336ca24');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
