-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2024 at 12:32 AM
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
  `calamity_time` time NOT NULL,
  `calamity_end_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_calamity`
--

INSERT INTO `tbl_calamity` (`id`, `calamity_id`, `calamity_type_id`, `calamity_status_id`, `calamity_description`, `calamity_active`, `calamity_date`, `calamity_time`, `calamity_end_datetime`) VALUES
(1, 'CALMITY-001', 'TYPE-001', 'Lvl-1', 'Bagyong Undoy', 0, '2024-12-13', '07:19:00', '2024-12-13 20:34:21'),
(2, 'CALMITY-002', 'TYPE-002', 'Lvl-2', 'Bagyong Undoy', 0, '2024-10-02', '08:52:00', '2024-12-13 07:16:42'),
(4, 'CALAMITY-003', 'TYPE-001', 'Lvl-1', 'Bagyong Undoy', 0, '2024-10-08', '07:19:00', '2024-12-13 07:16:42'),
(5, 'CALAMITY-A8F5D19FEF', 'TYPE-004', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-17', '22:00:00', '2024-12-13 07:16:42'),
(6, 'CALAMITY-BE49E1A565', 'TYPE-003', 'Lvl-2', 'Bagyong Undoy', 0, '2024-10-18', '14:12:00', '2024-12-13 07:16:42'),
(7, 'CALAMITY-625ABB7B9E', 'TYPE-004', 'Lvl-2', 'Bagyong Undoy', 0, '2024-10-18', '18:10:00', '2024-12-13 07:16:42'),
(8, 'CALAMITY-2B0CEBE98E', 'TYPE-001', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-18', '20:00:00', '2024-12-13 07:16:42'),
(9, 'CALAMITY-A7E644B520', 'TYPE-002', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-20', '14:47:00', '2024-12-13 07:16:42'),
(10, 'CALAMITY-ED18EE29C9', 'TYPE-005', 'Lvl-5', 'Bagyong Undoy', 0, '2024-10-21', '15:10:00', '2024-12-13 07:16:42'),
(11, 'CALAMITY-61579C72C0', 'TYPE-001', 'Lvl-1', 'Bagyong Undoy', 0, '2024-11-12', '12:36:00', '2024-12-13 07:16:42'),
(12, 'CALAMITY-2FD59C0734', 'TYPE-002', 'Lvl-4', 'Bagyong Laura', 0, '2024-11-24', '20:05:00', '2024-12-13 07:23:46'),
(13, 'CALAMITY-DF119E3B01', 'TYPE-002', 'Lvl-2', 'Magninture 2.4', 0, '2024-11-29', '21:41:00', '2024-12-13 07:16:42'),
(14, 'CALAMITY-D8133C5060', 'TYPE-004', 'Lvl-3', 'Soil Problem', 0, '2024-11-27', '21:42:00', '2024-12-13 07:16:42'),
(15, 'CALAMITY-E02620C3E4', 'TYPE-003', 'Lvl-5', 'High Rise of Watter', 0, '2024-11-30', '21:46:00', '2024-12-14 05:32:13'),
(16, 'CALAMITY-5365A2CF4D', 'TYPE-005', 'Lvl-2', '222', 0, '2024-11-30', '21:45:00', '2024-12-13 07:16:42'),
(17, 'CALAMITY-6E760FC3BB', 'TYPE-001', 'Lvl-2', 'Bagyong Neneng', 0, '2024-12-14', '05:32:00', '2024-12-14 05:35:59');

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
  `location_max_accommodate` int(255) NOT NULL,
  `facilitator_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evacuation_location`
--

INSERT INTO `tbl_evacuation_location` (`id`, `location_id`, `location_name`, `location_description`, `location_latitude`, `location_longhitude`, `location_current_no_of_evacuue`, `location_max_accommodate`, `facilitator_id`) VALUES
(9, 'LOCID-60AFBD7345', 'Tadlong', 'Filomino Pascual Elementary School', '10.8680771', '123.3461495', 0, 100, 10),
(11, 'LOCID-F6C479EDFF', 'Tadlong', 'Hautea Elementary School', '10.8481295', '123.3455575', 0, 200, 11),
(12, 'LOCID-27847EC0CB', 'Fabrica', 'Gil Lopez Elementary School', '10.8824647', '123.3475769', 0, 250, 12),
(14, 'LOCID-07C9BDD16F', 'Paraiso', 'Eusebio Lopez Memorial Integrated School', '10.8900853', '123.3540872', 0, 500, 14),
(15, 'LOCID-AF31286965', 'Paraiso', 'Eusebio Lopez Memorial Integrated School', '10.89024011', '123.35710957', 0, 500, 15),
(16, 'LOCID-CD48F63BC1', 'Paraiso', 'Josebio Lopez Elementary School ', '10.8926998', '123.3524657', 0, 200, 16),
(17, 'LOCID-60AFBD759F', 'Malubon', 'Uychiat Elementary School', '10.8686271', '123.3688204', 0, 200, 17),
(18, 'LOCID-60AFBD759G', 'Malubon', 'Valeriana Añalucas Elementary School', '10.8692792', '123.374092', 0, 200, 18),
(19, 'LOCID-F6C479ED01', 'Himoga-an Baybay', 'Himoga-an Baybay', '10.95533879', '123.38762770', 0, 200, 19),
(20, 'LOCID-F6C479ED02', 'Himoga-an Baybay', 'Cesar Gamboa Elem. School', '10.91980317', '123.38120563', 0, 200, 20),
(21, 'LOCID-F6C479ED03', 'Himoga-an Baybay', 'St. Mahilum Elementary School', '10.95410175', '123.39236322', 0, 200, 21),
(22, 'LOCID-70BDC879A1', 'Pob 1', 'Jose B. Puey Elementary School', '10.8935424', '123.4129442', 0, 200, 22),
(23, 'LOCID-70BDC879A2', 'Poblacion II (Barangay 2)', 'Sagay National Highschool', '10.88705149', '123.35101699', 0, 500, 23),
(24, 'LOCID-70BDC879A3', 'Pob 2', 'Ma. Lopez Elementary School', '10.894821', '123.4122776', 0, 200, 24),
(25, 'LOCID-70BDC879A4', 'Old Sagay', 'Old Sagay Elementary School', '10.9411558', '123.4214506', 0, 200, 25),
(26, 'LOCID-70BDC879A5', 'Old Sagay', 'SNHS- Old Sagay Extension', '10.932724', '123.4246615', 0, 200, 26),
(27, 'LOCID-70BDC879A6', 'Old Sagay', 'Buenaventura V. Rodriguez Elementary School', '10.9335186', '123.4077439', 0, 200, 27),
(28, 'LOCID-70BDC879A7', 'Tabao', 'PR. Katalbas II Elementary School', '10.914497', '123.4380444', 0, 200, 28),
(29, 'LOCID-70BDC879A8', 'Bulanon', 'Bulanon Elementary School', '10.9159572', '123.4715374', 0, 200, 29),
(30, 'LOCID-70BDC879A9', 'Bulanon', 'Talusan Elementary School', '10.90547581', '123.36309736', 0, 200, 30),
(31, 'LOCID-70BDC879AA', 'Bulanon', 'Onofre Dela Paz Elementary School', '10.9026922', '123.446554', 0, 200, 31),
(32, 'LOCID-70BDC879AB', 'Bulanon', 'Bulanon- National Highschool', '10.9149807', '123.4695134', 0, 200, 32),
(33, 'LOCID-70BDC879AC', 'Vito', 'Vito Elementary School', '10.91727486', '123.48900232', 0, 200, 33),
(34, 'LOCID-70BDC879AD', 'Vito', 'CPO Santiago Elementary School', '10.91827776', '123.48182954', 0, 200, 34),
(35, 'LOCID-70BDC879AE', 'Vito', 'Tuong Elementary School', '10.8875751', '123.5130963', 0, 200, 35),
(36, 'LOCID-70BDC879AF', 'Rafaela Barera', 'Raymundo Tupad Elementary School', '10.8766336', '123.4606916', 0, 200, 36),
(37, 'LOCID-70BDC879B0', 'General Luna', 'General Luna', '10.90025036', '123.46609036', 0, 200, 37),
(38, 'LOCID-70BDC879B1', 'General Luna', 'SNHS- General Luna Extension', '10.85616755', '123.43218668', 0, 200, 38),
(39, 'LOCID-70BDC879B2', 'Lopez Jaena', 'Lopez Jaena Elementary School', '10.8314724', '123.3370742', 0, 200, 39),
(40, 'LOCID-70BDC879B3', 'Lopez Jaena', 'SNHS Lopez Jaena Extension', '10.8315832', '123.4002351', 0, 200, 40),
(41, 'LOCID-70BDC879B4', 'Lopez Jaena', 'Briones Salcedo Elementary School', '10.8269886', '123.3976436', 0, 200, 41),
(42, 'LOCID-70BDC879B5', 'Rizal', 'AEMSES-SOF', '10.8615659', '123.4074404', 0, 200, 42),
(43, 'LOCID-70BDC879B6', 'Rizal', 'AEMSES', '10.8614816', '123.4063608', 0, 200, 43),
(44, 'LOCID-70BDC879B7', 'Rizal', 'SNHS Rizal Extension', '10.8580734', '123.4038019', 0, 200, 44),
(45, 'LOCID-70BDC879B8', 'Bato', 'Bato Central Elementary School', '10.8082456', '123.3762833', 0, 200, 45),
(46, 'LOCID-70BDC879B9', 'Bato', 'Bato National Highschool', '10.8082561', '123.3762833', 0, 200, 46),
(47, 'LOCID-70BDC879BA', 'Camp Himoga-an', 'CPO. Himogaan Elementary School', '10.8325233', '123.366531', 0, 200, 47),
(48, 'LOCID-70BDC879BB', 'Camp Himoga-an', 'Hamticon Elementary School', '10.7501411', '123.3191122', 0, 200, 48),
(49, 'LOCID-70BDC879BC', 'Maquiling', 'Maquiling Elementary School', '10.7885597', '123.3706955', 0, 200, 49),
(50, 'LOCID-70BDC879BD', 'Maquiling', 'Melchor Salcedo Elementary School', '10.7907249', '123.3621979', 0, 200, 50),
(51, 'LOCID-70BDC879BE', 'Puey', 'CPO. Bago National Highschool', '10.73808919', '123.31846465', 0, 200, 51),
(52, 'LOCID-70BDC879BF', 'Puey', 'Manara Elementary School', '10.73560206', '123.30437243', 0, 200, 52),
(53, 'LOCID-70BDC879BG', 'Sewahon', 'Sewahon National Highschool', '10.7916828', '123.3200007', 0, 200, 53),
(54, 'LOCID-70BDC879BH', 'Sewahon', 'RT Halipa Elementary School', '10.7917834', '123.3034411', 0, 200, 54),
(55, 'LOCID-70BDC879BI', 'Bato', 'CPO Santiago Elementary School', '10.80642961', '123.34094300', 0, 200, 55),
(56, 'LOCID-70BDC879BJ', 'Sewahon', 'S.V Aguilar Integrated School', '10.8193864', '123.3254965', 0, 200, 56),
(57, 'LOCID-70BDC879BK', 'Sewahon', 'Pacol Elementary School', '10.80676685', '123.32506052', 0, 200, 57),
(58, 'LOCID-70BDC879BL', 'Divina Colonia', 'Colonia Divina Integrated School', '10.7676816', '123.3075984', 0, 200, 58),
(59, 'LOCID-70BDC879BM', 'Plaridel', 'Plaridel Elementary School', '10.8986566', '123.4615944', 0, 200, 59);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evacuees_info`
--

CREATE TABLE `tbl_evacuees_info` (
  `id` int(11) NOT NULL,
  `evacuation_locid` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `isPwd` tinyint(1) NOT NULL,
  `isSenior` tinyint(1) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evacuees_info`
--

INSERT INTO `tbl_evacuees_info` (`id`, `evacuation_locid`, `fullname`, `address`, `age`, `birthdate`, `sex`, `isPwd`, `isSenior`, `isActive`, `created_date`) VALUES
(1, 'LOCID-60AFBD759F', 'John Dope', 'brgy.old', '24', '2024-06-29', 'Male', 0, 0, 0, '2024-11-30 01:51:51'),
(2, 'LOCID-27847EC0CB', 'jerome natividad', 'Sagay City, Negros Occidental', '24', '2024-06-29', 'Male', 1, 0, 0, '2024-11-30 01:51:51'),
(3, 'LOCID-27847EC0CB', 'Test Test', 'Cadiz City, Negros Occidental', '123', '2024-11-01', 'Female', 0, 0, 0, '2024-11-30 01:51:51'),
(4, 'LOCID-27847EC0CB', 'ss', 'ss', '22', '2024-11-30', 'Male', 1, 0, 0, '2024-11-30 02:30:55'),
(5, 'LOCID-07C9BDD16F', 'Marcky Marts', 'Street Villaren', '24', '2024-11-30', 'Male', 0, 0, 0, '2024-11-30 02:31:35'),
(6, 'LOCID-60AFBD759F', 'Mark David Libero', 'Sagay City, Negros Occidental', '61', '2000-01-19', 'Male', 0, 0, 0, '2024-12-10 10:45:29'),
(7, 'LOCID-60AFBD759F', 'asdsadasd asddas', 'Sagay City, Negros Occidental', '23', '2024-12-04', 'Female', 0, 0, 0, '2024-12-10 10:48:08'),
(8, 'LOCID-60AFBD759F', 's', 's', '23', '2024-12-18', 'Male', 0, 0, 0, '2024-12-10 10:51:28'),
(9, 'LOCID-60AFBD759F', 'ss', 'sss', '232', '2024-12-03', 'Male', 0, 0, 0, '2024-12-10 10:53:03'),
(10, 'LOCID-60AFBD759F', 'g', 'b', '23', '2025-01-02', 'Female', 0, 0, 0, '2024-12-10 10:55:15'),
(11, 'LOCID-60AFBD759F', 'c', 'c', '23', '2004-09-20', 'Male', 1, 1, 0, '2024-12-10 10:56:05'),
(12, 'LOCID-60AFBD759F', 'vcx', 's', '35', '2024-12-20', 'Male', 1, 0, 0, '2024-12-10 10:56:36'),
(13, 'LOCID-60AFBD759F', 'x', 's', '34', '2004-09-09', 'Male', 0, 1, 0, '2024-12-10 10:56:50'),
(14, 'LOCID-60AFBD759F', 'sssssss', 'ssssssss', '23', '2024-12-09', 'Male', 1, 0, 0, '2024-12-13 12:07:09'),
(15, 'LOCID-F6C479EDFF', 'isa', 'duwa', '3', '20000-09-29', 'Female', 1, 1, 0, '2024-12-13 12:33:45'),
(16, 'LOCID-60AFBD759F', 'f9', 'f9', '12', '2000-09-09', 'Male', 1, 0, 0, '2024-12-13 21:33:07'),
(17, 'LOCID-F6C479EDFF', 'f11', 'f11', '20', '20000-02-02', 'Female', 0, 1, 0, '2024-12-13 21:33:32'),
(18, 'LOCID-AF31286965', 'f15', 'f15', '15', '2001-12-15', 'Female', 1, 0, 0, '2024-12-13 21:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_facilitator_access`
--

CREATE TABLE `tbl_facilitator_access` (
  `id` int(11) NOT NULL,
  `facilitator_username` varchar(255) NOT NULL,
  `facilitator_password` varchar(255) NOT NULL,
  `facilitator_fullname` varchar(255) NOT NULL,
  `facilitator_contact_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_facilitator_access`
--

INSERT INTO `tbl_facilitator_access` (`id`, `facilitator_username`, `facilitator_password`, `facilitator_fullname`, `facilitator_contact_number`) VALUES
(10, 'f9', 'f9', 'Emma White', '09054805569'),
(11, 'f11', 'f11', 'Matthew Moore', '09054805570'),
(12, 'f12', 'f12', 'Sophia Thompson', '09054805571'),
(13, 'f13', 'f13', 'Anthony Garcia', '09054805572'),
(14, 'f14', 'f14', 'Olivia Harris', '09054805573'),
(15, 'f15', 'f15', 'Joshua Martin', '09054805574'),
(16, 'f16', 'f16', 'Mia Clark', '09054805575'),
(17, 'f17', 'f17', 'Andrew Rodriguez', '09054805576'),
(18, 'f18', 'f18', 'Isabella Lewis', '09054805577'),
(19, 'f19', 'f19', 'Ryan Lee', '09054805578'),
(20, 'f20', 'f20', 'Charlotte Walker', '09054805579'),
(21, 'f21', 'f21', 'Brandon Hall', '09054805580'),
(22, 'f22', 'f22', 'Liam Young', '09054805581'),
(23, 'f23', 'f23', 'Ella Allen', '09054805582'),
(24, 'f24', 'f24', 'Benjamin Scott', '09054805583'),
(25, 'f25', 'f25', 'Zoe King', '09054805584'),
(26, 'f26', 'f26', 'Nathan Wright', '09054805585'),
(27, 'f27', 'f27', 'Grace Hill', '09054805586'),
(28, 'f28', 'f28', 'Ethan Green', '09054805587'),
(29, 'f29', 'f29', 'Chloe Adams', '09054805588'),
(30, 'f30', 'f30', 'Samuel Nelson', '09054805589'),
(31, 'f31', 'f31', 'Ava Carter', '09054805590'),
(32, 'f32', 'f32', 'Jacob Mitchell', '09054805591'),
(33, 'f33', 'f33', 'Scarlett Perez', '09054805592'),
(34, 'f34', 'f34', 'Logan Roberts', '09054805593'),
(35, 'f35', 'f35', 'Hannah Phillips', '09054805594'),
(36, 'f36', 'f36', 'Jackson Evans', '09054805595'),
(37, 'f37', 'f37', 'Victoria Turner', '09054805596'),
(38, 'f38', 'f38', 'Dylan Parker', '09054805597'),
(39, 'f39', 'f39', 'Samantha Campbell', '09054805598'),
(40, 'f40', 'f40', 'Alexander Edwards', '09054805599'),
(41, 'f41', 'f41', 'Jane Smith', '09054805561'),
(42, 'f42', 'f32', 'Jhey Apoli', '0912321345123'),
(43, 'f43', 'f43', 'David Mark', '09054728412'),
(44, 'f44', 'f44', 'John Smith', '09054728413'),
(45, 'f45', 'f45', 'Mary Jane', '09054728414'),
(46, 'f46', 'f46', 'James Brown', '09054728415'),
(47, 'f47', 'f47', 'Emily Davis', '09054728416'),
(48, 'f48', 'f48', 'Michael Johnson', '09054728417'),
(49, 'f49', 'f49', 'Sarah Wilson', '09054728418'),
(50, 'f50', 'f50', 'Robert Lee', '09054728419'),
(51, 'f51', 'f51', 'Jessica Garcia', '09054728420'),
(52, 'f52', 'f52', 'Daniel Martinez', '09054728421'),
(53, 'f53', 'f53', 'Laura Hernandez', '09054728422'),
(54, 'f54', 'f54', 'Andrew Lopez', '09054728423'),
(55, 'f55', 'f55', 'Sophia Clark', '09054728424'),
(56, 'f56', 'f56', 'Matthew Lewis', '09054728425'),
(57, 'f57', 'f57', 'Olivia Hall', '09054728426'),
(58, 'f58', 'f58', 'Joshua Young', '09054728427'),
(59, 'f59', 'f59', 'Isabella King', '09054728428');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_calamity_status`
--
ALTER TABLE `tbl_calamity_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_evacuation_location`
--
ALTER TABLE `tbl_evacuation_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_evacuees_info`
--
ALTER TABLE `tbl_evacuees_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_facilitator_access`
--
ALTER TABLE `tbl_facilitator_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
