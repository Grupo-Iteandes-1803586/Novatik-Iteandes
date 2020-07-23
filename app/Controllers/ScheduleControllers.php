<?php

namespace App\Controllers;
require_once (__DIR__.'/../Models/Schedule.php');
require_once (__DIR__.'App\Models\Group');
use App\Models\Schedule;
use App\Models\Group;

if(!empty($_GET['action'])){
    ScheduleControllers::main($_GET['action']);
}
class ScheduleControllers{
    static function main($action){
        if ($action == "create") {
            ScheduleControllers::create();
        } else if ($action == "edit") {
            ScheduleControllers::edit();
        } else if ($action == "searchForID") {
            ScheduleControllers::searchForID($_REQUEST['idSchedule']);
        } else if ($action == "searchAll") {
            ScheduleControllers::getAll();
        } else if ($action == "activate") {
            ScheduleControllers::activate();
        } else if ($action == "inactivate") {
            ScheduleControllers::inactivate();
        }
    }

    //crear un horario
    static public function create()
    {
        try {
            $arrschedule= array();
            $arrschedule->startDateSchedule=  $_POST['startDateSchedule'];
            $arrschedule->endDateSchedule=  $_POST['endDateSchedule'];
            $arrschedule->cantHours=  $_POST['cantHours'];
            $arrschedule->startHourSchedule=  $_POST['startHourSchedule'];
            $arrschedule->endHourSchedule=  $_POST['endHourSchedule'];
            $arrschedule->stateSchedule= 'Activo';
            $arrschedule->Group_idGroup=  Group::searchForId($_POST['Group_idGroup']);
            $schedule = new Schedule($arrschedule);
            if($schedule->create()){
                header("Location: ../../views/modules/Schedule/show.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Schedule/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Editar un horario
    static public function edit (){
        try {
            $arrschedule= array();
            $arrschedule->idSchedule=  $_POST['idSchedule'];
            $arrschedule->startDateSchedule=  $_POST['startDateSchedule'];
            $arrschedule->endDateSchedule=  $_POST['endDateSchedule'];
            $arrschedule->cantHours=  $_POST['cantHours'];
            $arrschedule->startHourSchedule=  $_POST['startHourSchedule'];
            $arrschedule->endHourSchedule=  $_POST['endHourSchedule'];
            $arrschedule->stateSchedule= $_POST['stateSchedule'];
            $arrschedule->Group_idGroup=  Group::searchForId($_POST['Group_idGroup']);
            $schedule = new Schedule($arrschedule);
            $schedule->update();

            header("Location: ../../views/modules/Schedule/show.php?idSchedule=".$schedule->getIdSchedule()."&respuesta=correcto");
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Schedule/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Estado activo
    static public function activate (){
        try {
            $ObjSchedule = Schedule::searchForId($_GET['idSchedule']);
            $ObjSchedule->setStateSchedule('Activo');
            if($ObjSchedule->update()){
                header("Location: ../../views/modules/Schedule/index.php");
            }else{
                header("Location: ../../views/modules/Schedule/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/Person/Teacher/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $Schedule  = Schedule::searchForId($_GET['idSchedule']);
            $Schedule ->setStateSchedule("Inactivo");
            if($Schedule ->update()){
                header("Location: ../../views/modules/Schedule/index.php");
            }else{
                header("Location: ../../views/modules/Schedule/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Schedule/index.php?respuesta=error");
        }
    }
    //buscar por id
    static public function searchForID($idSchedule){
        try {
            return Schedule::searchForId($idSchedule);
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Schedule/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Schedule::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Schedule/manager.php?respuesta=error");
        }
    }

}