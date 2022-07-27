-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2022 a las 21:40:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- 
    -- Universidad Nacional Experimental del Táchira
    -- Prof: Marcel Molina

    -- Progrmación y Diseño
    -- José Alejandro Valduz Contreras 26841447
    -- Frank Benitez 26156872
 
--
-- Base de datos: `database_transporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `tlf` varchar(200) NOT NULL,
  `empresa_l` varchar(200) NOT NULL,
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `nombre`, `apellido`, `correo`, `tlf`, `empresa_l`, `comentario`) VALUES
(1, 'José', 'Valud', 'jose.valduz@unet.edu.ve', '04147519346', 'Residente c.a', 'Muy Buen Servicio, Excelencia en Puntualidad'),
(2, 'Juan', 'Valduz', 'Juans@gmail.com', '0276167616', 'Ninguna', 'Deberian Mejorar Los Precios de las rutas'),
(3, 'Lovelace', 'De Rey', 'bibliotecaUPTAIT@gmail.com', '0216457826', 'Unidad CA', 'Deberioan mejorar la puntualidad, me parece ue prometen mucho\r\npero dan poco'),
(4, 'ELoy', 'Mendez', 'lavor@gmail.com', '047541615', 'Federal Line', 'Los Choferes son Grosero a la hora de cobrar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id` int(11) NOT NULL,
  `empresa` varchar(200) NOT NULL,
  `inicio` varchar(200) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `fin` varchar(200) NOT NULL,
  `costo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id`, `empresa`, `inicio`, `ruta`, `fin`, `costo`) VALUES
(1, 'Lineas Unidas', 'terminal', 'av Principal prolongacion 19 de abril', 'CC. Borota', 15),
(2, 'San Rafael Union', 'av Perimetral', 'perimetral con autopista', 'Sector 6', 16),
(3, 'Residente c.a', 'Puente Real', 'Guayana prolongacion 18 de Abril', 'CC Sur', 10),
(4, 'Intercomunal', 'Terminal', '19 de Abril con AV España', 'UNET', 5),
(5, 'Lineas Unidas', 'Terminal', 'Puente Real Carabobo', 'CC SAMBIL', 10),
(6, 'Residente c.a', 'Pueblo Nuevo', 'Centro Carabobo ', 'Terminal', 5),
(7, 'Unidad CA', 'UNET', '19 de Abril AV España ', 'Terminal', 6),
(8, 'Estudiantil C.A', 'Terminal', '19 de Abril AV España ULA', 'UNET', 3),
(9, 'Estudiantil C.A', 'Puente Real', 'Caracbobo AV España', 'ULA', 4),
(10, 'Residente c.a', 'Carabobo', 'av principal, quinta y septima', 'Unidad Vecinal', 15),
(11, 'V.I.P', 'Puente Real', 'Carabobo 5ta Avenida', 'Centro', 10),
(12, 'InterComunal', 'Carabobo', 'Caracbobo AV España', 'Pueblo Nuevo', 5),
(13, 'Federal Line', 'Terminal', 'Carabobo Via Cordero', 'Cordero', 16),
(14, 'V.I.P', 'Terminal', 'Carabobo', 'Sambil', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tipo` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `tipo`) VALUES
(1, 'alejandrovz2011@hotmail.com', '$2y$10$COwtmAxrG2kf5chZieF6QugHFOnpJoX93tcKvjhwgkNTGlorBKkUK', 1803),
(2, 'user@gmail.com', '$2y$10$gkS2EalMzkguDZk91DJIz.Mjs7HaPC2Pahc.wTJi9n0pCdZQc2jeS', 0),
(3, 'user1@gmail.com', '$2y$10$yVo9leyBvNUGsKa0TsgMxuxt9H.fGSYiKms3pbs/IoOhKIXVYpEVu', 0),
(4, 'alcaldia@gmail.com', '$2y$10$9dTsuT8F/W5cRSaYBMfOBeyLmnF7xCEIflZvDkXOXzB..AnknG0W.', 777);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
