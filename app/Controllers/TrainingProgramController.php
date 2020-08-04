<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/TrainingProgram.php');
use App\Models\TrainingProgram;
use mysql_xdevapi\Exception;

//Metodo Get para recibir la accion
if(!empty($_GET['action'])){
    TrainingProgramController::main($_GET['action']);
}
//Cracion de la clase
class TrainingProgramController{
    //Metodo main
    static function main($action){
        if($action == "create"){
            TrainingProgramController::create();
        }else if($action == "edit"){
            TrainingProgramController::edit();
        }else if($action == "searchForId"){
            TrainingProgramController::searchForId($_REQUEST['$idTrainingProgram']);
        }else if($action == "getAll"){
            TrainingProgramController::getAll();
        }else if($action == "active"){
            TrainingProgramController::active();
        }else if($action =="inactive"){
            TrainingProgramController::inactive();
        }
    }
    //Funcion create del programa de formacion
    static public function create(){
        try{
            $arrayProgram= array();
            $arrayProgram['codeTrainingProgram'] =$_POST['codeTrainingProgram'];
            $arrayProgram['codeAlfaTrainingProgram'] =$_POST['codeAlfaTrainingProgram'];
            $arrayProgram['nameTrainingProgram'] = $_POST['nameTrainingProgram'];
            $arrayProgram['version'] = $_POST['version'];
            $arrayProgram['statusTrainingProgram'] = 'Activo';
            //Validacion del registro del programma de formacion
            if(!TrainingProgram::codeRegistration($arrayProgram['codeTrainingProgram'])){
                $program = new TrainingProgram($arrayProgram);
                if($program->create()){
                    header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=correcto");
                }else{
                    header("Location: ../../views/modules/TrainningProgram/create.php?respuesta=error&mensaje=Programa de formacion ya registrado");
                }


            }

        }catch (\Exception $e){
            header("Location: ../../views/modules/TrainningProgram/create.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
    //Funcion Edit del programa de formacion
    static public function edit(){
        try{
            $arrayProgram= array();
            $arrayProgram['codeTrainingProgram'] =$_POST['codeTrainingProgram'];
            $arrayProgram['codeAlfaTrainingProgram'] =$_POST['codeAlfaTrainingProgram'];
            $arrayProgram['nameTrainingProgram'] = $_POST['nameTrainingProgram'];
            $arrayProgram['version'] = $_POST['version'];
            $arrayProgram['statusTrainingProgram'] = $_POST['statusTrainingProgram'];
            $arrayProgram['idTrainingProgram'] = $_POST['idTrainingProgram'];

            $traProgram = new TrainingProgram($arrayProgram);
            $traProgram->update();
            header ("Location: ../../views/modules/TrainningProgram/show.php?idTrainingProgram=".$traProgram->getIdTrainingProgram()."&respuesta=correcto");
        }catch (Exception $e){
            header("Location: ../../views/modules/TrainningProgram/edit.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }

    //Funcion Activar estado del  programa de formacion
    static public function active(){
        try{
            $ObjTrainingP = TrainingProgram::searchForId($_GET['idTrainingProgram']);
            $ObjTrainingP->setStatusTrainingProgram('Activo');
            if($ObjTrainingP->update()){
                header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $e){
            header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
    //Funcion Inactivo del Programa de Formacion
    static public function inactive(){
        try{
            $ObjTrainingP = TrainingProgram::searchForId($_GET['idTrainingProgram']);
            $ObjTrainingP->setStatusTrainingProgram('Inactivo');
            if($ObjTrainingP->update()){
                header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $e){
            header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
    //Funcion buscar por Id
    static public function searchForId($idTrainingProgram){
        try{
            return TrainingProgram::searchForId($idTrainingProgram);
        }catch (\Exception $e){
            var_dump($e);
            //header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
    //Funcion buscar toda la informacion
    static public function getAll(){
        try{
            return TrainingProgram::getAll();
        }catch (\Exception $e){
            var_dump($e);
            //header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }



//Seleccion de Semestres
    private static function programIsInArray($idTrainingProgram, $ArrProgram){
        if(count($ArrProgram) > 0){
            foreach ($ArrProgram as $program){
                if($program->getIdTrainingProgram() == $idTrainingProgram){
                    return true;
                }
            }
        }
        return false;
    }
    //Seleccionar una competencia

    static public function selectCompetition ($isMultiple=false,
                                              $isRequired=true,
                                              $id="idTrainingProgram",
                                              $nombre="idTrainingProgram",
                                              $defaultValue="",
                                              $class="form-control",
                                              $where="",
                                              $arrExcluir = array()){
        $ArrProgram = array();
        if($where != ""){
            $base = "SELECT * FROM trainingprogram WHERE ";
            $ArrProgram = TrainingProgram::search($base.' '.$where);
        }else{
            $ArrProgram = TrainingProgram::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($ArrProgram) > 0){
            foreach ($ArrProgram as $program)
                if (!TrainingProgramController::programIsInArray($program->getIdTrainingProgram(),$arrExcluir))
                    $htmlSelect .= "<option ".(($program != "") ? (($defaultValue == $program->getIdTrainingProgram()) ? "selected" : "" ) : "")." value='".$program->getIdTrainingProgram()."'>".$program->getNameTrainingProgram()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
}
