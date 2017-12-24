-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2017 at 11:24 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donatelk`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `user_id` varchar(6) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`user_id`, `rating`) VALUES
('aba', 0),
('check', 0),
('fff', 0),
('fuckth', 0),
('fuuuu', 0),
('rashra', 0),
('rui', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` varchar(15) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` mediumtext NOT NULL,
  `donor_id` varchar(6) NOT NULL,
  `requestor_id` varchar(6) NOT NULL,
  `category` varchar(10) NOT NULL,
  `keywords` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` varchar(15) NOT NULL,
  `requester_id` varchar(6) NOT NULL,
  `item_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(6) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pwd`, `status`, `date_created`, `name`, `phone`, `email`, `type`) VALUES
('aaabba', 'aaa', '0', '2017-12-19 18:30:00', 'abaaba', '4485', 'a@k.v', 'U'),
('aba', 'aaa', '0', '2017-12-19 18:30:00', 'aba', 'aaa', 'a@k.v', 'U'),
('check', '$2y$10$5/l6iSuRfIr.p/EPAoplXeY4BqbaptVjA.k.uAV89AH1eoe0ZBXFq', '0', '2017-12-19 18:30:00', 'check', '77', 'rashmin.ravindu@gmail.com', 'D'),
('fuckth', '$2y$10$cTni783dixLjeshqcyDdIOCUR4eo2xwzkTiUwg3WU74bqar6S2zJa', '0', '2017-12-19 18:30:00', 'rashmin', '44', 'r@l.v', 'U'),
('fuuuu', '3344', '0', '2017-12-19 18:30:00', 'asda', '3344', 'f@l.c', 'U'),
('push', 'aaa', '0', '2017-12-19 18:30:00', 'rashmin', '4563', 's@k.c', 'U'),
('rashra', '$2y$10$Lk5n9Xzs5ATSHK4aeztpRe/FAXZQwSbUBv.kE3jU4XXfKQ4oaI/fK', '0', '2017-12-19 18:30:00', 'rashmin', '0771', 'd@k.c', 'U'),
('rio', '$2y$10$W6wB7adPmtrcXaTPfvsnZ.N2BiZMe8Wl.frS0zR3GThYP/pyCoxUu', '0', '2017-12-19 18:30:00', 'rio', '125', 'f@l.v', 'R'),
('rui', '$2y$10$P78NZZGQ/KyZJXi19HlcPuQbIphlz6J8fcxh8E4OK8cwYSr2kFLgq', '0', '2017-12-19 18:30:00', 'rui', 'aa', 'ra@k.c', 'D'),
('suck', '$2y$10$X6R3fWyxKjLQ.27TyfULN.TU4mPGr3qWeE3N9Lbtzz7wyKUl7G/6m', '0', '2017-12-19 18:30:00', 'check', 'dd', 'd@l.v', 'R');

-- --------------------------------------------------------

--
-- Table structure for table `user_requester`
--

CREATE TABLE `user_requester` (
  `user_id` varchar(6) NOT NULL,
  `age` varchar(10) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `place of work` varchar(50) NOT NULL,
  `proofdoc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_requester`
--

INSERT INTO `user_requester` (`user_id`, `age`, `occupation`, `place of work`, `proofdoc`) VALUES
('aaabba', '48', 'aaa', 'aaa', 'test.php'),
('push', '45', 'sss', 'sss', 'dbTest.php.txt'),
('rio', '78', 'fu', 'fu', 'test.php'),
('suck', '77', 'occu', 'oo', 'test.php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_requester`
--
ALTER TABLE `user_requester`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
