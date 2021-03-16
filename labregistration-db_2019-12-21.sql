-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2019 at 10:58 PM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labregistration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` varchar(6) NOT NULL,
  `courseName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `courseName`) VALUES
('CIS221', 'Database'),
('CIS341', 'Web Application Development'),
('CIS381', 'Human Computer Interaction'),
('CIS421', 'Database Applications'),
('CIS441', 'Business Data Communication');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `SID` int(6) NOT NULL,
  `LID` varchar(10) NOT NULL,
  `Snum` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`SID`, `LID`, `Snum`) VALUES
(122900, 'CIS221', 1),
(122900, 'CIS341', 1);

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `LabID` varchar(10) NOT NULL,
  `Name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Section` int(2) NOT NULL,
  `Day` varchar(4) NOT NULL,
  `Time` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Halls` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`LabID`, `Name`, `Section`, `Day`, `Time`, `Halls`) VALUES
('CIS221', 'Database', 1, 'SUN', '08:30-10:00', 'CIS01-PH3L-1'),
('CIS221', 'Database', 2, 'SUN', '08:30-10:00', 'CIS04-G2L2'),
('CIS221', 'Database', 3, 'SUN', '08:30-10:00', 'CIS07-A2L2'),
('CIS341', 'Web Application Development', 1, 'WED', '02:30-04:00', 'CIS03-PH1L-1'),
('CIS421', 'Database Applications', 2, 'SUN', '08:30-10:00', 'CIS03-PH1L-1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(25) NOT NULL,
  `id` int(6) NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `id`, `age`, `password`) VALUES
('Abd Al-Rahman Odeh', 122900, 20, 'abd99'),
('ahmed', 123456, 18, 'abcd1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD KEY `Fk_LID` (`LID`),
  ADD KEY `Fk_SID` (`SID`),
  ADD KEY `Fk_Snum` (`Snum`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`LabID`,`Section`),
  ADD KEY `section` (`Section`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `Fk_LID` FOREIGN KEY (`LID`) REFERENCES `labs` (`LabID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_SID` FOREIGN KEY (`SID`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_Snum` FOREIGN KEY (`Snum`) REFERENCES `labs` (`Section`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
