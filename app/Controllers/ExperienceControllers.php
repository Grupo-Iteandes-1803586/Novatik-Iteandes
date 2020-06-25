<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Experience.php');
use App\Models\Experience;

if(!empty($_GET['action'])){
    ExperienceControllers::main($_GET['action']);
}
class ExperienceControllers
{
    static function main($action)
    {
        if ($action == "create") {
            ExperienceControllers::create();
        } else if ($action == "edit") {
            ExperienceControllers::edit();
        } else if ($action == "searchForID") {
            ExperienceControllers::searchForID($_REQUEST['idExperience']);
        } else if ($action == "searchAll") {
            ExperienceControllers::getAll();
        }
    }
    static public function create()
    {
        try {
            $arrayExperience = array();
            $arrayExperience['idExperience'] = $_POST['idExperience'];
            $arrayExperience['institutionExperience'] = $_POST['institutionExperience'];
            $arrayExperience['dedicationExperience'] = $_POST['dedicationExperience'];
            $arrayExperience['startExperience'] = $_POST['startExperience'];
            $arrayExperience['endExperince'] = $_POST['endExperince'];
            $Experience = new Experience ($arrayExperience);
            if($Experience->create()){
                header("Location: ../../views/modules/Experience/create.php?respuesta=correcto");
            } else{
                header("Location: ../../views/modules/Experience/create.php?respuesta=error&mensaje=Experience ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Experience/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    static public function edit (){
        try {
            $arrayExperience = array();
            $arrayExperience['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayExperience['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $arrayExperience['idTeacherStudies'] = $_POST['idTeacherStudies'];
            $Experience = new Experience($arrayExperience);
            $Experience->update();

            header("Location: ../../views/modules/Experience/show.php?id=".$Experience->getIdExperience()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Experience/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    static public function searchForID ($idExperience){
        try {
            return Experience::searchForId($idExperience);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

    static public function getAll ()
    {
        try {
            return Experience::getAll();
        } catch (\Exception $e) {
            var_dump($e);

        }
    }
}