-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2022 at 04:35 PM
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
  `course_id` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('61ae0b8b3f476', 'Climbing Induction', 'Climbing Induction', '61ae0b8b3f476.jpg', '2021-12-06 18:39:31', '2022-01-02 14:46:03', '61952d7816277', '61952d7816277', 0),
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
('61ae0f7abf646', '61ae0b26d28c8', '2022 Complete Python Bootcamp From Zero to Hero', 'Learn Python like a Professional Start from the basics and go all the way to creating your own applications and games', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 1', '61ae0f7abf646.jpg', '1.0', '520', '0', '2021-12-06 18:56:18', '2021-12-30 23:16:52', '61952d7816277', '61952d7816277', 0),
('61ae0f9e103d7', '61ae0b7228135', 'Machine Learning A-Z™: Hands-On Python & R In Data', 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 2', '61ae0f9e103d7.jpg', '2.0', '525', '10', '2021-12-06 18:56:54', '2021-12-06 23:23:39', '61952d7816277', '61952d7816277', 0),
('61ae1000549e3', '61ae0b7b8ca42', 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.', 'Learn how to use NumPy, Pandas, Seaborn , Matplotlib , Plotly , Scikit-Learn , Machine Learning, Tensorflow , and more!', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 3', '61ae1000549e3.jpg', '3.0', '525', '0', '2021-12-06 18:58:32', '2022-02-05 00:09:34', '61952d7816277', '61952d7816277', 0),
('61ae1027e738a', '61ae0b82ec211', '100 Days of Code: The Complete Python Pro Bootcamp for 2022', 'This Python For Beginners Course Teaches You The Python Language Fast. Includes Python Online Training With Python 3', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Cource 4', '61ae1027e738a.jpg', '4.0', '525', '10', '2021-12-06 18:59:11', '2021-12-06 23:23:57', '61952d7816277', '61952d7816277', 0),
('61ae105cb949a', '61ae0b8b3f476', 'Learning Python for Data Analysis and Visualization', 'Learn python and how to use it to analyze,visualize and present data. Includes tons of sample code and hours of video!', '<p>This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain understanding how to deploy, use, and maintain your applications on Kubernetes. If you are into DevOps, this is a technology you need to master. Kubernetes has gained a lot of popularity lately and it is a well sought skill by companies.This course will help you to gain und</p><ul><li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li></ul><h3>HEEEEEEEEEEEEEEELO</h3>', 'Course 5', '61ae105cb949a.jpg', '5.0', '525', '0', '2021-12-06 19:00:04', '2021-12-15 22:21:25', '61952d7816277', '61952d7816277', 0),
('61ae10ac70735', '61ae0b977d08e', 'Python for Data Structures, Algorithms, and Interviews!', 'Get a kick start on your career and ace your coding interviews!', '<p>qwqwqwqwwqwqwq</p><p>&nbsp;</p><p><strong>dddddddddddddddddddddddd</strong></p><p>&nbsp;</p><p>&nbsp;</p>', 'Course 6', '61ae10ac70735.jpg', '4.2', '525', '10', '2021-12-06 19:01:24', '2021-12-15 00:30:29', '61952d7816277', '61952d7816277', 0),
('61b8e7615a900', '61ae0b977d08e', 'Django 2.2 & Python | The Ultimate Web Development Bootcamp', 'Build three complete websites, learn back and front-end web development, and publish your site online with DigitalOcean', '<p>Test <strong>1</strong>1<strong>1</strong>1 Hello</p><h2>123</h2><p>&nbsp;</p><p><a href=\"jimishgajjar.in\">jimishgajjar.in</a></p>', '123,456,789', '61b8e7615a900.jpg', '0.0', '525', '0', '2021-12-15 00:20:09', '2021-12-15 00:25:14', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_chapter`
--

CREATE TABLE `course_chapter` (
  `id` varchar(255) NOT NULL,
  `position_order` tinyint(4) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `chapter_title` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_chapter`
--

INSERT INTO `course_chapter` (`id`, `position_order`, `course_id`, `chapter_title`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('6205fc62111de', 1, '61ae0f7abf646', 'Chapter 1 ', '2022-02-11 11:34:18', '2022-02-14 23:41:42', '61952d7816277', '61952d7816277', 0),
('62062ab05a056', 2, '61ae0f7abf646', 'Chapter 2', '2022-02-11 14:51:52', '2022-02-11 22:18:05', '61952d7816277', '61952d7816277', 0),
('620637caea634', 1, '61ae0f9e103d7', 'Chapter 1', '2022-02-11 15:47:46', '2022-02-11 15:47:46', '61952d7816277', '61952d7816277', 0),
('621101955573a', 0, '61ae1000549e3', 'Chapter 1', '2022-02-19 20:11:25', '2022-02-19 20:11:25', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_content`
--

CREATE TABLE `course_content` (
  `id` varchar(255) NOT NULL,
  `position_order` tinyint(4) NOT NULL,
  `chapter_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `doc_title` text NOT NULL,
  `document_path` text NOT NULL,
  `is_trailer` varchar(20) NOT NULL DEFAULT 'false',
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_content`
--

INSERT INTO `course_content` (`id`, `position_order`, `chapter_id`, `course_id`, `doc_title`, `document_path`, `is_trailer`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('6205fc62160fd', 1, '6205fc62111de', '61ae0f7abf646', 'Chapter 1 Video 1', '61ae0f7abf646_6205fc62111de_6205fc62160fd.mp4', 'true', '2022-02-11 11:34:18', '2022-02-18 19:55:07', '61952d7816277', '61952d7816277', 0),
('62060135f12db', 2, '6205fc62111de', '61ae0f7abf646', 'Chapter 1 Video 2', '61ae0f7abf646_6205fc62111de_62060135f12db.mp4', 'false', '2022-02-11 11:54:53', '2022-02-18 19:54:57', '61952d7816277', '61952d7816277', 0),
('620601e515a70', 3, '6205fc62111de', '61ae0f7abf646', 'Chapter 1 Video 3', '61ae0f7abf646_6205fc62111de_620601e515a70.mp4', 'true', '2022-02-11 11:57:49', '2022-02-18 19:55:08', '61952d7816277', '61952d7816277', 0),
('62062ab05ac34', 1, '62062ab05a056', '61ae0f7abf646', 'Chapter 2 Video 1', '61ae0f7abf646_62062ab05a056_62062ab05ac34.mp4', 'false', '2022-02-11 14:51:52', '2022-02-11 14:51:52', '61952d7816277', '61952d7816277', 0),
('62062ab05dee9', 2, '62062ab05a056', '61ae0f7abf646', 'Chapter 2 Video 2', '61ae0f7abf646_62062ab05a056_62062ab05dee9.mp4', 'false', '2022-02-11 14:51:52', '2022-02-11 14:51:52', '61952d7816277', '61952d7816277', 0),
('620637caee7e4', 1, '620637caea634', '61ae0f9e103d7', 'Chapter 1 Video 1', '61ae0f9e103d7_620637caea634_620637caee7e4.mp4', 'false', '2022-02-11 15:47:47', '2022-02-11 15:47:47', '61952d7816277', '61952d7816277', 0),
('620637cb0d94e', 2, '620637caea634', '61ae0f9e103d7', 'Chapter 1 Video 2', '61ae0f9e103d7_620637caea634_620637cb0d94e.mp4', 'false', '2022-02-11 15:47:47', '2022-02-11 15:47:47', '61952d7816277', '61952d7816277', 0),
('620693453ed99', 3, '62062ab05a056', '61ae0f7abf646', 'Pdf Document', '61ae0f7abf646_62062ab05a056_620693453ed99.pdf', 'false', '2022-02-11 22:18:05', '2022-02-11 22:18:05', '61952d7816277', '61952d7816277', 0),
('620a9b5e998c6', 4, '6205fc62111de', '61ae0f7abf646', 'Test Video', '61ae0f7abf646_6205fc62111de_620a9b5e998c6.mp4', 'false', '2022-02-14 23:41:42', '2022-02-18 19:55:02', '61952d7816277', '61952d7816277', 0),
('6211019556269', 0, '621101955573a', '61ae1000549e3', 'Learn to create Machine Video 1', '61ae1000549e3_621101955573a_6211019556269.mp4', 'false', '2022-02-19 20:11:25', '2022-02-19 20:11:25', '61952d7816277', '61952d7816277', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_progress`
--

CREATE TABLE `course_progress` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `chapter_id` varchar(255) NOT NULL,
  `content_id` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_progress`
--

INSERT INTO `course_progress` (`id`, `user_id`, `course_id`, `chapter_id`, `content_id`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('6210f3b82e5b3', '61adfd8c73697', '61ae0f7abf646', '6205fc62111de', '6205fc62160fd', '2022-02-19 19:12:16', '2022-02-19 19:12:16', '61adfd8c73697', '61adfd8c73697', 0),
('6210f3ccb97ad', '61adfd8c73697', '61ae0f7abf646', '6205fc62111de', '62060135f12db', '2022-02-19 19:12:36', '2022-02-19 19:12:36', '61adfd8c73697', '61adfd8c73697', 0),
('6210f3ff4ff25', '61adfd8c73697', '61ae0f7abf646', '6205fc62111de', '620601e515a70', '2022-02-19 19:13:27', '2022-02-19 19:13:27', '61adfd8c73697', '61adfd8c73697', 0),
('6210f5b757887', '61adfd8c73697', '61ae0f7abf646', '6205fc62111de', '620a9b5e998c6', '2022-02-19 19:20:47', '2022-02-19 19:20:47', '61adfd8c73697', '61adfd8c73697', 0),
('6210f614c14c4', '61adfd8c73697', '61ae0f7abf646', '62062ab05a056', '62062ab05ac34', '2022-02-19 19:22:20', '2022-02-19 19:22:20', '61adfd8c73697', '61adfd8c73697', 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_progress_user`
--

CREATE TABLE `course_progress_user` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `course_percentage` varchar(10) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course_review`
--

CREATE TABLE `course_review` (
  `id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_review`
--

INSERT INTO `course_review` (`id`, `course_id`, `user_id`, `rating`, `title`, `description`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('62066e181c807', '61ae0f9e103d7', '61adfd8c73697', '4', 'Nice course', 'I learn a lot from this course', '2022-02-11 19:39:28', '2022-02-11 19:39:28', '61adfd8c73697', '61adfd8c73697', 0),
('6206a003055a6', '61ae0f7abf646', '61adfd8c73697', '3', 'Nice Course For Beginners', 'Learn something new from this course you should buy this course.', '2022-02-11 23:12:27', '2022-02-11 23:13:05', '61adfd8c73697', '61adfd8c73697', 0),
('6206a00306530', '61ae0f7abf646', '61adfd8c73697', '2', 'Nice Course', 'Learn something new from this course', '2022-02-11 23:12:27', '2022-02-11 23:12:27', '61adfd8c73697', '61adfd8c73697', 0),
('6206a0290241f', '61ae0f7abf646', '61adfd8c73697', '3', 'Nice Course For Beginners', 'Learn something new from this course you should buy this course.', '2022-02-11 23:13:05', '2022-02-11 23:13:05', '61adfd8c73697', '61adfd8c73697', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `transection_id` varchar(255) NOT NULL,
  `transection_status` varchar(255) NOT NULL,
  `transection_date` datetime NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `user_id`, `transection_id`, `transection_status`, `transection_date`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61f1908fbdb2d', '61adfd8c73697', 'Test Demo', 'Complete', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '61adfd8c73697', '61adfd8c73697', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sorting_items`
--

CREATE TABLE `sorting_items` (
  `id` int(10) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `position_order` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sorting_items`
--

INSERT INTO `sorting_items` (`id`, `title`, `description`, `position_order`) VALUES
(7, 'Test 1', 'Test 1 Description', 4),
(8, 'Test 2', 'Test 2 Description', 5),
(9, 'Test 3', 'Test 3 Description', 3),
(10, 'Test 4', 'Test 4 Description', 2),
(11, 'Test 5', 'Test 5 Description', 1);

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
('61adfd8c73697', 'Jimish Gajjar', 'jimish.gajjar@gmail.com', '9737956805', '61adfd8c73697.png', '1.3', '65', '24', 'Male', 'f3599dba24e40c1ff9367e56b386b87e', 'NOT SET', 0, '2021-12-06 17:39:48', '2021-12-06 17:39:48', '61adfd8c73696', '61adfd8c73696', 0),
('61ae56262a7cd', 'Parth Nayi', 'parthnayi786@gmail.com', '9409354805', 'userprofile.png', '5.5', '65', '24', 'Male', '04788c4f5295bc48719eb9d8d3dec40d', 'NOT SET', 0, '2021-12-06 23:57:50', '2021-12-06 23:57:50', '61ae56262a7cb', '61ae56262a7cb', 0),
('61c357ec53a61', 'Nikunj Panchal', 'nikunj@gmail.com', '1234567899', 'userprofile.png', '6', '6', '23', 'Male', 'e6422e3c2a047e9537107e84c325aad1', 'NOT SET', 0, '2021-12-22 22:23:00', '2021-12-22 22:23:00', '61c357ec53a60', '61c357ec53a60', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--

CREATE TABLE `user_courses` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `course_amount` varchar(255) NOT NULL,
  `discount_given` varchar(255) NOT NULL,
  `final_amount` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`id`, `user_id`, `course_id`, `course_amount`, `discount_given`, `final_amount`, `payment_id`, `payment_date`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('61f1908fc9623', '61adfd8c73697', '61ae0f7abf646', '520', '0', '520', '61f1908fbdb2d', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '61adfd8c73697', '61adfd8c73697', 0),
('61f1908fd8abe', '61adfd8c73697', '61ae1000549e3', '525', '0', '525', '61f1908fbdb2d', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '61adfd8c73697', '61adfd8c73697', 0),
('61f1908fe7cfe', '61adfd8c73697', '61ae0f9e103d7', '525', '52.5', '472.5', '61f1908fbdb2d', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '2022-01-26 23:48:55', '61adfd8c73697', '61adfd8c73697', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `course_id`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('62077e0e7a098', '61adfd8c73697', '61ae10ac70735', '2022-02-12 14:59:50', '2022-02-12 14:59:50', '61adfd8c73697', '61adfd8c73697', 0);

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
-- Indexes for table `course_chapter`
--
ALTER TABLE `course_chapter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_content`
--
ALTER TABLE `course_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_progress`
--
ALTER TABLE `course_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_progress_user`
--
ALTER TABLE `course_progress_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_review`
--
ALTER TABLE `course_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sorting_items`
--
ALTER TABLE `sorting_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_no` (`mobile_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sorting_items`
--
ALTER TABLE `sorting_items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
