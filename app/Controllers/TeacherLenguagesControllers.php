<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Teacher.php');
require_once(__DIR__.'/../Models/Lenguages.php');


use App\Models\Lenguages;
use App\Models\Teacher;
use App\Models\Experience;
use App\Models\TeacherLenguages;
use App\Models\TeacherStudies;
use App\Models\Person;

if(!empty($_GET['action'])){
    TeacherLenguagesControllers::main($_GET['action']);
}
class TeacherLenguagesControllers
{

    static function main($action)
    {
        if ($action == "create") {
            TeacherLenguagesControllers::create();
        } else if ($action == "edit") {
            TeacherLenguagesControllers::edit();
        } else if ($action == "searchForID") {
            TeacherLenguagesControllers::searchForID($_REQUEST['idTeacherLenguages']);
        } else if ($action == "searchAll") {
            TeacherLenguagesControllers::getAll();
        } else if ($action == "activate") {
            TeacherLenguagesControllers::activate();
        } else if ($action == "inactivate") {
            TeacherLenguagesControllers::inactivate();
        }
    }

    static public function create()
    {
        try {
            $arrayTeacherLenguages = array();
            $arrayTeacherLenguages ['Teacher_idTeacher'] = Teacher::searchForId($_POST['Teacher_idTeacher']);
            $arrayTeacherLenguages ['Lenguages_idLenguages'] = Lenguages::searchForId($_POST['Lenguages_idLenguages']);
            $arrayTeacherLenguages ['stateTeacherLenguages'] = 'Activo';
            $TeacherLenguages = new TeacherLenguages($arrayTeacherLenguages);
            if ($TeacherLenguages->create()) {
                header("Location: ../../views/modules/Person/Teacher/create.php?idTeacherLenguages=" . $TeacherLenguages->getIdTeacherLenguages());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    //Editar un TeacherLenguages
    static public function edit (){
        try {
            $arrayTeacherLenguages = array();
            $arrayTeacherLenguages['Teacher_idTeacher'] = Teacher::searchForId($_POST['Teacher_idTeacher']);
            $arrayTeacherLenguages['Lenguages_idLenguages'] = Lenguages::searchForId($_POST['Lenguages_idLenguages']);
            $arrayTeacherLenguages['stateTeacherLenguages'] = $_POST['stateTeacherLenguages'];
            $arrayTeacherLenguages['idTeacherLenguages'] = $_POST['idTeacherLenguages'];

            $TeacherLenguages = new TeacherLenguages( $arrayTeacherLenguages);
            $TeacherLenguages->update();

            header("Location: ../../views/modules/Person/Teacher/show.php?idTeacher=".$TeacherLenguages->getIdTeacherLenguages()."&respuesta=correcto");
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    /////Estado activo
    static public function activate (){
        try {
            $ObjTeacherLenguages = TeacherLenguages::searchForId($_GET['idTeacher']);
            $ObjTeacherLenguages->setStateTeacher('Activo');
            if($ObjTeacherLenguages->update()){
                header("Location: ../../views/Person/Teacher/index.php");
            }else{
                header("Location: ../../views/Person/Teacher/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/Person/Teacher/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $TeacherLenguages  = TeacherLenguages ::searchForId($_GET['idTeacher']);
            $TeacherLenguages ->setStateTeacher("Inactivo");
            if($TeacherLenguages ->update()){
                header("Location: ../../views/modules/Person/Teacher/index.php");
            }else{
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error");
        }
    }
    static public function searchForID ($idTeacherLenguages){
        try {
            return TeacherLenguages ::searchForId($idTeacherLenguages);
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Person/Teacher/manager.php?respuesta=error");
        }
    }
}