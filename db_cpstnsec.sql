-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 02:40 AM
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
  `submission_date` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_id`, `title`, `description`, `faculty_id`, `class_id`, `submission_date`, `date_created`) VALUES
(1, 'Hello, World!', 'Create a simple python program with hello world as output', 1, 55, '2022-05-06 00:00:00', '2022-04-29 07:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submission`
--

CREATE TABLE `assignment_submission` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submission_link` text NOT NULL,
  `submission_date` datetime NOT NULL,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_submission`
--

INSERT INTO `assignment_submission` (`submission_id`, `assignment_id`, `student_id`, `submission_link`, `submission_date`, `feedback`) VALUES
(1, 1, 1, 'https://www.google.com', '2022-04-29 08:17:02', 'Good submission, early bird!');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_description` varchar(50) NOT NULL,
  `course_units` int(11) NOT NULL,
  `year_level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_description`, `course_units`, `year_level`, `semester`, `program_id`) VALUES
(1, 'GED 111', 'Understanding the Self', 3, 1, 1, 1),
(2, 'GED 112', 'Readings in Philippine History', 3, 1, 1, 1),
(3, 'GED 113', 'The Contemporary World', 3, 1, 1, 1),
(4, 'GED 114', 'Mathematics in the Modern  World', 3, 1, 1, 1),
(5, 'TYP100', 'Fundatamentals of Typing', 3, 1, 1, 1),
(6, 'FIL111', 'Filipino sa Ibat-Ibang Disiplina', 3, 1, 1, 1),
(7, 'NSTP 1', 'Civic Welfare Training Service I', 3, 1, 1, 1),
(8, 'P.E 1', 'Self Testing Activities', 2, 1, 1, 1),
(9, 'GED125', 'Purposive Communication', 3, 1, 2, 1),
(10, 'GED126', 'Art Appreciation', 3, 1, 2, 1),
(11, 'GED127', 'Science, Technology and  Society', 3, 1, 2, 1),
(12, 'GED128', 'Ethics', 3, 1, 2, 1),
(13, 'COM101', 'Basic Computer Techniques and Word Pro', 3, 1, 2, 1),
(14, 'FIL221', 'Sosyedad at literatura /Panitikang Panlipunan', 3, 1, 2, 1),
(15, 'NSTP 2', 'Civic Welfare Training Service 2', 3, 1, 2, 1),
(16, 'P.E 2', 'Fundamentals or Rythmic Activities', 2, 1, 2, 1),
(17, 'GED 129', 'Rizal\'s Life and Works', 3, 2, 1, 1),
(18, 'GED 222', 'Arts and Humanities', 3, 2, 1, 1),
(19, 'ECO 101', 'Microeconamics', 3, 2, 1, 1),
(20, 'MGT 211', 'Environmental  Management System', 3, 2, 1, 1),
(21, 'EDU 040', 'Values Education', 3, 2, 1, 1),
(22, 'COM200', 'Computer Presentation Skills', 3, 2, 1, 1),
(23, 'P.E 3', 'Fundamentals or Games and Sports', 2, 2, 1, 1),
(24, 'LAW 201', 'Obligations and Contracts', 3, 2, 2, 1),
(25, 'TAX 101', 'Income Taxation', 3, 2, 2, 1),
(26, 'MGT 401', 'Inventory Management and Control', 3, 2, 2, 1),
(27, 'BEC100', 'Social Responsibility and Good Governance', 3, 2, 2, 1),
(28, 'COM 201', 'Electronic Spreadsheet Applications', 3, 2, 2, 1),
(29, 'P.E 4', 'Recreational Activities (Swimming)', 2, 2, 2, 1),
(30, 'MGT 501', 'Strategic Operation Management', 3, 3, 1, 1),
(31, 'BEC 102', 'Total Quality Management', 3, 3, 1, 1),
(32, 'MGT 202', 'Human Resource Management', 3, 3, 1, 1),
(33, 'MGT 312', 'Costing and Pricing', 3, 3, 1, 1),
(34, 'MGT 403', 'Logistic Management', 3, 3, 1, 1),
(35, 'ENG 304', 'Bussiness Communication', 3, 3, 1, 1),
(36, 'MGT 500', 'Practicum/ Work Integrated Learning', 6, 3, 3, 1),
(37, 'MGT 402', 'Project Management', 3, 3, 2, 1),
(38, 'MGT 322', 'Productivity and Quality Tools', 3, 3, 2, 1),
(39, 'MGT 323', 'Facilities Management', 3, 3, 2, 1),
(40, 'MGT 201', 'Management Information System', 3, 3, 2, 1),
(41, 'MGT 321', 'Managerial Accounting', 3, 3, 2, 1),
(42, 'MGT 303', 'Probability and Statistic', 3, 3, 2, 1),
(43, 'MGT 411', 'Bussiness Research 1', 3, 4, 1, 1),
(44, 'MGT 304', 'Global and International  Trade', 3, 4, 1, 1),
(45, 'MGT 414', 'Entreprenurial Management', 3, 4, 1, 1),
(46, 'MGT 415', 'Marketing Management', 3, 4, 1, 1),
(47, 'MGT 421', 'Bussiness Research 2', 3, 4, 2, 1),
(48, 'FIN 400', 'Financial Management', 3, 4, 2, 1),
(49, 'MGT 412', 'Special Topics In Operations Management', 3, 4, 2, 1),
(50, 'GED111', 'Understanding the Self', 3, 1, 1, 2),
(51, 'GED112', 'Readings in Philippine History', 3, 1, 1, 2),
(52, 'GED113', 'The contemporary world', 3, 1, 1, 2),
(53, 'GED114', 'Mathematics in the modern worl', 3, 1, 1, 2),
(54, 'TYP100', 'Fundamentals of Typing', 3, 1, 1, 2),
(55, 'CC101', 'Introduction to Computing', 3, 1, 1, 2),
(56, 'FL111', 'Filipino sa Iba\'t Ibang Disipl', 3, 1, 1, 2),
(57, 'NSTP1', 'Civic Welfare Training Service', 3, 1, 1, 2),
(58, 'PE1', 'Self Testing Activities', 2, 1, 1, 2),
(59, 'GED125', 'Purposive Communication', 3, 1, 2, 2),
(60, 'GED126', 'Art  Appreciation', 3, 1, 2, 2),
(61, 'GED127', 'Science,Technology and Society', 3, 1, 2, 2),
(62, 'GED128', 'Ethics', 3, 1, 2, 2),
(63, 'COM101', 'Computer Techniques & Word Pro', 3, 1, 2, 2),
(64, 'CC102', 'Computer Programming I', 3, 1, 2, 2),
(65, 'FIL221', 'Panitikang Filipino', 3, 1, 2, 2),
(66, 'NSTP2', 'Civic Welfare Training Service', 3, 1, 2, 2),
(67, 'P.E 2', 'Fundamentals of Rhythmic Activ', 3, 1, 2, 2),
(68, 'GED219', 'Rizal\'s Life and Works', 3, 2, 1, 2),
(69, 'GED220', 'Arts and Humanities', 3, 2, 1, 2),
(70, 'COM200', 'Computer Presentation Skills 2', 3, 2, 1, 2),
(71, 'CC102', 'Computer Programming 2', 3, 2, 1, 2),
(72, 'CC104', 'Data Structure and Algorithms', 3, 2, 1, 2),
(73, 'CC106', 'Applications Development/ Emer', 3, 2, 1, 2),
(74, 'P.E 3', 'Fundamentals of Games and Spor', 2, 2, 1, 2),
(75, 'COM201', 'Electronic Spreadsheet Applica', 3, 2, 2, 2),
(76, 'DS101', 'Discrete Structure I', 3, 2, 2, 2),
(77, 'AL101', 'Algorithms and Complexity', 3, 2, 2, 2),
(78, 'CC105', 'Information Management', 3, 2, 2, 2),
(79, 'PL103', 'Programming Languages', 3, 2, 2, 2),
(80, 'P.E 4', 'Recreational Activities', 2, 2, 2, 2),
(81, 'DS102', 'Discrete Structure 2', 3, 3, 1, 2),
(82, 'AL102', 'Automata Theory and Formal Lan', 3, 3, 1, 2),
(83, 'AR101', 'Architecture  and Organization', 3, 3, 1, 2),
(84, 'SDF 104', 'Object- Oriented Programming', 3, 3, 1, 2),
(85, 'SE101', 'Software Engineering I', 3, 3, 1, 2),
(86, 'ENG104', 'Bussiness Communication', 3, 3, 1, 2),
(87, 'ELEC101', 'Graphics and Visual Computing', 3, 3, 2, 2),
(88, 'NC101', 'Networks and Communications', 3, 3, 2, 2),
(89, 'OS101', 'Operating Systems', 3, 3, 2, 2),
(90, 'SE102', 'Software Engineering 2', 3, 3, 2, 2),
(91, 'IAS 103', 'Information Assurance and Secu', 3, 3, 2, 2),
(92, 'HC1101', 'Human Computer Interaction', 3, 3, 2, 2),
(93, 'MAT 303', 'Probability and Statistics', 3, 3, 2, 2),
(94, 'COM 502', 'Computer Research 1', 3, 4, 1, 2),
(95, 'ELEC 102', 'System Fundamentals', 3, 4, 1, 2),
(96, 'EDU540', 'Values Education', 3, 4, 1, 2),
(97, 'COM 602', 'Computer Research 2', 3, 4, 2, 2),
(98, 'SIP101', 'Social Issues and Professional', 3, 4, 2, 2),
(99, 'ELEC103', 'Intelligence System', 3, 4, 2, 2),
(100, 'GED 111', 'Understanding Self', 3, 1, 1, 3),
(101, 'GED 112', 'Readings in Philippine History', 3, 1, 1, 3),
(102, 'GED 113', 'The Contemporary World', 3, 1, 1, 3),
(103, 'GED 114', 'Mathematics in The Modern World', 3, 1, 1, 3),
(104, 'FIL 111', 'Filipino sa Ibat Ibang Disiplina', 3, 1, 1, 3),
(105, 'TYP 100', 'Fundamentals of typing', 3, 1, 1, 3),
(106, 'TTL 111', 'Technology for Teaching and Learning 1', 3, 1, 1, 3),
(107, 'NSTP I', 'Civic Welfare training Service  1', 3, 1, 1, 3),
(108, 'P.E 1', 'Self Testing Activities', 2, 1, 1, 3),
(109, 'GED 125', 'Purposive Communication', 3, 1, 2, 3),
(110, 'GED 126', 'Art Appreciation', 3, 1, 2, 3),
(111, 'GED 127', 'Science, Technology and Society', 3, 1, 2, 3),
(112, 'GED 128', 'Ethics', 3, 1, 2, 3),
(113, 'FIL 221', 'Kontekstwalisadong Komunikasyon sa Filipino', 3, 1, 2, 3),
(114, 'TTL 121', 'Technology for Teaching and Learning 2', 3, 1, 2, 3),
(115, 'COM 101', 'Basic Computer Techniques  & Word Processing', 3, 1, 2, 3),
(116, 'NSTP 2', 'Civic Walfare Training Service 2', 3, 1, 2, 3),
(117, 'P.E 2', 'Fundamentals of Rythimic Activities', 2, 1, 2, 3),
(118, 'GED 219', 'Rizal and Life Works', 3, 2, 1, 3),
(119, 'GED 220', 'Arts and Humanities', 3, 2, 1, 3),
(120, 'EDU 221', 'Facilitating  Learner - Centered Teaching', 3, 2, 1, 3),
(121, 'EDU 305', 'Assesment of Learning I', 3, 2, 1, 3),
(122, 'VED 111', 'Good Manners and Right Conduct', 3, 2, 1, 3),
(123, 'EDU 111', 'The Child & Adolescent Learners and Learning Princ', 3, 2, 1, 3),
(124, 'COM 200', 'Computer Presentation Skills', 3, 2, 1, 3),
(125, 'P.E 3', 'Fundamentals of Games and Sports', 2, 2, 1, 3),
(126, 'EDU 222', 'The Teacher and the School Curriculm', 3, 2, 2, 3),
(127, 'EDU 306', 'Assesment of Learning 2', 3, 2, 2, 3),
(128, 'EDU 005', 'The Teaching Profession', 3, 2, 2, 3),
(129, 'EDU 223', 'Building and Enhancing New Literacies  Across the ', 3, 2, 2, 3),
(130, 'EDU 224', 'The Teaching and the Community. School Culture and', 3, 2, 2, 3),
(131, 'EDU 121', 'Foundations of Special and Inclusive Education', 3, 2, 2, 3),
(132, 'COM 200', 'Electronic Spreadsheet  Application', 3, 2, 2, 3),
(133, 'P.E 4', 'Recreational Activities', 2, 2, 2, 3),
(134, 'TLE 111', 'Edukasyong Pantahanan at Pangkabuhayan', 3, 3, 1, 3),
(135, 'ENG 111', 'Teaching English in the Elementary  Grades (Langua', 3, 3, 1, 3),
(136, 'SCH 111', 'Teaching Science in Elementary Grades (biology che', 3, 3, 1, 3),
(137, 'MTB 111', 'Content and Pedagogy for the Mother Tounge', 3, 3, 1, 3),
(138, 'ENG 304', 'Bussiness Communication', 3, 3, 1, 3),
(139, 'MUS 111', 'Teaching Music in the Elementary  Grades', 3, 3, 1, 3),
(140, 'ART 111', 'Teaching Arts in the Elementary  Grades', 3, 3, 1, 3),
(141, 'EDU 401', 'Research in Education', 3, 3, 2, 3),
(142, 'EDU 331', 'Teaching Multi-Grade Classes', 3, 3, 2, 3),
(143, 'SSC 111', 'Teaching Social Studies in Elementary Grades', 3, 3, 2, 3),
(144, 'PEH 111', 'Teaching P,E & Health in the Elementary Grade', 3, 3, 2, 3),
(145, 'FIL 110', 'Pagtuturo ng Wikang Filipino sa Elementarya (Estru', 3, 3, 2, 3),
(146, 'TLE 112', 'Edukasyong Pantahanan at Pangkabuhayan with Entrep', 3, 3, 2, 3),
(147, 'MAT 303', 'Probability and Statistics', 3, 3, 2, 3),
(148, 'MAT 111', 'Teaching Math in the Primary Grades', 3, 4, 1, 3),
(149, 'SSC 112', 'Teaching Social Studies in the Elementary  Grade (', 3, 4, 1, 3),
(150, 'FIL 112', 'Pagtuturo ng Filipino sa Elementary Panitikan ng P', 3, 4, 1, 3),
(151, 'EDFS01', 'Field Study 1', 3, 4, 1, 3),
(152, 'EDFS02', 'Field Study 2', 3, 4, 1, 3),
(153, 'GED 125', 'Teaching English in the Elementary Grades  Through', 3, 4, 2, 3),
(154, 'GED 126', 'Teaching Math in Intermediate  Grades', 3, 4, 2, 3),
(155, 'GED 127', 'Teaching Science in Elementary Grades (Physics, Ea', 3, 4, 2, 3),
(156, 'GED 128', 'Teaching Internship', 6, 4, 2, 3),
(157, 'GED 111', 'Understanding the Self', 3, 1, 1, 4),
(158, 'GED 112', 'Readings in Philippine History', 3, 1, 1, 4),
(159, 'GED 113', 'The Contemporary World', 3, 1, 1, 4),
(160, 'GED 114', 'Mathematics in the Modern  World', 3, 1, 1, 4),
(161, 'TYP100', 'Fundatamentals of Typing', 3, 1, 1, 4),
(162, 'FIL111', 'Filipino sa Ibat-Ibang Disiplina', 3, 1, 1, 4),
(163, 'NSTP 1', 'Civic Welfare Training Service I', 3, 1, 1, 4),
(164, 'P.E 1', 'Self Testing Activities', 2, 1, 1, 4),
(165, 'GED125', 'Purposive Communication', 3, 1, 2, 4),
(166, 'GED126', 'Art Appreciation', 3, 1, 2, 4),
(167, 'GED127', 'Science, Technology and  Society', 3, 1, 2, 4),
(168, 'GED128', 'Ethics', 3, 1, 2, 4),
(169, 'COM101', 'Basic Computer Techniques and Word Pro', 3, 1, 2, 4),
(170, 'FIL 121', 'Kontekstwalisadong Komunikasyon sa Filipino', 3, 1, 2, 4),
(171, 'NSTP 2', 'Civic Welfare Training Service 2', 3, 1, 2, 4),
(172, 'P.E 2', 'Fundamentals or Rythmic Activities', 2, 1, 2, 4),
(173, 'GED 129', 'Rizal\'s Life and Works', 3, 2, 1, 4),
(174, 'GED 220', 'Arts and Humanities', 3, 2, 1, 4),
(175, 'PSY102', 'Personal and Professional Development', 3, 2, 1, 4),
(176, 'MGT 212', 'Administrative  Office Procedures and Mgt.', 3, 2, 1, 4),
(177, 'EDU 040', 'Values Education', 3, 2, 1, 4),
(178, 'COM200', 'Computer Presentation Skills', 3, 2, 1, 4),
(179, 'P.E 3', 'Fundamentals or Games and Sports', 2, 2, 1, 4),
(180, 'OFC 201', 'Principles of Public and Customer Relations', 3, 2, 2, 4),
(181, 'LAW 201', 'Obligations and Contracts', 3, 2, 2, 4),
(182, 'TAX 101', 'Income Taxation', 3, 2, 2, 4),
(183, 'MGT 401', 'Inventory Management and Control', 3, 2, 2, 4),
(184, 'BEC100', 'Social Responsibility and Good Governance', 3, 2, 2, 4),
(185, 'COM 201', 'Electronic Spreadsheet Applications', 3, 2, 2, 4),
(186, 'P.E 4', 'Recreational Activities (Swimming)', 2, 2, 2, 4),
(187, 'MGT 501', 'Strategic Operation Management', 3, 3, 1, 4),
(188, 'COM 503', 'Intro to Multimedia and Web Design', 3, 3, 1, 4),
(189, 'ENG 304', 'Bussiness Communication', 3, 3, 1, 4),
(190, 'BEC102', 'Total Quality Management', 3, 3, 1, 4),
(191, 'STE 200', 'Speed Development', 3, 3, 1, 4),
(192, 'OFC 101', 'Office Administration Internship', 6, 3, 3, 4),
(193, 'MGT 402', 'Project Management', 3, 3, 2, 4),
(194, 'MGT 322', 'Productivity and Quality Tools', 3, 3, 2, 4),
(195, 'MGT 323', 'Facilities Management', 3, 3, 2, 4),
(196, 'MGT 201', 'Management Information System', 3, 3, 2, 4),
(197, 'MGT 321', 'Managerial Accounting', 3, 3, 2, 4),
(198, 'MGT 303', 'Probability and Statistic', 3, 3, 2, 4),
(199, 'MGT 411', 'Bussiness Research 1', 3, 4, 1, 4),
(200, 'MGT 304', 'Global and International  Trade', 3, 4, 1, 4),
(201, 'MGT 414', 'Entreprenurial Management', 3, 4, 1, 4),
(202, 'MGT 415', 'Marketing Management', 3, 4, 1, 4),
(203, 'MGT 421', 'Bussiness Research 2', 3, 4, 2, 4),
(204, 'FIN 400', 'Financial Management', 3, 4, 2, 4),
(205, 'MGT 412', 'Special Topics In Operations Management', 3, 4, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `course_handled`
--

CREATE TABLE `course_handled` (
  `course_handling_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `date_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_handled`
--

INSERT INTO `course_handled` (`course_handling_id`, `course_id`, `faculty_id`, `date_create`) VALUES
(1, 55, 1, '2022-04-29 07:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `enrollmentlist`
--

CREATE TABLE `enrollmentlist` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollmentlist`
--

INSERT INTO `enrollmentlist` (`enrollment_id`, `student_id`, `program_id`, `class_id`, `academic_year`) VALUES
(1, 1, 2, 50, 2022),
(2, 1, 2, 51, 2022),
(3, 1, 2, 52, 2022),
(4, 1, 2, 53, 2022),
(5, 1, 2, 54, 2022),
(6, 1, 2, 55, 2022),
(7, 1, 2, 56, 2022),
(8, 1, 2, 57, 2022),
(9, 1, 2, 58, 2022);

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
  `program_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `firstname`, `middlename`, `lastname`, `department`, `program_id`, `date_created`) VALUES
(1, 'John', 'L', 'Laurinaitis', 2, 2, '2022-04-29 07:27:13');

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
(1, 'jlaurinaitis@sec.edu.ph', '123456', '123456');

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
(4, 'BSOA', 'Office Adminsitration'),
(5, 'BEeD-ENG', 'Elementary Education - English'),
(6, 'BEeD-FIL', 'Elementary Education - Filipino'),
(7, 'BEeD-MAT', 'Elementary Education - Mathematics');

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
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `firstname`, `middlename`, `lastname`, `program_id`, `date_created`) VALUES
(1, 'John', 'L', 'Oaramu', 2, '2022-04-29 07:28:35');

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
(1, 'johno@sec.edu.ph', '20150033', '20150033');

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
-- Indexes for table `course_handled`
--
ALTER TABLE `course_handled`
  ADD PRIMARY KEY (`course_handling_id`);

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
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `course_handled`
--
ALTER TABLE `course_handled`
  MODIFY `course_handling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enrollmentlist`
--
ALTER TABLE `enrollmentlist`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schoolevent`
--
ALTER TABLE `schoolevent`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

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
