-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 22, 2022 at 05:25 AM
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
  `num_atencion` int DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `num_atencion`) VALUES
(1, 'OFICINA ESTADISTICA E INFORMATICA', 8),
(2, 'PACIENTE', 9),
(3, 'CARDIOLOGIA', 0),
(4, 'CIRUGIA DE CABEZA, CUELLO Y MAXILO FACIAL', 7),
(5, 'CIRUGÍA GENERAL', 6),
(6, 'CIRUGIA PLASTICA', 9),
(7, 'CIRUGIA DE TORAX Y CARDIOVASCULAR', 9),
(8, 'DERMATOLOGIA', 4),
(9, 'GASTROENTEROLOGIA', 8),
(10, 'GERIATRIA', 9),
(11, 'GINECOLOGÍA Y OBSTETRICIA', 10),
(12, 'HEMATOLOGIA', 9),
(13, 'INFECTOLOGIA', 10),
(14, 'MEDICINA FAMILIAR Y COMUNITARIAMEDICINA FISICA', 9),
(15, 'MEDICINA INTENSIVA', 10),
(16, 'MEDICINA INTERNA', 10),
(17, 'NEFROLOGIA', 9),
(18, 'NEUMOLOGIA', 10),
(19, 'NEUROCIRUGIA', 10),
(20, 'NEUROLOGIA', 10),
(21, 'NUTRICIONISTA', 10),
(22, 'ODONTOLOGIA', 10),
(23, 'OFTALMOLOGIA', 10),
(24, 'ONCOLOGIA', 10),
(25, 'ORTOPEDIA Y TRAUMATOLOGÍA', 10),
(26, 'OTORRINOLARINGOLOGIA', 10),
(27, 'PEDIATRÍA', 10),
(28, 'PSICOLOGIA', 10),
(29, 'PSIQUIATRIA', 10),
(30, 'RADIOLOGO', 10),
(31, 'REUMATOLOGIA', 10),
(32, 'TRAUMATOLOGIA', 10),
(33, 'UROLOGIA', 10),
(34, 'RADIOLOGO', 10),
(35, 'REUMATOLOGIA', 10),
(36, 'TRAUMATOLOGIA', 10),
(37, 'UROLOGIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
CREATE TABLE IF NOT EXISTS `citas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idHistorial` int DEFAULT NULL,
  `cod_cita` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anotacion_enfermera` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `anotacion_medico` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `datetime_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetime_fin` datetime DEFAULT NULL,
  `idEspecialidad` int DEFAULT NULL,
  `etapa` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idHistorial` (`idHistorial`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id`, `idHistorial`, `cod_cita`, `anotacion_enfermera`, `anotacion_medico`, `datetime_creacion`, `datetime_fin`, `idEspecialidad`, `etapa`) VALUES
(1, 5, '868963', '', '', '2022-03-19 06:07:57', NULL, NULL, 1),
(2, 6, '882567', '', '', '2022-03-19 07:24:08', NULL, NULL, 1),
(3, 7, '', '', '', '2022-03-19 07:30:46', NULL, NULL, 1),
(4, 8, '570974', '', '', '2022-03-20 04:07:49', NULL, NULL, 1),
(5, 9, '189735', '', '', '2022-03-20 06:41:27', NULL, NULL, 1),
(6, 10, '402021', '', '', '2022-03-20 08:07:37', NULL, NULL, 1),
(7, 11, '', '', '', '2022-03-20 08:12:06', NULL, 0, 1),
(8, 12, '800540', '', '', '2022-03-20 08:37:22', NULL, 8, 1),
(9, 13, '957409', 'dddddd', 'holitassssss', '2022-03-20 09:01:13', NULL, 3, 2),
(10, 14, '367623', '', '', '2022-03-21 05:47:49', NULL, 5, 1);

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
-- Table structure for table `historia_clinica`
--

DROP TABLE IF EXISTS `historia_clinica`;
CREATE TABLE IF NOT EXISTS `historia_clinica` (
  `id` int NOT NULL AUTO_INCREMENT,
  `num` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ieds` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `nombres_comp` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos_comp` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `sexo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` int DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `tipo_doc` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_doc` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_civil` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ocupacion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_madre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_padre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_acomp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni_acomp` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dir_acomp` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `historia_clinica`
--

INSERT INTO `historia_clinica` (`id`, `num`, `ieds`, `idUsuario`, `nombres_comp`, `apellidos_comp`, `edad`, `sexo`, `direccion`, `distrito`, `fecha_nac`, `tipo_doc`, `num_doc`, `estado_civil`, `ocupacion`, `celular`, `nombre_madre`, `nombre_padre`, `nombre_acomp`, `dni_acomp`, `dir_acomp`) VALUES
(1, '1222', '44455', NULL, 'Test paciente', '', NULL, '', '', 0, '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(2, '1222', '44455', NULL, 'Test paciente', '', NULL, '', '', 0, '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(3, '55555', 'ssssaas', NULL, '', '', NULL, '', '', 0, '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(4, '7777', '', NULL, '', '', NULL, '', '', 0, '0000-00-00', '', '', '', '', '', '', '', '', '', ''),
(5, '99999', '', NULL, 'GGFFFF', 'RRRRR', NULL, '', '', 0, '0000-00-00', 'RUC', '332222', '', '', '', '', '', '', '', ''),
(6, '2678367', 'test', NULL, 'Pepe lucas', '', NULL, '', '', 0, '0000-00-00', 'RUC', '3321112', '', '', '', '', '', '', '', ''),
(7, '1584010', '122222', 32, 'pancho', 'eeeee', NULL, '', '', 0, '0000-00-00', 'RUC', '2223333', '', '', '', '', '', '', '', ''),
(8, '2800599', '', NULL, 'marlon', '', NULL, '', '', 0, '0000-00-00', '', '7455511', '', '', '', '', '', '', '', ''),
(9, '6637312', '', NULL, 'ggg', 'RRRRR', NULL, '', '', 0, '0000-00-00', '', '332111233', '', '', '', '', '', '', '', ''),
(10, '7189086', '44455', NULL, 'JUAN CARLOS', '', NULL, '', '', 0, '0000-00-00', '', '5544444', '', '', '', '', '', '', '', ''),
(11, '8358906', 'eeee', 35, 'arnol', '', 0, '', '', 0, '0000-00-00', '', '11111', '', '', '', '', '', '', '', ''),
(12, '5720009', '', NULL, 'pancho2', '', 0, '', '', 0, '0000-00-00', '', '66666', '', '', '', '', '', '', '', ''),
(13, '8872806', '', NULL, 'oscar dddd', '', 0, '', '', 0, '0000-00-00', '', '666777', '', '', '', '', '', '', '', ''),
(14, '6572881', '5555', 35, 'mirna', 'Lopez', 0, '', '', 0, '0000-00-00', '', '11111', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modulos`
--

INSERT INTO `modulos` (`id`, `titulo`, `descripcion`, `estado`) VALUES
(3, 'Dashboard', NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id`, `idRol`, `idModulo`, `r`, `c`, `u`, `d`) VALUES
(1, 1, 3, 1, 1, 1, 1);

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
-- Table structure for table `solicitud_hc`
--

DROP TABLE IF EXISTS `solicitud_hc`;
CREATE TABLE IF NOT EXISTS `solicitud_hc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fijo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sustento` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado_mesa` int DEFAULT NULL,
  `estado_fedateo` int DEFAULT '-1',
  `observacion` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `solicitud_hc`
--

INSERT INTO `solicitud_hc` (`id`, `email`, `celular`, `fijo`, `direccion`, `distrito`, `sustento`, `dni_path`, `estado_mesa`, `estado_fedateo`, `observacion`, `created_at`, `idUsuario`) VALUES
(1, '', '', '', '', '', 'test', '20220314_807546453.png', 0, -1, 'aaaaaaaaaaaaaaaaa', '2022-03-14 23:34:52', 24),
(2, '', '', '', '', '', 'test2', '20220314_471028935.png', 0, -1, 'aaaaaaaaaaaaaaaaa', '2022-03-14 23:35:39', 24),
(3, '', '900000000', '3333333', '', '', 'nueva solicitud', '', 0, -1, 'aaaaaaaaaaaaaaaaa', '2022-03-14 23:52:42', 24),
(4, '', '4555555', '', '', '', '', '', 1, -1, '', '2022-03-14 23:53:05', 24),
(5, 'valido@gmail.com', '777777', '0101010', 'Av. los alamos', 'assaassaadasda', 'new sustento', '20220314_868703557.jpg', 1, -1, '', '2022-03-14 23:56:00', 24),
(6, '', '', '', '', '', 'swwwwww', '', 0, -1, 'aaaaaaaaaaaaaaaaa', '2022-03-15 00:02:36', 24),
(7, '', '', '', '', '', 'DDDDDDD', '', 0, -1, 'aaaaaaaaaaaaaaaaa', '2022-03-15 00:03:53', 24),
(8, '', '', '', '', '', 'SSSAASAAAA', '', 1, -1, '', '2022-03-15 00:04:50', 24),
(11, '', '', '', '', '', '', '', NULL, -1, NULL, '2022-03-19 02:38:27', 24),
(12, '', '', '', '', '', '', '', NULL, -1, NULL, '2022-03-19 02:39:02', 24),
(13, 'mirna@gmail.com', '', '', '', '0', 'sustento pruebaaaaaaaaaaaaaaaaaaaa', '', 1, -1, '', '2022-03-21 01:11:34', 35),
(14, '', '', '', '', '', 'ffffffffffffffffffff', '', -1, -1, NULL, '2022-03-21 01:23:48', 24);

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
  `tipo_doc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_doc` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fijo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `tipo_doc`, `num_doc`, `celular`, `fijo`, `direccion`, `distrito`, `idRol`, `idArea`, `estado`, `path_foto`, `token`, `created_at`, `updated_at`) VALUES
(2, 'admin', NULL, 'admin@gmail.com', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL),
(19, 'Meyer', '', 'meyer@gmail.com', 'meyer', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, 1, NULL, NULL, '2022-03-13 20:48:11', '2022-03-13 09:14:46'),
(20, 'COYAKS', 'PEREZ QUISPE', 'coyaks@gmail.com', 'coyaks', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 21:50:17', '2022-03-13 21:50:17'),
(21, 'COYAKS', 'PEREZ QUISPE', 'admin222@gmail.com', '22222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 22:28:17', '2022-03-13 22:28:17'),
(22, 'DIEGO ENRIQUE', 'SILVA DIAZ', 'diego@gmail.com', 'diego', 'DNI', '71582654', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, '2022-03-13 22:32:53', '2022-03-13 22:32:53'),
(23, 'JHON ANDERSON', 'PAUCAR CCASANI', 'test@gmail.com', 'test', 'DNI', '74815853', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, '2022-03-13 22:39:20', '2022-03-13 22:39:20'),
(24, 'Paciente ', 'Torres Alva', 'paciente@gmail.com', 'paciente', NULL, '34321111', '', '', '', '', 8, NULL, 1, NULL, NULL, '2022-03-13 22:47:42', '2022-03-13 22:47:42'),
(25, 'test33', ' ', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '2022-03-14 22:55:12', '2022-03-14 22:55:12'),
(26, 'Mesa de partes', '', 'mesa@gmail.com', 'mesa', NULL, NULL, NULL, NULL, NULL, NULL, 7, NULL, 1, NULL, NULL, '2022-03-15 01:04:59', '2022-03-15 01:04:59'),
(27, 'fedateo', '', 'fedateo@gmail.com', 'fedateo', NULL, NULL, NULL, NULL, NULL, NULL, 4, NULL, 1, NULL, NULL, '2022-03-18 00:01:47', '2022-03-18 00:01:47'),
(28, 'Admision', '', 'admision@gmail.com', 'admision', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, NULL, '2022-03-18 00:25:47', '2022-03-18 00:25:47'),
(29, 'GGFFFF', 'RRRRR', 'demo5@gmail.com', 'demo', 'RUC', '332222', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, '2022-03-19 01:57:45', '2022-03-19 01:57:45'),
(30, 'dddd', 'ffff', 'demo6@gmail.com', 'demo', NULL, '222111', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, '2022-03-19 02:16:15', '2022-03-19 02:16:15'),
(31, 'Pepe lucas', 'asas', 'pepe@gmail.com', 'pepe', 'RUC', '3321112', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, '2022-03-19 02:25:11', '2022-03-19 02:25:11'),
(32, 'pancho', 'eeeee', 'rosa@gmail.com', 'rosa', 'RUC', '2223333', NULL, NULL, NULL, NULL, 8, NULL, 1, NULL, NULL, '2022-03-19 02:31:26', '2022-03-19 02:31:26'),
(33, 'enfermera', '', 'enfermera@gmail.com', 'enfermera', NULL, NULL, NULL, NULL, NULL, NULL, 6, 3, 1, NULL, NULL, '2022-03-20 02:08:26', '2022-03-20 02:08:26'),
(34, 'medico', '', 'medico@gmail.com', 'medico', NULL, NULL, NULL, NULL, NULL, NULL, 5, 3, 1, NULL, NULL, '2022-03-20 02:14:25', '2022-03-20 02:14:25'),
(35, 'mirna', 'Lopez', 'mirna@gmail.com', 'mirna', NULL, '11111', '', '', '', '0', 8, NULL, 1, NULL, NULL, '2022-03-21 00:49:37', '2022-03-21 00:49:37');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idHistorial`) REFERENCES `historia_clinica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`idModulo`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `solicitud_hc`
--
ALTER TABLE `solicitud_hc`
  ADD CONSTRAINT `solicitud_hc_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
