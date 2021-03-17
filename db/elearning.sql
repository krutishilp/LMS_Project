-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 06:33 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_Id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_Id`, `name`, `email`, `Password`) VALUES
(1, 'Prathamesh Dhobale', 'prathamesh@gmail.com', '12345'),
(2, 'Krutishil Purkar', 'krutishil@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_records`
--

CREATE TABLE `assessment_records` (
  `email` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `score` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessment_records`
--

INSERT INTO `assessment_records` (`email`, `exam_id`, `score`, `status`) VALUES
('srushti@gmail.com', '12345', '100', 1),
('srushti@gmail.com', 'WEBTECH_123', '100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_Id`, `Name`) VALUES
(1, 'IT'),
(2, 'COMP'),
(3, 'E&TC'),
(4, 'INSTRU'),
(5, 'MECH'),
(6, 'CIVIL');

-- --------------------------------------------------------

--
-- Table structure for table `pdfs`
--

CREATE TABLE `pdfs` (
  `name` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pdfs`
--

INSERT INTO `pdfs` (`name`, `unit`, `subject`, `author`) VALUES
('dsbda.pdf', 1, 'TOC', 'nishd268@gmail.com'),
('Python Tutorial.pdf', 1, 'Python', 'nishd268@gmail.com'),
('Pd.pdf', 3, 'DBMS', 'Srushti@g.com'),
('Resume.pdf', 5, 'DBMS', 'Srushti@g.com'),
('OfferLetter_PrathameshDhobale.pdf', 1, 'DBMS', 'Srushti@g.com'),
('Savitribai Phule Pune University, Online Result.pdf', 2, 'DBMS', 'Srushti@g.com'),
('Savitribai Phule Pune University, Online Result.pdf', 3, 'DBMS', 'Srushti@g.com'),
('Savitribai Phule Pune University, Online Result.pdf', 4, 'DBMS', 'Srushti@g.com');

-- --------------------------------------------------------

--
-- Table structure for table `ppts`
--

CREATE TABLE `ppts` (
  `name` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ppts`
--

INSERT INTO `ppts` (`name`, `unit`, `subject`, `author`) VALUES
('Pizza Restaurant PowerPoint Templates.pptx', 1, 'TOC', 'nishd268@gmail.com'),
('Python by the Creator.ppt', 1, 'Python', 'nishd268@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `prn`
--

CREATE TABLE `prn` (
  `prns` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `dept` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prn`
--

INSERT INTO `prn` (`prns`, `name`, `mname`, `dept`) VALUES
('12AB34', 'Raj Patil', 'Neelam', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `question` longtext NOT NULL,
  `op1` longtext NOT NULL,
  `op2` longtext NOT NULL,
  `op3` longtext NOT NULL,
  `op4` longtext NOT NULL,
  `ans` longtext NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `exam_id`, `question`, `op1`, `op2`, `op3`, `op4`, `ans`, `subject`) VALUES
('2', '12345', 'What is Python ?', 'SSl', 'ASD', 'AAD', 'ER', 'op1', 'DBMS'),
('1', 'WEBTECH_123', 'What is Web?', 'asd', 'ase', 'qwe', 'erf', 'op1', 'Web');

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `quizz_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`quizz_id`, `name`, `exam_id`, `duration`, `status`, `subject`, `teacher_id`) VALUES
(1, 'XYZ', '12345', '12345', 0, 'DBMS', 22),
(2, 'WEB TECH', 'WEBTECH_123', '20', 0, 'Web', 25);

-- --------------------------------------------------------

--
-- Table structure for table `qwise_assesment`
--

CREATE TABLE `qwise_assesment` (
  `email` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `uans` varchar(255) NOT NULL,
  `pt` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qwise_assesment`
--

INSERT INTO `qwise_assesment` (`email`, `exam_id`, `question_id`, `uans`, `pt`) VALUES
('rajp@gmail.com', 'PY', 'PYQ-1', 'op1', 1),
('rajp@gmail.com', 'PY', 'PYQ-2', 'op2', 1),
('rajp@gmail.com', 'PY', 'PYQ-3', 'op3', 1),
('rajp@gmail.com', 'PY', 'PYQ-4', 'op4', 1),
('rajp@gmail.com', 'PY', 'PYQ-5', 'op1', 1),
('d@r', '12', '1', 'op3', 0),
('d@r', '12', '2', 'op2', 0),
('d@r', '123', '1', 'op4', 0),
('d@r', '123', '2', 'op3', 0),
('Srushti@g.com', '12345', '1', 'op4', 0),
('Srushti@g.com', '123451212', '1', 'op4', 1),
('srushti@gmail.com', '12345', '1', 'op1', 0),
('srushti@gmail.com', '12345', '2', 'op1', 1),
('srushti@gmail.com', 'WEBTECH_123', '1', 'op1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `subject` varchar(255) NOT NULL,
  `vname` varchar(255) NOT NULL,
  `uemail` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`subject`, `vname`, `uemail`, `rating`) VALUES
('TOC', 'amaze.mp4', 'n@r', 'dl'),
('TOC', 'amaze.mp4', 'a@k', 'dl');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_Id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `prn` varchar(50) NOT NULL,
  `year` varchar(10) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_Id`, `name`, `email`, `prn`, `year`, `dept`, `Password`) VALUES
(1, 'Srushti Kishor Wajge', 'srushti@gmail.com', '71611203F', 'te', 'comp', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `student_pdf`
--

CREATE TABLE `student_pdf` (
  `name` varchar(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_ppt`
--

CREATE TABLE `student_ppt` (
  `name` varchar(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_videos`
--

CREATE TABLE `student_videos` (
  `name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_Id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `year` varchar(3) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `sem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_Id`, `subject`, `year`, `dept`, `sem`) VALUES
(1, 'Python', 'TE', 'IT', 3),
(2, 'DSF', 'SE', 'IT', 4),
(3, 'DBMS', 'TE', 'COMP', 5),
(4, 'Cloud Computing', 'BE', 'COMP', 8),
(5, 'Artificial Intelligence', 'BE', 'COMP', 8),
(6, 'Web', 'TE', 'COMP', 6),
(7, 'TOC', 'TE', 'COMP', 5);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_Id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `dept_Id` int(11) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_Id`, `email`, `name`, `subject`, `dept_Id`, `Password`) VALUES
(22, 'shewale@gmail.com', 'Shewale', 'DBMS', 2, '6051f69b0b347'),
(25, 'krutishilp@gmail.com', 'Krutishil Purkar', 'Web', 2, '6052377c93550');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `pos` varchar(3) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `email`, `pass`, `pos`, `dept`, `year`) VALUES
('Nishad Raisinghani', 'admin@rscoe.com', '12345', 'A', 'IT', 'TE'),
('Anuja Dombe', 'agdombe_it@jspmrscoe.edu.in', 'jspm@123', 'T', 'IT', 'TE'),
('NRD', 'd@r', '1234', 'S', 'IT', 'TE'),
('Nishad', 'nishd268@gmai.com', '5ef440ca6229d', 'T', 'IT', 'SE'),
('Raj Patil', 'rajp@gmail.com', '12345', 'S', 'IT', 'TE'),
('Srushti', 'Srushti@g.com', '5fc9fbc744c9e', 'T', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`name`, `subject`, `unit`, `views`, `likes`, `author`, `status`) VALUES
('Python Introduction.mp4', 'Python', 1, 0, 0, 'agdombe_it@jspmrscoe.edu.in', 1),
('Python Introduction.mp4', 'Python', 1, 0, 0, 'agdombe_it@jspmrscoe.edu.in', 0),
('VID-20190718-WA0000.mp4', 'DBMS', 3, 0, 0, 'Srushti@g.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `name` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`name`) VALUES
('FE'),
('SE'),
('TE'),
('BE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_Id`),
  ADD UNIQUE KEY `admin_email` (`email`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_Id`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`quizz_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_Id`),
  ADD UNIQUE KEY `student_email` (`email`),
  ADD UNIQUE KEY `student_prn` (`prn`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_Id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `quizz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
