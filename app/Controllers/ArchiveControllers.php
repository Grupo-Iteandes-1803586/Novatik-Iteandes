<?php
namespace App\Controllers;
require_once (__DIR__.'/../Models/Archive.php');
require_once (__DIR__.'/../Models/Activity.php');
use App\Models\Archive;
use App\Models\Activity;

if(!empty($_GET['action'])){
    ArchiveControllers::main($_GET['action']);
}
class ArchiveControllers
{
    static function main($action)
    {
        if ($action == "create") {
            ArchiveControllers::create();
        } else if ($action == "edit") {
            ArchiveControllers::edit();
        } else if ($action == "searchForID") {
            ArchiveControllers::searchForID($_REQUEST['idArchive']);
        } else if ($action == "searchAll") {
            ArchiveControllers::getAll();
        } else if ($action == "activate") {
            ArchiveControllers::activate();
        } else if ($action == "inactivate") {
            ArchiveControllers::inactivate();
        }
    }
    //Crear una Archive
    static public function create()
    {
        try {
            $arrayArchive['nameArchive'] = $_POST['nameArchive'];
            $arrayArchive['descriptionArchive'] = $_POST['descriptionArchive'];
            $arrayArchive['rutaArchive'] = $_POST['rutaArchive'];
            $arrayArchive['Activity_idActivity'] = Activity::searchForId($_POST['Activity_idActivity']);
            $arrayArchive['stateArchive'] = 'Activo';
            $Archive = new Archive($arrayArchive);

            if ($Archive->create()) {
                header("Location: ../../views/modules/Note/create.php?idArchive=" . $Archive->getIdNote());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    //Editar un Archive
    static public function edit (){
        try {
            $arrayArchive['idArchive'] = $_POST['idArchive'];
            $arrayArchive['nameArchive'] = $_POST['nameArchive'];
            $arrayArchive['descriptionArchive'] = $_POST['descriptionArchive'];
            $arrayArchive['rutaArchive'] = $_POST['rutaArchive'];
            $arrayArchive['Activity_idActivity'] = Activity::searchForId($_POST['Activity_idActivity']);
            $arrayArchive['stateArchive'] = $_POST['stateNote'];
            $Archive = new Archive ($arrayArchive);
            $Archive->update();

            header("Location: ../../views/modules/Note/show.php?respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Estado activo
    static public function activate (){
        try {
            $ObjArchive = Archive::searchForId($_GET['idArchive']);
            $ObjArchive->setStateArchive('Activo');
            if($ObjArchive->update()){
                header("Location: ../../views/modules/Note/index.php");
            }else{
                header("Location: ../../views/modules/Note/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    ///Estado Inactivo
    static public function inactivate (){
        try {
            $Archive  = Archive::searchForId($_GET['idArchive']);
            $Archive ->setStateArchive("Inactivo");
            if($Archive ->update()){
                header("Location: ../../views/modules/Note/index.php");
            }else{
                header("Location: ../../views/modules/Note/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/index.php?respuesta=error");
        }
    }
    //Buscar por id
    static public function searchForID ($idArchive){
        try {
            return Archive::searchForId($idArchive);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Note/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Archive::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Note/manager.php?respuesta=error");
        }
    }
}
