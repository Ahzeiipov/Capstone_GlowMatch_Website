-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2025 at 12:47 PM
-- Server version: 8.3.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skincareconsulting`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `password`, `created_at`) VALUES
(1, 'Nene', 'ne@gmail.com', '$2y$10$s/WSdNX1x99dxWNC1cnCeem8aAO1KO90jYQjpliN5DwdhPEmuzmV.', '2025-03-24 15:44:16'),
(2, 'Nara', 'Nara@gmail.com', '$2y$10$hFNK2BTDuEfsSPMqzB170uFLFrWNz3PIE9Y.Hqtxj8yxtoxLnKLna', '2025-03-24 18:11:31'),
(4, 'dada', 'thida@gmail.com', '$2y$10$XbQosF49O/AVjRtGEjY0me1MyHhg5cbzh/IwPVL0vXcX5R..uRu9m', '2025-03-25 09:17:24'),
(5, 'yuno', 'yuno@gmail.com', '$2y$10$MHvuaaPb4A1KqP7YogBJIei.bZKf3vcjNlZeMkPfuIcEJStiTab2a', '2025-03-25 11:43:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
