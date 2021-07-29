-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 07:27 AM
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
-- Use: To store a temporary key which is valid for next 24 hours when a user tries to reset password upon forgetting

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_steps`
-- Use: To manage task steps bucket list

CREATE TABLE `task_steps` (
  `tsequenceid` int(3) NOT NULL,
  `tstepdescription` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_types`
-- Use: To manage all task types available

CREATE TABLE `task_types` (
  `ttype` int(3) NOT NULL,
  `ttype_desc` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tdependency`
-- Use: This table is not used anywhere.

CREATE TABLE `tdependency` (
  `tguid` varchar(70) NOT NULL,
  `tsequenceid` varchar(70) NOT NULL,
  `dtguid` varchar(70) NOT NULL,
  `dtsequenceid` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

-- 
-- Table structure for table `tstatus`
-- Use: To store comments for any task or task step

CREATE TABLE `tstatus` (
  `tguid` varchar(70) NOT NULL,
  `tsequenceid` int(3) NOT NULL,
  `updatedon` date NOT NULL,
  `updatedat` time NOT NULL,
  `updatedby` varchar(70) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tstep`
-- Use: To store task steps information for any task created by user

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

-- --------------------------------------------------------

--
-- Table structure for table `ttable`
-- Use: To store task creation information 

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

-- --------------------------------------------------------

--
-- Table structure for table `ttype_map_tstep`
-- Use: To manage mapping beteween task types and task steps

CREATE TABLE `ttype_map_tstep` (
  `ttype` int(3) NOT NULL,
  `tsequenceid` int(3) NOT NULL,
  `peffort_per` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userdata1`
-- Use: To store Userdata (user guid, name and password)

CREATE TABLE `userdata1` (
  `uguid` varchar(70) NOT NULL,
  `uname` varchar(70) NOT NULL,
  `shortname` varchar(70) NOT NULL,
  `password` varchar(70) NOT NULL,
  `a_status` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userdata2`
-- Use: To store userid's by which user can login (For ex: type can be contact, employee email, Employee number, etc.)

CREATE TABLE `userdata2` (
  `type` varchar(70) NOT NULL,
  `value` varchar(70) NOT NULL,
  `uguid` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_map`
-- Use: To manage the organization hierarchy (Who reports to whom)

CREATE TABLE `user_map` (
  `owner` varchar(70) NOT NULL,
  `owner_name` varchar(70) NOT NULL,
  `reportee` varchar(70) NOT NULL,
  `reportee_name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
-- Use: To manage roles assigned to users (For ex: pm, dm, admin)

CREATE TABLE `user_role` (
  `uguid` varchar(70) NOT NULL,
  `uname` varchar(70) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vstatus`
-- Use: To store the remarks added for any vacation

CREATE TABLE `vstatus` (
  `vguid` varchar(70) NOT NULL,
  `vsequenceid` varchar(20) NOT NULL,
  `updatedon` date NOT NULL,
  `updatedat` time NOT NULL,
  `updatedby` varchar(70) NOT NULL,
  `vremark` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vtable`
-- Use: To manage the vacation requested by user and any subsequent action taken

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
