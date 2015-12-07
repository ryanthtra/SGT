-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2015 at 12:22 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lfz_sgt`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
`id` int(10) unsigned NOT NULL COMMENT 'Unique entry id.',
  `key` varchar(10) NOT NULL,
  `rights_flags` tinyint(3) unsigned NOT NULL COMMENT 'bitvector for access rights'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of API keys for teachers and students' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
`id` int(10) unsigned NOT NULL COMMENT 'The unique id for this course.',
  `course` varchar(32) NOT NULL COMMENT 'The name of the course.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sgt`
--

CREATE TABLE IF NOT EXISTS `sgt` (
`id` int(10) unsigned NOT NULL COMMENT 'Unique id for the entry.',
  `creator_id` int(10) unsigned NOT NULL COMMENT 'The entry id from `api_keys`.',
  `student_id` int(11) unsigned NOT NULL COMMENT 'Entry id number from `students`.',
  `course_id` int(10) unsigned NOT NULL COMMENT 'The entry id from `courses`.',
  `grade` int(3) unsigned NOT NULL COMMENT 'Grade for the course.',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The time that this entry was created.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='For the student grade table.' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(11) unsigned NOT NULL COMMENT 'Id number of the student.',
  `creator_id` int(10) unsigned NOT NULL COMMENT 'The entry id of the creator in `api_keys`.',
  `name` varchar(32) NOT NULL COMMENT 'Name of the student.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of students.' AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sgt`
--
ALTER TABLE `sgt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique entry id.';
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique id for this course.';
--
-- AUTO_INCREMENT for table `sgt`
--
ALTER TABLE `sgt`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique id for the entry.';
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id number of the student.';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
