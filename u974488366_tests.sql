-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2019 at 05:09 PM
-- Server version: 10.2.27-MariaDB
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_tests`
--

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(10) UNSIGNED NOT NULL,
  `test_title` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_summary` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_img` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_body` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `test_author` int(10) DEFAULT NULL,
  `test_time` datetime(6) DEFAULT NULL,
  `test_update_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `test_slug` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `test_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_title`, `test_summary`, `test_img`, `test_body`, `test_author`, `test_time`, `test_update_time`, `test_slug`, `test_status`) VALUES
(178, 'Mathematics test ( for demo )', 'this is the demo test for mathematics  ', NULL, '<p>This test contains 20 questions ( MCQs ) for demo purpose only..<br></p>', 24, '2019-11-08 01:19:35.000000', '2019-11-07 19:51:14', 'mathematics-test-for-demo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test_que`
--

CREATE TABLE `test_que` (
  `que_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `qno` int(11) NOT NULL,
  `que_title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `que_desc` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `a` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `b` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `c` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `d` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ans` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `expl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_que`
--

INSERT INTO `test_que` (`que_id`, `test_id`, `qno`, `que_title`, `que_desc`, `a`, `b`, `c`, `d`, `ans`, `expl`, `type`) VALUES
(1, 178, 1, '2<sup>8</sup> will be__', '', '16', '256 ', '128', '64', 'b', 'For simplicity we can split these powers as<br>(2×2×2) (2×2×2) ( 2×2.) = (8)(8)(4)= 64×4 =256 Ans', ''),
(2, 178, 2, '14 persons can complete a work in 16 days, 8 persons started the work 12 days after they stsrted the work, 8 more peoples joined them. How many days will they take to complete thr remaining work', 'This Question is based on work and time problems ', '12', '8', '9', '5', 'b', '14 persons complete in 16days = 1 work, =>8 persons complete in 12 days = (1x8)/14 x 12/16 = 3/7 , =>remaining work = 1- 3/7 = 4/7 and total no. of persons = 8+8 , 14 persons do 1 work in =16 day, 16  persons do 4/7 work in  = 16 x14 /16 x 4/7 = 8 days Ans.', ''),
(3, 178, 3, 'A train running at 90 km/hr crosses a pole in 10 seconds. What is the length of train?', 'Time and distance based problem', '250 m', '150 m', '900 m', 'none of these', 'a', 'speed of train = Length of train / time taken to cross', ''),
(4, 178, 4, 'When a 192 meter long rod is cut down into small pieces of length 3.2 meter each. Then how many pieces are available?', 'Unitary Method', '52', '68', '60', '58', 'c', 'required no. of pieces = 192/3.2 = 60', ''),
(5, 178, 5, 'The ratio between the present age of Sudhir and Madan is 4:5 , if after five years the ratio of their age becomes 5 : 6, what is the present age of Sudhir?', 'Problem based on ages', '18 years', '20 years', '22 years', '21 years', 'b', '', ''),
(6, 178, 6, 'The sum of three consecutive odd numbers is 20 more than the first number of these. What is the middle number?', 'Problems based on numbers', '7', '8', '12', '9', 'd', '', ''),
(7, 178, 7, 'If one-third of a number is 10 more than one fourth of the same number, what is 60% of that number?', 'Problems based on numbers', '144', '24', '18', '72', 'd', '', ''),
(8, 178, 8, 'If the length and breadth of a rectangular plot are increased by 50% and 20% respectively, how many times will be the new area of the old area?', 'Area ', '1 and 4/5', '2', '3 and 2/5', '5 and 1/5', 'a', '', ''),
(9, 178, 9, 'A rectangular plot is 50m long and 20 m broad. Inside it there is a path of 7 m wide all round it. What is the area of the path?', 'Area ', '216 sq. m', '1000 sq.m', '1216 sq. m', '784 sq. m', 'd', '', ''),
(10, 178, 10, 'Find the compound interest of Rs. 10,000 in 9 months at 4% per annum interest payable quarterly.', 'Compound interest', 'Rs. 300', 'Rs. 310 ', 'Rs 303', 'Rs 303.01', 'd', '', ''),
(11, 178, 11, 'Find out the ratio whose value is 2/3 and the antecedent  is 18', 'Ratio and compound ratio', '18:27', '02:03', '20:30', '180:270', 'a', 'The two quantties compared in a ratio is called its items. The first term is called antecedent, the second the consequent.', '');

-- --------------------------------------------------------

--
-- Table structure for table `test_report_que`
--

CREATE TABLE `test_report_que` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `que_id` int(11) NOT NULL,
  `reason` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_responses`
--

CREATE TABLE `test_responses` (
  `resp_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `roll_no` int(6) NOT NULL,
  `test_id` int(11) NOT NULL,
  `que_id` int(11) NOT NULL,
  `response` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `true_option` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` int(11) NOT NULL,
  `user_ip` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_responses`
--

INSERT INTO `test_responses` (`resp_id`, `uid`, `roll_no`, `test_id`, `que_id`, `response`, `true_option`, `session_id`, `user_ip`) VALUES
(1, 24, 24, 178, 1, 'b', 'a', 1, '1c3d73329ce3bffa715cbebd334e97d5');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `result_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `roll_no` int(6) NOT NULL,
  `test_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `answered` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `incorrect` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `test_time` datetime NOT NULL DEFAULT current_timestamp(),
  `session_id` int(11) NOT NULL,
  `user_ip` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`result_id`, `uid`, `roll_no`, `test_id`, `total_questions`, `answered`, `correct`, `incorrect`, `marks`, `test_time`, `session_id`, `user_ip`, `name`) VALUES
(27, 23, 23, 178, 40, 7, 2, 5, 2, '2019-11-08 11:54:16', 603, '2e3def288f6d05893fb4aeeb67f8c6bc', 'Anonymus'),
(28, 24, 24, 178, 1, 1, 0, 1, 0, '2019-11-08 14:11:24', 1, '1c3d73329ce3bffa715cbebd334e97d5', 'Prakash Chandra');

-- --------------------------------------------------------

--
-- Table structure for table `test_session`
--

CREATE TABLE `test_session` (
  `session_id` int(9) UNSIGNED NOT NULL,
  `name` varchar(256) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `test_session`
--

INSERT INTO `test_session` (`session_id`, `name`) VALUES
(1, 'Prakash Chandra');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(6) UNSIGNED NOT NULL,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `user_name`, `name`, `email`, `pass`, `user_role`) VALUES
(23, 'anonymus', 'Anonymus', '', '25d55ad283aa400af464c76d713c07ad', 'student'),
(24, 'prakash_chandra', 'Prakash Chandra', '', 'db3a1377a3af33ec74d8d520eaafc3b8', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`) USING BTREE;

--
-- Indexes for table `test_que`
--
ALTER TABLE `test_que`
  ADD PRIMARY KEY (`que_id`);

--
-- Indexes for table `test_report_que`
--
ALTER TABLE `test_report_que`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_responses`
--
ALTER TABLE `test_responses`
  ADD PRIMARY KEY (`resp_id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `test_session`
--
ALTER TABLE `test_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `test_que`
--
ALTER TABLE `test_que`
  MODIFY `que_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `test_report_que`
--
ALTER TABLE `test_report_que`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_responses`
--
ALTER TABLE `test_responses`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `test_session`
--
ALTER TABLE `test_session`
  MODIFY `session_id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
