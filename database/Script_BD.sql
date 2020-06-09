-- MySQL Workbench Synchronization
-- Generated: 2020-06-09 13:00
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Kakuja

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `iteandes_novati'k`.`Teacher` 
DROP FOREIGN KEY `fk_Teacher_Experience`,
DROP FOREIGN KEY `fk_Teacher_Person1`;

ALTER TABLE `iteandes_novati'k`.`TeacherLenguages` 
DROP FOREIGN KEY `fk_TeacherLenguages_Lenguages1`;

ALTER TABLE `iteandes_novati'k`.`Student` 
DROP FOREIGN KEY `fk_Student_Person1`;

ALTER TABLE `iteandes_novati'k`.`Activity` 
DROP FOREIGN KEY `fk_Activity_LearningResult1`;

ALTER TABLE `iteandes_novati'k`.`TrainingCompetition` 
DROP FOREIGN KEY `fk_TrainingCompetition_TrainingProgram1`;

ALTER TABLE `iteandes_novati'k`.`LearningResult` 
DROP FOREIGN KEY `fk_LearningResult_TrainingCompetition1`;

ALTER TABLE `iteandes_novati'k`.`Note` 
DROP FOREIGN KEY `fk_Note_Activity1`,
DROP FOREIGN KEY `fk_Note_Teacher1`;

ALTER TABLE `iteandes_novati'k`.`Enrollment` 
DROP FOREIGN KEY `fk_Enrollment_Semester1`,
DROP FOREIGN KEY `fk_Enrollment_TrainingProgram1`;

ALTER TABLE `iteandes_novati'k`.`Schedule` 
DROP FOREIGN KEY `fk_Schedule_Group1`;

ALTER TABLE `iteandes_novati'k`.`Group` 
DROP FOREIGN KEY `fk_Group_TrainingCompetition1`;

ALTER TABLE `iteandes_novati'k`.`EnrollmentCompetition` 
DROP FOREIGN KEY `fk_EnrollmentCompetition_Enrollment1`,
DROP FOREIGN KEY `fk_EnrollmentCompetition_Schedule1`,
DROP FOREIGN KEY `fk_EnrollmentCompetition_TrainingCompetition1`;

ALTER TABLE `iteandes_novati'k`.`Person` 
CHANGE COLUMN `idPerson` `idPerson` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `iteandes_novati'k`.`Teacher` 
CHANGE COLUMN `idTeacher` `idTeacher` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Experience_idExperience` `Experience_idExperience` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `TeacherStudies_idTeacherStudies` `TeacherStudies_idTeacherStudies` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `Person_idPerson` `Person_idPerson` BIGINT(19) UNSIGNED NOT NULL ,
ADD INDEX `fk_Teacher_TeacherStudies1_idx` (`TeacherStudies_idTeacherStudies` ASC),
ADD INDEX `fk_Teacher_Person1_idx` (`Person_idPerson` ASC) VISIBLE,
DROP INDEX `fk_Teacher_Person_idx` ,
DROP INDEX `fk_Teacher_TeacherStudies_idx` ;
;

ALTER TABLE `iteandes_novati'k`.`TeacherLenguages` 
CHANGE COLUMN `idTeacherLenguages` `idTeacherLenguages` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Teacher_idTeacher` `Teacher_idTeacher` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `Lenguages_idLenguages` `Lenguages_idLenguages` TINYINT(3) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`Experience` 
CHANGE COLUMN `idExperience` `idExperience` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `iteandes_novati'k`.`Lenguages` 
CHANGE COLUMN `idLenguages` `idLenguages` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `iteandes_novati'k`.`TeacherStudies` 
CHANGE COLUMN `idTeacherStudies` `idTeacherStudies` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `iteandes_novati'k`.`Student` 
CHANGE COLUMN `idStudent` `idStudent` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Person_idPerson` `Person_idPerson` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`TrainingProgram` 
ADD COLUMN `codeTrainingProgram` BIGINT(19) UNSIGNED NOT NULL AFTER `idTrainingProgram`,
CHANGE COLUMN `idTrainingProgram` `idTrainingProgram` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD UNIQUE INDEX `codeTrainingProgram_UNIQUE` (`codeTrainingProgram` ASC);
;

ALTER TABLE `iteandes_novati'k`.`Activity` 
CHANGE COLUMN `idActivity` `idActivity` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `LearningResult_idLearningResult` `LearningResult_idLearningResult` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`TrainingCompetition` 
CHANGE COLUMN `idTrainingCompetition` `idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `TrainingProgram_idTrainingProgram` `TrainingProgram_idTrainingProgram` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`LearningResult` 
CHANGE COLUMN `idLearningResult` `idLearningResult` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `TrainingCompetition_idTrainingCompetition` `TrainingCompetition_idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`Note` 
CHANGE COLUMN `idNote` `idNote` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Activity_idActivity` `Activity_idActivity` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `Teacher_idTeacher` `Teacher_idTeacher` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`Enrollment` 
CHANGE COLUMN `idEnrollment` `idEnrollment` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Student_idStudent` `Student_idStudent` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `Semester_idSemester` `Semester_idSemester` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `TrainingProgram_idTrainingProgram` `TrainingProgram_idTrainingProgram` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`Semester` 
CHANGE COLUMN `idSemester` `idSemester` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `iteandes_novati'k`.`Schedule` 
CHANGE COLUMN `idSchedule` `idSchedule` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Group_idGroup` `Group_idGroup` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`Group` 
CHANGE COLUMN `idGroup` `idGroup` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `TrainingCompetition_idTrainingCompetition` `TrainingCompetition_idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`EnrollmentCompetition` 
CHANGE COLUMN `idEnrollmentCompetition` `idEnrollmentCompetition` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `Enrollment_idEnrollment` `Enrollment_idEnrollment` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `Schedule_idSchedule` `Schedule_idSchedule` BIGINT(19) UNSIGNED NOT NULL ,
CHANGE COLUMN `TrainingCompetition_idTrainingCompetition` `TrainingCompetition_idTrainingCompetition` BIGINT(19) UNSIGNED NOT NULL ;

ALTER TABLE `iteandes_novati'k`.`Teacher` 
DROP FOREIGN KEY `fk_Teacher_TeacherStudies1`;

ALTER TABLE `iteandes_novati'k`.`Teacher` ADD CONSTRAINT `fk_Teacher_Experience`
  FOREIGN KEY (`Experience_idExperience`)
  REFERENCES `iteandes_novati'k`.`Experience` (`idExperience`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Teacher_TeacherStudies1`
  FOREIGN KEY (`TeacherStudies_idTeacherStudies`)
  REFERENCES `iteandes_novati'k`.`TeacherStudies` (`idTeacherStudies`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Teacher_Person1`
  FOREIGN KEY (`Person_idPerson`)
  REFERENCES `iteandes_novati'k`.`Person` (`idPerson`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`TeacherLenguages` 
DROP FOREIGN KEY `fk_TeacherLenguages_Teacher1`;

ALTER TABLE `iteandes_novati'k`.`TeacherLenguages` ADD CONSTRAINT `fk_TeacherLenguages_Teacher1`
  FOREIGN KEY (`Teacher_idTeacher`)
  REFERENCES `iteandes_novati'k`.`Teacher` (`idTeacher`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_TeacherLenguages_Lenguages1`
  FOREIGN KEY (`Lenguages_idLenguages`)
  REFERENCES `iteandes_novati'k`.`Lenguages` (`idLenguages`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`Student` 
ADD CONSTRAINT `fk_Student_Person1`
  FOREIGN KEY (`Person_idPerson`)
  REFERENCES `iteandes_novati'k`.`Person` (`idPerson`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`Activity` 
ADD CONSTRAINT `fk_Activity_LearningResult1`
  FOREIGN KEY (`LearningResult_idLearningResult`)
  REFERENCES `iteandes_novati'k`.`LearningResult` (`idLearningResult`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`TrainingCompetition` 
ADD CONSTRAINT `fk_TrainingCompetition_TrainingProgram1`
  FOREIGN KEY (`TrainingProgram_idTrainingProgram`)
  REFERENCES `iteandes_novati'k`.`TrainingProgram` (`idTrainingProgram`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`LearningResult` 
ADD CONSTRAINT `fk_LearningResult_TrainingCompetition1`
  FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`)
  REFERENCES `iteandes_novati'k`.`TrainingCompetition` (`idTrainingCompetition`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`Note` 
ADD CONSTRAINT `fk_Note_Activity1`
  FOREIGN KEY (`Activity_idActivity`)
  REFERENCES `iteandes_novati'k`.`Activity` (`idActivity`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Note_Teacher1`
  FOREIGN KEY (`Teacher_idTeacher`)
  REFERENCES `iteandes_novati'k`.`Teacher` (`idTeacher`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`Enrollment` 
DROP FOREIGN KEY `fk_Enrollment_Student1`;

ALTER TABLE `iteandes_novati'k`.`Enrollment` ADD CONSTRAINT `fk_Enrollment_Student1`
  FOREIGN KEY (`Student_idStudent`)
  REFERENCES `iteandes_novati'k`.`Student` (`idStudent`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Enrollment_Semester1`
  FOREIGN KEY (`Semester_idSemester`)
  REFERENCES `iteandes_novati'k`.`Semester` (`idSemester`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Enrollment_TrainingProgram1`
  FOREIGN KEY (`TrainingProgram_idTrainingProgram`)
  REFERENCES `iteandes_novati'k`.`TrainingProgram` (`idTrainingProgram`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`Schedule` 
ADD CONSTRAINT `fk_Schedule_Group1`
  FOREIGN KEY (`Group_idGroup`)
  REFERENCES `iteandes_novati'k`.`Group` (`idGroup`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`Group` 
ADD CONSTRAINT `fk_Group_TrainingCompetition1`
  FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`)
  REFERENCES `iteandes_novati'k`.`TrainingCompetition` (`idTrainingCompetition`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `iteandes_novati'k`.`EnrollmentCompetition` 
ADD CONSTRAINT `fk_EnrollmentCompetition_Enrollment1`
  FOREIGN KEY (`Enrollment_idEnrollment`)
  REFERENCES `iteandes_novati'k`.`Enrollment` (`idEnrollment`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_EnrollmentCompetition_Schedule1`
  FOREIGN KEY (`Schedule_idSchedule`)
  REFERENCES `iteandes_novati'k`.`Schedule` (`idSchedule`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_EnrollmentCompetition_TrainingCompetition1`
  FOREIGN KEY (`TrainingCompetition_idTrainingCompetition`)
  REFERENCES `iteandes_novati'k`.`TrainingCompetition` (`idTrainingCompetition`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
