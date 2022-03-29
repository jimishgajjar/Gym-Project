-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2022 at 08:17 AM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `user_ip`, `course_id`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES
('6241fa2d55587', '6239dcdfda947', '127.0.0.1', '6235ebae7a861', '2022-03-28 23:40:53', '2022-03-28 23:40:53', '6239dcdfda947', '6239dcdfda947', 0),
('6241fa2d59ef4', '6239dcdfda947', '127.0.0.1', '623a17837515f', '2022-03-28 23:40:53', '2022-03-28 23:40:53', '6239dcdfda947', '6239dcdfda947', 0),
('624215478ad9d', '62421547871ab', '127.0.0.1', '6235ebae7a861', '2022-03-29 01:36:31', '2022-03-29 01:36:31', '62421547871ab', '62421547871ab', 0),
('624215478e682', '62421547871ab', '127.0.0.1', '623a17837515f', '2022-03-29 01:36:31', '2022-03-29 01:36:31', '62421547871ab', '62421547871ab', 0),
('624215badf34f', '62420dfead7b8', '127.0.0.1', '6235ebae7a861', '2022-03-29 01:38:26', '2022-03-29 01:38:26', '62420dfead7b8', '62420dfead7b8', 0);

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
('6236063647e2f', '6235d6bea9eb1', 'Learning Python for Data Analysis and Visualization', 'Learn python and how to use it to analyze,visualize and present data. Includes tons of sample code and hours of video!', '&lt;h4&gt;Requirements&lt;/h4&gt;&lt;p&gt;Basic math skills.&lt;/p&gt;&lt;p&gt;Basic to Intermediate Python Skills&lt;/p&gt;&lt;p&gt;Have a computer (either Mac, Windows, or Linux)&lt;/p&gt;&lt;p&gt;Desire to learn!&lt;/p&gt;&lt;h4&gt;Description&lt;/h4&gt;&lt;p&gt;&lt;strong&gt;PLEASE&amp;nbsp;READ&amp;nbsp;BEFORE&amp;nbsp;ENROLLING:&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;1.)&amp;nbsp;THERE&amp;nbsp;IS&amp;nbsp;AN&amp;nbsp;UPDATED&amp;nbsp;VERSION&amp;nbsp;OF&amp;nbsp;THIS&amp;nbsp;COURSE:&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;&quot;PYTHON&amp;nbsp;FOR&amp;nbsp;DATA&amp;nbsp;SCIENCE&amp;nbsp;AND&amp;nbsp;MACHINE&amp;nbsp;LEARNING BOOTCAMP&quot;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;2.)&amp;nbsp;IF YOU ARE A COMPLETE BEGINNER IN PYTHON-CHECK OUT MY OTHER COURSE &quot;COMPLETE&amp;nbsp;PYTHON&amp;nbsp;MASTERCLASS&amp;nbsp;JOURNEY&quot;!&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;CLICK&amp;nbsp;ON&amp;nbsp;MY&amp;nbsp;PROFILE&amp;nbsp;TO&amp;nbsp;FIND&amp;nbsp;IT. (PLEASE&amp;nbsp;WATCH&amp;nbsp;THE&amp;nbsp;FIRST&amp;nbsp;PROMO&amp;nbsp;VIDEO&amp;nbsp;ON&amp;nbsp;THIS&amp;nbsp;PAGE&amp;nbsp;FOR&amp;nbsp;MORE&amp;nbsp;INFO)&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;**********************************************************************************************************&lt;/p&gt;&lt;p&gt;&lt;strong&gt;This course will give you the resources to learn python and effectively use it analyze and visualize data! Start your career in Data Science!&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; You&#039;ll get a full understanding of how to program with Python and how to use it in conjunction with scientific computing modules and libraries to analyze data.&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp; You will also get lifetime access to over 100 example python code notebooks, new and updated videos, as well as future additions of various data analysis projects that you can use for a portfolio to show future employers!&amp;nbsp;&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; By the end of this course you will:&amp;nbsp;&lt;/p&gt;&lt;ol&gt;&lt;li&gt;Have an understanding of how to program in Python.&lt;/li&gt;&lt;li&gt;Know how to create and manipulate arrays using numpy and Python.&lt;/li&gt;&lt;li&gt;Know how to use pandas to create and analyze data sets.&lt;/li&gt;&lt;li&gt;Know how to use matplotlib and seaborn libraries to create beautiful data visualization.&lt;/li&gt;&lt;li&gt;Have an amazing portfolio of example python data analysis projects!&lt;/li&gt;&lt;li&gt;Have an understanding of Machine Learning and SciKit Learn!&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&amp;nbsp; With 100+ lectures and over 20 hours of information and more than 100 example python code notebooks, you will be excellently prepared for a future in data science!&amp;nbsp;&lt;/p&gt;&lt;h4&gt;Who this course is for:&lt;/h4&gt;&lt;ul&gt;&lt;li&gt;Anyone interested in learning more about python, data science, or data visualizations.&lt;/li&gt;&lt;li&gt;Anyone interested about the rapidly expanding world of data science!&lt;/li&gt;&lt;/ul&gt;', 'Data Analysis', '6236063647e2f.jpg', '0', '1400', '50', 'false', '2022-03-19 22:05:02', '2022-03-22 12:14:39', '61952d7816277', '61952d7816277', 0),
('623a17837515f', '6235d6bea9eb1', 'Ultimate AWS Certified Developer Associate 2022 - NEW!', 'Full Practice Exam with Explanations included! PASS the Amazon Web Services Certified Developer Certification DVA-C01.', '&lt;p&gt;Know the basics of programming (functions, environment variables, CLI &amp;amp; JSON)&lt;/p&gt;&lt;p&gt;No AWS cloud experience is necessary, we&#039;ll use the AWS Free Tier&lt;/p&gt;&lt;p&gt;Windows / Linux / Mac OS X Machine&lt;/p&gt;&lt;h2&gt;Description&lt;/h2&gt;&lt;p&gt;&lt;strong&gt;Welcome!&amp;nbsp;I&#039;m here to help you prepare and PASS the newest AWS&amp;nbsp;Certified Developer Associate exam.&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;[April 2021 Update]:&lt;/strong&gt; Over 100 videos have been refreshed/added to keep up with the AWS&amp;nbsp;UI changes and exam changes&lt;/p&gt;&lt;p&gt;&lt;strong&gt;[Dec 2020 Update]:&lt;/strong&gt; The S3 section has been entirely re-recorded to accommodate for the AWS&amp;nbsp;UI changes&lt;/p&gt;&lt;p&gt;&lt;strong&gt;[May 2020 Update]:&amp;nbsp;&lt;/strong&gt;Over 200 lectures have been added or refreshed, bringing the course to 29 hours of content, and fully up to date.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;[July 2019 Update]:&lt;/strong&gt;&amp;nbsp;Over 30 lectures added and refreshed (~2h of video)! The course is now up to date on the newest exam topics.&lt;/p&gt;&lt;p&gt;&lt;strong&gt;[Feb 2019 Update]&lt;/strong&gt;:&amp;nbsp;Keeping the course updated!&amp;nbsp;Added full section on ECS (1h15m)&lt;/p&gt;&lt;p&gt;-----------------------------------&lt;/p&gt;&lt;p&gt;&lt;strong&gt;The AWS&amp;nbsp;Certified Developer&amp;nbsp;Associate certification is one of the most challenging exams&lt;/strong&gt;. It&#039;s great at assessing how well you understand not just AWS, but the new cloud paradigms such as Serverless, which makes this certification incredibly valuable to have and pass. Rest assured, &lt;strong&gt;I&#039;ve passed it myself with a score of 984 out of 1000&lt;/strong&gt;. Yes, you read that right, I&amp;nbsp;only made one mistake!&amp;nbsp;Next, &lt;strong&gt;I&amp;nbsp;want to help YOU pass the AWS&amp;nbsp;Certified Developer Associate certification with flying colors&lt;/strong&gt;. No need to know anything about AWS, beginners welcome!&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;i&gt;This is going to be a long journey, but passing the AWS&amp;nbsp;Certified Developer exam will be worth it!&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;This course is different from the other ones you&#039;ll find on Udemy. Dare I say, better (but you&#039;ll judge!)&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;It covers in-depth all the&lt;strong&gt; new topics&lt;/strong&gt; on the AWS&amp;nbsp;Certified Developer Associate DVA-C01 exam&lt;/p&gt;&lt;p&gt;It&#039;s packed with &lt;strong&gt;practical knowledge&lt;/strong&gt; on how to use AWS inside and out as a developer&lt;/p&gt;&lt;p&gt;It teaches you &lt;strong&gt;how to prepare for the AWS&amp;nbsp;exam&lt;/strong&gt; &lt;strong&gt;AND&lt;/strong&gt; &lt;strong&gt;how to prepare for the real world&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;It&#039;s a &lt;strong&gt;logical progression of topics&lt;/strong&gt;, not a laundry list of random services&lt;/p&gt;&lt;p&gt;It&#039;s&lt;strong&gt; fast-paced and to the point&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;It has &lt;strong&gt;professional subtitles&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;All &lt;strong&gt;400+ slides available&lt;/strong&gt; &lt;strong&gt;as downloadable PDF&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Concretely, here&#039;s what we&#039;ll learn to pass the AWS&amp;nbsp;Certified Developer Associate exam:&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;The AWS&amp;nbsp;Fundamentals:&amp;nbsp;IAM, EC2, Load Balancing, Auto Scaling, EBS, Route 53, RDS, ElastiCache, S3&lt;/p&gt;&lt;p&gt;The AWS&amp;nbsp;CLI:&amp;nbsp;CLI setup, usage on EC2, best practices, SDK, advanced usage&lt;/p&gt;&lt;p&gt;Properly deploy an application:&amp;nbsp;AWS&amp;nbsp;Elastic Beanstalk, CICD, CodeCommit, CodePipeline, CodeBuild, CodeDeploy&lt;/p&gt;&lt;p&gt;Infrastructure as code with AWS&amp;nbsp;CloudFormation&lt;/p&gt;&lt;p&gt;Monitoring, Troubleshooting &amp;amp;&amp;nbsp;Audit:&amp;nbsp;AWS&amp;nbsp;CloudWatch, X-Ray, CloudTrail&lt;/p&gt;&lt;p&gt;AWS&amp;nbsp;Integration &amp;amp;&amp;nbsp;Messaging:&amp;nbsp;SQS, SNS, Kinesis&lt;/p&gt;&lt;p&gt;AWS&amp;nbsp;Serverless:&amp;nbsp;AWS&amp;nbsp;Lambda, DynamoDB, API&amp;nbsp;Gateway, Cognito,&amp;nbsp;Serverless Application Model (SAM)&lt;/p&gt;&lt;p&gt;ECS, ECR &amp;amp;&amp;nbsp;Fargate:&amp;nbsp;Docker in&amp;nbsp;AWS&lt;/p&gt;&lt;p&gt;AWS&amp;nbsp;Security best practices:&amp;nbsp;KMS, Encryption SDK, SSM Parameter Store, IAM Policies&lt;/p&gt;&lt;p&gt;AWS&amp;nbsp;Other Services Overview:&amp;nbsp;CloudFront, Step Functions, SWF, Redshift&lt;/p&gt;&lt;p&gt;Tips to ROCK the exam&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;This course is full of opportunities to apply your knowledge:&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;There are many &lt;strong&gt;hands-on lectures&lt;/strong&gt; in every section&lt;/p&gt;&lt;p&gt;There are &lt;strong&gt;quizzes&lt;/strong&gt; at the end of every section&lt;/p&gt;&lt;p&gt;There&#039;s an &lt;strong&gt;AWS&amp;nbsp;Certified Developer Associate practice exam&lt;/strong&gt; at the end of the course&lt;/p&gt;&lt;p&gt;We&#039;ll be using the &lt;strong&gt;AWS&amp;nbsp;Free Tier&lt;/strong&gt; most of the time&lt;/p&gt;&lt;p&gt;I&#039;ll be showing you how to go beyond the AWS&amp;nbsp;Free Tier (you know... the real world!)&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Take a look at these student reviews:&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;5&amp;nbsp;stars:&lt;/strong&gt; &lt;i&gt;&quot;I just passed my AWS&amp;nbsp;Certified Developer Associate exam with 96% and this course was extremely helpful in closing the gaps in my own understanding/experience. It was very easy to follow and informative.&quot; &lt;strong&gt;- Derek C.&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;5&amp;nbsp;stars:&lt;/strong&gt;&amp;nbsp;&quot;&lt;i&gt;This was a perfect match for what I was seeking. It has been about 8 years since I used the AWS cloud frequently (other clouds and hybrids). Seeing a lot of the updates to services with some hands-on has been very helpful.&quot;&lt;strong&gt;– James C.&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;5&amp;nbsp;stars:&lt;/strong&gt; &lt;i&gt;&quot;Course is presented such way in detailed level with great diagram explanation. It&#039;s helped me to clear my AWS&amp;nbsp;Certified Developer Associate DVA-C01 exam successfully with a 92% pass rate&quot; &lt;strong&gt;- Edward K.&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;strong&gt;5&amp;nbsp;stars:&lt;/strong&gt;&lt;i&gt; &quot;This course was very interesting and full of great information and hands-on examples. Stephane did a very good job of assembling it all together and delivers it with so much knowledge and passion.&quot;&lt;/i&gt;&lt;strong&gt;-&lt;/strong&gt; &lt;i&gt;&lt;strong&gt;Abdennour T.&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;-----------------------------------&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Instructor&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;My name is Stephane Maarek, and I&#039;ll be your instructor in this course. I teach about AWS certifications with my focus always on helping my students improve their professional proficiencies in AWS. I am also the author of some of the most highly-rated &amp;amp; best-selling courses on AWS Lambda, AWS CloudFormation &amp;amp; AWS EC2.&lt;/p&gt;&lt;p&gt;Throughout my career in designing and delivering these certifications and courses, I have already taught 1,000,000+ students and gotten 350,000+ reviews!&lt;/p&gt;&lt;p&gt;With AWS becoming much more than a buzzword out there, I&#039;ve decided it&#039;s time for students to properly learn how to be an AWS Developer Associate. So, let’s kick start the course! You are in good hands!&lt;/p&gt;&lt;p&gt;---------------------------------&lt;/p&gt;&lt;p&gt;&lt;strong&gt;This course also comes with:&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;Lifetime access to all future updates&lt;/p&gt;&lt;p&gt;A responsive instructor in the Q&amp;amp;A Section&lt;/p&gt;&lt;p&gt;Udemy Certificate of Completion Ready for Download&lt;/p&gt;&lt;p&gt;A 30 Day &quot;No Questions Asked&quot; Money Back Guarantee!&lt;/p&gt;&lt;p&gt;&lt;strong&gt;Join me in this course if you want to become an AWS Certified Developer Associate and master the AWS platform!&lt;/strong&gt;&lt;/p&gt;&lt;p&gt;&lt;br&gt;&amp;nbsp;&lt;/p&gt;&lt;h2&gt;Who this course is for:&lt;/h2&gt;&lt;ul&gt;&lt;li&gt;Anyone wanting to acquire the knowledge to pass the AWS Certified Developer Associate Certification&lt;/li&gt;&lt;li&gt;Developers who want to upskill themselves and understand how to leverage the AWS Cloud for their applications&lt;/li&gt;&lt;li&gt;Developers who want to get up to speed with best practices on Serverless and AWS Cloud&lt;/li&gt;&lt;/ul&gt;', 'AWS Certified,Developer ', '623a17837515f.jpg', '0', '3499', '80', 'true', '2022-03-23 00:07:55', '2022-03-23 00:07:55', '61952d7816277', '61952d7816277', 0);

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
('6238ac7f9204f', 0, '6235ebae7a861', 'The Basics (Data Types)', '2022-03-21 22:19:03', '2022-03-21 22:19:03', '61952d7816277', '61952d7816277', 0),
('623a18913f5e0', 0, '623a17837515f', 'Course Introduction - AWS Certified Developer Associate', '2022-03-23 00:12:25', '2022-03-23 00:12:25', '61952d7816277', '61952d7816277', 0);

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
('6238ad4667e52', 0, '6238ac236f1aa', '6235ebae7a861', 'Classes! (Object Orientated Programming)', '6235ebae7a861_6238ac236f1aa_6238ad4667e52.mp4', 'false', '2022-03-21 22:22:22', '2022-03-21 22:22:22', '61952d7816277', '61952d7816277', 0),
('623a18913fe2a', 0, '623a18913f5e0', '623a17837515f', 'Create your AWS Account', '623a17837515f_623a18913f5e0_623a18913fe2a.mp4', 'false', '2022-03-23 00:12:25', '2022-03-23 00:12:25', '61952d7816277', '61952d7816277', 0),
('623a189140840', 0, '623a18913f5e0', '623a17837515f', 'Important Message', '623a17837515f_623a18913f5e0_623a189140840.mp4', 'false', '2022-03-23 00:12:25', '2022-03-23 00:12:25', '61952d7816277', '61952d7816277', 0),
('623a18915a261', 0, '623a18913f5e0', '623a17837515f', 'About your instructor', '623a17837515f_623a18913f5e0_623a18915a261.mp4', 'false', '2022-03-23 00:12:25', '2022-03-23 00:12:25', '61952d7816277', '61952d7816277', 0);

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
('624214bbdfb20', '624214b2d076c', 'Test Demo', 'Complete', '2022-03-29 01:34:11', '2022-03-29 01:34:11', '2022-03-29 01:34:11', '624214b2d076c', '624214b2d076c', 0);

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
('6238c519116b3', 'amit jadvani', 'amit@gmail.com', '4567891231', 'userprofile.png', '5.8', '65', '27', 'Male', '0cb1eb413b8f7cee17701a37a1d74dc3', 'NOT SET', 0, '2022-03-22 00:04:01', '2022-03-22 00:04:01', '6238c519116b3', '6238c519116b3', 0),
('6239dcdfda947', 'Akshay Jadwani', 'akshay@gmail.com', '1875948623', 'userprofile.png', '5.8', '50', '28', 'Male', '2de1b2d6a6738df78c5f9733853bd170', 'NOT SET', 0, '2022-03-22 19:57:43', '2022-03-22 19:57:43', '6239dcdfda947', '6239dcdfda947', 0),
('62420dfead7b8', 'Maulik Panchal', 'maulik@gmail.com', '1234567899', 'userprofile.png', '5.6', '60', '26', 'Male', '21df07c02796f71ed40e4663f6a6bb79', 'NOT SET', 0, '2022-03-29 01:05:26', '2022-03-29 01:05:26', '62420dfead7b8', '62420dfead7b8', 0),
('624214b2d076c', 'Patel Jimish', 'pateljimish@gmail.com', '4875911202', 'userprofile.png', '5.7', '68', '28', 'Male', 'ee3fe132e487e08d130a689f88de5528', 'NOT SET', 0, '2022-03-29 01:34:02', '2022-03-29 01:34:02', '624214b2d076c', '624214b2d076c', 0),
('62421547871ab', 'Parth Nayi', 'parthnayi@gmail.com', '5846127893', 'userprofile.png', '5.6', '62', '29', 'Male', '6e40d17c3551b60ada075890cdd58f95', 'NOT SET', 0, '2022-03-29 01:36:31', '2022-03-29 01:36:31', '62421547871ab', '62421547871ab', 0);

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
('624214bbe0ab7', '624214b2d076c', '6235ebae7a861', '1000', '400', '600', '624214bbdfb20', '2022-03-29 01:34:11', '2022-03-29 01:34:11', '2022-03-29 01:34:11', '624214b2d076c', '624214b2d076c', 0);

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
('623eae8f32cf1', '6235e06d10799', '50', '03', '2022', '2022-03-26 11:41:27', '2022-03-26 11:41:27', '6235e06d10799', '6235e06d10799', 0),
('6241a67978043', '6239dcdfda947', '58', '03', '2022', '2022-03-28 17:43:45', '2022-03-28 17:43:45', '6239dcdfda947', '6239dcdfda947', 0),
('62420dfead7df', '62420dfead7b8', '60', '03', '2022', '2022-03-29 01:05:26', '2022-03-29 01:05:26', '62420dfead7b8', '62420dfead7b8', 0),
('624214b2d0791', '624214b2d076c', '68', '03', '2022', '2022-03-29 01:34:02', '2022-03-29 01:34:02', '624214b2d076c', '624214b2d076c', 0),
('62421547871c3', '62421547871ab', '62', '03', '2022', '2022-03-29 01:36:31', '2022-03-29 01:36:31', '62421547871ab', '62421547871ab', 0);

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
