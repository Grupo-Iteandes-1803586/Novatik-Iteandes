<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/TeacherLenguages.php');
require_once(__DIR__.'/../Models/Teacher.php');
require_once(__DIR__.'/../Models/Lenguages.php');


use App\Models\Lenguages;
use App\Models\Teacher;
use App\Models\TeacherLenguages;

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

    static public function searchForID ($idTeacherLenguages){
        try {
            return TeacherLenguages::searchForId($idTeacherLenguages);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Person/Teacher/manager.php?respuesta=error");
        }
    }
}