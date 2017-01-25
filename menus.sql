-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 08:43 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `godatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblwebmenulocations`
--

CREATE TABLE `tblwebmenulocations` (
  `menulocationid` smallint(4) NOT NULL,
  `menulocationname` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='menu locations: top left, top right, top nav bar, bottom';

--
-- Dumping data for table `tblwebmenulocations`
--

INSERT INTO `tblwebmenulocations` (`menulocationid`, `menulocationname`) VALUES
(101, 'Top Left'),
(102, 'Top Right'),
(103, 'Top Nav Bar'),
(104, 'Bottom Nav Bar'),
(105, 'Bottom End');

-- --------------------------------------------------------

--
-- Table structure for table `tblwebmenus`
--

CREATE TABLE `tblwebmenus` (
  `menuid` int(4) NOT NULL,
  `menulabel` varchar(75) NOT NULL DEFAULT '',
  `menulink` varchar(255) NOT NULL DEFAULT '#',
  `menuparent` tinyint(2) NOT NULL DEFAULT '0',
  `menusort` tinyint(2) DEFAULT NULL,
  `menuclass` varchar(255) DEFAULT NULL,
  `menulocationcode` smallint(4) NOT NULL,
  `languagecode` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblwebmenulocations`
--
ALTER TABLE `tblwebmenulocations`
  ADD PRIMARY KEY (`menulocationid`);

--
-- Indexes for table `tblwebmenus`
--
ALTER TABLE `tblwebmenus`
  ADD PRIMARY KEY (`menuid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblwebmenus`
--
ALTER TABLE `tblwebmenus`
  MODIFY `menuid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
