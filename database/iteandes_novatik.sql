-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-07-2020 a las 18:41:11
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `iteandes_novatik`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `UpdatePerson`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePerson` (IN `uIdPerson` INT, IN `stateTotal` VARCHAR(10))  NO SQL
BEGIN
UPDATE experience e
INNER JOIN teacher t ON e.idExperience=t.Experience_idExperience
SET stateExperience=stateTotal
 WHERE t.Person_idPerson=uIdPerson;
 
UPDATE teacherstudies ts
INNER JOIN teacher t ON ts.idTeacherStudies=t.TeacherStudies_idTeacherStudies
SET stateTeacherStudies=stateTotal
 WHERE t.Person_idPerson=uIdPerson;
 
UPDATE lenguages l
INNER JOIN teacherlenguages tl ON tl.Lenguages_idLenguages=l.idLenguages
INNER JOIN teacher t ON tl.Teacher_idTeacher=t.idTeacher
SET stateLenguague=stateTotal
 WHERE t.Person_idPerson=uIdPerson;

UPDATE teacherlenguages tl
INNER JOIN   lenguages l  ON tl.Lenguages_idLenguages=l.idLenguages
INNER JOIN teacher t ON tl.Teacher_idTeacher=t.idTeacher
SET stateTeacherLenguages=stateTotal
 WHERE t.Person_idPerson=uIdPerson;

UPDATE teacher t
SET stateTeacher=stateTotal
 WHERE t.Person_idPerson=uIdPerson;
 
 UPDATE person p
SET statePerson=stateTotal
 WHERE p.idPerson=uIdPerson;
 
END$$

DROP PROCEDURE IF EXISTS `UpdateStudent`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateStudent` (IN `uIdPerson` INT, IN `stateTotal` VARCHAR(10))  NO SQL
BEGIN
UPDATE student st
INNER JOIN person p ON st.Person_idPerson=p.idPerson
SET stateStudent=stateTotal
WHERE st.Person_idPerson=uIdPerson;
 
 UPDATE person p
SET statePerson=stateTotal
 WHERE p.idPerson=uIdPerson;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `idActivity` bigint(19) UNSIGNED NOT NULL,
  `codeActivity` bigint(20) NOT NULL,
  `nameActivity` varchar(300) NOT NULL,
  `descriptionActivity` varchar(500) NOT NULL,
  `typeActivity` enum('Desempeño','Producto','Conocimiento') NOT NULL,
  `LearningResult_idLearningResult` bigint(19) UNSIGNED NOT NULL,
  `stateActivity` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE `archive` (
  `idArchive` bigint(19) UNSIGNED NOT NULL,
  `nameArchive` varchar(300) NOT NULL,
  `descriptionArchive` varchar(250) NOT NULL,
  `stateArchive` enum('Activo','Inactivo') NOT NULL,
  `rutaArchive` varchar(500) NOT NULL,
  `Activity_idActivity` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE `enrollment` (
  `idEnrollment` bigint(19) UNSIGNED NOT NULL,
  `dateEnrollment` date NOT NULL,
  `stateEnrollment` enum('Activo','Inactivo') NOT NULL,
  `Student_idStudent` bigint(19) UNSIGNED NOT NULL,
  `Semester_idSemester` bigint(19) UNSIGNED NOT NULL,
  `TrainingProgram_idTrainingProgram` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollmentcompetition`
--

DROP TABLE IF EXISTS `enrollmentcompetition`;
CREATE TABLE `enrollmentcompetition` (
  `idEnrollmentCompetition` bigint(19) UNSIGNED NOT NULL,
  `Enrollment_idEnrollment` bigint(19) UNSIGNED NOT NULL,
  `Schedule_idSchedule` bigint(19) UNSIGNED NOT NULL,
  `TrainingCompetition_idTrainingCompetition` bigint(19) UNSIGNED NOT NULL,
  `stateEnrollmentCompetition` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE `experience` (
  `idExperience` bigint(19) UNSIGNED NOT NULL,
  `institutionExperience` varchar(300) NOT NULL,
  `dedicationExperience` varchar(500) NOT NULL,
  `startExperience` date NOT NULL,
  `endExperince` date NOT NULL,
  `stateExperience` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `idGroup` bigint(19) UNSIGNED NOT NULL,
  `codeGroup` bigint(20) NOT NULL,
  `nameGroup` varchar(300) NOT NULL,
  `minimumSpaceGroup` tinyint(4) NOT NULL,
  `maximumSpaceGroup` bigint(20) NOT NULL,
  `stateGroup` enum('Activo','Inactivo') NOT NULL,
  `TrainingCompetition_idTrainingCompetition` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `learningresult`
--

DROP TABLE IF EXISTS `learningresult`;
CREATE TABLE `learningresult` (
  `idLearningResult` bigint(19) UNSIGNED NOT NULL,
  `codeLearningResult` bigint(20) NOT NULL,
  `nameLearningResult` varchar(500) NOT NULL,
  `durationLearningResult` tinyint(4) NOT NULL,
  `statuLearningResult` enum('Activo','Inactivo') NOT NULL,
  `TrainingCompetition_idTrainingCompetition` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lenguages`
--

DROP TABLE IF EXISTS `lenguages`;
CREATE TABLE `lenguages` (
  `idLenguages` bigint(19) UNSIGNED NOT NULL,
  `nameLenguages` varchar(40) NOT NULL,
  `stateLenguague` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `idNote` bigint(19) UNSIGNED NOT NULL,
  `dateNote` date NOT NULL,
  `valueNote` float NOT NULL,
  `Activity_idActivity` bigint(19) UNSIGNED NOT NULL,
  `Teacher_idTeacher` bigint(19) UNSIGNED NOT NULL,
  `stateNote` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `idPerson` bigint(19) UNSIGNED NOT NULL,
  `documentPerson` int(11) NOT NULL,
  `namePerson` varchar(150) NOT NULL,
  `lastNamePerson` varchar(150) NOT NULL,
  `dateBornPerson` date NOT NULL,
  `rhPerson` enum('A+','A-','B-','B+','O+','O-','AB-','AB+') NOT NULL,
  `emailPerson` varchar(90) NOT NULL,
  `phonePerson` bigint(20) NOT NULL,
  `adressPerson` varchar(260) NOT NULL,
  `generePerson` enum('Femenino','Masculino','Otro') NOT NULL,
  `userPerson` varchar(45) NOT NULL,
  `passwordPerson` varchar(45) NOT NULL,
  `typePerson` enum('Administrador','Secretaria','Docente','Estudiante') NOT NULL,
  `statePerson` enum('Activo','Inactivo') NOT NULL,
  `photoPerson` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `idSchedule` bigint(19) UNSIGNED NOT NULL,
  `startDateSchedule` date NOT NULL,
  `endDateSchedule` date NOT NULL,
  `cantHours` tinyint(4) NOT NULL,
  `daySchedule` varchar(40) NOT NULL,
  `startHourSchedule` time NOT NULL,
  `endHourSchedule` time NOT NULL,
  `stateSchedule` enum('Activo','Inactivo') NOT NULL,
  `Group_idGroup` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE `semester` (
  `idSemester` bigint(19) UNSIGNED NOT NULL,
  `nameSemester` varchar(250) NOT NULL,
  `descriptionSemester` varchar(500) DEFAULT NULL,
  `starDateSemester` date NOT NULL,
  `endDateSemester` date NOT NULL,
  `startDate50` date NOT NULL,
  `endDate50` date NOT NULL,
  `starDate2Semester` date NOT NULL,
  `endDate2Semester` date NOT NULL,
  `statuSemester` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `idStudent` bigint(19) UNSIGNED NOT NULL,
  `gradeYear` smallint(4) NOT NULL,
  `modality` enum('Bachiller Academico','Bachiller Tecnico') NOT NULL,
  `Institution` varchar(300) NOT NULL,
  `Person_idPerson` bigint(19) UNSIGNED NOT NULL,
  `stateStudent` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
  `idTeacher` bigint(19) UNSIGNED NOT NULL,
  `Experience_idExperience` bigint(19) UNSIGNED NOT NULL,
  `TeacherStudies_idTeacherStudies` bigint(19) UNSIGNED NOT NULL,
  `Person_idPerson` bigint(19) UNSIGNED NOT NULL,
  `stateTeacher` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacherlenguages`
--

DROP TABLE IF EXISTS `teacherlenguages`;
CREATE TABLE `teacherlenguages` (
  `idTeacherLenguages` bigint(19) UNSIGNED NOT NULL,
  `Teacher_idTeacher` bigint(19) UNSIGNED NOT NULL,
  `Lenguages_idLenguages` bigint(19) UNSIGNED NOT NULL,
  `stateTeacherLenguages` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacherstudies`
--

DROP TABLE IF EXISTS `teacherstudies`;
CREATE TABLE `teacherstudies` (
  `idTeacherStudies` bigint(19) UNSIGNED NOT NULL,
  `titleTeacherStudies` varchar(300) NOT NULL,
  `yearStudyTeacher` smallint(4) NOT NULL,
  `stateTeacherStudies` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trainingcompetition`
--

DROP TABLE IF EXISTS `trainingcompetition`;
CREATE TABLE `trainingcompetition` (
  `idTrainingCompetition` bigint(19) UNSIGNED NOT NULL,
  `codeTrainingCompetition` bigint(20) NOT NULL,
  `codeAlfaTrainingCompetition` varchar(10) NOT NULL,
  `denomination` varchar(300) NOT NULL,
  `duration` tinyint(4) NOT NULL,
  `minimumSpace` tinyint(4) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `statusTrainingCompetition` enum('Activo','Inactivo') NOT NULL,
  `TrainingProgram_idTrainingProgram` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trainingprogram`
--

DROP TABLE IF EXISTS `trainingprogram`;
DROP TABLE IF EXISTS `trainingprogram`;
CREATE TABLE `trainingprogram` (
  `idTrainingProgram` bigint(19) UNSIGNED NOT NULL,
  `codeTrainingProgram` bigint(19) UNSIGNED NOT NULL,
  `codeAlfaTrainingProgram` varchar(10) NOT NULL,
  `nameTrainingProgram` varchar(500) NOT NULL,
  `version` float NOT NULL,
  `statusTrainingProgram` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
