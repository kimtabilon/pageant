-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2018 at 03:56 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pageant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usr` varchar(40) NOT NULL,
  `psw` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `usr`, `psw`) VALUES
(1, 'admin', '8d66a53a381493bec08da23cef5a43767f20a42c');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(90) NOT NULL,
  `points` float NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `points`, `sort`) VALUES
(1, 'Best in Production Number', 10, 1),
(3, 'Best in Swimwear', 10, 2),
(4, 'Best in Long Gown', 10, 6),
(5, 'Best Speaker', 10, 7),
(9, 'Miss Body Beautiful', 10, 4),
(10, 'Miss Hot Legs', 10, 3),
(11, 'Shooting Pose', 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `jme` int(11) NOT NULL,
  `jfrnd` int(11) NOT NULL,
  `chat_msg` text NOT NULL,
  `read_msg` tinyint(4) NOT NULL,
  `off_me` tinyint(4) NOT NULL,
  `off_frnd` tinyint(4) NOT NULL,
  `sort_time` int(21) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `judge`
--

CREATE TABLE `judge` (
  `id` int(11) NOT NULL,
  `jdNum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `judge`
--

INSERT INTO `judge` (`id`, `jdNum`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `majorcategories`
--

CREATE TABLE `majorcategories` (
  `id` int(11) NOT NULL,
  `majorCat` varchar(80) NOT NULL,
  `points` float NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `majorcategories`
--

INSERT INTO `majorcategories` (`id`, `majorCat`, `points`, `sort`) VALUES
(2, 'Personality', 15, 2),
(3, 'Talent', 30, 3),
(4, 'Picture Interpretation', 15, 4),
(5, 'Professionalism', 20, 5),
(8, 'Beauty of Face and Figure', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `major_result`
--

CREATE TABLE `major_result` (
  `id` int(11) NOT NULL,
  `category` varchar(80) NOT NULL,
  `judge` int(11) NOT NULL,
  `candidate` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pair`
--

CREATE TABLE `pair` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pair`
--

INSERT INTO `pair` (`id`, `num`, `type`) VALUES
(1, 6, 'mr'),
(2, 6, 'ms');

-- --------------------------------------------------------

--
-- Table structure for table `save_result`
--

CREATE TABLE `save_result` (
  `id` int(11) NOT NULL,
  `category` varchar(90) NOT NULL,
  `judge` int(11) NOT NULL,
  `candidate` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `talentcategories`
--

CREATE TABLE `talentcategories` (
  `id` int(11) NOT NULL,
  `majorCat` varchar(80) NOT NULL,
  `points` float NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `talentcategories`
--

INSERT INTO `talentcategories` (`id`, `majorCat`, `points`, `sort`) VALUES
(4, 'Choice of Material : Uniqueness / Creativity', 15, 4),
(10, 'Over-all Appeal : X Factor', 10, 5),
(3, 'Choice of Material :Suitability of the Piece', 15, 3),
(8, 'Performance : Mastery and Skill', 25, 1),
(2, 'Performance : Stage Presence / Projection', 25, 2),
(11, 'Over-all Appeal : Audience Impact', 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `talent_result`
--

CREATE TABLE `talent_result` (
  `id` int(11) NOT NULL,
  `category` varchar(80) NOT NULL,
  `judge` int(11) NOT NULL,
  `candidate` int(11) NOT NULL,
  `score` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timer`
--

CREATE TABLE `timer` (
  `id` int(11) NOT NULL,
  `candidate` int(11) NOT NULL,
  `start_t` int(20) NOT NULL,
  `end_t` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judge`
--
ALTER TABLE `judge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `majorcategories`
--
ALTER TABLE `majorcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major_result`
--
ALTER TABLE `major_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pair`
--
ALTER TABLE `pair`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save_result`
--
ALTER TABLE `save_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talent_result`
--
ALTER TABLE `talent_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timer`
--
ALTER TABLE `timer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT for table `judge`
--
ALTER TABLE `judge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `majorcategories`
--
ALTER TABLE `majorcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `major_result`
--
ALTER TABLE `major_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;
--
-- AUTO_INCREMENT for table `pair`
--
ALTER TABLE `pair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `save_result`
--
ALTER TABLE `save_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `talent_result`
--
ALTER TABLE `talent_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timer`
--
ALTER TABLE `timer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
