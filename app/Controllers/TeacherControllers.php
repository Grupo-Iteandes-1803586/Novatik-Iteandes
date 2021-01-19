<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Teacher.php');
require_once(__DIR__.'/../Models/Experience.php');
require_once(__DIR__.'/../Models/TeacherStudies.php');
require_once(__DIR__.'/../Models/Person.php');

use App\Models\Teacher;
use App\Models\Experience;
use App\Models\TeacherStudies;
use App\Models\Person;

if(!empty($_GET['action'])){
    TeacherControllers::main($_GET['action']);
}
class TeacherControllers
{

    static function main($action)
    {
        if ($action == "create") {
            TeacherControllers::create();
        } else if ($action == "edit") {
            TeacherControllers::edit();
        } else if ($action == "searchForID") {
            TeacherControllers::searchForID($_REQUEST['idTeacher']);
        } else if ($action == "searchAll") {
            TeacherControllers::getAll();
        }
    }

    static public function create()
    {
        try {
            $arrayTeacher = array();
            $arrayTeacher['Experience_idExperience'] = Experience::searchForId($_POST['Experience_idExperience']);
            $arrayTeacher['TeacherStudies_idTeacherStudies'] = TeacherStudies::searchForId($_POST['TeacherStudies_idTeacherStudies']);
            $arrayTeacher['Person_idPerson'] = Person ::searchForId ($_POST['Person_idPerson']);
            $arrayTeacher['stateTeacher'] = 'Activo';
            $Teacher= new Teacher($arrayTeacher);
            if($Teacher->create()){
                header("Location: ../../views/modules/Person/Teacher/show.php?respuesta=correcto");
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    //Editar un Teacher
    static public function edit (){
        try {
            $arrayTeacher = array();
            $arrayTeacher['Experience_idExperience'] = Experience::searchForId($_POST['Experience_idExperience']);
            $arrayTeacher['TeacherStudies_idTeacherStudies'] = TeacherStudies::searchForId($_POST['TeacherStudies_idTeacherStudies']);
            $arrayTeacher['Person_idPerson'] = Person ::searchForId ($_POST['Person_idPerson']);
            $arrayTeacher['stateTeacher'] = $_POST['stateTeacher'];
            $arrayTeacher['idTeacher'] = $_POST['idTeacher'];

            $Teacher = new Teacher( $arrayTeacher);
            $Teacher->update();

            header("Location: ../../views/modules/Person/Teacher/show.php?idTeacher=".$Teacher->getIdTeacher()."&respuesta=correcto");
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Teacher/edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    static public function searchForID ($idTeacher){
        try {
            return Teacher::searchForId($idTeacher);
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            //header("Location: ../../views/modules/Person/Teacher/manager.php?respuesta=error");
        }
    }
    static public function getAll (){
        try {
            return Teacher::getAll();
        } catch (\Exception $e) {
            //GeneralFunctions::console( $e, 'log', 'errorStack');
            header("Location: ../Vista/modules/Person/Teacher/manager.php?respuesta=error");
        }
    }

//Seleccion de Docente
    private static function teacherIsInArray($idTeacher, $ArrTeacher){
        if(count($ArrTeacher) > 0){
            foreach ($ArrTeacher as $teacher){
                if($teacher->getIdTeacher() == $idTeacher){
                    return true;
                }
            }
        }
        return false;
    }

    static public function selectTeacher ($isMultiple=false,
                                              $isRequired=true,
                                              $id="idTeacher",
                                              $nombre="idTeacher",
                                              $defaultValue="",
                                              $class="form-control",
                                              $where="",
                                              $arrExcluir = array()){
        $ArrTeacher = array();
        if($where != ""){
            $base = "SELECT * FROM Teacher WHERE ";
            $ArrTeacher = Teacher::search($base.' '.$where);
        }else{
            $ArrTeacher = Teacher::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($ArrTeacher) > 0){
            foreach ($ArrTeacher as $teacher)
                if (!TeacherControllers::teacherIsInArray($teacher->getIdTeacher(),$arrExcluir))
                    $htmlSelect .= "<option ".(($teacher != "") ? (($defaultValue == $teacher->getIdTeacher()) ? "selected" : "" ) : "")." value='".$teacher->getIdTeacher()."'>".$teacher->getPersonIdPerson()->getNamePerson()." ".$teacher->getPersonIdPerson()->getLastNamePerson()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

}