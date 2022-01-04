-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 10:43 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(15) NOT NULL,
  `orgid` int(15) NOT NULL,
  `deptname` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `orgid`, `deptname`) VALUES
(24, 23, 'QA'),
(25, 23, 'IT'),
(26, 23, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(15) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `password` varchar(75) NOT NULL,
  `salary` int(10) NOT NULL,
  `dp` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pancard` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `Joiningdate` date DEFAULT NULL,
  `orgid` int(15) NOT NULL,
  `depid` int(15) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `fname`, `lname`, `email`, `gender`, `dob`, `password`, `salary`, `dp`, `contact`, `address`, `pancard`, `designation`, `Joiningdate`, `orgid`, `depid`) VALUES
(86, 'RAJNISH', 'Mishra', 'rajnish.m.a.020102@gmail.com', 'Male', '2003-12-10', 'Admin@123', 65526, '', '7016855922', 'B 905 Raghuvir Symphony Bhimrad Althan road', 'AAAAB8555C', 'Demo', '2021-12-16', 22, 0),
(89, 'SURAJ', 'WARBHE', 'suraj@viit.ac.in', 'Male', '2003-12-09', 'Admin@123', 4589565, '61addb01707087.99920751logo.jpg', '8956556555', 'Pune', 'LPAAB8555C', 'Trainee', '2021-12-02', 23, 26),
(90, 'SAYALI', 'DALAL', 'sayali@viit.ac.in', 'Female', '2003-12-03', 'Admin@123', 5655980, '', '6789456123', 'Pune', 'AAAAB8555C', 'Designer', '2021-02-11', 23, 25),
(91, 'SAEE', 'WADEKAR', 'saee@viit.ac.in', 'Female', '2003-12-24', 'Admin@123', 3655850, '', '6789456123', 'Pune', 'BWQAB8555C', 'Student', '2021-12-02', 23, 26),
(92, 'RAJNISH', 'MISHRA', 'rajnishkumar.21910644@viit.ac.in', 'Male', '2003-12-04', 'Admin@123', 5658845, '', '7016855922', 'B 905 Raghuvir Symphony Bhimrad Althan road', 'EBAAA8555C', 'Intern', '2021-12-01', 23, 24);

--
-- Triggers `employee`
--
DELIMITER $$
CREATE TRIGGER `Mysqltrigger` BEFORE INSERT ON `employee` FOR EACH ROW SET NEW.fname = UPPER(NEW.fname)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Mysqltriggerlname` BEFORE INSERT ON `employee` FOR EACH ROW SET NEW.lname = UPPER(NEW.lname)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_empleave_after_delete` AFTER DELETE ON `employee` FOR EACH ROW DELETE FROM emp_leave WHERE email = old.email
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_trigger_employee` AFTER DELETE ON `employee` FOR EACH ROW DELETE FROM user WHERE email = old.email
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_trigger_employee` AFTER UPDATE ON `employee` FOR EACH ROW UPDATE user SET email=NEW.email , password= NEW.password WHERE email = old.email
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `emptrigger_after_insert` AFTER INSERT ON `employee` FOR EACH ROW INSERT INTO user (email , password , role ) VALUES (NEW.email , NEW.password , 'employee')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave`
--

CREATE TABLE `emp_leave` (
  `id` int(11) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `start_date` varchar(24) NOT NULL,
  `last_date` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`id`, `reason`, `start_date`, `last_date`, `email`, `status`) VALUES
(32, ' Sick', '2021-12-06', '2021-12-08', 'saee@viit.ac.in', 'Accepted'),
(33, ' Vacation', '2021-12-08', '2021-12-13', 'sayali@viit.ac.in', 'pending'),
(35, ' Vacation 1st Dose', '2021-12-05', '2021-12-06', 'suraj@viit.ac.in', 'Accepted'),
(41, ' Vaccination 2nd Dose', '2021-12-15', '2021-12-16', 'rajnishkumar.21910644@viit.ac.in', 'Accepted'),
(42, ' Casual Leave', '2021-12-29', '2022-01-02', 'rajnishkumar.21910644@viit.ac.in', 'Accepted'),
(43, ' Casual Leave', '2021-12-07', '2021-12-08', 'suraj@viit.ac.in', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(15) NOT NULL,
  `orgname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(75) NOT NULL,
  `address` varchar(255) NOT NULL,
  `employername` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `website` varchar(255) NOT NULL,
  `gstno` varchar(20) NOT NULL,
  `dp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `orgname`, `email`, `password`, `address`, `employername`, `contact`, `website`, `gstno`, `dp`) VALUES
(22, 'Google', 'google@gmail.com', 'Admin@123', 'California Street', 'Rajnish Mishra', '7016855922', 'http://localhost/hr-management-system/superadmin/add-organization.php', '27AAPFU0123F1ZV', ''),
(23, 'Vishwakarma Intitute of Information Technology, pune', 'admin@viit.ac.in', 'Admin@123', 'Kondhwa, Pune', 'Rajnish Mishra', '8956556555', 'http://www.viit.ac.in', '52BBPFU0123F1ZV', ''),
(24, 'Accenture', 'admin@accenture.com', 'Admin@123', 'Washington Dc', 'Mukesh Shah', '6789456123', 'http://localhost/hr-management-system/superadmin/add-organization.php', '89BBHFU0123F1ZV', '');

--
-- Triggers `organization`
--
DELIMITER $$
CREATE TRIGGER `delete_trigger` AFTER DELETE ON `organization` FOR EACH ROW DELETE FROM user WHERE email = old.email
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `edit_trigger` AFTER UPDATE ON `organization` FOR EACH ROW UPDATE user SET email=NEW.email , password=NEW.password WHERE email = old.email
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `orgtrigger_after_insert` AFTER INSERT ON `organization` FOR EACH ROW INSERT INTO user (email , password , role ) VALUES (NEW.email , NEW.password , 'organization')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` int(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `email`, `password`) VALUES
(1, 'superadmin@organisation', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(75) NOT NULL,
  `role` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(7, 'superadmin@organisation', 'Admin@123', 'superadmin'),
(8, 'google@gmail.com', 'Admin@123', 'organization'),
(9, 'rajnish.m.a.020102@gmail.com', 'Admin@123', 'employee'),
(10, 'admin@viit.ac.in', 'Admin@123', 'organization'),
(11, 'admin@accenture.com', 'Admin@123', 'organization'),
(13, 'rajnish..020102@gmail.com', 'Admin@123', 'employee'),
(15, 'suraj@viit.ac.in', 'Admin@123', 'employee'),
(16, 'sayali@viit.ac.in', 'Admin@123', 'employee'),
(17, 'saee@viit.ac.in', 'Admin@123', 'employee'),
(18, 'rajnishkumar.21910644@viit.ac.in', 'Admin@123', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deptname` (`deptname`),
  ADD KEY `org_id_foreign` (`orgid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orgid` (`orgid`);

--
-- Indexes for table `emp_leave`
--
ALTER TABLE `emp_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orgname` (`orgname`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `org_id_foreign` FOREIGN KEY (`orgid`) REFERENCES `organization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `orgid` FOREIGN KEY (`orgid`) REFERENCES `organization` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
