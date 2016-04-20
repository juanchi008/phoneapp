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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla phoneapp.clientes: 0 rows
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre_usuario`, `contrasena`, `nombre`, `email`, `estado_civil`, `direccion`, `numero_oficina`, `ciudad`, `provincia`, `id_provincia`, `codigo_postal`, `id_pais`, `numero_casa`, `numero_trabajo`, `numero_movil`, `cargo_trabajo`, `fecha_registro`, `fecha_conexion`, `fecha_modif`, `id_estado`, `auth_key`, `password_reset_token`, `role`) VALUES
	(36, 'jose008', '$2y$13$NKU/.kuAAiQlAadZJdnBUeXluImbg2N5KczynNCcNM.AyoWd7y6bK', 'josel', 'jose@hotmail.com', 'soltero', 'iturbe', '241', 'lambare', 'Asunción', 1, '0214', 1, '901264', '1548485', '1146516486', 'analista', '2016-01-23', '1970-01-01', '2016-02-05', 1, 'fv_W3nFU5E7ffr_G2EoPU1byByrIW-rQ', '0', 20);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Volcando estructura para tabla phoneapp.contactos
DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apodo` varchar(50) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `no_apart` varchar(4) DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  `id_pais` smallint(6) NOT NULL,
  `codigo_postal` varchar(4) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `movil` varchar(12) DEFAULT NULL,
  `oficio` varchar(50) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL DEFAULT '1',
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla phoneapp.contactos: 0 rows
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;


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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla phoneapp.logs: 0 rows
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `module`, `info`, `ip_address`, `fecha_registro`, `hora_registro`, `result`, `submodule`, `nombre`, `role`) VALUES
	(1, 'login', 'login via login form page', '184.110.123.15', '2016-02-05', '11:30:00', 'Success', 'page', 'Super Admin | 1', 'Super Admin'),
	(2, 'autos', 'Exito', '10.1.1.2', '1970-01-01', '03:02:00', 'exito', 'crear', 'Super Admin | 5', 'Super Admin'),
	(6, 'autos', 'Exito', '192.168.56.1', '1970-01-01', '09:02:00', 'exito', 'actualizar', 'Super Admin | 5', 'Super Admin');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


-- Volcando estructura para tabla phoneapp.paises
DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla phoneapp.paises: 0 rows
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` (`id`, `nombre_pais`) VALUES
	(1, 'Paraguay'),
	(2, 'Argentina'),
	(3, 'Canada'),
	(5, 'Brasil'),
	(6, 'Chile'),
	(7, 'Uruguay'),
	(4, 'Colombia'),
	(8, 'venezuela');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;


-- Volcando estructura para tabla phoneapp.provincias
DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_provincia` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla phoneapp.provincias: 0 rows
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` (`id`, `nombre_provincia`) VALUES
	(1, 'Asunción'),
	(2, 'Encarnacion'),
	(4, 'Ciudad del este'),
	(6, 'Concepcion'),
	(7, 'Pilar'),
	(8, 'San Pedro');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;


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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla phoneapp.users: 0 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nombre_usuario`, `contrasena`, `nombre`, `email`, `fecha_registro`, `fecha_conexion`, `fecha_modif`, `id_estado`, `auth_key`, `password_reset_token`, `role`, `is_super_admin`) VALUES
	(6, 'alebogado', '$2y$13$R9xSEajuU21cAjn3dYZ4xuhaKdG5S7k5djeKYdihyIMu6jzS6o1KC', 'Alejandra', 'ale@hotmail.com', '2016-01-16', '1970-01-01', '1970-01-01', 1, 'JeENFBD_BOuaz9DEUB44cZczLmqrvWr_', '0', 30, 0),
	(7, 'juanchi008', '$2y$13$GgQDYwSpTmjqpFC00AdzU.GQjgT10xCX/N790.xR5boRsN4VtwJ32', 'Juan Manuel', 'juan_@hotmail.com', '2016-01-16', '1970-01-01', '1970-01-01', 1, '2QfqjI14XGOonVr9mOCG-Kb_4AcStZbT', '0', 30, 0),
	(5, 'superadmin', '$2y$13$NF0ICNbmYcnmJKzfbk0Svu0flnOiLi8kvjc3s9r/idW/z8EeYD3X2', 'Super Admin', 'juanchi_008manuel@hotmail.com', '2016-01-16', '1970-01-01', '2016-01-16', 1, 'v9ATygfEStomJRapB8hzr121BV40zjRE', '0', 40, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
