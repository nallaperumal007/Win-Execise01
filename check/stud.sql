-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 11:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stud`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `regno` int(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `chkid` int(11) DEFAULT NULL,
  `finaltot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `regno`, `name`, `address`, `mark`, `chkid`, `finaltot`) VALUES
(195, 44, 'hjghj', 'jghjg', 99, 3, 330),
(196, 45, 'cmgmg', 'hjgjghg', 88, 3, 330),
(198, 8, 'ghghghjhk', 'gghg', 77, 4, 330),
(199, 9, 'hhghj', 'jhhjg', 66, 4, 330),
(200, 10, NULL, NULL, NULL, 100, NULL),
(202, 11, 'kjkjsdds', 'kjsajkflk', 99, 101, 0),
(204, 12, 'nalla perumal', 'vannarpettai', 88, 102, 0),
(206, 1, 'nalla perumal', 'vannarpettai', 99, 103, 0),
(211, 1111, 'nalla perumal', 'vannarpettai', 88, 104, NULL),
(213, 999, 'nalla perumal', 'vannarpettai', 99, 105, NULL),
(218, 234, 'nalla perumal', 'vannarpettai', 99, 4, NULL),
(222, 7, 'nalla perumal', 'vannarpettai', 77, 4, NULL),
(226, 13, 'nalla perumal', 'vannarpettai', 99, 4, NULL),
(229, 14, 'nalla perumal', 'vannarpettai', 77, 5, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regno` (`regno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
