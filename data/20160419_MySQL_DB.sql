-- --------------------------------------------------------
-- Host:                         192.168.56.2
-- Versión del servidor:         5.5.46 - MySQL Community Server (GPL)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para phoneapp
DROP DATABASE IF EXISTS `phoneapp`;
CREATE DATABASE IF NOT EXISTS `phoneapp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `phoneapp`;


-- Volcando estructura para tabla phoneapp.autos
DROP TABLE IF EXISTS `autos`;
CREATE TABLE IF NOT EXISTS `autos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `color` varchar(50) NOT NULL,
  `no_motor` varchar(50) NOT NULL,
  `matricula_auto` varchar(50) NOT NULL,
  `no_chassis` varchar(50) NOT NULL,
  `observaciones` varchar(50) NOT NULL,
  `kilometraje` varchar(50) NOT NULL,
  `no_chapa` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL DEFAULT '1',
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(75) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado_civil` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `numero_oficina` varchar(50) DEFAULT NULL,
  `ciudad` varchar(50) NOT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `id_provincia` int(11) NOT NULL,
  `codigo_postal` varchar(50) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `numero_casa` varchar(20) NOT NULL,
  `numero_trabajo` varchar(20) DEFAULT NULL,
  `numero_movil` varchar(20) DEFAULT NULL,
  `cargo_trabajo` varchar(50) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_conexion` date NOT NULL,
  `fecha_modif` date NOT NULL,
  `id_estado` int(11) NOT NULL,
  `auth_key` varchar(32) DEFAULT '0',
  `password_reset_token` varchar(255) DEFAULT '0',
  `role` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.contratos
DROP TABLE IF EXISTS `contratos`;
CREATE TABLE IF NOT EXISTS `contratos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `id_forms` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_modif` date NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.forms_datos
DROP TABLE IF EXISTS `forms_datos`;
CREATE TABLE IF NOT EXISTS `forms_datos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datos` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.logs
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  `ip_address` varchar(20) NOT NULL,
  `fecha_registro` date NOT NULL,
  `hora_registro` time NOT NULL,
  `result` varchar(100) DEFAULT NULL,
  `submodule` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.paises
DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.provincias
DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_provincia` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.stados
DROP TABLE IF EXISTS `stados`;
CREATE TABLE IF NOT EXISTS `stados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(50) NOT NULL,
  `contexto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(75) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_conexion` date NOT NULL,
  `fecha_modif` date NOT NULL,
  `id_estado` int(11) NOT NULL,
  `auth_key` varchar(32) DEFAULT '0',
  `password_reset_token` varchar(255) DEFAULT '0',
  `role` int(11) DEFAULT '0',
  `is_super_admin` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.


-- Volcando estructura para tabla phoneapp.ventas
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `id_forms` int(11) NOT NULL,
  `tiene_consignacion` smallint(6) NOT NULL,
  `id_form_consignacion` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_modif` date NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
