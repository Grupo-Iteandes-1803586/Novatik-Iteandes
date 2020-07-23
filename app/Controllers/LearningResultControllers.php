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
}
