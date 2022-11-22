-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2022 at 01:29 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name_class` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id_class`, `name_class`) VALUES
(1, 'ป.1'),
(2, 'ป.2'),
(3, 'ป.3'),
(4, 'ป.4'),
(5, 'ป.5'),
(6, 'ป.6');

-- --------------------------------------------------------

--
-- Table structure for table `class_group`
--

CREATE TABLE `class_group` (
  `id` int(11) UNSIGNED NOT NULL,
  `name_group` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_group`
--

INSERT INTO `class_group` (`id`, `name_group`) VALUES
(101, 'ประถมศึกษาตอนต้น'),
(201, 'ประถมศึกษาตอนปลาย');

-- --------------------------------------------------------

--
-- Table structure for table `class_room`
--

CREATE TABLE `class_room` (
  `id_room` int(11) UNSIGNED NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `id_class` int(11) NOT NULL,
  `id_class_group` int(11) UNSIGNED NOT NULL,
  `id_school` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_room`
--

INSERT INTO `class_room` (`id_room`, `class_name`, `id_class`, `id_class_group`, `id_school`) VALUES
(1, 'ป.1/1', 1, 101, 15),
(10, 'ป.2/1', 2, 101, 16),
(12, 'ป.1/2', 1, 101, 15),
(13, 'ป.6/1', 6, 201, 15),
(16, 'ป.1/1', 1, 101, 16),
(17, 'ป.1/2', 1, 101, 16);

-- --------------------------------------------------------

--
-- Table structure for table `form_header`
--

CREATE TABLE `form_header` (
  `id_header` int(11) UNSIGNED NOT NULL,
  `name_header` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_header`
--

INSERT INTO `form_header` (`id_header`, `name_header`) VALUES
(1, 'ความสามารถในการสือสาร'),
(2, 'ความสามารถในการคิด'),
(3, 'ความสามารถในการแก้ปัญหา'),
(4, 'ความสามารถในการใช้ทักษะชีวิต'),
(5, 'ความสามารถในการใช้เทคโนโลยี');

-- --------------------------------------------------------

--
-- Table structure for table `form_question`
--

CREATE TABLE `form_question` (
  `id_queustion` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_header` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `form_question`
--

INSERT INTO `form_question` (`id_queustion`, `question`, `id_header`) VALUES
(101, 'มีความสามารถในการรับและส่งสาร', 1),
(102, 'มีความสารถในการถ่ายทอดความรู้', 1),
(103, 'ใช้วิธีการสื่อสารที่เหมาะสมมีประสิทธิภาพ', 1),
(104, 'เจรจาต่อรองเพื่อขจัดและลดปัญหาความขัดแย้งต่าง ๆได้', 1),
(105, 'เลือกรับและไม่รับข้อมูลข่าวสารด้วยเหตุผลและถูกต้อง', 1),
(201, 'มีความสารถในการคิด/วิเคราะห์', 2),
(202, 'ทักษะในการคิดนอกรอบอย่างสร้างสรรค์', 2),
(203, 'สามารถคิดอย่างมีวิจรณญาณ', 2),
(204, 'ตัดสินใจแก้ปัญหาเกี่ยวกับตนเองได้อย่างเหมาะสม', 2),
(205, 'ตัดสินใจแก้ปัญหาเกี่ยวกับตนเองได้อย่างเหมาะสม', 2),
(301, 'สามารถแก้ปัญหาและอุปสรรคต่าง ๆ ที่เผชิญได้', 3),
(302, '\'เข้าใจความสัมพันธ์และการเปลี่ยนแปลงในสังคม', 3),
(303, 'แสวงหาความรู้ประยุกต์ความรู้มาใช้ในการป้องกันและแก้ปัญหา', 3),
(304, 'สามารถตัดสินได้อย่างเหมาะสมตามวัย', 3),
(401, 'เรียนรู้ด้วยตัวเองได้อย่างเหมาะสมกับวัย', 4),
(402, 'สามารถทำงานกลุ่มร่วมกับผู้อื่นได้', 4),
(403, 'นำความรู้ที่ได้ไปใช้ประโยชน์ในชีวิตประจำวัน', 4),
(404, 'จัดการปัญหาและความขัดเเย้งได้อย่างเหมาะสม', 4),
(405, '\'หลีกเลี่ยงพฤติกรรมไม่พึงประสงค์ที่ส่งผลกระทบต่อตนเอง\',', 4),
(501, 'เลือกและใช้เทคโนโลยีได้อย่างเหมาะสม', 5),
(502, 'มีทักษะกระบวนการทางเทคโนโลยี', 5),
(503, 'สามารถนำเทคโนโลยีไปใช้พัฒนาตนเอง', 5),
(504, 'ใช้เทคโนโลยีในการแก้ปัญหาได้อย่างสร้างสรรค์', 5),
(505, 'มีคุณธรรม จริยธรรม  ในการใช้เทคโนโลยี', 5);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) UNSIGNED NOT NULL,
  `schoolname` text NOT NULL,
  `schooladrees` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `schoolname`, `schooladrees`) VALUES
(15, 'โรงเรียนนราธิวาส', '96000'),
(16, 'โรงเรียนสงขลา', '50/63 90000 สงขลา');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id_score` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `id_h_question` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id_score`, `score`, `id_h_question`, `id_question`, `id_student`) VALUES
(1, 5, 1, 101, 6),
(2, 5, 1, 102, 6),
(3, 4, 1, 103, 6),
(4, 4, 1, 104, 6),
(5, 4, 1, 105, 6),
(6, 5, 2, 201, 6),
(7, 5, 2, 202, 6),
(8, 5, 2, 203, 6),
(9, 4, 2, 204, 6),
(10, 4, 2, 205, 6),
(11, 4, 3, 301, 6),
(12, 4, 3, 302, 6),
(13, 4, 3, 303, 6),
(14, 5, 3, 304, 6),
(15, 5, 4, 401, 6),
(16, 5, 4, 402, 6),
(17, 5, 4, 403, 6),
(18, 4, 4, 404, 6),
(19, 4, 4, 405, 6),
(20, 4, 5, 501, 6),
(21, 4, 5, 502, 6),
(22, 5, 5, 503, 6),
(23, 5, 5, 504, 6),
(24, 5, 5, 505, 6),
(25, 4, 1, 101, 10),
(26, 4, 1, 102, 10),
(27, 4, 1, 103, 10),
(28, 4, 1, 104, 10),
(29, 5, 1, 105, 10),
(30, 4, 2, 201, 10),
(31, 4, 2, 202, 10),
(32, 4, 2, 203, 10),
(33, 3, 2, 204, 10),
(34, 2, 2, 205, 10),
(35, 1, 3, 301, 10),
(36, 2, 3, 302, 10),
(37, 3, 3, 303, 10),
(38, 4, 3, 304, 10),
(39, 4, 4, 401, 10),
(40, 4, 4, 402, 10),
(41, 3, 4, 403, 10),
(42, 2, 4, 404, 10),
(43, 1, 4, 405, 10),
(44, 3, 5, 501, 10),
(45, 4, 5, 502, 10),
(46, 5, 5, 503, 10),
(47, 5, 5, 504, 10),
(48, 4, 5, 505, 10),
(49, 5, 1, 101, 12),
(50, 4, 1, 102, 12),
(51, 5, 1, 103, 12),
(52, 5, 1, 104, 12),
(53, 5, 1, 105, 12),
(54, 5, 2, 201, 12),
(55, 5, 2, 202, 12),
(56, 5, 2, 203, 12),
(57, 5, 2, 204, 12),
(58, 5, 2, 205, 12),
(59, 5, 3, 301, 12),
(60, 5, 3, 302, 12),
(61, 5, 3, 303, 12),
(62, 5, 3, 304, 12),
(63, 5, 4, 401, 12),
(64, 5, 4, 402, 12),
(65, 5, 4, 403, 12),
(66, 5, 4, 404, 12),
(67, 5, 4, 405, 12),
(68, 5, 5, 501, 12),
(69, 5, 5, 502, 12),
(70, 5, 5, 503, 12),
(71, 5, 5, 504, 12),
(72, 5, 5, 505, 12),
(73, 5, 1, 101, 20),
(74, 5, 1, 102, 20),
(75, 5, 1, 103, 20),
(76, 5, 1, 104, 20),
(77, 5, 1, 105, 20),
(78, 5, 2, 201, 20),
(79, 5, 2, 202, 20),
(80, 5, 2, 203, 20),
(81, 5, 2, 204, 20),
(82, 5, 2, 205, 20),
(83, 5, 3, 301, 20),
(84, 5, 3, 302, 20),
(85, 5, 3, 303, 20),
(86, 5, 3, 304, 20),
(87, 5, 4, 401, 20),
(88, 5, 4, 402, 20),
(89, 5, 4, 403, 20),
(90, 5, 4, 404, 20),
(91, 5, 4, 405, 20),
(92, 5, 5, 501, 20),
(93, 5, 5, 502, 20),
(94, 5, 5, 503, 20),
(95, 5, 5, 504, 20),
(96, 5, 5, 505, 20),
(97, 1, 1, 101, 13),
(98, 1, 1, 102, 13),
(99, 1, 1, 103, 13),
(100, 2, 1, 104, 13),
(101, 1, 1, 105, 13),
(102, 2, 2, 201, 13),
(103, 2, 2, 202, 13),
(104, 1, 2, 203, 13),
(105, 2, 2, 204, 13),
(106, 2, 2, 205, 13),
(107, 1, 3, 301, 13),
(108, 3, 3, 302, 13),
(109, 3, 3, 303, 13),
(110, 2, 3, 304, 13),
(111, 2, 4, 401, 13),
(112, 3, 4, 402, 13),
(113, 2, 4, 403, 13),
(114, 1, 4, 404, 13),
(115, 2, 4, 405, 13),
(116, 1, 5, 501, 13),
(117, 2, 5, 502, 13),
(118, 2, 5, 503, 13),
(119, 3, 5, 504, 13),
(120, 3, 5, 505, 13),
(121, 2, 1, 101, 14),
(122, 2, 1, 102, 14),
(123, 3, 1, 103, 14),
(124, 3, 1, 104, 14),
(125, 4, 1, 105, 14),
(126, 2, 2, 201, 14),
(127, 2, 2, 202, 14),
(128, 3, 2, 203, 14),
(129, 4, 2, 204, 14),
(130, 2, 2, 205, 14),
(131, 2, 3, 301, 14),
(132, 1, 3, 302, 14),
(133, 3, 3, 303, 14),
(134, 3, 3, 304, 14),
(135, 3, 4, 401, 14),
(136, 3, 4, 402, 14),
(137, 2, 4, 403, 14),
(138, 3, 4, 404, 14),
(139, 3, 4, 405, 14),
(140, 3, 5, 501, 14),
(141, 2, 5, 502, 14),
(142, 3, 5, 503, 14),
(143, 4, 5, 504, 14),
(144, 3, 5, 505, 14),
(145, 5, 1, 101, 21),
(146, 5, 1, 102, 21),
(147, 4, 1, 103, 21),
(148, 3, 1, 104, 21),
(149, 2, 1, 105, 21),
(150, 2, 2, 201, 21),
(151, 2, 2, 202, 21),
(152, 1, 2, 203, 21),
(153, 2, 2, 204, 21),
(154, 3, 2, 205, 21),
(155, 3, 3, 301, 21),
(156, 2, 3, 302, 21),
(157, 1, 3, 303, 21),
(158, 1, 3, 304, 21),
(159, 1, 4, 401, 21),
(160, 2, 4, 402, 21),
(161, 3, 4, 403, 21),
(162, 3, 4, 404, 21),
(163, 4, 4, 405, 21),
(164, 1, 5, 501, 21),
(165, 1, 5, 502, 21),
(166, 2, 5, 503, 21),
(167, 2, 5, 504, 21),
(168, 2, 5, 505, 21),
(169, 2, 1, 101, 22),
(170, 2, 1, 102, 22),
(171, 1, 1, 103, 22),
(172, 1, 1, 104, 22),
(173, 1, 1, 105, 22),
(174, 4, 2, 201, 22),
(175, 5, 2, 202, 22),
(176, 5, 2, 203, 22),
(177, 4, 2, 204, 22),
(178, 5, 2, 205, 22),
(179, 1, 3, 301, 22),
(180, 2, 3, 302, 22),
(181, 3, 3, 303, 22),
(182, 3, 3, 304, 22),
(183, 3, 4, 401, 22),
(184, 3, 4, 402, 22),
(185, 4, 4, 403, 22),
(186, 3, 4, 404, 22),
(187, 3, 4, 405, 22),
(188, 2, 5, 501, 22),
(189, 3, 5, 502, 22),
(190, 4, 5, 503, 22),
(191, 3, 5, 504, 22),
(192, 4, 5, 505, 22),
(193, 3, 1, 101, 23),
(194, 3, 1, 102, 23),
(195, 3, 1, 103, 23),
(196, 3, 1, 104, 23),
(197, 3, 1, 105, 23),
(198, 3, 2, 201, 23),
(199, 3, 2, 202, 23),
(200, 3, 2, 203, 23),
(201, 4, 2, 204, 23),
(202, 5, 2, 205, 23),
(203, 2, 3, 301, 23),
(204, 2, 3, 302, 23),
(205, 3, 3, 303, 23),
(206, 4, 3, 304, 23),
(207, 5, 4, 401, 23),
(208, 4, 4, 402, 23),
(209, 4, 4, 403, 23),
(210, 3, 4, 404, 23),
(211, 3, 4, 405, 23),
(212, 3, 5, 501, 23),
(213, 4, 5, 502, 23),
(214, 4, 5, 503, 23),
(215, 3, 5, 504, 23),
(216, 5, 5, 505, 23),
(217, 4, 1, 101, 24),
(218, 3, 1, 102, 24),
(219, 5, 1, 103, 24),
(220, 2, 1, 104, 24),
(221, 3, 1, 105, 24),
(222, 3, 2, 201, 24),
(223, 4, 2, 202, 24),
(224, 5, 2, 203, 24),
(225, 5, 2, 204, 24),
(226, 3, 2, 205, 24),
(227, 3, 3, 301, 24),
(228, 4, 3, 302, 24),
(229, 5, 3, 303, 24),
(230, 4, 3, 304, 24),
(231, 3, 4, 401, 24),
(232, 3, 4, 402, 24),
(233, 4, 4, 403, 24),
(234, 5, 4, 404, 24),
(235, 2, 4, 405, 24),
(236, 2, 5, 501, 24),
(237, 3, 5, 502, 24),
(238, 4, 5, 503, 24),
(239, 5, 5, 504, 24),
(240, 3, 5, 505, 24),
(241, 4, 1, 101, 25),
(242, 4, 1, 102, 25),
(243, 4, 1, 103, 25),
(244, 3, 1, 104, 25),
(245, 4, 1, 105, 25),
(246, 3, 2, 201, 25),
(247, 4, 2, 202, 25),
(248, 4, 2, 203, 25),
(249, 4, 2, 204, 25),
(250, 5, 2, 205, 25),
(251, 3, 3, 301, 25),
(252, 3, 3, 302, 25),
(253, 4, 3, 303, 25),
(254, 4, 3, 304, 25),
(255, 4, 4, 401, 25),
(256, 2, 4, 402, 25),
(257, 2, 4, 403, 25),
(258, 3, 4, 404, 25),
(259, 4, 4, 405, 25),
(260, 2, 5, 501, 25),
(261, 4, 5, 502, 25),
(262, 3, 5, 503, 25),
(263, 4, 5, 504, 25),
(264, 5, 5, 505, 25),
(265, 4, 1, 101, 26),
(266, 5, 1, 102, 26),
(267, 5, 1, 103, 26),
(268, 4, 1, 104, 26),
(269, 5, 1, 105, 26),
(270, 5, 2, 201, 26),
(271, 5, 2, 202, 26),
(272, 5, 2, 203, 26),
(273, 5, 2, 204, 26),
(274, 4, 2, 205, 26),
(275, 4, 3, 301, 26),
(276, 5, 3, 302, 26),
(277, 5, 3, 303, 26),
(278, 5, 3, 304, 26),
(279, 4, 4, 401, 26),
(280, 4, 4, 402, 26),
(281, 5, 4, 403, 26),
(282, 5, 4, 404, 26),
(283, 5, 4, 405, 26),
(284, 5, 5, 501, 26),
(285, 4, 5, 502, 26),
(286, 3, 5, 503, 26),
(287, 4, 5, 504, 26),
(288, 5, 5, 505, 26);

-- --------------------------------------------------------

--
-- Stand-in structure for view `scoreclass`
-- (See below for the actual view)
--
CREATE TABLE `scoreclass` (
`name_header` varchar(200)
,`id_room` int(11) unsigned
,`id_school` int(11) unsigned
,`id_class` int(11)
,`avgscore` decimal(18,8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `scoreschool`
-- (See below for the actual view)
--
CREATE TABLE `scoreschool` (
`name_header` varchar(200)
,`id_class` int(11)
,`id_school` int(11) unsigned
,`avgscore` decimal(22,12)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `scorestudent`
-- (See below for the actual view)
--
CREATE TABLE `scorestudent` (
`id_teacher` int(11)
,`id_student` int(11) unsigned
,`name_header` varchar(200)
,`id_room` int(11)
,`avgscore` decimal(14,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `scoresum`
-- (See below for the actual view)
--
CREATE TABLE `scoresum` (
`id_student` int(11) unsigned
,`name_header` varchar(200)
,`SUM(score.score)` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id_student` int(11) UNSIGNED NOT NULL,
  `number_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `student_lastname` varchar(200) NOT NULL,
  `id_room` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id_student`, `number_id`, `title`, `student_name`, `student_lastname`, `id_room`, `school_id`, `id_teacher`) VALUES
(6, 33039, 'ด.ช', 'กุลพัฒน์', 'สุขธันญโชติ', 12, 15, 26),
(10, 33040, 'ด.ญ', 'เลดี่กา', 'วิสดาว', 12, 15, 26),
(12, 33041, 'ด.ญ', 'วราภรณ์', 'รัตนพงศ์', 12, 15, 26),
(13, 33042, 'ด.ช', 'สมชาย', 'ยอด', 12, 15, 26),
(14, 33043, 'ด.ช', 'วรินทร', 'คงจันทร์', 12, 15, 26),
(20, 44030, 'ด.ช', 'กูอาซวัน', 'กูจิ', 13, 15, 38),
(21, 22030, 'ด.ญ', 'อัสมา', 'ลี้แอ', 1, 15, 39),
(22, 22031, 'ด.ช', 'อนุพงศ ', 'เกิดสุข', 1, 15, 39),
(23, 11011, 'ด.ญ', 'วราภรณ์', 'ยอดงาม', 16, 16, 42),
(24, 11012, 'ด.ช', 'มาโฆ', 'สมบัรติ', 16, 16, 42),
(25, 22020, 'ด.ญ', 'สมาย', 'รัตนพงศ์', 17, 16, 43),
(26, 22021, 'ด.ช', 'สุบรรณ', 'นกสังข์', 17, 16, 43);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_date`
--

CREATE TABLE `tbl_date` (
  `d_id` int(11) NOT NULL,
  `d_open` datetime NOT NULL,
  `d_close` date NOT NULL,
  `d_timezone` varchar(20) NOT NULL,
  `d_insert` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_date`
--

INSERT INTO `tbl_date` (`d_id`, `d_open`, `d_close`, `d_timezone`, `d_insert`) VALUES
(0, '2022-10-30 00:00:00', '2022-11-03', '27-10-2022 11:44:46', '2022-10-27 11:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `school_id` int(11) UNSIGNED NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `firstname`, `lastname`, `phone`, `email`, `password`, `urole`, `created_at`, `school_id`, `id_room`) VALUES
(1, '', 'ผู้พัฒนาระบบ', 'สมรรถนะ', '527527', '624235036@parichat.skru.ac.th', '$2y$10$KayvRFvGpffhGdfQYR7LteluO9EtOz.wJQZXlosWku95BclF0TtDK', 'admin', '2022-08-23 05:47:01', 3, 0),
(26, 'นางสาว', 'ลิซ่า', 'มาโนบาล', '0625495264', 'lisa@gmail.com', '$2y$10$04kZjXocP6XUanJP2j0cnudZ9UJT0O8aWlCirYkYlxxyEHuKaniLO', 'teacher', '2022-10-11 16:47:57', 15, 12),
(28, '', 'วิน', 'ดี้', '0627291696', 'love@gmail.com', '$2y$10$kX1bawTP2FFyDMhifuor7e8WlQxq.2Q0DPm8riWtVHNIPoIBIeOUK', 'teacher', '2022-10-11 16:06:45', 14, 0),
(36, 'นาง', 'พรพรรณ', 'สุขใจ', '0627291696', '45691@parichat.skru.ac.th', '$2y$10$LQS310HUqDpS2uSWRzQZM.gAb.xEMrnLy2kZDTDekxcRf88VWExsG', 'director', '2022-10-21 16:35:29', 15, 0),
(38, 'นาง', 'โสภิดา', 'กาณจนลินด์', '0848535424', '2525@parichat.skru.ac.th', '$2y$10$DlERr6AT5ZV7icF8xNSE6.AT5u9Hz3lCioVXMQn9MOwLr/9qzBZju', 'teacher', '2022-10-24 11:42:22', 15, 13),
(39, 'นาย', 'skov', 'evans', '0254592166', 'nikic@parichat.skru.ac.th', '$2y$10$23NBjQyDwTvcNoXtCdfgpO3McdX2wyfgLav4rorsMdga0wfxdXKvO', 'teacher', '2022-10-25 19:45:12', 15, 1),
(40, '', 'อิงค์ฟ้า', 'วราหัต', '0872935646', 'nickimijah@parichat.skru.ac.th', '$2y$10$5ORJqeqI4mz0UlTxyMfqAebw3OJ38kF3OBnAJlTHlcvLgWA3OOavG', 'director', '2022-10-25 19:53:33', 13, 0),
(41, 'นาย', 'สมชาย', 'ยอดจันทร์', '0936059844', 'somchai@gmail.com', '$2y$10$XoiZbiCIYXG9L.efDeUO..czqUEYlwXsOL.5klkN5KEzMSvBT7Txe', 'director', '2022-10-25 23:56:44', 16, 0),
(42, 'นางสาว', 'หญิงรฐา', 'ขวัญ', '0883871464', '456123@parichat.skru.ac.th', '$2y$10$q1SCJ3xtdoxkilZWhVhuhud1ITrwxxDOWHaBqveQkEeCVMLJbnHkS', 'teacher', '2022-10-26 00:00:08', 16, 16),
(43, 'นาง', 'ไอรัก', 'แสงจันทร์', '0985890706', '789456@parichat.skru.ac.th', '$2y$10$Qs5CRYxEcIf4GKRxgkkjGuBvUbflgVuV92.nVhbWafh8DaxgMKtna', 'teacher', '2022-10-26 00:01:37', 16, 17);

-- --------------------------------------------------------

--
-- Structure for view `scoreclass`
--
DROP TABLE IF EXISTS `scoreclass`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `scoreclass`  AS SELECT `scorestudent`.`name_header` AS `name_header`, `class_room`.`id_room` AS `id_room`, `class_room`.`id_school` AS `id_school`, `class_room`.`id_class` AS `id_class`, avg(`scorestudent`.`avgscore`) AS `avgscore` FROM (((`scorestudent` join `class_room` on(`class_room`.`id_room` = `scorestudent`.`id_room`)) join `school` on(`school`.`id` = `class_room`.`id_school`)) join `class` on(`class`.`id_class` = `class_room`.`id_class`)) GROUP BY `scorestudent`.`name_header`, `class_room`.`id_room`, `class_room`.`id_school`, `class_room`.`id_class``id_class`  ;

-- --------------------------------------------------------

--
-- Structure for view `scoreschool`
--
DROP TABLE IF EXISTS `scoreschool`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `scoreschool`  AS SELECT `scoreclass`.`name_header` AS `name_header`, `scoreclass`.`id_class` AS `id_class`, `scoreclass`.`id_school` AS `id_school`, avg(`scoreclass`.`avgscore`) AS `avgscore` FROM `scoreclass` WHERE 1 GROUP BY `scoreclass`.`name_header`, `scoreclass`.`id_class`, `scoreclass`.`id_school``id_school`  ;

-- --------------------------------------------------------

--
-- Structure for view `scorestudent`
--
DROP TABLE IF EXISTS `scorestudent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `scorestudent`  AS SELECT `student`.`id_teacher` AS `id_teacher`, `student`.`id_student` AS `id_student`, `form_header`.`name_header` AS `name_header`, `student`.`id_room` AS `id_room`, avg(`score`.`score`) AS `avgscore` FROM ((`score` join `form_header` on(`score`.`id_h_question` = `form_header`.`id_header`)) join `student` on(`student`.`id_student` = `score`.`id_student`)) GROUP BY `student`.`id_student`, `form_header`.`name_header`, `student`.`id_room``id_room`  ;

-- --------------------------------------------------------

--
-- Structure for view `scoresum`
--
DROP TABLE IF EXISTS `scoresum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `scoresum`  AS SELECT `student`.`id_student` AS `id_student`, `form_header`.`name_header` AS `name_header`, sum(`score`.`score`) AS `SUM(score.score)` FROM ((`score` join `form_header` on(`score`.`id_h_question` = `form_header`.`id_header`)) join `student` on(`student`.`id_student` = `score`.`id_student`)) WHERE 1 GROUP BY `student`.`id_student`, `form_header`.`name_header``name_header`  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `class_group`
--
ALTER TABLE `class_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_room`
--
ALTER TABLE `class_room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `id_class_group` (`id_class_group`),
  ADD KEY `id_school` (`id_school`);

--
-- Indexes for table `form_header`
--
ALTER TABLE `form_header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indexes for table `form_question`
--
ALTER TABLE `form_question`
  ADD PRIMARY KEY (`id_queustion`),
  ADD KEY `id_header` (`id_header`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id_score`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_group`
--
ALTER TABLE `class_group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `class_room`
--
ALTER TABLE `class_room`
  MODIFY `id_room` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `form_header`
--
ALTER TABLE `form_header`
  MODIFY `id_header` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `form_question`
--
ALTER TABLE `form_question`
  MODIFY `id_queustion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id_score` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
