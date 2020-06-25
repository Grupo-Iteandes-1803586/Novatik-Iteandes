<?php
namespace App\Controllers;
require(__DIR__.'/../Models/TrainingProgram.php');
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
            $arrayProgram['codeTrainingProgram'] =$_POST['$codeTrainingProgram'];
            $arrayProgram['nameTrainingProgram'] = $_POST['$nameTrainingProgram'];
            $arrayProgram['version'] = $_POST['$version'];
            $arrayProgram['statusTrainingProgram'] = 'Activo';
            //Validacion del registro del programma de formacion
            $program = new TrainingProgram($arrayProgram);
            if($program->create()){
                header("Location: ../../views/modules/TrainningProgram/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/TrainningProgram/create.php?respuesta=error&mensaje=Programa de Formacion no Registrado");
            }
        }catch (\Exception $e){
            header("Location: ../../views/modules/TrainningProgram/create.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
    //Funcion Edit del programa de formacion
    static public function edit(){
        try{
            $arrayProgram= array();
            $arrayProgram['codeTrainingProgram'] =$_POST['$codeTrainingProgram'];
            $arrayProgram['nameTrainingProgram'] = $_POST['$nameTrainingProgram'];
            $arrayProgram['version'] = $_POST['$version'];
            $arrayProgram['statusTrainingProgram'] = $_POST['statusTrainingProgram'];
            $arrayProgram['$idTrainingProgram'] = $_POST['$idTrainingProgram'];

            $traProgram = new TrainingProgram($arrayProgram);
            $traProgram->update();
            header ("Location: ../../views/modules/TrainingProgram/show.php?id=".$traProgram->getIdTrainingProgram()."&respuesta=correcto");
        }catch (Exception $e){
            header("Location: ../../views/modules/TrainningProgram/edit.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }

    //Funcion Activar estado del  programa de formacion
    static public function active(){
            try{
                $ObjTrainingP = TrainingProgram::searchForId($_GET['$idTrainingProgram']);
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
            $ObjTrainingP = TrainingProgram::searchForId($_GET['$idTrainingProgram']);
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
}
