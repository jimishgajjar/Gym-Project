-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 06:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61952d7816277', 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2021-11-17 17:26:45', '2021-11-17 17:26:45', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_description`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61ae0b26d28c8', 'GRIT STRENGTH', 'GRIT STRENGTH', '2021-12-06 18:37:50', '2021-12-06 18:37:50', '61952d7816277', '61952d7816277', 0),
('61ae0b7228135', 'ZUMBA ATHLETIC', 'ZUMBA ATHLETIC', '2021-12-06 18:39:06', '2021-12-06 18:39:06', '61952d7816277', '61952d7816277', 0),
('61ae0b7b8ca42', 'FUSION YOGA', 'FUSION YOGA', '2021-12-06 18:39:15', '2021-12-06 18:39:15', '61952d7816277', '61952d7816277', 0),
('61ae0b82ec211', 'Meditation', 'Meditation', '2021-12-06 18:39:22', '2021-12-06 18:39:22', '61952d7816277', '61952d7816277', 0),
('61ae0b8b3f476', 'Climbing Induction', 'Climbing Induction', '2021-12-06 18:39:31', '2021-12-06 18:39:31', '61952d7816277', '61952d7816277', 0),
('61ae0b977d08e', 'Punch Boxing', 'Punch Boxing', '2021-12-06 18:39:43', '2021-12-06 18:39:43', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `thumbnail` text NOT NULL,
  `rating` varchar(10) NOT NULL DEFAULT '0.0',
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `category_id`, `title`, `description`, `tags`, `thumbnail`, `rating`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61ae0f7abf646', '61ae0b26d28c8', '2022 Complete Python Bootcamp From Zero to Hero', 'Learn Python like a Professional Start from the basics and go all the way to creating your own applications and games', 'Course 1', '61ae0f7abf646.jpg', '1.0', '2021-12-06 18:56:18', '2021-12-06 23:23:29', '61952d7816277', '61952d7816277', 0),
('61ae0f9e103d7', '61ae0b7228135', 'Machine Learning A-Z™: Hands-On Python & R In Data', 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', 'Course 2', '61ae0f9e103d7.jpg', '2.0', '2021-12-06 18:56:54', '2021-12-06 23:23:39', '61952d7816277', '61952d7816277', 0),
('61ae1000549e3', '61ae0b7b8ca42', 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', 'Learn how to use NumPy, Pandas, Seaborn , Matplotlib , Plotly , Scikit-Learn , Machine Learning, Tensorflow , and more!', 'Course 3', '61ae1000549e3.jpg', '3.0', '2021-12-06 18:58:32', '2021-12-06 23:23:48', '61952d7816277', '61952d7816277', 0),
('61ae1027e738a', '61ae0b82ec211', '100 Days of Code: The Complete Python Pro Bootcamp for 2022', 'This Python For Beginners Course Teaches You The Python Language Fast. Includes Python Online Training With Python 3', 'Cource 4', '61ae1027e738a.jpg', '4.0', '2021-12-06 18:59:11', '2021-12-06 23:23:57', '61952d7816277', '61952d7816277', 0),
('61ae105cb949a', '61ae0b8b3f476', 'Learning Python for Data Analysis and Visualization', 'Learn python and how to use it to analyze,visualize and present data. Includes tons of sample code and hours of video!', 'Course 5', '61ae105cb949a.jpg', '5.0', '2021-12-06 19:00:04', '2021-12-06 19:00:04', '61952d7816277', '61952d7816277', 0),
('61ae10ac70735', '61ae0b977d08e', 'Python for Data Structures, Algorithms, and Interviews!', 'Get a kick start on your career and ace your coding interviews!', 'Course 6', '61ae10ac70735.jpg', '4.2', '2021-12-06 19:01:24', '2021-12-06 23:24:10', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'userpic.png',
  `password` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `mobile_no`, `profile_pic`, `password`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61adfd8c73697', 'Jimish Gajjar', 'jimish.gajjar@gmail.com', '9737956805', 'userpic.png', 'f3599dba24e40c1ff9367e56b386b87e', '2021-12-06 17:39:48', '2021-12-06 17:39:48', '61adfd8c73696', '61adfd8c73696', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
