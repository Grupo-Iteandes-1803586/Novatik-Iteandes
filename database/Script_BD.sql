-- MySQL Workbench Synchronization
-- Generated: 2020-06-26 11:43
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Kakuja

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `iteandes_novatik` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Person` (
  `idPerson` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `documentPerson` INT(11) NOT NULL,
  `namePerson` VARCHAR(55) NOT NULL,
  `dateBornPerson` DATE NOT NULL,
  `rhPerson` VARCHAR(3) NOT NULL,
  `emailPerson` VARCHAR(70) NOT NULL,
  `phonePerson` INT(11) NOT NULL,
  `adressPerson` VARCHAR(60) NOT NULL,
  `generePerson` ENUM('Femenino', 'Masculino', 'Otro') NOT NULL,
  `userPerson` VARCHAR(45) NOT NULL,
  `passwordPerson` VARCHAR(45) NOT NULL,
  `typePerson` ENUM('Administrador', 'Secreataria', 'Docente', 'Estudiante') NOT NULL,
  `statePerson` ENUM('Activo', 'Inactivo') NOT NULL,
  `photoPerson` VARCHAR(350) NULL DEFAULT NULL,
  PRIMARY KEY (`idPerson`),
  UNIQUE INDEX `documentPerson_UNIQUE` (`documentPerson` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Teacher` (
  `idTeacher` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Experience_idExperience` BIGINT(19) UNSIGNED NOT NULL,
  `TeacherStudies_idTeacherStudies` BIGINT(19) UNSIGNED NOT NULL,
  `Person_idPerson` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idTeacher`),
  INDEX `fk_Teacher_Experience_idx` (`Experience_idExperience` ASC),
  INDEX `fk_Teacher_TeacherStudies1_idx` (`TeacherStudies_idTeacherStudies` ASC),
  INDEX `fk_Teacher_Person1_idx` (`Person_idPerson` ASC),
  CONSTRAINT `fk_Teacher_Experience`
    FOREIGN KEY (`Experience_idExperience`)
    REFERENCES `iteandes_novatik`.`Experience` (`idExperience`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Teacher_TeacherStudies1`
    FOREIGN KEY (`TeacherStudies_idTeacherStudies`)
    REFERENCES `iteandes_novatik`.`TeacherStudies` (`idTeacherStudies`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Teacher_Person1`
    FOREIGN KEY (`Person_idPerson`)
    REFERENCES `iteandes_novatik`.`Person` (`idPerson`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`TeacherLenguages` (
  `idTeacherLenguages` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Teacher_idTeacher` BIGINT(19) UNSIGNED NOT NULL,
  `Lenguages_idLenguages` TINYINT(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`idTeacherLenguages`),
  INDEX `fk_TeacherLenguages_Teacher1_idx` (`Teacher_idTeacher` ASC),
  INDEX `fk_TeacherLenguages_Lenguages1_idx` (`Lenguages_idLenguages` ASC),
  CONSTRAINT `fk_TeacherLenguages_Teacher1`
    FOREIGN KEY (`Teacher_idTeacher`)
    REFERENCES `iteandes_novatik`.`Teacher` (`idTeacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TeacherLenguages_Lenguages1`
    FOREIGN KEY (`Lenguages_idLenguages`)
    REFERENCES `iteandes_novatik`.`Lenguages` (`idLenguages`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Experience` (
  `idExperience` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `institutionExperience` VARCHAR(100) NOT NULL,
  `dedicationExperience` VARCHAR(50) NOT NULL,
  `startExperience` DATE NOT NULL,
  `endExperince` DATE NOT NULL,
  PRIMARY KEY (`idExperience`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Lenguages` (
  `idLenguages` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nameLenguages` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`idLenguages`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`TeacherStudies` (
  `idTeacherStudies` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titleTeacherStudies` VARCHAR(100) NOT NULL,
  `yearStudyTeacher` SMALLINT(4) NOT NULL,
  PRIMARY KEY (`idTeacherStudies`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Student` (
  `idStudent` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gradeYear` SMALLINT(4) NOT NULL,
  `modality` ENUM('Bachiler', 'Tecnico') NOT NULL,
  `Institution` VARCHAR(100) NOT NULL,
  `Person_idPerson` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idStudent`),
  INDEX `fk_Student_Person1_idx` (`Person_idPerson` ASC),
  CONSTRAINT `fk_Student_Person1`
    FOREIGN KEY (`Person_idPerson`)
    REFERENCES `iteandes_novatik`.`Person` (`idPerson`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`TrainingProgram` (
  `idTrainingProgram` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeTrainingProgram` BIGINT(19) UNSIGNED NOT NULL,
  `nameTrainingProgram` VARCHAR(100) NOT NULL,
  `version` FLOAT(11) NOT NULL,
  `statusTrainingProgram` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idTrainingProgram`),
  UNIQUE INDEX `codeTrainingProgram_UNIQUE` (`codeTrainingProgram` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Activity` (
  `idActivity` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeActivity` BIGINT(20) NOT NULL,
  `nameActivity` VARCHAR(100) NOT NULL,
  `descriptionActivity` VARCHAR(500) NOT NULL,
  `typeActivity` ENUM('Desempeño', 'Producto', 'Conocimiento') NOT NULL,
  `LearningResult_idLearningResult` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idActivity`),
  UNIQUE INDEX `codeActivity_UNIQUE` (`codeActivity` ASC),
  INDEX `fk_Activity_LearningResult1_idx` (`LearningResult_idLearningResult` ASC),
  CONSTRAINT `fk_Activity_LearningResult1`
    FOREIGN KEY (`LearningResult_idLearningResult`)
    REFERENCES `iteandes_novatik`.`LearningResult` (`idLearningResult`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`TrainingCompetition` (
  `idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeTrainingCompetition` BIGINT(20) NOT NULL,
  `denomination` VARCHAR(150) NOT NULL,
  `duration` TINYINT(4) NOT NULL,
  `minimumSpace` TINYINT(4) NOT NULL,
  `order` TINYINT(4) NOT NULL,
  `statusTrainingCompetition` ENUM('Activo', 'Inactivo') NOT NULL,
  `TrainingProgram_idTrainingProgram` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idTrainingCompetition`),
  UNIQUE INDEX `codeTrainingCompetition_UNIQUE` (`codeTrainingCompetition` ASC),
  INDEX `fk_TrainingCompetition_TrainingProgram1_idx` (`TrainingProgram_idTrainingProgram` ASC),
  CONSTRAINT `fk_TrainingCompetition_TrainingProgram1`
    FOREIGN KEY (`TrainingProgram_idTrainingProgram`)
    REFERENCES `iteandes_novatik`.`TrainingProgram` (`idTrainingProgram`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`LearningResult` (
  `idLearningResult` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeLearningResult` BIGINT(20) NOT NULL,
  `nameLearningResult` VARCHAR(500) NOT NULL,
  `durationLearningResult` TINYINT(4) NOT NULL,
  `statuLearningResult` ENUM('Activo', 'Inactivo') NOT NULL,
  `TrainingCompetition_idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idLearningResult`),
  UNIQUE INDEX `codeLearningResult_UNIQUE` (`codeLearningResult` ASC),
  INDEX `fk_LearningResult_TrainingCompetition1_idx` (`TrainingCompetition_idTrainingCompetition` ASC),
  CONSTRAINT `fk_LearningResult_TrainingCompetition1`
    FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`)
    REFERENCES `iteandes_novatik`.`TrainingCompetition` (`idTrainingCompetition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Note` (
  `idNote` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateNote` DATE NOT NULL,
  `valueNote` FLOAT(11) NOT NULL,
  `Activity_idActivity` BIGINT(19) UNSIGNED NOT NULL,
  `Teacher_idTeacher` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idNote`),
  INDEX `fk_Note_Activity1_idx` (`Activity_idActivity` ASC),
  INDEX `fk_Note_Teacher1_idx` (`Teacher_idTeacher` ASC),
  CONSTRAINT `fk_Note_Activity1`
    FOREIGN KEY (`Activity_idActivity`)
    REFERENCES `iteandes_novatik`.`Activity` (`idActivity`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Note_Teacher1`
    FOREIGN KEY (`Teacher_idTeacher`)
    REFERENCES `iteandes_novatik`.`Teacher` (`idTeacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Enrollment` (
  `idEnrollment` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateEnrollment` DATE NOT NULL,
  `stateEnrollment` ENUM('Activo', 'Inactivo') NOT NULL,
  `Student_idStudent` BIGINT(19) UNSIGNED NOT NULL,
  `Semester_idSemester` BIGINT(19) UNSIGNED NOT NULL,
  `TrainingProgram_idTrainingProgram` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idEnrollment`),
  INDEX `fk_Enrollment_Student1_idx` (`Student_idStudent` ASC),
  INDEX `fk_Enrollment_Semester1_idx` (`Semester_idSemester` ASC),
  INDEX `fk_Enrollment_TrainingProgram1_idx` (`TrainingProgram_idTrainingProgram` ASC),
  CONSTRAINT `fk_Enrollment_Student1`
    FOREIGN KEY (`Student_idStudent`)
    REFERENCES `iteandes_novatik`.`Student` (`idStudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Enrollment_Semester1`
    FOREIGN KEY (`Semester_idSemester`)
    REFERENCES `iteandes_novatik`.`Semester` (`idSemester`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Enrollment_TrainingProgram1`
    FOREIGN KEY (`TrainingProgram_idTrainingProgram`)
    REFERENCES `iteandes_novatik`.`TrainingProgram` (`idTrainingProgram`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Semester` (
  `idSemester` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nameSemester` VARCHAR(50) NOT NULL,
  `startDate` DATE NOT NULL,
  `endDate` DATE NOT NULL,
  `statuSemester` ENUM('Activo', 'Inactivo') NOT NULL,
  PRIMARY KEY (`idSemester`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Schedule` (
  `idSchedule` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `startDateSchedule` DATE NOT NULL,
  `endDateSchedule` DATE NOT NULL,
  `cantHours` TINYINT(4) NOT NULL,
  `startHourSchedule` TIME NOT NULL,
  `endHourSchedule` TIME NOT NULL,
  `Schedulecol` VARCHAR(45) NOT NULL,
  `stateSchedule` ENUM('Activo', 'Inactivo') NOT NULL,
  `Group_idGroup` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idSchedule`),
  INDEX `fk_Schedule_Group1_idx` (`Group_idGroup` ASC),
  CONSTRAINT `fk_Schedule_Group1`
    FOREIGN KEY (`Group_idGroup`)
    REFERENCES `iteandes_novatik`.`Group` (`idGroup`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Group` (
  `idGroup` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codeGroup` BIGINT(20) NOT NULL,
  `nameGroup` VARCHAR(100) NOT NULL,
  `minimumSpaceGroup` TINYINT(4) NOT NULL,
  `maximumSpaceGroup` BIGINT(20) NOT NULL,
  `stateGroup` ENUM('Activo', 'Inactivo') NOT NULL,
  `TrainingCompetition_idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idGroup`),
  UNIQUE INDEX `codeGroup_UNIQUE` (`codeGroup` ASC),
  INDEX `fk_Group_TrainingCompetition1_idx` (`TrainingCompetition_idTrainingCompetition` ASC),
  CONSTRAINT `fk_Group_TrainingCompetition1`
    FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`)
    REFERENCES `iteandes_novatik`.`TrainingCompetition` (`idTrainingCompetition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`EnrollmentCompetition` (
  `idEnrollmentCompetition` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Enrollment_idEnrollment` BIGINT(19) UNSIGNED NOT NULL,
  `Schedule_idSchedule` BIGINT(19) UNSIGNED NOT NULL,
  `TrainingCompetition_idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idEnrollmentCompetition`),
  INDEX `fk_EnrollmentCompetition_Enrollment1_idx` (`Enrollment_idEnrollment` ASC),
  INDEX `fk_EnrollmentCompetition_Schedule1_idx` (`Schedule_idSchedule` ASC),
  INDEX `fk_EnrollmentCompetition_TrainingCompetition1_idx` (`TrainingCompetition_idTrainingCompetition` ASC),
  CONSTRAINT `fk_EnrollmentCompetition_Enrollment1`
    FOREIGN KEY (`Enrollment_idEnrollment`)
    REFERENCES `iteandes_novatik`.`Enrollment` (`idEnrollment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EnrollmentCompetition_Schedule1`
    FOREIGN KEY (`Schedule_idSchedule`)
    REFERENCES `iteandes_novatik`.`Schedule` (`idSchedule`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EnrollmentCompetition_TrainingCompetition1`
    FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`)
    REFERENCES `iteandes_novatik`.`TrainingCompetition` (`idTrainingCompetition`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `iteandes_novatik`.`Archive` (
  `idArchive` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nameArchive` VARCHAR(100) NOT NULL,
  `descriptionArchive` VARCHAR(250) NOT NULL,
  `stateArchive` ENUM('Activo', 'Inactivo') NOT NULL,
  `rutaArchive` VARCHAR(250) NOT NULL,
  `Activity_idActivity` BIGINT(19) UNSIGNED NOT NULL,
  PRIMARY KEY (`idArchive`),
  INDEX `fk_Archive_Activity1_idx` (`Activity_idActivity` ASC),
  CONSTRAINT `fk_Archive_Activity1`
    FOREIGN KEY (`Activity_idActivity`)
    REFERENCES `iteandes_novatik`.`Activity` (`idActivity`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
