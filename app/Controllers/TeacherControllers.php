<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Teacher.php');
require_once(__DIR__.'/../Models/Experience.php');
require_once(__DIR__.'/../Models/TeacherStudies.php');
require_once(__DIR__.'/../Models/Person.php');

use App\Models\Teacher;
use App\Models\Experience;
use App\Models\TeacherStudies;
use App\Models\Person;

if(!empty($_GET['action'])){
    TeacherControllers::main($_GET['action']);
}
class TeacherControllers
{

    static function main($action)
    {
        if ($action == "create") {
            TeacherControllers::create();
        } else if ($action == "edit") {
            TeacherControllers::edit();
        } else if ($action == "searchForID") {
            TeacherControllers::searchForID($_REQUEST['idTeacher']);
        } else if ($action == "searchAll") {
            TeacherControllers::getAll();
        } else if ($action == "activate") {
            TeacherControllers::activate();
        } else if ($action == "inactivate") {
            TeacherControllers::inactivate();
        }
    }

    static public function create()
    {
        try {
            $arrayTeacher = array();
            $arrayTeacher['Experience_idExperience'] = Experience::searchForId($_POST['Experience_idExperience']);
            $arrayTeacher['TeacherStudies_idTeacherStudies'] = TeacherStudies::searchForId($_POST['TeacherStudies_idTeacherStudies']);
            $arrayTeacher['Person_idPerson'] = Person ::searchForId ($_POST['Person_idPerson']);
            $arrayTeacher['stateTeacher'] = 'Activo';
            $Teacher= new Teacher($arrayTeacher);
            if($Teacher->create()){
                header("Location: ../../views/modules/Person/Teacher/create.php?idTeacher=".$Teacher->getIdTeacher());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    //Editar un Teacher
    static public function edit (){
        try {
            $arrayTeacher = array();
            $arrayTeacher['Experience_idExperience'] = Experience::searchForId($_POST['Experience_idExperience']);
            $arrayTeacher['TeacherStudies_idTeacherStudies'] = TeacherStudies::searchForId($_POST['TeacherStudies_idTeacherStudies']);
            $arrayTeacher['Person_idPerson'] = Person ::searchForId ($_POST['Person_idPerson']);
            $arrayTeacher['stateTeacher'] = $_POST['stateTeacher'];
            $arrayTeacher['idTeacher'] = $_POST['idTeacher'];

            $Teacher = new Teacher( $arrayTeacher);
            $Teacher->update();

            header("Location: ../../views/modules/Person/Teacher/show.php?idTeacher=".$Teacher->getIdTeacher()."&respuesta=correcto");
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
/////Estado activo
    static public function activate (){
        try {
            $ObjTeacher = Teacher::searchForId($_GET['idTeacher']);
            $ObjTeacher->setStateTeacher('Activo');
            if($ObjTeacher->update()){
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
            $Teacher  = Teacher ::searchForId($_GET['idTeacher']);
            $Teacher ->setStateTeacher("Inactivo");
            if($Teacher ->update()){
                header("Location: ../../views/modules/Person/Teacher/index.php");
            }else{
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
           // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error");
        }
    }
    static public function searchForID ($id){
        try {
            return Teacher ::searchForId($id);
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Person/Teacher/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Teacher::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Person/Teacher/manager.php?respuesta=error");
        }
    }

}