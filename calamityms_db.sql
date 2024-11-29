-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 03:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calamityms_db`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `calamities_this_year`
-- (See below for the actual view)
--
CREATE TABLE `calamities_this_year` (
`id` int(11)
,`calamity_active` tinyint(1)
,`calamity_date` date
,`calamity_time` time
,`calamity_description` varchar(255)
,`status_id` varchar(255)
,`status_level` varchar(255)
,`status_color` varchar(255)
,`status_description` varchar(255)
,`type_calamity_id` varchar(255)
,`type_calamity_type` varchar(255)
,`type_calamity_description` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_access`
--

CREATE TABLE `tbl_admin_access` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_access`
--

INSERT INTO `tbl_admin_access` (`id`, `username`, `password`, `fullname`) VALUES
(1, 'admin', 'admin', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `id` int(255) NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `announcement_description` varchar(255) NOT NULL,
  `announcement_date` date NOT NULL,
  `announcement_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`id`, `announcement_title`, `announcement_description`, `announcement_date`, `announcement_time`) VALUES
(9, 'Relief Goods', 'asdasdasdasdasd', '2024-11-12', '12:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calamity`
--

CREATE TABLE `tbl_calamity` (
  `id` int(11) NOT NULL,
  `calamity_id` varchar(255) NOT NULL,
  `calamity_type_id` varchar(255) NOT NULL,
  `calamity_status_id` varchar(255) NOT NULL,
  `calamity_description` varchar(255) NOT NULL,
  `calamity_active` tinyint(1) NOT NULL,
  `calamity_date` date NOT NULL,
  `calamity_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_calamity`
--

INSERT INTO `tbl_calamity` (`id`, `calamity_id`, `calamity_type_id`, `calamity_status_id`, `calamity_description`, `calamity_active`, `calamity_date`, `calamity_time`) VALUES
(1, 'CALMITY-001', 'TYPE-001', 'Lvl-1', 'Bagyong Undoy', 1, '2024-10-08', '07:19:00'),
(2, 'CALMITY-002', 'TYPE-002', 'Lvl-2', 'Bagyong Undoy', 0, '2024-10-02', '08:52:00'),
(4, 'CALAMITY-003', 'TYPE-001', 'Lvl-1', 'Bagyong Undoy', 0, '2024-10-08', '07:19:00'),
(5, 'CALAMITY-A8F5D19FEF', 'TYPE-004', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-17', '22:00:00'),
(6, 'CALAMITY-BE49E1A565', 'TYPE-003', 'Lvl-2', 'Bagyong Undoy', 0, '2024-10-18', '14:12:00'),
(7, 'CALAMITY-625ABB7B9E', 'TYPE-004', 'Lvl-2', 'Bagyong Undoy', 0, '2024-10-18', '18:10:00'),
(8, 'CALAMITY-2B0CEBE98E', 'TYPE-001', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-18', '20:00:00'),
(9, 'CALAMITY-A7E644B520', 'TYPE-002', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-20', '14:47:00'),
(10, 'CALAMITY-ED18EE29C9', 'TYPE-005', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-21', '15:10:00'),
(11, 'CALAMITY-61579C72C0', 'TYPE-001', 'Lvl-1', 'Bagyong Undoy', 0, '2024-11-12', '12:36:00'),
(12, 'CALAMITY-2FD59C0734', 'TYPE-002', 'Lvl-4', 'Bagyong Undoy', 1, '2024-11-24', '20:05:00'),
(13, 'CALAMITY-DF119E3B01', 'TYPE-002', 'Lvl-2', 'Magninture 2.4', 0, '2024-11-29', '21:41:00'),
(14, 'CALAMITY-D8133C5060', 'TYPE-004', 'Lvl-3', 'Soil Problem', 0, '2024-11-27', '21:42:00'),
(15, 'CALAMITY-E02620C3E4', 'TYPE-003', 'Lvl-5', 'High Rise of Watter', 1, '2024-11-30', '21:46:00'),
(16, 'CALAMITY-5365A2CF4D', 'TYPE-005', 'Lvl-2', '222', 1, '2024-11-29', '21:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calamity_status`
--

CREATE TABLE `tbl_calamity_status` (
  `id` int(11) NOT NULL,
  `status_id` varchar(255) NOT NULL,
  `status_level` varchar(255) NOT NULL,
  `status_color` varchar(255) NOT NULL,
  `status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_calamity_status`
--

INSERT INTO `tbl_calamity_status` (`id`, `status_id`, `status_level`, `status_color`, `status_description`) VALUES
(1, 'Lvl-1', '1', 'Green', 'Low risk. Situation is normal, but monitoring is ongoing.'),
(2, 'Lvl-2', '2', 'YellowGreen', 'Slight risk. Authorities are on alert but no immediate action is required.'),
(3, 'Lvl-3', '3', 'Yellow', 'Moderate risk. Prepare for possible evacuation or action. Advisory issued.'),
(4, 'Lvl-4', '4', 'Orange', 'High risk. Evacuations may be recommended. Stay updated with official alerts.'),
(5, 'Lvl-5', '5', 'Red', 'Severe risk. Immediate action required (evacuation, lockdown, or shelter-in-place). Critical danger.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evacuation_location`
--

CREATE TABLE `tbl_evacuation_location` (
  `id` int(11) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_description` varchar(255) NOT NULL,
  `location_latitude` varchar(255) NOT NULL,
  `location_longhitude` varchar(255) NOT NULL,
  `location_current_no_of_evacuue` int(255) NOT NULL,
  `location_max_accommodate` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evacuation_location`
--

INSERT INTO `tbl_evacuation_location` (`id`, `location_id`, `location_name`, `location_description`, `location_latitude`, `location_longhitude`, `location_current_no_of_evacuue`, `location_max_accommodate`) VALUES
(9, 'LOCID-60AFBD759F', 'Tadlong', 'Filomino Pascual Elementary School', '10.8680771', '123.3461495', 100, 100),
(11, 'LOCID-F6C479EDFF', 'Tadlong', 'Hautea Elementary School', '10.8481295', '123.3455575', 100, 200),
(12, 'LOCID-27847EC0CB', 'Fabrica', 'Gil Lopez Elementary School', '10.8824647', '123.3475769', 200, 250),
(14, 'LOCID-07C9BDD16F', 'Paraiso', 'Eusebio Lopez Memorial Integrated School', '10.8900853', '123.3540872', 10, 500),
(15, 'LOCID-AF31286965', 'Paraiso', 'Eusebio Lopez Memorial Integrated School', '10.89024011', '123.35710957', 10, 500),
(16, 'LOCID-CD48F63BC1', 'Paraiso', 'Josebio Lopez Elementary School ', '10.8926998', '123.3524657', 0, 200),
(17, 'LOCID-60AFBD759F', 'Malubon', 'Uychiat Elementary School', '10.8686271', '123.3688204', 0, 200),
(18, 'LOCID-60AFBD759G', 'Malubon', 'Valeriana Añalucas Elementary School', '10.8692792', '123.374092', 0, 200),
(19, 'LOCID-F6C479ED01', 'Himoga-an Baybay', 'Himoga-an Baybay', '10.95533879', '123.38762770', 0, 200),
(20, 'LOCID-F6C479ED02', 'Himoga-an Baybay', 'Cesar Gamboa Elem. School', '10.91980317', '123.38120563', 100, 200),
(21, 'LOCID-F6C479ED03', 'Himoga-an Baybay', 'St. Mahilum Elementary School', '10.95410175', '123.39236322', 0, 200),
(22, 'LOCID-70BDC879A1', 'Pob 1', 'Jose B. Puey Elementary School', '10.8935424', '123.4129442', 0, 200),
(23, 'LOCID-70BDC879A2', 'Poblacion II (Barangay 2)', 'Sagay National Highschool', '10.88705149', '123.35101699', 0, 500),
(24, 'LOCID-70BDC879A3', 'Pob 2', 'Ma. Lopez Elementary School', '10.894821', '123.4122776', 0, 200),
(25, 'LOCID-70BDC879A4', 'Old Sagay', 'Old Sagay Elementary School', '10.9411558', '123.4214506', 0, 200),
(26, 'LOCID-70BDC879A5', 'Old Sagay', 'SNHS- Old Sagay Extension', '10.932724', '123.4246615', 0, 200),
(27, 'LOCID-70BDC879A6', 'Old Sagay', 'Buenaventura V. Rodriguez Elementary School', '10.9335186', '123.4077439', 0, 200),
(28, 'LOCID-70BDC879A7', 'Tabao', 'PR. Katalbas II Elementary School', '10.914497', '123.4380444', 0, 200),
(29, 'LOCID-70BDC879A8', 'Bulanon', 'Bulanon Elementary School', '10.9159572', '123.4715374', 0, 200),
(30, 'LOCID-70BDC879A9', 'Bulanon', 'Talusan Elementary School', '10.90547581', '123.36309736', 0, 200),
(31, 'LOCID-70BDC879AA', 'Bulanon', 'Onofre Dela Paz Elementary School', '10.9026922', '123.446554', 0, 200),
(32, 'LOCID-70BDC879AB', 'Bulanon', 'Bulanon- National Highschool', '10.9149807', '123.4695134', 0, 200),
(33, 'LOCID-70BDC879AC', 'Vito', 'Vito Elementary School', '10.91727486', '123.48900232', 0, 200),
(34, 'LOCID-70BDC879AD', 'Vito', 'CPO Santiago Elementary School', '10.91827776', '123.48182954', 0, 200),
(35, 'LOCID-70BDC879AE', 'Vito', 'Tuong Elementary School', '10.8875751', '123.5130963', 0, 200),
(36, 'LOCID-70BDC879AF', 'Rafaela Barera', 'Raymundo Tupad Elementary School', '10.8766336', '123.4606916', 0, 200),
(37, 'LOCID-70BDC879B0', 'General Luna', 'General Luna', '10.90025036', '123.46609036', 0, 200),
(38, 'LOCID-70BDC879B1', 'General Luna', 'SNHS- General Luna Extension', '10.85616755', '123.43218668', 0, 200),
(39, 'LOCID-70BDC879B2', 'Lopez Jaena', 'Lopez Jaena Elementary School', '10.8314724', '123.3370742', 0, 200),
(40, 'LOCID-70BDC879B3', 'Lopez Jaena', 'SNHS Lopez Jaena Extension', '10.8315832', '123.4002351', 0, 200),
(41, 'LOCID-70BDC879B4', 'Lopez Jaena', 'Briones Salcedo Elementary School', '10.8269886', '123.3976436', 0, 200),
(42, 'LOCID-70BDC879B5', 'Rizal', 'AEMSES-SOF', '10.8615659', '123.4074404', 0, 200),
(43, 'LOCID-70BDC879B6', 'Rizal', 'AEMSES', '10.8614816', '123.4063608', 0, 200),
(44, 'LOCID-70BDC879B7', 'Rizal', 'SNHS Rizal Extension', '10.8580734', '123.4038019', 0, 200),
(45, 'LOCID-70BDC879B8', 'Bato', 'Bato Central Elementary School', '10.8082456', '123.3762833', 0, 200),
(46, 'LOCID-70BDC879B9', 'Bato', 'Bato National Highschool', '10.8082561', '123.3762833', 0, 200),
(47, 'LOCID-70BDC879BA', 'Camp Himoga-an', 'CPO. Himogaan Elementary School', '10.8325233', '123.366531', 0, 200),
(48, 'LOCID-70BDC879BB', 'Camp Himoga-an', 'Hamticon Elementary School', '10.7501411', '123.3191122', 0, 200),
(49, 'LOCID-70BDC879BC', 'Maquiling', 'Maquiling Elementary School', '10.7885597', '123.3706955', 0, 200),
(50, 'LOCID-70BDC879BD', 'Maquiling', 'Melchor Salcedo Elementary School', '10.7907249', '123.3621979', 0, 200),
(51, 'LOCID-70BDC879BE', 'Puey', 'CPO. Bago National Highschool', '10.73808919', '123.31846465', 0, 200),
(52, 'LOCID-70BDC879BF', 'Puey', 'Manara Elementary School', '10.73560206', '123.30437243', 0, 200),
(53, 'LOCID-70BDC879BG', 'Sewahon', 'Sewahon National Highschool', '10.7916828', '123.3200007', 0, 200),
(54, 'LOCID-70BDC879BH', 'Sewahon', 'RT Halipa Elementary School', '10.7917834', '123.3034411', 0, 200),
(55, 'LOCID-70BDC879BI', 'Bato', 'CPO Santiago Elementary School', '10.80642961', '123.34094300', 0, 200),
(56, 'LOCID-70BDC879BJ', 'Sewahon', 'S.V Aguilar Integrated School', '10.8193864', '123.3254965', 0, 200),
(57, 'LOCID-70BDC879BK', 'Sewahon', 'Pacol Elementary School', '10.80676685', '123.32506052', 0, 200),
(58, 'LOCID-70BDC879BL', 'Divina Colonia', 'Colonia Divina Integrated School', '10.7676816', '123.3075984', 0, 200),
(59, 'LOCID-70BDC879BM', 'Plaridel', 'Plaridel Elementary School', '10.8986566', '123.4615944', 0, 200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evacuees_info`
--

CREATE TABLE `tbl_evacuees_info` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `isPwd` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evacuees_info`
--

INSERT INTO `tbl_evacuees_info` (`id`, `fullname`, `address`, `age`, `birthdate`, `sex`, `isPwd`) VALUES
(1, 'John Dope', 'brgy.old', '24', '10/10/2024', 'Male', 1),
(2, 'jerome natividad', 'Sagay City, Negros Occidental', '24', '2024-06-29', 'Male', 1),
(3, 'Test Test', 'Cadiz City, Negros Occidental', '123', '2024-11-01', 'Female', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facilitator_access`
--

CREATE TABLE `tbl_facilitator_access` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_facilitator_access`
--

INSERT INTO `tbl_facilitator_access` (`id`, `username`, `password`) VALUES
(1, 'facilitator', 'facilitator'),
(2, 'facilitator1', 'facilitator1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_of_calamity`
--

CREATE TABLE `tbl_type_of_calamity` (
  `id` int(11) NOT NULL,
  `type_calamity_id` varchar(255) NOT NULL,
  `type_calamity_type` varchar(255) NOT NULL,
  `type_calamity_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type_of_calamity`
--

INSERT INTO `tbl_type_of_calamity` (`id`, `type_calamity_id`, `type_calamity_type`, `type_calamity_description`) VALUES
(1, 'TYPE-001', 'Storm', 'This is natural disaster'),
(2, 'TYPE-002', 'Earthquake', 'A sudden shaking of the ground caused by tectonic shifts.'),
(3, 'TYPE-003', 'Flood', 'An overflow of water that submerges land, often due to heavy rainfall.'),
(4, 'TYPE-004', 'Landslide', 'A mass movement of rock, debris, or earth down a slope.'),
(5, 'TYPE-005', 'Drought', 'A prolonged period of abnormally low rainfall, leading to water shortages.');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_monthly_calamity_counts`
-- (See below for the actual view)
--
CREATE TABLE `view_monthly_calamity_counts` (
`month_name` varchar(9)
,`calamity_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_top_calamity_type`
-- (See below for the actual view)
--
CREATE TABLE `view_top_calamity_type` (
`calamity_type` varchar(255)
,`calamity_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_total`
-- (See below for the actual view)
--
CREATE TABLE `view_total` (
`total_evacuations` bigint(21)
,`active_calamities` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `calamities_this_year`
--
DROP TABLE IF EXISTS `calamities_this_year`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `calamities_this_year`  AS SELECT `c`.`id` AS `id`, `c`.`calamity_active` AS `calamity_active`, `c`.`calamity_date` AS `calamity_date`, `c`.`calamity_time` AS `calamity_time`, `c`.`calamity_description` AS `calamity_description`, `cs`.`status_id` AS `status_id`, `cs`.`status_level` AS `status_level`, `cs`.`status_color` AS `status_color`, `cs`.`status_description` AS `status_description`, `tc`.`type_calamity_id` AS `type_calamity_id`, `tc`.`type_calamity_type` AS `type_calamity_type`, `tc`.`type_calamity_description` AS `type_calamity_description` FROM ((`tbl_calamity` `c` join `tbl_calamity_status` `cs` on(`c`.`calamity_status_id` = `cs`.`status_id`)) join `tbl_type_of_calamity` `tc` on(`c`.`calamity_type_id` = `tc`.`type_calamity_id`)) WHERE `c`.`calamity_active` = 0 AND year(`c`.`calamity_date`) = year(curdate()) ORDER BY `c`.`calamity_date` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `view_monthly_calamity_counts`
--
DROP TABLE IF EXISTS `view_monthly_calamity_counts`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_monthly_calamity_counts`  AS SELECT monthname(`tbl_calamity`.`calamity_date`) AS `month_name`, count(0) AS `calamity_count` FROM `tbl_calamity` GROUP BY month(`tbl_calamity`.`calamity_date`) ORDER BY month(`tbl_calamity`.`calamity_date`) ASC ;

-- --------------------------------------------------------

--
-- Structure for view `view_top_calamity_type`
--
DROP TABLE IF EXISTS `view_top_calamity_type`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_top_calamity_type`  AS SELECT `tc`.`type_calamity_type` AS `calamity_type`, count(`c`.`id`) AS `calamity_count` FROM (`tbl_calamity` `c` join `tbl_type_of_calamity` `tc` on(`c`.`calamity_type_id` = `tc`.`type_calamity_id`)) WHERE year(`c`.`calamity_date`) = year(curdate()) GROUP BY `tc`.`type_calamity_type` ORDER BY count(`c`.`id`) DESC ;

-- --------------------------------------------------------

--
-- Structure for view `view_total`
--
DROP TABLE IF EXISTS `view_total`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `view_total`  AS SELECT (select count(`tbl_evacuation_location`.`id`) from `tbl_evacuation_location`) AS `total_evacuations`, (select count(`tbl_calamity`.`id`) from `tbl_calamity` where `tbl_calamity`.`calamity_active` = 1) AS `active_calamities` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_calamity`
--
ALTER TABLE `tbl_calamity`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `calamity_id_2` (`calamity_id`),
  ADD KEY `calamity_id` (`calamity_type_id`),
  ADD KEY `calamity_status_id` (`calamity_status_id`);

--
-- Indexes for table `tbl_calamity_status`
--
ALTER TABLE `tbl_calamity_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `tbl_evacuation_location`
--
ALTER TABLE `tbl_evacuation_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `tbl_evacuees_info`
--
ALTER TABLE `tbl_evacuees_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_facilitator_access`
--
ALTER TABLE `tbl_facilitator_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type_of_calamity`
--
ALTER TABLE `tbl_type_of_calamity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calamity_id` (`type_calamity_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_access`
--
ALTER TABLE `tbl_admin_access`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_calamity`
--
ALTER TABLE `tbl_calamity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_calamity_status`
--
ALTER TABLE `tbl_calamity_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_evacuation_location`
--
ALTER TABLE `tbl_evacuation_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbl_evacuees_info`
--
ALTER TABLE `tbl_evacuees_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_facilitator_access`
--
ALTER TABLE `tbl_facilitator_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_type_of_calamity`
--
ALTER TABLE `tbl_type_of_calamity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_calamity`
--
ALTER TABLE `tbl_calamity`
  ADD CONSTRAINT `status id` FOREIGN KEY (`calamity_status_id`) REFERENCES `tbl_calamity_status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type of calamity` FOREIGN KEY (`calamity_type_id`) REFERENCES `tbl_type_of_calamity` (`type_calamity_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
