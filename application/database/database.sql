-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-05-2021 a las 18:59:39
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `descripcion`, `status`) VALUES
(1, 'Ford', 'Carros', 1),
(2, 'Pepsi', 'Refresco', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

DROP TABLE IF EXISTS `modelos`;
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float(100,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modelo_marcas` (`marca_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `marca_id`, `nombre`, `descripcion`, `precio`, `status`) VALUES
(1, 1, 'Explorer', '', 100000.00, 1),
(2, 2, 'SevenUP', 'refresco', 15.00, 2),
(3, 2, 'pepsi', 'pepsi', 20.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

DROP TABLE IF EXISTS `ordenes`;
CREATE TABLE IF NOT EXISTS `ordenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) NOT NULL,
  `modelo_id` int(11) NOT NULL,
  `cantidad` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orden_pedido` (`pedido_id`),
  KEY `orden_modelo` (`modelo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `pedido_id`, `modelo_id`, `cantidad`) VALUES
(11, 3, 1, 9),
(10, 1, 2, 30),
(12, 3, 2, 50),
(23, 6, 1, 6),
(30, 5, 2, 3),
(29, 5, 3, 2),
(28, 5, 1, 3),
(24, 6, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `domicilio` text NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(20) NOT NULL,
  `iva` float(2,2) NOT NULL,
  `monto` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `nombre`, `apellido`, `domicilio`, `telefono`, `fecha`, `estado`, `iva`, `monto`) VALUES
(1, 'Jesus', 'Martinez', 'en una casafsgasgas', '6673662647436353643734636', '2021-04-29 18:24:36', '3', 0.16, 522.00),
(3, 'Erick', 'Castillo', 'dsadasdasdsa', '332321312', '2021-04-30 17:01:08', '2', 0.16, 1044870.00),
(6, 'Karen', 'Garcia', 'Av. Lorem Ipsum #1234', '123456789', '2021-05-27 18:43:56', '2', 0.16, 696052.20),
(5, 'Jesus', 'Perez', 'en una casa', '00000000000000', '2021-04-30 18:17:13', '2', 0.16, 348098.60);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
