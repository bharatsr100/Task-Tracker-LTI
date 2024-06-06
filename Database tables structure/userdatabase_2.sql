-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 12:21 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES
('bharatsr100@gmail.com', '1ff0e903eb92d3fd3f6ca032ea817a946d6499558f', '2023-11-25 09:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `task_steps`
--

CREATE TABLE `task_steps` (
  `tsequenceid` int(3) NOT NULL,
  `tstepdescription` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_steps`
--

INSERT INTO `task_steps` (`tsequenceid`, `tstepdescription`) VALUES
(21, 'Kickoff'),
(31, 'Requirement Gathering'),
(41, 'Requirement Analysis'),
(51, 'Estimation'),
(61, 'Approval Step'),
(71, 'Functional Specification (FSR)'),
(81, 'Functional Design (FSD)'),
(91, 'Technical Design (TSD)'),
(101, 'Code'),
(111, 'Code Review'),
(121, 'Technical Testing'),
(131, 'Unit Testing (UT)'),
(141, 'Integration Testing (TIN)'),
(151, 'User Acceptance Testing (UAT)'),
(161, 'Non Regression Testing (NRT)'),
(171, 'Cut Over'),
(181, 'Go Live'),
(191, 'Hypercare'),
(201, 'Bug Fix'),
(211, 'Closure'),
(221, 'Peer Review'),
(231, 'Manager Review'),
(241, 'Demo'),
(251, 'Live Demo'),
(261, 'Report Submission');

-- --------------------------------------------------------

--
-- Table structure for table `task_types`
--

CREATE TABLE `task_types` (
  `ttype` int(3) NOT NULL,
  `ttype_desc` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_types`
--

INSERT INTO `task_types` (`ttype`, `ttype_desc`) VALUES
(0, 'Select Task Type'),
(1, 'Change Request'),
(2, 'Bug Fix'),
(3, 'New Development'),
(4, 'Analysis'),
(5, 'Test Type5'),
(6, 'Project Review');

-- --------------------------------------------------------

--
-- Table structure for table `tdependency`
--

CREATE TABLE `tdependency` (
  `tguid` varchar(70) NOT NULL,
  `tsequenceid` varchar(70) NOT NULL,
  `dtguid` varchar(70) NOT NULL,
  `dtsequenceid` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tstatus`
--

CREATE TABLE `tstatus` (
  `tguid` varchar(70) NOT NULL,
  `tsequenceid` int(3) NOT NULL,
  `updatedon` date NOT NULL,
  `updatedat` time NOT NULL,
  `updatedby` varchar(70) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tstatus`
--

INSERT INTO `tstatus` (`tguid`, `tsequenceid`, `updatedon`, `updatedat`, `updatedby`, `comment`) VALUES
('202107270149200005375', 0, '2021-07-27', '01:20:49', '202106140120550005107', 'Sample Comment @ 1:20pm'),
('202107270149200005375', 101, '2021-10-30', '08:41:31', '202106140120550005107', ''),
('202107270149200005375', 101, '2021-10-30', '08:41:31', '202106140120550005107', 'Task Phase Changed to: Awaiting '),
('202107270149200005375', 121, '2021-07-30', '12:03:21', '202106140120550005107', ''),
('202107270244330003880', 221, '2021-07-27', '14:35:38', '202106140120550005107', 'Assigned to: Sheik '),
('202107270244330003880', 221, '2021-07-27', '14:35:38', '202106140120550005107', 'Sample Comment 2:35'),
('202107270244330003880', 221, '2021-07-27', '14:35:38', '202106140120550005107', 'Task Phase Changed to: On Hold '),
('202107271047280003336', 0, '2021-07-27', '10:28:47', '202106140120550005107', 'Sample Comment @10:28'),
('202107271047280003336', 41, '2021-07-27', '10:30:08', '202106140120550005107', ''),
('202107271047280003336', 41, '2021-07-27', '10:30:08', '202106140120550005107', 'Task Phase Changed to: In Progress (Start) '),
('202107271047280003336', 41, '2021-07-27', '10:30:23', '202106140120550005107', ''),
('202107271240330007785', 0, '2021-07-27', '12:33:40', '202106140120550005107', 'Start working on ppt'),
('202107271240330007785', 221, '2021-07-27', '12:39:11', '202106140120550005107', 'Assigned to: Sheik '),
('202107271240330007785', 221, '2021-07-27', '12:39:11', '202106140120550005107', 'Forwarded to Sheik'),
('202107271240330007785', 221, '2021-07-27', '12:39:11', '202106140120550005107', 'Task Phase Changed to: On Hold '),
('202107271240330007785', 231, '2021-07-27', '12:52:56', '202107260918100005529', ''),
('202107271240330007785', 231, '2021-07-27', '12:52:56', '202107260918100005529', 'Assigned to: Pradyumna '),
('202107281247200001306', 31, '2021-07-28', '00:21:01', '202107260918100005529', ''),
('202107281247200001306', 31, '2021-07-28', '00:21:01', '202107260918100005529', 'Assigned to: Sheik '),
('202107301142440001829', 0, '2021-07-30', '11:44:42', '202106140120550005107', 'Sample Comment @11:44'),
('202107301142440001829', 221, '2021-07-30', '11:48:17', '202106140120550005107', ''),
('202107301142440001829', 221, '2021-07-30', '11:48:17', '202106140120550005107', 'Assigned to: Sheik '),
('202107301142440001829', 231, '2021-07-30', '11:48:30', '202106140120550005107', ''),
('202107301142440001829', 231, '2021-07-30', '11:48:30', '202106140120550005107', 'Assigned to: Pradyumna '),
('202107301142440001829', 251, '2021-07-30', '11:50:01', '202106140120550005107', 'Sample Comment @11:49'),
('202107301142440001829', 251, '2021-07-30', '11:50:01', '202106140120550005107', 'Task Phase Changed to:  '),
('202107301255290001710', 0, '2021-07-30', '12:29:55', '202106140120550005107', 'Comment @12:29PM'),
('202107301255290001710', 221, '2021-07-30', '12:35:49', '202106140120550005107', 'Assigned to: Sheik '),
('202107301255290001710', 221, '2021-07-30', '12:35:49', '202106140120550005107', 'Forwarded to Sheik'),
('202107301255290001710', 231, '2021-07-30', '12:36:32', '202106140120550005107', 'Assigned to: Pradyumna '),
('202107301255290001710', 231, '2021-07-30', '12:36:32', '202106140120550005107', 'SAmple Comment @12:36'),
('202107301255290001710', 251, '2021-07-30', '12:39:00', '202106140120550005107', ''),
('202107301255290001710', 251, '2021-07-30', '12:39:00', '202106140120550005107', 'Task Phase Changed to:  '),
('202110300805360009470', 0, '2021-10-30', '08:36:05', '202106140120550005107', 'Sample Comment @8:35'),
('202110300805360009470', 221, '2021-10-30', '08:38:39', '202106140120550005107', 'Assigned to: Yogesh '),
('202110300805360009470', 221, '2021-10-30', '08:38:39', '202106140120550005107', 'Delegated to Yogesh @8:38'),
('202110300805360009470', 231, '2021-10-30', '08:39:27', '202106140120550005107', 'Assigned to: Pradyumna '),
('202110300805360009470', 231, '2021-10-30', '08:39:27', '202106140120550005107', 'Task Phase Changed to: In Progress (Start) '),
('202110300805360009470', 231, '2021-10-30', '08:39:27', '202106140120550005107', 'Task started and forwarded to Pradyumna'),
('202110300805360009470', 241, '2021-10-30', '08:42:36', '202106140120550005107', ''),
('202110300805360009470', 241, '2021-10-30', '08:42:36', '202106140120550005107', 'Task Phase Changed to:  '),
('202110300949140007883', 0, '2021-10-30', '09:14:49', '202106140120550005107', 'Sample Comment @9:14'),
('202110300949140007883', 221, '2021-10-30', '09:17:03', '202106140120550005107', ''),
('202110300949140007883', 221, '2021-10-30', '09:17:03', '202106140120550005107', 'Assigned to: Yogesh '),
('202110300949140007883', 231, '2021-10-30', '09:17:40', '202106140120550005107', ''),
('202110300949140007883', 231, '2021-10-30', '09:17:40', '202106140120550005107', 'Assigned to: Pradyumna ');

-- --------------------------------------------------------

--
-- Table structure for table `tstep`
--

CREATE TABLE `tstep` (
  `tguid` varchar(70) NOT NULL,
  `tsequenceid` int(3) NOT NULL,
  `tstepdescription` varchar(255) NOT NULL,
  `tstage` int(3) NOT NULL,
  `assignto` varchar(70) DEFAULT NULL,
  `pstart` date DEFAULT NULL,
  `pend` date DEFAULT NULL,
  `peffort` int(10) DEFAULT NULL,
  `astart` date DEFAULT NULL,
  `aend` date DEFAULT NULL,
  `aeffort` int(10) DEFAULT NULL,
  `p_seq` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tstep`
--

INSERT INTO `tstep` (`tguid`, `tsequenceid`, `tstepdescription`, `tstage`, `assignto`, `pstart`, `pend`, `peffort`, `astart`, `aend`, `aeffort`, `p_seq`) VALUES
('202107270149200005375', 0, 'Develop End to End Task Management Application', 2, '202106140120550005107', '2021-06-01', '2021-07-31', 28800, '2021-06-02', '0000-00-00', 22080, NULL),
('202107270149200005375', 31, 'Requirement Gathering', 1, '202107010318160004665', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, NULL),
('202107270149200005375', 41, 'Requirement Analysis', 4, '202106140120550005107', '2021-07-02', '2021-07-08', 2880, '2021-07-02', '2021-07-08', 3360, NULL),
('202107270149200005375', 51, 'Estimation', 1, '202107010318160004665', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, NULL),
('202107270149200005375', 71, 'Functional Specification (FSR)', 4, '202106140120550005107', '2021-06-09', '2021-07-15', 2880, '2021-07-09', '2021-07-15', 2880, NULL),
('202107270149200005375', 101, 'Code', 6, '202106140120550005107', '2021-07-16', '2021-07-14', 11520, '2021-07-16', '0000-00-00', 12480, NULL),
('202107270149200005375', 111, 'Code Review', 5, '202106140120550005107', '2021-07-15', '2021-07-21', 2880, '2021-07-15', '0000-00-00', 1920, NULL),
('202107270149200005375', 121, 'Technical Testing', 3, '202106140120550005107', '2021-07-25', '2021-07-31', 1440, '2021-07-25', '0000-00-00', 1440, NULL),
('202107270149200005375', 131, 'Unit Testing (UT)', 1, '202107010318160004665', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, NULL),
('202107270244330003880', 0, 'Internship Project Review', 2, '202106140120550005107', '2021-07-26', '2021-07-31', 2400, '2021-07-27', '0000-00-00', 480, NULL),
('202107270244330003880', 221, 'Peer Review', 5, '202107260914080001161', '2021-07-27', '2021-07-27', 480, '2021-07-27', '0000-00-00', 480, NULL),
('202107270244330003880', 231, 'Manager Review', 1, '202106140120550005107', '0000-00-00', '0000-00-00', 480, '0000-00-00', '0000-00-00', 0, NULL),
('202107270244330003880', 241, 'Demo', 1, '202106140120550005107', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, NULL),
('202107270244330003880', 251, 'Live Demo', 1, '202106140120550005107', '0000-00-00', '0000-00-00', 480, '0000-00-00', '0000-00-00', 0, NULL),
('202107270244330003880', 261, 'Report Submission', 1, '202106140120550005107', '0000-00-00', '0000-00-00', 960, '0000-00-00', '0000-00-00', 0, NULL),
('202107281247200001306', 0, 'Bug  Fix in LTI website', 2, '202107260918100005529', '2021-07-28', '2021-08-27', 14400, '0000-00-00', '0000-00-00', 0, NULL),
('202107281247200001306', 21, 'Kickoff', 1, '202107260918100005529', '0000-00-00', '0000-00-00', 5184, '0000-00-00', '0000-00-00', 0, NULL),
('202107281247200001306', 31, 'Requirement Gathering', 1, '202107260914080001161', '0000-00-00', '0000-00-00', 2297, '0000-00-00', '0000-00-00', 0, NULL),
('202107281247200001306', 171, 'Cut Over', 1, '202107260918100005529', '0000-00-00', '0000-00-00', 1473, '0000-00-00', '0000-00-00', 0, NULL),
('202107301210570003209', 0, 'Sample Task C3', 2, '202107020343560007236', '2021-07-04', '2021-07-10', 3360, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 0, 'Internship Project Review', 2, '202106140120550005107', '2021-10-29', '2021-11-03', 2400, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 131, 'Unit Testing (UT)', 1, '202107260918100005529', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 221, 'Peer Review', 2, '202107030555130008108', '2021-10-30', '2021-10-31', 960, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 231, 'Manager Review', 1, '202107260918100005529', '0000-00-00', '0000-00-00', 0, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 241, 'Demo', 2, '202106140120550005107', '2021-10-28', '2021-10-31', 1920, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 251, 'Live Demo', 2, '202106140120550005107', '2021-10-30', '2021-10-30', 480, '0000-00-00', '0000-00-00', 0, NULL),
('202110300949140007883', 261, 'Report Submission', 2, '202106140120550005107', '2021-10-30', '2021-11-04', 2400, '0000-00-00', '0000-00-00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ttable`
--

CREATE TABLE `ttable` (
  `tguid` varchar(70) NOT NULL,
  `tid` varchar(20) NOT NULL,
  `tdescription` varchar(200) NOT NULL,
  `ttype` varchar(70) NOT NULL,
  `createdon` date NOT NULL,
  `createdat` time NOT NULL,
  `createdby` varchar(70) NOT NULL,
  `priority` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ttable`
--

INSERT INTO `ttable` (`tguid`, `tid`, `tdescription`, `ttype`, `createdon`, `createdat`, `createdby`, `priority`) VALUES
('202107270149200005375', 'T001', 'Develop End to End Task Management Application', '3', '2021-07-27', '01:20:49', '202106140120550005107', 2),
('202107281247200001306', 'T003', 'Bug  Fix in website', '2', '2021-07-28', '12:20:47', '202107260918100005529', 1),
('202107301210570003209', 'C003', 'Sample Task C3', '2', '2021-07-03', '03:01:01', '202107260918100005529', 4),
('202110300949140007883', 'T002', 'Internship Project Review', '6', '2021-10-30', '09:14:49', '202106140120550005107', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ttype_map_tstep`
--

CREATE TABLE `ttype_map_tstep` (
  `ttype` int(3) NOT NULL,
  `tsequenceid` int(3) NOT NULL,
  `peffort_per` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ttype_map_tstep`
--

INSERT INTO `ttype_map_tstep` (`ttype`, `tsequenceid`, `peffort_per`) VALUES
(1, 41, 25),
(1, 51, 45),
(2, 21, 36),
(2, 31, 15.95),
(2, 171, 10.23),
(2, 211, 30.56),
(3, 41, 10),
(3, 71, 10),
(3, 101, 40),
(3, 111, 10),
(3, 121, 5),
(3, 141, 10),
(3, 201, 15),
(4, 181, 0),
(4, 191, 0),
(5, 141, 56.32),
(6, 221, 20),
(6, 231, 20),
(6, 251, 20),
(6, 261, 40);

-- --------------------------------------------------------

--
-- Table structure for table `userdata1`
--

CREATE TABLE `userdata1` (
  `uguid` varchar(70) NOT NULL,
  `uname` varchar(70) NOT NULL,
  `shortname` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL,
  `a_status` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata1`
--

INSERT INTO `userdata1` (`uguid`, `uname`, `shortname`, `password`, `a_status`) VALUES
('202106130413030002786', 'Bharat', 'Singh', '8989', 'active'),
('202106130535020008743', 'Bharat Singh', 'bsr1234', '789', 'active'),
('202106130630230004246', 'Bharat', 'Singh', 'bharat999', 'active'),
('202106131055420009086', 'Devraj', 'dev', 'dev991', 'active'),
('202106131254540003133', 'test456', 'afdaf', 'etet', 'active'),
('202106140120550005107', 'Bharat', 'bsr', '8769', 'active'),
('202106141013100009054', 'test5623', 't5623', '5623', 'active'),
('202106141034550002478', 'Test896', 't896', '896', 'active'),
('202106141201490009250', 'Test452', 't452', '452', 'active'),
('202106150945160001168', 'Test897', 't897', '897', 'active'),
('202106230231410006820', 'Test562', 't562', 'Test@562', 'active'),
('202106230333550008379', 'Ashish', 'asharma', '6262', 'active'),
('202106280947240002889', 'Test User12', 'tu12', '1212', 'active'),
('202107010318160004665', 'Rahul', 'rahul', 'r789', 'active'),
('202107020300560003789', 'Akash', 'ak', '890', 'active'),
('202107020301510006678', 'Amogh', 'amg', '789', 'active'),
('202107020304460002086', 'Arjun', 'asr', '123', 'active'),
('202107020308480008995', 'Sarthak', 'sr', '765', 'active'),
('202107020313490007218', 'Mahek', 'mk', '456', 'active'),
('202107020315530006629', 'Saksham', 'sk', '125', 'active'),
('202107020317470001169', 'Kuldeep', 'kp', '321', 'active'),
('202107020324540007327', 'Priyansh', 'psh', '521', 'active'),
('202107020331580004884', 'Jaydeep', 'jp', '567', 'active'),
('202107020343560007236', 'Aman', 'am', '246', 'active'),
('202107020348510009595', 'Swapnil', 'sp', '987', 'active'),
('202107030545120006860', 'Deepak', 'dp', '999', 'active'),
('202107030555130008108', 'Yogesh', 'yg', '998', 'active'),
('202107260914080001161', 'Sheik', 'Sheik R', '4321', 'active'),
('202107260918100005529', 'Pradyumna', 'Prady', '9876', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `userdata2`
--

CREATE TABLE `userdata2` (
  `type` varchar(70) NOT NULL,
  `value` varchar(70) NOT NULL,
  `uguid` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata2`
--

INSERT INTO `userdata2` (`type`, `value`, `uguid`) VALUES
('contact', '1231231235', '202107020315530006629'),
('contact', '1231231238', '202107020304460002086'),
('contact', '2462462465', '202107020343560007236'),
('contact', '3213213216', '202107020317470001169'),
('contact', '4564564569', '202107020313490007218'),
('contact', '5215215219', '202107020324540007327'),
('contact', '5625625622', '202106230231410006820'),
('contact', '5645788912', '202106130413030002786'),
('contact', '5656454512', '202106130630230004246'),
('contact', '5656565656', '202106131055420009086'),
('contact', '5675675679', '202107020331580004884'),
('contact', '6262626262', '202106230333550008379'),
('contact', '7506404183', '202107260918100005529'),
('contact', '7657657659', '202107020308480008995'),
('contact', '7845784552', '202106141034550002478'),
('contact', '7897897894', '202107020301510006678'),
('contact', '7897897896', '202107010318160004665'),
('contact', '8769055449', '202106140120550005107'),
('contact', '890', '202107020300560003789'),
('contact', '8945561223', '202106141013100009054'),
('contact', '8978564556', '202106130535020008743'),
('contact', '8978978979', '202106150945160001168'),
('contact', '9638524697', '202106280947240002889'),
('contact', '9638527416', '202107030545120006860'),
('contact', '9789213405', '202107260914080001161'),
('contact', '9856463453', '202106131254540003133'),
('contact', '9879879876', '202107020348510009595'),
('contact', '9989989989', '202107030555130008108'),
('contact', 'Test452@gmail.com', '202106141201490009250'),
('employeeid', '156434', '202106131254540003133'),
('employeeid', '7878', '202106130630230004246'),
('employeeid', 'P123', '202107020304460002086'),
('employeeid', 'P1234', '202106130535020008743'),
('employeeid', 'P125', '202107020315530006629'),
('employeeid', 'P246', '202107020343560007236'),
('employeeid', 'P321', '202107020317470001169'),
('employeeid', 'P452', '202106141201490009250'),
('employeeid', 'P456', '202107020313490007218'),
('employeeid', 'P521', '202107020324540007327'),
('employeeid', 'P5623', '202106141013100009054'),
('employeeid', 'P567', '202107020331580004884'),
('employeeid', 'P765', '202107020308480008995'),
('employeeid', 'P7878', '202106130413030002786'),
('employeeid', 'P789', '202107020301510006678'),
('employeeid', 'P890', '202107020300560003789'),
('employeeid', 'P896', '202106141034550002478'),
('employeeid', 'P987', '202107020348510009595'),
('employeeid', 'P998', '202107030555130008108'),
('employeeid', 'P99912', '202106131055420009086'),
('employeeid', 'PS4321', '202107260914080001161'),
('employeeid', 'PS562', '202106230231410006820'),
('employeeid', 'PS62', '202106230333550008379'),
('employeeid', 'PS789', '202107010318160004665'),
('employeeid', 'PS897', '202106150945160001168'),
('employeeid', 'PS9876', '202107260918100005529'),
('employeeid', 'PS999', '202107030545120006860'),
('employeeid', 'T04297', '202106140120550005107'),
('employeeid', 'testuser12@gmail.com', '202106280947240002889'),
('e_emailid', '1212', '202106280947240002889'),
('e_emailid', 'afdffwfa@gmail.com', '202106131254540003133'),
('e_emailid', 'akash@gmail.com', '202107020300560003789'),
('e_emailid', 'aman@gmail.com', '202107020343560007236'),
('e_emailid', 'amogh@gmail.com', '202107020301510006678'),
('e_emailid', 'arjun@gmail.com', '202107020304460002086'),
('e_emailid', 'ashish@gmail.com', '202106230333550008379'),
('e_emailid', 'bharat123@gmail.com', '202106130535020008743'),
('e_emailid', 'bharat999@gmail.com', '202106130630230004246'),
('e_emailid', 'bharat@gmail.com', '202106130413030002786'),
('e_emailid', 'bharatsr100@gmail.com', '202106140120550005107'),
('e_emailid', 'deepak@gmail.com', '202107030545120006860'),
('e_emailid', 'dev999@gmail.com', '202106131055420009086'),
('e_emailid', 'jaydeep@gmail.com', '202107020331580004884'),
('e_emailid', 'kuldeep@gmail.com', '202107020317470001169'),
('e_emailid', 'mahek@gmail.com', '202107020313490007218'),
('e_emailid', 'pradyumna.barapatre@lntinfotech.com', '202107260918100005529'),
('e_emailid', 'priyansh@gmail.com', '202107020324540007327'),
('e_emailid', 'rahulkumar@gmail.com', '202107010318160004665'),
('e_emailid', 'saksham@gmail.com', '202107020315530006629'),
('e_emailid', 'Sarthak@gmail.com', '202107020308480008995'),
('e_emailid', 'sheikmohamedrafiq.rasoolmohideen@lntinfotech.com', '202107260914080001161'),
('e_emailid', 'swapnil@gmail.com', '202107020348510009595'),
('e_emailid', 'test452', '202106141201490009250'),
('e_emailid', 'test5623@gmail.com', '202106141013100009054'),
('e_emailid', 'test562@gmail.com', '202106230231410006820'),
('e_emailid', 'test896@gmail.com', '202106141034550002478'),
('e_emailid', 'Test897@gmail.com', '202106150945160001168'),
('e_emailid', 'yogesh@gmail.com', '202107030555130008108'),
('p_emailid', 'afdfa45454@gmail.com', '202106130630230004246'),
('p_emailid', 'afdfeffa@gmail.com', '202106131254540003133'),
('p_emailid', 'ak@gmail.com', '202107020300560003789'),
('p_emailid', 'am@gmail.com', '202107020343560007236'),
('p_emailid', 'amg@gmail.com', '202107020301510006678'),
('p_emailid', 'ashish62@gmail.com', '202106230333550008379'),
('p_emailid', 'asr@gmail.com', '202107020304460002086'),
('p_emailid', 'b123@gmail.com', '202106130535020008743'),
('p_emailid', 'bharats200@gmail.com', '202106140120550005107'),
('p_emailid', 'bsr@gmail.com', '202106130413030002786'),
('p_emailid', 'dev152@gmail.com', '202106131055420009086'),
('p_emailid', 'dp@gmail.com', '202107030545120006860'),
('p_emailid', 'jp@gmail.com', '202107020331580004884'),
('p_emailid', 'kp@gmail.com', '202107020317470001169'),
('p_emailid', 'mk@gmail.com', '202107020313490007218'),
('p_emailid', 'pradyumna@lntinfotech.com', '202107260918100005529'),
('p_emailid', 'psh@gmail.com', '202107020324540007327'),
('p_emailid', 'rahul@gmail.com', '202107010318160004665'),
('p_emailid', 'sheikmohamedrafiq@lntinfotech.com', '202107260914080001161'),
('p_emailid', 'sk@gmail.com', '202107020315530006629'),
('p_emailid', 'sp@gmail.com', '202107020348510009595'),
('p_emailid', 'sr@gmail.com', '202107020308480008995'),
('p_emailid', 't452@gmail.com', '202106141201490009250'),
('p_emailid', 't5623@gmail.com', '202106141013100009054'),
('p_emailid', 't562@gmail.com', '202106230231410006820'),
('p_emailid', 't896@gmail.com', '202106141034550002478'),
('p_emailid', 't897@gmail.com', '202106150945160001168'),
('p_emailid', 'tu12@gmail.com', '202106280947240002889'),
('p_emailid', 'yg@gmail.com', '202107030555130008108');

-- --------------------------------------------------------

--
-- Table structure for table `user_map`
--

CREATE TABLE `user_map` (
  `owner` varchar(70) NOT NULL,
  `owner_name` varchar(70) NOT NULL,
  `reportee` varchar(70) NOT NULL,
  `reportee_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_map`
--

INSERT INTO `user_map` (`owner`, `owner_name`, `reportee`, `reportee_name`) VALUES
('202106131055420009086', 'Devraj', '202106230333550008379', 'Ashish'),
('202106131055420009086', 'Devraj', '202107020304460002086', 'Arjun'),
('202106230333550008379', 'Ashish', '202107020331580004884', 'Jaydeep'),
('202106230333550008379', 'Ashish', '202107030545120006860', 'Deepak'),
('202107010318160004665', 'Rahul', '202106131055420009086', 'Devraj'),
('202107010318160004665', 'Rahul', '202107020343560007236', 'Aman'),
('202107010318160004665', 'Rahul', '202107260918100005529', 'Pradyumna'),
('202107020304460002086', 'Arjun', '202107020308480008995', 'Sarthak'),
('202107020304460002086', 'Arjun', '202107020317470001169', 'Kuldeep'),
('202107020313490007218', 'Mahek', '202107020301510006678', 'Amogh'),
('202107020313490007218', 'Mahek', '202107020348510009595', 'Swapnil'),
('202107020324540007327', 'Priyansh', '202107020300560003789', 'Akash'),
('202107020324540007327', 'Priyansh', '202107020315530006629', 'Saksham'),
('202107020343560007236', 'Aman', '202107020313490007218', 'Mahek'),
('202107020343560007236', 'Aman', '202107020324540007327', 'Priyansh'),
('202107030555130008108', 'Yogesh', '202106140120550005107', 'Bharat'),
('202107260918100005529', 'Pradyumna', '202107030555130008108', 'Yogesh');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `uguid` varchar(70) NOT NULL,
  `uname` varchar(70) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`uguid`, `uname`, `role`) VALUES
('202106131055420009086', 'Devraj', 'pm'),
('202106230333550008379', 'Ashish', 'tl'),
('202107010318160004665', 'Rahul', 'admin'),
('202107010318160004665', 'Rahul', 'dm'),
('202107020304460002086', 'Arjun', 'tl'),
('202107020313490007218', 'Mahek', 'admin'),
('202107020313490007218', 'Mahek', 'tl'),
('202107020324540007327', 'Priyansh', 'tl'),
('202107020343560007236', 'Aman', 'admin'),
('202107020343560007236', 'Aman', 'pm'),
('202107030555130008108', 'Yogesh', 'tl'),
('202107260914080001161', 'Sheik', 'tl'),
('202107260918100005529', 'Pradyumna', 'admin'),
('202107260918100005529', 'Pradyumna', 'pm');

-- --------------------------------------------------------

--
-- Table structure for table `vstatus`
--

CREATE TABLE `vstatus` (
  `vguid` varchar(70) NOT NULL,
  `vsequenceid` varchar(20) NOT NULL,
  `updatedon` date NOT NULL,
  `updatedat` time NOT NULL,
  `updatedby` varchar(70) NOT NULL,
  `vremark` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vstatus`
--

INSERT INTO `vstatus` (`vguid`, `vsequenceid`, `updatedon`, `updatedat`, `updatedby`, `vremark`) VALUES
('202107261139290009192', 'ooo', '2021-07-26', '11:29:39', '202106140120550005107', 'Out of office'),
('202107270246360003309', 'ooo', '2021-07-27', '02:36:46', '202106140120550005107', 'Out of Office due to emergency'),
('202107281140160007613', 'ooo', '2021-07-28', '07:47:00', '202107260918100005529', 'Rejecting the application'),
('202107281140160007613', 'ooo', '2021-07-28', '11:16:40', '202107260918100005529', 'Not available due to a family function'),
('202107281159170008926', 'ooo', '2021-07-28', '07:48:38', '202107260918100005529', 'Approving the vacation. Take Care'),
('202107281159170008926', 'ooo', '2021-07-28', '11:17:59', '202107260914080001161', 'Out of Office due to health issue'),
('202107300332200008590', 'ooo', '2021-07-30', '03:20:32', '202107260918100005529', 'Out of Office due to health issues'),
('202107301244410006159', 'ooo', '2021-07-30', '12:41:44', '202106140120550005107', 'Out of Office due to fever'),
('202107301244410006159', 'ooo', '2021-07-30', '12:42:06', '202106140120550005107', 'Vacation Cancelled'),
('202110300908190005685', 'ooo', '2021-10-30', '05:50:11', '202107260918100005529', 'Approved'),
('202110300908190005685', 'ooo', '2021-10-30', '09:19:08', '202106140120550005107', 'Out of office');

-- --------------------------------------------------------

--
-- Table structure for table `vtable`
--

CREATE TABLE `vtable` (
  `vguid` varchar(70) NOT NULL,
  `vid` varchar(20) NOT NULL,
  `vremark` varchar(250) NOT NULL,
  `createdon` date NOT NULL,
  `createdat` time NOT NULL,
  `createdby` varchar(70) NOT NULL,
  `createdfor` varchar(70) NOT NULL,
  `vstart` date NOT NULL,
  `vend` date NOT NULL,
  `action` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vtable`
--

INSERT INTO `vtable` (`vguid`, `vid`, `vremark`, `createdon`, `createdat`, `createdby`, `createdfor`, `vstart`, `vend`, `action`) VALUES
('202107261139290009192', 'spld', 'Out of office', '2021-07-26', '11:29:39', '202106140120550005107', '202106140120550005107', '2021-07-28', '2021-07-29', 'Approved'),
('202107270246360003309', 'emeg', 'Out of Office due to emergency', '2021-07-27', '02:36:46', '202106140120550005107', '202106140120550005107', '2021-07-27', '2021-07-27', ''),
('202107281140160007613', 'spld', 'Not available due to a family function', '2021-07-28', '11:16:40', '202107260918100005529', '202107260914080001161', '2021-07-22', '2021-07-23', 'Rejected'),
('202107281159170008926', 'sick', 'Out of Office due to health issue', '2021-07-28', '11:17:59', '202107260914080001161', '202107260914080001161', '2021-07-30', '2021-07-30', 'Approved'),
('202107300332200008590', 'sick', 'Out of Office due to health issues', '2021-07-30', '03:20:32', '202107260918100005529', '202106140120550005107', '2021-07-30', '2021-07-30', 'Approved'),
('202107301244410006159', 'sick', 'Out of Office due to fever', '2021-07-30', '12:41:44', '202106140120550005107', '202106140120550005107', '2021-07-31', '2021-07-31', 'cancel'),
('202110300908190005685', 'emeg', 'Out of office', '2021-10-30', '09:19:08', '202106140120550005107', '202106140120550005107', '2021-10-31', '2021-10-31', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `task_steps`
--
ALTER TABLE `task_steps`
  ADD PRIMARY KEY (`tsequenceid`);

--
-- Indexes for table `task_types`
--
ALTER TABLE `task_types`
  ADD PRIMARY KEY (`ttype`);

--
-- Indexes for table `tdependency`
--
ALTER TABLE `tdependency`
  ADD PRIMARY KEY (`tguid`,`tsequenceid`,`dtguid`,`dtsequenceid`);

--
-- Indexes for table `tstatus`
--
ALTER TABLE `tstatus`
  ADD PRIMARY KEY (`tguid`,`tsequenceid`,`updatedon`,`updatedat`,`updatedby`,`comment`);

--
-- Indexes for table `tstep`
--
ALTER TABLE `tstep`
  ADD PRIMARY KEY (`tguid`,`tsequenceid`,`tstage`);

--
-- Indexes for table `ttable`
--
ALTER TABLE `ttable`
  ADD PRIMARY KEY (`tguid`);

--
-- Indexes for table `ttype_map_tstep`
--
ALTER TABLE `ttype_map_tstep`
  ADD PRIMARY KEY (`ttype`,`tsequenceid`);

--
-- Indexes for table `userdata1`
--
ALTER TABLE `userdata1`
  ADD PRIMARY KEY (`uguid`);

--
-- Indexes for table `userdata2`
--
ALTER TABLE `userdata2`
  ADD PRIMARY KEY (`type`,`value`);

--
-- Indexes for table `user_map`
--
ALTER TABLE `user_map`
  ADD PRIMARY KEY (`owner`,`reportee`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`uguid`,`role`);

--
-- Indexes for table `vstatus`
--
ALTER TABLE `vstatus`
  ADD PRIMARY KEY (`vguid`,`vsequenceid`,`updatedon`,`updatedat`,`updatedby`,`vremark`);

--
-- Indexes for table `vtable`
--
ALTER TABLE `vtable`
  ADD PRIMARY KEY (`vguid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
