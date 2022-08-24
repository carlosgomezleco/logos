-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: orion
-- Tiempo de generación: 28-06-2019 a las 09:02:36
-- Versión del servidor: 5.1.73
-- Versión de PHP: 5.5.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `webogi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pub_documento`
--

CREATE TABLE IF NOT EXISTS `pub_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ruta` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(1) NOT NULL COMMENT '0=>Diario Oficial, 1=> Normativa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `pub_documento`
--

INSERT INTO `pub_documento` (`id`, `nombre`, `ruta`, `tipo`) VALUES
(1, 'llllllllll', '1_11-TIC165_GOMEZ_GALAN.xls', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pub_hoja_inventario`
--

CREATE TABLE IF NOT EXISTS `pub_hoja_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `investigador` varchar(70) NOT NULL,
  `hoja` varchar(70) NOT NULL,
  `foto` varchar(70) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `pub_hoja_inventario`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pub_incentivo`
--

CREATE TABLE IF NOT EXISTS `pub_incentivo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Incentivo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `pub_incentivo`
--

INSERT INTO `pub_incentivo` (`id`, `Incentivo`) VALUES
(1, 'MOTRICES-INFRA-2018'),
(3, 'REDES'),
(4, 'MOTRICES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pub_modelo_hoja`
--

CREATE TABLE IF NOT EXISTS `pub_modelo_hoja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_incentivo` int(11) NOT NULL,
  `archivado` tinyint(1) NOT NULL,
  `hoja_inventario` varchar(100) NOT NULL,
  `observaciones` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `pub_modelo_hoja`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pub_usuarios`
--

CREATE TABLE IF NOT EXISTS `pub_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `pub_usuarios`
--

INSERT INTO `pub_usuarios` (`id`, `usuario`) VALUES
(1, 'mcarmen.garcia.sc'),
(2, 'ogi'),
(3, 'adm.id'),
(4, 'carlos.gomez.sc');
