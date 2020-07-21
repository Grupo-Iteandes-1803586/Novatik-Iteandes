<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Person.php') ;
require(__DIR__.'/../Models/Experience.php') ;
require(__DIR__.'/../Models/Lenguages.php') ;
require(__DIR__.'/../Models/TeacherStudies.php') ;
require(__DIR__.'/../Models/Student.php') ;
require(__DIR__.'/../Models/Teacher.php') ;
require(__DIR__.'/../Models/TeacherLenguages.php') ;

use App\Models\Experience;
use App\Models\Lenguages;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\TeacherLenguages;
use App\Models\TeacherStudies;
use App\Models\Student;
use mysql_xdevapi\Exception;

//Metodo Get para recibir la accion
if(!empty($_GET['action'])){
    PersonController::main($_GET['action']);
}

//Creacion de la clase
class PersonController{
    //Metodo main
    static function main($action){
        //Acciones de la clase Teacher
        if($action == "create"){
            PersonController::create();
        }else if($action == "edit"){
            PersonController::edit();
        }else if($action == "searchForId"){
            PersonController::searchForId($_REQUEST['$idPerson']);
        }else if($action == "getAll"){
            PersonController::getAll();
        }else if($action == "active"){
            PersonController::active();
        }else if($action =="inactive"){
            PersonController::inactive();
        }
        //Acciones de la clase Students
        if($action == "createStudent"){
            PersonController::createStudent();
        }else if($action == "editStudent"){
            PersonController::editStudent();
        }else if($action == "searchForIdStudent"){
            PersonController::searchForIdStudent($_REQUEST['idStudent']);
        }else if($action == "getAllStudent"){
            PersonController::getAllStudent();
        }else if($action == "activeStudent"){
            PersonController::activeStudent();
        }else if($action =="inactiveStudent"){
            PersonController::inactiveStudent();
        }
    }
    //Funcion crear persona
    static public function create(){
        try{
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
            $arrayPerson['lastNamePerson'] = $_POST['lastNamePerson'];
            $arrayPerson['dateBornPerson']= $_POST['dateBornPerson'];
            $arrayPerson['rhPerson'] = $_POST['rhPerson'];
            $arrayPerson['emailPerson'] = $_POST['emailPerson'];
            $arrayPerson['phonePerson'] = $_POST['phonePerson'];
            $arrayPerson['adressPerson'] = $_POST['adressPerson'];
            $arrayPerson['generePerson'] = $_POST['generePerson'];
            $arrayPerson['typePerson'] = 'Docente';
            $arrayPerson['statePerson'] = 'Activo';
            $arrayPerson['photoPerson']= $_POST['photoPerson'];
            //datos de experiencia
            $arrayExperience = array();
            $arrayExperience['institutionExperience'] = $_POST['institutionExperience'];
            $arrayExperience['dedicationExperience'] = $_POST['dedicationExperience'];
            $arrayExperience['startExperience'] = $_POST['startExperience'];
            $arrayExperience['endExperince'] = $_POST['endExperince'];
            $arrayExperience['stateExperience'] = 'Activo';
            $Experience = new Experience($arrayExperience);
            //Datos de estudio
            $arrayTeacherStudies = array();
            $arrayTeacherStudies['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayTeacherStudies['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $arrayTeacherStudies['stateTeacherStudies'] = 'Activo';
            $TeacherStudies = new TeacherStudies($arrayTeacherStudies);
            //Datos de Lenguaje
            $arrayLenguages = array();
            $arrayLenguages['nameLenguages'] = $_POST['nameLenguages'];
            $arrayLenguages['stateLenguague'] = 'Activo';
            $lenguages = new Lenguages($arrayLenguages);

            //Validar registro del Usuario
            if(!Person::userRegistration($arrayPerson['documentPerson'])){
                $person =new Person($arrayPerson);
                if($person->create()){
                    if($Experience->create()) {
                        if($TeacherStudies->create()) {
                            //Datos de Teacher
                            $arrayTeacher = array();
                            $arrayTeacher['Experience_idExperience'] = $Experience;
                            $arrayTeacher['TeacherStudies_idTeacherStudies'] = $TeacherStudies;
                            $arrayTeacher['Person_idPerson'] =$person;
                            $arrayTeacher['stateTeacher'] = 'Activo';
                            $Teacher= new Teacher($arrayTeacher);
                            if($Teacher->create()) {
                                if($lenguages->create()){
                                    $arrayTeacherLenguages = array();
                                    $arrayTeacherLenguages ['Teacher_idTeacher'] =$Teacher;
                                    $arrayTeacherLenguages ['Lenguages_idLenguages'] = $lenguages;
                                    $arrayTeacherLenguages ['stateTeacherLenguages'] = 'Activo';
                                    $TeacherLenguages = new TeacherLenguages($arrayTeacherLenguages);
                                    if ($TeacherLenguages->create()) {
                                        header("Location: ../../views/modules/Person/Teacher/show.php?respuesta=correcto");
                                    }
                                }
                            }
                        }
                    }
                }
            }else{
                header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

  //Funcion Edit de una persona
    static public function edit(){
        try{
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
            $arrayPerson['lastNamePerson'] = $_POST['lastNamePerson'];
            $arrayPerson['dateBornPerson']= $_POST['dateBornPerson'];
            $arrayPerson['rhPerson'] = $_POST['rhPerson'];
            $arrayPerson['emailPerson'] = $_POST['emailPerson'];
            $arrayPerson['phonePerson'] = $_POST['phonePerson'];
            $arrayPerson['adressPerson'] = $_POST['adressPerson'];
            $arrayPerson['generePerson'] = $_POST['generePerson'];
            $arrayPerson['typePerson'] = $_POST['typePerson'];
            $arrayPerson['statePerson'] = $_POST['statePerson'];
            $arrayPerson['photoPerson']= $_POST['photoPerson'];
            $arrayPerson['idPerson']= $_POST['idPerson'];
            $person= new Person($arrayPerson);
            //Datos de la Experiencia
            $arrayExperience = array();
            $arrayExperience['idExperience'] = $_POST['idExperience'];
            $arrayExperience['institutionExperience'] = $_POST['institutionExperience'];
            $arrayExperience['dedicationExperience'] = $_POST['dedicationExperience'];
            $arrayExperience['startExperience'] = $_POST['startExperience'];
            $arrayExperience['endExperince'] = $_POST['endExperince'];
            $arrayExperience['stateExperience'] = $_POST['stateExperience'];;
            $Experience = new Experience($arrayExperience);
            //Datos de estudio
            $arrayTeacherStudies = array();
            $arrayTeacherStudies['idTeacherStudies'] = $_POST['idTeacherStudies'];
            $arrayTeacherStudies['titleTeacherStudies'] = $_POST['titleTeacherStudies'];
            $arrayTeacherStudies['yearStudyTeacher'] = $_POST['yearStudyTeacher'];
            $arrayTeacherStudies['stateTeacherStudies'] =$_POST['stateTeacherStudies'];
            $TeacherStudies = new TeacherStudies($arrayTeacherStudies);
            //Datos de Lenguaje
            $arrayLenguages = array();
            $arrayLenguages['idLenguages'] = $_POST['idLenguages'];
            $arrayLenguages['nameLenguages'] = $_POST['nameLenguages'];
            $arrayLenguages['stateLenguague'] = $_POST['stateLenguague'];
            $lenguages = new Lenguages($arrayLenguages);
            if($person->update()){
                if($Experience->update()) {
                    if($TeacherStudies->update()) {
                        if($lenguages->update()){
                            //Datos del Docente
                            $arrayTeacher = array();
                            $arrayTeacher['Experience_idExperience'] = Experience::searchForId($_POST['Experience_idExperience']);
                            $arrayTeacher['TeacherStudies_idTeacherStudies'] = TeacherStudies::searchForId($_POST['TeacherStudies_idTeacherStudies']);
                            $arrayTeacher['Person_idPerson'] = Person ::searchForId ($_POST['Person_idPerson']);
                            $arrayTeacher['stateTeacher'] = $_POST['stateTeacher'];
                            $arrayTeacher['idTeacher'] = $_POST['idTeacher'];
                            $Teacher = new Teacher( $arrayTeacher);
                            if($Teacher->update()) {
                                $arrayTeacherLenguages = array();
                                $arrayTeacherLenguages['Teacher_idTeacher'] = Teacher::searchForId($_POST['Teacher_idTeacher']);
                                $arrayTeacherLenguages['Lenguages_idLenguages'] = Lenguages::searchForId($_POST['Lenguages_idLenguages']);
                                $arrayTeacherLenguages['stateTeacherLenguages'] = $_POST['stateTeacherLenguages'];
                                $arrayTeacherLenguages['idTeacherLenguages'] = $_POST['idTeacherLenguages'];

                                $TeacherLenguages = new TeacherLenguages( $arrayTeacherLenguages);
                                if ($TeacherLenguages->update()){
                                    header("Location: ../../views/modules/Person/Teacher/show.php?idPerson=".$person->getIdPerson()."&respuesta=correcto");
                                }


                            }
                        }

                    }
                }
            }
        }catch (Exception $exc){
            header("Location: ../../views/modules/Person/Teacher/edit.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }
    //Funcion activo de la Persona
    static public function active(){
        try{
            $ObjPerson = Person::searchForId($_GET['idPerson']);
            $ObjPerson->setStatePerson('Activo');
            if($ObjPerson->update()){
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    //Funcion inactivo de la Persona
    static public function inactive(){
        try{
            $ObjPerson = Person::searchForId($_GET['idPerson']);
            $ObjPerson->setStatePerson('Inactivo');
            if($ObjPerson->update()){
                header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/Teacher/create.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }
    //Funcion obtener por Id de la persona
    static public function searchForId($idPerson){
        try{
            return Person::searchForId($idPerson);
        }catch (\Exception $exc){
            var_dump($exc);
            //header("Location: ../../views/modules/Person/index.php?respuesta=error");
        }
    }

    //Funcion Obtener todas las personas
    static public function getAll(){
        try{
            return Person::getAll();
        }catch (\Exception $exc){
            var_dump($exc);
            //header("Location: ../../views/modules/Person/index.php?respuesta=error");
        }
    }

    //Metodos de la clase Student
    static public function createStudent(){
        try{
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
            $arrayPerson['lastNamePerson'] = $_POST['lastNamePerson'];
            $arrayPerson['dateBornPerson']= $_POST['dateBornPerson'];
            $arrayPerson['rhPerson'] = $_POST['rhPerson'];
            $arrayPerson['emailPerson'] = $_POST['emailPerson'];
            $arrayPerson['phonePerson'] = $_POST['phonePerson'];
            $arrayPerson['adressPerson'] = $_POST['adressPerson'];
            $arrayPerson['generePerson'] = $_POST['generePerson'];
            $arrayPerson['typePerson'] = 'Estudiante';
            $arrayPerson['statePerson'] = 'Activo';
            $arrayPerson['photoPerson']= $_POST['photoPerson'];
            //Validar registro del Usuario
            if(!Person::userRegistration($arrayPerson['documentPerson'])){
                $person =new Person($arrayPerson);
                if($person->create()){
                    //datos del Estudiante
                    $arrayStudent = array();
                    $arrayStudent['gradeYear'] = $_POST['gradeYear'];
                    $arrayStudent['modality'] = $_POST['modality'];
                    $arrayStudent['Institution'] = $_POST['Institution'];
                    $arrayStudent['Person_idPerson'] = Person::searchForId($_POST['Person_idPerson']);
                    $arrayStudent['stateStudent'] = 'Activo';
                    $student = new Student($arrayStudent);
                    if($student->create()) {
                        header("Location: ../../views/modules/Person/Student/index.php?respuesta=correcto");
                    }
                }
            }else{
                header("Location: ../../views/modules/Person/Student/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/Student/create.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    //Funcion Edit del programa de formacion
    static public function editStudent(){
        try {
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
            $arrayPerson['lastNamePerson'] = $_POST['lastNamePerson'];
            $arrayPerson['dateBornPerson'] = $_POST['dateBornPerson'];
            $arrayPerson['rhPerson'] = $_POST['rhPerson'];
            $arrayPerson['emailPerson'] = $_POST['emailPerson'];
            $arrayPerson['phonePerson'] = $_POST['phonePerson'];
            $arrayPerson['adressPerson'] = $_POST['adressPerson'];
            $arrayPerson['generePerson'] = $_POST['generePerson'];
            $arrayPerson['typePerson'] = $_POST['typePerson'];
            $arrayPerson['statePerson'] = $_POST['statePerson'];
            $arrayPerson['photoPerson'] = $_POST['photoPerson'];
            $arrayPerson['idPerson'] = $_POST['idPerson'];
            $person = new Person($arrayPerson);
            if ($person->update()) {
                //datos del Estudiante
                $arrayStudent = array();
                $arrayStudent['gradeYear'] = $_POST['gradeYear'];
                $arrayStudent['modality'] = $_POST['modality'];
                $arrayStudent['Institution'] = $_POST['Institution'];
                $arrayStudent['Person_idPerson'] = Student::searchForId($_POST['Person_idPerson']);
                $arrayStudent['stateStudent'] = $_POST['stateStudent'];
                $arrayStudent['idStudent'] = $_POST['idStudent'];
                $student = new Student($arrayStudent);
                if ($student->update()) {
                    header("Location: ../../views/modules/Person/Student/show.php?respuesta=correcto");
                }
            }
        }catch (Exception $e){
            header("Location: ../../views/modules/TrainningProgram/edit.php?respuesta=error&mensaje" . $e-> getMessage());
        }
    }

    //Funcion activo de la Persona
    static public function activeStudent(){
        try{
            $ObjStudent = Student::searchForId($_GET['idStudent']);
            $ObjStudent->setStateStudent('Activo');
            if($ObjStudent->update()){
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/Student/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    //Funcion inactivo de la Persona
    static public function inactiveStudent(){
        try{
            $ObjStudent = Student::searchForId($_GET['idStudent']);
            $ObjStudent->setStateStudent('Inactivo');
            if($ObjStudent->update()){
                header("Location: ../../views/modules/Person/Student/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/Student/create.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/Teacher/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }
    //Funcion obtener por Id de la persona
    static public function searchForIdStudent($idStudent){
        try{
            return Student::searchForId($idStudent);
        }catch (\Exception $exc){
            var_dump($exc);
            //header("Location: ../../views/modules/Person/index.php?respuesta=error");
        }
    }

    //Funcion Obtener todas las personas
    static public function getAllStudent(){
        try{
            return Student::getAll();
        }catch (\Exception $exc){
            var_dump($exc);
            //header("Location: ../../views/modules/Person/index.php?respuesta=error");
        }
    }
}