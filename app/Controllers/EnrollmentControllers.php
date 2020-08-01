<?php

namespace App\Controllers;
require_once (__DIR__.'/../Models/Enrollment.php');
require_once (__DIR__.'/../Models/Student.php');
require_once (__DIR__.'/../Models/TrainingProgram.php');
require_once (__DIR__.'/../Models/Semester.php');

use App\Models\Enrollment;
use App\Models\Person;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\TrainingCompetition;
use App\Models\TrainingProgram;
use App\Models\Semester;
use Carbon\Carbon;

if(!empty($_GET['action'])){
    EnrollmentControllers::main($_GET['action']);
}

class EnrollmentControllers{
    static function main($action){
        if ($action == "create") {
            EnrollmentControllers::create();
        } else if ($action == "edit") {
            EnrollmentControllers::edit();
        } else if ($action == "searchForID") {
            EnrollmentControllers::searchForID($_REQUEST['idEnrollment']);
        } else if ($action == "searchAll") {
            EnrollmentControllers::getAll();
        } else if ($action == "activate") {
            EnrollmentControllers::activate();
        } else if ($action == "inactivate") {
            EnrollmentControllers::inactivate();
        }
    }

    //Crear una matricula
    static public function create()
    {
        try {
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
            $arrayPerson['lastNamePerson'] = $_POST['lastNamePerson'];
            $arrayPerson['dateBornPerson']= Carbon::parse($_POST['dateBornPerson']);
            $arrayPerson['rhPerson'] = $_POST['rhPerson'];
            $arrayPerson['emailPerson'] = $_POST['emailPerson'];
            $arrayPerson['phonePerson'] = $_POST['phonePerson'];
            $arrayPerson['adressPerson'] = $_POST['adressPerson'];
            $arrayPerson['generePerson'] = $_POST['generePerson'];
            $arrayPerson['typePerson'] = 'Docente';
            $arrayPerson['statePerson'] = 'Activo';
            $arrayPerson['photoPerson']= $_POST['photoPerson'];
            //Validar registro del Usuario
            if(!Person::userRegistration($arrayPerson['documentPerson'])) {
                $person = new Person($arrayPerson);
                if ($person->create()) {
                    $arrayStudent = array();
                    $arrayStudent['gradeYear'] = $_POST['gradeYear'];
                    $arrayStudent['modality'] = $_POST['modality'];
                    $arrayStudent['Institution'] = $_POST['Institution'];
                    $arrayStudent['Person_idPerson'] = $person;
                    $arrayStudent['stateStudent'] = 'Activo';
                    $student = new Student($arrayStudent);

                    if ($student->create()) {
                        $arrEnrollment = array();
                        $arrEnrollment->dateEnrollment = Carbon::now(); //Fecha Actual;
                        $arrEnrollment->stateEnrollment = $_POST['stateEnrollment'];
                        $arrEnrollment->Student_idStudent = $student;
                        $arrEnrollment->Semester_idSemester = Semester::searchForId($_POST['Semester_idSemester']);
                        $arrEnrollment->TrainingProgram_idTrainingProgram = TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
                        $enrollmment = new Enrollment($arrEnrollment);
                        if ($enrollmment->create()) {
                            $arrayEnrollmentCompetition['Enrollment_idEnrollment'] = $enrollmment;
                            $arrayEnrollmentCompetition['Schedule_idSchedule'] = Schedule::searchForId($_POST['Schedule_idSchedule']);
                            $arrayEnrollmentCompetition['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
                            $arrayEnrollmentCompetition['stateEnrollmentCompetition'] = 'Activo';
                            $EnrollmentCompetition = new EnrollmentCompetition($arrayEnrollmentCompetition);

                            if ($EnrollmentCompetition->create()) {
                                header("Location: ../../views/modules/Enrollment/show.php?idEnrollment=" . $enrollmment->idEnrollment());

                            }

                        }
                    }

                }
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrEnrollment= array();
            $arrEnrollment->idEnrollment = $_POST['idEnrollment'];
            $arrEnrollment->dateEnrollment = Carbon::now(); //Fecha Actual;
            $arrEnrollment->stateEnrollment = $_POST['stateEnrollment'];
            $arrEnrollment->Student_idStudent = Student::searchForId($_POST['Student_idStudent']);
            $arrEnrollment->Semester_idSemester= Semester::searchForId($_POST['Semester_idSemester']);
            $arrEnrollment->TrainingProgram_idTrainingProgram= TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
            $enrollmment = new Enrollment($arrEnrollment);
            $enrollmment->update();
            $arrayEnrollmentCompetition['idEnrollmentCompetition'] = $_POST['idEnrollmentCompetition'];
            $arrayEnrollmentCompetition['Enrollment_idEnrollment'] = Enrollment::searchForId($_POST['Enrollment_idEnrollment']);
            $arrayEnrollmentCompetition['Schedule_idSchedule'] = Schedule::searchForId($_POST['Schedule_idSchedule']);
            $arrayEnrollmentCompetition['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $arrayEnrollmentCompetition['stateEnrollmentCompetition'] = $_POST['stateEnrollmentCompetition'];
            $EnrollmentCompetition = new Note($arrayEnrollmentCompetition);
            $EnrollmentCompetition->update();
            header("Location: ../../views/modules/Enrollment/show.php?idEnrollment=".$enrollmment->getIdEnrollment()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Estado activo
    static public function activate (){
        try {
            $ObjEnrollment = Enrollment::searchForId($_GET['idEnrollment']);
            $ObjEnrollment->setStateEnrollment('Activo');
            if($ObjEnrollment->update()){
                header("Location: ../../views/modules/Enrollment/index.php");
            }else{
                header("Location: ../../views/modules/Enrollment/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/index.php?respuesta=error&mensaje=".$e->getMessage());
            header("Location: ../../views/modules/Enrollment/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $enrollment  = Enrollment::searchForId($_GET['idEnrollment']);
            $enrollment ->setStateEnrollment("Inactivo");
            if($enrollment ->update()){
                header("Location: ../../views/modules/Enrollment/index.php");
            }else{
                header("Location: ../../views/modules/Enrollment/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/index.php?respuesta=error");
        }
    }

    static public function searchForID ($idEnrollment){
        try {
            return Enrollment::searchForId($idEnrollment);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Enrollment::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Enrollment/manager.php?respuesta=error");
        }
    }
}