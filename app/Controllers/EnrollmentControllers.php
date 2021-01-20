<?php

namespace App\Controllers;
require_once (__DIR__.'/../Models/Enrollment.php');
require_once (__DIR__.'/../Models/Schedule.php');
require_once (__DIR__.'/../Models/Student.php');
require_once (__DIR__.'/../Models/Person.php');
require_once (__DIR__.'/../Models/TrainingProgram.php');
require_once (__DIR__.'/../Models/Semester.php');

use App\Models\Enrollment;
use App\Models\EnrollmentCompetition;
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
        } else if ($action == "createEstu") {
            EnrollmentControllers::createEstu();
        } else if ($action == "searchForID") {
            EnrollmentControllers::searchForID($_REQUEST['idEnrollment']);
        } else if ($action == "searchAll") {
            EnrollmentControllers::getAll();
        } else if ($action == "activate") {
            EnrollmentControllers::activate();
        } else if ($action == "inactivate") {
            EnrollmentControllers::inactivate();
        }else if ($action == "infoCreateE") {
            EnrollmentControllers::infoCreateE($_REQUEST['documentPerson']);
        }
    }

    static public  function infoCreateE($documentPerson){
        try {
            $arrayPerson  = Person::searchForIdP($documentPerson);
            //Validar registro del Usuario
            if(!Person::userRegistration($documentPerson)) {
                header("Location: ../../views/modules/Enrollment/create.php?respuesta=correcto");
            }else{
                //buscar idStudent de la persona
                $arrayStu  = Student::searchForIdP($arrayPerson->getIdPerson());
                header("Location: ../../views/modules/Enrollment/createNew.php?idStudent=".$arrayStu->getIdStudent()."&respuesta=correcto");
            }

        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/infoCreate.php?respuesta=error");
        }
    }
    static  public function createEstu(){
        try {
            $arrEnrollment = array();
            $arrEnrollment['dateEnrollment'] = Carbon::now(); //Fecha Actual;
            $arrEnrollment['stateEnrollment'] = 'Activo';
            $arrEnrollment['Student_idStudent'] = Student::searchForId($_POST['Student_idStudent']);
            $arrEnrollment['Semester_idSemester'] = Semester::searchForId($_POST['Semester_idSemester']);
            $arrEnrollment['TrainingProgram_idTrainingProgram'] = TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
            $enrollmment = new Enrollment($arrEnrollment);
            if ($enrollmment->create()) {
                header("Location: ../../views/modules/Enrollment/createNew.php?idEnrollment=".$enrollmment->getIdEnrollment()."&respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Enrollment/createNew.php?respuesta=error&mensaje=Error");
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/createNew.php?respuesta=error&mensaje=" . $e->getMessage());
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
            $arrayPerson['typePerson'] = 'Estudiante';
            $arrayPerson['statePerson'] = 'Activo';
            $arrayPerson['photoPerson']= 'Sin Imagen';
            //Validar registro del Usuario
            if(!Person::userRegistration($arrayPerson['documentPerson'])){
                $person =new Person($arrayPerson);
                if($person->create()){
                    $arrayStudent = array();
                    $arrayStudent['gradeYear'] = $_POST['gradeYear'];
                    $arrayStudent['modality'] = $_POST['modality'];
                    $arrayStudent['Institution'] = $_POST['Institution'];
                    $arrayStudent['Person_idPerson'] = $person;
                    $arrayStudent['stateStudent'] = 'Activo';
                    $student = new Student($arrayStudent);
                    if ($student->create()) {
                        $arrEnrollment = array();
                        $arrEnrollment['dateEnrollment'] = Carbon::now(); //Fecha Actual;
                        $arrEnrollment['stateEnrollment'] = 'Activo';
                        $arrEnrollment['Student_idStudent'] = $student;
                        $arrEnrollment['Semester_idSemester'] = Semester::searchForId($_POST['Semester_idSemester']);
                        $arrEnrollment['TrainingProgram_idTrainingProgram'] = TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
                        $enrollmment = new Enrollment($arrEnrollment);
                        if ($enrollmment->create()) {
                            header("Location: ../../views/modules/Enrollment/show.php?idEnrollment=".$enrollmment->getIdEnrollment()."&respuesta=correcto");
                        }
                    }

                }
            }else{
                header("Location: ../../views/modules/Enrollment/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit(){
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
            $arrayPerson['typePerson'] = $_POST['typePerson'];
            $arrayPerson['statePerson'] = $_POST['statePerson'];
            $arrayPerson['photoPerson']= 'Sin Imagen';
            $arrayPerson['idPerson']= $_POST['idPerson'];
            $person= new Person($arrayPerson);
            if($person->update()){
                $arrayStudent = array();
                $arrayStudent['idStudent'] = $_POST['idStudent'];
                $arrayStudent['gradeYear'] = $_POST['gradeYear'];
                $arrayStudent['modality'] = $_POST['modality'];
                $arrayStudent['Institution'] = $_POST['Institution'];
                $arrayStudent['Person_idPerson'] = $person;
                $arrayStudent['stateStudent'] = $person->getStatePerson();
                $student = new Student($arrayStudent);
                if($student->update()){
                    $arrEnrollment= array();
                    $arrEnrollment['idEnrollment'] = $_POST['idEnrollment'];
                    $arrEnrollment['dateEnrollment'] = Carbon::now(); //Fecha Actual;
                    $arrEnrollment['stateEnrollment'] = $person->getStatePerson();
                    $arrEnrollment['Student_idStudent'] = $student;
                    $arrEnrollment['Semester_idSemester']= Semester::searchForId($_POST['Semester_idSemester']);
                    $arrEnrollment['TrainingProgram_idTrainingProgram']= TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
                    $enrollmment = new Enrollment($arrEnrollment);
                    if($enrollmment->update()){
                        header("Location: ../../views/modules/Enrollment/show.php?idEnrollment=".$enrollmment->getIdEnrollment()."&respuesta=correcto");
                    }
                }
            }
         } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Funcion activo
    static public function activate(){
        try{
            Enrollment::updateNew($_GET['idEnrollment'],"Activo");
            header("Location: ../../views/modules/Enrollment/index.php");
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Enrollment/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    //Funcion inactivo
    static public function inactivate(){
        try{
            Enrollment::updateNew($_GET['idEnrollment'],"Inactivo");
            header("Location: ../../views/modules/Enrollment/index.php");
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Enrollment/index.php?respuesta=error&mensaje" . $exc-> getMessage());
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