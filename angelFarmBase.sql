-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2022 at 12:43 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `angelFarmBase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_passport` varchar(255) NOT NULL DEFAULT 'admin.png',
  `admin_signature` varchar(200) NOT NULL DEFAULT 'defaultSign.png',
  `admin_fullname` varchar(255) NOT NULL,
  `admin_phone_no` varchar(15) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_uniqueid` varchar(20) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_permissions` varchar(150) NOT NULL,
  `admin_status` varchar(5) NOT NULL DEFAULT 'off',
  `admin_email_verified` varchar(6) NOT NULL DEFAULT 'no',
  `admin_date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `suspened` int(2) NOT NULL DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_passport`, `admin_signature`, `admin_fullname`, `admin_phone_no`, `admin_email`, `admin_uniqueid`, `admin_username`, `admin_password`, `admin_permissions`, `admin_status`, `admin_email_verified`, `admin_date_added`, `admin_last_login`, `suspened`, `deleted`) VALUES
(1, '118129001-3371732499550329-7764603403919473158-n-5931e933583d429e0977319f3ff652c16cf7.jpg', 'whatsapp-image-2021-04-09-at-2.01.03-pm-2843-5158-81630f255383c57d32d40121533994b64c0a.jpeg', 'Ozioko Lovelyn', '08107972756', 'ucodetut@gmail.com', 'elog-52955209', 'Ejekwu8621', '$2y$10$tJGKPzY1EnGHtgeUDSbgTe3ZH/gdrE47j9AlyTe39PAQCUYRJZh/i', 'superuser, editor', 'on', 'yes', '2021-11-15 02:31:49', '2022-02-03 15:04:51', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `adminOtp`
--

CREATE TABLE `adminOtp` (
  `id` int(11) NOT NULL,
  `admin_unique` varchar(15) NOT NULL,
  `secure_token` int(8) DEFAULT NULL,
  `dateSent` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'unused'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminOtp`
--

INSERT INTO `adminOtp` (`id`, `admin_unique`, `secure_token`, `dateSent`, `status`) VALUES
(1, 'elog-52955209', 41327220, '2022-02-03 13:42:34', 'used'),
(2, 'elog-93690269', 75595253, '2021-12-20 09:56:47', 'used'),
(3, 'elog-43492329', 82296215, '2021-12-26 04:06:01', 'used');

-- --------------------------------------------------------

--
-- Table structure for table `duration_weeks`
--

CREATE TABLE `duration_weeks` (
  `id` int(11) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `duration_weeks`
--

INSERT INTO `duration_weeks` (`id`, `duration`, `deleted`) VALUES
(1, '1', 0),
(2, '2', 0),
(3, '2', 0),
(4, '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `farmTools`
--

CREATE TABLE `farmTools` (
  `id` int(11) NOT NULL,
  `tool_name` varchar(255) NOT NULL,
  `tool_img` varchar(255) NOT NULL,
  `available` int(11) NOT NULL DEFAULT 1,
  `tool_price` int(100) NOT NULL,
  `tool_type` varchar(100) NOT NULL,
  `secret_key` varchar(8) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `farmTools`
--

INSERT INTO `farmTools` (`id`, `tool_name`, `tool_img`, `available`, `tool_price`, `tool_type`, `secret_key`, `deleted`) VALUES
(1, 'Tractor', '1.jpeg', 0, 10000, 'heavy duty', 'hb6f7gxm', 0),
(2, 'Wheel Barrow', 'wheel.jpg', 1, 2000, 'light duty', 'er23hgr4', 0),
(3, 'Shovel', 'hlb1lodbtbrpk1rjszteq6awavxat-59660ad1de7d3b29cd3889ee166515834a24.jpg', 1, 1500, 'light duty', '8tbupfim', 0),
(4, 'Axe', '443d0d6a7e976f48cdf86e1ed36fe172-4153089d85c387f9480e8a97f23d64f5ec84.jpg', 1, 2300, 'heavy duty', 'hm46guxz', 0),
(5, 'Heavy Tractor', 'tractors-3741b55c195c60c4399620a2c273940f3915.jpg', 1, 40000, 'heavy duty', 'h4alpyw1', 0),
(6, 'Tractor Green', 'banner-8459803d30f0de3972f61b58c8f696333d4f.jpg', 1, 30000, 'heavy duty', 'x51cpwi7', 0),
(7, 'Wheel Barrow Sliver', 'h697cd124be86489d9b7f211fdc5410fb8-7567730f79e5198da1e0fdb8d05786e067e2.jpg', 1, 2600, 'light duty', '9u8cpojt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lga`
--

CREATE TABLE `lga` (
  `id` int(11) NOT NULL,
  `lga` varchar(200) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lga`
--

INSERT INTO `lga` (`id`, `lga`, `deleted`) VALUES
(1, 'Abadam', 0),
(2, 'Abaji', 0),
(3, 'Abak', 0),
(4, 'Abakaliki', 0),
(5, 'Aba North', 0),
(6, 'Aba South', 0),
(7, 'Abeokuta North', 0),
(8, 'Abeokuta South', 0),
(9, 'Abi', 0),
(10, 'Aboh Mbaise', 0),
(11, 'Abua/Odual', 0),
(12, 'Adavi', 0),
(13, 'Ado Ekiti', 0),
(14, 'Ado-Odo/Ota', 0),
(15, 'Afijio', 0),
(16, 'Afikpo North', 0),
(17, 'Afikpo South', 0),
(18, 'Agaie', 0),
(19, 'Agatu', 0),
(20, 'Agwara', 0),
(21, 'Agege', 0),
(22, 'Aguata', 0),
(23, 'Ahiazu Mbaise', 0),
(24, 'Ahoada East', 0),
(25, 'Ahoada West', 0),
(26, 'Ajaokuta', 0),
(27, 'Ajeromi-Ifelodun', 0),
(28, 'Ajingi', 0),
(29, 'Akamkpa', 0),
(30, 'Akinyele', 0),
(31, 'Akko', 0),
(32, 'Akoko-Edo', 0),
(33, 'Akoko North-East', 0),
(34, 'Akoko North-West', 0),
(35, 'Akoko South-West', 0),
(36, 'Akoko South-East', 0),
(37, 'Akpabuyo', 0),
(38, 'Akuku-Toru', 0),
(39, 'Akure North', 0),
(40, 'Akure South', 0),
(41, 'Akwanga', 0),
(42, 'Albasu', 0),
(43, 'Aleiro', 0),
(44, 'Alimosho', 0),
(45, 'Alkaleri', 0),
(46, 'Amuwo-Odofin', 0),
(47, 'Anambra East', 0),
(48, 'Anambra West', 0),
(49, 'Anaocha', 0),
(50, 'Andoni', 0),
(51, 'Aninri', 0),
(52, 'Aniocha North', 0),
(53, 'Aniocha South', 0),
(54, 'Anka', 0),
(55, 'Ankpa', 0),
(56, 'Apa', 0),
(57, 'Apapa', 0),
(58, 'Ado', 0),
(59, 'Ardo Kola', 0),
(60, 'Arewa Dandi', 0),
(61, 'Argungu', 0),
(62, 'Arochukwu', 0),
(63, 'Asa', 0),
(64, 'Asari-Toru', 0),
(65, 'Askira/Uba', 0),
(66, 'Atakunmosa East', 0),
(67, 'Atakunmosa West', 0),
(68, 'Atiba', 0),
(69, 'Atisbo', 0),
(70, 'Augie', 0),
(71, 'Auyo', 0),
(72, 'Awe', 0),
(73, 'Awgu', 0),
(74, 'Awka North', 0),
(75, 'Awka South', 0),
(76, 'Ayamelum', 0),
(77, 'Aiyedaade', 0),
(78, 'Aiyedire', 0),
(79, 'Babura', 0),
(80, 'Badagry', 0),
(81, 'Bagudo', 0),
(82, 'Bagwai', 0),
(83, 'Bakassi', 0),
(84, 'Bokkos', 0),
(85, 'Bakori', 0),
(86, 'Bakura', 0),
(87, 'Balanga', 0),
(88, 'Bali', 0),
(89, 'Bama', 0),
(90, 'Bade', 0),
(91, 'Barkin Ladi', 0),
(92, 'Baruten', 0),
(93, 'Bassa', 0),
(94, 'Bassa', 0),
(95, 'Batagarawa', 0),
(96, 'Batsari', 0),
(97, 'Bauchi', 0),
(98, 'Baure', 0),
(99, 'Bayo', 0),
(100, 'Bebeji', 0),
(101, 'Bekwarra', 0),
(102, 'Bende', 0),
(103, 'Biase', 0),
(104, 'Bichi', 0),
(105, 'Bida', 0),
(106, 'Billiri', 0),
(107, 'Bindawa', 0),
(108, 'Binji', 0),
(109, 'Biriniwa', 0),
(110, 'Birnin Gwari', 0),
(111, 'Birnin Kebbi', 0),
(112, 'Birnin Kudu', 0),
(113, 'Birnin Magaji/Kiyaw', 0),
(114, 'Biu', 0),
(115, 'Bodinga', 0),
(116, 'Bogoro', 0),
(117, 'Boki', 0),
(118, 'Boluwaduro', 0),
(119, 'Bomadi', 0),
(120, 'Bonny', 0),
(121, 'Borgu', 0),
(122, 'Boripe', 0),
(123, 'Bursari', 0),
(124, 'Bosso', 0),
(125, 'Brass', 0),
(126, 'Buji', 0),
(127, 'Bukkuyum', 0),
(128, 'Buruku', 0),
(129, 'Bungudu', 0),
(130, 'Bunkure', 0),
(131, 'Bunza', 0),
(132, 'Burutu', 0),
(133, 'Bwari', 0),
(134, 'Calabar Municipal', 0),
(135, 'Calabar South', 0),
(136, 'Chanchaga', 0),
(137, 'Charanchi', 0),
(138, 'Chibok', 0),
(139, 'Chikun', 0),
(140, 'Dala', 0),
(141, 'Damaturu', 0),
(142, 'Damban', 0),
(143, 'Dambatta', 0),
(144, 'Damboa', 0),
(145, 'Dandi', 0),
(146, 'Dandume', 0),
(147, 'Dange Shuni', 0),
(148, 'Danja', 0),
(149, 'Dan Musa', 0),
(150, 'Darazo', 0),
(151, 'Dass', 0),
(152, 'Daura', 0),
(153, 'Dawakin Kudu', 0),
(154, 'Dawakin Tofa', 0),
(155, 'Degema', 0),
(156, 'Dekina', 0),
(157, 'Demsa', 0),
(158, 'Dikwa', 0),
(159, 'Doguwa', 0),
(160, 'Doma', 0),
(161, 'Donga', 0),
(162, 'Dukku', 0),
(163, 'Dunukofia', 0),
(164, 'Dutse', 0),
(165, 'Dutsi', 0),
(166, 'Dutsin Ma', 0),
(167, 'Eastern Obolo', 0),
(168, 'Ebonyi', 0),
(169, 'Edati', 0),
(170, 'Ede North', 0),
(171, 'Ede South', 0),
(172, 'Edu', 0),
(173, 'Ife Central', 0),
(174, 'Ife East', 0),
(175, 'Ife North', 0),
(176, 'Ife South', 0),
(177, 'Efon', 0),
(178, 'Egbado North', 0),
(179, 'Egbado South', 0),
(180, 'Egbeda', 0),
(181, 'Egbedore', 0),
(182, 'Egor', 0),
(183, 'Ehime Mbano', 0),
(184, 'Ejigbo', 0),
(185, 'Ekeremor', 0),
(186, 'Eket', 0),
(187, 'Ekiti', 0),
(188, 'Ekiti East', 0),
(189, 'Ekiti South-West', 0),
(190, 'Ekiti West', 0),
(191, 'Ekwusigo', 0),
(192, 'Eleme', 0),
(193, 'Emuoha', 0),
(194, 'Emure', 0),
(195, 'Enugu East', 0),
(196, 'Enugu North', 0),
(197, 'Enugu South', 0),
(198, 'Epe', 0),
(199, 'Esan Central', 0),
(200, 'Esan North-East', 0),
(201, 'Esan South-East', 0),
(202, 'Esan West', 0),
(203, 'Ese Odo', 0),
(204, 'Esit Eket', 0),
(205, 'Essien Udim', 0),
(206, 'Etche', 0),
(207, 'Ethiope East', 0),
(208, 'Ethiope West', 0),
(209, 'Etim Ekpo', 0),
(210, 'Etinan', 0),
(211, 'Eti Osa', 0),
(212, 'Etsako Central', 0),
(213, 'Etsako East', 0),
(214, 'Etsako West', 0),
(215, 'Etung', 0),
(216, 'Ewekoro', 0),
(217, 'Ezeagu', 0),
(218, 'Ezinihitte', 0),
(219, 'Ezza North', 0),
(220, 'Ezza South', 0),
(221, 'Fagge', 0),
(222, 'Fakai', 0),
(223, 'Faskari', 0),
(224, 'Fika', 0),
(225, 'Fufure', 0),
(226, 'Funakaye', 0),
(227, 'Fune', 0),
(228, 'Funtua', 0),
(229, 'Gabasawa', 0),
(230, 'Gada', 0),
(231, 'Gagarawa', 0),
(232, 'Gamawa', 0),
(233, 'Ganjuwa', 0),
(234, 'Ganye', 0),
(235, 'Garki', 0),
(236, 'Garko', 0),
(237, 'Garun Mallam', 0),
(238, 'Gashaka', 0),
(239, 'Gassol', 0),
(240, 'Gaya', 0),
(241, 'Gayuk', 0),
(242, 'Gezawa', 0),
(243, 'Gbako', 0),
(244, 'Gboko', 0),
(245, 'Gbonyin', 0),
(246, 'Geidam', 0),
(247, 'Giade', 0),
(248, 'Giwa', 0),
(249, 'Gokana', 0),
(250, 'Gombe', 0),
(251, 'Gombi', 0),
(252, 'Goronyo', 0),
(253, 'Grie', 0),
(254, 'Gubio', 0),
(255, 'Gudu', 0),
(256, 'Gujba', 0),
(257, 'Gulani', 0),
(258, 'Guma', 0),
(259, 'Gumel', 0),
(260, 'Gummi', 0),
(261, 'Gurara', 0),
(262, 'Guri', 0),
(263, 'Gusau', 0),
(264, 'Guzamala', 0),
(265, 'Gwadabawa', 0),
(266, 'Gwagwalada', 0),
(267, 'Gwale', 0),
(268, 'Gwandu', 0),
(269, 'Gwaram', 0),
(270, 'Gwarzo', 0),
(271, 'Gwer East', 0),
(272, 'Gwer West', 0),
(273, 'Gwiwa', 0),
(274, 'Gwoza', 0),
(275, 'Hadejia', 0),
(276, 'Hawul', 0),
(277, 'Hong', 0),
(278, 'Ibadan North', 0),
(279, 'Ibadan North-East', 0),
(280, 'Ibadan North-West', 0),
(281, 'Ibadan South-East', 0),
(282, 'Ibadan South-West', 0),
(283, 'Ibaji', 0),
(284, 'Ibarapa Central', 0),
(285, 'Ibarapa East', 0),
(286, 'Ibarapa North', 0),
(287, 'Ibeju-Lekki', 0),
(288, 'Ibeno', 0),
(289, 'Ibesikpo Asutan', 0),
(290, 'Ibi', 0),
(291, 'Ibiono-Ibom', 0),
(292, 'Idah', 0),
(293, 'Idanre', 0),
(294, 'Ideato North', 0),
(295, 'Ideato South', 0),
(296, 'Idemili North', 0),
(297, 'Idemili South', 0),
(298, 'Ido', 0),
(299, 'Ido Osi', 0),
(300, 'Ifako-Ijaiye', 0),
(301, 'Ifedayo', 0),
(302, 'Ifedore', 0),
(303, 'Ifelodun', 0),
(304, 'Ifelodun', 0),
(305, 'Ifo', 0),
(306, 'Igabi', 0),
(307, 'Igalamela Odolu', 0),
(308, 'Igbo Etiti', 0),
(309, 'Igbo Eze North', 0),
(310, 'Igbo Eze South', 0),
(311, 'Igueben', 0),
(312, 'Ihiala', 0),
(313, 'Ihitte/Uboma', 0),
(314, 'Ilaje', 0),
(315, 'Ijebu East', 0),
(316, 'Ijebu North', 0),
(317, 'Ijebu North East', 0),
(318, 'Ijebu Ode', 0),
(319, 'Ijero', 0),
(320, 'Ijumu', 0),
(321, 'Ika', 0),
(322, 'Ika North East', 0),
(323, 'Ikara', 0),
(324, 'Ika South', 0),
(325, 'Ikeduru', 0),
(326, 'Ikeja', 0),
(327, 'Ikenne', 0),
(328, 'Ikere', 0),
(329, 'Ikole', 0),
(330, 'Ikom', 0),
(331, 'Ikono', 0),
(332, 'Ikorodu', 0),
(333, 'Ikot Abasi', 0),
(334, 'Ikot Ekpene', 0),
(335, 'Ikpoba Okha', 0),
(336, 'Ikwerre', 0),
(337, 'Ikwo', 0),
(338, 'Ikwuano', 0),
(339, 'Ila', 0),
(340, 'Ilejemeje', 0),
(341, 'Ile Oluji/Okeigbo', 0),
(342, 'Ilesa East', 0),
(343, 'Ilesa West', 0),
(344, 'Illela', 0),
(345, 'Ilorin East', 0),
(346, 'Ilorin South', 0),
(347, 'Ilorin West', 0),
(348, 'Imeko Afon', 0),
(349, 'Ingawa', 0),
(350, 'Ini', 0),
(351, 'Ipokia', 0),
(352, 'Irele', 0),
(353, 'Irepo', 0),
(354, 'Irepodun', 0),
(355, 'Irepodun', 0),
(356, 'Irepodun/Ifelodun', 0),
(357, 'Irewole', 0),
(358, 'Isa', 0),
(359, 'Ise/Orun', 0),
(360, 'Iseyin', 0),
(361, 'Ishielu', 0),
(362, 'Isiala Mbano', 0),
(363, 'Isiala Ngwa North', 0),
(364, 'Isiala Ngwa South', 0),
(365, 'Isin', 0),
(366, 'Isi Uzo', 0),
(367, 'Isokan', 0),
(368, 'Isoko North', 0),
(369, 'Isoko South', 0),
(370, 'Isu', 0),
(371, 'Isuikwuato', 0),
(372, 'Itas/Gadau', 0),
(373, 'Itesiwaju', 0),
(374, 'Itu', 0),
(375, 'Ivo', 0),
(376, 'Iwajowa', 0),
(377, 'Iwo', 0),
(378, 'Izzi', 0),
(379, 'Jaba', 0),
(380, 'Jada', 0),
(381, 'Jahun', 0),
(382, 'Jakusko', 0),
(383, 'Jalingo', 0),
(384, 'Jama\'are', 0),
(385, 'Jega', 0),
(386, 'Jema\'a', 0),
(387, 'Jere', 0),
(388, 'Jibia', 0),
(389, 'Jos East', 0),
(390, 'Jos North', 0),
(391, 'Jos South', 0),
(392, 'Kabba/Bunu', 0),
(393, 'Kabo', 0),
(394, 'Kachia', 0),
(395, 'Kaduna North', 0),
(396, 'Kaduna South', 0),
(397, 'Kafin Hausa', 0),
(398, 'Kafur', 0),
(399, 'Kaga', 0),
(400, 'Kagarko', 0),
(401, 'Kaiama', 0),
(402, 'Kaita', 0),
(403, 'Kajola', 0),
(404, 'Kajuru', 0),
(405, 'Kala/Balge', 0),
(406, 'Kalgo', 0),
(407, 'Kaltungo', 0),
(408, 'Kanam', 0),
(409, 'Kankara', 0),
(410, 'Kanke', 0),
(411, 'Kankia', 0),
(412, 'Kano Municipal', 0),
(413, 'Karasuwa', 0),
(414, 'Karaye', 0),
(415, 'Karim Lamido', 0),
(416, 'Karu', 0),
(417, 'Katagum', 0),
(418, 'Katcha', 0),
(419, 'Katsina', 0),
(420, 'Katsina-Ala', 0),
(421, 'Kaura', 0),
(422, 'Kaura Namoda', 0),
(423, 'Kauru', 0),
(424, 'Kazaure', 0),
(425, 'Keana', 0),
(426, 'Kebbe', 0),
(427, 'Keffi', 0),
(428, 'Khana', 0),
(429, 'Kibiya', 0),
(430, 'Kirfi', 0),
(431, 'Kiri Kasama', 0),
(432, 'Kiru', 0),
(433, 'Kiyawa', 0),
(434, 'Kogi', 0),
(435, 'Koko/Besse', 0),
(436, 'Kokona', 0),
(437, 'Kolokuma/Opokuma', 0),
(438, 'Konduga', 0),
(439, 'Konshisha', 0),
(440, 'Kontagora', 0),
(441, 'Kosofe', 0),
(442, 'Kaugama', 0),
(443, 'Kubau', 0),
(444, 'Kudan', 0),
(445, 'Kuje', 0),
(446, 'Kukawa', 0),
(447, 'Kumbotso', 0),
(448, 'Kumi', 0),
(449, 'Kunchi', 0),
(450, 'Kura', 0),
(451, 'Kurfi', 0),
(452, 'Kusada', 0),
(453, 'Kwali', 0),
(454, 'Kwande', 0),
(455, 'Kwami', 0),
(456, 'Kware', 0),
(457, 'Kwaya Kusar', 0),
(458, 'Lafia', 0),
(459, 'Lagelu', 0),
(460, 'Lagos Island', 0),
(461, 'Lagos Mainland', 0),
(462, 'Langtang South', 0),
(463, 'Langtang North', 0),
(464, 'Lapai', 0),
(465, 'Lamurde', 0),
(466, 'Lau', 0),
(467, 'Lavun', 0),
(468, 'Lere', 0),
(469, 'Logo', 0),
(470, 'Lokoja', 0),
(471, 'Machina', 0),
(472, 'Madagali', 0),
(473, 'Madobi', 0),
(474, 'Mafa', 0),
(475, 'Magama', 0),
(476, 'Magumeri', 0),
(477, 'Mai\'Adua', 0),
(478, 'Maiduguri', 0),
(479, 'Maigatari', 0),
(480, 'Maiha', 0),
(481, 'Maiyama', 0),
(482, 'Makarfi', 0),
(483, 'Makoda', 0),
(484, 'Malam Madori', 0),
(485, 'Malumfashi', 0),
(486, 'Mangu', 0),
(487, 'Mani', 0),
(488, 'Maradun', 0),
(489, 'Mariga', 0),
(490, 'Makurdi', 0),
(491, 'Marte', 0),
(492, 'Maru', 0),
(493, 'Mashegu', 0),
(494, 'Mashi', 0),
(495, 'Matazu', 0),
(496, 'Mayo Belwa', 0),
(497, 'Mbaitoli', 0),
(498, 'Mbo', 0),
(499, 'Michika', 0),
(500, 'Miga', 0),
(501, 'Mikang', 0),
(502, 'Minjibir', 0),
(503, 'Misau', 0),
(504, 'Moba', 0),
(505, 'Mobbar', 0),
(506, 'Mubi North', 0),
(507, 'Mubi South', 0),
(508, 'Mokwa', 0),
(509, 'Monguno', 0),
(510, 'Mopa Muro', 0),
(511, 'Moro', 0),
(512, 'Moya', 0),
(513, 'Mkpat-Enin', 0),
(514, 'Municipal Area Council', 0),
(515, 'Musawa', 0),
(516, 'Mushin', 0),
(517, 'Nafada', 0),
(518, 'Nangere', 0),
(519, 'Nasarawa', 0),
(520, 'Nasarawa', 0),
(521, 'Nasarawa Egon', 0),
(522, 'Ndokwa East', 0),
(523, 'Ndokwa West', 0),
(524, 'Nembe', 0),
(525, 'Ngala', 0),
(526, 'Nganzai', 0),
(527, 'Ngaski', 0),
(528, 'Ngor Okpala', 0),
(529, 'Nguru', 0),
(530, 'Ningi', 0),
(531, 'Njaba', 0),
(532, 'Njikoka', 0),
(533, 'Nkanu East', 0),
(534, 'Nkanu West', 0),
(535, 'Nkwerre', 0),
(536, 'Nnewi North', 0),
(537, 'Nnewi South', 0),
(538, 'Nsit-Atai', 0),
(539, 'Nsit-Ibom', 0),
(540, 'Nsit-Ubium', 0),
(541, 'Nsukka', 0),
(542, 'Numan', 0),
(543, 'Nwangele', 0),
(544, 'Obafemi Owode', 0),
(545, 'Obanliku', 0),
(546, 'Obi', 0),
(547, 'Obi', 0),
(548, 'Obi Ngwa', 0),
(549, 'Obio/Akpor', 0),
(550, 'Obokun', 0),
(551, 'Obot Akara', 0),
(552, 'Obowo', 0),
(553, 'Obubra', 0),
(554, 'Obudu', 0),
(555, 'Odeda', 0),
(556, 'Odigbo', 0),
(557, 'Odogbolu', 0),
(558, 'Odo Otin', 0),
(559, 'Odukpani', 0),
(560, 'Offa', 0),
(561, 'Ofu', 0),
(562, 'Ogba/Egbema/Ndoni', 0),
(563, 'Ogbadibo', 0),
(564, 'Ogbaru', 0),
(565, 'Ogbia', 0),
(566, 'Ogbomosho North', 0),
(567, 'Ogbomosho South', 0),
(568, 'Ogu/Bolo', 0),
(569, 'Ogoja', 0),
(570, 'Ogo Oluwa', 0),
(571, 'Ogori/Magongo', 0),
(572, 'Ogun Waterside', 0),
(573, 'Oguta', 0),
(574, 'Ohafia', 0),
(575, 'Ohaji/Egbema', 0),
(576, 'Ohaozara', 0),
(577, 'Ohaukwu', 0),
(578, 'Ohimini', 0),
(579, 'Orhionmwon', 0),
(580, 'Oji River', 0),
(581, 'Ojo', 0),
(582, 'Oju', 0),
(583, 'Okehi', 0),
(584, 'Okene', 0),
(585, 'Oke Ero', 0),
(586, 'Okigwe', 0),
(587, 'Okitipupa', 0),
(588, 'Okobo', 0),
(589, 'Okpe', 0),
(590, 'Okrika', 0),
(591, 'Olamaboro', 0),
(592, 'Ola Oluwa', 0),
(593, 'Olorunda', 0),
(594, 'Olorunsogo', 0),
(595, 'Oluyole', 0),
(596, 'Omala', 0),
(597, 'Omuma', 0),
(598, 'Ona Ara', 0),
(599, 'Ondo East', 0),
(600, 'Ondo West', 0),
(601, 'Onicha', 0),
(602, 'Onitsha North', 0),
(603, 'Onitsha South', 0),
(604, 'Onna', 0),
(605, 'Okpokwu', 0),
(606, 'Opobo/Nkoro', 0),
(607, 'Oredo', 0),
(608, 'Orelope', 0),
(609, 'Oriade', 0),
(610, 'Ori Ire', 0),
(611, 'Orlu', 0),
(612, 'Orolu', 0),
(613, 'Oron', 0),
(614, 'Orsu', 0),
(615, 'Oru East', 0),
(616, 'Oruk Anam', 0),
(617, 'Orumba North', 0),
(618, 'Orumba South', 0),
(619, 'Oru West', 0),
(620, 'Ose', 0),
(621, 'Oshimili North', 0),
(622, 'Oshimili South', 0),
(623, 'Oshodi-Isolo', 0),
(624, 'Osisioma', 0),
(625, 'Osogbo', 0),
(626, 'Oturkpo', 0),
(627, 'Ovia North-East', 0),
(628, 'Ovia South-West', 0),
(629, 'Owan East', 0),
(630, 'Owan West', 0),
(631, 'Owerri Municipal', 0),
(632, 'Owerri North', 0),
(633, 'Owerri West', 0),
(634, 'Owo', 0),
(635, 'Oye', 0),
(636, 'Oyi', 0),
(637, 'Oyigbo', 0),
(638, 'Oyo', 0),
(639, 'Oyo East', 0),
(640, 'Oyun', 0),
(641, 'Paikoro', 0),
(642, 'Pankshin', 0),
(643, 'Patani', 0),
(644, 'Pategi', 0),
(645, 'Port Harcourt', 0),
(646, 'Potiskum', 0),
(647, 'Qua\'an Pan', 0),
(648, 'Rabah', 0),
(649, 'Rafi', 0),
(650, 'Rano', 0),
(651, 'Remo North', 0),
(652, 'Rijau', 0),
(653, 'Rimi', 0),
(654, 'Rimin Gado', 0),
(655, 'Ringim', 0),
(656, 'Riyom', 0),
(657, 'Rogo', 0),
(658, 'Roni', 0),
(659, 'Sabon Birni', 0),
(660, 'Sabon Gari', 0),
(661, 'Sabuwa', 0),
(662, 'Safana', 0),
(663, 'Sagbama', 0),
(664, 'Sakaba', 0),
(665, 'Saki East', 0),
(666, 'Saki West', 0),
(667, 'Sandamu', 0),
(668, 'Sanga', 0),
(669, 'Sapele', 0),
(670, 'Sardauna', 0),
(671, 'Shagamu', 0),
(672, 'Shagari', 0),
(673, 'Shanga', 0),
(674, 'Shani', 0),
(675, 'Shanono', 0),
(676, 'Shelleng', 0),
(677, 'Shendam', 0),
(678, 'Shinkafi', 0),
(679, 'Shira', 0),
(680, 'Shiroro', 0),
(681, 'Shongom', 0),
(682, 'Shomolu', 0),
(683, 'Silame', 0),
(684, 'Soba', 0),
(685, 'Sokoto North', 0),
(686, 'Sokoto South', 0),
(687, 'Song', 0),
(688, 'Southern Ijaw', 0),
(689, 'Suleja', 0),
(690, 'Sule Tankarkar', 0),
(691, 'Sumaila', 0),
(692, 'Suru', 0),
(693, 'Surulere', 0),
(694, 'Surulere', 0),
(695, 'Tafa', 0),
(696, 'Tafawa Balewa', 0),
(697, 'Tai', 0),
(698, 'Takai', 0),
(699, 'Takum', 0),
(700, 'Talata Mafara', 0),
(701, 'Tambuwal', 0),
(702, 'Tangaza', 0),
(703, 'Tarauni', 0),
(704, 'Tarka', 0),
(705, 'Tarmuwa', 0),
(706, 'Taura', 0),
(707, 'Toungo', 0),
(708, 'Tofa', 0),
(709, 'Toro', 0),
(710, 'Toto', 0),
(711, 'Chafe', 0),
(712, 'Tsanyawa', 0),
(713, 'Tudun Wada', 0),
(714, 'Tureta', 0),
(715, 'Udenu', 0),
(716, 'Udi', 0),
(717, 'Udu', 0),
(718, 'Udung-Uko', 0),
(719, 'Ughelli North', 0),
(720, 'Ughelli South', 0),
(721, 'Ugwunagbo', 0),
(722, 'Uhunmwonde', 0),
(723, 'Ukanafun', 0),
(724, 'Ukum', 0),
(725, 'Ukwa East', 0),
(726, 'Ukwa West', 0),
(727, 'Ukwuani', 0),
(728, 'Umuahia North', 0),
(729, 'Umuahia South', 0),
(730, 'Umu Nneochi', 0),
(731, 'Ungogo', 0),
(732, 'Unuimo', 0),
(733, 'Uruan', 0),
(734, 'Urue-Offong/Oruko', 0),
(735, 'Ushongo', 0),
(736, 'Ussa', 0),
(737, 'Uvwie', 0),
(738, 'Uyo', 0),
(739, 'Uzo Uwani', 0),
(740, 'Vandeikya', 0),
(741, 'Wamako', 0),
(742, 'Wamba', 0),
(743, 'Warawa', 0),
(744, 'Warji', 0),
(745, 'Warri North', 0),
(746, 'Warri South', 0),
(747, 'Warri South West', 0),
(748, 'Wasagu/Danko', 0),
(749, 'Wase', 0),
(750, 'Wudil', 0),
(751, 'Wukari', 0),
(752, 'Wurno', 0),
(753, 'Wushishi', 0),
(754, 'Yabo', 0),
(755, 'Yagba East', 0),
(756, 'Yagba West', 0),
(757, 'Yakuur', 0),
(758, 'Yala', 0),
(759, 'Yamaltu/Deba', 0),
(760, 'Yankwashi', 0),
(761, 'Yauri', 0),
(762, 'Yenagoa', 0),
(763, 'Yola North', 0),
(764, 'Yola South', 0),
(765, 'Yorro', 0),
(766, 'Yunusari', 0),
(767, 'Yusufari', 0),
(768, 'Zaki', 0),
(769, 'Zango', 0),
(770, 'Zangon Kataf', 0),
(771, 'Zaria', 0),
(772, 'Zing', 0),
(773, 'Zurmi', 0),
(774, 'Zuru', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `customer` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dateSent` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `customer`, `title`, `message`, `dateSent`, `deleted`) VALUES
(1, 'admin', 'cus-23657477', 'payment', 'Customer paid for a tool', '2022-01-29 11:57:44', 0),
(2, 'admin', 'cus-71032517', 'payment', 'Customer paid for a tool!', '2022-01-29 16:38:25', 1),
(3, 'admin', 'cus-23657477', 'payment', 'Customer paid for a tool', '2022-01-29 22:47:00', 1),
(4, 'admin', 'cus-23657477', 'payment', 'Customer paid for a tool', '2022-01-29 22:47:17', 1),
(5, 'admin', 'cus-23657477', 'payment', 'Customer paid for a tool', '2022-01-29 22:47:47', 1),
(6, 'admin', 'cus-23657477', 'payment', 'Customer paid for a tool', '2022-01-29 23:02:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pwdReset`
--

CREATE TABLE `pwdReset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` text NOT NULL,
  `pwdResetExpires` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secureOtp`
--

CREATE TABLE `secureOtp` (
  `id` int(11) NOT NULL,
  `user_uniqueid` varchar(20) NOT NULL,
  `secure_token` int(8) DEFAULT NULL,
  `dateSent` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'unused'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secureOtp`
--

INSERT INTO `secureOtp` (`id`, `user_uniqueid`, `secure_token`, `dateSent`, `status`) VALUES
(1, 'cus-23657477', 18424357, '2022-01-29 20:24:06', 'used'),
(2, 'cus-71032517', NULL, '2022-01-29 16:34:55', 'used'),
(3, 'cus-62257038', 29785277, '2022-01-31 15:50:45', 'used'),
(4, 'cus-89530437', 28260947, '2022-02-03 14:51:18', 'used'),
(5, 'cus-81890005', NULL, '2022-03-11 11:13:53', 'unused');

-- --------------------------------------------------------

--
-- Table structure for table `secureQuestion`
--

CREATE TABLE `secureQuestion` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `secure_question` varchar(100) NOT NULL,
  `secure_answer` varchar(100) NOT NULL,
  `dateSent` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `deleted`) VALUES
(1, 'Abia ', 0),
(2, 'Abuja ', 0),
(3, 'Adamawa ', 0),
(4, 'Akwa Ibom ', 0),
(5, 'Anambra ', 0),
(6, 'Bauchi ', 0),
(7, 'Bayelsa ', 0),
(8, 'Benue ', 0),
(9, 'Borno ', 0),
(10, 'Cross River ', 0),
(11, 'Delta ', 0),
(12, 'Ebonyi ', 0),
(13, 'Edo ', 0),
(14, 'Ekiti ', 0),
(15, 'Enugu ', 0),
(16, 'Gombe ', 0),
(17, 'Imo ', 0),
(18, 'Jigawa ', 0),
(19, 'Kaduna ', 0),
(20, 'Kano ', 0),
(21, 'Katsina ', 0),
(22, 'Kebbi ', 0),
(23, 'Kogi ', 0),
(24, 'Kwara ', 0),
(25, 'Lagos ', 0),
(26, 'Nasarawa ', 0),
(27, 'Niger ', 0),
(28, 'Ogun ', 0),
(29, 'Ondo ', 0),
(30, 'Osun ', 0),
(31, 'Oyo ', 0),
(32, 'Plateau ', 0),
(33, 'Rivers ', 0),
(34, 'Sokoto ', 0),
(35, 'Taraba ', 0),
(36, 'Yobe ', 0),
(37, 'Zamfara ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tool_type`
--

CREATE TABLE `tool_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tool_type`
--

INSERT INTO `tool_type` (`id`, `type`, `deleted`) VALUES
(1, 'heavy duty', 0),
(2, 'light weight', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `item_img` varchar(200) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_duration` varchar(20) NOT NULL,
  `item_price` int(100) NOT NULL,
  `transaction_ref` varchar(100) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `item_datepaid` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_uniqueid` varchar(15) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_phoneNo` varchar(15) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_lga` varchar(100) NOT NULL,
  `user_state` text NOT NULL,
  `user_address` text NOT NULL,
  `user_address2` text DEFAULT NULL,
  `delivered` int(11) NOT NULL DEFAULT 0,
  `returned` int(11) NOT NULL DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `item_img`, `item_name`, `item_duration`, `item_price`, `transaction_ref`, `paid`, `item_datepaid`, `user_uniqueid`, `user_name`, `user_phoneNo`, `user_email`, `user_city`, `user_lga`, `user_state`, `user_address`, `user_address2`, `delivered`, `returned`, `deleted`) VALUES
(1, 'wheel.jpg', 'Wheel Barrow', '2', 400000, 'AF-f2d36faf41a5e42fb0490b2c1d23f776', 1, '2022-01-30 16:55:04', 'cus-71032517', 'Ozioko Lovelyn', '09089474892', 'uzbgraphixsite@gmail.com', 'Nsukka', 'Nsukka', 'Enugu ', 'N0. 1 Nsukka street Nsukka eungu state', '', 1, 0, 0),
(2, 'wheel.jpg', 'Wheel Barrow', '4', 80000, 'AF-2f8251a0a58252b54dc40726c033eb23', 0, '2022-01-30 19:17:07', 'cus-71032517', 'Ozioko Lovelyn', '09089474892', 'uzbgraphixsite@gmail.com', 'Nsukka', 'Nsukka', 'Enugu ', 'N0. 1 Nsukka street Nsukka eungu state', '', 0, 0, 0),
(3, 'wheel.jpg', 'Wheel Barrow', '2', 40000, 'AF-2f9b7796374cdd9e7c3984632e26f40e', 1, '2022-01-31 15:58:03', 'cus-62257038', 'Ejekwu Graveth', '09152173137', 'ucodetech.wordpress@gmail.com', 'ugwulawo', 'Ofu', 'Kogi ', 'Hawawo Musa street iyogbo idah\r\nHawawo Musa street iyogbo idah', '', 1, 0, 0),
(4, '443d0d6a7e976f48cdf86e1ed36fe172-4153089d85c387f9480e8a97f23d64f5ec84.jpg', 'Axe', '2', 46000, 'AF-582247067765a305d2a29c995cb29fb8', 1, '2022-02-03 10:11:09', 'cus-89530437', 'Ozioko Lovelyn', '080849478494', 'lovelynchimaobimozioko@gmail.com', 'Eungu', 'Nsukka', 'Enugu ', 'Ozzi  Edem Nsukka', '', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `passport` varchar(200) NOT NULL DEFAULT 'default.png',
  `signature` varchar(200) NOT NULL DEFAULT 'defaultSign.png',
  `user_unique_id` varchar(15) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_tel` varchar(15) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` text NOT NULL,
  `user_state` varchar(100) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `user_lga` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `user_date_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(2) NOT NULL DEFAULT 0,
  `suspened` int(2) NOT NULL DEFAULT 0,
  `made_update` int(11) NOT NULL DEFAULT 0,
  `made_update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `passport`, `signature`, `user_unique_id`, `user_fullname`, `user_tel`, `user_email`, `user_address`, `user_state`, `user_city`, `user_lga`, `user_password`, `verified`, `user_date_joined`, `user_last_login`, `deleted`, `suspened`, `made_update`, `made_update_date`) VALUES
(2, 'default.png', 'defaultSign.png', 'cus-71032517', 'Ozioko Lovelyn', '09089474892', 'uzbgraphixsite@gmail.com', 'N0. 1 Nsukka street Nsukka eungu state', 'Enugu ', 'Nsukka', 'Nsukka', '$2y$10$aBiu3dJR8xfR/6Bj8FoHoeDw.ScVqrLlCS3dClPAyaPQlUADWTipe', 1, '2022-01-29 16:34:29', '2022-01-30 19:22:43', 0, 0, 0, '2022-01-29 16:34:29'),
(3, 'default.png', 'defaultSign.png', 'cus-62257038', 'Ejekwu Graveth', '09152173137', 'ucodetech.wordpress@gmail.com', 'Hawawo Musa street iyogbo idah\r\nHawawo Musa street iyogbo idah', 'Kogi ', 'ugwulawo', 'Ofu', '$2y$10$JM8j26zyNZgEssvGCvUFyOqbgEvIxxTZ2Us1JqP7V24kiWVygwqDe', 1, '2022-01-31 15:50:16', '2022-01-31 15:58:46', 0, 0, 0, '2022-01-31 15:50:16'),
(4, 'default.png', 'defaultSign.png', 'cus-89530437', 'Ozioko Lovelyn', '080849478494', 'lovelynchimaobimozioko@gmail.com', 'Ozzi  Edem Nsukka', 'Enugu ', 'Eungu', 'Nsukka', '$2y$10$7D4JkqT3BwculpL3UnqAiOzL8N0D6g3U.of2IJz90QCN9EVGk79yO', 1, '2022-02-03 09:51:43', '2022-02-03 16:00:32', 0, 0, 0, '2022-02-03 09:51:43'),
(5, 'default.png', 'defaultSign.png', 'cus-81890005', 'Ejekwu Graveth', '080484937393', 'ucodetut@gmail.com', 'hawawo musa street iyogbo', 'Kogi ', 'idah', 'Idah', '$2y$10$9J7znCCbv3CW0.U.PGTrIugJm6QMvzrNfvCz3m2GHGblACVsNWVeu', 0, '2022-03-11 11:12:27', '2022-03-11 11:12:27', 0, 0, 0, '2022-03-11 11:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `verifyAdmin`
--

CREATE TABLE `verifyAdmin` (
  `id` int(11) NOT NULL,
  `sudo_email` varchar(255) NOT NULL,
  `token` varchar(32) NOT NULL,
  `dateSent` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verifyAdmin`
--

INSERT INTO `verifyAdmin` (`id`, `sudo_email`, `token`, `dateSent`, `status`) VALUES
(1, 'ucodetut@gmail.com', '81470144', '2021-11-15 02:31:53', 1),
(2, 'uzbgraphixsite@gmail.com', '74695955', '2021-11-16 04:13:03', 1),
(3, 'trustgodbiz@gmail.com', '91398282', '2021-12-26 04:03:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `verifyEmail`
--

CREATE TABLE `verifyEmail` (
  `id` int(11) NOT NULL,
  `user_uniqueid` varchar(15) NOT NULL,
  `token` varchar(20) DEFAULT NULL,
  `dateVerified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verifyEmail`
--

INSERT INTO `verifyEmail` (`id`, `user_uniqueid`, `token`, `dateVerified`) VALUES
(1, 'cus-23657477', '86131264', '2022-01-28 15:51:47'),
(2, 'cus-71032517', '43941129', '2022-01-29 16:34:33'),
(3, 'cus-62257038', '12821655', '2022-01-31 15:50:25'),
(4, 'cus-89530437', '51858258', '2022-02-03 09:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `yearTable`
--

CREATE TABLE `yearTable` (
  `id` int(11) NOT NULL,
  `Deyear` year(4) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `yearTable`
--

INSERT INTO `yearTable` (`id`, `Deyear`, `deleted`) VALUES
(102, 1901, 0),
(103, 1902, 0),
(104, 1903, 0),
(105, 1904, 0),
(106, 1905, 0),
(107, 1906, 0),
(108, 1907, 0),
(109, 1908, 0),
(110, 1909, 0),
(111, 1910, 0),
(112, 1911, 0),
(113, 1912, 0),
(114, 1913, 0),
(115, 1914, 0),
(116, 1915, 0),
(117, 1916, 0),
(118, 1917, 0),
(119, 1918, 0),
(120, 1919, 0),
(121, 1920, 0),
(122, 1921, 0),
(123, 1922, 0),
(124, 1923, 0),
(125, 1924, 0),
(126, 1925, 0),
(127, 1926, 0),
(128, 1927, 0),
(129, 1928, 0),
(130, 1929, 0),
(131, 1930, 0),
(132, 1931, 0),
(133, 1932, 0),
(134, 1933, 0),
(135, 1934, 0),
(136, 1935, 0),
(137, 1936, 0),
(138, 1937, 0),
(139, 1938, 0),
(140, 1939, 0),
(141, 1940, 0),
(142, 1941, 0),
(143, 1942, 0),
(144, 1943, 0),
(145, 1944, 0),
(146, 1945, 0),
(147, 1946, 0),
(148, 1947, 0),
(149, 1948, 0),
(150, 1949, 0),
(151, 1950, 0),
(152, 1951, 0),
(153, 1952, 0),
(154, 1953, 0),
(155, 1954, 0),
(156, 1955, 0),
(157, 1956, 0),
(158, 1957, 0),
(159, 1958, 0),
(160, 1959, 0),
(161, 1960, 0),
(162, 1961, 0),
(163, 1962, 0),
(164, 1963, 0),
(165, 1964, 0),
(166, 1965, 0),
(167, 1966, 0),
(168, 1967, 0),
(169, 1968, 0),
(170, 1969, 0),
(171, 1970, 0),
(172, 1971, 0),
(173, 1972, 0),
(174, 1973, 0),
(175, 1974, 0),
(176, 1975, 0),
(177, 1976, 0),
(178, 1977, 0),
(179, 1978, 0),
(180, 1979, 0),
(181, 1980, 0),
(182, 1981, 0),
(183, 1982, 0),
(184, 1983, 0),
(185, 1984, 0),
(186, 1985, 0),
(187, 1986, 0),
(188, 1987, 0),
(189, 1988, 0),
(190, 1989, 0),
(191, 1990, 0),
(192, 1991, 0),
(193, 1992, 0),
(194, 1993, 0),
(195, 1994, 0),
(196, 1995, 0),
(197, 1996, 0),
(198, 1997, 0),
(199, 1998, 0),
(200, 1999, 0),
(201, 2000, 0),
(202, 2001, 0),
(203, 2002, 0),
(204, 2003, 0),
(205, 2004, 0),
(206, 2005, 0),
(207, 2006, 0),
(208, 2007, 0),
(209, 2008, 0),
(210, 2009, 0),
(211, 2010, 0),
(212, 2011, 0),
(213, 2012, 0),
(214, 2013, 0),
(215, 2014, 0),
(216, 2015, 0),
(217, 2016, 0),
(218, 2017, 0),
(219, 2018, 0),
(220, 2019, 0),
(221, 2020, 0),
(222, 2021, 0),
(223, 2022, 0),
(224, 2023, 0),
(225, 2024, 0),
(226, 2025, 0),
(227, 2026, 0),
(228, 2027, 0),
(229, 2028, 0),
(230, 2029, 0),
(231, 2030, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminOtp`
--
ALTER TABLE `adminOtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duration_weeks`
--
ALTER TABLE `duration_weeks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmTools`
--
ALTER TABLE `farmTools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lga`
--
ALTER TABLE `lga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdReset`
--
ALTER TABLE `pwdReset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secureOtp`
--
ALTER TABLE `secureOtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secureQuestion`
--
ALTER TABLE `secureQuestion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tool_type`
--
ALTER TABLE `tool_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `verifyAdmin`
--
ALTER TABLE `verifyAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifyEmail`
--
ALTER TABLE `verifyEmail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yearTable`
--
ALTER TABLE `yearTable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `adminOtp`
--
ALTER TABLE `adminOtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `duration_weeks`
--
ALTER TABLE `duration_weeks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farmTools`
--
ALTER TABLE `farmTools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lga`
--
ALTER TABLE `lga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pwdReset`
--
ALTER TABLE `pwdReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secureOtp`
--
ALTER TABLE `secureOtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `secureQuestion`
--
ALTER TABLE `secureQuestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tool_type`
--
ALTER TABLE `tool_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verifyAdmin`
--
ALTER TABLE `verifyAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verifyEmail`
--
ALTER TABLE `verifyEmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yearTable`
--
ALTER TABLE `yearTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
