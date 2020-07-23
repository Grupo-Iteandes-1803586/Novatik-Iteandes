<?php
namespace App\Controllers;
require_once (__DIR__.'/../Models/EnrollmentCompetition.php');
require_once (__DIR__.'/../Models/Enrollment');
require_once (__DIR__.'/../Models/Schedule.php');
require_once (__DIR__.'/../Models/TrainingCompetition.php');

use App\Models\Enrollment;
use App\Models\Note;
use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\Activity;
use App\Models\TrainingCompetition;

if(!empty($_GET['action'])){
    EnrollmentCompetitionControllers::main($_GET['action']);
}
class EnrollmentCompetitionControllers{

    static function main($action)
    {
        if ($action == "create") {
            NoteControllers::create();
        } else if ($action == "edit") {
            NoteControllers::edit();
        } else if ($action == "searchForID") {
            NoteControllers::searchForID($_REQUEST['idEnrollmentCompetition']);
        } else if ($action == "searchAll") {
            NoteControllers::getAll();
        } else if ($action == "activate") {
            NoteControllers::activate();
        } else if ($action == "inactivate") {
            NoteControllers::inactivate();
        }
    }
    //Crear una EnrollmentCompetition
    static public function create()
    {
        try {
            $arrayEnrollmentCompetition['Enrollment_idEnrollment'] = Enrollment::searchForId($_POST['Enrollment_idEnrollment']);
            $arrayEnrollmentCompetition['Schedule_idSchedule'] = Schedule::searchForId($_POST['Schedule_idSchedule']);
            $arrayEnrollmentCompetition['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $arrayEnrollmentCompetition['stateEnrollmentCompetition'] = 'Activo';
            $EnrollmentCompetition = new EnrollmentCompetition($arrayEnrollmentCompetition);

            if ($EnrollmentCompetition->create()) {
                header("Location: ../../views/modules/Note/create.php?idNote=" . $EnrollmentCompetition->getIdNote());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Editar un EnrollmentCompetition
    static public function edit (){
        try {
            $arrayEnrollmentCompetition['idEnrollmentCompetition'] = $_POST['idEnrollmentCompetition'];
            $arrayEnrollmentCompetition['Enrollment_idEnrollment'] = Enrollment::searchForId($_POST['Enrollment_idEnrollment']);
            $arrayEnrollmentCompetition['Schedule_idSchedule'] = Schedule::searchForId($_POST['Schedule_idSchedule']);
            $arrayEnrollmentCompetition['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $arrayEnrollmentCompetition['stateEnrollmentCompetition'] = $_POST['stateEnrollmentCompetition'];
            $EnrollmentCompetition = new Note($arrayEnrollmentCompetition);
            $EnrollmentCompetition->update();

            header("Location: ../../views/modules/Note/show.php?respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    //Estado activo
    static public function activate (){
        try {
            $ObjEnrollmentCompetition = EnrollmentCompetition::searchForId($_GET['idEnrollmentCompetition']);
            $ObjEnrollmentCompetition->setStateEnrollmentCompetition('Activo');
            if($ObjEnrollmentCompetition->update()){
                header("Location: ../../views/modules/Note/index.php");
            }else{
                header("Location: ../../views/modules/Note/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $EnrollmentCompetition  = EnrollmentCompetition::searchForId($_GET['idEnrollmentCompetition']);
            $EnrollmentCompetition ->setStateEnrollmentCompetition("Inactivo");
            if($EnrollmentCompetition ->update()){
                header("Location: ../../views/modules/Note/index.php");
            }else{
                header("Location: ../../views/modules/Note/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/index.php?respuesta=error");
        }
    }
    //Buscar por id
    static public function searchForID ($idEnrollmentCompetition){
        try {
            return EnrollmentCompetition::searchForId($idEnrollmentCompetition);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Note/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return EnrollmentCompetition::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Note/manager.php?respuesta=error");
        }
    }
}