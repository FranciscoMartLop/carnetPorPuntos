-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2016 at 07:39 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `franweb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`franweb`@`%` PROCEDURE `update_license_month` ()  BEGIN
	DECLARE Current_Num_exp INT;
    DECLARE Current_Puntos TINYINT;
	DECLARE done INT DEFAULT FALSE;
    DECLARE c1 cursor for select Num_exp, Puntos from carnet;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    open c1;
    myloop: LOOP
    fetch c1 into Current_Num_exp, Current_Puntos;
    IF done THEN
      LEAVE myloop;
	END IF;
	BEGIN
		INSERT INTO historial_carnet(Num_exp, Puntos_ini, Inicio_mes) values (Current_Num_exp, Current_Puntos, NOW());
	END;
    END LOOP;
    CLOSE c1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `actualiza`
--

CREATE TABLE `actualiza` (
  `Id_profesor` int(11) NOT NULL,
  `Num_exp` int(11) NOT NULL,
  `Fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Codigo_curso` int(11) NOT NULL,
  `Id_motivo` int(11) NOT NULL,
  `Puntuacion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actualiza`
--

INSERT INTO `actualiza` (`Id_profesor`, `Num_exp`, `Fecha_hora`, `Codigo_curso`, `Id_motivo`, `Puntuacion`) VALUES
(1, 1, '2016-06-06 11:24:19', 1, 7, 0.5),
(1, 1, '2016-06-07 17:55:22', 1, 3, -2),
(1, 1, '2016-06-08 03:20:30', 1, 3, -2),
(1, 1, '2016-06-08 13:50:39', 1, 8, 1),
(1, 1, '2016-06-10 20:59:41', 1, 9, 1),
(1, 1, '2016-06-10 21:00:13', 1, 2, -1),
(1, 1, '2016-06-14 11:06:48', 1, 2, -1),
(1, 1, '2016-06-16 22:16:52', 1, 9, 1),
(1, 1, '2016-06-19 17:22:25', 1, 10, 1),
(1, 2, '2016-06-14 10:42:51', 2, 4, -2),
(1, 3, '2016-06-08 13:57:44', 1, 2, -1),
(1, 3, '2016-06-16 22:11:12', 1, 2, -1),
(1, 5, '2016-06-01 20:32:35', 3, 19, 4),
(1, 6, '2016-06-01 20:32:44', 3, 8, -4),
(1, 6, '2016-06-01 20:33:03', 3, 15, 1),
(1, 7, '2016-06-01 20:32:08', 4, 8, -2),
(2, 2, '2016-05-18 09:56:29', 2, 1, -1),
(3, 7, '2016-06-19 17:28:43', 4, 10, -4),
(3, 7, '2016-06-19 17:29:15', 4, 20, 2),
(3, 7, '2016-06-19 17:30:26', 4, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `alumnado`
--

CREATE TABLE `alumnado` (
  `Num_exp` int(11) NOT NULL,
  `Nombre_alumno` varchar(70) NOT NULL,
  `Apellidos_alumno` varchar(70) NOT NULL,
  `Carnet` int(11) NOT NULL,
  `Codigo_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alumnado`
--

INSERT INTO `alumnado` (`Num_exp`, `Nombre_alumno`, `Apellidos_alumno`, `Carnet`, `Codigo_curso`) VALUES
(1, 'José', 'Pérez Villegas', 1, 1),
(2, 'María', 'Ruiz Peña', 2, 2),
(3, 'Pepe', 'Villegas Castillo', 3, 1),
(4, 'Carlos', 'García Torres', 4, 2),
(5, 'Ramón', 'Castillo Muñoz', 5, 3),
(6, 'Natalia', 'Montiel Gonzalez', 6, 3),
(7, 'Victor', 'López Sevilla', 7, 4),
(8, 'Celia', 'Cabeo Ruiz', 8, 4),
(9, 'Cristina', 'Sánchez Montoro ', 9, 5),
(10, 'Marina', 'Puga Campos', 10, 5),
(11, 'Javier', 'Abril Jiménez', 11, 6),
(12, 'Alberto', 'Rubio De Guinzo', 12, 6);

-- --------------------------------------------------------

--
-- Table structure for table `carnet`
--

CREATE TABLE `carnet` (
  `Num_exp` int(11) NOT NULL,
  `Puntos` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carnet`
--

INSERT INTO `carnet` (`Num_exp`, `Puntos`) VALUES
(1, 23),
(2, 13),
(3, 9),
(4, 5),
(5, 15),
(6, 23),
(7, 15),
(8, 13),
(9, 21),
(10, 15),
(11, 20),
(12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `Codigo_curso` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`Codigo_curso`, `Nombre`) VALUES
(1, '1º ESO A'),
(2, '1º ESO B'),
(3, '1º ESO C'),
(4, '2º ESO A'),
(5, '2º ESO B'),
(6, '2º ESO C');

-- --------------------------------------------------------

--
-- Table structure for table `historial_carnet`
--

CREATE TABLE `historial_carnet` (
  `Num_exp` int(11) NOT NULL,
  `Puntos_ini` tinyint(4) NOT NULL,
  `Inicio_mes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historial_carnet`
--

INSERT INTO `historial_carnet` (`Num_exp`, `Puntos_ini`, `Inicio_mes`) VALUES
(1, 22, '2016-01-01'),
(1, 22, '2016-02-01'),
(1, 22, '2016-03-01'),
(1, 22, '2016-04-01'),
(1, 22, '2016-05-30'),
(1, 22, '2016-06-01'),
(1, 22, '2016-07-01'),
(1, 22, '2016-08-01'),
(1, 22, '2016-09-01'),
(1, 22, '2016-10-01'),
(1, 22, '2016-11-01'),
(1, 22, '2016-12-01'),
(2, 13, '2016-01-01'),
(2, 13, '2016-02-01'),
(2, 13, '2016-03-01'),
(2, 13, '2016-04-01'),
(2, 15, '2016-05-30'),
(2, 15, '2016-06-06'),
(2, 13, '2016-07-01'),
(2, 13, '2016-08-01'),
(2, 13, '2016-09-01'),
(2, 13, '2016-10-01'),
(2, 13, '2016-11-01'),
(2, 13, '2016-12-01'),
(3, 9, '2016-01-01'),
(3, 9, '2016-02-01'),
(3, 9, '2016-03-01'),
(3, 9, '2016-04-01'),
(3, 9, '2016-05-01'),
(3, 11, '2016-06-06'),
(3, 9, '2016-07-01'),
(3, 9, '2016-08-01'),
(3, 9, '2016-09-01'),
(3, 9, '2016-10-01'),
(3, 9, '2016-11-01'),
(3, 9, '2016-12-01'),
(4, 5, '2016-01-01'),
(4, 5, '2016-02-01'),
(4, 5, '2016-03-01'),
(4, 5, '2016-04-01'),
(4, 5, '2016-05-01'),
(4, 5, '2016-06-01'),
(4, 5, '2016-07-01'),
(4, 5, '2016-08-01'),
(4, 5, '2016-09-01'),
(4, 5, '2016-10-01'),
(4, 5, '2016-11-01'),
(4, 5, '2016-12-01'),
(5, 11, '2016-01-01'),
(5, 11, '2016-02-01'),
(5, 11, '2016-03-01'),
(5, 11, '2016-04-01'),
(5, 11, '2016-05-01'),
(5, 11, '2016-06-01'),
(5, 11, '2016-07-01'),
(5, 11, '2016-08-01'),
(5, 11, '2016-09-01'),
(5, 11, '2016-10-01'),
(5, 11, '2016-11-01'),
(5, 11, '2016-12-01'),
(6, 26, '2016-01-01'),
(6, 26, '2016-02-01'),
(6, 26, '2016-03-01'),
(6, 26, '2016-04-01'),
(6, 26, '2016-05-01'),
(6, 26, '2016-06-01'),
(6, 26, '2016-07-01'),
(6, 26, '2016-08-01'),
(6, 26, '2016-09-01'),
(6, 26, '2016-10-01'),
(6, 26, '2016-11-01'),
(6, 26, '2016-12-01'),
(7, 18, '2016-01-01'),
(7, 18, '2016-02-01'),
(7, 18, '2016-03-01'),
(7, 18, '2016-04-01'),
(7, 18, '2016-05-01'),
(7, 18, '2016-06-01'),
(7, 18, '2016-07-01'),
(7, 18, '2016-08-01'),
(7, 18, '2016-09-01'),
(7, 18, '2016-10-01'),
(7, 18, '2016-11-01'),
(7, 18, '2016-12-01'),
(8, 13, '2016-01-01'),
(8, 13, '2016-02-01'),
(8, 13, '2016-03-01'),
(8, 13, '2016-04-01'),
(8, 13, '2016-05-01'),
(8, 13, '2016-06-01'),
(8, 13, '2016-07-01'),
(8, 13, '2016-08-01'),
(8, 13, '2016-09-01'),
(8, 13, '2016-10-01'),
(8, 13, '2016-11-01'),
(8, 13, '2016-12-01'),
(9, 21, '2016-01-01'),
(9, 21, '2016-02-01'),
(9, 21, '2016-03-01'),
(9, 21, '2016-04-01'),
(9, 21, '2016-05-01'),
(9, 21, '2016-06-01'),
(9, 21, '2016-07-01'),
(9, 21, '2016-08-01'),
(9, 21, '2016-09-01'),
(9, 21, '2016-10-01'),
(9, 21, '2016-11-01'),
(9, 21, '2016-12-01'),
(10, 15, '2016-01-01'),
(10, 15, '2016-02-01'),
(10, 15, '2016-03-01'),
(10, 15, '2016-04-01'),
(10, 15, '2016-05-01'),
(10, 15, '2016-06-01'),
(10, 15, '2016-07-01'),
(10, 15, '2016-08-01'),
(10, 15, '2016-09-01'),
(10, 15, '2016-10-01'),
(10, 15, '2016-11-01'),
(10, 15, '2016-12-01'),
(11, 20, '2016-01-01'),
(11, 20, '2016-02-01'),
(11, 20, '2016-03-01'),
(11, 20, '2016-04-01'),
(11, 20, '2016-05-01'),
(11, 20, '2016-06-01'),
(11, 20, '2016-07-01'),
(11, 20, '2016-08-01'),
(11, 20, '2016-09-01'),
(11, 20, '2016-10-01'),
(11, 20, '2016-11-01'),
(11, 20, '2016-12-01'),
(12, 10, '2016-01-01'),
(12, 10, '2016-02-01'),
(12, 10, '2016-03-01'),
(12, 10, '2016-04-01'),
(12, 10, '2016-05-01'),
(12, 10, '2016-06-01'),
(12, 10, '2016-07-01'),
(12, 10, '2016-08-01'),
(12, 10, '2016-09-01'),
(12, 10, '2016-10-01'),
(12, 10, '2016-11-01'),
(12, 10, '2016-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `imparte`
--

CREATE TABLE `imparte` (
  `Id_profesor` int(11) NOT NULL,
  `Codigo_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imparte`
--

INSERT INTO `imparte` (`Id_profesor`, `Codigo_curso`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `perdida_ganancia`
--

CREATE TABLE `perdida_ganancia` (
  `Id_motivo` int(11) NOT NULL,
  `Motivo` varchar(200) NOT NULL,
  `Puntuacion` float NOT NULL,
  `Codigo_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perdida_ganancia`
--

INSERT INTO `perdida_ganancia` (`Id_motivo`, `Motivo`, `Puntuacion`, `Codigo_curso`) VALUES
(1, 'Gritar', -1, 1),
(1, 'Empujar a un compañero/a', -1, 2),
(1, 'Gritar', -1, 3),
(1, 'Tirar cosas a los compañeros', -1, 4),
(1, 'No pedir el turno de palabra', -1, 5),
(1, 'Tirar cosas al suelo', -1, 6),
(2, 'Escuchar música', -1, 1),
(2, 'Interrumpir al profesor/a o a un\ncompañero/a', -1, 2),
(2, 'Ocupas la mesa del compañero', -1, 3),
(2, 'No traer los libros y/o material de clase', -1, 4),
(2, 'No estar sentado cuando empieza la\nclase y con el material encima de la\nmesa', -1, 5),
(2, 'No darle el móvil al profesor cuando te\nlo pide', -1, 6),
(3, 'Interrumpir la clase (al profesor, a un\ncompañero, hacer ruidos molestos,\nmontar “jaleo”, entrar y salir de clase\nsin permiso ...)', -2, 1),
(3, 'No estar dentro de clase cuando llega el\nprofesor/a', -1, 2),
(3, 'Interrumpir la clase (al profesor, a un\r\ncompañero, hacer ruidos molestos,\r\nmontar “jaleo”, entrar y salir de clase\r\nsin permiso ...)', -1, 3),
(3, 'No darle el móvil al profesor cuando te\nlo pide', -1, 4),
(3, 'Ensuciar la clase', -1, 5),
(3, 'Interrumpir la clase', -2, 6),
(4, 'Coger el material de un compañero/a sin\npermiso (mochila, estuche, archivador,\netc)', -2, 1),
(4, 'Reirte de los demás', -2, 2),
(4, 'No traer los libros y/o material de clase', -1, 3),
(4, 'Ensuciar el suelo', -1, 4),
(4, 'Interrumpir la clase', -2, 5),
(4, 'Cantar y/o bailar en clase', -2, 6),
(5, 'Insultar a los compañeros', -4, 1),
(5, 'No respetas las normas de juego en\r\nEducación Física', -2, 2),
(5, 'Coges el material de un compañero/a\r\nsin permiso (mochila, estuche,\r\narchivador, etc)', -2, 3),
(5, 'No pides el turno de palabra', -2, 4),
(5, 'No respetas al profesor/a o a\r\nlos compañeros/as', -4, 5),
(5, 'Gritas', -2, 6),
(6, 'Contestas de manera irrespetuosa al\r\nprofesorado', -4, 1),
(6, 'Realizas insultos de género', -3, 2),
(6, 'Insultas a los compañeros', -2, 3),
(6, 'Insultas a los compañeros', -2, 4),
(6, 'Jugando utilizas la violencia (juegos violentos)', -4, 5),
(6, 'Contestas de manera irrespetuosa al\r\nprofesorado', -4, 6),
(7, 'Mantener limpia la mesa', 0.5, 1),
(7, 'Mantienes limpia la mesa', 1, 2),
(7, 'Contestas de manera irrespetuosa al\r\nprofesorado', -4, 3),
(7, 'Gritas', -2, 4),
(7, 'Mantienes limpia tu mesa', 0.5, 5),
(7, 'Coges el material de un compañero/a sin permiso (mochila, estuche, etc)', -4, 6),
(8, 'Mantener la clase ordenada y limpia', 1, 1),
(8, 'Reciclas', 1, 2),
(8, 'Agredes a un compañero/a', -4, 3),
(8, 'No cuidas los materiales del colegio', -2, 4),
(8, 'Ayudas a un compañero/a con las\r\nasignaturas', 0.5, 5),
(8, 'Agredes a los compañeros', -4, 6),
(9, 'Un familiar viene a tutoría', 1, 1),
(9, 'Ayudas a un compañero/a', 1, 2),
(9, 'Haces manuales o carteles de las\r\nnormas de convivencia', 0.5, 3),
(9, 'Contestas de manera irrespetuosa al\r\nprofesorado', -4, 4),
(9, 'Un familiar viene a tutoría', 1, 5),
(9, 'Un familiar viene a tutoría', 1, 6),
(10, 'Por una semana sin perder ningún punto', 1, 1),
(10, 'En Educación Física juegas en un grupo\r\nmixto', 1, 2),
(10, 'Mantener limpia la mesa', 0.5, 3),
(10, 'Agredes a un compañero/a', -4, 4),
(10, 'Por trabajos extraordinarios o\r\nvoluntarios', 1, 5),
(10, 'Haces manuales o carteles de las\r\nnormas de convivencia', 0.5, 6),
(11, 'Por comportamiento excelente en el\r\naula o en una actividad', 2, 1),
(11, 'Por trabajos extraordinarios en una\r\nactividad o voluntarios', 1, 2),
(11, 'Mantener la clase ordenada', 0.5, 3),
(11, 'Coges el material de un compañero/a\r\nsin permiso (mochila, estuche,\r\narchivador, etc)', -4, 4),
(11, 'Limpias la clase', 1, 5),
(11, 'Por trabajos extraordinarios o\r\nvoluntarios', 1, 6),
(12, 'Por una semana sin gritar', 2, 1),
(12, 'Pedir permiso al profesor', 0.5, 3),
(12, 'Haces manuales o carteles de las\r\nnormas de convivencia', 0.5, 4),
(12, 'Durante una semana estás callado,\r\natendiendo y participando\r\n(comportamiento excelente) en clase de\r\nmúsica, lengua y francés', 3, 5),
(12, 'Por el cumplimiento de la sanción\r\nimpuesta', 1, 6),
(13, 'Asistir a una o más reuniones con el\r\norientador y la tutora, la primera en\r\npresencia de los padres, para dar\r\nexplicaciones y adquirir compromisos\r\nde mejora, siguiendo las indicaciones\r\nque te den.', 4, 1),
(13, 'Ayudar a un compañero', 0.5, 3),
(13, 'Mantener limpia la mesa', 0.5, 4),
(13, 'Por una semana sin perder ningún punto', 1, 6),
(14, 'Un familiar viene a tutoría', 1, 3),
(14, 'Limpiar la clase', 0.5, 4),
(14, 'Por comportamiento excelente en el\r\naula o en una actividad', 2, 6),
(15, 'Por trabajos extraordinarios o\r\nvoluntarios', 1, 3),
(15, 'Un familiar viene a tutoría', 1, 4),
(15, 'Limpiar las ventanas', 1, 6),
(16, 'Por el cumplimiento de la\r\nsanción impuesta', 1, 3),
(16, 'Por trabajos extraordinarios o\r\nvoluntarios', 1, 4),
(16, 'Crear el himno de la clase', 2, 6),
(17, 'Por un mes sin perder ningún punto', 1, 3),
(17, 'Por el cumplimiento de la sanción\r\nimpuesta', 1, 4),
(17, 'Limpiar la clase', 2, 6),
(18, 'Por comportamiento excelente en el\r\naula o en una actividad', 2, 3),
(18, 'Por una semana sin perder ningún punto', 1, 4),
(18, 'Asistir a una o más reuniones con el\r\norientador y la tutora, la primera en\r\npresencia de los padres, para dar\r\nexplicaciones y adquirir compromisos\r\nde mejora, siguiendo las indicaciones\r\nque te den', 4, 6),
(19, 'Asistir a una o más reuniones con el\r\norientador y la tutora, la primera en\r\npresencia de los padres, para dar\r\nexplicaciones y adquirir compromisos\r\nde mejora, siguiendo las indicaciones\r\nque te den', 4, 3),
(19, 'Por comportamiento excelente en el\r\naula o en una actividad', 2, 4),
(20, 'No gritar durante una semana', 2, 4),
(21, 'Asistir a una o más reuniones con el\r\norientador y la tutora, la primera en\r\npresencia de los padres, para dar\r\nexplicaciones y adquirir compromisos\r\nde mejora, siguiendo las indicaciones\r\nque te den', 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `profesor`
--

CREATE TABLE `profesor` (
  `Id_profesor` int(11) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Nombre_profesor` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profesor`
--

INSERT INTO `profesor` (`Id_profesor`, `Password`, `Nombre_profesor`) VALUES
(1, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Andrés'),
(2, '8cb2237d0679ca88db6464eac60da96345513964', 'Fede'),
(3, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Fran');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actualiza`
--
ALTER TABLE `actualiza`
  ADD PRIMARY KEY (`Id_profesor`,`Num_exp`,`Fecha_hora`,`Id_motivo`,`Codigo_curso`),
  ADD KEY `fk_Profesor_has_Carnet_Carnet1_idx` (`Num_exp`),
  ADD KEY `fk_Profesor_has_Carnet_Profesor1_idx` (`Id_profesor`),
  ADD KEY `puntos_idx` (`Codigo_curso`,`Id_motivo`);

--
-- Indexes for table `alumnado`
--
ALTER TABLE `alumnado`
  ADD PRIMARY KEY (`Num_exp`),
  ADD KEY `fk_Alumnado_Carnet_idx` (`Carnet`),
  ADD KEY `fk_C#_Curso_idx` (`Codigo_curso`);

--
-- Indexes for table `carnet`
--
ALTER TABLE `carnet`
  ADD PRIMARY KEY (`Num_exp`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`Codigo_curso`);

--
-- Indexes for table `historial_carnet`
--
ALTER TABLE `historial_carnet`
  ADD PRIMARY KEY (`Num_exp`,`Inicio_mes`);

--
-- Indexes for table `imparte`
--
ALTER TABLE `imparte`
  ADD PRIMARY KEY (`Id_profesor`,`Codigo_curso`),
  ADD KEY `fk_Profesor_has_Curso_Curso1_idx` (`Codigo_curso`),
  ADD KEY `fk_Profesor_has_Curso_Profesor1_idx` (`Id_profesor`);

--
-- Indexes for table `perdida_ganancia`
--
ALTER TABLE `perdida_ganancia`
  ADD PRIMARY KEY (`Id_motivo`,`Codigo_curso`),
  ADD KEY `fk_Convivencia_has_Curso_Curso1_idx` (`Codigo_curso`),
  ADD KEY `fk_Convivencia_has_Curso_Convivencia1_idx` (`Id_motivo`);

--
-- Indexes for table `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`Id_profesor`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actualiza`
--
ALTER TABLE `actualiza`
  ADD CONSTRAINT `fk_Profesor_has_Carnet_Carnet1` FOREIGN KEY (`Num_exp`) REFERENCES `carnet` (`Num_exp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Profesor_has_Carnet_Profesor1` FOREIGN KEY (`Id_profesor`) REFERENCES `profesor` (`Id_profesor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perdida_ganancia` FOREIGN KEY (`Codigo_curso`,`Id_motivo`) REFERENCES `perdida_ganancia` (`Codigo_curso`, `Id_motivo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `alumnado`
--
ALTER TABLE `alumnado`
  ADD CONSTRAINT `fk_Alumnado_Carnet` FOREIGN KEY (`Carnet`) REFERENCES `carnet` (`Num_exp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_C#_Curso` FOREIGN KEY (`Codigo_curso`) REFERENCES `curso` (`Codigo_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `historial_carnet`
--
ALTER TABLE `historial_carnet`
  ADD CONSTRAINT `FK_Num_exp` FOREIGN KEY (`Num_exp`) REFERENCES `carnet` (`Num_exp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `imparte`
--
ALTER TABLE `imparte`
  ADD CONSTRAINT `fk_Profesor_has_Curso_Curso1` FOREIGN KEY (`Codigo_curso`) REFERENCES `curso` (`Codigo_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Profesor_has_Curso_Profesor1` FOREIGN KEY (`Id_profesor`) REFERENCES `profesor` (`Id_profesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `perdida_ganancia`
--
ALTER TABLE `perdida_ganancia`
  ADD CONSTRAINT `fk_Convivencia_has_Curso_Curso1` FOREIGN KEY (`Codigo_curso`) REFERENCES `curso` (`Codigo_curso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`franweb`@`%` EVENT `update_license` ON SCHEDULE EVERY 1 MONTH STARTS '2016-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO call update_license_month()$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
