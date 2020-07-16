<?php
namespace App\Models;

require_once ('BasicModel.php');

class Lenguages extends BasicModel{
    private $idLenguages ;
    private $nameLenguages ;
    private $stateLenguague;

    /**
     * Lenguages constructor.
     * @param $idLenguages
     * @param $nameLenguages
     */
    public function __construct($lengus  = array())
    {
        parent::__construct();
        $this->idLenguages = $lengus;['idLenguages'] ?? null;
        $this->nameLenguages = $lengus;['nameLenguages'] ?? null;
        $this->stateLenguague = $lengus;['stateLenguague'] ?? null;
    }
    function __destruct(){
        $this->Disconnect();
    }
//metodos get y set
    /**
     * @return int
     */
    public function getIdLenguages(): int
    {
        return $this->idLenguages;
    }

    /**
     * @param int $idLenguages
     */
    public function setIdLenguages(int $idLenguages): void
    {
        $this->idLenguages = $idLenguages;
    }

    /**
     * @return String
     */
    public function getNameLenguages(): String
    {
        return $this->nameLenguages;
    }

    /**
     * @param String $nameLenguages
     */
    public function setNameLenguages(String $nameLenguages): void
    {
        $this->nameLenguages = $nameLenguages;
    }

    /**
     * @return String
     */
    public function getStateLenguague(): String
    {
        return $this->stateLenguague;
    }

    /**
     * @param String $stateLenguague
     */
    public function setStateLenguague(String $stateLenguague): void
    {
        $this->stateLenguague = $stateLenguague;
    }


    //creacion de metodos
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.lenguages VALUES (NULL, ?, ?)", array(
                $this-> nameLenguages,
                $this-> stateLenguague
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.lenguages SET nameLenguages = ?,stateLenguague = ? WHERE idLenguages = ?", array(
                $this->nameLenguages,
                $this->stateLenguague,
                $this ->idLenguages
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del la funcion eliminar o cambiar estado de Lenguages segun el Id
    public function delete($idLenguages) : bool{
        $Lenguages = Lenguages::searchForId($idLenguages); //Buscando un usuario por el ID
        $Lenguages->setStateLenguague("Inactivo"); //Cambia el estado del Usuario
        return $Lenguages->update();
    }

    //buscar por query
    public static function search($query) : array{
        $arrLenguages = array();
        $tmp = new Lenguages();
        $getrows = $tmp->getRows($query);
        foreach($getrows as $value){
            $lenguage = new Lenguages();
            $lenguage-> idLenguages= $value['idLenguages'];
            $lenguage-> nameLenguages= $value['nameLenguages'];
            $lenguage-> stateLenguague= $value['stateLenguague'];
            $lenguage->Disconnect();
            array_push($arrLenguages,$lenguage);
        }
        $tmp->Disconnect();
        return $arrLenguages;
    }
    //Buscar pot Id de Lenguages
    public static function searchForId($idLenguages) : Lenguages{
        $lenguages= null;
        if(lenguages > 0) {
            $lenguages = new Lenguages;
            $getrow = $lenguages->getRow("SELECT * FROM iteandes_novatik.lenguages WHERE idLenguages =?", array($idLenguages));
            $lenguages->nameLenguages = $getrow['nameLenguages'];
            $lenguages->stateLenguague = $getrow['stateLenguague'];
            $lenguages->idLenguages = $getrow['idLenguages'];
        }
        $lenguages->Disconnect();
        return lenguages;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Lenguages::search("SELECT * FROM iteandes_novatik.lenguages");
    }

    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->nameLenguages. " ".$this->stateLenguague;
    }
}
