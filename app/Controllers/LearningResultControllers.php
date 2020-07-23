<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/LearningResult.php');
require_once(__DIR__.'/../Models/TrainingCompetition.php');

use App\Models\LearningResult;
use App\Models\TrainingCompetition;


if(!empty($_GET['action'])){
    LearningResultControllers::main($_GET['action']);
}
class LearningResultControllers
{

    static function main($action)
    {
        if ($action == "create") {
            LearningResultControllers::create();
        } else if ($action == "edit") {
            LearningResultControllers::edit();
        } else if ($action == "searchForID") {
            LearningResultControllers::searchForID($_REQUEST['idLearningResult']);
        } else if ($action == "searchAll") {
            LearningResultControllers::getAll();
        } else if ($action == "activate") {
            LearningResultControllers::activate();
        } else if ($action == "inactivate") {
            LearningResultControllers::inactivate();
        }
    }
    //Crear una   LearningResult
    static public function create()
    {
        try {
            $arrayLearningResult = array();
            $arrayLearningResult['codeLearningResult'] =$_POST['codeLearningResult'];
            $arrayLearningResult['nameLearningResult'] =$_POST['nameLearningResult'];
            $arrayLearningResult['durationLearningResult'] =$_POST['durationLearningResult'];
            $arrayLearningResult['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $arrayLearningResult['statuLearningResult'] = 'Activo';
            $LearningResult= new LearningResult($arrayLearningResult);
            if($LearningResult->create()){
                header("Location: ../../views/modules/LearningResult/create.php?idLearningResult=".$LearningResult->getIdLearningResult());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/LearningResult/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    //editar una   LearningResult
    static public function edit (){
        try {
            $arrayLearningResult  = array();
            $arrayLearningResult ['idLearningResult'] = $_POST['idLearningResult'];
            $arrayLearningResult ['LearningResult'] = $_POST['LearningResult'];
            $arrayLearningResult ['nameLearningResult'] = $_POST['nameLearningResult'];
            $arrayLearningResult ['durationLearningResult'] = $_POST['durationLearningResult'];
            $arrayLearningResult ['statuLearningResult'] = $_POST['statuLearningResult'];
            $arrayLearningResult['TrainingCompetition_idTrainingCompetition'] = TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $LearningResult = new LearningResult($arrayLearningResult );
            $LearningResult->update();

            header("Location: ../../views/modules/LearningResult/show.php?idLearningResult=".$LearningResult->getIdLearningResult()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //var_dump($e);
            header("Location: ../../views/modules/LearningResult/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Ictivo
    static public function activate (){
        try {
            $LearningResult = LearningResult::searchForId($_GET['idLearningResult']);
            $LearningResult->setIdLearningResult("Activo");
            if($LearningResult->update()){
                header("Location: ../../views/modules/LearningResult/index.php");
            }else{
                header("Location: ../../views/modules/LearningResult/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //var_dump($e);
            header("Location: ../../views/modules/LearningResult/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $LearningResult  = LearningResult::searchForId($_GET['idLearningResult']);
            $LearningResult ->setIdLearningResult("Inactivo");
            if($LearningResult ->update()){
                header("Location: ../../views/modules/LearningResult/index.php");
            }else{
                header("Location: ../../views/modules/LearningResult/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/LearningResult/index.php?respuesta=error");
        }
    }
//Buscar por id
    static public function searchForID ($idLearningResult){
        try {
            return LearningResult::searchForId($idLearningResult);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/LearningResult/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return LearningResult::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/LearningResult/manager.php?respuesta=error");
        }
    }
}
