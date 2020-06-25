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
        }
    }

    static public function create()
    {
        try {
            $arrayTeacherStudies = array();
            $arrayTeacherStudies['idTeacherStudies'] = $_POST['idTeacherStudies'];
            $arrayTeacherStudies['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayTeacherStudies['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $TeacherStudies = new TeacherStudies ($arrayTeacherStudies);
                if($TeacherStudies->create()){
                    header("Location: ../../views/modules/TeacherStudies/create.php?respuesta=correcto");
                } else{
                header("Location: ../../views/modules/TeacherStudies/create.php?respuesta=error&mensaje=TeacherStudies ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/TeacherStudies/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayTeacherStudies = array();
            $arrayTeacherStudies['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayTeacherStudies['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $arrayTeacherStudies['idTeacherStudies'] = $_POST['idTeacherStudies'];
            $TeacherStudies = new TeacherStudies($arrayTeacherStudies);
            $TeacherStudies->update();

            header("Location: ../../views/modules/TeacherStudies/show.php?id=".$TeacherStudies->getIdTeacherStudies()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/TeacherStudies/edit.php?respuesta=error&mensaje=".$e->getMessage());
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






