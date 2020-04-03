-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2020 at 07:30 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csa_msg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `max_cnt` int(11) NOT NULL DEFAULT '200'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `max_cnt`) VALUES
(1, 'admin', 'admin@admin.com', 'e807f1fcf82d132f9bb018ca6738a19f', 50);

-- --------------------------------------------------------

--
-- Table structure for table `deleteduser`
--

CREATE TABLE `deleteduser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `deltime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleteduser`
--

INSERT INTO `deleteduser` (`id`, `email`, `deltime`) VALUES
(1, '2', '2020-04-02 02:07:14');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `feedbackdata` varchar(500) NOT NULL,
  `attachment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `sender`, `reciver`, `title`, `feedbackdata`, `attachment`) VALUES
(19, 'test0@test.com', 'Admin', 'welcome', 'This is welcome message', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group` varchar(50) CHARACTER SET latin1 NOT NULL,
  `title` varchar(200) CHARACTER SET latin1 NOT NULL,
  `content` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `group`, `title`, `content`) VALUES
(1, 21, 'Adult', 'ASDF', 'ASDFASDF'),
(2, 21, 'Adult', 'SADF', 'ASDFASFD'),
(3, 21, 'Adult', 'web test', 'web sending message'),
(4, 21, 'Adult', 'web test', 'sdfasdf'),
(5, 21, 'Adult', 'test', 'This is test message'),
(6, 21, 'Adult', 'Web test', 'This is web test'),
(7, 21, 'Adult', 'web test', 'This is web test'),
(8, 21, 'Adult', 'Web test', 'This is web test'),
(9, 21, 'Adult', 'Web Test', 'This is web test'),
(10, 21, 'Adult', 'web test', 'this is web test'),
(11, 21, 'Adult', 'web test', 'this is web test'),
(12, 21, 'Middle School', 'web test', 'this is web test'),
(13, 21, 'Adult', 'Web Test', 'This is web test message'),
(14, 21, 'Academy/Select', 'Welcome', 'This is first message from Adult group'),
(15, 21, 'Academy/Select', 'Welcome', 'Welcome to Academy/Select Group.\r\nYou can receive the news from Academy/Select Group in real-time.'),
(16, 21, 'Academy/Select', 'Welcome', 'Welcome to Academy/Select group.\r\nThanks'),
(17, 21, 'Academy/Select', 'Welcome', 'Welcome to Academy/Select Group.\r\nThanks'),
(18, 21, 'Adult', 'Welcome', 'Welcome to Adult group.\r\nThanks'),
(19, 21, 'Adult', 'Welocme', 'This is test message'),
(20, 21, 'Adult', 'Welcome', 'this is welcome message'),
(21, 21, 'Adult', 'Welcome', 'This is welcome message from Adult'),
(22, 21, 'Adult', 'Welcome', 'This is test'),
(23, 21, 'Adult', 'welcome', 'This is test'),
(24, 21, 'Adult', 'welcome', 'This is test'),
(25, 21, 'Adult', 'Hi', 'This is test'),
(26, 21, 'Adult', 'Hi', 'Test message'),
(27, 21, 'Adult', 'Test', 'This is test message from CPA'),
(28, 21, 'Adult', 'Test2', 'This is test message from CPA'),
(29, 21, 'Adult', 'Test3', 'This is test message from CPA'),
(30, 21, 'Adult', 'test4', 'This is test message from CPA'),
(31, 21, 'Adult', 'Test5', 'This is test message from CPA'),
(32, 21, 'Adult', 'Test6', 'This is test message from CPA'),
(33, 21, 'Adult', 'test1', 'This is test message'),
(34, 21, 'Academy/Select', 'test2', 'This is test message'),
(35, 21, 'Academy/Select', 'test4', 'test4 message'),
(36, 21, 'Academy/Select', 'test5', 'this is test5'),
(37, 21, 'Academy/Select', 'test1', 'This is test'),
(38, 21, 'Academy/Select', 'test2', 'This is test');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notiuser` varchar(50) NOT NULL,
  `notireciver` varchar(50) NOT NULL,
  `notitype` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notiuser`, `notireciver`, `notitype`, `time`) VALUES
(18, 'test0@test.com', 'Admin', 'Create Account', '2020-03-30 16:33:56'),
(19, 'test0@test.com', 'Admin', 'Send Feedback', '2020-03-30 16:42:20'),
(20, 'test1@test.com', 'Admin', 'Create Account', '2020-03-30 18:27:57'),
(21, 'test1@test.com', 'Admin', 'Create Account', '2020-03-30 18:47:27'),
(22, 'test2@test.com', 'Admin', 'Create Account', '2020-03-31 19:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `mobile`, `designation`, `image`, `status`) VALUES
(20, 'test0', 'test0@test.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '1234567890', '1234567890', '', 0),
(21, 'test1', 'test1@test.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '1234567890', '123', 'general_user.jpg', 1),
(22, 'test2', 'test2@test.com', 'e807f1fcf82d132f9bb018ca6738a19f', 'Male', '123456', '1234', 'general_user.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deleteduser`
--
ALTER TABLE `deleteduser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deleteduser`
--
ALTER TABLE `deleteduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
