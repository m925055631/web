-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2015 at 06:21 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `votes`
--
CREATE DATABASE IF NOT EXISTS `votes` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `votes`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'c8a1f091540bcb46012703e3b62ddf85');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countid` varchar(10) NOT NULL,
  `programid` varchar(10) NOT NULL,
  `programname` varchar(100) NOT NULL,
  `section` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `countid`, `programid`, `programname`, `section`) VALUES
(1, 'v1v', '朱日丹', '朱日丹', '0'),
(2, 'v2v', '梁浩', '梁浩', '0'),
(3, 'v3v', '徐超仁', '徐超仁', '0'),
(4, 'v4v', '方嘉宇', '方嘉宇', '0'),
(5, 'v5v', '吴嘉丽', '吴嘉丽', '0'),
(6, 'v6v', '赵伟成', '赵伟成', '0'),
(7, 'v7v', '郦敏懿', '郦敏懿', '0'),
(8, 'v8v', '陈劲', '陈劲', '0'),
(9, 'v9v', '周银军', '周银军', '0'),
(10, 'v10v', '郑毓武', '郑毓武', '0'),
(11, 'v11v', '刘静秋', '刘静秋', '0');

-- --------------------------------------------------------

--
-- Table structure for table `program1`
--

CREATE TABLE IF NOT EXISTS `program1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `countid` varchar(10) NOT NULL,
  `programid` varchar(10) NOT NULL,
  `programname` varchar(100) NOT NULL,
  `section` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `program1`
--

INSERT INTO `program1` (`id`, `countid`, `programid`, `programname`, `section`) VALUES
(1, 'v1v', '运管室等', '运管室等-网运专项成本团队', '2'),
(2, 'v2v', '客保室1', '客保室1-A类平台告警梳理专项', '3'),
(3, 'v3v', '客保室2', '客保室2-工单优化处理团队', '3'),
(4, 'v4v', '平台室', '平台室-护航小组专项', '4'),
(5, 'v5v', '外呼室', '外呼室-12345支撑团队', '6'),
(6, 'v6v', '视讯室1', '视讯室1-会议保障团队(郭)', '7'),
(7, 'v7v', '视讯室2', '视讯室2-视讯开发式维护团队(石)', '7'),
(8, 'v8v', '公众室/质保室', '公众室/质保室-院线通感知提升项目', '9'),
(9, 'v9v', '公众室/客保室', '公众室/客保室-4G放号支撑团队', '9'),
(10, 'v10v', '质保室', '质保室-数据库及数据分析能力提升团队', '10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `phonenumber` varchar(20) NOT NULL,
  `section` varchar(8) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `phonenumber`, `section`, `status`) VALUES
(1, '13302383311', '1', 0),
(2, '13316168163', '1', 0),
(3, '13302330266', '1', 1),
(4, '13302339388', '1', 1),
(5, '13302339161', '2', 0),
(6, '13302335668', '2', 0),
(7, '13392138828', '2', 1),
(8, '13302330056', '2', 1),
(9, '13302333370', '2', 0),
(10, '13302336388', '3', 0),
(11, '13316097686', '3', 1),
(12, '13302330916', '3', 0),
(13, '13302330815', '3', 1),
(14, '13316097698', '4', 1),
(15, '13316097706', '4', 0),
(16, '13316097728', '4', 0),
(17, '13316097768', '4', 1),
(18, '13316097755', '4', 0),
(19, '13392138438', '4', 1),
(20, '13316097868', '4', 0),
(21, '13302338567', '4', 1),
(22, '13392136806', '5', 0),
(23, '13392136809', '5', 1),
(24, '13392136938', '5', 0),
(25, '13302331512', '5', 0),
(26, '13302330756', '5', 1),
(27, '13302330917', '5', 0),
(28, '13302331911', '6', 1),
(29, '13316097838', '6', 1),
(30, '13392138399', '6', 0),
(31, '13392135268', '6', 0),
(32, '13302333021', '6', 0),
(33, '13302332226', '6', 0),
(34, '13302332095', '7', 1),
(35, '13392138300', '7', 0),
(36, '13392138308', '7', 1),
(37, '13392138299', '7', 1),
(38, '13392138262', '7', 1),
(39, '13392138289', '7', 0),
(40, '18925179250', '7', 0),
(41, '13392138281', '7', 1),
(42, '18928900503', '7', 0),
(43, '13392138278', '7', 0),
(44, '13392138533', '7', 1),
(45, '13392138258', '7', 0),
(46, '18922189559', '7', 1),
(47, '13392138268', '7', 1),
(48, '13302330312', '7', 0),
(49, '13302333158', '8', 0),
(50, '13302337819', '8', 0),
(51, '13302331024', '8', 1),
(52, '13316097738', '8', 0),
(53, '13302335036', '8', 0),
(54, '13302337568', '8', 1),
(55, '13302338312', '8', 1),
(56, '13302338861', '8', 0),
(57, '13302330420', '8', 0),
(58, '13302330617', '8', 1),
(59, '13302330706', '8', 0),
(60, '13302337222', '9', 1),
(61, '13302337563', '9', 1),
(62, '13302337558', '9', 0),
(63, '13302333319', '9', 1),
(64, '13302337933', '9', 1),
(65, '13302336613', '9', 0),
(66, '13322811353', '9', 0),
(67, '13302339028', '9', 0),
(68, '13302330950', '9', 0),
(69, '13302332325', '10', 0),
(70, '13302333450', '10', 0),
(71, '13302333317', '10', 0),
(72, '13392138303', '10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voteresult`
--

CREATE TABLE IF NOT EXISTS `voteresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phonenumber` varchar(20) NOT NULL,
  `votes` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voteresult1`
--

CREATE TABLE IF NOT EXISTS `voteresult1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phonenumber` varchar(20) NOT NULL,
  `votes` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
