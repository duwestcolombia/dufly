-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2017 a las 13:00:51
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dufly`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE IF NOT EXISTS `ciudades` (
  `ID_CIUDAD` int(10) NOT NULL DEFAULT '0',
  `NOMBRE_CIUDAD` varchar(2000) NOT NULL,
  `ID_PAIS` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_CIUDAD`),
  KEY `FK_PAISES_CIUDADES_idx` (`ID_PAIS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE IF NOT EXISTS `destinos` (
  `ID_DESTINO` int(10) NOT NULL,
  `ID_CIUDAD` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_DESTINO`),
  KEY `FK_CIUDADES_DESTINOS_idx` (`ID_CIUDAD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE IF NOT EXISTS `hoteles` (
  `CODRESERVA_HOTEL` int(10) NOT NULL,
  `CIUDAD_HOTEL` int(10) DEFAULT NULL,
  `FINGRESO_HOTEL` date DEFAULT NULL,
  `FSALIDA_HOTEL` date DEFAULT NULL,
  PRIMARY KEY (`CODRESERVA_HOTEL`),
  KEY `FK_CIUDADES_HOTELES_idx` (`CIUDAD_HOTEL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origenes`
--

CREATE TABLE IF NOT EXISTS `origenes` (
  `ID_ORIGEN` int(10) NOT NULL,
  `ID_CIUDAD` int(10) DEFAULT NULL,
  PRIMARY KEY (`ID_ORIGEN`),
  KEY `FK_CIUDADES_ORIGENES_idx` (`ID_CIUDAD`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `ID_PAIS` int(10) NOT NULL DEFAULT '0',
  `NOMBRE_PAIS` varchar(2000) NOT NULL,
  PRIMARY KEY (`ID_PAIS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `COD_RESERVA` int(10) NOT NULL DEFAULT '0',
  `FECHA_RESERVA` datetime NOT NULL,
  `HOTEL_RESERVA` char(1) NOT NULL,
  `VUELO_RESERVA` char(1) NOT NULL,
  `VIDAREGRESO_HOTEL` char(1) DEFAULT NULL,
  `OBSERVACION_RESERVA` varchar(2000) DEFAULT NULL,
  `AUTORIZO_RESERVA` varchar(2000) DEFAULT NULL,
  `FAUTORIZACION_RESERVA` date DEFAULT NULL,
  `ESTADO_RESERVA` char(10) DEFAULT NULL,
  `ESPORADICO_USUARIO` varchar(2000) DEFAULT NULL,
  `ID_USUARIO` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`COD_RESERVA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE IF NOT EXISTS `vuelos` (
  `CODRESERVA_VUELO` int(10) NOT NULL,
  `ID_ORIGEN` int(10) DEFAULT NULL,
  `ID_DESTINO` int(10) DEFAULT NULL,
  `FECHA_VUELO` date DEFAULT NULL,
  `FECHA_REGRESO_VUELO` date DEFAULT NULL,
  PRIMARY KEY (`CODRESERVA_VUELO`),
  KEY `FR_ORIGENES_VUELOS_idx` (`ID_ORIGEN`),
  KEY `FK_DESTINOS_VUELOS_idx` (`ID_DESTINO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `FK_PAISES_CIUDADES` FOREIGN KEY (`ID_PAIS`) REFERENCES `paises` (`ID_PAIS`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD CONSTRAINT `FK_CIUDADES_DESTINOS` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `ciudades` (`ID_CIUDAD`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD CONSTRAINT `FK_CIUDADES_HOTELES` FOREIGN KEY (`CIUDAD_HOTEL`) REFERENCES `ciudades` (`ID_CIUDAD`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_RESERVAS_HOTELES` FOREIGN KEY (`CODRESERVA_HOTEL`) REFERENCES `reservas` (`COD_RESERVA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `origenes`
--
ALTER TABLE `origenes`
  ADD CONSTRAINT `FK_CIUDADES_ORIGENES` FOREIGN KEY (`ID_CIUDAD`) REFERENCES `ciudades` (`ID_CIUDAD`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vuelos`
--
ALTER TABLE `vuelos`
  ADD CONSTRAINT `FK_DESTINOS_VUELOS` FOREIGN KEY (`ID_DESTINO`) REFERENCES `destinos` (`ID_DESTINO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ORIGENES_VUELOS` FOREIGN KEY (`ID_ORIGEN`) REFERENCES `origenes` (`ID_ORIGEN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_RESERVAS_VUELOS` FOREIGN KEY (`CODRESERVA_VUELO`) REFERENCES `reservas` (`COD_RESERVA`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
