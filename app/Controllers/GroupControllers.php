<?php

namespace  App\Controllers;

require_once (__DIR__.'/../Models/TrainingCompetition.php');
require_once (__DIR__.'/../Models/Group.php');
require_once (__DIR__.'/../Models/Schedule.php');
require_once (__DIR__.'/../Models/Teacher.php');

use App\Models\Schedule;
use App\Models\Teacher;
use App\Models\TrainingCompetition;
use App\Models\Group;
use App\Models\TrainingProgram;
use Carbon\Carbon;

if(!empty($_GET['action'])){
    GroupControllers::main($_GET['action']);
}

class GroupControllers{
    static function main($action){
        if ($action == "create") {
            GroupControllers::create();
        } else if ($action == "edit") {
            GroupControllers::edit();
        } else if ($action == "searchForID") {
            GroupControllers::searchForID($_REQUEST['idGroup']);
        } else if ($action == "searchAll") {
            GroupControllers::getAll();
        } else if ($action == "activate") {
            GroupControllers::activate();
        } else if ($action == "inactivate") {
            GroupControllers::inactivate();
        }
    }
//Crear un grupo
    static public function create()
    {
        try {
            $dayF = "";
            foreach ($_POST['dayS'] as $daySchedule) {
                $s = '|';
                if ($dayF == '') {
                    $dayF = $daySchedule;
                } else {
                    $dayF .= $s . $daySchedule;
                }
            }
                $arrschedule= array();
                $arrschedule['startDateSchedule']=  Carbon::parse($_POST['startDateSchedule']);
                $arrschedule['endDateSchedule']=  Carbon::parse($_POST['endDateSchedule']);
                $arrschedule['cantHours']=  $_POST['cantHours'];
                $arrschedule['daySchedule']=  $dayF;
                $arrschedule['startHourSchedule']=  Carbon::parse($_POST['startHourSchedule']);
                $arrschedule['endHourSchedule']=  Carbon::parse($_POST['endHourSchedule']);
                $arrschedule['stateSchedule']= 'Activo';
                $schedule = new Schedule($arrschedule);
                if($schedule->create()) {
                    $arrGroup = array();
                    $arrGroup['codeGroup']=$_POST['codeGroup'];
                    $arrGroup['nameGroup']=$_POST['nameGroup'];
                    $arrGroup['minimumSpaceGroup']=$_POST['minimumSpaceGroup'];
                    $arrGroup['maximumSpaceGroup']=$_POST['maximumSpaceGroup'];
                    $arrGroup['stateGroup']= 'Activo';
                    $arrGroup['TrainingCompetition_idTrainingCompetition']= TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
                    $arrGroup['Schedule_idSchedule']= $schedule;
                    $arrGroup['Teacher_idTeacher']= Teacher::searchForIdTeacher($_POST['Teacher_idTeacher']);
                    $group = new Group($arrGroup);
                    if($group->create()) {
                        header("Location: ../../views/modules/Group/show.php?idSchedule=".$schedule->getIdSchedule()."respuesta=correcto");
                    }
                }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Editar un Grupo
    static public function edit (){
        try {
                $dayF = "";
                foreach ($_POST['dayS'] as $daySchedule) {
                    $s = '|';
                    if ($dayF == '') {
                        $dayF = $daySchedule;
                    } else {
                        $dayF .= $s . $daySchedule;
                    }
                }
                $arrschedule= array();
                $arrschedule['startDateSchedule']=  Carbon::parse($_POST['startDateSchedule']);
                $arrschedule['endDateSchedule']=  Carbon::parse($_POST['endDateSchedule']);
                $arrschedule['cantHours']=  $_POST['cantHours'];
                $arrschedule['daySchedule']= $dayF;
                $arrschedule['startHourSchedule']=  Carbon::parse($_POST['startHourSchedule']);
                $arrschedule['endHourSchedule']=  Carbon::parse($_POST['endHourSchedule']);
                $arrschedule['stateSchedule']= $_POST['stateSchedule'];
                $arrschedule['idSchedule']=  $_POST['idSchedule'];
                $schedule = new Schedule($arrschedule);
                if($schedule->update()) {
                    $arrGroup = array();
                    $arrGroup['codeGroup'] = $_POST['codeGroup'];
                    $arrGroup['nameGroup'] = $_POST['nameGroup'];
                    $arrGroup['minimumSpaceGroup'] = $_POST['minimumSpaceGroup'];
                    $arrGroup['maximumSpaceGroup'] = $_POST['maximumSpaceGroup'];
                    $arrGroup['stateGroup'] = $_POST['stateSchedule'];
                    $arrGroup['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
                    $arrGroup['Schedule_idSchedule'] = $schedule;
                    $arrGroup['Teacher_idTeacher']= Teacher::searchForIdTeacher($_POST['Teacher_idTeacher']);
                    $arrGroup['idGroup'] = $_POST['idGroup'];
                    $group = new Group($arrGroup);
                    if ($group->update()) {
                        header("Location: ../../views/modules/Group/show.php?idSchedule=".$schedule->getIdSchedule(). "&respuesta=correcto");
                    }
                }
         } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Funcion activo
    static public function activate(){
        try{
            Schedule::updateNew($_GET['idSchedule'],"Activo");
            header("Location: ../../views/modules/Group/index.php");
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Group/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    //Funcion inactivo
    static public function inactivate(){
        try{
            Schedule::updateNew($_GET['idSchedule'],"Inactivo");
            header("Location: ../../views/modules/Group/index.php");
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Group/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    static public function searchForID ($idGroup){
        try {
            return Group::searchForId($idGroup);
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/show.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Group::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Group/index.php?respuesta=error");
        }
    }
}