-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 10.01.2024 klo 15:18
-- Palvelimen versio: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventdatabase`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `eventattendees`
--

DROP TABLE IF EXISTS `eventattendees`;
CREATE TABLE IF NOT EXISTS `eventattendees` (
  `EventID` int NOT NULL,
  `UserID` int NOT NULL,
  `count` int NOT NULL,
  PRIMARY KEY (`EventID`,`UserID`),
  KEY `UserID` (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `eventattendees`
--

INSERT INTO `eventattendees` (`EventID`, `UserID`, `count`) VALUES
(1, 5, 5),
(1, 4, 9),
(1, 3, 12),
(1, 1, 17),
(1, 2, 15),
(3, 2, 15),
(3, 1, 17),
(3, 3, 12),
(3, 4, 9),
(3, 5, 5);

-- --------------------------------------------------------

--
-- Rakenne taululle `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `EventID` int NOT NULL AUTO_INCREMENT,
  `EventName` varchar(100) NOT NULL,
  `EventDate` date NOT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `events`
--

INSERT INTO `events` (`EventID`, `EventName`, `EventDate`) VALUES
(1, 'Tech Conference', '2023-09-15'),
(2, 'Product Launch', '2023-09-20'),
(3, 'Networking Mixer', '2023-09-25');

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`UserID`, `Username`, `email`, `deleted_at`) VALUES
(1, '\"><script>alert(\"Database XSS\");</script>', 'test@test.com', '2023-12-13 17:38:30'),
(2, 'Alice Smith', 'alice.smith@outlook.com', '2023-12-13 17:48:57'),
(3, 'Robert Johnson', NULL, '2023-12-13 17:50:04'),
(4, 'Emily White', 'emily.white.verylongemail123456789@gmail.com', '2023-12-13 17:38:06'),
(5, 'David Baker', NULL, '2023-12-13 17:37:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
