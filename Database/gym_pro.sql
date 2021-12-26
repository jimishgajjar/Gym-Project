-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 07:33 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `cource_id` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `user_ip`, `cource_id`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61be2e69df252', '61adfd8c73697', '127.0.0.1', '61ae0f7abf646', '2021-12-19 00:24:33', '2021-12-19 00:24:33', '61adfd8c73697', '61adfd8c73697', 0),
('61be422407631', '', '127.0.0.1', '61ae0f7abf646', '2021-12-19 01:48:44', '2021-12-19 01:48:44', '127.0.0.1', '127.0.0.1', 0),
('61c72a92f057b', '', '127.0.0.1', '61ae1000549e3', '2021-12-25 19:58:34', '2021-12-25 19:58:34', '127.0.0.1', '127.0.0.1', 0),
('61c7320568ab2', '', '127.0.0.1', '61ae0f9e103d7', '2021-12-25 20:30:21', '2021-12-25 20:30:21', '127.0.0.1', '127.0.0.1', 0),
('61c8b4613d611', '61adfd8c73697', '127.0.0.1', '61ae0f7abf646', '2021-12-26 23:58:49', '2021-12-26 23:58:49', '61adfd8c73697', '61adfd8c73697', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` varchar(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` text NOT NULL,
  `category_img` text NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_description`, `category_img`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61ae0b26d28c8', 'GRIT STRENGTH', 'GRIT STRENGTH', '61ae0b26d28c8.jpg', '2021-12-06 18:37:50', '2021-12-06 18:37:50', '61952d7816277', '61952d7816277', 0),
('61ae0b7228135', 'ZUMBA ATHLETIC', 'ZUMBA ATHLETIC', '61ae0b7228135.jpg', '2021-12-06 18:39:06', '2021-12-06 18:39:06', '61952d7816277', '61952d7816277', 0),
('61ae0b7b8ca42', 'FUSION YOGA', 'FUSION YOGA', '61ae0b7b8ca42.jpg', '2021-12-06 18:39:15', '2021-12-06 18:39:15', '61952d7816277', '61952d7816277', 0),
('61ae0b82ec211', 'Meditation', 'Meditation', '61ae0b82ec211.jpg', '2021-12-06 18:39:22', '2021-12-06 18:39:22', '61952d7816277', '61952d7816277', 0),
('61ae0b8b3f476', 'Climbing Induction', 'Climbing Induction', '61ae0b8b3f476.jpg', '2021-12-06 18:39:31', '2021-12-06 18:39:31', '61952d7816277', '61952d7816277', 0),
('61ae0b977d08e', 'Punch Boxing', 'Punch Boxing', '61ae0b977d08e.jpg', '2021-12-06 18:39:43', '2021-12-06 18:39:43', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `small_description` text NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `thumbnail` text NOT NULL,
  `rating` varchar(10) NOT NULL DEFAULT '0.0',
  `price` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `category_id`, `title`, `small_description`, `description`, `tags`, `thumbnail`, `rating`, `price`, `discount`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61ae0f7abf646', '61ae0b26d28c8', '2022 Complete Python Bootcamp From Zero to Hero', 'Learn Python like a Professional Start from the basics and go all the way to creating your own applications and games', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 1', '61ae0f7abf646.jpg', '1.0', '525', '0', '2021-12-06 18:56:18', '2021-12-06 23:23:29', '61952d7816277', '61952d7816277', 0),
('61ae0f9e103d7', '61ae0b7228135', 'Machine Learning A-Z™: Hands-On Python & R In Data', 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 2', '61ae0f9e103d7.jpg', '2.0', '525', '10', '2021-12-06 18:56:54', '2021-12-06 23:23:39', '61952d7816277', '61952d7816277', 0),
('61ae1000549e3', '61ae0b7b8ca42', 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', 'Learn how to use NumPy, Pandas, Seaborn , Matplotlib , Plotly , Scikit-Learn , Machine Learning, Tensorflow , and more!', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 3', '61ae1000549e3.jpg', '3.0', '525', '0', '2021-12-06 18:58:32', '2021-12-06 23:23:48', '61952d7816277', '61952d7816277', 0),
('61ae1027e738a', '61ae0b82ec211', '100 Days of Code: The Complete Python Pro Bootcamp for 2022', 'This Python For Beginners Course Teaches You The Python Language Fast. Includes Python Online Training With Python 3', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Cource 4', '61ae1027e738a.jpg', '4.0', '525', '10', '2021-12-06 18:59:11', '2021-12-06 23:23:57', '61952d7816277', '61952d7816277', 0),
('61ae105cb949a', '61ae0b8b3f476', 'Learning Python for Data Analysis and Visualization', 'Learn python and how to use it to analyze,visualize and present data. Includes tons of sample code and hours of video!', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 5', '61ae105cb949a.jpg', '5.0', '525', '0', '2021-12-06 19:00:04', '2021-12-15 22:21:25', '61952d7816277', '61952d7816277', 0),
('61ae10ac70735', '61ae0b977d08e', 'Python for Data Structures, Algorithms, and Interviews!', 'Get a kick start on your career and ace your coding interviews!', '<p>qwqwqwqwwqwqwq</p><p>&nbsp;</p><p><strong>dddddddddddddddddddddddd</strong></p><p>&nbsp;</p><p>&nbsp;</p>', 'Course 6', '61ae10ac70735.jpg', '4.2', '525', '10', '2021-12-06 19:01:24', '2021-12-15 00:30:29', '61952d7816277', '61952d7816277', 0),
('61b8e7615a900', '61ae0b977d08e', 'Django 2.2 & Python | The Ultimate Web Development Bootcamp', 'Build three complete websites, learn back and front-end web development, and publish your site online with DigitalOcean', '<p>Test <strong>1</strong>1<strong>1</strong>1 Hello</p><h2>123</h2><p>&nbsp;</p><p><a href=\"jimishgajjar.in\">jimishgajjar.in</a></p>', '123,456,789', '61b8e7615a900.jpg', '0.0', '525', '0', '2021-12-15 00:20:09', '2021-12-15 00:25:14', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_review`
--

CREATE TABLE `course_review` (
  `id` varchar(255) NOT NULL,
  `cource_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `review` text NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `age` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_key` varchar(255) NOT NULL,
  `reset_status` tinyint(4) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `mobile_no`, `profile_pic`, `height`, `weight`, `age`, `gender`, `password`, `reset_key`, `reset_status`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61adfd8c73697', 'Jimish Gajjar', 'jimish.gajjar@gmail.com', '9737956805', 'userpic.png', '5.5', '65', '24', 'Male', 'f3599dba24e40c1ff9367e56b386b87e', 'NOT SET', 0, '2021-12-06 17:39:48', '2021-12-06 17:39:48', '61adfd8c73696', '61adfd8c73696', 0),
('61ae56262a7cd', 'Parth Nayi', 'parthnayi786@gmail.com', '9409354805', 'userpic.png', '5.5', '65', '24', 'Male', '04788c4f5295bc48719eb9d8d3dec40d', 'NOT SET', 0, '2021-12-06 23:57:50', '2021-12-06 23:57:50', '61ae56262a7cb', '61ae56262a7cb', 0),
('61c357ec53a61', 'Nikunj Panchal', 'nikunj@gmail.com', '1234567899', 'userpic.png', '6', '6', '23', 'Male', 'e6422e3c2a047e9537107e84c325aad1', 'NOT SET', 0, '2021-12-22 22:23:00', '2021-12-22 22:23:00', '61c357ec53a60', '61c357ec53a60', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `cource_id` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `cource_id`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61c73f01ea397', '61adfd8c73697', '61ae0f7abf646', '2021-12-25 21:25:45', '2021-12-25 21:25:45', '61adfd8c73697', '61adfd8c73697', 0),
('61c73f086c82b', '61adfd8c73697', '61ae0f9e103d7', '2021-12-25 21:25:52', '2021-12-25 21:25:52', '61adfd8c73697', '61adfd8c73697', 0),
('61c73f215c8d8', '61adfd8c73697', '61ae1000549e3', '2021-12-25 21:26:17', '2021-12-25 21:26:17', '61adfd8c73697', '61adfd8c73697', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
-- Indexes for table `course_review`
--
ALTER TABLE `course_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
