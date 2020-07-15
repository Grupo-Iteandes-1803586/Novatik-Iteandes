<?php
namespace App\Controllers;
require(__DIR__.'/../Models/TeacherStudies.php');
use App\Models\TeacherStudies;

if(!empty($_GET['action'])){
    TeacherStudiesControllers::main($_GET['action']);
}
class TeacherStudiesControllers
{
    static function main($action)
    {
        if ($action == "create") {
            TeacherStudiesControllers::create();
        } else if ($action == "edit") {
            TeacherStudiesControllers::edit();
        } else if ($action == "searchForID") {
            TeacherStudiesControllers::searchForID($_REQUEST['idTeacherStudies']);
        } else if ($action == "searchAll") {
            TeacherStudiesControllers::getAll();
        }else if($action == "active"){
            TeacherStudiesControllers::active();
        }else if($action =="inactive"){
            TeacherStudiesControllers::inactive();
        }
    }

    static public function create()
    {
        try {
            $arrayTeacherStudies = array();
            $arrayTeacherStudies['idTeacherStudies'] = $_POST['idTeacherStudies'];
            $arrayTeacherStudies['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayTeacherStudies['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $arrayTeacherStudies['stateTeacherStudies'] = 'Activo';
            $TeacherStudies = new TeacherStudies ($arrayTeacherStudies);
                if($TeacherStudies->create()){
                    header("Location: ../../views/modules/Person/Teacher/index.php.php?respuesta=correcto");
                } else{
                header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=TeacherStudies ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayTeacherStudies = array();
            $arrayTeacherStudies['idTeacherStudies'] = $_POST['idTeacherStudies'];
            $arrayTeacherStudies['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayTeacherStudies['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $arrayTeacherStudies['stateTeacherStudies'] = $_POST['stateTeacherStudies'];
            $TeacherStudies = new TeacherStudies($arrayTeacherStudies);
            $TeacherStudies->update();

            header("Location: ../../views/modules/Person/Teacher/show.php?id=".$TeacherStudies->getIdTeacherStudies()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Person/Teacher/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    static public function activate (){
        try {
            $TeacherStudies = TeacherStudies::searchForId($_GET['idTeacherStudies']);
            $TeacherStudies->setStateTeacherStudies("Activo");
            if($TeacherStudies->update()){
                header("Location: ../../views/modules/Person/Teacher/index.php");
            }else{
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $Lenguages = Lenguages::searchForId($_GET['idTeacherStudies']);
            $Lenguages->setStateTeacherStudies("Inactivo");
            if($Lenguages->update()){
                header("Location: ../../views/modules/Person/Teacher/index.php");
            }else{
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error");
        }
    }
    static public function searchForID ($idTeacherStudies){
        try {
            return TeacherStudies::searchForId($idTeacherStudies);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

    static public function getAll ()
    {
        try {
            return TeacherStudies::getAll();
        } catch (\Exception $e) {
            var_dump($e);

        }
    }
}






