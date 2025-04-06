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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderid` int(11) NOT NULL,
  `Content` varchar(255) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `recipientid` int(11) NOT NULL,  -- Changed to int(11) for consistency
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
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

-- Products Table
CREATE TABLE 'products' (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
  'creatorid' INT(11) NOT NULL,
  'tag' VARCHAR(1000) NOT NULL,
  'detail' VARCHAR(1000) NOT NULL,
  'category_id' INT(11) DEFAULT NULL,
  'created' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id'),
  FOREIGN KEY ('creatorid') REFERENCES users('id') ON DELETE CASCADE,
  FOREIGN KEY ('category_id') REFERENCES categories('id') ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Dumping data for table `products`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,  -- Store hashed passwords
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) 
VALUES 
  ('1', 'admin@example.com', 'admin', 'adminpass'),
  ('2', 'guest@example.com', 'guest', 'guestpass'),
  ('3', 'developer@example.com', 'developer', 'devpass'),
  ('4','tester@example.com', 'tester', 'testpass');

-- -------------------------------------
-- Enhanced SQL Schema for Campus Marketplace
-- -------------------------------------

-- Drop tables if they exist for clean re-import
DROP TABLE IF EXISTS product_rating, notifications, categories, images, products, posts, messages, users;

-- Messages Table
CREATE TABLE 'messages' (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
 'senderid' INT(11) NOT NULL,
  'recipientid' INT(11) NOT NULL,
  'content' VARCHAR(255) NOT NULL,
  'is_read' TINYINT(1) NOT NULL DEFAULT 0,
  'created' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id'),
  FOREIGN KEY ('senderid') REFERENCES users('id') ON DELETE CASCADE,
  FOREIGN KEY ('recipientid') REFERENCES users('id') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Posts Table
CREATE TABLE 'posts' (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
  'tags' VARCHAR(255) NOT NULL,
  'detail' VARCHAR(255) NOT NULL,
  'pic' VARCHAR(255) NOT NULL,
  'created' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  'posterid' INT(11) NOT NULL,
  PRIMARY KEY ('id'),
  FOREIGN KEY ('posterid') REFERENCES users('id') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Categories Table
CREATE TABLE 'categories' (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
  'name' VARCHAR(100) NOT NULL UNIQUE,
  'description' TEXT,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Product Rating Table
CREATE TABLE product_rating (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
  'product_id' INT(11) NOT NULL,
  'user_id' INT(11) NOT NULL,
  'rating' INT CHECK (rating BETWEEN 1 AND 5),
  'comment' TEXT,
  'created_at' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id'),
  FOREIGN KEY ('product_id') REFERENCES products('id') ON DELETE CASCADE,
  FOREIGN KEY ('user_id') REFERENCES users('id') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Notifications Table
CREATE TABLE notifications (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
  'user_id' INT(11) NOT NULL,
  'title' VARCHAR(100),
  'message' TEXT,
  'is_read' BOOLEAN DEFAULT FALSE,
  'created_at' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id'),
  FOREIGN KEY ('user_id') REFERENCES users('id') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Images Table (optional - supports multiple images per product)
CREATE TABLE 'images' (
  'id' INT(11) NOT NULL AUTO_INCREMENT,
  'product_id' INT(11) NOT NULL,
  'image_url' VARCHAR(255) NOT NULL,
  'uploaded_at' TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY ('id'),
  FOREIGN KEY ('product_id') REFERENCES products('id') ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
