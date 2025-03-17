-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skin_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_text` text NOT NULL,
  `recommendation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `recommendation_id`) VALUES
(1, 1, 'Oily', 1),
(2, 1, 'Dry', 2),
(3, 1, 'Combination', 3),
(4, 1, 'Sensitive', 4),
(5, 2, 'Yes', 1),
(6, 2, 'No', 2),
(7, 3, 'Yes', 3),
(8, 3, 'No', 4),
(9, 4, 'Lightweight', 1),
(10, 4, 'Heavy', 2),
(11, 5, 'Yes', 4),
(12, 5, 'No', 3),
(13, 6, 'Yes', 3),
(14, 6, 'No', 1),
(15, 7, 'Once a week', 2),
(16, 7, 'Everyday', 1),
(17, 8, 'Yes', 4),
(18, 8, 'No', 3),
(19, 9, 'Yes', 2),
(20, 9, 'No', 1),
(21, 10, 'Daily', 3),
(22, 10, 'Occasionally', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`) VALUES
(1, 'What is your skin type?'),
(2, 'Do you have acne-prone skin?'),
(3, 'Is your skin sensitive to new products?'),
(4, 'Do you prefer lightweight or heavy creams?'),
(5, 'Are you looking for anti-aging properties?'),
(6, 'Do you have redness or irritation?'),
(7, 'How often do you exfoliate?'),
(8, 'Do you prefer fragrance-free products?'),
(9, 'Do you have dry patches on your skin?'),
(10, 'Are you looking for a daily or occasional treatment?');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `picture_url` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`id`, `product_name`, `picture_url`, `description`) VALUES
(1, 'Centella Calming Gel', 'images/centella_gel.jpg', 'A lightweight gel for sensitive and acne-prone skin.'),
(2, 'Centella Hydrating Cream', 'images/centella_cream.jpg', 'Deep hydration for dry and irritated skin.'),
(3, 'Centella Soothing Toner', 'images/centella_toner.jpg', 'Soothes redness and prepares skin for treatment.'),
(4, 'Centella Anti-Aging Serum', 'images/centella_serum.jpg', 'Reduces fine lines and enhances skin elasticity.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `recommendation_id` (`recommendation_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`recommendation_id`) REFERENCES `recommendations` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
