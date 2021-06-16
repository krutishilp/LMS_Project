-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 04:47 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 'admin', 'admin@gmail.com', '12345'),
(2, 'Krutishil Purkar', 'krutishil@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_records`
--

CREATE TABLE `assessment_records` (
  `assessment_id` int(11) NOT NULL,
  `stud_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `score` int(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessment_records`
--

INSERT INTO `assessment_records` (`assessment_id`, `stud_name`, `email`, `exam_id`, `score`, `status`) VALUES
(1, 'Srushti aaa', 'srushti@gmail.com', '123456', 40, 1),
(2, 'Srushti', 'srushti@gmail.com', '123456', 50, 1),
(3, 'Srushti wwww', 'srushti@gmail.com', '123456', 75, 1),
(4, 'Test', 'test@test.com', '123456', 80, 1),
(7, 'Srushti Kishor Wajge', 'srushti@gmail.com', '123456', 100, 1),
(8, 'Nidhi Goda', 'nidhi@gmail.com', '123456', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `Assignment_No` int(11) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Subject_Name` varchar(50) NOT NULL,
  `Unit` int(11) NOT NULL,
  `Teacher_ID` int(11) NOT NULL,
  `Assignment_Deadline` date NOT NULL,
  `Assignment_Given_On` date NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`Assignment_No`, `Description`, `Subject_Name`, `Unit`, `Teacher_ID`, `Assignment_Deadline`, `Assignment_Given_On`, `filename`) VALUES
(1, 'This is 1st assignment', 'Web', 1, 25, '2021-03-24', '2021-03-21', 'pdfs/PAYSLIP JUL 2020 (1).pdf'),
(2, 'This is 1st assignment for dbms', 'DBMS', 1, 22, '2021-03-31', '2021-03-24', 'pdfs/CandidateHallTicket.pdf'),
(3, 'This is 2nd assignment', 'DBMS', 2, 22, '2021-04-04', '2021-03-24', 'pdfs/HallTicket_REG_Student.pdf'),
(4, 'Assignment', 'Artificial', 4, 26, '2021-04-26', '2021-04-25', 'pdfs/PAYSLIP MAR 2021.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submission`
--

CREATE TABLE `assignment_submission` (
  `submission_Id` int(11) NOT NULL,
  `student_Id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `unit` int(11) NOT NULL,
  `submission_date` date NOT NULL,
  `assignment_no` int(11) NOT NULL,
  `filepath` varchar(500) NOT NULL,
  `submitted` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment_submission`
--

INSERT INTO `assignment_submission` (`submission_Id`, `student_Id`, `student_name`, `subject_name`, `unit`, `submission_date`, `assignment_no`, `filepath`, `submitted`) VALUES
(1, 1, 'Srushti Kishor Wajge', 'DBMS', 1, '2021-03-25', 2, '../teacher/Assignment_Submitted/Resume.pdf', 'On Time'),
(2, 1, 'Srushti Kishor Wajge', 'DBMS', 2, '2021-03-25', 3, '../teacher/Assignment_Submitted/Pd.pdf', 'On Time'),
(3, 1, 'Srushti Kishor Wajge', 'Web', 1, '2021-03-25', 1, '../teacher/Assignment_Submitted/IJETT-V4I4P283-1 (1).pdf', 'Late'),
(4, 3, 'Nidhi Goda', 'Artificial', 4, '2021-04-25', 4, '../teacher/Assignment_Submitted/PAYSLIP MAR 2021.pdf', 'On Time'),
(5, 1, 'Srushti Kishor Wajge', 'Artificial', 4, '2021-04-28', 4, '../teacher/Assignment_Submitted/PAYSLIP MAR 2021.pdf', 'Late');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `submission_date` date NOT NULL,
  `imagepath` varchar(500) NOT NULL,
  `blogtext` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `email`, `author`, `submission_date`, `imagepath`, `blogtext`) VALUES
(4, 'srushti@gmail.com', 'Srushti Kishor Wajge', '2021-04-16', 'blogs/images/taylorig1440_900.png', 'Life throws curveballs And while there might be blockers to success its imperative to keep pushing with the knowledge mistakes will be made and failure is inevitable'),
(5, 'srushti@gmail.com', 'Srushti Kishor Wajge', '2021-04-16', 'blogs/images/46910965-3d-wallpaper-hd.jpg', 'Life throws curveballs. And while there might be blockers to success, its imperative to keep pushing with the knowledge mistakes will be made and failure is inevitable.'),
(6, 'nidhi@gmail.com', 'Nidhi Goda', '2021-04-25', 'blogs/images/ph-10008.jpg', 'ASsASDadADadaSDasd');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_Id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `link` varchar(100) NOT NULL,
  `feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_Id`, `title`, `link`, `feedback_date`) VALUES
(1, 'CC Seminar on 2021-04-30', 'https://docs.google.com/forms/d/e/1FAIpQLSeI8_vYyaJgM7SJM4Y9AWfLq-tglWZh6yt7bEXEOJr_L-hV1A/viewform?', '2021-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `final_result`
--

CREATE TABLE `final_result` (
  `id` int(11) NOT NULL,
  `stud_prn` varchar(20) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `year` varchar(10) NOT NULL,
  `dept` varchar(10) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `final_result`
--

INSERT INTO `final_result` (`id`, `stud_prn`, `subject`, `year`, `dept`, `sem`, `marks`) VALUES
(6, '12345', 'Cloud', 'BE', 'COMP', 'sem2', 100),
(7, '123456', 'Python', 'SE', 'IT', 'sem1', 25),
(10, '12345', 'Web', 'BE', 'COMP', 'sem2', 60),
(11, '71785633F', 'Cloud', 'BE', 'COMP', 'sem1', 80),
(12, '71785633F', 'Artificial', 'BE', 'COMP', 'sem1', 70),
(13, '71611203F', 'Cloud', 'BE', 'COMP', 'sem1', 90),
(14, '71611203F', 'Artificial', 'BE', 'COMP', 'sem1', 80),
(15, '71985633F', 'Python', 'SE', 'IT', 'sem1', 90),
(16, '71611222F', 'DELD', 'SE', 'COMP', 'sem1', 80),
(17, '71784633F', 'Python', 'SE', 'IT', 'sem1', 60),
(18, '71785613F', '', 'BE', 'COMP', 'sem1', 55);

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
('Savitribai Phule Pune University, Online Result.pdf', 4, 'DBMS', 'Srushti@g.com'),
('Spring-Professional-Certification-Study-Guide.pdf', 1, 'Cloud', 'krutishilp@gmail.com');

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
('1', 'WEBTECH_123', 'What is Web?', 'asd', 'ase', 'qwe', 'erf', 'op1', 'Web'),
('1', '123', 'what is database management system?', 'as', 'asa', 'asasa', 'asasas', 'op2', 'DBMS'),
('1', '123456', 'kkkk', 'k', 'cc', 'l', 'l', 'op1', 'Cloud'),
('2', '123456', 'ssss', 'a', 'w', 's', 's', 'op2', 'Cloud'),
('1', '1234', 'asd', 'dsa', 'sdasd', 'asdsa', 'asas', 'op1', 'Cloud');

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
(2, 'WEB TECH', 'WEBTECH_123', '20', 1, 'Web', 25),
(3, 'DBMS', '123', '30', 0, 'DBMS', 22),
(4, 'Cloud', '123456', '20', 0, 'Cloud', 25),
(5, 'CLOUD1', '1234', '10', 0, 'Cloud', 25);

-- --------------------------------------------------------

--
-- Table structure for table `qwise_assesment`
--

CREATE TABLE `qwise_assesment` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `uans` varchar(255) NOT NULL,
  `pt` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qwise_assesment`
--

INSERT INTO `qwise_assesment` (`id`, `email`, `exam_id`, `question_id`, `uans`, `pt`) VALUES
(1, 'rajp@gmail.com', 'PY', 'PYQ-1', 'op1', 1),
(2, 'rajp@gmail.com', 'PY', 'PYQ-2', 'op2', 1),
(3, 'rajp@gmail.com', 'PY', 'PYQ-3', 'op3', 1),
(4, 'rajp@gmail.com', 'PY', 'PYQ-4', 'op4', 1),
(5, 'rajp@gmail.com', 'PY', 'PYQ-5', 'op1', 1),
(6, 'd@r', '12', '1', 'op3', 0),
(7, 'd@r', '12', '2', 'op2', 0),
(8, 'd@r', '123', '1', 'op4', 0),
(9, 'd@r', '123', '2', 'op3', 0),
(10, 'Srushti@g.com', '12345', '1', 'op4', 0),
(11, 'Srushti@g.com', '123451212', '1', 'op4', 1),
(12, 'srushti@gmail.com', '12345', '1', 'op1', 0),
(13, 'srushti@gmail.com', '12345', '2', 'op1', 1),
(14, 'srushti@gmail.com', 'WEBTECH_123', '1', 'op1', 1),
(15, 'srushti@gmail.com', '123', '1', 'op2', 1),
(16, 'test@test.com', '123456', '1', 'op2', 0),
(17, 'test@test.com', '123456', '2', 'op2', 1),
(24, 'srushti@gmail.com', '123456', '1', 'op2', 0),
(25, 'srushti@gmail.com', '123456', '2', 'op2', 1),
(26, 'nidhi@gmail.com', '123456', '1', 'op1', 1),
(27, 'nidhi@gmail.com', '123456', '2', '', 0);

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
-- Table structure for table `seminar`
--

CREATE TABLE `seminar` (
  `seminar_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `notice` varchar(500) DEFAULT NULL,
  `seminar_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`seminar_id`, `title`, `notice`, `seminar_date`) VALUES
(3, 'Seminar on CC by AMAZON', '../seminar/CC QB.pdf', '2021-04-30'),
(4, 'xyz', '../seminar/Pd.pdf', '2021-06-30');

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
(1, 'Srushti Kishor Wajge', 'srushti@gmail.com', '71611203F', 'BE', 'comp', '12345'),
(2, 'Krutishil Purkar', 'test@test.com', '12345', 'BE', 'comp', '12345'),
(3, 'Nidhi Goda', 'nidhi@gmail.com', '71785633F', 'BE', 'COMP', 'Nidhi123'),
(4, 'Ram', 'ram@gmail.com', '123456', 'SE', 'IT', 'ram@123'),
(7, 'Lokesh Bhavsar', 'lokesh@gmail.com', '71785602F', 'BE', 'COMP', 'Lokesh123'),
(8, 'Sunil Datir', 'sunil@gmail.com', '71785613F', 'BE', 'COMP', 'Sunil123'),
(9, 'Student XYZ', 'student@gmail.com', '71785623F', 'BE', 'COMP', 'Student123'),
(10, 'Prasad Kasar', 'prasad@gmail.com', '71985633F', 'SE', 'IT', 'Prasad123'),
(11, 'Jatin Dalal', 'jatin@gmail.com', '71611222F', 'SE', 'COMP', 'Jatin123'),
(12, 'Rohit Dhurjad', 'rohit@gmail.com', '71784633F', 'SE', 'IT', 'Rohit123');

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
(4, 'Cloud', 'BE', 'COMP', 8),
(5, 'Artificial', 'BE', 'COMP', 8),
(6, 'Web', 'TE', 'COMP', 6),
(7, 'TOC', 'TE', 'COMP', 5),
(8, 'DELD', 'SE', 'COMP', 3),
(9, 'AI', 'SE', 'IT', 8);

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
(22, 'shinde@gmail.com', 'Priti Shinde', 'DBMS', 2, '6051f69b0b347'),
(25, 'talekar@gmail.com', 'Sopan Talekar', 'Cloud', 2, '12345'),
(26, 'talekar@gmail.com', 'Sopan Talekar', 'Artificial', 2, '60786b0dcdc2e'),
(28, 'priti@gmail.com', 'Priti Shinde', 'DSF', 1, 'Priti123');

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
('VID-20190718-WA0000.mp4', 'DBMS', 3, 0, 0, 'Srushti@g.com', 0),
('VID-20190718-WA0000.mp4', 'Cloud', 2, 0, 0, 'talekar@gmail.com', 0),
('VID-20191209-WA0048.mp4', 'Cloud', 2, 0, 0, 'talekar@gmail.com', 0);

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
-- Indexes for table `assessment_records`
--
ALTER TABLE `assessment_records`
  ADD PRIMARY KEY (`assessment_id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`Assignment_No`);

--
-- Indexes for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  ADD PRIMARY KEY (`submission_Id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_Id`);

--
-- Indexes for table `final_result`
--
ALTER TABLE `final_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`quizz_id`);

--
-- Indexes for table `qwise_assesment`
--
ALTER TABLE `qwise_assesment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seminar`
--
ALTER TABLE `seminar`
  ADD PRIMARY KEY (`seminar_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_Id`),
  ADD UNIQUE KEY `student_email` (`email`),
  ADD UNIQUE KEY `student_prn` (`prn`),
  ADD UNIQUE KEY `prn` (`prn`);

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
-- AUTO_INCREMENT for table `assessment_records`
--
ALTER TABLE `assessment_records`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `Assignment_No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assignment_submission`
--
ALTER TABLE `assignment_submission`
  MODIFY `submission_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `final_result`
--
ALTER TABLE `final_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `quizz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `qwise_assesment`
--
ALTER TABLE `qwise_assesment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `seminar`
--
ALTER TABLE `seminar`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
