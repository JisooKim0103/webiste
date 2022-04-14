-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 11:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cpstnsec`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentlist`
--

CREATE TABLE `enrollmentlist` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `academic_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_credential`
--

CREATE TABLE `faculty_credential` (
  `faculty_logid` int(11) NOT NULL,
  `faculty_code` varchar(30) NOT NULL,
  `faculty_password` varchar(32) NOT NULL,
  `faculty_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_credential`
--

INSERT INTO `faculty_credential` (`faculty_logid`, `faculty_code`, `faculty_password`, `faculty_id`) VALUES
(1, 'elem.j.amurao', '123', '2022-1'),
(2, 'hs.g.gulam', 'gulam', '2022-2');

-- --------------------------------------------------------

--
-- Table structure for table `student_credential`
--

CREATE TABLE `student_credential` (
  `student_logid` int(11) NOT NULL,
  `student_code` varchar(30) NOT NULL,
  `student_password` varchar(32) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_credential`
--

INSERT INTO `student_credential` (`student_logid`, `student_code`, `student_password`, `student_id`) VALUES
(1, 's10-gulamg', '123', 'AY2022-001'),
(2, 'c4-amuraoj', 'amurao', 'AY2022-005');

-- --------------------------------------------------------

--
-- Table structure for table `web_admin`
--

CREATE TABLE `web_admin` (
  `admin_id` int(11) NOT NULL,
  `admincode` varchar(50) NOT NULL,
  `adminpass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_admin`
--

INSERT INTO `web_admin` (`admin_id`, `admincode`, `adminpass`) VALUES
(1, 'g.gulam', '123'),
(2, 'j.amurao', 'amurao');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollmentlist`
--
ALTER TABLE `enrollmentlist`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `faculty_credential`
--
ALTER TABLE `faculty_credential`
  ADD PRIMARY KEY (`faculty_logid`);

--
-- Indexes for table `student_credential`
--
ALTER TABLE `student_credential`
  ADD PRIMARY KEY (`student_logid`);

--
-- Indexes for table `web_admin`
--
ALTER TABLE `web_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollmentlist`
--
ALTER TABLE `enrollmentlist`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_credential`
--
ALTER TABLE `faculty_credential`
  MODIFY `faculty_logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_credential`
--
ALTER TABLE `student_credential`
  MODIFY `student_logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `web_admin`
--
ALTER TABLE `web_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
