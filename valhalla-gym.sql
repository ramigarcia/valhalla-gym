-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2022 a las 20:19:27
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
-- Base de datos: `valhalla-gym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adminv`
--

CREATE TABLE `adminv` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contraseña` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `adminv`
--

INSERT INTO `adminv` (`id`, `usuario`, `contraseña`) VALUES
(1, 'valhalla', 'valhalla31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dni` int(10) NOT NULL,
  `apellido` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_p` date NOT NULL,
  `fecha_v` date NOT NULL,
  `plan_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `nombre`) VALUES
(1, 'Mes libre'),
(2, '3x Semana');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adminv`
--
ALTER TABLE `adminv`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `plan_id_2` (`plan_id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adminv`
--
ALTER TABLE `adminv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `planes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
