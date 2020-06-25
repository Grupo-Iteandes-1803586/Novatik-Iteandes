<?php
namespace App\Controllers;
require(__DIR__.'/../Models/Person.php') ;
use App\Models\Person;
use mysql_xdevapi\Exception;

//Metodo Get para recibir la accion
if(!empty($_GET['action'])){
    PersonController::main($_GET['action']);
}

//Creacion de la clase
class PersonController{
    //Metodo main
    static function main($action){
        if($action == "create"){
            PersonController::create();
        }else if($action == "edit"){
            PersonController::edit();
        }else if($action == "searchForId"){
            PersonController::searchForId($_REQUEST['idPerson']);
        }else if($action == "getAll"){
            PersonController::getAll();
        }else if($action == "active"){
            PersonController::active();
        }else if($action =="inactive"){
            PersonController::inactive();
        }
    }
    //Funcion crear persona
    static public function create(){
        try{
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
            $arrayPerson['dateBornPerson']= $_POST['dateBornPerson'];
            $arrayPerson['rhPerson'] = $_POST['rhPerson'];
            $arrayPerson['emailPerson'] = $_POST['emailPerson'];
            $arrayPerson['phonePerson'] = $_POST['phonePerson'];
            $arrayPerson['adressPerson'] = $_POST['adressPerson'];
            $arrayPerson['generePerson'] = $_POST['generePerson'];
            $arrayPerson['typePerson'] = $_POST['typePerson'];
            $arrayPerson['statePerson'] = 'Activo';
            $arrayPerson['photoPerson']= $_POST['photoPerson'];
            //Validar registro del Usuario
            if(!Person::userRegistration($arrayPerson['documentPerson'])){
                $person =new Person($arrayPerson);
                if($person->create()){
                    header("Location: ../../views/modules/Person/index.php?respuesta=correcto");
                }
            }else{
                header("Location: ../../views/modules/Person/create.php?respuesta=error&mensaje=Usuario ya registrado");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/create.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

  //Funcion Edit de una persona
    static public function edit(){
        try{
            $arrayPerson = array();
            $arrayPerson['documentPerson'] = $_POST['documentPerson'];
            $arrayPerson['namePerson'] = $_POST['namePerson'];
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
            $person->update();
            header ("Location: ../../views/modules/Person/show.php?id=".$person->getIdPerson()."&respuesta=correcto");

        }catch (Exception $exc){
            header("Location: ../../views/modules/Person/edit.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }
    //Funcion activo de la Persona
    static public function active(){
        try{
            $ObjPerson = Person::searchForId($_GET['idPerson']);
            $ObjPerson->setStatePerson('Activo');
            if($ObjPerson->update()){
                header("Location: ../../views/modules/Person/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/index.php?respuesta=error&mensaje" . $exc-> getMessage());
        }
    }

    //Funcion inactivo de la Persona
    static public function inactive(){
        try{
            $ObjPerson = Person::searchForId($_GET['idPerson']);
            $ObjPerson->setStatePerson('Inactivo');
            if($ObjPerson->update()){
                header("Location: ../../views/modules/Person/index.php?respuesta=correcto");
            }else{
                header("Location: ../../views/modules/Person/index.php?respuesta=error&mensaje=Error al Guardar");
            }
        }catch (\Exception $exc){
            header("Location: ../../views/modules/Person/index.php?respuesta=error&mensaje" . $exc-> getMessage());
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
}