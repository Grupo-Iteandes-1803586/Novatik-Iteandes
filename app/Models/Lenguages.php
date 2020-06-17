<?php
namespace App\Models;

require("BasicModel.php");

class Lenguages extends BasicModel{
    private $idLenguages ;
    private $nameLenguages ;

    /**
     * Lenguages constructor.
     * @param $idLenguages
     * @param $nameLenguages
     */
    public function __construct($lengus  = array())
    {
        $this->idLenguages = $lengus;['idLenguages'] ?? null;
        $this->nameLenguages = $lengus;['inameLenguages'] ?? null;
    }
    function __destruct(){
        $this->Disconnect();
    }
    //metodos get y set
    /**
     * @return int
     */
    public function getIdLenguages(): ? int
    {
        return $this->idLenguages;
    }

    /**
     * @param   int $idLenguages
     */
    public function setIdLenguages(? int $idLenguages): void
    {
        $this->idLenguages = $idLenguages;
    }

    /**
     * @return String
     */
    public function getNameLenguages(): ? String
    {
        return $this->nameLenguages;
    }

    /**
     * @param String   $nameLenguages
     */
    public function setNameLenguages(?String $nameLenguages): void
    {
        $this->nameLenguages = $nameLenguages;
    }
    //creacion de metodos
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO Iteandes_Novatik.Lenguages VALUES (NULL, ?)", array(
                $this-> $nameLenguages
            )
        );

        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE Iteandes_Novatik.Lenguages SET nameLenguages = ? WHERE idLenguages = ?", array(
                $this->nameLenguages,
                $this ->idLenguages
            )
        );
        $this->Disconnect();
        return $result;
    }

    //buscar por query
    public static function search($query) : array{
        $arrLenguages = array();
        $tmp = new Lenguages();
        $getrows = $tmp->getRows($query);
        foreach($getrows as $value){
            $lenguage = new Lenguages();
            $lenguage-> nameLenguages= $value['$nameLenguages'];
            $lenguage->Disconnect();
            array_push($arrLenguages,$lenguage);
        }
        $tmp->Disconnect;
        return $arrLenguages;
    }
    //Buscar pot Id de Lenguages
    public static function searchForId($idLenguages) : Lenguages{
        $lenguages= null;
        if(lenguages > 0) {
            $lenguages = new Lenguages;
            $getrow = $lenguages->getRow("SELECT * FROM Iteandes_Novatik.Lenguages WHERE idLenguages =?", array($idLenguages));
            $lenguages->nameLenguages = $getrow['nameLenguages'];

        }
        $lenguages->Disconnect();
        return lenguages;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Lenguages::search("SELECT * FROM Iteandes_Novatik.Lenguages");
    }

    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->nameLenguages. "";
    }
}
