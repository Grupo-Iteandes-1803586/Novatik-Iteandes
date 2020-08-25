<?php

namespace App\Controllers;

require_once(__DIR__.'/../Models/TrainingProgram.php');
require_once(__DIR__.'/../Models/GeneralFunctions.php');
require_once(__DIR__.'/../Models/TrainingCompetition.php');
use App\Models\GeneralFunctions;
use App\Models\TrainingCompetition;
use App\Models\TrainingProgram;

if(!empty($_GET['action'])){
    TrainingCompetitionControllers::main($_GET['action']);
}
class TrainingCompetitionControllers{

    static function main($action){
        if ($action == "create") {
            TrainingCompetitionControllers::create();
        } else if ($action == "edit") {
            TrainingCompetitionControllers::edit();
        } else if ($action == "searchForID") {
            TrainingCompetitionControllers::searchForID($_REQUEST['idTrainingCompetition']);
        } else if ($action == "searchAll") {
            TrainingCompetitionControllers::getAll();
        } else if ($action == "activate") {
            TrainingCompetitionControllers::activate();
        } else if ($action == "inactivate") {
            TrainingCompetitionControllers::inactivate();
        }
    }


    //metodo crear
    static public function create()
    {
        try {
            $arrayTrainingCompetition = array();
            $arrayTrainingCompetition['codeTrainingCompetition']= $_POST['codeTrainingCompetition'];
            $arrayTrainingCompetition['codeAlfaTrainingCompetition']= $_POST['codeAlfaTrainingCompetition'];
            $arrayTrainingCompetition['denomination']= $_POST['denomination'];
            $arrayTrainingCompetition['duration']= $_POST['duration'];
            $arrayTrainingCompetition['minimumSpace']= $_POST['minimumSpace'];
            $arrayTrainingCompetition['orderTrainingCompetition']= $_POST['orderTrainingCompetition'];
            $arrayTrainingCompetition['statusTrainingCompetition'] = 'Activo';
            $arrayTrainingCompetition['TrainingProgram_idTrainingProgram']= TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
            $competition = new TrainingCompetition($arrayTrainingCompetition);
            if($competition->create()){
                header("Location: ../../views/modules/TrainingCompetition/create.php?idTrainingProgram=".$competition->getTrainingProgramIdTrainingProgram()->getIdTrainingProgram());
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/TrainingCompetition/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Editar una Competencia
    static public function edit (){
        try {
            $arrayTrainingCompetition = array();
            $arrayTrainingCompetition['codeTrainingCompetition']= $_POST['codeTrainingCompetition'];
            $arrayTrainingCompetition['codeAlfaTrainingCompetition']= $_POST['codeAlfaTrainingCompetition'];
            $arrayTrainingCompetition['denomination']= $_POST['denomination'];
            $arrayTrainingCompetition['duration']= $_POST['duration'];
            $arrayTrainingCompetition['minimumSpace']= $_POST['minimumSpace'];
            $arrayTrainingCompetition['orderTrainingCompetition']= $_POST['orderTrainingCompetition'];
            $arrayTrainingCompetition['statusTrainingCompetition'] = $_POST['statusTrainingCompetition'];
            $arrayTrainingCompetition['TrainingProgram_idTrainingProgram']= TrainingProgram::searchForId($_POST['TrainingProgram_idTrainingProgram']);
            $arrayTrainingCompetition['idTrainingCompetition']= $_POST['idTrainingCompetition'];
            $competition = new TrainingCompetition($arrayTrainingCompetition);
            $competition->update();

            header("Location: ../../views/modules/TrainingCompetition/show.php?idTrainingCompetition=".$competition->getIdTrainingCompetition()."&respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/TrainingCompetition/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Estado activo
    static public function activate (){
        try {
            $ObjTraininC = TrainingCompetition::searchForId($_GET['idTrainingCompetition']);
            $ObjTraininC->setStatusTrainingCompetition('Activo');
            if($ObjTraininC->update()){
                header("Location: ../../views/modules/TrainingCompetition/index.php");
            }else{
                header("Location: ../../views/modules/TrainingCompetition/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/TrainingCompetition/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $TrainigCompetition  = TrainingCompetition::searchForId($_GET['idTrainingCompetition']);
            $TrainigCompetition ->setStatusTrainingCompetition("Inactivo");
            if($TrainigCompetition ->update()){
                header("Location: ../../views/modules/TrainingCompetition/index.php");
            }else{
                header("Location: ../../views/modules/TrainingCompetition/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/TrainingCompetition/index.php?respuesta=error");
        }
    }
    //Buscar popr id
    static public function searchForID ($idTrainingCompetition){
        try {
            return TrainingCompetition::searchForId($idTrainingCompetition);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/TrainingCompetition/manager.php?respuesta=error");
        }
    }
    //Obtener toda la informacion de la tabla
    static public function getAll (){
        try {
            return TrainingCompetition::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/TrainingCompetition/manager.php?respuesta=error");
        }
    }
//Seleccion de Competencias
    private static function competitionIsInArray($idTrainingCompetition, $ArrCompetition){
        if(count($ArrCompetition) > 0){
            foreach ($ArrCompetition as $competition){
                if($competition->getIdTrainingCompetition() == $idTrainingCompetition){
                    return true;
                }
            }
        }
        return false;
    }
    //Seleccionar una competencia

    static public function selectCompetition ($isMultiple=false,
                                          $isRequired=true,
                                          $id="idTrainingCompetition",
                                          $nombre="idTrainingCompetition",
                                          $defaultValue="",
                                          $class="form-control",
                                          $where="",
                                          $arrExcluir = array()){
        $arrCompetition = array();
        if($where != ""){
            $base = "SELECT * FROM TrainingCompetition WHERE ";
            $arrCompetition = TrainingCompetition::search($base.' '.$where);
        }else{
            $arrCompetition = TrainingCompetition::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrCompetition) > 0){
            foreach ($arrCompetition as $competition)
                if (!TrainingCompetitionControllers::competitionIsInArray($competition->getIdTrainingCompetition(),$arrExcluir))
                    $htmlSelect .= "<option ".(($competition != "") ? (($defaultValue == $competition->getIdTrainingCompetition()) ? "selected" : "" ) : "")." value='".$competition->getIdTrainingCompetition()."'>".$competition->getDenomination()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

}
