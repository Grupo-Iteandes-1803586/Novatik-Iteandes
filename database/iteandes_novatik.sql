-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-08-2020 a las 15:56:41
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

CREATE TABLE `lenguages` (
  `idLenguages` bigint(19) UNSIGNED NOT NULL,
  `nameLenguages` varchar(40) NOT NULL,
  `stateLenguague` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `note`
--

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
-------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

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

CREATE TABLE `trainingcompetition` (
  `idTrainingCompetition` bigint(19) UNSIGNED NOT NULL,
  `codeTrainingCompetition` bigint(20) NOT NULL,
  `codeAlfaTrainingCompetition` varchar(10) NOT NULL,
  `denomination` varchar(300) NOT NULL,
  `duration` tinyint(4) NOT NULL,
  `minimumSpace` tinyint(4) NOT NULL,
  `orderTrainingCompetition` tinyint(4) NOT NULL,
  `statusTrainingCompetition` enum('Activo','Inactivo') NOT NULL,
  `TrainingProgram_idTrainingProgram` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trainingprogram`
--

CREATE TABLE `trainingprogram` (
  `idTrainingProgram` bigint(19) UNSIGNED NOT NULL,
  `codeTrainingProgram` bigint(19) UNSIGNED NOT NULL,
  `codeAlfaTrainingProgram` varchar(10) NOT NULL,
  `nameTrainingProgram` varchar(500) NOT NULL,
  `version` float NOT NULL,
  `statusTrainingProgram` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`idActivity`),
  ADD UNIQUE KEY `codeActivity_UNIQUE` (`codeActivity`),
  ADD KEY `fk_Activity_LearningResult1_idx` (`LearningResult_idLearningResult`);

--
-- Indices de la tabla `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`idArchive`),
  ADD KEY `fk_Archive_Activity1_idx` (`Activity_idActivity`);

--
-- Indices de la tabla `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`idEnrollment`),
  ADD KEY `fk_Enrollment_Student1_idx` (`Student_idStudent`),
  ADD KEY `fk_Enrollment_Semester1_idx` (`Semester_idSemester`),
  ADD KEY `fk_Enrollment_TrainingProgram1_idx` (`TrainingProgram_idTrainingProgram`);

--
-- Indices de la tabla `enrollmentcompetition`
--
ALTER TABLE `enrollmentcompetition`
  ADD PRIMARY KEY (`idEnrollmentCompetition`),
  ADD KEY `fk_EnrollmentCompetition_Enrollment1_idx` (`Enrollment_idEnrollment`),
  ADD KEY `fk_EnrollmentCompetition_Schedule1_idx` (`Schedule_idSchedule`),
  ADD KEY `fk_EnrollmentCompetition_TrainingCompetition1_idx` (`TrainingCompetition_idTrainingCompetition`);

--
-- Indices de la tabla `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`idExperience`);

--
-- Indices de la tabla `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`idGroup`),
  ADD UNIQUE KEY `codeGroup_UNIQUE` (`codeGroup`),
  ADD KEY `fk_Group_TrainingCompetition1_idx` (`TrainingCompetition_idTrainingCompetition`);

--
-- Indices de la tabla `learningresult`
--
ALTER TABLE `learningresult`
  ADD PRIMARY KEY (`idLearningResult`),
  ADD UNIQUE KEY `codeLearningResult_UNIQUE` (`codeLearningResult`),
  ADD KEY `fk_LearningResult_TrainingCompetition1_idx` (`TrainingCompetition_idTrainingCompetition`);

--
-- Indices de la tabla `lenguages`
--
ALTER TABLE `lenguages`
  ADD PRIMARY KEY (`idLenguages`);

--
-- Indices de la tabla `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`idNote`),
  ADD KEY `fk_Note_Activity1_idx` (`Activity_idActivity`),
  ADD KEY `fk_Note_Teacher1_idx` (`Teacher_idTeacher`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`idPerson`),
  ADD UNIQUE KEY `documentPerson_UNIQUE` (`documentPerson`);

--
-- Indices de la tabla `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`idSchedule`),
  ADD KEY `fk_Schedule_Group1_idx` (`Group_idGroup`);

--
-- Indices de la tabla `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`idSemester`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`idStudent`),
  ADD KEY `fk_Student_Person1_idx` (`Person_idPerson`);

--
-- Indices de la tabla `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`idTeacher`),
  ADD KEY `fk_Teacher_Experience_idx` (`Experience_idExperience`),
  ADD KEY `fk_Teacher_TeacherStudies1_idx` (`TeacherStudies_idTeacherStudies`),
  ADD KEY `fk_Teacher_Person1_idx` (`Person_idPerson`);

--
-- Indices de la tabla `teacherlenguages`
--
ALTER TABLE `teacherlenguages`
  ADD PRIMARY KEY (`idTeacherLenguages`),
  ADD KEY `fk_TeacherLenguages_Teacher1_idx` (`Teacher_idTeacher`),
  ADD KEY `fk_TeacherLenguages_Lenguages1_idx` (`Lenguages_idLenguages`);

--
-- Indices de la tabla `teacherstudies`
--
ALTER TABLE `teacherstudies`
  ADD PRIMARY KEY (`idTeacherStudies`);

--
-- Indices de la tabla `trainingcompetition`
--
ALTER TABLE `trainingcompetition`
  ADD PRIMARY KEY (`idTrainingCompetition`),
  ADD UNIQUE KEY `codeTrainingCompetition_UNIQUE` (`codeTrainingCompetition`),
  ADD KEY `fk_TrainingCompetition_TrainingProgram1_idx` (`TrainingProgram_idTrainingProgram`);

--
-- Indices de la tabla `trainingprogram`
--
ALTER TABLE `trainingprogram`
  ADD PRIMARY KEY (`idTrainingProgram`),
  ADD UNIQUE KEY `codeTrainingProgram_UNIQUE` (`codeTrainingProgram`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activity`
--
ALTER TABLE `activity`
  MODIFY `idActivity` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archive`
--
ALTER TABLE `archive`
  MODIFY `idArchive` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `idEnrollment` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `enrollmentcompetition`
--
ALTER TABLE `enrollmentcompetition`
  MODIFY `idEnrollmentCompetition` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experience`
--
ALTER TABLE `experience`
  MODIFY `idExperience` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `group`
--
ALTER TABLE `group`
  MODIFY `idGroup` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `learningresult`
--
ALTER TABLE `learningresult`
  MODIFY `idLearningResult` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lenguages`
--
ALTER TABLE `lenguages`
  MODIFY `idLenguages` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `note`
--
ALTER TABLE `note`
  MODIFY `idNote` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `idPerson` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `schedule`
--
ALTER TABLE `schedule`
  MODIFY `idSchedule` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `semester`
--
ALTER TABLE `semester`
  MODIFY `idSemester` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `idStudent` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `teacher`
--
ALTER TABLE `teacher`
  MODIFY `idTeacher` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `teacherlenguages`
--
ALTER TABLE `teacherlenguages`
  MODIFY `idTeacherLenguages` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `teacherstudies`
--
ALTER TABLE `teacherstudies`
  MODIFY `idTeacherStudies` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `trainingcompetition`
--
ALTER TABLE `trainingcompetition`
  MODIFY `idTrainingCompetition` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `trainingprogram`
--
ALTER TABLE `trainingprogram`
  MODIFY `idTrainingProgram` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `fk_Activity_LearningResult1` FOREIGN KEY (`LearningResult_idLearningResult`) REFERENCES `learningresult` (`idLearningResult`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `fk_Archive_Activity1` FOREIGN KEY (`Activity_idActivity`) REFERENCES `activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `fk_Enrollment_Semester1` FOREIGN KEY (`Semester_idSemester`) REFERENCES `semester` (`idSemester`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Enrollment_Student1` FOREIGN KEY (`Student_idStudent`) REFERENCES `student` (`idStudent`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Enrollment_TrainingProgram1` FOREIGN KEY (`TrainingProgram_idTrainingProgram`) REFERENCES `trainingprogram` (`idTrainingProgram`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `enrollmentcompetition`
--
ALTER TABLE `enrollmentcompetition`
  ADD CONSTRAINT `fk_EnrollmentCompetition_Enrollment1` FOREIGN KEY (`Enrollment_idEnrollment`) REFERENCES `enrollment` (`idEnrollment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EnrollmentCompetition_Schedule1` FOREIGN KEY (`Schedule_idSchedule`) REFERENCES `schedule` (`idSchedule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EnrollmentCompetition_TrainingCompetition1` FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`) REFERENCES `trainingcompetition` (`idTrainingCompetition`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `fk_Group_TrainingCompetition1` FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`) REFERENCES `trainingcompetition` (`idTrainingCompetition`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `learningresult`
--
ALTER TABLE `learningresult`
  ADD CONSTRAINT `fk_LearningResult_TrainingCompetition1` FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`) REFERENCES `trainingcompetition` (`idTrainingCompetition`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_Note_Activity1` FOREIGN KEY (`Activity_idActivity`) REFERENCES `activity` (`idActivity`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Note_Teacher1` FOREIGN KEY (`Teacher_idTeacher`) REFERENCES `teacher` (`idTeacher`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_Schedule_Group1` FOREIGN KEY (`Group_idGroup`) REFERENCES `group` (`idGroup`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_Student_Person1` FOREIGN KEY (`Person_idPerson`) REFERENCES `person` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `fk_Teacher_Experience` FOREIGN KEY (`Experience_idExperience`) REFERENCES `experience` (`idExperience`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Teacher_Person1` FOREIGN KEY (`Person_idPerson`) REFERENCES `person` (`idPerson`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Teacher_TeacherStudies1` FOREIGN KEY (`TeacherStudies_idTeacherStudies`) REFERENCES `teacherstudies` (`idTeacherStudies`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `teacherlenguages`
--
ALTER TABLE `teacherlenguages`
  ADD CONSTRAINT `fk_TeacherLenguages_Lenguages1` FOREIGN KEY (`Lenguages_idLenguages`) REFERENCES `lenguages` (`idLenguages`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TeacherLenguages_Teacher1` FOREIGN KEY (`Teacher_idTeacher`) REFERENCES `teacher` (`idTeacher`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trainingcompetition`
--
ALTER TABLE `trainingcompetition`
  ADD CONSTRAINT `fk_TrainingCompetition_TrainingProgram1` FOREIGN KEY (`TrainingProgram_idTrainingProgram`) REFERENCES `trainingprogram` (`idTrainingProgram`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
