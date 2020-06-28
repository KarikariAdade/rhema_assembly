-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: fdb21.awardspace.net
-- Generation Time: Mar 03, 2020 at 02:53 AM
-- Server version: 5.7.20-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3098535_rhemassembly`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_profile`
--

CREATE TABLE `admin_profile` (
  `id` int(11) NOT NULL,
  `first_name` varchar(400) DEFAULT NULL,
  `last_name` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `password` varchar(400) DEFAULT NULL,
  `position` varchar(400) DEFAULT NULL,
  `occupation` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `status` varchar(400) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `description` longtext,
  `admin_image` varchar(400) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `security_question` varchar(500) NOT NULL,
  `security_answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_profile`
--

INSERT INTO `admin_profile` (`id`, `first_name`, `last_name`, `email`, `password`, `position`, `occupation`, `address`, `status`, `gender`, `description`, `admin_image`, `phone`, `security_question`, `security_answer`) VALUES
(1, 'Karikari', 'Adade', 'juniorlecrae@gmail.com', '755d0f608e0feb4c0562a510e6488ded', 'Presiding Elder', 'Web Developer', 'Plot 234, Block K', 'Single', 'Male', 'My name is Karikari Adade. A 21 year old web developer trying to make it in the tech world', 'http://coprhemassembly.tk/admin/assets/uploads/profile/IMG_20200201_201120.jpg', '0548876922', 'What\'s your father\'s last name?', '5240d27d41f6b277a050e9c74c0bab64'),
(2, 'Gideon', 'Kwadwo', 'iamkarikari@gmail.com', '755d0f608e0feb4c0562a510e6488ded', 'Secretary', 'Doctor', 'Plot 234, Block K', 'In a Relationship', 'Male', 'Your request to become an adminYour request to become an adminYour request to become an adminYour request to become an admin', 'http://www.coprhemassembly.tk/admin/assets/uploads/profile/IMAG0061.jpg', '233248683109', 'What\'s your father\'s last name?', '5240d27d41f6b277a050e9c74c0bab64'),
(3, 'Emmanuel', 'Kobeah', 'iamkarikari98@gmail.com', '755d0f608e0feb4c0562a510e6488ded', 'Deacon', '', '', '', 'Male', 'transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.', NULL, '+233548876922', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `publisher_id` int(11) DEFAULT NULL,
  `publisher_name` varchar(400) DEFAULT NULL,
  `announcement_slug` varchar(400) NOT NULL,
  `announcement_title` varchar(400) NOT NULL,
  `category` varchar(400) DEFAULT NULL,
  `description` longtext,
  `date` datetime DEFAULT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `publisher_id`, `publisher_name`, `announcement_slug`, `announcement_title`, `category`, `description`, `date`, `image`) VALUES
(2, 1, 'Karikari Adade', 'evangelism-announcement', 'Evangelism Announcement', 'Evangelism Ministry', '<span style="text-align: justify;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.</span>         ', '2020-01-16 14:31:53', 'http://localhost/rhema_assembly/admin/assets/uploads/announcement/IMG-20190512-WA0022.jpg'),
(4, 1, 'Karikari Adade', 'mens-ministry-announcement', 'Men\'s Ministry Announcement', 'Men Ministry', '<span style="text-align: justify;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.</span>         ', '2020-01-16 14:36:09', 'http://localhost/rhema_assembly/admin/assets/uploads/announcement/IMG-20190526-WA0005.jpg'),
(5, 1, 'Karikari Adade', 'children-ministry-announcement', 'Children Ministry Announcement', 'Children Ministry', '<span style="text-align: justify;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.</span>         ', '2020-01-16 14:38:41', 'http://localhost/rhema_assembly/admin/assets/uploads/announcement/IMG-20190527-WA0052.jpg'),
(6, 1, 'Karikari Adade', 'evangelism-announcement', 'Evangelism Announcement', 'Evangelism Ministry', 'The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the soc         ', '2020-01-26 14:53:41', 'http://www.coprhemassembly.tk/admin/assets/uploads/announcement/ab-img.png');

-- --------------------------------------------------------

--
-- Table structure for table `annual_harvest`
--

CREATE TABLE `annual_harvest` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `venue` varchar(400) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `target_amount` decimal(10,2) NOT NULL,
  `harvest_year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `annual_harvest`
--

INSERT INTO `annual_harvest` (`id`, `date`, `time`, `venue`, `status`, `target_amount`, `harvest_year`) VALUES
(3, '2019-01-30', '11:11:00', 'Church Premise', 0, 1000.00, 2019),
(4, '2020-02-23', '06:00:00', 'Church Premises', 1, 2000.00, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `church_expenses`
--

CREATE TABLE `church_expenses` (
  `id` int(11) NOT NULL,
  `purpose` varchar(400) DEFAULT NULL,
  `amount_used` double(10,2) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(400) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `week_number` tinyint(4) NOT NULL,
  `month_number` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `church_expenses`
--

INSERT INTO `church_expenses` (`id`, `purpose`, `amount_used`, `date`, `user`, `year`, `week_number`, `month_number`) VALUES
(1, 'Buy Cement', 300.00, '2020-02-16 12:13:38', 'Karikari Adade (Presiding Elder)', 2020, 7, 2),
(2, 'Buy Cement 2', 111.00, '2020-02-16 15:46:45', 'Karikari Adade (Presiding Elder)', 2020, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `activity` varchar(400) DEFAULT NULL,
  `activity_slug` varchar(500) NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_date` date DEFAULT NULL,
  `event_category` varchar(400) NOT NULL,
  `event_desc` longtext,
  `event_picture` varchar(400) DEFAULT NULL,
  `venue` varchar(400) DEFAULT NULL,
  `remarks` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `activity`, `activity_slug`, `start_date`, `start_time`, `end_date`, `event_category`, `event_desc`, `event_picture`, `venue`, `remarks`) VALUES
(2, 'Men Camping', 'men-camping', '2020-01-01', '10:00:00', '2020-01-31', 'Youth Ministry', 'The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.', 'http://localhost/rhema_assembly/admin/assets/uploads/event/IMG-20190512-WA0020.jpg', 'Agona Community', 'All are invited'),
(3, 'Women Camping', 'women-camping', '2020-01-01', '10:00:00', '2020-01-31', 'Evangelism Ministry', 'The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.', 'http://localhost/rhema_assembly/admin/assets/uploads/event/IMG-20190527-WA0054.jpg', 'Agona Community', 'All are invited'),
(4, 'Women Camping 2', 'women-camping-', '2020-01-01', '10:00:00', '2020-01-31', 'Women Ministry', 'The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.', 'http://localhost/rhema_assembly/admin/assets/uploads/event/IMG-20190527-WA0059.jpg', 'Agona Community', 'All are invited');

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE `featured` (
  `id` int(11) NOT NULL,
  `featured_text` varchar(400) DEFAULT NULL,
  `featured_image` varchar(500) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `featured_text`, `featured_image`, `status`) VALUES
(1, 'The God-chosen men and women running the His church. The God-chosen men and women running', 'www.coprhemassembly.tk/admin/assets/uploads/featured/IMG-20190512-WA0017.jpg', 1),
(2, 'Anyone can be Transformed by the Story of Jesus at Rhema Assembly. Come as you are.', 'www.coprhemassembly.tk/admin/assets/uploads/featured/IMG-20190513-WA0015.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `full_name` varchar(300) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `week_number` tinyint(4) NOT NULL,
  `month_number` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `transaction_id`, `full_name`, `email`, `phone`, `amount`, `type`, `status`, `date`, `week_number`, `month_number`) VALUES
(1, 'W2I7B', 'Karikari', 'juniorlecrae@gmail.com', '0548876922', 10, 'Offering', 1, '2020-01-31 15:50:22', 5, 1),
(2, 'I41LQ', 'Karikari Adade', 'juniorlecrae@gmail.com', '0548876922', 100, 'Donation', 1, '2020-01-31 15:52:56', 3, 1),
(5, 'W6T5J', 'Karikari Adade', 'juniorlecrae@gmail.com', '0548876922', 120, 'Welfare', 1, '2020-02-03 17:48:13', 2, 2),
(6, 'W635J', 'Karikari Adade', 'juniorlecrae@gmail.com', '0548876922', 120, 'Donation', 1, '2020-02-03 17:48:13', 1, 2),
(7, '6JV9K', 'Karikari Adade', 'juniorlecrae@gmail.com', '0548876922', 10, 'Offering', 0, '2020-03-02 03:17:02', 10, 3),
(8, 'LWYQC', 'Karikari Adade', 'juniorlecrae@gmail.com', '0548876922', 10, 'Offering', 0, '2020-03-02 03:17:18', 10, 3),
(9, 'CWADY', 'Karikari Adade', 'juniorlecrae@gmail.com', '0548876922', 10, 'Offering', 0, '2020-03-02 03:19:02', 10, 3),
(10, 'MR3NQ', 'Karikari', 'jjuniorlecrae@gmail.com', '0548876922', 10, 'Tithe', 0, '2020-03-02 03:26:01', 10, 3),
(11, 'HEB2P', 'karikari', 'juniorleca@gmail.com', '+233548876922', 10, 'Tithe', 0, '2020-03-03 01:29:02', 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `category` varchar(400) DEFAULT NULL,
  `picture` varchar(500) DEFAULT NULL,
  `date_uploaded` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `category`, `picture`, `date_uploaded`) VALUES
(1, 'Committee Pictures', 'http://www.coprhemassembly.tk/admin/assets/uploads/gallery/bg-vector.png', '2020-01-26 15:39:37'),
(3, 'Events Pictures', 'http://www.coprhemassembly.tk/admin/assets/uploads/gallery/â€ª+233 26 956 8019â€¬ 20161111_164045.jpg', '2020-01-26 15:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `giving`
--

CREATE TABLE `giving` (
  `id` int(11) NOT NULL,
  `week_number` tinyint(4) DEFAULT NULL,
  `month_number` tinyint(4) DEFAULT NULL,
  `week_name` varchar(400) DEFAULT NULL,
  `tithe` decimal(10,2) DEFAULT NULL,
  `donation` decimal(10,2) DEFAULT NULL,
  `offering` decimal(10,2) DEFAULT NULL,
  `welfare` decimal(10,2) DEFAULT NULL,
  `year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `giving`
--

INSERT INTO `giving` (`id`, `week_number`, `month_number`, `week_name`, `tithe`, `donation`, `offering`, `welfare`, `year`) VALUES
(3, 5, 2, 'Lords supper week', 100.00, 50.00, 150.00, 30.00, 2020),
(12, 6, 2, 'Children Week', 110.00, 210.00, 410.00, 110.00, 2020),
(13, 1, 1, 'Youth Week', 110.00, 210.00, 410.00, 110.00, 2020),
(14, 2, 1, 'Women Week', 110.00, 210.00, 410.00, 110.00, 2020),
(15, 3, 1, 'Missions Week', 110.00, 210.00, 410.00, 110.00, 2020),
(16, 7, 2, 'Missions Week', 50.00, 55.00, 95.00, 55.00, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `mailbox`
--

CREATE TABLE `mailbox` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(400) DEFAULT NULL,
  `contact_phone` varchar(400) DEFAULT NULL,
  `contact_company` varchar(400) NOT NULL,
  `contact_email` varchar(400) DEFAULT NULL,
  `contact_message` longtext,
  `contact_reply_id` int(11) DEFAULT NULL,
  `contact_reply_name` varchar(400) DEFAULT NULL,
  `contact_reply_email` varchar(400) NOT NULL,
  `reply_title` varchar(600) NOT NULL,
  `reply_message` longtext NOT NULL,
  `reply_status` varchar(200) DEFAULT NULL,
  `message_status` varchar(200) DEFAULT NULL,
  `trash` varchar(200) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mailbox`
--

INSERT INTO `mailbox` (`id`, `contact_name`, `contact_phone`, `contact_company`, `contact_email`, `contact_message`, `contact_reply_id`, `contact_reply_name`, `contact_reply_email`, `reply_title`, `reply_message`, `reply_status`, `message_status`, `trash`, `date`) VALUES
(1, 'karikari adade', '0548876922', 'Donate', 'juniorlecrae@gmail.com', 'The God-chosen men and women running the His church. The God-chosen men and women running the His church. The God-chosen men and women running the His church', NULL, NULL, '', '', '', 'No', 'read', 'No', '2020-01-12 22:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `ministry` varchar(400) DEFAULT NULL,
  `phone` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `year_duration` date DEFAULT NULL,
  `marital_status` varchar(400) DEFAULT NULL,
  `occupation` varchar(400) DEFAULT NULL,
  `baptism` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `picture` varchar(400) DEFAULT NULL,
  `career_field` varchar(200) NOT NULL,
  `home_cell_group` varchar(400) NOT NULL,
  `bible_study_group` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `gender`, `birthday`, `address`, `ministry`, `phone`, `email`, `year_duration`, `marital_status`, `occupation`, `baptism`, `description`, `picture`, `career_field`, `home_cell_group`, `bible_study_group`) VALUES
(1, 'Karikari', 'Adade', 'Male', '2019-12-31', 'Plot 234, Block K', 'None', '0548876922', 'juniorlecrae@gmail.com', '2019-12-30', 'Single', 'Web Developer', 'Yes', 'This is the shit', 'C:/xampp/htdocs/rhema_assembly/admin/assets/uploads/members/UCC.jpg', 'Science and Engineering', '', 'Bible Study 1'),
(2, 'Bizzle', 'Lemuel', 'Male', '2020-01-04', 'dgsdf', 'None', '0548876922', 'shit@gmail.com', '2020-01-01', 'In a Relationship', 'Doctor', 'No', 'lkjkk lkjkk ', NULL, '', '', 'Bible Study 1'),
(3, 'Bizzle', 'Lemuel', 'Male', '2020-01-01', 'dgsdf', 'None', '0548876922', 'oncampuswith4@gmail.com', '2019-12-30', 'Divorced', 'Doctor', 'No', 'Any fucking desc', 'C:/xampp/htdocs/rhema_assembly/admin/assets/uploads/members/â€ª+233 26 956 8019â€¬ 20161111_164045.jpg', 'Community &amp; Social Services', '', ''),
(4, 'Augustina', 'Adade', 'Female', '1961-10-16', 'AZ 1000- 120L', 'Women Ministry', '0208522053', 'augustina@gmail.com', '1979-01-12', 'Widowed', 'Trader/Retailer', 'Yes', 'My name is Augustina', 'C:/xampp/htdocs/rhema_assembly/admin/assets/uploads/members/IMG-20170120-WA0016.jpg', 'Retail &amp; Sales', '', 'Bible Study 1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `sender_name` varchar(400) DEFAULT NULL,
  `sender_email` varchar(400) DEFAULT NULL,
  `message_title` varchar(400) DEFAULT NULL,
  `message_desc` longtext,
  `receiver_email` varchar(400) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `trash_status` varchar(400) NOT NULL,
  `date` datetime DEFAULT NULL,
  `message_category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `sender_name`, `sender_email`, `message_title`, `message_desc`, `receiver_email`, `status`, `trash_status`, `date`, `message_category`) VALUES
(1, 1, 'Karikari Adade', 'juniorlecrae@gmail.com', 'This is the subject', 'This is the message', 'juniorlecrae@gmail.com', 'read', 'Yes', '2020-01-16 12:07:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_activities`
--

CREATE TABLE `monthly_activities` (
  `month_id` int(11) NOT NULL,
  `month_name` varchar(300) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `week_number` varchar(400) DEFAULT NULL,
  `week_activity_name` varchar(300) DEFAULT NULL,
  `week_day` date DEFAULT NULL,
  `opening_prayer` varchar(300) DEFAULT NULL,
  `worship` varchar(300) DEFAULT NULL,
  `intensive_prayer` varchar(300) DEFAULT NULL,
  `sermon` varchar(300) DEFAULT NULL,
  `offering` varchar(300) DEFAULT NULL,
  `conductor` varchar(300) DEFAULT NULL,
  `benediction` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_activities`
--

INSERT INTO `monthly_activities` (`month_id`, `month_name`, `year`, `week_number`, `week_activity_name`, `week_day`, `opening_prayer`, `worship`, `intensive_prayer`, `sermon`, `offering`, `conductor`, `benediction`) VALUES
(1, 'January', '2020', '1', 'Ministry Week', '2020-01-05', 'Karikari Adade', 'Karikari Adade', 'Williams Wills', 'Mr. Unknown', 'Eld. Bizzle', 'Bro. Emma', 'Any Member'),
(2, 'January', '2020', '2', 'Youth Week', '2020-01-12', 'Adade Karikari', 'Karikari Adade', 'William Agyemang', 'Mr. NiceGuy', 'Eld. Bizzle', 'Bro. Emma', 'Any Member'),
(3, 'January', '2020', '3', 'Children Week', '2020-01-19', 'Karikari Adade', 'Karikari Adade', 'Williams Wills', 'Mr. Unknown', 'Eld. Bizzle', 'Bro. Emma', 'Any Member'),
(4, 'January', '2020', '4', 'Children Week', '2020-01-26', 'Karikari Adade', 'Karikari Adade', 'Williams Wills', 'Mr. Unknown', 'Eld. Bizzle', 'Bro. Emma', 'Any Member');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_author` varchar(400) DEFAULT NULL,
  `news_title` varchar(500) DEFAULT NULL,
  `news_slug` varchar(500) DEFAULT NULL,
  `news_category` varchar(400) DEFAULT NULL,
  `news_description` longtext,
  `news_date` datetime DEFAULT NULL,
  `news_image` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_author`, `news_title`, `news_slug`, `news_category`, `news_description`, `news_date`, `news_image`) VALUES
(5, 'Karikari Adade', 'Building a new Church for the Kids', 'building-a-new-church-for-the-kids', 'General News', 'The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the soc           ', '2020-01-26 13:55:35', 'http://www.coprhemassembly.tk/admin/assets/uploads/news/ab-img.png');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `category` varchar(300) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `category`, `message`, `date`, `status`) VALUES
(1, 'Volunteer', 'gideon adade has requested to be a volunteer', '2019-12-24 11:23:11', 1),
(2, 'Staff Request', 'Kwadwo Adade has made a staff request', '2019-12-25 09:32:44', 1),
(3, 'Staff Request', 'Kwadwo  Adade has made a staff request', '2019-12-26 15:25:20', 1),
(4, 'Staff Request', 'Bizzle Lemuel has made a staff request', '2020-01-14 07:36:33', 1),
(5, 'Member Add', 'Bizzle Lemuel has been added to members', '2020-01-15 14:49:23', 1),
(6, 'Event Add', 'Karikari Adade added a new event', '2020-01-16 13:39:49', 1),
(7, 'Event Add', 'Karikari Adade added a new event', '2020-01-16 13:41:18', 1),
(8, 'Event Add', 'Karikari Adade added a new event', '2020-01-16 13:41:45', 1),
(9, 'Event Add', 'Karikari Adade added a new event', '2020-01-16 13:42:53', 1),
(10, 'Monthly Activity', 'Karikari Adade added a monthly activity', '2020-01-16 15:00:29', 1),
(11, 'Monthly Activity', 'Karikari Adade added a monthly activity', '2020-01-16 15:01:11', 1),
(12, 'Monthly Activity', 'Karikari Adade updated a monthly activity', '2020-01-16 15:01:40', 1),
(13, 'Monthly Activity', 'Karikari Adade added a monthly activity', '2020-01-16 15:02:18', 1),
(14, 'Monthly Activity', 'Karikari Adade added a monthly activity', '2020-01-16 15:02:28', 1),
(15, 'Event Add', 'Karikari Adade added a new event', '2020-01-26 14:15:25', 1),
(16, 'Event Add', 'Karikari Adade added a new event', '2020-01-26 14:19:01', 1),
(17, 'Event Add', 'Karikari Adade added a new event', '2020-01-26 14:31:04', 1),
(18, 'Staff Request', 'Gideon Kwadwo has made a staff request', '2020-01-26 18:54:41', 1),
(19, 'Staff Request', 'Gideon Kwadwo has made a staff request', '2020-01-26 19:03:47', 1),
(20, 'Staff Request', 'Emmanuel Kobeah has made a staff request', '2020-03-03 02:18:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile_pictures`
--

CREATE TABLE `profile_pictures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_position` varchar(400) DEFAULT NULL,
  `user_name` varchar(400) DEFAULT NULL,
  `user_email` varchar(300) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `picture` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_pictures`
--

INSERT INTO `profile_pictures` (`id`, `user_id`, `user_position`, `user_name`, `user_email`, `date_added`, `picture`) VALUES
(11, 2, '', 'Gideon Kwadwo', 'iamkarikari98@gmail.com', '2020-01-26 19:42:16', 'http://www.coprhemassembly.tk/admin/staff/assets/uploads/profile/20160107200247.jpg'),
(12, 2, 'Secretary', 'Gideon Kwadwo', 'iamkarikari98@gmail.com', '2020-01-26 19:42:45', 'http://www.coprhemassembly.tk/admin/assets/uploads/profile/IMAG0061.jpg'),
(15, 1, 'Presiding Elder', 'Karikari Adade', 'juniorlecrae@gmail.com', '2020-03-02 02:23:16', 'http://coprhemassembly.tk/admin/assets/uploads/profile/IMG_20200201_201120.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sermon`
--

CREATE TABLE `sermon` (
  `id` int(11) NOT NULL,
  `publisher_id` int(11) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `sermon_slug` varchar(400) NOT NULL,
  `author` varchar(400) DEFAULT NULL,
  `bible_verses` varchar(400) DEFAULT NULL,
  `sermon_link` varchar(500) DEFAULT NULL,
  `sermon_notes` longtext,
  `date` datetime DEFAULT NULL,
  `service_type` varchar(400) DEFAULT NULL,
  `sermon_image` varchar(400) NOT NULL,
  `sermon_file` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sermon`
--

INSERT INTO `sermon` (`id`, `publisher_id`, `title`, `sermon_slug`, `author`, `bible_verses`, `sermon_link`, `sermon_notes`, `date`, `service_type`, `sermon_image`, `sermon_file`) VALUES
(1, 1, 'Walking with Christ', 'walking-with-christ', 'Karikari Adade', 'Bizzle 32:23', 'www.coprhemassembly.tk', 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.', '2020-01-04 12:32:02', 'Sunday Service', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon/theme.jpg', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon_file/Rise_ Get Up and Live in Gods - Trip Lee.pdf'),
(2, 1, 'Don\'t compromise', 'dont-compromise', 'Bro. Atta', 'Psalms 32:2', 'www.coprhemassembly.tk', '<span style="color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</span>   ', '2020-01-15 16:35:14', 'Youth Ministry', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon/theme.jpg', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon_file/Rise_ Get Up and Live in Gods - Trip Lee.pdf'),
(3, 1, 'Knowing your stand in Christ', 'knowing-your-stand-in-christ', 'Mr. Karikari Adade', 'Psalms 32:2, Proverbs 1:10', 'www.coprhemassembly.tk', '<p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">While we wait for the blessed hope, the glorious appearing ofour great God and Savior, Jesus Christ, who gave himself for us to redeem us from all wickedness and to purify for himself a people that are his very own,eager to do what is good (Titus 2:13-14)</p><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">The Church of Pentecost, both nationally and internationally, has become a respected institution; thanks for the exceptional work done by our forebears and great leaders. However, when we match our achievements with the standards set by the early church (Acts 2:42-47) and what God can do through us, we come to the realisation that there is more to be done.</p><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;"><span style="font-weight: bolder;">â€œI Will Build My Churchâ€, is the first part of Vision 2023, with the overarching theme, â€œPossessing the Nations: Equipping the Church to transform every sphere of society with the values and principles of the Kingdom of Godâ€.</span></p><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.<br></p>   ', '2020-01-16 06:46:26', 'Evangelism Ministry', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon/â€ª+233 26 956 8019â€¬ 20161111_164045.jpg', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon_file/Rise_ Get Up and Live in Gods - Trip Lee.pdf'),
(4, 1, 'Walking with Christ', 'walking-with-christ', 'Karikari Adade', 'Psalms 32:2, Proverbs 1:10', 'www.coprhemassembly.tk', '<h4 style="margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2;"><span source="" sans="" pro",="" "helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 14px;"="" style="">And I tell you that you are Peter, and on this rock I will build my church,andthe gatesofHades will not overcome it (Matthew 16:18 NIV)</span><br></h4><p style="margin-bottom: 1rem;">While we wait for the blessed hope, the glorious appearing ofour great God and Savior, Jesus Christ, who gave himself for us to redeem us from all wickedness and to purify for himself a people that are his very own,eager to do what is good (Titus 2:13-14)</p><p style="margin-bottom: 1rem;">The Church of Pentecost, both nationally and internationally, has become a respected institution; thanks for the exceptional work done by our forebears and great leaders. However, when we match our achievements with the standards set by the early church (Acts 2:42-47) and what God can do through us, we come to the realisation that there is more to be done.</p><p style="margin-bottom: 1rem;">â€œI Will Build My Churchâ€, is the first part of Vision 2023, with the overarching theme, â€œPossessing the Nations: Equipping the Church to transform every sphere of society with the values and principles of the Kingdom of Godâ€.</p><p style="margin-bottom: 1rem;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.</p>     											', '2020-01-16 10:22:24', 'Women Ministry', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon/bg-vector.png', 'http://localhost/rhema_assembly/admin/assets/uploads/sermon_file/Rise_ Get Up and Live in Gods - Trip Lee.pdf'),
(5, 1, 'Walking with Christ', 'walking-with-christ', 'Karikari Adade', 'Psalms 32:2, Proverbs 1:10', 'www.coprhemassembly.tk', '<h4 style="margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2;"><span source="" sans="" pro",="" "helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 14px;"="" style="">And I tell you that you are Peter, and on this rock I will build my church,andthe gatesofHades will not overcome it (Matthew 16:18 NIV)</span><br></h4><p style="margin-bottom: 1rem;">While we wait for the blessed hope, the glorious appearing ofour great God and Savior, Jesus Christ, who gave himself for us to redeem us from all wickedness and to purify for himself a people that are his very own,eager to do what is good (Titus 2:13-14)</p><p style="margin-bottom: 1rem;">The Church of Pentecost, both nationally and internationally, has become a respected institution; thanks for the exceptional work done by our forebears and great leaders. However, when we match our achievements with the standards set by the early church (Acts 2:42-47) and what God can do through us, we come to the realisation that there is more to be done.</p><p style="margin-bottom: 1rem;"><b>â€œI Will Build My Churchâ€, is the first part of Vision 2023, with the overarching theme, â€œPossessing the Nations: Equipping the Church to transform every sphere of society with the values and principles of the Kingdom of Godâ€.</b></p><p style="margin-bottom: 1rem;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.</p>     											  											  											  											', '2020-01-16 10:29:27', 'Men Ministry', 'http://www.coprhemassembly.tk/admin/assets/uploads/sermon/ab-img.png', 'http://www.coprhemassembly.tk/admin/assets/uploads/sermon_file/Swiftmailer.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `staff_request`
--

CREATE TABLE `staff_request` (
  `id` int(11) NOT NULL,
  `first_name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `description` longtext,
  `status` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `password` varchar(200) NOT NULL,
  `position` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_request`
--

INSERT INTO `staff_request` (`id`, `first_name`, `last_name`, `phone`, `email`, `gender`, `description`, `status`, `date`, `password`, `position`) VALUES
(5, 'Gideon', 'Kwadwo', '0548876922', 'iamkarikari98@gmail.com', 'Male', 'Add me to the staff please. Just let me be part', 'verified', '2020-01-26 19:35:20', '', 'Secretary'),
(6, 'Emmanuel', 'Kobeah', '+233548876922', 'iamkarikari98@gmail.com', 'Male', 'transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.', 'verified', '2020-03-03 02:26:32', '', 'Deacon');

-- --------------------------------------------------------

--
-- Table structure for table `study_groups`
--

CREATE TABLE `study_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(400) DEFAULT NULL,
  `group_category` varchar(400) NOT NULL,
  `group_coordinator` varchar(400) DEFAULT NULL,
  `coordinator_id` int(11) NOT NULL,
  `coordinator_email` varchar(400) DEFAULT NULL,
  `coordinator_phone` varchar(300) DEFAULT NULL,
  `coordinator_address` varchar(400) DEFAULT NULL,
  `coordinator_picture` varchar(400) NOT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_groups`
--

INSERT INTO `study_groups` (`id`, `group_name`, `group_category`, `group_coordinator`, `coordinator_id`, `coordinator_email`, `coordinator_phone`, `coordinator_address`, `coordinator_picture`, `date_created`) VALUES
(1, 'Bible Study 1', 'Bible Studies', 'Karikari Adade', 1, 'juniorlecrae@gmail.com', '0548876922', 'Plot 234, Block K', 'http://localhost/rhema_assembly/admin/assets/uploads/profile/â€ª+233 26 956 8019â€¬ 20161111_164045.jpg', '2020-01-16 18:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `tasklist`
--

CREATE TABLE `tasklist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(400) DEFAULT NULL,
  `user_position` varchar(400) DEFAULT NULL,
  `task_title` varchar(400) DEFAULT NULL,
  `task_description` longtext,
  `task_schedule_date` date DEFAULT NULL,
  `task_schedule_time` time NOT NULL,
  `task_status` varchar(400) DEFAULT NULL,
  `task_marker` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasklist`
--

INSERT INTO `tasklist` (`id`, `user_id`, `user_name`, `user_position`, `task_title`, `task_description`, `task_schedule_date`, `task_schedule_time`, `task_status`, `task_marker`) VALUES
(1, 1, 'Karikari Adade', 'Presiding Elder', 'Cleanup exercise', 'This is a cleanup exercise', '2020-01-19', '12:33:00', 'Public', 'In Progress'),
(2, 1, 'Karikari Adade', 'Presiding Elder', 'Closing Date', 'This is a private task', '2020-01-27', '23:55:00', 'Private', 'On Hold');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `theme_title` varchar(600) DEFAULT NULL,
  `bible_verse` varchar(400) DEFAULT NULL,
  `theme_picture` varchar(500) DEFAULT NULL,
  `theme_description` longtext,
  `theme_year` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id`, `theme_title`, `bible_verse`, `theme_picture`, `theme_description`, `theme_year`) VALUES
(3, 'A Glorious Church to Possess the Nations', 'Ephesians 3:21, 5:27', '/home/www/coprhemassembly.tk/admin/assets/uploads/theme/2020-theme-banner-web.jpg', '<h4 style="margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.5rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;;"><span source="" sans="" pro",="" "helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-size:="" 14px;"="">And I tell you that you are Peter, and on this rock I will build my church,andthe gatesofHades will not overcome it (Matthew 16:18 NIV)</span><br></h4><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">While we wait for the blessed hope, the glorious appearing ofour great God and Savior, Jesus Christ, who gave himself for us to redeem us from all wickedness and to purify for himself a people that are his very own,eager to do what is good (Titus 2:13-14)</p><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">The Church of Pentecost, both nationally and internationally, has become a respected institution; thanks for the exceptional work done by our forebears and great leaders. However, when we match our achievements with the standards set by the early church (Acts 2:42-47) and what God can do through us, we come to the realisation that there is more to be done.</p><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;"><span style="font-weight: bolder;">â€œI Will Build My Churchâ€, is the first part of Vision 2023, with the overarching theme, â€œPossessing the Nations: Equipping the Church to transform every sphere of society with the values and principles of the Kingdom of Godâ€.</span></p><p style="margin-bottom: 1rem; color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;">The purpose of this theme, â€œI Will Build My Churchâ€, is to help bring to the fore the understanding of the dual identity of the Church; that the church is called out of the world to belong to God and sent back into the world to witness and to serve. If the church is able to rediscover its identity as originally given by God in the Scriptures, and made alive and relevant by the Spirit of God, we could be in the most exciting times in the history of the church. Everything depends on our ability to understand the Church as it ought to be, our willingness to change where necessary and above all, our determination to keep our lives continually opened to spiritual freshness. The energy then derived could help us do more for the Kingdom of God. This is because the transformation of the society cannot take place without the transformation of the church. Society will listen to the testimony of a credible church, a church living out the values and principles of Christ.</p>', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(400) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `ministry` varchar(400) DEFAULT NULL,
  `event` varchar(400) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `company` varchar(400) NOT NULL,
  `address` varchar(400) NOT NULL,
  `comment` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `full_name`, `email`, `ministry`, `event`, `phone`, `company`, `address`, `comment`) VALUES
(3, 'Karikari Adade', 'juniorlecrae@gmail.com', 'Men Ministry', 'Visitations', '0548876922', 'Buzut', 'Plot 234', 'This is a visit event'),
(4, 'Adade Karikari', 'oncampuswith4@gmail.com', 'Youth Ministry', NULL, '0548876922', 'bizblock', 'Plot 234, Block 542', 'This is a contribution'),
(5, 'Adade Karikari', 'oncampuswith4@gmail.com', 'Youth Ministry', NULL, '0548876922', 'bizblock', 'Plot 234, Block 542', 'This is a contribution');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_profile`
--
ALTER TABLE `admin_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annual_harvest`
--
ALTER TABLE `annual_harvest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `church_expenses`
--
ALTER TABLE `church_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `giving`
--
ALTER TABLE `giving`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mailbox`
--
ALTER TABLE `mailbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_activities`
--
ALTER TABLE `monthly_activities`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sermon`
--
ALTER TABLE `sermon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_request`
--
ALTER TABLE `staff_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_groups`
--
ALTER TABLE `study_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasklist`
--
ALTER TABLE `tasklist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_profile`
--
ALTER TABLE `admin_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `annual_harvest`
--
ALTER TABLE `annual_harvest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `church_expenses`
--
ALTER TABLE `church_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `giving`
--
ALTER TABLE `giving`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `mailbox`
--
ALTER TABLE `mailbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `monthly_activities`
--
ALTER TABLE `monthly_activities`
  MODIFY `month_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `sermon`
--
ALTER TABLE `sermon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `staff_request`
--
ALTER TABLE `staff_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `study_groups`
--
ALTER TABLE `study_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tasklist`
--
ALTER TABLE `tasklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
