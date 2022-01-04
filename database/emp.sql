-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 09:02 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(13, 13, 'IT'),
(14, 13, 'Marketing'),
(16, 13, 'Administrator'),
(19, 13, 'SDE');

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
(21, 'sayali', 'Dalal', 'sayali@gmail.com', 'Female', '2003-12-10', '1234', 56891, '', '2147483647', 'kondhwa budruk ,pune', 'ABCDE1234D', 'Intern', '2021-12-02', 13, 13),
(24, 'simba', 'nagpal', 'simba@gmail.com', 'Male', '2001-03-08', '1234', 100000, '', '2147483612', 'kondhwa budruk,pune', 'ABCDE1234F', 'manager', '2021-12-18', 13, 14),
(82, 'abc', 'def', 'def@gmail.com', 'Male', '2001-12-06', '12345678Av', 30000, '', '1234567890', 'pune', 'ABCDE1234F', 'manager', '2021-12-05', 13, 0),
(83, 'abcd', 'abcd', 'efg@gmail.com', 'Male', '2003-12-24', '1234567890Ab', 30000, '', '1234567890', 'pune', 'ABCDE1234F', 'Manager', '2021-12-11', 13, 13),
(84, 'ABCD', 'abcd', 'efgh@gmail.com', 'Male', '2003-12-24', '1234567890Ab', 30000, '', '1234567890', 'pune', 'ABCDE1234F', 'Manager', '2021-12-11', 13, 13),
(85, 'ABCD', 'DEF', 'abc@gmail.com', 'Female', '2003-12-12', '12345678Ab', 30000, '', '2147483647', 'pune', 'ABCDE1234D', 'Manager', '2021-12-06', 21, 0);

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
  `email` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp_leave`
--

INSERT INTO `emp_leave` (`id`, `reason`, `start_date`, `last_date`, `email`, `status`) VALUES
(9, 'I got sick', '2021-07-28', '2021-07-30', 'test@gmail.com', 'Canceled'),
(15, ' drnrdng', '2021-07-09', '2021-07-11', 'emp1@emp.com', 'Accepted'),
(16, ' drnrdng', '2021-07-14', '2021-07-25', 'emp1@emp.com', 'Canceled'),
(17, ' drnrdng', '2021-07-16', '2021-07-25', 'emp1@emp.com', 'Accepted'),
(20, ' dcw', '2021-07-10', '2021-07-11', 'emp3@emp.com', 'Accepted'),
(21, ' efwe', '2021-07-23', '2021-07-25', 'emp3@emp.com', 'Canceled'),
(22, ' ewfew', '2021-07-24', '2021-07-18', 'emp3@emp.com', 'Accepted'),
(23, ' drnrdng', '2021-07-01', '2021-07-02', 'emp3@emp.com', 'Canceled'),
(24, ' i got sick', '2021-07-03', '2021-07-06', 'test@gmail.com', 'Accepted'),
(25, ' i got sick', '2021-07-04', '2021-07-07', 'test@gmail.com', 'Canceled'),
(26, ' drnrdng', '2021-07-04', '2021-07-07', 'test@gmail.com', 'Accepted'),
(27, 'Sick ', '2021-11-30', '2021-12-04', 'emp2@gmail.com', 'Canceled');

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
(13, 'Camlin', 'camlin@gmail.com', '1234', 'pune', 'Piyush patil', '2147483123', 'https://www.google.in/', '27AAPFU0939F1ZV', ''),
(15, 'Apsara', 'apsara@gmail.com', '1234', 'kondhwa,pune ', 'Piyush patil1', '2147483647', 'https://www.google.in/', '27AAPFU0939F1ZV', ''),
(16, 'Gada electronics', 'gada@gmail.com', '1234', 'kondhwa ,pune', 'Jethalal gada', '2147483647', 'https://www.gadaelectronics.in/', '27AAPFU0123F1ZV', ''),
(21, 'qwe', 'qwe@gmail.com', '12345678Abc', 'pune', 'qwrt', '1234567812', 'http://localhost/hr-management-system/superadmin/add-organization.php', '27AAPFU0123F1ZV', '');

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
(1, 'superadmin@gmail.com', '1234');

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
(1, 'superadmin@gmail.com', 'superadmin@123', 'superadmin'),
(2, 'qwe@gmail.com', '12345678Abc', 'organization'),
(6, 'abc@gmail.com', '12345678Ab', 'employee');

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `emp_leave`
--
ALTER TABLE `emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
