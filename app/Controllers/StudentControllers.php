<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Student.php');
require_once(__DIR__.'/../Models/Person.php');

use App\Models\Student;
use App\Models\Person;

//Metodo Get para recibir la accion
if(!empty($_GET['action'])){
    StudentControllers::main($_GET['action']);
}
//Cracion de la clase
class StudentControllers
{
    //Metodo main
    static function main($action)
    {
        if ($action == "create") {
            StudentControllers::create();
        } else if ($action == "edit") {
            StudentControllers::edit();
        } else if ($action == "searchForId") {
            StudentControllers::searchForId($_REQUEST['idStudent']);
        } else if ($action == "getAll") {
            StudentControllers::getAll();
        } else if ($action == "active") {
            StudentControllers::active();
        } else if ($action == "inactive") {
            StudentControllers::inactive();
        }
    }
    static public function create()
    {
        try {
            $arrayStudent = array();
            $arrayStudent['gradeYear'] = $_POST['gradeYear'];
            $arrayStudent['modality'] = $_POST['modality'];
            $arrayStudent['Institution'] = $_POST['Institution'];
            $arrayStudent['Person_idPerson'] = Student::searchForId($_POST['Person_idPerson']);
            $arrayStudent['stateStudent'] = 'Activo';
            $student = new Student($arrayStudent);
            if($student->create()){
                header("Location: ../../views/modules/Person/Student/index.php?idStudent=".$student->getIdStudent());
            }
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Student/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
    static public function edit()
    {
        try {
            $arrayStudent = array();
            $arrayStudent['idStudent'] = $_POST['idStudent'];
            $arrayStudent['gradeYear'] = $_POST['gradeYear'];
            $arrayStudent['modality'] = $_POST['modality'];
            $arrayStudent['Institution'] = $_POST['Institution'];
            $arrayStudent['Person_idPerson'] = Student::searchForId($_POST['Person_idPerson']);
            $arrayStudent['stateStudent'] = $_POST['stateStudent'];
            $student = new Student($arrayStudent);
            $student->update();
            header("Location: ../../views/modules/Person/Student/show.php?idStudent=".$student->getIdStudent()."&respuesta=correcto");
        } catch (Exception $e) {
            //GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/Person/Student/edit.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    //Creacion del la funcion eliminar o cambiar estado
    public function delete($idStudent) : bool{
        $student = Student::searchForId($idStudent); //Buscando un Programa por el ID
        $student->setStateStudent("Inactivo"); //Cambia el estado del Programa
        return $student->update();
    }

    //Funcion Activar
    static public function active(){
        try{
            $ObjStudent = Student::searchForId($_GET['idStudent']);
            $ObjStudent->setStateStudent('Activo');
            if($ObjStudent->update()){
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $e){
            header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }

    //Funcion Inactivo on
    static public function inactive(){
        try{
            $ObjStudent = Student::searchForId($_GET['idStudent']);
            $ObjStudent->setStateStudent('Inactivo');
            if($ObjStudent->update()){
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $e){
            header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }

    //Funcion buscar por Id
    static public function searchForId($idStudent){
        try{
            return Student::searchForId($idStudent);
        }catch (\Exception $e){
            var_dump($e);
            //header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
    //Funcion buscar toda la informacion
    static public function getAll(){
        try{
            return TrainingProgram::getAll();
        }catch (\Exception $e){
            var_dump($e);
            //header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }
}