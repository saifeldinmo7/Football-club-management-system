-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2026 at 05:43 PM
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
-- Database: `football_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coachId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`coachId`, `userId`, `teamId`, `name`, `age`, `phone`, `specialization`) VALUES
(1, 2, 1, 'Ali Mohamed', 40, '01001234567', 'Attacking'),
(2, 3, 2, 'Omar Khaled', 38, '01009876543', 'Defensive');

-- --------------------------------------------------------

--
-- Table structure for table `lineup`
--

CREATE TABLE `lineup` (
  `lineupId` int(11) NOT NULL,
  `matchId` int(11) DEFAULT NULL,
  `coachId` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `isStarting` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lineup`
--

INSERT INTO `lineup` (`lineupId`, `matchId`, `coachId`, `position`, `isStarting`) VALUES
(1, 1, 1, 'Forward', 1),
(2, 1, 1, 'Midfielder', 1),
(3, 2, 2, 'Defender', 1);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `matchId` int(11) NOT NULL,
  `teamId` int(11) DEFAULT NULL,
  `opponent` varchar(100) NOT NULL,
  `matchDate` date NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `result` varchar(20) DEFAULT NULL,
  `status` enum('scheduled','completed','cancelled') DEFAULT 'scheduled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`matchId`, `teamId`, `opponent`, `matchDate`, `location`, `result`, `status`) VALUES
(1, 1, 'Zamalek', '2025-06-01', 'Cairo Stadium', NULL, 'scheduled'),
(2, 2, 'Al Ahly', '2025-06-01', 'Cairo Stadium', NULL, 'scheduled'),
(3, 1, 'Pyramids FC', '2025-05-15', 'Alexandria', '2-1', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `playerId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `shirtNumber` int(11) DEFAULT NULL,
  `fitnessStatus` varchar(50) DEFAULT NULL,
  `performanceScore` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerId`, `userId`, `teamId`, `name`, `age`, `position`, `shirtNumber`, `fitnessStatus`, `performanceScore`) VALUES
(1, 4, 1, 'Ahmed Hassan', 22, 'Forward', 9, 'Fit', 85),
(2, 5, 1, 'Mohamed Salah', 24, 'Midfielder', 10, 'Fit', 90),
(3, 6, 2, 'Karim Nasser', 21, 'Defender', 5, 'Injured', 70);

-- --------------------------------------------------------

--
-- Table structure for table `player_training`
--

CREATE TABLE `player_training` (
  `id` int(11) NOT NULL,
  `playerId` int(11) DEFAULT NULL,
  `sessionId` int(11) DEFAULT NULL,
  `attendance` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player_training`
--

INSERT INTO `player_training` (`id`, `playerId`, `sessionId`, `attendance`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `teamId` int(11) NOT NULL,
  `teamName` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`teamId`, `teamName`, `category`) VALUES
(1, 'Al Ahly', 'Senior'),
(2, 'Zamalek', 'Senior'),
(3, 'Youth Eagles', 'Youth');

-- --------------------------------------------------------

--
-- Table structure for table `training_sessions`
--

CREATE TABLE `training_sessions` (
  `sessionId` int(11) NOT NULL,
  `coachId` int(11) DEFAULT NULL,
  `teamId` int(11) DEFAULT NULL,
  `sessionDate` date NOT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `focusArea` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_sessions`
--

INSERT INTO `training_sessions` (`sessionId`, `coachId`, `teamId`, `sessionDate`, `duration`, `focusArea`, `notes`) VALUES
(1, 1, 1, '2025-05-20', '90 mins', 'Attacking drills', 'Focus on finishing'),
(2, 2, 2, '2025-05-21', '60 mins', 'Defensive shape', 'Work on set pieces');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','coach','player') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin1', 'admin123', 'admin@football.com', 'admin'),
(2, 'coach_ali', 'coach123', 'ali@football.com', 'coach'),
(3, 'coach_omar', 'coach123', 'omar@football.com', 'coach'),
(4, 'player_ahmed', 'player123', 'ahmed@football.com', 'player'),
(5, 'player_mo', 'player123', 'mo@football.com', 'player'),
(6, 'player_karim', 'player123', 'karim@football.com', 'player');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coachId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `teamId` (`teamId`);

--
-- Indexes for table `lineup`
--
ALTER TABLE `lineup`
  ADD PRIMARY KEY (`lineupId`),
  ADD KEY `matchId` (`matchId`),
  ADD KEY `coachId` (`coachId`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`matchId`),
  ADD KEY `teamId` (`teamId`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`playerId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `teamId` (`teamId`);

--
-- Indexes for table `player_training`
--
ALTER TABLE `player_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `playerId` (`playerId`),
  ADD KEY `sessionId` (`sessionId`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teamId`);

--
-- Indexes for table `training_sessions`
--
ALTER TABLE `training_sessions`
  ADD PRIMARY KEY (`sessionId`),
  ADD KEY `coachId` (`coachId`),
  ADD KEY `teamId` (`teamId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coachId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lineup`
--
ALTER TABLE `lineup`
  MODIFY `lineupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `matchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `player_training`
--
ALTER TABLE `player_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `teamId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_sessions`
--
ALTER TABLE `training_sessions`
  MODIFY `sessionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE SET NULL,
  ADD CONSTRAINT `coaches_ibfk_2` FOREIGN KEY (`teamId`) REFERENCES `teams` (`teamId`) ON DELETE SET NULL;

--
-- Constraints for table `lineup`
--
ALTER TABLE `lineup`
  ADD CONSTRAINT `lineup_ibfk_1` FOREIGN KEY (`matchId`) REFERENCES `matches` (`matchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `lineup_ibfk_2` FOREIGN KEY (`coachId`) REFERENCES `coaches` (`coachId`) ON DELETE SET NULL;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`teamId`) REFERENCES `teams` (`teamId`) ON DELETE SET NULL;

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE SET NULL,
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`teamId`) REFERENCES `teams` (`teamId`) ON DELETE SET NULL;

--
-- Constraints for table `player_training`
--
ALTER TABLE `player_training`
  ADD CONSTRAINT `player_training_ibfk_1` FOREIGN KEY (`playerId`) REFERENCES `players` (`playerId`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_training_ibfk_2` FOREIGN KEY (`sessionId`) REFERENCES `training_sessions` (`sessionId`) ON DELETE CASCADE;

--
-- Constraints for table `training_sessions`
--
ALTER TABLE `training_sessions`
  ADD CONSTRAINT `training_sessions_ibfk_1` FOREIGN KEY (`coachId`) REFERENCES `coaches` (`coachId`) ON DELETE SET NULL,
  ADD CONSTRAINT `training_sessions_ibfk_2` FOREIGN KEY (`teamId`) REFERENCES `teams` (`teamId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
