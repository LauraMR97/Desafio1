-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 02, 2021 at 12:46 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `escapeweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `opciones`
--

CREATE TABLE `opciones` (
  `id_opcion` int NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `id_pregunta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `opciones`
--

INSERT INTO `opciones` (`id_opcion`, `descripcion`, `id_pregunta`) VALUES
(1, 'Plata', 15),
(2, 'Caucho', 15),
(3, 'Quiero las dos', 15),
(4, 'o', 15),
(5, 'Perry el Perro', 16),
(6, 'AlTorito el torito', 16),
(7, 'Paquito el Patito', 16),
(8, 'Paca la Alpaca', 16),
(9, 'LA REINA DE ESPAÑA', 17),
(10, 'LA REINA DE LOS LAGARTOS', 17),
(11, 'A NO SE', 17),
(12, 'AJAJJAJAJ', 17);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `foto` varchar(30) NOT NULL,
  `prestigio` varchar(20) NOT NULL,
  `aciertos` int NOT NULL,
  `victorias` int NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `conectado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`nombre`, `correo`, `password`, `foto`, `prestigio`, `aciertos`, `victorias`, `activo`, `conectado`) VALUES
('alvaro', 'alvaro@gmail.com', '8f39c63d50478f69b087a9696546e72e50cd1967', './PERFILES/usuario.jpg', 'madera', 0, 0, 0, 0),
('Daniel', 'daniel@gmail.com', 'bdafc5b89483593871bf6f3e6cb5d87d8eac20d8', './PERFILES/usuario.jpg', 'madera', 0, 0, 1, 0),
('david', 'david@gmail.com', '269cb45d944e48836d6e92d5f74ea339807882af', './PERFILES/usuario.jpg', 'madera', 50, 0, 1, 0),
('Laura', 'laura@gmail.com', '94745df4bd94de756ea5436584fec066fc7898d5', './PERFILES/usuario.jpg', 'madera', 0, 0, 1, 0),
('Abril', 'lauramorenoramos97@gmail.com', '2fae671016c4ea86e8334cdfc2bc1cdc20c54430', './PERFILES/usuario.jpg', 'madera', 0, 0, 0, 0),
('m', 'm@gmail.com', '6b0d31c0d563223024da45691584643ac78c96e8', './PERFILES/usuario.jpg', 'madera', 30, 0, 1, 0),
('Miku', 'miku@gmail.com', '8f013fac0d0f685814950bc3ca887532a8f88b4f', './PERFILES/usuario.jpg', 'madera', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pregunta`
--

CREATE TABLE `pregunta` (
  `Id_pregunta` int NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `correo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`Id_pregunta`, `descripcion`, `correo`) VALUES
(15, '¿Plata o Plomo?', 'david@gmail.com'),
(16, '¿Quien es mi Mascota?', 'david@gmail.com'),
(17, '¿Quien es Malena?', 'david@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `preg_resp`
--

CREATE TABLE `preg_resp` (
  `Id_pregunta` int NOT NULL,
  `id_respuesta` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `preg_resp`
--

INSERT INTO `preg_resp` (`Id_pregunta`, `id_respuesta`) VALUES
(15, 12),
(16, 13),
(17, 14);

-- --------------------------------------------------------

--
-- Table structure for table `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int NOT NULL,
  `descripcionR` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `descripcionR`) VALUES
(12, 'Caucho'),
(13, 'Perry el Perro'),
(14, 'LA REINA DE LOS LAGARTOS');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` int NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(0, 'Administrador'),
(1, 'Editor'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Table structure for table `rol_persona`
--

CREATE TABLE `rol_persona` (
  `id_rol` int NOT NULL,
  `correo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rol_persona`
--

INSERT INTO `rol_persona` (`id_rol`, `correo`) VALUES
(1, 'alvaro@gmail.com'),
(2, 'daniel@gmail.com'),
(0, 'david@gmail.com'),
(0, 'laura@gmail.com'),
(2, 'lauramorenoramos97@gmail.com'),
(2, 'm@gmail.com'),
(2, 'miku@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sala`
--

CREATE TABLE `sala` (
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `num_personas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id_opcion`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`correo`);

--
-- Indexes for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`Id_pregunta`),
  ADD UNIQUE KEY `descripcion` (`descripcion`),
  ADD KEY `correo` (`correo`);

--
-- Indexes for table `preg_resp`
--
ALTER TABLE `preg_resp`
  ADD PRIMARY KEY (`Id_pregunta`,`id_respuesta`),
  ADD KEY `id_respuesta` (`id_respuesta`);

--
-- Indexes for table `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respuesta`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rol_persona`
--
ALTER TABLE `rol_persona`
  ADD PRIMARY KEY (`id_rol`,`correo`),
  ADD KEY `correo` (`correo`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id_opcion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `Id_pregunta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`Id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `persona` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preg_resp`
--
ALTER TABLE `preg_resp`
  ADD CONSTRAINT `preg_resp_ibfk_1` FOREIGN KEY (`Id_pregunta`) REFERENCES `pregunta` (`Id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preg_resp_ibfk_2` FOREIGN KEY (`id_respuesta`) REFERENCES `respuesta` (`id_respuesta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rol_persona`
--
ALTER TABLE `rol_persona`
  ADD CONSTRAINT `rol_persona_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `persona` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_persona_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
