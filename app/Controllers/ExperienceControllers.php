<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Experience.php');
use App\Models\Experience;
use Carbon\Carbon;

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
            ExperienceControllers::searchForID($_REQUEST['$idExperience']);
        } else if ($action == "searchAll") {
            ExperienceControllers::getAll();
        }
    }
    static public function create()
    {
        try {
            $arrayExperience = array();
            $arrayExperience['institutionExperience'] = $_POST['institutionExperience'];
            $arrayExperience['dedicationExperience'] = $_POST['dedicationExperience'];
            $arrayExperience['startExperience'] = Carbon::parse($_POST['startExperience']);
            $arrayExperience['endExperince'] = Carbon::parse($_POST['endExperince']);
            $arrayExperience['stateExperience'] = 'Activo';
            $Experience = new Experience($arrayExperience);
            if($Experience->create()){
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=correcto");
            } else{
                header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=Experience ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    static public function edit (){
        try {
            $arrayExperience = array();
            $arrayExperience['idExperience'] = $_POST['idExperience'];
            $arrayExperience['institutionExperience'] = $_POST['institutionExperience'];
            $arrayExperience['dedicationExperience'] = $_POST['dedicationExperience'];
            $arrayExperience['startExperience'] = Carbon::parse($_POST['startExperience']);
            $arrayExperience['endExperince'] = Carbon::parse($_POST['endExperince']);
            $arrayExperience['stateExperience'] = $_POST['stateExperience'];
            $Experience = new Experience($arrayExperience);
            $Experience->update();

            header("Location: ../../views/modules/Person/Teacher/show.php?id=".$Experience->getIdExperience()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Person/Teacher/edit.php?respuesta=error&mensaje=".$e->getMessage());
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