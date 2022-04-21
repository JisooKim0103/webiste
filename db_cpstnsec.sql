-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 08:01 AM
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
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `submission_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submission`
--

CREATE TABLE `assignment_submission` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_email` varchar(75) NOT NULL,
  `submission_link` text NOT NULL,
  `submission_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_description` varchar(50) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_description`, `year_level`, `semester`, `program`) VALUES
(1, 'Readings i', '3', 1, 1, 1),
(2, 'The Contem', '3', 1, 1, 1),
(3, 'Mathematic', '3', 1, 1, 1),
(4, 'Fundatamen', '3', 1, 1, 1),
(5, 'Filipino s', '3', 1, 1, 1),
(6, 'Civic Welf', '3', 1, 1, 1),
(7, 'Self Testi', '2', 1, 1, 1),
(8, 'Purposive ', '3', 1, 2, 1),
(9, 'Art Apprec', '3', 1, 2, 1),
(10, 'Science, T', '3', 1, 2, 1),
(11, 'Ethics', '3', 1, 2, 1),
(12, 'Basic Comp', '3', 1, 2, 1),
(13, 'Sosyedad a', '3', 1, 2, 1),
(14, 'Civic Welf', '3', 1, 2, 1),
(15, 'Fundamenta', '2', 1, 2, 1),
(16, 'Rizal\'s Li', '3', 2, 1, 1),
(17, 'Arts and H', '3', 2, 1, 1),
(18, 'Microecona', '3', 2, 1, 1),
(19, 'Environmen', '3', 2, 1, 1),
(20, 'Values Edu', '3', 2, 1, 1),
(21, 'Computer P', '3', 2, 1, 1),
(22, 'Fundamenta', '2', 2, 1, 1),
(23, 'Obligation', '3', 2, 2, 1),
(24, 'Income Tax', '3', 2, 2, 1),
(25, 'Inventory ', '3', 2, 2, 1),
(26, 'Social Res', '3', 2, 2, 1),
(27, 'Electronic', '3', 2, 2, 1),
(28, 'Recreation', '2', 2, 2, 1),
(29, 'Strategic ', '3', 3, 1, 1),
(30, 'Total Qual', '3', 3, 1, 1),
(31, 'Human Reso', '3', 3, 1, 1),
(32, 'Costing an', '3', 3, 1, 1),
(33, 'Logistic M', '3', 3, 1, 1),
(34, 'Bussiness ', '3', 3, 1, 1),
(35, 'Practicum/', '6', 3, 3, 1),
(36, 'Project Ma', '3', 3, 2, 1),
(37, 'Productivi', '3', 3, 2, 1),
(38, 'Facilities', '3', 3, 2, 1),
(39, 'Management', '3', 3, 2, 1),
(40, 'Managerial', '3', 3, 2, 1),
(41, 'Probabilit', '3', 3, 2, 1),
(42, 'Bussiness ', '3', 4, 1, 1),
(43, 'Global and', '3', 4, 1, 1),
(44, 'Entreprenu', '3', 4, 1, 1),
(45, 'Marketing ', '3', 4, 1, 1),
(46, 'Bussiness ', '3', 4, 2, 1),
(47, 'Financial ', '3', 4, 2, 1),
(48, 'Special To', '3', 4, 2, 1),
(49, 'Understand', '3', 1, 1, 2),
(50, 'Readings i', '3', 1, 1, 2),
(51, 'The contem', '3', 1, 1, 2),
(52, 'Mathematic', '3', 1, 1, 2),
(53, 'Fundamenta', '3', 1, 1, 2),
(54, 'Introducti', '3', 1, 1, 2),
(55, 'Filipino s', '3', 1, 1, 2),
(56, 'Civic Welf', '3', 1, 1, 2),
(57, 'Self Testi', '2', 1, 1, 2),
(58, 'Purposive ', '3', 1, 2, 2),
(59, 'Art  Appre', '3', 1, 2, 2),
(60, 'Science,Te', '3', 1, 2, 2),
(61, 'Ethics', '3', 1, 2, 2),
(62, 'Computer T', '3', 1, 2, 2),
(63, 'Computer P', '3', 1, 2, 2),
(64, 'Panitikang', '3', 1, 2, 2),
(65, 'Civic Welf', '3', 1, 2, 2),
(66, 'Fundamenta', '3', 1, 2, 2),
(67, 'Rizal\'s Li', '3', 2, 1, 2),
(68, 'Arts and H', '3', 2, 1, 2),
(69, 'Computer P', '3', 2, 1, 2),
(70, 'Computer P', '3', 2, 1, 2),
(71, 'Data Struc', '3', 2, 1, 2),
(72, 'Applicatio', '3', 2, 1, 2),
(73, 'Fundamenta', '2', 2, 1, 2),
(74, 'Electronic', '3', 2, 2, 2),
(75, 'Discrete S', '3', 2, 2, 2),
(76, 'Algorithms', '3', 2, 2, 2),
(77, 'Informatio', '3', 2, 2, 2),
(78, 'Programmin', '3', 2, 2, 2),
(79, 'Recreation', '2', 2, 2, 2),
(80, 'Discrete S', '3', 3, 1, 2),
(81, 'Automata T', '3', 3, 1, 2),
(82, 'Architectu', '3', 3, 1, 2),
(83, 'Object- Or', '3', 3, 1, 2),
(84, 'Software E', '3', 3, 1, 2),
(85, 'Bussiness ', '3', 3, 1, 2),
(86, 'Graphics a', '3', 3, 2, 2),
(87, 'Networks a', '3', 3, 2, 2),
(88, 'Operating ', '3', 3, 2, 2),
(89, 'Software E', '3', 3, 2, 2),
(90, 'Informatio', '3', 3, 2, 2),
(91, 'Human Comp', '3', 3, 2, 2),
(92, 'Probabilit', '3', 3, 2, 2),
(93, 'Computer R', '3', 4, 1, 2),
(94, 'System Fun', '3', 4, 1, 2),
(95, 'Values Edu', '3', 4, 1, 2),
(96, 'Computer R', '3', 4, 2, 2),
(97, 'Social Iss', '3', 4, 2, 2),
(98, 'Intelligen', '3', 4, 2, 2),
(99, 'Understand', '3', 1, 1, 3),
(100, 'Readings i', '3', 1, 1, 3),
(101, 'The Contem', '3', 1, 1, 3),
(102, 'Mathematic', '3', 1, 1, 3),
(103, 'Filipino s', '3', 1, 1, 3),
(104, 'Fundamenta', '3', 1, 1, 3),
(105, 'Technology', '3', 1, 1, 3),
(106, 'Civic Welf', '3', 1, 1, 3),
(107, 'Self Testi', '2', 1, 1, 3),
(108, 'Purposive ', '3', 1, 2, 3),
(109, 'Art Apprec', '3', 1, 2, 3),
(110, 'Science, T', '3', 1, 2, 3),
(111, 'Ethics ', '3', 1, 2, 3),
(112, 'Kontekstwa', '3', 1, 2, 3),
(113, 'Technology', '3', 1, 2, 3),
(114, 'Basic Comp', '3', 1, 2, 3),
(115, 'Civic Walf', '3', 1, 2, 3),
(116, 'Fundamenta', '2', 1, 2, 3),
(117, 'Rizal and ', '3', 2, 1, 3),
(118, 'Arts and H', '3', 2, 1, 3),
(119, 'Facilitati', '3', 2, 1, 3),
(120, 'Assesment ', '3', 2, 1, 3),
(121, 'Good Manne', '3', 2, 1, 3),
(122, 'The Child ', '3', 2, 1, 3),
(123, 'Computer P', '3', 2, 1, 3),
(124, 'Fundamenta', '2', 2, 1, 3),
(125, 'The Teache', '3', 2, 2, 3),
(126, 'Assesment ', '3', 2, 2, 3),
(127, 'The Teachi', '3', 2, 2, 3),
(128, 'Building a', '3', 2, 2, 3),
(129, 'The Teachi', '3', 2, 2, 3),
(130, 'Foundation', '3', 2, 2, 3),
(131, 'Electronic', '3', 2, 2, 3),
(132, 'Recreation', '2', 2, 2, 3),
(133, 'Edukasyong', '3', 3, 1, 3),
(134, 'Teaching E', '3', 3, 1, 3),
(135, 'Teaching S', '3', 3, 1, 3),
(136, 'Content an', '3', 3, 1, 3),
(137, 'Bussiness ', '3', 3, 1, 3),
(138, 'Teaching M', '3', 3, 1, 3),
(139, 'Teaching A', '3', 3, 1, 3),
(140, 'Research i', '3', 3, 2, 3),
(141, 'Teaching M', '3', 3, 2, 3),
(142, 'Teaching S', '3', 3, 2, 3),
(143, 'Teaching P', '3', 3, 2, 3),
(144, 'Pagtuturo ', '3', 3, 2, 3),
(145, 'Edukasyong', '3', 3, 2, 3),
(146, 'Probabilit', '3', 3, 2, 3),
(147, 'Teaching M', '3', 4, 1, 3),
(148, 'Teaching S', '3', 4, 1, 3),
(149, 'Pagtuturo ', '3', 4, 1, 3),
(150, 'Field Stud', '3', 4, 1, 3),
(151, 'Field Stud', '3', 4, 1, 3),
(152, 'Teaching E', '3', 4, 2, 3),
(153, 'Teaching M', '3', 4, 2, 3),
(154, 'Teaching S', '3', 4, 2, 3),
(155, 'Teaching I', '6', 4, 2, 3),
(156, 'Understand', '3', 1, 1, 4),
(157, 'Readings i', '3', 1, 1, 4),
(158, 'The Contem', '3', 1, 1, 4),
(159, 'Mathematic', '3', 1, 1, 4),
(160, 'Fundatamen', '3', 1, 1, 4),
(161, 'Filipino s', '3', 1, 1, 4),
(162, 'Civic Welf', '3', 1, 1, 4),
(163, 'Self Testi', '2', 1, 1, 4),
(164, 'Purposive ', '3', 1, 2, 4),
(165, 'Art Apprec', '3', 1, 2, 4),
(166, 'Science, T', '3', 1, 2, 4),
(167, 'Ethics', '3', 1, 2, 4),
(168, 'Basic Comp', '3', 1, 2, 4),
(169, 'Kontekstwa', '3', 1, 2, 4),
(170, 'Civic Welf', '3', 1, 2, 4),
(171, 'Fundamenta', '2', 1, 2, 4),
(172, 'Rizal\'s Li', '3', 2, 1, 4),
(173, 'Arts and H', '3', 2, 1, 4),
(174, 'Personal a', '3', 2, 1, 4),
(175, 'Administra', '3', 2, 1, 4),
(176, 'Values Edu', '3', 2, 1, 4),
(177, 'Computer P', '3', 2, 1, 4),
(178, 'Fundamenta', '2', 2, 1, 4),
(179, 'Principles', '3', 2, 2, 4),
(180, 'Obligation', '3', 2, 2, 4),
(181, 'Income Tax', '3', 2, 2, 4),
(182, 'Inventory ', '3', 2, 2, 4),
(183, 'Social Res', '3', 2, 2, 4),
(184, 'Electronic', '3', 2, 2, 4),
(185, 'Recreation', '2', 2, 2, 4),
(186, 'Strategic ', '3', 3, 1, 4),
(187, 'Intro to M', '3', 3, 1, 4),
(188, 'Bussiness ', '3', 3, 1, 4),
(189, 'Total Qual', '3', 3, 1, 4),
(190, 'Speed Deve', '3', 3, 1, 4),
(191, 'Office Adm', '6', 3, 3, 4),
(192, 'Project Ma', '3', 3, 2, 4),
(193, 'Productivi', '3', 3, 2, 4),
(194, 'Facilities', '3', 3, 2, 4),
(195, 'Management', '3', 3, 2, 4),
(196, 'Managerial', '3', 3, 2, 4),
(197, 'Probabilit', '3', 3, 2, 4),
(198, 'Bussiness ', '3', 4, 1, 4),
(199, 'Global and', '3', 4, 1, 4),
(200, 'Entreprenu', '3', 4, 1, 4),
(201, 'Marketing ', '3', 4, 1, 4),
(202, 'Bussiness ', '3', 4, 2, 4),
(203, 'Financial ', '3', 4, 2, 4),
(204, 'Special To', '3', 4, 2, 4);

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
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `department` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `firstname`, `middlename`, `lastname`, `department`, `class_id`, `date_created`) VALUES
(1, 'John', 'L', 'Daugherty', 2, 0, '2022-04-20 02:56:55');

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
(1, 'jldaught@sec.edu.ph', 'Password123!!', '112123');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(15) NOT NULL,
  `program_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_code`, `program_description`) VALUES
(1, 'BSBA', 'Business Adminsitration'),
(2, 'BSCS', 'Computer Science'),
(3, 'BSED', 'Elementary Education'),
(4, 'BSOA', 'Office Adminsitration');

-- --------------------------------------------------------

--
-- Table structure for table `schoolevent`
--

CREATE TABLE `schoolevent` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_description` varchar(255) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schoolevent`
--

INSERT INTO `schoolevent` (`event_id`, `event_name`, `event_description`, `event_date`) VALUES
(1, 'Ok', 'ok        ', '2022-04-19'),
(2, 'This is my event', 'Okay ito        ', '2022-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_description` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_description`) VALUES
(1, 'First Sem'),
(2, 'Second Sem'),
(3, 'Summer');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `program_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `firstname`, `middlename`, `lastname`, `program_id`, `class_id`, `date_created`) VALUES
(1, 'John Oliver', 'L', 'Amurao', 2, 0, '2022-04-20 05:23:43');

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
(1, 'joamurao@sec.edu.ph', '13XSuck!t', '00120150033');

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
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  ADD PRIMARY KEY (`submission_id`);

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
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `faculty_credential`
--
ALTER TABLE `faculty_credential`
  ADD PRIMARY KEY (`faculty_logid`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `schoolevent`
--
ALTER TABLE `schoolevent`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

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
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `enrollmentlist`
--
ALTER TABLE `enrollmentlist`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculty_credential`
--
ALTER TABLE `faculty_credential`
  MODIFY `faculty_logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schoolevent`
--
ALTER TABLE `schoolevent`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_credential`
--
ALTER TABLE `student_credential`
  MODIFY `student_logid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `web_admin`
--
ALTER TABLE `web_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
