-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2009 at 03:45 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `search`
--
CREATE DATABASE `search` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `search`;

-- --------------------------------------------------------

--
-- Table structure for table `completed`
--

CREATE TABLE IF NOT EXISTS `completed` (
  `URL` varchar(500) NOT NULL,
  `PATHINCACHE` varchar(500) NOT NULL,
  `KEYWORDS` varchar(500) NOT NULL,
  `TIMEOFCRAWL` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `HITS` int(11) DEFAULT NULL,
  `TITLE` varchar(500) NOT NULL,
  `COUNTRY` varchar(100) NOT NULL,
  `DATA` longtext NOT NULL,
  `RANK` double NOT NULL,
  `WORDCOUNT` double NOT NULL,
  'lasthit' bigint(50) DEFAULT NULL,
   'ipaddres' varchar(100) DEFAULT NULL,
   
  PRIMARY KEY (`URL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dictionary`
--

CREATE TABLE IF NOT EXISTS `dictionary` (
  `id` int(11) NOT NULL,
  `word` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disallowed`
--

CREATE TABLE IF NOT EXISTS `disallowed` (
  `URL` varchar(500) NOT NULL,
  `TIMEOFCRAWL` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ip_to_country`
--

CREATE TABLE IF NOT EXISTS `ip_to_country` (
  `IP_FROM` bigint(20) unsigned NOT NULL,
  `IP_TO` bigint(20) unsigned NOT NULL,
  `REGISTRY` char(7) NOT NULL,
  `ASSIGNED` bigint(20) NOT NULL,
  `CTRY` char(2) NOT NULL,
  `CNTRY` char(3) NOT NULL,
  `COUNTRY` varchar(100) NOT NULL,
  PRIMARY KEY (`IP_FROM`,`IP_TO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE IF NOT EXISTS `reference` (
  `keyword` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL DEFAULT '',
  `len` float NOT NULL,
  `lrep` float NOT NULL,
  `occ` float NOT NULL,
  `wds` float NOT NULL,
  `occwds` float NOT NULL,
  `occlen` float NOT NULL,
  `key1` double NOT NULL,
  PRIMARY KEY (`key1`,`occlen`,`occwds`,`wds`,`occ`,`lrep`,`len`,`url`,`keyword`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `waiting`
--

CREATE TABLE IF NOT EXISTS `waiting` (
  `URL` varchar(500) NOT NULL,
  `TIMEOFADDITION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
