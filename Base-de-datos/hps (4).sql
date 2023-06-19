-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2023 a las 16:24:34
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'ADMINISTRADOR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`, `role`) VALUES
(1, 'admin', 'admin123', '28-12-2016 11:42:05 AM', 'ADMINISTRADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`) VALUES
(3, 'Psiquiatra general', 7, 6, 600, '2019-06-29', '9:15 AM', '2019-06-23 17:31:28', 1, 0, '0000-00-00 00:00:00'),
(7, 'Psiquiatra general', 1, 8, 0, '2023-06-21', '2:15 PM', '2023-06-14 18:07:40', 1, 1, NULL),
(8, 'Psiquiatra general', 1, 8, 0, '2023-06-21', '2:30 PM', '2023-06-14 18:27:52', 1, 1, NULL),
(9, 'Psiquiatra general', 1, 8, 0, '2023-06-23', '5:00 PM', '2023-06-14 20:58:02', 1, 0, '2023-06-14 21:02:16'),
(10, 'Psiquiatra general', 1, 8, 0, '2023-06-23', '12:45 PM', '2023-06-15 16:31:44', 0, 1, '2023-06-16 20:39:53'),
(11, 'Psiquiatra general', 1, 8, 0, '2023-06-15', '4:45 PM', '2023-06-16 20:39:49', 1, 1, NULL),
(12, 'Psiquiatra general', 1, 1, 0, '2023-06-27', '5:45 PM', '2023-06-16 21:38:53', 1, 1, NULL),
(13, 'Psiquiatra general', 10, 1, 0, '2023-06-22', '7:45 PM', '2023-06-16 23:33:59', 1, 1, NULL),
(14, 'Psiquiatra general', 10, 1, 0, '2023-06-16', '11:45 PM', '2023-06-18 03:42:05', 1, 1, NULL),
(15, 'Psiquiatra general', 10, 4, 0, '2023-06-22', '2:00 PM', '2023-06-18 17:46:57', 1, 0, '2023-06-19 05:16:54'),
(16, 'Psiquiatra menor', 14, 1, 100, '2023-06-22', '7:30 PM', '2023-06-18 23:22:00', 1, 1, NULL),
(17, 'Psiquiatra general', 10, 1, 0, '2023-06-21', '1:30 PM', '2023-06-19 05:21:16', 1, 0, '2023-06-19 12:28:40'),
(18, 'Psiquiatra general', 12, 4, 100, '2023-06-23', '8:45 AM', '2023-06-19 12:38:12', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `ci` varchar(100) DEFAULT NULL,
  `PatLastName` varchar(200) DEFAULT NULL,
  `PatSecondName` varchar(200) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'ESPECIALISTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`, `estado`, `ci`, `PatLastName`, `PatSecondName`, `role`) VALUES
(10, 'Psiquiatra general', 'Jesus', 'buenos aires', '0', 78815708, 'jesus@gmail.com', 'ab3b3e6556b4a9e7033cf87bf338862b', '2023-06-16 22:32:58', '2023-06-19 03:55:28', 1, '10083746', 'Huanaco', 'Mollisaca', 'ESPECIALISTA'),
(11, 'Psiquiatra general', 'Marco', 'Buenos aires', '0', 78815708, 'marco@gmail.com', '9985039da9a041e4e95a6e62e63adf76', '2023-06-16 23:39:25', '2023-06-19 05:10:14', 1, NULL, NULL, NULL, 'ESPECIALISTA'),
(12, 'Psiquiatra general', 'Dimas', 'desconocido', '100', 400043, 'dimas@gmail.com', '51947e3cf64ee746b6f2c73d174d525a', '2023-06-18 22:20:45', '2023-06-19 02:52:35', 1, '15325235', 'Miranda', 'Mollisaca', 'ESPECIALISTA'),
(13, 'Psiquiatra general', 'Matias', 'desconocido', '29', 4343434, 'matias@gmail.com', '06098bbde90f356c3a7cddcdfcf92eee', '2023-06-18 22:26:21', NULL, 1, '3252352', 'gonzales', 'marquez', 'ESPECIALISTA'),
(14, 'Psiquiatra menor', 'Juan', 'buenos aires', '100', 78812441, 'juan@gmail.com', 'f5737d25829e95b9c234b7fa06af8736', '2023-06-18 23:18:02', NULL, 1, '3883422', 'Padilla', 'Marquez', 'ESPECIALISTA'),
(15, 'Psiquiatra general', 'Esteban', 'La ceja ', '100', 7815352, 'esteban@gmail.com', '3466752a246bee264d690225ea75954b', '2023-06-18 23:49:17', NULL, 1, '10003252', 'Ramos ', 'Chambilla', 'ESPECIALISTA'),
(16, 'Psiquiatra menor', 'Mariana', 'Buenos Aires', '100', 78234232, 'mariana@gmail.com', 'c6395fc2a20ef14c669de0a8fc196280', '2023-06-19 00:20:53', NULL, 1, '88434343', 'Menacho', 'Ugarte', 'ESPECIALISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(20, 7, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 19:59:57', '16-07-2022 02:30:39 AM', 1),
(22, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:05:49', NULL, 0),
(23, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:06:16', NULL, 1),
(24, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:08:22', NULL, 1),
(25, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:24:02', '14-06-2023 11:56:45 PM', 1),
(26, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:27:03', NULL, 1),
(27, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:29:30', NULL, 0),
(28, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:29:38', '15-06-2023 12:01:06 AM', 1),
(29, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:31:28', '15-06-2023 12:03:10 AM', 1),
(30, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:33:22', NULL, 0),
(31, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:33:34', NULL, 0),
(32, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 20:54:01', NULL, 1),
(33, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 20:58:59', '15-06-2023 02:34:18 AM', 1),
(34, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 21:32:07', NULL, 1),
(35, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 21:42:57', NULL, 0),
(36, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 21:43:04', NULL, 1),
(37, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 22:35:49', NULL, 1),
(38, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 16:31:05', NULL, 0),
(39, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 16:31:17', '15-06-2023 10:01:23 PM', 1),
(40, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 16:32:26', '15-06-2023 10:02:44 PM', 1),
(41, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 17:38:27', NULL, 0),
(42, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 17:38:32', '15-06-2023 11:09:02 PM', 1),
(43, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 02:24:19', NULL, 1),
(44, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:37:14', NULL, 0),
(45, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:37:20', NULL, 0),
(46, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:37:37', NULL, 1),
(47, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:43:49', '16-06-2023 09:18:05 AM', 1),
(48, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:48:22', '16-06-2023 09:18:26 AM', 1),
(49, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:49:10', '16-06-2023 09:19:15 AM', 1),
(50, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 03:56:27', NULL, 1),
(51, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 18:56:28', NULL, 1),
(52, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 19:15:31', '17-06-2023 12:45:56 AM', 1),
(53, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:39:27', NULL, 1),
(54, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:40:24', NULL, 1),
(55, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:39:15', NULL, 1),
(56, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 22:17:46', NULL, 0),
(57, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 22:17:57', NULL, 0),
(58, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 22:18:24', '17-06-2023 03:54:07 AM', 1),
(59, 1, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 22:25:03', '19-06-2023 09:35:28 AM', 1),
(60, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:43:07', NULL, 1),
(61, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-17 13:46:59', '18-06-2023 07:17:31 AM', 1),
(62, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 03:37:14', '18-06-2023 09:11:41 AM', 1),
(63, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 03:42:15', NULL, 1),
(64, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 15:40:47', NULL, 1),
(65, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 16:18:39', NULL, 0),
(66, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 16:18:45', NULL, 1),
(67, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:43:18', NULL, 1),
(68, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:47:16', NULL, 1),
(69, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:57:52', NULL, 1),
(70, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 18:06:42', NULL, 0),
(71, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 18:06:48', NULL, 1),
(72, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 18:11:03', NULL, 1),
(73, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 20:42:05', NULL, 1),
(74, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 21:40:24', NULL, 1),
(75, 14, 'juan@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:20:18', NULL, 1),
(76, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:50:07', '19-06-2023 05:21:33 AM', 1),
(77, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:52:30', NULL, 1),
(78, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 03:38:04', NULL, 1),
(79, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 04:16:46', NULL, 1),
(80, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 04:39:39', NULL, 1),
(81, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 05:15:46', '19-06-2023 10:50:14 AM', 1),
(82, 10, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 12:27:21', '19-06-2023 06:03:36 PM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Psiquiatra general', '2016-12-28 05:37:25', '0000-00-00 00:00:00'),
(13, 'Psiquiatra menor', '2023-06-16 22:24:43', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intentos_usuarios`
--

CREATE TABLE `intentos_usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `intento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `intentos_usuarios`
--

INSERT INTO `intentos_usuarios` (`id`, `id_usuario`, `intento`) VALUES
(3, 0, '2023-06-16 16:02:51'),
(4, 0, '2023-06-16 16:02:57'),
(5, 0, '2023-06-16 16:03:02'),
(6, 0, '2023-06-16 16:03:10'),
(7, 0, '2023-06-16 16:40:09'),
(8, 0, '2023-06-16 17:43:47'),
(9, 0, '2023-06-16 17:43:58'),
(10, 0, '2023-06-16 17:44:06'),
(11, 0, '2023-06-16 17:49:25'),
(12, 0, '2023-06-16 17:49:31'),
(13, 0, '2023-06-16 18:43:07'),
(14, 0, '2023-06-16 19:47:55'),
(15, 0, '2023-06-16 19:48:05'),
(18, 0, '2023-06-18 19:20:38'),
(19, 0, '2023-06-18 19:20:44'),
(20, 2, '2023-06-18 19:54:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulaciones`
--

CREATE TABLE `simulaciones` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `simulaciones`
--

INSERT INTO `simulaciones` (`id`, `doctorId`, `nombre`, `enlace`) VALUES
(11, NULL, 'simulacion fobia', 'https://www.youtube.com/watch?v=joXkoT6KV54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'fdsfsdf', 'fsdfsd@ghashhgs.com', 3264826346, 'mensaje de ejemplo', '2019-11-10 17:53:48', 'vfdsfgfd', '2019-11-10 17:54:04', 1),
(4, 'Jose', 'jose@gmail.com', 3252352, 'quisiera que me desbaneen mi cuenta\r\n', '2023-06-16 19:18:35', NULL, NULL, NULL),
(5, 'Alejandra', 'alejandra@gmail.com', 88952352, 'tengo un problema con el sistema ', '2023-06-16 21:51:16', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(2, 1, 'normal', 'normal', '85 Kg', '101 grados', 'ninguna por el momento', '2019-11-06 03:20:07'),
(8, 6, 'normal', 'normal', '62kg', 'normal', 'tomar antidepresivos', '2023-06-16 18:57:00'),
(9, 7, 'normal', 'normal', '76kg', 'normal', 'debes tomar mas medicamentos', '2023-06-18 16:36:44'),
(10, 8, 'normal', 'normal', '67kg', 'normal', 'toma mas medicamentos', '2023-06-18 17:52:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `PatIdCard` varchar(100) DEFAULT NULL,
  `PatLastName` varchar(200) DEFAULT NULL,
  `PatSecondName` varchar(200) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'PACIENTE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`, `estado`, `PatIdCard`, `PatLastName`, `PatSecondName`, `role`) VALUES
(1, 1, 'Alejandra', 4558968789, 'alejandra@gmail.com', 'masculino', ' Buenos Aires', 25, 'ninguno', '2019-11-04 20:38:06', '2023-06-19 04:04:45', 0, '100837454', 'Huanaco', 'Mollisaca', 'PACIENTE'),
(6, 1, 'jose', 44356344, 'jose@gmail.com', 'masculino', 'Buenos Aires', 20, 'ninguno', '2023-06-14 21:03:18', '2023-06-19 04:05:15', 0, '3243234223', 'quispe', 'perez', 'PACIENTE'),
(7, 10, 'jose', 12345678, 'jes@gmail.com', 'masculino', 'Buenos Aires', 21, 'ninguno', '2023-06-16 23:45:03', '2023-06-19 04:40:39', 0, '10032523', 'Rodriguez', 'Perez', 'PACIENTE'),
(8, 10, 'Marco', 7885325, 'marco1@gmail.com', 'masculino', 'Buenos Aries', 19, 'tuvo un accidente de moto hace 6 años', '2023-06-18 17:48:14', '2023-06-19 04:17:08', 1, '88852532', 'Maquera ', 'pacosillo', 'PACIENTE'),
(11, 1, 'Antonio', 12345678, 'antonio@gmail.com', 'masculino', 'fads', 54, 'fasdfa', '2023-06-18 21:53:20', NULL, 1, '32232443', NULL, NULL, 'PACIENTE'),
(12, 1, 'Michell', 43434343, 'michell@gmail.com', 'masculino', 'desconocido', 49, 'ninguno', '2023-06-18 22:00:05', NULL, 1, '434343', 'rodirgues', 'perez', 'PACIENTE'),
(13, 1, 'jorge', 325352, 'jorge1@gmail.com', 'masculino', 'desconocido', 35, 'ninguno', '2023-06-18 22:01:54', NULL, 1, '325235', 'calderon', 'quisbert', 'PACIENTE'),
(14, 1, 'Matias', 35235253, 'matias@gmail.com', 'masculino', 'desconocido', 30, 'ninguno', '2023-06-18 22:06:02', '2023-06-18 22:15:08', 1, '3252352', 'marquez ', 'Santino', 'PACIENTE'),
(15, 1, 'Esteban', 76662335, 'esteban@gmail.com', 'masculino', 'buenos aires', 23, 'ninguno', '2023-06-18 23:47:20', NULL, 1, '100436344', 'Ramos ', 'Chambilla', 'PACIENTE'),
(16, 1, 'Jorge', 78814697, 'jorge@gmail.com', 'masculino', 'desconocido', 19, 'ninguno', '2023-06-19 01:39:29', NULL, 1, '32423422', 'Gato', 'Montes', 'PACIENTE'),
(17, 10, 'alejandro', 78815708, 'alejandro@gmail.com', 'masculino', 'desconocido', 24, 'ninguno', '2023-06-19 03:47:22', '2023-06-19 03:49:55', 1, '523525588', 'quispe', 'pacosillo', 'PACIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpatientevaluation`
--

CREATE TABLE `tblpatientevaluation` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `Symptoms` varchar(200) DEFAULT NULL,
  `Diagnosis` varchar(200) NOT NULL,
  `SpecialistComments` mediumtext DEFAULT NULL,
  `ProgressRating` int(3) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tblpatientevaluation`
--

INSERT INTO `tblpatientevaluation` (`ID`, `PatientID`, `Symptoms`, `Diagnosis`, `SpecialistComments`, `ProgressRating`, `CreationDate`) VALUES
(1, 0, 'tiene problemas en la cabeza', 'tiene un problema psicologico', 'debemos ir tratando cada problema paso a paso', 10, '2023-06-18 16:23:29'),
(2, 7, 'tiene problemas en la cabeza', 'tiene un problema psicologico', 'debemos ir trabajando mas en tu caso', 10, '2023-06-18 16:37:36'),
(3, 7, 'tiene problemas en la cabeza', 'tiene un problema psicologico', 'vamos mejorando poco a poco', 40, '2023-06-18 16:50:05'),
(4, 8, 'tiene un sintoma extraño', 'tiene una fobia desconocida', 'iremos trabajando todas en cada cita para ir mejorando tu condicion', 20, '2023-06-18 17:58:44'),
(5, 8, 'tiene posible fobia psicologica ', 'tiene un problema psicologico', 'iremos trabajando para que te sientas mejor', 50, '2023-06-18 18:08:26'),
(6, 8, 'tienes aun ciertos sintomas', 'posiblemente ya se te vaya la fobia ', 'ya falta poco para que te recuperes ', 95, '2023-06-18 20:43:08'),
(7, 8, 'tiene esquizofrenia nivel severo ', 'tiene una fobia desconocida', 'iremos trabajando en tu caso poco a poco', 30, '2023-06-18 23:53:36'),
(8, 8, 'tiene respiracion agitada', 'tiene ansiedad fobica social', 'tiene una observacion en el nivel de voz devido a que grita mucho', 15, '2023-06-19 05:19:19'),
(9, 8, 'tiene nuevos sintomas de una posible fobia', 'tiene una fobia social', 'iremos trabajando durante cada cita', 15, '2023-06-19 12:33:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, NULL, 'alejandra@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 19:57:20', NULL, 0),
(25, 2, 'alejandra@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 19:57:57', '16-07-2022 02:29:28 AM', 1),
(26, 2, 'alejandra@gmail.com', 0x3a3a3100000000000000000000000000, '2022-07-15 20:11:12', '16-07-2022 02:55:17 AM', 1),
(27, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:07:31', NULL, 1),
(28, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 18:27:23', NULL, 1),
(29, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 20:57:47', NULL, 1),
(30, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-14 21:35:46', '15-06-2023 03:05:53 AM', 1),
(31, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 16:31:30', NULL, 1),
(32, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-15 17:37:28', NULL, 1),
(33, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 00:05:19', NULL, 1),
(34, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 02:26:04', NULL, 1),
(35, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 02:50:21', NULL, 1),
(36, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 11:56:53', '16-06-2023 05:27:22 PM', 1),
(37, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 11:57:43', '16-06-2023 05:27:44 PM', 1),
(38, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 12:10:32', '16-06-2023 05:40:55 PM', 1),
(39, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 19:54:27', NULL, 0),
(40, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 19:54:35', NULL, 0),
(41, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:02:52', NULL, 0),
(42, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:02:57', NULL, 0),
(43, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:03:02', NULL, 0),
(44, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:03:10', NULL, 0),
(45, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:03:29', '17-06-2023 01:33:33 AM', 1),
(46, 8, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:39:36', NULL, 1),
(47, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 20:40:09', NULL, 0),
(48, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:31:28', '17-06-2023 03:13:36 AM', 1),
(49, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:43:48', NULL, 0),
(50, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:43:58', NULL, 0),
(51, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:44:06', NULL, 0),
(52, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:44:15', '17-06-2023 03:17:15 AM', 1),
(53, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:48:07', '17-06-2023 03:19:15 AM', 1),
(54, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:49:26', NULL, 0),
(55, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 21:49:31', NULL, 0),
(56, NULL, 'jesus@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 22:43:07', NULL, 0),
(57, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 22:43:15', '17-06-2023 04:28:58 AM', 1),
(58, 3, 'moises@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:15:07', '17-06-2023 04:45:13 AM', 1),
(59, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:33:39', NULL, 1),
(60, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:47:55', NULL, 0),
(61, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:48:06', NULL, 0),
(62, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:48:52', NULL, 0),
(63, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:48:58', NULL, 0),
(64, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-16 23:49:27', NULL, 1),
(65, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 03:41:53', NULL, 1),
(66, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 15:51:22', NULL, 1),
(67, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:41:32', NULL, 1),
(68, 1, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:44:01', '18-06-2023 11:15:15 PM', 1),
(69, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:46:44', NULL, 1),
(70, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:52:32', NULL, 1),
(71, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 17:59:15', NULL, 1),
(72, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 18:08:59', NULL, 1),
(73, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:20:38', NULL, 0),
(74, NULL, 'jose@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:20:44', NULL, 0),
(75, 1, 'jes@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:21:51', NULL, 1),
(76, NULL, 'marco@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:54:36', NULL, 0),
(77, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-18 23:54:45', NULL, 1),
(78, 1, 'jes@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 03:56:31', '19-06-2023 09:45:40 AM', 1),
(79, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 04:15:51', NULL, 1),
(80, 1, 'jes@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 04:41:23', NULL, 1),
(81, 1, 'jes@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 05:20:32', '19-06-2023 10:54:18 AM', 1),
(82, 4, 'marco1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-19 12:35:25', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `ci` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `role` varchar(255) NOT NULL DEFAULT 'USUARIO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fullName`, `lastName`, `middleName`, `ci`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`, `estado`, `role`) VALUES
(1, 'jose antonio', 'Quispe', 'Perez', '32423443', 'buenos aires', 'La paz', 'masculino', 'jes@gmail.com', '90e528618534d005b1a7e7b7a367813f', '2023-06-16 21:31:18', '2023-06-19 05:12:39', 1, 'USUARIO'),
(2, 'marco', 'maquera', 'pacosillo', '52352352', 'Buenos Aires', 'La paz', 'masculino', 'marco@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2023-06-16 23:13:54', '2023-06-19 04:11:48', 1, 'USUARIO'),
(3, 'Moises', 'Paco', 'Perez', '10083746', 'Buenos Aires', 'La paz', 'masculino', 'moises@gmail.com', 'a4f80546e0e2319d302d5e6fe30af835', '2023-06-16 23:14:51', '2023-06-18 03:24:22', 1, 'USUARIO'),
(4, 'Marco', 'Maquera', 'Pacosillo', '10323222', 'Buenos Aires', 'La paz', 'masculino', 'marco1@gmail.com', 'f7fd5e0527271e590ad8416d5677180d', '2023-06-18 17:46:26', NULL, 1, 'USUARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_simulador`
--

CREATE TABLE `usuarios_simulador` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `role` varchar(255) NOT NULL DEFAULT 'SIMULADOR'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_simulador`
--

INSERT INTO `usuarios_simulador` (`id`, `first_name`, `last_name`, `middle_name`, `id_number`, `email`, `birthdate`, `password`, `regDate`, `updationDate`, `estado`, `role`) VALUES
(1, 'jose antonio', 'Huanca', 'Calderon', '1032232', 'jose1@gmail.com', '1982-02-02', 'jose', '2023-06-15 18:11:28', '2023-06-18 22:12:32', 1, 'SIMULADOR'),
(2, 'jorge', 'Doe', 'Smith', '1234567890', 'jorge@gmail.com', '1990-01-01', 'jorge123', '2023-06-15 18:39:14', '2023-06-16 19:23:44', 1, 'SIMULADOR'),
(3, 'paco', 'pepe', '', '3252352', 'paco@gmail.com', '0000-00-00', '2023-06-08', '2023-06-16 12:56:32', '2023-06-16 19:19:15', 0, 'SIMULADOR'),
(4, 'Marco', 'Maquera ', 'Pacosillo', '34253221', 'marco@gmail.com', '2004-01-14', 'marco123', '2023-06-16 19:24:55', '2023-06-19 05:13:28', 0, 'SIMULADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `intentos_usuarios`
--
ALTER TABLE `intentos_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tblpatientevaluation`
--
ALTER TABLE `tblpatientevaluation`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_simulador`
--
ALTER TABLE `usuarios_simulador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `intentos_usuarios`
--
ALTER TABLE `intentos_usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tblpatientevaluation`
--
ALTER TABLE `tblpatientevaluation`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios_simulador`
--
ALTER TABLE `usuarios_simulador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
