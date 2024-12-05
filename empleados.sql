-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para empleados
CREATE DATABASE IF NOT EXISTS `empleados` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `empleados`;

-- Volcando estructura para tabla empleados.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `presupuesto` double unsigned NOT NULL,
  `gastos` double unsigned NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla empleados.departamento: ~7 rows (aproximadamente)
INSERT INTO `departamento` (`codigo`, `nombre`, `presupuesto`, `gastos`) VALUES
	(1, 'Desarrollo', 120000, 6000),
	(2, 'Sistemas', 150000, 21000),
	(3, 'Recursos Humanos', 280000, 25000),
	(4, 'Contabilidad', 110000, 3000),
	(5, 'I+D', 375000, 380000),
	(6, 'Proyectos', 0, 0),
	(7, 'Publicidad', 0, 1000);

-- Volcando estructura para tabla empleados.dep_empleados
CREATE TABLE IF NOT EXISTS `dep_empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(10) unsigned NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_dep_empleados_empleado` (`id_empleado`),
  KEY `FK_dep_empleados_departamento` (`id_departamento`),
  CONSTRAINT `FK_dep_empleados_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_dep_empleados_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla empleados.dep_empleados: ~0 rows (aproximadamente)

-- Volcando estructura para tabla empleados.empleado
CREATE TABLE IF NOT EXISTS `empleado` (
  `codigo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido1` varchar(100) NOT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `codigo_departamento` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nif` (`nif`),
  KEY `codigo_departamento` (`codigo_departamento`),
  CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`codigo_departamento`) REFERENCES `departamento` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla empleados.empleado: ~14 rows (aproximadamente)
INSERT INTO `empleado` (`codigo`, `nif`, `nombre`, `apellido1`, `apellido2`, `codigo_departamento`) VALUES
	(1, '32481596F', 'Aarón', 'Rivero', 'Gómez', 5),
	(2, 'Y5575632D', 'Adela', 'Salas', 'Díaz', 2),
	(3, 'R6970642B', 'Adolfo', 'Rubio', 'Flores', 3),
	(4, '77705545E', 'Adrián', 'Suárez', NULL, 4),
	(5, '17087203C', 'Marcos', 'Loyola', 'Méndez', 5),
	(6, '38382980M', 'María', 'Santana', 'Moreno', 1),
	(7, '80576669X', 'Pilar', 'Ruiz', NULL, 2),
	(8, '71651431Z', 'Pepe', 'Ruiz', 'Santana', 3),
	(9, '56399183D', 'Juan', 'Gómez', 'López', 2),
	(10, '46384486H', 'Diego', 'Flores', 'Salas', 5),
	(11, '67389283A', 'Marta', 'Herrera', 'Gil', 1),
	(12, '41234836R', 'Irene', 'Salas', 'Flores', NULL),
	(13, '82635162B', 'Juan Antonio', 'Sáez', 'Guerrero', NULL),
	(14, '324234', 'PEPITO', 'LOPEZ', 'BRINCA CHARCOS', 7);

-- Volcando estructura para tabla empleados.nomina
CREATE TABLE IF NOT EXISTS `nomina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(10) NOT NULL,
  `sueldo` decimal(20,6) NOT NULL,
  `bono` decimal(3,2) DEFAULT NULL,
  `f_pago` date NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla empleados.nomina: ~10 rows (aproximadamente)
INSERT INTO `nomina` (`id`, `id_empleado`, `sueldo`, `bono`, `f_pago`) VALUES
	(1, 10, 5070.160000, 2.14, '2024-11-10'),
	(2, 13, 3482.600000, 9.99, '2023-12-22'),
	(3, 14, 6846.560000, 2.60, '2023-12-08'),
	(4, 2, 5274.230000, 1.20, '2024-11-03'),
	(5, 11, 8857.060000, 2.80, '2024-03-10'),
	(6, 4, 4670.590000, 2.80, '2024-03-14'),
	(7, 5, 3016.810000, 7.20, '2024-10-28'),
	(8, 6, 3193.120000, 8.50, '2024-10-17'),
	(9, 3, 5625.890000, 3.50, '2024-07-10'),
	(10, 2, 9966.190000, 9.90, '2024-05-09');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
