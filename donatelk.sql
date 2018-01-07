-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2017 at 02:04 PM
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
  `user_id` varchar(20) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`user_id`, `rating`) VALUES
('aba1', 0),
('chinthana1', 0),
('rash1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(15) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` mediumtext NOT NULL,
  `photo_path` varchar(50) NOT NULL,
  `donor_id` varchar(20) NOT NULL,
  `requester_id` varchar(6) DEFAULT NULL,
  `category` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_submitted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `title`, `description`, `photo_path`, `donor_id`, `requester_id`, `category`, `status`, `date_submitted`) VALUES
(1, 'Book', 'blah blah', 'item_images/1.jpg', 'rash1', '', 'books', 'confirmed by donor', '2017-12-26 15:43:06'),
(2, 'Dress', 'blah blah', 'item_images/2.jpg', 'rash1', NULL, 'clothes', 'advertised', '2017-12-26 15:43:40'),
(3, 'Newshoe', 'shoessss', 'item_images/3.jpg', 'rash1', NULL, 'shoes', 'advertised', '2017-12-26 15:45:13'),
(4, 'Table', 'table', 'item_images/4.jpg', 'aba1', NULL, 'furniture', 'advertised', '2017-12-26 15:48:42'),
(5, 'Deckshoes', 'deck shoesss', 'item_images/5.jpg', 'aba1', 'aba008', 'shoes', 'sent by admin', '2017-12-26 15:49:07'),
(6, 'Desk', 'very valuable', 'item_images/6.jpg', 'chinthana1', NULL, 'furniture', 'advertised', '2017-12-26 15:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` varchar(15) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `item_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `user_id`, `item_id`) VALUES
('1', 'aba008', 6),
('10', 'aba008', 5),
('5', 'aba008', 1),
('7', 'aba008', 4),
('8', 'iresha1', 2),
('9', 'mayuka1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `pwd` varchar(65) NOT NULL,
  `status` char(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` char(1) NOT NULL,
  `nic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `pwd`, `status`, `date_created`, `name`, `address`, `phone`, `email`, `type`, `nic`) VALUES
('aba1', '$2y$10$nxkjPjRts84pGQgqit4swea1OENeFty6Zt1.lSEwtleOtopJX3w8u', 'a', '2017-12-26 10:16:35', 'aba', 'ab , pera , kandy .', '0774895214', 'aba@aba.aba', 'D', '965485364v'),
('admin1', '$2y$10$hJ9iA/agaeiU.wRimaWvl.dyPQevJn3iPgZEsIzyTsX92s66Ns96y', 'a', '2017-12-26 10:34:17', 'admin1', 'none', '0000000000', 'a@l.c', 'A', '000000000V'),
('chinthana1', '$2y$10$8rKxmzBBSdDDYiUj/kWXtOkEu/YZH/APtB4l9AGmtqP8f9/bfUTGq', 'a', '2017-12-26 10:20:34', 'chinthana', 'chinthana , galle , south', '0775632965', 'chintha@c.com', 'D', '963256954V'),
('iresha1', '$2y$10$nu2ghLQQNdTVOtjwAJh53e67TSMs2LyQlXpfDrwyCOLO91LOWOCRi', 'a', '2017-12-26 10:38:34', 'Iresha', 'hambantota , hambantota', '0554856321', 'i@k.c', 'R', '984562152V'),
('mayuka1', '$2y$10$taUFid4h1Hj62qfJfzcuyejPyCetwe717/OFUwwFJQ/FfDLUVgtPO', 'a', '2017-12-26 10:35:07', 'mayuka jayawardana', 'mayu , mt lavania , colombo', '0715621547', 'mayu@h.c', 'R', '956384562V'),
('rash1', '$2y$10$gD9o1EqgOpBmdujrOgt6U.AFyw7EiJASbl5TipC9PjuzNVLYwPuCe', 'a', '2017-12-26 10:11:45', 'rashmin', 'brito , palatuwa , matara', '0774620921', 'rash@k.com', 'D', '952160982V'),
('rash2', '$2y$10$B5barUAR9gw7iDdGjxhukOaYveS4gQ96OczllI/NaqsqtlrRI66wK', 'w', '2017-12-26 14:23:13', 'Ravindu Rashmin', 'University of Moratuawa , Moratuwa', '0774620921', 'rashmin.ravindu@gmail.com', 'R', '952160982v');

-- --------------------------------------------------------

--
-- Table structure for table `user_requester`
--

CREATE TABLE `user_requester` (
  `user_id` varchar(10) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `place of work` varchar(30) NOT NULL,
  `salary` varchar(10) NOT NULL,
  `proofdoc` varchar(60) NOT NULL,
  `summary` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_requester`
--

INSERT INTO `user_requester` (`user_id`, `age`, `occupation`, `place of work`, `salary`, `proofdoc`, `summary`) VALUES
('iresha1', 22, 'Student', 'uom', '0', 'user_proofdocs/iresha1.pdf', 'im a student okkkk'),
('mayuka1', 23, 'student', 'UOM', '0', 'user_proofdocs/mayuka1.pdf', 'im a student still , studieng in mora '),
('rash2', 23, 'stu', 'uom', '0', 'user_proofdocs/rash2.pdf', 'dasfsdsfadsf');

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
