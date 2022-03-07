-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2022 at 06:02 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistema_hc`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `nombre`) VALUES
(1, 'OFICINA ESTADISTICA E INFORMATICA'),
(2, 'PACIENTE'),
(3, 'CARDIOLOGIA'),
(4, 'CIRUGIA DE CABEZA, CUELLO Y MAXILO FACIAL'),
(5, 'CIRUGÍA GENERAL'),
(6, 'CIRUGIA PLASTICA'),
(7, 'CIRUGIA DE TORAX Y CARDIOVASCULAR'),
(8, 'DERMATOLOGIA'),
(9, 'GASTROENTEROLOGIA'),
(10, 'GERIATRIA'),
(11, 'GINECOLOGÍA Y OBSTETRICIA'),
(12, 'HEMATOLOGIA'),
(13, 'INFECTOLOGIA'),
(14, 'MEDICINA FAMILIAR Y COMUNITARIAMEDICINA FISICA'),
(15, 'MEDICINA INTENSIVA'),
(16, 'MEDICINA INTERNA'),
(17, 'NEFROLOGIA'),
(18, 'NEUMOLOGIA'),
(19, 'NEUROCIRUGIA'),
(20, 'NEUROLOGIA'),
(21, 'NUTRICIONISTA'),
(22, 'ODONTOLOGIA'),
(23, 'OFTALMOLOGIA'),
(24, 'ONCOLOGIA'),
(25, 'ORTOPEDIA Y TRAUMATOLOGÍA'),
(26, 'OTORRINOLARINGOLOGIA'),
(27, 'PEDIATRÍA'),
(28, 'PSICOLOGIA'),
(29, 'PSIQUIATRIA'),
(30, 'RADIOLOGO'),
(31, 'REUMATOLOGIA'),
(32, 'TRAUMATOLOGIA'),
(33, 'UROLOGIA'),
(34, 'RADIOLOGO'),
(35, 'REUMATOLOGIA'),
(36, 'TRAUMATOLOGIA'),
(37, 'UROLOGIA');

-- --------------------------------------------------------

--
-- Table structure for table `config_general`
--

DROP TABLE IF EXISTS `config_general`;
CREATE TABLE IF NOT EXISTS `config_general` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config_general`
--

INSERT INTO `config_general` (`id`, `nombre`, `valor`, `descripcion`) VALUES
(1, 'empresa', 'skoy', 'Nombre de la empresa que utiliza el sistema comercial'),
(2, 'path_logo', 'logo.png', 'Ruta del logo de la Empresa'),
(3, 'moneda', 'S/', 'Símbolo de la moneda en uso'),
(4, 'igv', '18', 'Porcentaje del igv'),
(5, 'google_maps_api_key', 'AIzaSyB_3VeFSPqQcB8jmnn5Ju8MO3EZPGg8Y_g', 'Llave maps'),
(6, 'email_sender', 'coyaks19@gmail.com', 'Remitente de emails'),
(7, 'path_nubefact', 'https://api.nubefact.com/api/v1/26090489-4dbb-471d-b4b0-3e0d8ac58de7', NULL),
(8, 'nubefact_token', '4c9185a3e37c43a1a1a10f1f767de3ac9ff31adcd53746c7842eac0f540f6bad', NULL),
(9, 'culqi_key_private', 'sk_test_99d8b973ffdea438', 'Llave privada de Culqi (proveedor de pasarela de pago)'),
(10, 'culqi_key_public', 'pk_test_b22ecb3cd06c88c2', 'Llave publica de Culqi (proveedor de pasarela de pago)');

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idRol` int NOT NULL,
  `idModulo` int NOT NULL,
  `r` int DEFAULT NULL,
  `c` int DEFAULT NULL,
  `u` int DEFAULT NULL,
  `d` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idRol` (`idRol`),
  KEY `idModulo` (`idModulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo_persona` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_doc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `deuda` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'ADMIN', 'Administrador del sistema\r\n', 1),
(2, 'TECNICO ADMINISTRATIVO ADMISION', 'Tecnico Administrativo Admision del Hipolito', 1),
(4, 'TÉCNICO ADMINISTRATIVO FEDATEO', '', 1),
(5, 'MEDICO', '', 1),
(6, 'LICENCIADA DE ENFERMERIA', '', 1),
(7, 'TÉCNICO ADMINISTRATIVO MESA DE PARTES', '', 1),
(8, 'PACIENTE', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idRol` int DEFAULT NULL,
  `idArea` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `path_foto` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idRol` (`idRol`),
  KEY `idArea` (`idArea`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `idRol`, `idArea`, `estado`, `path_foto`, `token`, `created_at`, `updated_at`) VALUES
(2, 'admin', NULL, 'admin@gmail.com', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'RAUL', NULL, 'raul@gmail.com', 'raul', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'test2', NULL, 'test@gmail.com', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `modulos`
--
ALTER TABLE `modulos`
  ADD CONSTRAINT `modulos_ibfk_1` FOREIGN KEY (`id`) REFERENCES `permisos` (`idModulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idArea`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
