-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 25, 2025 at 05:00 AM
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
-- Database: `skincareconsulting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answeroptions`
--

CREATE TABLE `answeroptions` (
  `OptionID` int(11) NOT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `OptionText` text NOT NULL,
  `SkinTypeEffect` enum('Dry','Oily','Combination','Normal','Sensitive','None') DEFAULT 'None',
  `SeverityEffect` enum('Severe','Mild','None') DEFAULT 'None',
  `Score` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `IngredientID` int(11) NOT NULL,
  `IngredientName` varchar(255) NOT NULL,
  `SkinTypeEffect` enum('Dry','Oily','Combination','Normal','Sensitive','None') DEFAULT 'None',
  `AcneEffect` enum('Beneficial','Neutral','Harmful') DEFAULT 'Neutral',
  `DarkSpotsEffect` enum('Beneficial','Neutral','Harmful') DEFAULT 'Neutral',
  `LargePoresEffect` enum('Beneficial','Neutral','Harmful') DEFAULT 'Neutral',
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `SkinType` enum('Dry','Oily','Combination','Normal','Sensitive') DEFAULT NULL,
  `SeverityLevel` enum('Severe','Mild','None') DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL,
  `ConcernType` enum('Acne','Dark Spots','Large Pores') NOT NULL,
  `ProductType` enum('Sunscreen','Serum','Toner','Moisturizer','Foam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `QuestionID` int(11) NOT NULL,
  `QuestionText` text NOT NULL,
  `Category` enum('Skin Type','Acne','Dark Spots','Large Pores') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recommendedproducts`
--

CREATE TABLE `recommendedproducts` (
  `RecommendationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `ResponseID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `QuestionID` int(11) DEFAULT NULL,
  `OptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skincondition`
--

CREATE TABLE `skincondition` (
  `ConditionID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `SkinType` enum('Dry','Oily','Combination','Normal','Sensitive') DEFAULT NULL,
  `AcneSeverity` enum('Severe','Mild','None') DEFAULT NULL,
  `DarkSpotsSeverity` enum('Severe','Mild','None') DEFAULT NULL,
  `LargePoresSeverity` enum('Severe','Mild','None') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useringredientanalysis`
--

CREATE TABLE `useringredientanalysis` (
  `AnalysisID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `IngredientID` int(11) DEFAULT NULL,
  `Suitability` enum('Good','Neutral','Bad') DEFAULT NULL,
  `AnalysisResult` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinputingredients`
--

CREATE TABLE `userinputingredients` (
  `InputID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `IngredientName` varchar(255) NOT NULL,
  `InputDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `answeroptions`
--
ALTER TABLE `answeroptions`
  ADD PRIMARY KEY (`OptionID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`IngredientID`),
  ADD UNIQUE KEY `IngredientName` (`IngredientName`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`QuestionID`);

--
-- Indexes for table `recommendedproducts`
--
ALTER TABLE `recommendedproducts`
  ADD PRIMARY KEY (`RecommendationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`ResponseID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `QuestionID` (`QuestionID`),
  ADD KEY `OptionID` (`OptionID`);

--
-- Indexes for table `skincondition`
--
ALTER TABLE `skincondition`
  ADD PRIMARY KEY (`ConditionID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `useringredientanalysis`
--
ALTER TABLE `useringredientanalysis`
  ADD PRIMARY KEY (`AnalysisID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `IngredientID` (`IngredientID`);

--
-- Indexes for table `userinputingredients`
--
ALTER TABLE `userinputingredients`
  ADD PRIMARY KEY (`InputID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answeroptions`
--
ALTER TABLE `answeroptions`
  MODIFY `OptionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `IngredientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recommendedproducts`
--
ALTER TABLE `recommendedproducts`
  MODIFY `RecommendationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `ResponseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skincondition`
--
ALTER TABLE `skincondition`
  MODIFY `ConditionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useringredientanalysis`
--
ALTER TABLE `useringredientanalysis`
  MODIFY `AnalysisID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinputingredients`
--
ALTER TABLE `userinputingredients`
  MODIFY `InputID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answeroptions`
--
ALTER TABLE `answeroptions`
  ADD CONSTRAINT `answeroptions_ibfk_1` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE;

--
-- Constraints for table `recommendedproducts`
--
ALTER TABLE `recommendedproducts`
  ADD CONSTRAINT `recommendedproducts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `recommendedproducts_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_ibfk_3` FOREIGN KEY (`OptionID`) REFERENCES `answeroptions` (`OptionID`) ON DELETE CASCADE;

--
-- Constraints for table `skincondition`
--
ALTER TABLE `skincondition`
  ADD CONSTRAINT `skincondition_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `useringredientanalysis`
--
ALTER TABLE `useringredientanalysis`
  ADD CONSTRAINT `useringredientanalysis_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `useringredientanalysis_ibfk_2` FOREIGN KEY (`IngredientID`) REFERENCES `ingredients` (`IngredientID`) ON DELETE CASCADE;

--
-- Constraints for table `userinputingredients`
--
ALTER TABLE `userinputingredients`
  ADD CONSTRAINT `userinputingredients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
