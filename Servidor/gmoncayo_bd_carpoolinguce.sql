-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-11-2018 a las 16:27:42
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gmoncayo_bd_carpoolinguce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auto`
--

CREATE TABLE `auto` (
  `id_auto` int(4) NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `placa_auto` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `marca_auto` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `modelo_auto` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `color_auto` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_auto` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `capacidad_auto` int(5) NOT NULL,
  `foto_auto` text CHARACTER SET utf8 COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `auto`
--

INSERT INTO `auto` (`id_auto`, `id_usuario`, `placa_auto`, `marca_auto`, `modelo_auto`, `color_auto`, `tipo_auto`, `capacidad_auto`, `foto_auto`) VALUES
(1, 1, 'RCA-0489', 'KIA', 'RIO', 'ROJO', 'SEDÁN', 4, 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/autosUploads/auto.jpg'),
(2, 2, 'PCP-7655', 'CHEVROLET', 'Grand vitara sz', 'Plomo', 'SEDÁN', 3, 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/autosUploads/1668226650.'),
(5, 7, 'PBU-2152', 'CHEVROLET', 'AVEO', 'MARRON', 'SED�N', 3, 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/autosUploads/1811881190.'),
(6, 8, 'PBH-6840', 'HYUNDAI', 'TUCCSON', 'NEGRO', 'SUV', 3, 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/autosUploads/626673686.'),
(7, 10, 'PBK-8721', 'RENAULT', 'LOGAN ', 'NEGRO', 'SEDÁN', 4, 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/autosUploads/268525086.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_ruta`
--

CREATE TABLE `calificacion_ruta` (
  `id_calif_ruta` int(4) NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `id_ruta` int(4) NOT NULL,
  `calificacion` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `calificacion_ruta`
--

INSERT INTO `calificacion_ruta` (`id_calif_ruta`, `id_usuario`, `id_ruta`, `calificacion`) VALUES
(14, 1, 1, 1),
(21, 1, 2, 1),
(22, 7, 11, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confirmar`
--

CREATE TABLE `confirmar` (
  `con_id` int(11) NOT NULL,
  `con_email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `con_codigo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `confirmar`
--

INSERT INTO `confirmar` (`con_id`, `con_email`, `con_codigo`) VALUES
(1, 'tefa@uce.edu.ec', 'rqTxxM0Qv9'),
(2, 'mmoncayo@uce.edu.ec', '9alvoxxlQs'),
(3, 'mvgarciay@uce.edu.ec', 'QoAyUZG447'),
(4, 'markovgpg@uce.edu.ec', '8FZGN1qSDH'),
(5, 'mvgarci@uce.edu.ec', '3fF8abkTIR'),
(6, 'asda@uce.edu.ec', 'Ui3ojxFPal'),
(7, 'hgguaman@uce.edu.ec', 'QCdn40hxkG'),
(8, 'aflores@uce.edu.ec', 'kyKPk4jcRd'),
(9, 'jwduran@uce.edu.ec', 'WBzNGtd8HB'),
(10, 'kjandradec@uce.edu.ec', 'XyUWYUJ2JH'),
(11, 'wjvalladaresv@uce.edu.ec', 'Mrt3azGGap'),
(12, 'wjvalladares@uce.edu.ec', 'Ds2CWF097w'),
(13, 'cpcorreac@uce.edu.ec', 'Nd9egI7pix'),
(14, 'bayumbo@uce.edu.ec', 'MKpXSmel6w'),
(15, 'lpdioquilima@uce.edu.ec', '9ei3Tx7Za2'),
(16, 'cacaceresb2@uce.edu.ec', 'dWl2qDRUGc'),
(17, 'mvgarciay@uce.edu.ec', 'rHrDDlzNrz'),
(18, 'jyasimbaya@uce.edu.ec', 'XXRzWl4fCD'),
(19, 'jfjimenezc1@uce.edu.ec', 'Di18gAi8DQ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservados`
--

CREATE TABLE `reservados` (
  `id_reservado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_ruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reservados`
--

INSERT INTO `reservados` (`id_reservado`, `id_usuario`, `id_ruta`) VALUES
(1, 1, 2),
(3, 3, 2),
(4, 3, 1),
(10, 3, 7),
(11, 3, 9),
(12, 1, 9),
(13, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id_ruta` int(6) NOT NULL,
  `latitud_origen` float NOT NULL,
  `longitud_origen` float NOT NULL,
  `latitud_destino` float NOT NULL,
  `longitud_destino` float NOT NULL,
  `pd_encuentro` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_destino` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `hora_ruta` time NOT NULL,
  `disponibilidad_ruta` int(2) NOT NULL,
  `fecha_ruta` date NOT NULL,
  `estado_ruta` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id_ruta`, `latitud_origen`, `longitud_origen`, `latitud_destino`, `longitud_destino`, `pd_encuentro`, `direccion_destino`, `hora_ruta`, `disponibilidad_ruta`, `fecha_ruta`, `estado_ruta`) VALUES
(1, -0.197806, -78.5023, -0.0881842, -78.4528, 'Parqueadero Aulas S', 'Alberto Guerrero, Quito 170203, Ecuador', '16:35:00', 2, '2018-10-06', 'Ejecutada'),
(2, -0.197806, -78.5023, -0.201034, -78.5004, 'Parqueadero Aulas S', 'Ulloa N22- 105 y Ramírez Dávalos, Quito 170520, Ecuador', '19:54:00', 3, '2018-10-05', 'Ejecutada'),
(7, -0.197806, -78.5023, -0.200152, -78.5034, 'Parqueadero Hidraúli', 'Edificio Administrativo UCE, Av. América, Quito 170129, Ecuador', '16:08:00', 0, '2018-10-15', 'Ejecutada'),
(9, -0.197806, -78.5023, -0.185496, -78.4837, 'Parqueadero CISCO', 'La Carolina, Quito, Ecuador', '21:00:00', 1, '2018-10-16', 'Ejecutada'),
(10, -0.197806, -78.5023, -0.0938585, -78.4515, 'Parqueadero Hidraúli', 'Panecillo 235, Quito 170203, Ecuador', '18:30:00', 4, '2018-10-16', 'Ejecutada'),
(11, -0.197806, -78.5023, -0.260632, -78.5463, 'Parqueadero Aulas A', 'Angamarca &amp; Avenida Mariscal Sucre, Quito 170148, Ecuador', '13:30:00', 3, '2018-10-24', 'Ejecutada'),
(12, -0.197806, -78.5023, -0.2026, -78.5038, 'Parqueadero CISCO', 'M. Valera, M de Varela, Quito 170103, Ecuador', '17:14:00', 2, '2018-10-26', 'Ejecutada'),
(13, -0.197806, -78.5023, -0.201848, -78.5008, 'Parqueadero Aulas S', 'America Y Perez Guerrero, Quito 170129, Ecuador', '16:08:00', 3, '2018-10-26', 'Ejecutada'),
(14, -0.197806, -78.5023, -0.10541, -78.5133, 'Parqueadero CISCO', 'El Condado, Quito, Ecuador', '18:46:00', 4, '2018-10-31', 'Cancelada'),
(15, -0.197806, -78.5023, -0.0939538, -78.4513, 'Parqueadero CISCO', 'Rumiñahui, Quito 170203, Ecuador', '12:30:00', 2, '2018-11-05', 'Activa'),
(16, -0.197806, -78.5023, -0.202656, -78.5007, 'Parqueadero Hidraúli', 'America Y Perez Guerrero, Quito 170129, Ecuador', '14:55:00', 4, '2018-11-30', 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id_sector` int(4) NOT NULL,
  `nombre_sector` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pos_sector` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id_sector`, `nombre_sector`, `pos_sector`) VALUES
(1, 'Norte', 'Norte'),
(2, 'Sur', 'Sur'),
(3, 'Centro', 'Centro'),
(4, 'Valles', 'Valles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(4) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `foto` text CHARACTER SET utf8,
  `fecha_nac` date NOT NULL,
  `telefono` int(10) UNSIGNED ZEROFILL NOT NULL,
  `sector` varchar(100) CHARACTER SET utf8 NOT NULL,
  `rol` varchar(30) CHARACTER SET utf8 NOT NULL,
  `sexo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `clave` varchar(100) CHARACTER SET utf8 NOT NULL,
  `confirmado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `foto`, `fecha_nac`, `telefono`, `sector`, `rol`, `sexo`, `correo`, `clave`, `confirmado`) VALUES
(1, 'William Vladimir', 'Auz Riquelme', 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/uploads/1954120983.', '1995-08-31', 0987924458, 'Casas', 'Docente', 'Masculino', 'tefa@uce.edu.ec', '7815696ecbf1c96e6894b779456d330e', 1),
(2, 'Giovanny', 'Moncayo Unda', 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/uploads/1845062057.', '1983-03-05', 0995026736, 'Carapungo', 'Estudiante', 'Masculino', 'mmoncayo@uce.edu.ec', 'a906449d5769fa7361d7ecc6aa3f6d28', 1),
(7, 'Henry Giovanny', 'Guamán Rosales', NULL, '1983-03-17', 0998801899, 'Sur', 'Estudiante', 'Masculino', 'hgguaman@uce.edu.ec', 'f9dc59037ce25fc836546391d2f664b2', 1),
(8, 'Aldrin Ismael', 'Flores Suarez', 'http://gmoncayoresearch.com/carpoolingUCE/Servidor/uploads/1626899269.', '1969-08-18', 0984050315, 'Valles', 'Docente', 'Masculino', 'aflores@uce.edu.ec', 'd0afb808edb086873d1f927591f93a16', 1),
(9, 'Moises', 'Duran ', NULL, '1991-10-18', 0995102222, 'Norte', 'Estudiante', 'Masculino', 'jwduran@uce.edu.ec', 'ff9830c42660c1dd1942844f8069b74a', 1),
(10, 'Kevin Joel ', 'Andrade Correa ', NULL, '1999-03-28', 0983998566, 'Norte', 'Estudiante', 'Masculino', 'kjandradec@uce.edu.ec', 'f1ebd816687897e4d1c59a6168377ce9', 1),
(11, 'Wilson Jhoel', 'Valladares Valenzuela', NULL, '2000-03-10', 0989500318, 'Norte', 'Estudiante', 'Masculino', 'wjvalladaresv@uce.edu.ec', '979b6cd86c6f43e662f9766650a0c5e2', 1),
(12, 'Wilson Jhoel', 'Valladares Valenzuela', NULL, '2000-03-10', 0989500318, 'Norte', 'Estudiante', 'Masculino', 'wjvalladares@uce.edu.ec', '979b6cd86c6f43e662f9766650a0c5e2', 0),
(13, 'Cynthia Pamela ', 'Correa Calahorrano', NULL, '1999-10-23', 0981459772, 'Sur', 'Estudiante', 'Femenino', 'cpcorreac@uce.edu.ec', '2bd147e9017cb78952c02603cf4349af', 1),
(14, 'Bryan Alejandro', 'Yumbo Guallichico', NULL, '1998-06-20', 0969043297, 'Sur', 'Estudiante', 'Masculino', 'bayumbo@uce.edu.ec', 'ea8916c34b93b5775386fde6fe5d4fda', 1),
(15, 'Lenin Patricio ', 'Dioquilima ', NULL, '1999-12-11', 0995850670, 'Valles', 'Estudiante', 'Masculino', 'lpdioquilima@uce.edu.ec', '119774c68ea34174105580529a6371ba', 1),
(16, 'Cristian', 'Cáceres', NULL, '1998-07-20', 0983357220, 'Sur', 'Estudiante', 'Masculino', 'cacaceresb2@uce.edu.ec', '73533c229056bd8ee0b23380c66b0ec4', 0),
(17, 'Marco Vinicio', 'García Yunga', NULL, '1992-10-07', 0987924458, 'Norte', 'Estudiante', 'Masculino', 'mvgarciay@uce.edu.ec', '7815696ecbf1c96e6894b779456d330e', 1),
(18, 'Jessica', 'Asimbaya ', NULL, '1993-09-08', 0999663287, 'Sur', 'Estudiante', 'Femenino', 'jyasimbaya@uce.edu.ec', '671a46d479e6c7c3954096cc6953acda', 1),
(19, 'Juan Fernando', 'Jiménez Cobo', NULL, '1999-08-19', 0958919155, 'Sur', 'Estudiante', 'Masculino', 'jfjimenezc1@uce.edu.ec', '9e7b2fdbeb229281b9c4a489aa8fd150', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_ruta_sector`
--

CREATE TABLE `usuario_ruta_sector` (
  `id_urs` int(11) NOT NULL,
  `id_usuario` int(4) NOT NULL,
  `id_ruta` int(4) NOT NULL,
  `id_sector` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario_ruta_sector`
--

INSERT INTO `usuario_ruta_sector` (`id_urs`, `id_usuario`, `id_ruta`, `id_sector`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(7, 1, 7, 4),
(9, 1, 9, 1),
(11, 7, 11, 2),
(12, 1, 12, 3),
(13, 1, 13, 2),
(14, 10, 14, 1),
(15, 1, 15, 1),
(16, 1, 16, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id_auto`),
  ADD KEY `ForaneaUsuarioFK` (`id_usuario`);

--
-- Indices de la tabla `calificacion_ruta`
--
ALTER TABLE `calificacion_ruta`
  ADD PRIMARY KEY (`id_calif_ruta`),
  ADD KEY `ForaneaCR1` (`id_usuario`),
  ADD KEY `ForaneaCR2` (`id_ruta`);

--
-- Indices de la tabla `confirmar`
--
ALTER TABLE `confirmar`
  ADD PRIMARY KEY (`con_id`);

--
-- Indices de la tabla `reservados`
--
ALTER TABLE `reservados`
  ADD PRIMARY KEY (`id_reservado`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id_sector`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_ruta_sector`
--
ALTER TABLE `usuario_ruta_sector`
  ADD PRIMARY KEY (`id_urs`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_sector` (`id_sector`),
  ADD KEY `ForaneaURS3FK` (`id_ruta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auto`
--
ALTER TABLE `auto`
  MODIFY `id_auto` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `calificacion_ruta`
--
ALTER TABLE `calificacion_ruta`
  MODIFY `id_calif_ruta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `confirmar`
--
ALTER TABLE `confirmar`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `reservados`
--
ALTER TABLE `reservados`
  MODIFY `id_reservado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id_ruta` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id_sector` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `usuario_ruta_sector`
--
ALTER TABLE `usuario_ruta_sector`
  MODIFY `id_urs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `ForaneaUsuarioFK` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion_ruta`
--
ALTER TABLE `calificacion_ruta`
  ADD CONSTRAINT `ForaneaCR1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ForaneaCR2` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_ruta_sector`
--
ALTER TABLE `usuario_ruta_sector`
  ADD CONSTRAINT `ForaneaURS3FK` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ruta_sector_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ruta_sector_ibfk_2` FOREIGN KEY (`id_sector`) REFERENCES `sectores` (`id_sector`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
