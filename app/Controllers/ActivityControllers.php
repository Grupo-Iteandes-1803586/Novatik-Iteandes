<?php
namespace App\Controllers;
require_once (__DIR__.'/../Models/Activity.php');
require_once (__DIR__.'/../Models/Archive.php');
require_once (__DIR__.'/../Models/LearningResult.php');

use App\Models\LearningResult;
use App\Models\Archive;
use App\Models\Activity;

if(!empty($_GET['action'])){
    ActivityControllers::main($_GET['action']);
}
class ActivityControllers
{
    static function main($action)
    {
        if ($action == "create") {
            ActivityControllers::create();
        } else if ($action == "edit") {
            ActivityControllers::edit();
        } else if ($action == "searchForID") {
            ActivityControllers::searchForID($_REQUEST['idActivity']);
        } else if ($action == "searchAll") {
            ActivityControllers::getAll();
        } else if ($action == "activate") {
            ActivityControllers::activate();
        } else if ($action == "inactivate") {
            ActivityControllers::inactivate();
        }
    }
    //Crear una Activity
    static public function create()
    {
        try {
            $arrayActivity['codeActivity'] = $_POST['codeActivity'];
            $arrayActivity['nameActivity'] = $_POST['nameActivity'];
            $arrayActivity['descriptionActivity'] = $_POST['descriptionActivity'];
            $arrayActivity['typeActivity'] = $_POST['typeActivity'];
            $arrayActivity['LearningResult_idLearningResult'] = LearningResult::searchForId($_POST['LearningResult_idLearningResult']);
            $arrayActivity['stateActivity'] = 'Activo';
            $activity = new Activity($arrayActivity);
            if ($activity->create()) {
                //archive
                $arrayArchive['nameArchive'] = $_POST['nameArchive'];
                $arrayArchive['descriptionArchive'] = $_POST['descriptionArchive'];
                $arrayArchive['rutaArchive'] = 'Ruta del Archivo';
                $arrayArchive['Activity_idActivity'] =$activity;
                $arrayArchive['Group_idGroup'] =$activity;
                $arrayArchive['stateArchive'] = 'Activo';
                $archive = new Archive($arrayArchive);
                if ($archive->create()) {
                    header("Location: ../../views/modules/Activity/show.php?idActivity=".$activity->getIdActivity());
                }
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Activity/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    //Editar una Activity
    static public function edit (){
        try {
            $arrayActivity['idActivity'] = $_POST['idActivity'];
            $arrayActivity['codeActivity'] = $_POST['codeActivity'];
            $arrayActivity['nameActivity'] = $_POST['nameActivity'];
            $arrayActivity['descriptionActivity'] = $_POST['descriptionActivity'];
            $arrayActivity['typeActivity'] = $_POST['typeActivity'];
            $arrayActivity['LearningResult_idLearningResult'] = LearningResult::searchForId($_POST['LearningResult_idLearningResult']);
            $arrayActivity['stateActivity'] = $_POST['stateActivity'];
            $Activity = new Activity($arrayActivity);
            if($Activity->update()){
                $arrayArchive['idArchive'] = $_POST['idArchive'];
                $arrayArchive['nameArchive'] = $_POST['nameArchive'];
                $arrayArchive['descriptionArchive'] = $_POST['descriptionArchive'];
                $arrayArchive['rutaArchive'] = 'Ruta de Archivo';
                $arrayArchive['Activity_idActivity'] = $Activity;
                $arrayArchive['stateArchive'] = $Activity->getStateActivity();
                $Archive = new Archive ($arrayArchive);
            }if($Archive->update()){
                header("Location: ../../views/modules/Activity/show.php?idActivity=".$Activity->getIdActivity()."&respuesta=correcto");
            }
        } catch (\Exception $e) {
            var_dump($e);
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Activity/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    //Estado activo
    static public function activate (){
        try {
            $ObjActivity = Activity::searchForId($_GET['idActivity']);
            $ObjActivity->setStateActivity('Activo');
            if($ObjActivity->update()){
                header("Location: ../../views/modules/Activity/index.php");
            }else{
                header("Location: ../../views/modules/Activity/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Activity/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $Activity  = Activity::searchForId($_GET['idActivity']);
            $Activity ->setStateActivity("Inactivo");
            if($Activity ->update()){
                header("Location: ../../views/modules/Activity/index.php");
            }else{
                header("Location: ../../views/modules/Activity/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Activity/index.php?respuesta=error");
        }
    }
    //Buscar por id
    static public function searchForID ($idActivity){
        try {
            return Activity::searchForId($idActivity);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Note/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Activity::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Note/manager.php?respuesta=error");
        }
    }
}
