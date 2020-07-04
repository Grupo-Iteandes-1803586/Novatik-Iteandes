<?php

namespace App\Models;

use http\QueryString;
require('BasicModel.php');
#Creacion de la clase con herencia de la clase Basic Model
class Person extends BasicModel{
    private $idPerson;
    private $documentPerson;
    private $namePerson;
    private $dateBornPerson;
    private $agePerson;
    private $rhPerson;
    private $emailPerson;
    private $phonePerson;
    private $adressPerson;
    private $generePerson;
    private $userPerson;
    private $passwordPerson;
    private $typePerson;
    private $statePerson;
    private $photoPerson;

    /**
     * Person constructor.
     * @param $idPerson
     * @param $documentPerson
     * @param $namePerson
     * @param $dateBornPerson
     * @param $rhPerson
     * @param $emailPerson
     * @param $phonePerson
     * @param $adressPerson
     * @param $generePerson
     * @param $userPerson
     * @param $passwordPerson
     * @param $typePerson
     * @param $statePerson
     * @param $photoPerson
     */
    public function __construct($person=array()){
        parent::__construct();//Se llama al constructor padre que esta dentro de la clase Basic Model "para conexion con la BD"
        $this->idPerson = $person['idPerson'] ?? null;
        $this->documentPerson = $person['documentPerson'] ?? null;
        $this->namePerson = $person['namePerson'] ?? null;
        $this->dateBornPerson = $person['dateBornPerson'] ?? null;
        $this->rhPerson = $person['rhPerson'] ?? null;
        $this->emailPerson = $person['emailPerson'] ?? null;
        $this->phonePerson = $person['phonePerson'] ?? null;
        $this->adressPerson = $person['adressPerson'] ?? null;
        $this->generePerson = $person['generePerson'] ?? null;
        $this->userPerson = $person['userPerson'] ?? null;
        $this->passwordPerson = $person['passwordPerson'] ?? null;
        $this->typePerson = $person['typePerson'] ?? null;
        $this->statePerson = $person['statePerson'] ?? null;
        $this->photoPerson = $person['photoPerson'] ?? null;
    }

    /*Metodo destructor cierre de la conexion*/
    function __destruct(){
        $this->Disconnect();
    }
    /**
     * @return int
     * Obtener codigo de la persona
     */
    public function getIdPerson(): int
    {
        return $this->idPerson;
    }

    /**
     * @param int $idPerson
     */
    public function setCodePerson(int $idPerson): void
    {
        $this->idPerson = $idPerson;
    }

    /**
     * @return int
     * Obtener Documento de la persona
     */
    public function getDocumentPerson(): int
    {
        return $this->documentPerson;
    }

    /**
     * @param int $documentPerson
     */
    public function setDocumentPerson(int $documentPerson): void
    {
        $this->documentPerson = $documentPerson;
    }

    /**
     * @return String
     * Obtener Nombres de la persona
     */
    public function getNamePerson(): String
    {
        return $this->namePerson;
    }

    /**
     * @param String $namePerson
     */
    public function setNamePerson(String $namePerson): void
    {
        $this->namePerson = $namePerson;
    }
    /**
     * @return date
     * Obtener Fecha de nacimiento de la persona
     */
    public function getDateBornPerson(): date
    {
        return $this->dateBornPerson;
    }

    /**
     * @param date $dateBornPerson
     */
    public function setDateBornPerson(date $dateBornPerson): void
    {
        $this->dateBornPerson = $dateBornPerson;
    }

    /**
     * @return String
     * Obtener Rh de la persona
     */
    public function getRhPerson(): String
    {
        return $this->rhPerson;
    }

    /**
     * @param String $rhPerson
     */
    public function setRhPerson(String $rhPerson): void
    {
        $this->rhPerson = $rhPerson;
    }

    /**
     * @return String
     * Obtener Usuario  de la persona
     */
    public function getUserPerson(): String
    {
        return $this->userPerson;
    }

    /**
     * @param String $userPerson
     */
    public function setUserPerson(String $userPerson): void
    {
        $this->userPerson = $userPerson;
    }

    /**
     * @return String
     * Obtener password de la persona
     */
    public function getPasswordPerson(): String
    {
        return $this->passwordPerson;
    }

    /**
     * @param String $passwordPerson
     */
    public function setPasswordPerson(String $passwordPerson): void
    {
        $this->passwordPerson = $passwordPerson;
    }

    /**
     * @return String
     * Obtener tipo de persona de la persona
     */
    public function getTypePerson(): String
    {
        return $this->typePerson;
    }

    /**
     * @param String $typePerson
     */
    public function setTypePerson(String $typePerson): void
    {
        $this->typePerson = $typePerson;
    }

    /**
     * @return String
     * Obtener estado de la persona
     */
    public function getStatePerson(): String
    {
        return $this->statePerson;
    }

    /**
     * @param String $statePerson
     */
    public function setStatePerson(String $statePerson): void
    {
        $this->statePerson = $statePerson;
    }
    /**
     * @return String
     * Obtener Email de la persona
     */
    public function getEmailPerson(): String
    {
        return $this->emailPerson;
    }

    /**
     * @param String $emailPerson
     */
    public function setEmailPerson(String $emailPerson): void
    {
        $this->emailPerson = $emailPerson;
    }

    /**
     * @return int
     * Obtener Telefono de la persona
     */
    public function getPhonePerson(): int
    {
        return $this->phonePerson;
    }

    /**
     * @param int $phonePerson
     */
    public function setPhonePerson(int $phonePerson): void
    {
        $this->phonePerson = $phonePerson;
    }

    /**
     * @return String
     * Otener Direccion
     */
    public function getAdressPerson(): String
    {
        return $this->adressPerson;
    }

    /**
     * @param String $adressPerson
     */
    public function setAdressPerson(String $adressPerson): void
    {
        $this->adressPerson = $adressPerson;
    }

    /**
     * @return String
     * Obtener genero de la persona
     */
    public function getGenerePerson(): String
    {
        return $this->generePerson;
    }

    /**
     * @param String $generePerson
     */
    public function setGenerePerson(String $generePerson): void
    {
        $this->generePerson = $generePerson;
    }

    /**
     * @return String
     * Obtener foto de la persona
     */
    public function getPhotoPerson(): String
    {
        return $this->photoPerson;
    }

    /**
     * @param String $photoPerson
     */
    public function setPhotoPerson(String $photoPerson): void
    {
        $this->photoPerson = $photoPerson;
    }

    //Creacion del metodo create
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.person VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
            $this->documentPerson,
            $this->namePerson,
            $this->dateBornPerson,
            $this->rhPerson,
            $this->emailPerson,
            $this->phonePerson,
            $this->adressPerson,
            $this->generePerson,
            $this->generateNameUser($this -> documentPerson , $this -> namePerson),
            $this->documentPerson,
            $this->typePerson,
            $this->statePerson,
            $this->photoPerson
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Generar nomre de usuario
    public function generateNameUser($documentPerson , $namePerson):String{
        $finalUserName = "";
        $userName = explode(" ",$namePerson);
        foreach ($userName as $user){
            $finalUserName .= $user[0];
        }
        return $finalUserName .= $documentPerson ;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.person SET documentPerson = ?, namePerson = ?,dateBornPerson = ?, emailPerson = ?,phonePerson = ?,adressPerson = ?,statePerson = ?,photoPerson = ? WHERE idPerson = ?", array(
                $this->documentPerson,
                $this->namePerson,
                $this->dateBornPerson,
                $this->rhPerson,
                $this->emailPerson,
                $this->phonePerson,
                $this->adressPerson,
                $this->generePerson,
                $this->typePerson,
                $this->statePerson,
                $this->photoPerson,
                $this-> idPerson
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del la funcion eliminar o cambiar estado de una persona segun el Id
    public function deleted($idPerson) : bool{
        $User = Person::searchForId($idPerson); //Buscando un usuario por el ID
        $User->setStatePerson("Inactivo"); //Cambia el estado del Usuario
        return $User->update();
    }

    //buscar por query
    public static function search($query) : array{
        $arrPerson = array();
        $tmp = new Person();
        $getrows = $tmp->getRows($query);

        foreach($getrows as $value){
            $Users = new Person();
            $Users->documentPerson = $value['documentPerson'];
            $Users->namePerson = $value['namePerson'];
            $Users->dateBornPerson = $value['dateBornPerson'];
            $Users->rhPerson = $value['rhPerson'];
            $Users->emailPerson = $value['emailPerson'];
            $Users->phonePerson = $value['phonePerson'];
            $Users->adressPerson = $value['adressPerson'];
            $Users->generePerson = $value['generePerson'];
            $Users->userPerson = $value['userPerson'];
            $Users->passwordPerson = $value['passwordPerson'];
            $Users->typePerson = $value['typePerson'];
            $Users->statePerson = $value['statePerson'];
            $Users->photoPerson = $value['photoPerson'];
            $Users->Disconnect();
            array_push($arrPerson,$Users);
        }
        $tmp->Disconnect;
        return $arrPerson;
    }
    //Buscar pot Id de persona
    public static function searchForId($idPerson) : Person{
    $Users = null;
    if($idPerson > 0) {
        $Users = new Person;
        $getrow = $Users->getRow("SELECT * FROM iteandes_novatik.person WHERE idPerson =?", array($idPerson));
        $Users->documentPerson = $getrow['documentPerson'];
        $Users->namePerson = $getrow['namePerson'];
        $Users->dateBornPerson = $getrow['dateBornPerson'];
        $Users->rhPerson = $getrow['rhPerson'];
        $Users->emailPerson = $getrow['emailPerson'];
        $Users->phonePerson = $getrow['phonePerson'];
        $Users->adressPerson = $getrow['adressPerson'];
        $Users->generePerson = $getrow['generePerson'];
        $Users->userPerson = $getrow['userPerson'];
        $Users->passwordPerson = $getrow['passwordPerson'];
        $Users->typePerson = $getrow['typePerson'];
        $Users->statePerson = $getrow['statePerson'];
        $Users->photoPerson = $getrow['photoPerson'];
    }
    $Users->Disconnect();
    return $Users;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Person::search("SELECT * FROM iteandes_novatik.Person");
    }
    public static function getForDocument($documentPerson) : array
    {
        return Person::search("SELECT idPerson,documentPerson,namePerson,dateBornPerson,rhPerson,emailPerson,phonePerson,adressPerson,generePerson,typePerson,statePerson,photoPerson FROM iteandes_novatik.person WHERE documentPerson = ".$documentPerson);
    }
    public static function userRegistration ($documentPerson) : bool
    {
        $result = Person::search("SELECT idPerson FROM iteandes_novatik.person where documentPerson = ".$documentPerson);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }
    //Metodo generaRr edad
    public function generateAge($dateBornPerson) : int{
        $age = date_diff(date_create($dateBornPerson),date_create('now'))->y;
        return $age;
    }
    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->documentPerson." ".$this->namePerson." ".$this->dateBornPerson." ".$this->rhPerson
            ." ".$this->emailPerson ." ".$this->phonePerson." ".$this->adressPerson." ".$this->generePerson." ".$this->userPerson
            ." ".$this->passwordPerson." ".$this->typePerson." ".$this->statePerson." ".$this->photoPerson;
    }

    public function delete($idPerson): bool
    {
        $personDelet = Person::searchForId($idPerson);
        $personDelet->setStatePerson("Inactivo");
        return $personDelet->update();
    }
}
