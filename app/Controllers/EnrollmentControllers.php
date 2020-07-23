<?php

namespace App\Controllers;
require_once (__DIR__.'/../Models/Enrollment.php');
require_once (__DIR__.'/../Models/Student.php');
require_once (__DIR__.'/../Models/TrainingProgram.php');
require_once (__DIR__.'/../Models/Semester.php');

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\TrainingProgram;
use App\Models\Semester;

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

            $arrEnrollment= array();
            $arrEnrollment->idEnrollment = $_POST['idEnrollment'];
            $arrEnrollment->dateEnrollment = $_POST['dateEnrollment'];
            $arrEnrollment->stateEnrollment = $_POST['stateEnrollment'];
            $arrEnrollment->Student_idStudent = Student::searchForId($_POST['Student_idStudent']);
            $arrEnrollment->Semester_idSemester= Semester::searchForId($_POST['Semester_idSemester']);
            $arrEnrollment->TrainingProgram_idTrainingProgram= TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
            $enrollmment = new Enrollment($arrEnrollment);
            if($enrollmment->create()){
                header("Location: ../../views/modules/Enrollment/show.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Enrollment/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
}