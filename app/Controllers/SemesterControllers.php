<?php

namespace App\Controllers;
require_once(__DIR__.'/../Models/Semester.php');
use App\Models\Semester;
use mysql_xdevapi\Exception;
use Carbon\Carbon;

//Metodo POST para recibir la accion
if(!empty($_GET['action'])){
    SemesterControllers::main($_GET['action']);
}
//Creacion de la clase

class SemesterControllers{
    //Metodo Main
    static function  main($action){
        if($action == "create"){
            SemesterControllers::create();
        }else if($action == "edit"){
            SemesterControllers::edit();
        }else if($action == "searchForId"){
            SemesterControllers::searchForId($_REQUEST['$idSemester']);
        }else if($action == "getAll"){
            SemesterControllers::getAll();
        }else if($action == "active"){
            SemesterControllers::active();
        }else if($action =="inactive"){
            SemesterControllers::inactive();
    }
}
    //Funcion create Semestre
    static public function create(){
        //var_dump($_POST);
        try{
            $arraySemeste = array();
            $arraySemeste['nameSemester'] = $_POST['nameSemester'];
            $arraySemeste['descriptionSemester'] = $_POST['descriptionSemester'];
            $arraySemeste['starDateSemester'] = Carbon::parse($_POST['starDateSemester']);
            $arraySemeste['endDateSemester'] = Carbon::parse($_POST['endDateSemester']);
            $arraySemeste['startDate50'] = Carbon::parse($_POST['startDate50']);
            $arraySemeste['endDate50'] = Carbon::parse($_POST['endDate50']);
            $arraySemeste['starDate2Semester'] = Carbon::parse($_POST['starDate2Semester']) ;
            $arraySemeste['endDate2Semester'] = Carbon::parse($_POST['endDate2Semester']) ;
            $arraySemeste['statuSemester'] ='Activo';
            //Validacion del registro del semestre
            $semester = new Semester($arraySemeste);
            if($semester->create()){
                header("Location: ../../views/modules/Semester/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Semester/create.php?respuesta=error&mensaje=Semestre no Registrado");
            }
        }catch(Exception $ex){
            header("Location: ../../views/modules/Semester/create.php?respuesta=error&mensaje" . $ex-> getMessage());
        }
    }
    //Funcion Edit Semester
    static public function edit(){
        try{
            $arraySemeste = array();
            $arraySemeste['nameSemester'] = $_POST['nameSemester'];
            $arraySemeste['descriptionSemester'] = $_POST['descriptionSemester'];
            $arraySemeste['starDateSemester'] = Carbon::parse($_POST['starDateSemester']);
            $arraySemeste['endDateSemester'] = Carbon::parse($_POST['endDateSemester']);
            $arraySemeste['startDate50'] = Carbon::parse($_POST['startDate50']);
            $arraySemeste['endDate50'] = Carbon::parse($_POST['endDate50']);
            $arraySemeste['starDate2Semester'] = Carbon::parse($_POST['starDate2Semester']) ;
            $arraySemeste['endDate2Semester'] = Carbon::parse($_POST['endDate2Semester'] );
            $arraySemeste['statuSemester'] =$_POST['statuSemester'];
            $arraySemeste['idSemester'] = $_POST['idSemester'];

            $semester =  new Semester($arraySemeste);
            $semester->update();
            header ("Location: ../../views/modules/Semester/show.php?idSemester=".$semester->getIdSemester()."&respuesta=correcto");
        }catch (\Exception $ex){
            var_dump($ex);
            //header("Location: ../../views/modules/Semester/edit.php?respuesta=error&mensaje" . $ex-> getMessage());
        }
    }

    //Funcion de activacion del estado
    static public function active(){
        try{
            $ObjSemester = Semester::searchForId($_GET['idSemester']);
            $ObjSemester->setStatuSemester('Activo');
            if($ObjSemester->update()){
                header("Location: ../../views/modules/Semester/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Semester/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $ex){
            header("Location: ../../views/modules/Semester/index.php?respuesta=error&mensaje" . $ex-> getMessage());
        }
    }
    //Funcion de inactivado del estado
    static public function inactive(){
        try{
            $ObjSemester = Semester::searchForId($_GET['idSemester']);
            $ObjSemester->setStatuSemester('Inactivo');
            if($ObjSemester->update()){
                header("Location: ../../views/modules/Semester/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Semester/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $ex){
            header("Location: ../../views/modules/Semester/index.php?respuesta=error&mensaje" . $ex-> getMessage());
        }
    }
    //Funcion Buscar pot Id
    static public function  searchForId($idSemester){
        try{
            return Semester::searchForId($idSemester);
        }catch (\Exception $ex){
            var_dump($ex);
            //header("Location: ../../views/modules/Semester/index.php?respuesta=error&mensaje" . $ex-> getMessage());
        }
    }
    //Funcion obtener toda la informacion
    static public function getAll(){
        try{
            return Semester::getAll();
        }catch (\Exception $ex){
            var_dump($ex);
            //header("Location: ../../views/modules/Semester/index.php?respuesta=error&mensaje" . $ex-> getMessage());
        }
    }


//Seleccion de Semestres
    private static function semesterIsInArray($idSemester, $ArrSemester){
        if(count($ArrSemester) > 0){
            foreach ($ArrSemester as $semester){
                if($semester->getIdSemester() == $idSemester){
                    return true;
                }
            }
        }
        return false;
    }
    //Seleccionar una competencia

    static public function selectCompetition ($isMultiple=false,
                                              $isRequired=true,
                                              $id="idSemester",
                                              $nombre="idSemester",
                                              $defaultValue="",
                                              $class="form-control",
                                              $where="",
                                              $arrExcluir = array()){
        $arrSemester = array();
        if($where != ""){
            $base = "SELECT * FROM Semester WHERE ";
            $arrSemester = Semester::search($base.' '.$where);
        }else{
            $arrSemester = TrainingCompetition::getAll();
        }

        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."' style='width: 100%;'>";
        $htmlSelect .= "<option value='' >Seleccione</option>";
        if(count($arrSemester) > 0){
            foreach ($arrSemester as $semester)
                if (!SemesterControllers::semesterIsInArray($semester->getIdSemester(),$arrExcluir))
                    $htmlSelect .= "<option ".(($semester != "") ? (($defaultValue == $semester->getIdSemester()) ? "selected" : "" ) : "")." value='".$semester->getIdSemester()."'>".$semester->getNameSemester()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
}