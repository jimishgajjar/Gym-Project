-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 03:25 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
('6235d6a89e4a3', 'GRIT STRENGTH', 'We have heap of fun piece of equi to build down every inh of your for body.', '6235d6a89e4a3.jpg', '2022-03-19 18:42:08', '2022-03-19 18:44:26', '61952d7816277', '61952d7816277', 0),
('6235d6bea9eb1', 'ZUMBA ATHLETIC', 'We have heap of fun piece of equi to build down every inh of your for body.', '6235d6bea9eb1.jpg', '2022-03-19 18:42:30', '2022-03-19 18:44:37', '61952d7816277', '61952d7816277', 0);

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
  `is_active` text NOT NULL DEFAULT 'true',
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `category_id`, `title`, `small_description`, `description`, `tags`, `thumbnail`, `rating`, `price`, `discount`, `is_active`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('6235ebae7a861', '6235d6a89e4a3', 'Learn Python: The Complete Python Programming Course', 'Learn A-Z everything about Python, from the basics, to advanced topics like Python GUI, Python Data Analysis, and more!', '&lt;h4&gt;Requirements&lt;/h4&gt;&lt;ol&gt;&lt;li&gt;Macintosh (OSX)/ Windows(Vista and higher) Machine&lt;/li&gt;&lt;li&gt;Internet Connection&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;strong&gt;Do you want to become a programmer? Do you want to learn how to create games, automate your browser, visualize data, and much more?&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;If you’re looking to learn Python for the very &lt;strong&gt;first time&lt;/strong&gt; or need a &lt;strong&gt;quick brush-up&lt;/strong&gt;, this is the course for you!&lt;/p&gt;&lt;p&gt;Python has rapidly become one of the &lt;strong&gt;most popular programming languages &lt;/strong&gt;around the world. Compared to other languages such as Java or C++, Python consistently outranks and outperforms these languages in demand from businesses and job availability. The average Python developer makes &lt;strong&gt;over $100,000 &lt;/strong&gt;- this number is only going to grow in the coming years.&lt;/p&gt;&lt;p&gt;The best part? Python is one of the &lt;strong&gt;easiest coding languages &lt;/strong&gt;to learn right now. It doesn’t matter if you have no programming experience or are unfamiliar with the syntax of Python. By the time you finish this course, you&#039;ll be an &lt;strong&gt;absolute pro&lt;/strong&gt; at programming!&lt;/p&gt;&lt;p&gt;This course will cover &lt;strong&gt;all the basics&lt;/strong&gt; and &lt;strong&gt;several advanced concepts&lt;/strong&gt; of Python. We’ll go over:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;The fundamentals of Python programming&lt;/li&gt;&lt;li&gt;Writing and Reading to Files&lt;/li&gt;&lt;li&gt;Automation of Word and Excel Files&lt;/li&gt;&lt;li&gt;Web scraping with BeautifulSoup4&lt;/li&gt;&lt;li&gt;Browser automation with Selenium&lt;/li&gt;&lt;li&gt;Data Analysis and Visualization with MatPlotLib&lt;/li&gt;&lt;li&gt;Regex parsing and Task Management&lt;/li&gt;&lt;li&gt;GUI and Gaming with Tkinter&lt;/li&gt;&lt;li&gt;And much more!&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;If you read the above list and are feeling a bit confused, don’t worry! As an instructor and student on Udemy for &lt;strong&gt;almost 4 years,&lt;/strong&gt; I know what it’s like to be overwhelmed with boring and mundane. I promise you’ll have a blast learning the ins and outs of python. I’ve successfully taught over&lt;strong&gt; 200,000+ students &lt;/strong&gt;from over&lt;strong&gt; 200 countries&lt;/strong&gt; jumpstart their programming journeys through my courses.&lt;/p&gt;&lt;p&gt;Here’s what some of my students have to say:&lt;/p&gt;&lt;ul&gt;&lt;li&gt;“I wish I started programming at a younger age like Avi. &amp;nbsp;This Python course was excellent for those that cringe at the thought of starting over from scratch with attempts to write programs once again. Python is a great building language for any beginner programmer. Thank you Avi!”&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;“I had no idea about any programming language. With Avi&#039;s lectures, I&#039;m now aware of several python concepts and I&#039;m beginning to write my own programs. Avi is crisp and clear in his lectures and it is easy to catch the concepts and the depth of it through his explanations. Thanks, Avi for the wonderful course, You&#039;re awesome! It&#039;s helping me a lot :)”&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;ul&gt;&lt;li&gt;&quot;Videos are short and concise and well-defined in their title, this makes them easy to refer back to when a refresher is needed. Explanations aren&#039;t convoluted with complicated examples, which adds to the quick pace of the videos. I am very pleased with the decision to enroll in this course. Not only has it increased the pace I&#039;m learning Python but I actively look forward to continuing the course, whenever I get the chance. Avi is friendly and energetic, absolutely delightful as an instructor.”&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;So what are you waiting for? &lt;strong&gt;Jumpstart your programming journey&lt;/strong&gt; and dive into the world of Python by&lt;strong&gt; enrolling in this course today!&lt;/strong&gt;&lt;/p&gt;&lt;h4&gt;Who this course is for:&lt;/h4&gt;&lt;ol&gt;&lt;li&gt;Even if you haven&#039;t touched coding before, it won&#039;t matter. The easy step-to-step lectures will quickly guide you through everything you&#039;ll need to know about coding, mainly Python. This course is here for you to get accustomed and familiar with Python and its syntax. And above all, Python is one of the easiest coding languages to learn, and there&#039;s a lot you can do with it.&lt;/li&gt;&lt;/ol&gt;', 'Python,Python Complete Course', '6235ebae7a861.jpg', '3', '1000', '40', 'true', '2022-03-19 20:11:50', '2022-03-22 12:14:33', '61952d7816277', '61952d7816277', 0),
('6236063647e2f', '6235d6bea9eb1', 'Learning Python for Data Analysis and Visualization', 'Learn python and how to use it to analyze,visualize and present data. Includes tons of sample code and hours of video!', '&lt;h4&gt;Requirements&lt;/h4&gt;&lt;p&gt;Basic math skills.&lt;/p&gt;&lt;p&gt;Basic to Intermediate Python Skills&lt;/p&gt;&lt;p&gt;Have a computer (either Mac, Windows, or Linux)&lt;/p&gt;&lt;p&gt;Desire to learn!&lt;/p&gt;&lt;h4&gt;Description&lt;/h4&gt;&lt;p&gt;&lt;strong&gt;PLEASE&amp;nbsp;READ&amp;nbsp;BEFORE&amp;nbsp;ENROLLING:&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;1.)&amp;nbsp;THERE&amp;nbsp;IS&amp;nbsp;AN&amp;nbsp;UPDATED&amp;nbsp;VERSION&amp;nbsp;OF&amp;nbsp;THIS&amp;nbsp;COURSE:&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&quot;PYTHON&amp;nbsp;FOR&amp;nbsp;DATA&amp;nbsp;SCIENCE&amp;nbsp;AND&amp;nbsp;MACHINE&amp;nbsp;LEARNING BOOTCAMP&quot;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;2.)&amp;nbsp;IF YOU ARE A COMPLETE BEGINNER IN PYTHON-CHECK OUT MY OTHER COURSE &quot;COMPLETE&amp;nbsp;PYTHON&amp;nbsp;MASTERCLASS&amp;nbsp;JOURNEY&quot;!&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;CLICK&amp;nbsp;ON&amp;nbsp;MY&amp;nbsp;PROFILE&amp;nbsp;TO&amp;nbsp;FIND&amp;nbsp;IT. (PLEASE&amp;nbsp;WATCH&amp;nbsp;THE&amp;nbsp;FIRST&amp;nbsp;PROMO&amp;nbsp;VIDEO&amp;nbsp;ON&amp;nbsp;THIS&amp;nbsp;PAGE&amp;nbsp;FOR&amp;nbsp;MORE&amp;nbsp;INFO)&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;**********************************************************************************************************&lt;/p&gt;&lt;p&gt;&lt;strong&gt;This course will give you the resources to learn python and effectively use it analyze and visualize data! Start your career in Data Science!&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; You&#039;ll get a full understanding of how to program with Python and how to use it in conjunction with scientific computing modules and libraries to analyze data.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp; You will also get lifetime access to over 100 example python code notebooks, new and updated videos, as well as future additions of various data analysis projects that you can use for a portfolio to show future employers!&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; By the end of this course you will:&amp;nbsp;&lt;/p&gt;&lt;ol&gt;&lt;li&gt;Have an understanding of how to program in Python.&lt;/li&gt;&lt;li&gt;Know how to create and manipulate arrays using numpy and Python.&lt;/li&gt;&lt;li&gt;Know how to use pandas to create and analyze data sets.&lt;/li&gt;&lt;li&gt;Know how to use matplotlib and seaborn libraries to create beautiful data visualization.&lt;/li&gt;&lt;li&gt;Have an amazing portfolio of example python data analysis projects!&lt;/li&gt;&lt;li&gt;Have an understanding of Machine Learning and SciKit Learn!&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&amp;nbsp; With 100+ lectures and over 20 hours of information and more than 100 example python code notebooks, you will be excellently prepared for a future in data science!&amp;nbsp;&lt;/p&gt;&lt;h4&gt;Who this course is for:&lt;/h4&gt;&lt;ul&gt;&lt;li&gt;Anyone interested in learning more about python, data science, or data visualizations.&lt;/li&gt;&lt;li&gt;Anyone interested about the rapidly expanding world of data science!&lt;/li&gt;&lt;/ul&gt;', 'Data Analysis', '6236063647e2f.jpg', '0', '1400', '50', 'false', '2022-03-19 22:05:02', '2022-03-22 12:14:39', '61952d7816277', '61952d7816277', 0);

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
('6238ac236f1aa', 0, '6235ebae7a861', 'Up and Running With Python', '2022-03-21 22:17:31', '2022-03-21 22:22:22', '61952d7816277', '61952d7816277', 0),
('6238ac7f9204f', 0, '6235ebae7a861', 'The Basics (Data Types)', '2022-03-21 22:19:03', '2022-03-21 22:19:03', '61952d7816277', '61952d7816277', 0);

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
('6238ac2373e56', 0, '6238ac236f1aa', '6235ebae7a861', 'Installing Python', '6235ebae7a861_6238ac236f1aa_6238ac2373e56.mp4', 'true', '2022-03-21 22:17:31', '2022-03-21 22:22:43', '61952d7816277', '61952d7816277', 0),
('6238ac2384658', 0, '6238ac236f1aa', '6235ebae7a861', 'Hello World', '6235ebae7a861_6238ac236f1aa_6238ac2384658.pdf', 'false', '2022-03-21 22:17:31', '2022-03-21 22:17:43', '61952d7816277', '61952d7816277', 0),
('6238ac7f9632b', 0, '6238ac7f9204f', '6235ebae7a861', 'Data Types and Ints', '6235ebae7a861_6238ac7f9204f_6238ac7f9632b.mp4', 'false', '2022-03-21 22:19:03', '2022-03-21 22:19:03', '61952d7816277', '61952d7816277', 0),
('6238ac7f9a344', 0, '6238ac7f9204f', '6235ebae7a861', 'Dictionary Functions', '6235ebae7a861_6238ac7f9204f_6238ac7f9a344.pdf', 'false', '2022-03-21 22:19:03', '2022-03-21 22:19:03', '61952d7816277', '61952d7816277', 0),
('6238ad4667e52', 0, '6238ac236f1aa', '6235ebae7a861', 'Classes! (Object Orientated Programming)', '6235ebae7a861_6238ac236f1aa_6238ad4667e52.mp4', 'false', '2022-03-21 22:22:22', '2022-03-21 22:22:22', '61952d7816277', '61952d7816277', 0);

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
('6238af154ca04', '6235ebae7a861', '6235e06d10799', '5', 'Nice Course', 'This is the most useful topic by udemy.', '2022-03-21 22:30:05', '2022-03-22 00:32:44', '6235e06d10799', '6235e06d10799', 0),
('6238c473420b9', '6235ebae7a861', '6238bcd658e74', '3', 'Superb Course', 'Explanation was very clear.', '2022-03-22 00:01:15', '2022-03-22 00:01:30', '6238bcd658e74', '6238bcd658e74', 0),
('6238c4da6d25c', '6235ebae7a861', '6238c4ac5a995', '1', 'Average Course', 'Not recomanded for biginers', '2022-03-22 00:02:58', '2022-03-22 00:02:58', '6238c4ac5a995', '6238c4ac5a995', 0),
('6238c561b02ef', '6235ebae7a861', '6238c519116b3', '3', 'Most buy course', 'Amazing course for beginer..', '2022-03-22 00:05:13', '2022-03-22 00:05:13', '6238c519116b3', '6238c519116b3', 0);

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
('6238ad85cea99', '6235e06d10799', 'Test Demo', 'Complete', '2022-03-21 22:23:25', '2022-03-21 22:23:25', '2022-03-21 22:23:25', '6235e06d10799', '6235e06d10799', 0),
('6238c457ac5ba', '6238bcd658e74', 'Test Demo', 'Complete', '2022-03-22 00:00:47', '2022-03-22 00:00:47', '2022-03-22 00:00:47', '6238bcd658e74', '6238bcd658e74', 0),
('6238c4bef2231', '6238c4ac5a995', 'Test Demo', 'Complete', '2022-03-22 00:02:30', '2022-03-22 00:02:30', '2022-03-22 00:02:30', '6238c4ac5a995', '6238c4ac5a995', 0),
('6238c53581567', '6238c519116b3', 'Test Demo', 'Complete', '2022-03-22 00:04:29', '2022-03-22 00:04:29', '2022-03-22 00:04:29', '6238c519116b3', '6238c519116b3', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'userprofile.png',
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
('6235e06d10799', 'Jimish Gajjar', 'jimish.gajjar@gmail.com', '9737956805', 'userprofile.png', '5.5', '55', '24', 'Male', 'f3599dba24e40c1ff9367e56b386b87e', 'NOT SET', 0, '2022-03-19 19:23:49', '2022-03-19 19:23:49', '6235e06d10799', '6235e06d10799', 0),
('6238bcd658e74', 'Raj Bhavsar', 'raj@gmail.com', '8401278551', 'userprofile.png', '5.7', '60', '25', 'Male', '65a1223dae83b8092c4edba0823a793c', 'NOT SET', 0, '2022-03-21 23:28:46', '2022-03-21 23:28:46', '6238bcd658e74', '6238bcd658e74', 0),
('6238c4ac5a995', 'Nikunj Pachal', 'nikunj@gmail.com', '1234567982', 'userprofile.png', '5.4', '60', '23', 'Male', 'e6422e3c2a047e9537107e84c325aad1', 'NOT SET', 0, '2022-03-22 00:02:12', '2022-03-22 00:02:12', '6238c4ac5a995', '6238c4ac5a995', 0),
('6238c519116b3', 'amit jadvani', 'amit@gmail.com', '4567891231', 'userprofile.png', '5.8', '65', '27', 'Male', '0cb1eb413b8f7cee17701a37a1d74dc3', 'NOT SET', 0, '2022-03-22 00:04:01', '2022-03-22 00:04:01', '6238c519116b3', '6238c519116b3', 0);

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
('6238ad85da0e0', '6235e06d10799', '6235ebae7a861', '1000', '400', '600', '6238ad85cea99', '2022-03-21 22:23:25', '2022-03-21 22:23:25', '2022-03-21 22:23:25', '6235e06d10799', '6235e06d10799', 0),
('6238c457b7925', '6238bcd658e74', '6235ebae7a861', '1000', '400', '600', '6238c457ac5ba', '2022-03-22 00:00:47', '2022-03-22 00:00:47', '2022-03-22 00:00:47', '6238bcd658e74', '6238bcd658e74', 0),
('6238c4bef2fd5', '6238c4ac5a995', '6235ebae7a861', '1000', '400', '600', '6238c4bef2231', '2022-03-22 00:02:30', '2022-03-22 00:02:30', '2022-03-22 00:02:30', '6238c4ac5a995', '6238c4ac5a995', 0),
('6238c5358c859', '6238c519116b3', '6235ebae7a861', '1000', '400', '600', '6238c53581567', '2022-03-22 00:04:29', '2022-03-22 00:04:29', '2022-03-22 00:04:29', '6238c519116b3', '6238c519116b3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE `user_report` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `reg_month` varchar(10) NOT NULL,
  `reg_year` varchar(10) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_user_id` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_report`
--

INSERT INTO `user_report` (`id`, `user_id`, `weight`, `reg_month`, `reg_year`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('6235e06d107b0', '6235e06d10799', '55', '03', '2022', '2022-03-19 19:23:49', '2022-03-19 19:23:49', '6235e06d10799', '6235e06d10799', 0),
('6238bcd658e98', '6238bcd658e74', '60', '03', '2022', '2022-03-21 23:28:46', '2022-03-21 23:28:46', '6238bcd658e74', '6238bcd658e74', 0),
('6238c4ac5a9bc', '6238c4ac5a995', '60', '03', '2022', '2022-03-22 00:02:12', '2022-03-22 00:02:12', '6238c4ac5a995', '6238c4ac5a995', 0),
('6238c519116ca', '6238c519116b3', '65', '03', '2022', '2022-03-22 00:04:01', '2022-03-22 00:04:01', '6238c519116b3', '6238c519116b3', 0);

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
-- Indexes for table `user_report`
--
ALTER TABLE `user_report`
  ADD PRIMARY KEY (`id`);

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
