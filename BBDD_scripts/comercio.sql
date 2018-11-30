-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2018 a las 19:27:52
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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `nick` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `referencia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`nick`, `referencia`, `cantidad`) VALUES
('a', 'Producto_1', 1),
('Martin', 'Producto_1', 1),
('p', 'Producto_1', 1),
('p', 'Producto_2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `nick` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `fecha` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id`, `nick`, `importe`, `fecha`) VALUES
(1, 'd', '192.39', '2018-11-30 17:08:38.542166'),
(2, 'd', '192.39', '2018-11-30 17:10:21.641063'),
(3, 'd', '1985.61', '2018-11-30 17:10:35.094832'),
(4, 'd', '3757.05', '2018-11-30 17:19:47.985456'),
(5, 'd', '192.39', '2018-11-30 17:33:21.445983'),
(6, 'gempo', '3372.27', '2018-11-30 17:52:17.795978'),
(7, 'gempo', '3372.27', '2018-11-30 17:57:48.194876'),
(8, 'gempo', '192.39', '2018-11-30 17:58:03.199734');

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
('Producto_1', 'Lampara de pasillo', 'Una descripcion cualquiera', 'imagenes/Producto_1/1.jpg', 159),
('Producto_2', 'Lampara de nochevieja', 'as', 'imagenes/Producto_2/3.jpg', 654),
('referencia', 'Lampara para gran salon', 'asdf', 'imagenes/referencia/1.jpg', 987);

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
('amigo', '123456', 'amigos', 'amigo', '55555', 'c/ Juan Pablo Bonet, 18', 'admin'),
('d', 'd', 'Dionisio', 'Gonzalez', '63215498', 'calle de las mesas', 'cliente'),
('fran', 'f', 'Francisco', 'Navarro', '66666666', 'c/ Juan Pablo Bonet, 18', 'admin'),
('gempo', '123456', 'Maria', 'De la Huerta', '66666666', 'c/ Juan Pablo Bonet, 18', 'admin'),
('p', '1', '1', '1', '1', '1', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`nick`,`referencia`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

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

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
