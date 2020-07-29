<?php
namespace App\Controllers;
require_once (__DIR__.'/../Models/Note.php');
require_once (__DIR__.'/../Models/Teacher.php');
require_once (__DIR__.'/../Models/Activity.php');

use App\Models\Note;
use App\Models\Teacher;
use App\Models\Activity;
use Carbon\Carbon;

if(!empty($_GET['action'])){
    NoteControllers::main($_GET['action']);
}

class NoteControllers{
    static function main($action){
        if ($action == "create") {
            NoteControllers::create();
        } else if ($action == "edit") {
            NoteControllers::edit();
        } else if ($action == "searchForID") {
            NoteControllers::searchForID($_REQUEST['idNote']);
        } else if ($action == "searchAll") {
            NoteControllers::getAll();
        } else if ($action == "activate") {
            NoteControllers::activate();
        } else if ($action == "inactivate") {
            NoteControllers::inactivate();
        }
    }

    //Crear una nota
    static public function create()
    {
        try {
            $arrayNote['dateNote'] = Carbon::now(); //Fecha Actual;
            $arrayNote['valueNote'] = $_POST['valueNote'];
            $arrayNote['Activity_idActivity'] = Activity::searchForId($_POST['Activity_idActivity']);
            $arrayNote['Teacher_idTeacher'] = Teacher::searchForId($_POST['Teacher_idTeacher']);
            $arrayNote['stateNote'] = 'Activo';
            $Note = new Note($arrayNote);

            if ($Note->create()) {
                header("Location: ../../views/modules/Note/create.php?idNote=" . $Note->getIdNote());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Editar un Note
    static public function edit (){
        try {
            $arrayNote['idNote'] = $_POST['idNote'];
            $arrayNote['dateNote'] = Carbon::now(); //Fecha Actual;
            $arrayNote['valueNote'] = $_POST['valueNote'];
            $arrayNote['Activity_idActivity'] = Activity::searchForId($_POST['Activity_idActivity']);
            $arrayNote['Teacher_idTeacher'] = Teacher::searchForId($_POST['Teacher_idTeacher']);
            $arrayNote['stateNote'] = $_POST['stateNote'];
            $Note = new Note($arrayNote);
            $Note->update();

            header("Location: ../../views/modules/Note/show.php?respuesta=correcto");
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Note/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    //Estado activo
    static public function activate (){
        try {
            $ObjNote = Note::searchForId($_GET['idNote']);
            $ObjNote->setStateNote('Activo');
            if($ObjNote->update()){
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
            $note  = Note::searchForId($_GET['idNote']);
            $note ->setStateNote("Inactivo");
            if($note ->update()){
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
    static public function searchForID ($idNote){
        try {
            return Note::searchForId($idNote);
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Note/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Note::getAll();
        } catch (\Exception $e) {
            GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Note/manager.php?respuesta=error");
        }
    }
}