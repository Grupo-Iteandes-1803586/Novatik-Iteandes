<?php

namespace  App\Controllers;

require_once (__DIR__.'/../Models/TrainingCompetition.php');
require_once (__DIR__.'/../Models/Group.php');

use App\Models\TrainingCompetition;
use App\Models\Group;
use App\Models\TrainingProgram;

if(!empty($_GET['action'])){
    GroupControllers::main($_GET['action']);
}

class GroupControllers{
    static function main($action){
        if ($action == "create") {
            GroupControllers::create();
        } else if ($action == "edit") {
            GroupControllers::edit();
        } else if ($action == "searchForID") {
            GroupControllers::searchForID($_REQUEST['idGroup']);
        } else if ($action == "searchAll") {
            GroupControllers::getAll();
        } else if ($action == "activate") {
            GroupControllers::activate();
        } else if ($action == "inactivate") {
            GroupControllers::inactivate();
        }
    }
//Crear un grupo
    static public function create()
    {
        try {
            $arrGroup = array();
            $arrGroup['codeGroup']=$_POST['codeGroup'];
            $arrGroup['nameGroup']=$_POST['nameGroup'];
            $arrGroup['minimumSpaceGroup']=$_POST['minimumSpaceGroup'];
            $arrGroup['maximumSpaceGroup']=$_POST['maximumSpaceGroup'];
            $arrGroup['stateGroup']= 'Activo';
            $arrGroup['TrainingCompetition_idTrainingCompetition']= TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $group = new Group();
            if($arrGroup->create()){
                header("Location: ../../views/modules/Group/show.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Editar un Grupo
    static public function edit (){
        try {
            $arrGroup = array();
            $arrGroup['idGroup']=$_POST['idGroup'];
            $arrGroup['codeGroup']=$_POST['codeGroup'];
            $arrGroup['nameGroup']=$_POST['nameGroup'];
            $arrGroup['minimumSpaceGroup']=$_POST['minimumSpaceGroup'];
            $arrGroup['maximumSpaceGroup']=$_POST['maximumSpaceGroup'];
            $arrGroup['stateGroup']= 'Activo';
            $arrGroup['TrainingCompetition_idTrainingCompetition']= TrainingCompetition::searchForId($_POST['TrainingCompetition_idTrainingCompetition']);
            $group = new Group();
            $group->update();

            header("Location: ../../views/modules/Group/show.php?idGroup=".$group->getIdGroup()."&respuesta=correcto");
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Estado activo
    static public function activate (){
        try {
            $ObjGroup = Group::searchForId($_GET['idGroup']);
            $ObjGroup->setStateGroup('Activo');
            if($ObjGroup->update()){
                header("Location: ../../views/modules/Group/index.php");
            }else{
                header("Location: ../../views/modules/Group/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $group  = Group::searchForId($_GET['idGroup']);
            $group ->setStateGroup("Inactivo");
            if($group ->update()){
                header("Location: ../../views/modules/Group/index.php");
            }else{
                header("Location: ../../views/modules/Group/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            // GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Group/index.php?respuesta=error");
        }
    }
    static public function searchForID ($idGroup){
        try {
            return Group::searchForId($idGroup);
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Group/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Group::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Group/manager.php?respuesta=error");
        }
    }
}