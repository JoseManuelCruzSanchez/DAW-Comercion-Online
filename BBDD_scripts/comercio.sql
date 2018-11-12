-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2018 a las 19:01:57
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comercio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `referencia` varchar(10) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `ruta_imagen` varchar(50) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`referencia`, `titulo`, `descripcion`, `ruta_imagen`, `precio`) VALUES
('81866358', 'Lámpara de pie LED WAVE', 'Lámpara de pie con 1 luz, fabricada en metal de color metálico y estilo moderno, tecnología LED integrado. Ideal para decorar y crear una luz ambiental y acogedora en su salón u otras estancias. Dispone de IP23 indicado para uso en interior.', 'imagenes/81866358/1.jpg', 34),
('81884042', 'Lámpara de pie LED POLINA', 'Lámpara de pie LED recta de estilo moderno de 2 luces, con una potencia de 23 W con un tono de luz cálido. Produce un flujo luminoso de 1480 lúmenes. Fabricada en metal con acabado en color gris. Clasificación energética A. Medidas: 136 cm de altura ', 'imagenes/81884042/1.jpg', 220);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nick` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('admin','cliente') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nick`, `contrasena`, `nombre`, `apellidos`, `telefono`, `direccion`, `tipo`) VALUES
('Andres', 'b', 'Andres', 'Perete Perete', '654987341', 'calle de los juares', 'admin'),
('Andres1', 'a', 'Andres', 'Perete Perete', '321654987', 'calle de los juares', 'admin'),
('Andres2', 'a', 'Andres', 'Perete Perete', '321654987', 'calle de los juares', 'cliente'),
('gempo3', 'asd', 'Jose', 'cruz', '687905815', 'juan pablo bonet', 'cliente'),
('iñigo', 'ab', 'abasdf', 'abasdf', 'ab', 'abasdf', 'cliente'),
('Martin', 'asd', 'Martin', 'SÃ¡nchez Heras', '987654321', 'av salamanca 3', 'cliente'),
('p', 'p', 'José Manuel', 'Cruz Sánchez', '687905815', 'c/ Juan Pablo Bonet, 18', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`referencia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`nick`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
