-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2021 at 01:40 PM
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
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessment_records`
--

INSERT INTO `assessment_records` (`email`, `exam_id`, `score`, `status`) VALUES
('d@r', 'PY', '0', 1),
('d@r', '12', '0', 1),
('d@r', '123', '0', 1),
('Srushti@g.com', '12345', '0', 1),
('Srushti@g.com', '123451212', '100', 1);

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
('DSF-1', 'DSF', 'The computing time of OBST is                   ', '2n', 'n2', 'logn', 'none of these', 'op2\r', ''),
('DSF-12', 'DSF', 'Total number of records divided total number of records in hashing denotes-------------', 'loading factor', 'balance factor', 'size of hashing', 'none of these', 'op4\r', ''),
('DSF-13', 'DSF', 'Folding is a method of                     ', 'index function for t', 'a hash function', 'chaining', 'none of these', 'op2\r', ''),
('DSF-14', 'DSF', 'Transferring the contents from old hash table to new hash table is required when', 'double hashing', 'quadratic probi', 'linear probing', 'rehashing', 'op4\r', ''),
('DSF-15', 'DSF', 'Space gets doubled in following technique---------------', 'double hashing', 'quadratic probi', 'linear probing', 'rehashing', 'op4\r', ''),
('DSF-16', 'DSF', 'Following hashing technique is preferred when huge amount of data is available', 'extensible hashing', 'quadratic probi', 'linear probing', 'rehashing', 'op1\r', ''),
('DSF-17', 'DSF', '\"What will be the position of the number 2131 in a hash table', ' when the mid square method is a\"', '131', '499', '169', '411', 'op3\r'),
('DSF-18', 'DSF', 'The technique of linear probing can lead to--------------', 'radix sort', 'clustering', 'efficient storag', 'overflow', 'op2\r', ''),
('DSF-19', 'DSF', 'A good hashing function must have                                  ', 'minimize collisions', 'easy and quick', 'distribute the ke', 'all of the above', 'op4\r', ''),
('DSF-2', 'DSF', 'In optimal binary searchtree the optimum cost depends upon', 'probability of succ', 'probability of u', 'Both A and B', 'value stored in', 'op3\r', ''),
('DSF-20', 'DSF', '\"What will be the position of the number 3111 in a hash table', ' when the mid square method is a\"', '786', '11', '783', '121', 'op3\r'),
('DSF-21', 'DSF', '\"Given the input (4371', ' 1323', ' 6173', ' 4199', ' 4344', ' 9679', ' 1989} and hash function h(X)=X mod10. The number 4344 will be placed at index using quadratic probing\"'),
('DSF-22', 'DSF', '\"Consider the keys (24', '13', '16', '15', '19', '20', '22'),
('DSF-23', 'DSF', 'What is the worst-case time for serial search finding a single item in an array?', 'constant time', 'Logarithmic tim', 'Linear time', 'Quadratic time', 'op3\r', ''),
('DSF-24', 'DSF', 'What is the best definition of a collision in a hash table?', 'Two entries are ide', 'Two entries wit', 'Two entries wit', 'Two entries wit', 'op3\r', ''),
('DSF-25', 'DSF', 'A chained hash table has an array size of 512. What is the maximum number of entries that ca', '511', '512', '1024', '256', 'op2\r', ''),
('DSF-26', 'DSF', 'Suppose you place m items in a hash table with an array size of s. What is the correct formula', 's + m', 's - m', 'm / s', 'm * s', 'op3\r', ''),
('DSF-27', 'DSF', 'Sequential search require                  comparisons', 'O(n^2)', 'O(logn)', 'O(n)', 'O(n^3)', 'op3\r', ''),
('DSF-28', 'DSF', 'Best case timing behaviour of searching using hashing', 'O(n)', 'O(1)', 'O(logn)', 'O(n^2)', 'op2\r', ''),
('DSF-29', 'DSF', 'Wrost case timing behaviour of searching using hashing', 'O(logn)', 'O(1)', 'O(n)', 'O(n^2)', 'op3\r', ''),
('DSF-3', 'DSF', 'Having explicit failure node is the feature of ------------------', 'Expression tree', 'Binary tree', 'binary search tr', 'Extended binar', 'op4\r', ''),
('DSF-30', 'DSF', 'Which among the following is not a open addressing strategy', 'Linear Probing', 'Double Hashin', 'Multiplicative', 'None of above', 'op3\r', ''),
('DSF-31', 'DSF', 'Time required for rehashing is----------', 'O(logn)', 'O(n)', 'O(n2)', 'O(nlogn)', 'op2\r', ''),
('DSF-32', 'DSF', 'A hash search determines', 'Collision resolution', 'insertion of key', 'location of the', 'deletion of key', 'op3\r', ''),
('DSF-33', 'DSF', 'The set of keys that hash to the same location in the list is called as ----------', 'key', 'address', 'hash search', 'Synonyms', 'op4\r', ''),
('DSF-34', 'DSF', 'When a hashing algorithem produce an address for an insertion key and that address is already', 'Collision', 'Synonyms', 'Hash search', 'key', 'op1\r', ''),
('DSF-35', 'DSF', 'Which data structure allows deleting data elements from front and inserting at rear?', 'Stacks', 'Queues', 'Deques', 'Binary search tr', 'op2\r', ''),
('DSF-36', 'DSF', 'When key values are reals a similar data representation might be produced by using a hashing function with.', 'Mod', 'Div', 'Trunc', 'Log-N', 'op2\r', ''),
('DSF-39', 'DSF', 'An advantage of chained hash table over the open addressing scheme is', 'Worst case comple of serach operation os less', 'Space used is le', 'Deletion is easi', 'None of these', 'op3\r', ''),
('DSF-4', 'DSF', '\"Consider a hash table of size seven', ' with starting index zero and a hash function', '', '', '', '', ''),
('DSF-40', 'DSF', 'The average search time of hashing with linear probing will be less if the load factor', 'Is far less than one', 'Equals one', 'Is far greater th', 'None of these', 'op1\r', ''),
('DSF-41', 'DSF', 'A hash table has space for 100 records. What is the probability of collision before the table is', '0.45', '0.5', '0.3', '0.34', 'op1\r', ''),
('DSF-42', 'DSF', 'The minimum number of colors needed to color a graph having n (>3) vertices and 2 edges is', '4', '3', '2', '1', 'op3\r', ''),
('DSF-43', 'DSF', 'An advantage of chained hash table over the open addressing scheme is', 'Worst case comple serach operation o', 'Space used is le', 'Deletion is easi', 'None of these', 'op3\r', ''),
('DSF-44', 'DSF', 'The indirect change of the values of a variable in one module by another module is called', 'internal change', 'inter-module ch', 'side effect', 'side-module up', 'op3\r', ''),
('DSF-45', 'DSF', 'A hash function randomly distributes records one by one in a space that can hold x number of', '(x-1) (x-2)...(x-(m-', '(x-1) (x-2)...(x-', '(x-1) (x-2)...(x-', '(x-1) (x-2)...(x-', 'op1\r', ''),
('DSF-46', 'DSF', 'What is the worst-case time for serial search finding a single item in an array?', 'Constant time', 'Logarithmic ti', 'mLinear time', 'Quadratic time', 'op3\r', ''),
('DSF-47', 'DSF', 'What is the worst-case time for binary search finding a single item in an array', 'Constant time', 'Logarithmic ti', 'mLinear time', 'Quadratic time', 'op2\r', ''),
('DSF-48', 'DSF', 'Suppose you place m items in a hash table with an array size of s. What is the correct formula', 's + m', 's - m', 'm * s', 'm / s', 'op4\r', ''),
('DSF-49', 'DSF', '\"The keys 12', ' 18', ' 13', ' 2', ' 3', ' 23', ' 5 and 15 are inserted into an initially empty hash table of length\"'),
('DSF-5', 'DSF', 'In hashing a record is located using —              --.', 'index', 'key', 'function', 'fnction', 'op3\r', ''),
('DSF-50', 'DSF', '\"The keys are Supriya', ' Shivraj', ' Divyanand', ' Vaishali', ' Anuja', ' Shilpa', ' Avi. The hash function is l\"'),
('DSF-51', 'DSF', 'The advantage of chained hash table over open addressing scheme is               ', 'deletion is easier', 'space used is le', 'worst case com', 'none of these', 'op1\r', ''),
('DSF-52', 'DSF', 'The average search time of hashing with linear probing is less if loading factor           ', 'far greater than 1', 'far less than 1', 'equals 1', 'none of these', 'op2\r', ''),
('DSF-6', 'DSF', 'Consider a hashing function that resolves coffision by quadratic probing. Assume the address', '2', '8', '4', '5', 'op1\r', ''),
('DSF-7', 'DSF', '\"Which of the following statements are true?', '', '', '', '', '', ''),
('DSF-8', 'DSF', 'For the above hash table which slots remains unoccupied?', '5', '9', '7', '0', 'op3\r', ''),
('DSF-9', 'DSF', 'Use of pointer is in                    hashing technique', 'double hashing', 'chaining', 'quadratic probi', 'linear probing', 'op2\r', ''),
('i. 9679', ' 1989', ' 4199 hash to the same value', '', '', '', '', '', ''),
('ii. 1471', ' 6171 has to the same value', '', '', '', '', '', '', ''),
('iii. All elements hash to the same value', '', '', '', '', '', '', '', ''),
('iv. Each element hashes to a different value\"', 'only i', 'only ii', 'iii or iv', 'only ii & i', 'op4\r', '', '', ''),
('PYQ-1', 'PY', 'try1', 'a', 'b', 'c', 'd', 'op1', 'Python'),
('PYQ-2', 'PY', 'try2', 'aa', 'bb', 'cc', 'dd', 'op2', 'Python'),
('PYQ-3', 'PY', 'try3', 'aaa', 'bbb', 'ccc', 'ddd', 'op3', 'Python'),
('PYQ-4', 'PY', 'try4', 'aaaa', 'bbbb', 'cccc', 'dddd', 'op4', 'Python'),
('PYQ-5', 'PY', 'try5', 'aaaaa', 'bbbbb', 'ccccc', 'ddddd', 'op1', 'Python'),
('Use modulo (10) as your hashing function. Using the linear probing with replacement', ' place t\"', '8', '4', '1', '7', 'op1\r', '', ''),
('will be stored in the location\"', '3', '4', '5', '6', 'op3\r', '', '', ''),
('2', '12345', 'XYZ', 'x', 'y', 'z', 'No', 'op4', 'DBMS'),
('', '12345zsdasdas', '', '', '', '', '', '', 'DBMS'),
('2', '123451212', 'PQR', 'A', 'B', 'C', 'D', 'op1', 'DBMS'),
('2', '123', 'what is database management system?', 'A', 'B', 'C', 'D', 'op1', 'DBMS');

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `name` varchar(255) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`name`, `exam_id`, `duration`, `status`, `subject`) VALUES
('DSF-1', 'DSF', '40', 0, 'DSF'),
('Python Skill Test', 'PY', '30', 0, 'Python'),
('DB', '12', '10', 0, 'DBMS'),
('DB 2', '12345', '10', 0, 'DBMS'),
('DB 3', '123', '30', 0, 'DBMS'),
('DB 3', '123', '30', 0, 'DBMS'),
('DB4', '123451212', '5', 0, 'DBMS'),
('DB4', '123451212', '5', 0, 'DBMS'),
('as', '12345zsdasdas', '2', 0, 'DBMS'),
('as', '12345zsdasdas', '2', 0, 'DBMS'),
('', '', '', 0, ''),
('123', '123', '30', 0, 'DBMS'),
('123', '123', '30', 0, 'DBMS');

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
('Srushti@g.com', '123451212', '1', 'op4', 1);

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
(1, 'Srushti Kishor Wajge', 'srushti@gmail.com', '71611203F', 'be', 'comp', '12345');

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
(6, 'Web Technology', 'TE', 'COMP', 6),
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
(22, 'shewale@gmail.com', 'Shewale', 'DBMS', 2, '6051f69b0b347');

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
  MODIFY `teacher_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
