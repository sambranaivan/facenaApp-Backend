-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2019 a las 01:59:02
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `costo_docente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antiguedad`
--

CREATE TABLE `antiguedad` (
  `id` int(11) NOT NULL,
  `desde` int(11) NOT NULL,
  `hasta` int(11) NOT NULL,
  `adicional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `antiguedad`
--

INSERT INTO `antiguedad` (`id`, `desde`, `hasta`, `adicional`) VALUES
(0, 0, 4, 20),
(1, 5, 6, 30),
(2, 7, 9, 40),
(3, 10, 11, 50),
(4, 12, 14, 60),
(5, 15, 16, 70),
(6, 17, 19, 80),
(7, 20, 21, 100),
(8, 22, 23, 110),
(9, 24, 99, 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `cargo` varchar(12) DEFAULT NULL,
  `dedicacion` varchar(5) DEFAULT NULL,
  `sueldo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`, `dedicacion`, `sueldo`) VALUES
(0, 'AY.ALUM', 'SIMP', 4783.94),
(1, 'AUX.1RA', 'SIMP', 5980.11),
(2, 'AUX.1RA', 'SEMI', 11960.4),
(3, 'AUX.1RA', 'EXCL', 23920.82),
(4, 'JTP', 'SIMP', 7087.55),
(5, 'JTP', 'SEMI', 14175.3),
(6, 'JTP', 'EXCL', 28350.63),
(7, 'P.ADJ', 'SIMP', 8185.83),
(8, 'P.ADJ', 'SEMI', 16371.89),
(9, 'P.ADJ', 'EXCL', 32743.81),
(10, 'P.TIT', 'SIMP', 10355.29),
(11, 'P.TIT', 'SEMI', 20710.88),
(12, 'P.TIT', 'EXCL', 41421.79),
(13, 'BEDEL', '25 HS', 14175.3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costo`
--

CREATE TABLE `costo` (
  `id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `antiguedad_id` int(11) NOT NULL,
  `adic_rem` double DEFAULT NULL,
  `adic_norem` double DEFAULT NULL,
  `garantia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costo`
--

INSERT INTO `costo` (`id`, `cargo_id`, `antiguedad_id`, `adic_rem`, `adic_norem`, `garantia`) VALUES
(0, 0, 0, 184.53, 516.69, 0),
(1, 0, 1, 199.91, 559.74, 0),
(2, 0, 2, 215.29, 602.8, 0),
(3, 0, 3, 230.67, 645.86, 0),
(4, 0, 4, 246.05, 688.91, 0),
(5, 0, 5, 261.42, 731.97, 0),
(6, 0, 6, 276.8, 775.03, 0),
(7, 0, 7, 307.56, 861.14, 0),
(8, 0, 8, 322.93, 904.2, 0),
(9, 0, 9, 338.31, 947.26, 0),
(10, 1, 0, 230.67, 645.86, 1001),
(11, 1, 1, 249.89, 699.68, 312.82),
(12, 1, 2, 269.11, 753.5, 0),
(13, 1, 3, 288.33, 807.32, 0),
(14, 1, 4, 307.55, 861.14, 0),
(15, 1, 5, 326.78, 914.96, 0),
(16, 1, 6, 346, 968.78, 0),
(17, 1, 7, 384.44, 1076.43, 0),
(18, 1, 8, 403.66, 1130.25, 0),
(19, 1, 9, 422.89, 1184.07, 0),
(20, 2, 0, 461.33, 1291.72, 2001.78),
(21, 2, 1, 499.77, 1399.36, 625.38),
(22, 2, 2, 538.22, 1507.01, 0),
(23, 2, 3, 576.66, 1614.65, 0),
(24, 2, 4, 615.11, 1722.29, 0),
(25, 2, 5, 653.55, 1829.94, 0),
(26, 2, 6, 692, 1937.58, 0),
(27, 2, 7, 768.88, 2152.87, 0),
(28, 2, 8, 807.33, 2260.51, 0),
(29, 2, 9, 845.77, 2368.15, 0),
(30, 3, 0, 922.66, 2583.45, 4003.52),
(31, 3, 1, 999.55, 2798.74, 1250.73),
(32, 3, 2, 1076.44, 3014.02, 0),
(33, 3, 3, 1153.33, 3229.31, 0),
(34, 3, 4, 1230.22, 3444.6, 0),
(35, 3, 5, 1307.1, 3659.89, 0),
(36, 3, 6, 1383.99, 3875.17, 0),
(37, 3, 7, 1537.77, 4305.75, 0),
(38, 3, 8, 1614.66, 4521.04, 0),
(39, 3, 9, 1691.55, 4736.32, 0),
(40, 4, 0, 274.46, 768.49, 0),
(41, 4, 1, 297.34, 832.53, 0),
(42, 4, 2, 320.21, 896.57, 0),
(43, 4, 3, 343.08, 960.62, 0),
(44, 4, 4, 365.95, 1024.66, 0),
(45, 4, 5, 388.82, 1088.7, 0),
(46, 4, 6, 411.7, 1152.74, 0),
(47, 4, 7, 457.44, 1280.82, 0),
(48, 4, 8, 480.31, 1344.86, 0),
(49, 4, 9, 503.18, 1408.9, 0),
(50, 5, 0, 548.93, 1537, 0),
(51, 5, 1, 594.67, 1665.09, 0),
(52, 5, 2, 640.42, 1793.17, 0),
(53, 5, 3, 686.16, 1921.26, 0),
(54, 5, 4, 731.9, 2049.34, 0),
(55, 5, 5, 777.65, 2177.42, 0),
(56, 5, 6, 823.39, 2305.51, 0),
(57, 5, 7, 914.88, 2561.67, 0),
(58, 5, 8, 960.62, 2689.76, 0),
(59, 5, 9, 1006.37, 2817.84, 0),
(60, 6, 0, 1097.86, 3074.02, 0),
(61, 6, 1, 1189.35, 3330.19, 0),
(62, 6, 2, 1280.84, 3586.35, 0),
(63, 6, 3, 1372.33, 3842.52, 0),
(64, 6, 4, 1463.82, 4098.69, 0),
(65, 6, 5, 1555.31, 4354.86, 0),
(66, 6, 6, 1646.8, 4611.03, 0),
(67, 6, 7, 1829.77, 5123.36, 0),
(68, 6, 8, 1921.26, 5379.53, 0),
(69, 6, 9, 2012.75, 5635.7, 0),
(70, 7, 0, 318.26, 891.13, 0),
(71, 7, 1, 344.78, 965.39, 0),
(72, 7, 2, 371.31, 1039.65, 0),
(73, 7, 3, 397.83, 1113.91, 0),
(74, 7, 4, 424.35, 1188.17, 0),
(75, 7, 5, 450.87, 1262.43, 0),
(76, 7, 6, 477.39, 1336.69, 0),
(77, 7, 7, 530.44, 1485.22, 0),
(78, 7, 8, 556.96, 1559.48, 0),
(79, 7, 9, 583.48, 1633.74, 0),
(80, 8, 0, 636.53, 1782.3, 0),
(81, 8, 1, 689.58, 1930.82, 0),
(82, 8, 2, 742.62, 2079.35, 0),
(83, 8, 3, 795.67, 2227.87, 0),
(84, 8, 4, 848.71, 2376.4, 0),
(85, 8, 5, 901.76, 2524.92, 0),
(86, 8, 6, 954.8, 2673.45, 0),
(87, 8, 7, 1060.89, 2970.5, 0),
(88, 8, 8, 1113.93, 3119.02, 0),
(89, 8, 9, 1166.98, 3267.55, 0),
(90, 9, 0, 1273.07, 3564.6, 0),
(91, 9, 1, 1379.16, 3861.65, 0),
(92, 9, 2, 1485.25, 4158.7, 0),
(93, 9, 3, 1591.33, 4455.75, 0),
(94, 9, 4, 1697.42, 4752.79, 0),
(95, 9, 5, 1803.51, 5049.84, 0),
(96, 9, 6, 1909.6, 5346.89, 0),
(97, 9, 7, 2121.78, 5940.99, 0),
(98, 9, 8, 2227.87, 6238.04, 0),
(99, 9, 9, 2333.96, 6535.09, 0),
(100, 10, 0, 405.86, 1136.41, 0),
(101, 10, 1, 439.68, 1231.11, 0),
(102, 10, 2, 473.5, 1325.82, 0),
(103, 10, 3, 507.32, 1420.52, 0),
(104, 10, 4, 541.14, 1515.22, 0),
(105, 10, 5, 574.97, 1609.92, 0),
(106, 10, 6, 608.79, 1704.62, 0),
(107, 10, 7, 676.43, 1894.02, 0),
(108, 10, 8, 710.25, 1988.72, 0),
(109, 10, 9, 744.07, 2083.43, 0),
(110, 11, 0, 811.74, 2272.87, 0),
(111, 11, 1, 879.38, 2462.27, 0),
(112, 11, 2, 947.03, 2651.68, 0),
(113, 11, 3, 1014.67, 2841.08, 0),
(114, 11, 4, 1082.32, 3030.49, 0),
(115, 11, 5, 1149.96, 3219.89, 0),
(116, 11, 6, 1217.6, 3409.3, 0),
(117, 11, 7, 1352.89, 3788.11, 0),
(118, 11, 8, 1420.54, 3977.52, 0),
(119, 11, 9, 1488.18, 4166.92, 0),
(120, 12, 0, 1623.48, 4545.74, 0),
(121, 12, 1, 1758.77, 4924.55, 0),
(122, 12, 2, 1894.06, 5303.37, 0),
(123, 12, 3, 2029.35, 5682.18, 0),
(124, 12, 4, 2164.64, 6060.99, 0),
(125, 12, 5, 2299.93, 6439.8, 0),
(126, 12, 6, 2435.22, 6818.61, 0),
(127, 12, 7, 2705.81, 7576.24, 0),
(128, 12, 8, 2841.1, 7955.05, 0),
(129, 12, 9, 2976.39, 8333.86, 0),
(130, 13, 0, 548.93, 1537, 0),
(131, 13, 1, 594.67, 1665.09, 0),
(132, 13, 2, 640.42, 1793.17, 0),
(133, 13, 3, 686.16, 1921.26, 0),
(134, 13, 4, 731.9, 2049.34, 0),
(135, 13, 5, 777.65, 2177.42, 0),
(136, 13, 6, 823.39, 2305.51, 0),
(137, 13, 7, 914.88, 2561.67, 0),
(138, 13, 8, 960.62, 2689.76, 0),
(139, 13, 9, 1006.37, 2817.84, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fijos`
--

CREATE TABLE `fijos` (
  `id` int(11) NOT NULL,
  `variable` varchar(12) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `valor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fijos`
--

INSERT INTO `fijos` (`id`, `variable`, `descripcion`, `valor`) VALUES
(0, 'adic_doctor', '% Adicional por titulo de Doctor', 18),
(1, 'adic_master', '% Adicional por titulo de Magister', 8),
(2, 'adic_esp', '% Adicional por titulo de Especialista', 5),
(3, 'c_patr', 'C Patronal', 10.17),
(4, 'obra_social', 'Obra Social', 6),
(5, 'ley_19032', 'Ley 19032', 1.5),
(6, 'art', 'A.R.T ', 0.33),
(7, 'costo_facult', 'costo facultad', 18);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antiguedad`
--
ALTER TABLE `antiguedad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desde_index` (`desde`),
  ADD KEY `hasta_index` (`hasta`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `costo`
--
ALTER TABLE `costo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargo_id_index` (`cargo_id`),
  ADD KEY `antigüedad_id_index` (`antiguedad_id`);

--
-- Indices de la tabla `fijos`
--
ALTER TABLE `fijos`
  ADD PRIMARY KEY (`id`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `costo`
--
ALTER TABLE `costo`
  ADD CONSTRAINT `costo_antiguedad` FOREIGN KEY (`antiguedad_id`) REFERENCES `antiguedad` (`id`),
  ADD CONSTRAINT `costo_cargos` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
