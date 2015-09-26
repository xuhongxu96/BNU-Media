-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-09-26 19:10:59
-- 服务器版本： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `media`
--

-- --------------------------------------------------------

--
-- 表的结构 `bnm_categories`
--

DROP TABLE IF EXISTS `bnm_categories`;
CREATE TABLE IF NOT EXISTS `bnm_categories` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bnm_category_relationships`
--

DROP TABLE IF EXISTS `bnm_category_relationships`;
CREATE TABLE IF NOT EXISTS `bnm_category_relationships` (
  `ID` int(11) NOT NULL,
  `media` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bnm_media`
--

DROP TABLE IF EXISTS `bnm_media`;
CREATE TABLE IF NOT EXISTS `bnm_media` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `desp` varchar(200) DEFAULT NULL,
  `url` varchar(300) NOT NULL,
  `thumbnail` varchar(200) NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `bnm_users`
--

DROP TABLE IF EXISTS `bnm_users`;
CREATE TABLE IF NOT EXISTS `bnm_users` (
  `ID` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT '0',
  `accessToken` varchar(32) DEFAULT NULL,
  `authKey` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `media` (`media`),
  ADD KEY `relationCategory` (`category`);

--
-- Indexes for table `bnm_media`
--
ALTER TABLE `bnm_media`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `mediaUser` (`user`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bnm_category_relationships`
--
ALTER TABLE `bnm_category_relationships`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bnm_media`
--
ALTER TABLE `bnm_media`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bnm_users`
--
ALTER TABLE `bnm_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- 限制导出的表
--

--
-- 限制表 `bnm_category_relationships`
--
ALTER TABLE `bnm_category_relationships`
  ADD CONSTRAINT `bnm_category_relationships_ibfk_1` FOREIGN KEY (`media`) REFERENCES `bnm_media` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bnm_category_relationships_ibfk_2` FOREIGN KEY (`category`) REFERENCES `bnm_categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `bnm_media`
--
ALTER TABLE `bnm_media`
  ADD CONSTRAINT `bnm_media_ibfk_1` FOREIGN KEY (`user`) REFERENCES `bnm_users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
