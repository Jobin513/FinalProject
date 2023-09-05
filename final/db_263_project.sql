-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2023 at 03:14 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_263_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commenID` char(4) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `responderID` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commenID`, `description`, `date`, `responderID`) VALUES
('C001', 'Microwave Fire', '2021-12-01', 'R001'),
('C002', 'Leaking Pipe', '2021-12-05', 'R002'),
('C003', 'Loose Elevator Cable', '2021-12-08', 'R003');

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE `incident` (
  `incidentID` char(4) NOT NULL,
  `type` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `date` date DEFAULT NULL,
  `responderID` char(4) DEFAULT NULL,
  `commenID` char(4) DEFAULT NULL,
  `ipID` varchar(10) DEFAULT NULL,
  `personID` char(4) DEFAULT NULL
) ;

--
-- Dumping data for table `incident`
--

INSERT INTO `incident` (`incidentID`, `type`, `state`, `date`, `responderID`, `commenID`, `ipID`, `personID`) VALUES
('N001', 'Microwave Fire', 'open', '2021-12-01', 'R001', 'C001', 'I001', 'P001'),
('N002', 'Leaking Pipe', 'closed', '2021-12-05', 'R002', 'C002', 'I002', 'P002'),
('N003', 'Loose Elevator Cable', 'stalled', '2021-12-08', 'R003', 'C003', 'I003', 'P003'),
('N004', 'Computer Freeze', 'open', '2023-09-04', 'R001', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ip_address`
--

CREATE TABLE `ip_address` (
  `ipID` varchar(10) NOT NULL,
  `ipaddress` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ip_address`
--

INSERT INTO `ip_address` (`ipID`, `ipaddress`, `reason`) VALUES
('I001', 123, 'Connected Computer Center'),
('I002', 457, 'President Phone IP Address'),
('I003', 789, 'Camera #3');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `personID` char(4) NOT NULL,
  `firstName` char(25) NOT NULL,
  `lastName` char(25) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `job` char(25) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`personID`, `firstName`, `lastName`, `email`, `job`, `description`) VALUES
('P001', 'Larry', 'Moreno', 'larrymoreno@mail.adelphi.edu', 'VicePresdient', 'Bystander'),
('P002', 'Nicholas', 'Prashad', 'nicholasprashad@mail.adelphi.edu', 'President', 'Witness'),
('P003', 'Jobin', 'John', 'jobinjohn@mail.adelphi.edu', 'Secretary', 'Injured');

-- --------------------------------------------------------

--
-- Table structure for table `responder`
--

CREATE TABLE `responder` (
  `responderID` char(4) NOT NULL,
  `handler` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responder`
--

INSERT INTO `responder` (`responderID`, `handler`) VALUES
('R001', 'John'),
('R002', 'Peter'),
('R003', 'Henry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commenID`),
  ADD KEY `fk_comment_responderID` (`responderID`);

--
-- Indexes for table `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incidentID`),
  ADD KEY `FK_Responded` (`responderID`),
  ADD KEY `FK_Comment` (`commenID`),
  ADD KEY `FK_Ip_Address` (`ipID`),
  ADD KEY `FK_Person` (`personID`);

--
-- Indexes for table `ip_address`
--
ALTER TABLE `ip_address`
  ADD PRIMARY KEY (`ipID`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`personID`);

--
-- Indexes for table `responder`
--
ALTER TABLE `responder`
  ADD PRIMARY KEY (`responderID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_Responder` FOREIGN KEY (`responderID`) REFERENCES `responder` (`responderID`),
  ADD CONSTRAINT `fk_comment_responderID` FOREIGN KEY (`responderID`) REFERENCES `responder` (`responderID`);

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `FK_Comment` FOREIGN KEY (`commenID`) REFERENCES `comment` (`commenID`),
  ADD CONSTRAINT `FK_Ip_Address` FOREIGN KEY (`ipID`) REFERENCES `ip_address` (`ipID`),
  ADD CONSTRAINT `FK_Person` FOREIGN KEY (`personID`) REFERENCES `people` (`personID`),
  ADD CONSTRAINT `FK_Responded` FOREIGN KEY (`responderID`) REFERENCES `responder` (`responderID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
