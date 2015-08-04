-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-04 16:31:38
-- 服务器版本： 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bnumedia`
--

-- --------------------------------------------------------

--
-- 表的结构 `bnm_categories`
--

CREATE TABLE IF NOT EXISTS `bnm_categories` (
`ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bnm_category_relationships`
--

CREATE TABLE IF NOT EXISTS `bnm_category_relationships` (
`ID` int(11) NOT NULL,
  `media` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bnm_media`
--

CREATE TABLE IF NOT EXISTS `bnm_media` (
`ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desp` varchar(200) DEFAULT NULL,
  `url` varchar(300) NOT NULL,
  `thumbnail` varchar(200) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bnm_users`
--

CREATE TABLE IF NOT EXISTS `bnm_users` (
`ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT '0',
  `accessToken` varchar(32) DEFAULT NULL,
  `authKey` varchar(32) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bnm_categories`
--
ALTER TABLE `bnm_categories`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bnm_category_relationships`
--
ALTER TABLE `bnm_category_relationships`
 ADD PRIMARY KEY (`ID`), ADD KEY `media` (`media`), ADD KEY `relationCategory` (`category`);

--
-- Indexes for table `bnm_media`
--
ALTER TABLE `bnm_media`
 ADD PRIMARY KEY (`ID`), ADD KEY `mediaUser` (`user`);

--
-- Indexes for table `bnm_users`
--
ALTER TABLE `bnm_users`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bnm_categories`
--
ALTER TABLE `bnm_categories`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bnm_category_relationships`
--
ALTER TABLE `bnm_category_relationships`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `bnm_media`
--
ALTER TABLE `bnm_media`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `bnm_users`
--
ALTER TABLE `bnm_users`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
