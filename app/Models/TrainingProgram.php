<?php

namespace App\Models;
require ('BasicModel.php');

#Creacion de la clase con herencia de la clase Basic Model
class TrainingProgram extends BasicModel{
    private $idTrainingProgram;
    private $codeTrainingProgram;
    private $nameTrainingProgram;
    private $version;
    private $statusTrainingProgram;

    /**
     * TrainingProgram constructor.
     * @param $idTrainingProgram
     * @param $codeTrainingProgram
     * @param $nameTrainingProgram
     * @param $version
     * @param $statusTrainingProgram
     */
    public function __construct($trainingProgram = array())
    {
        parent::__construct();//se llama al constructor de la clase BasicModel
        $this->idTrainingProgram =  $trainingProgram['$idTrainingProgram']?? null;
        $this->codeTrainingProgram =$trainingProgram['$codeTrainingProgram'] ?? null;
        $this->nameTrainingProgram = $trainingProgram['$nameTrainingProgram'] ?? null;
        $this->version = $trainingProgram['$version'] ?? null;
        $this->statusTrainingProgram = $trainingProgram['$statusTrainingProgram'] ?? null;
    }
    /*Metodo destructor cierre de la conexion*/
    function __destruct(){
        $this->Disconnect();
    }
    /**
     * @return int
     * obtener id del training program
     */
    public function getIdTrainingProgram(): int
    {
        return $this->idTrainingProgram;
    }

    /**
     * @param int $idTrainingProgram
     */
    public function setIdTrainingProgram(int $idTrainingProgram): void
    {
        $this->idTrainingProgram = $idTrainingProgram;
    }

    /**
     * @return int
     * Obtener codigo del Training Program
     */
    public function getCodeTrainingProgram(): int
    {
        return $this->codeTrainingProgram;
    }

    /**
     * @param int $codeTrainingProgram
     */
    public function setCodeTrainingProgram(int $codeTrainingProgram): void
    {
        $this->codeTrainingProgram = $codeTrainingProgram;
    }

    /**
     * @return String
     * Obtener nombre del Training Program
     */
    public function getNameTrainingProgram(): String
    {
        return $this->nameTrainingProgram;
    }

    /**
     * @param String $nameTrainingProgram
     */
    public function setNameTrainingProgram(String $nameTrainingProgram): void
    {
        $this->nameTrainingProgram = $nameTrainingProgram;
    }

    /**
     * @return float
     * Obtener la version del Training Program
     */
    public function getVersion(): float
    {
        return $this->version;
    }

    /**
     * @param float $version
     */
    public function setVersion(float $version): void
    {
        $this->version = $version;
    }

    /**
     * @return String
     * Obtener estado del Training Program
     */
    public function getStatusTrainingProgram(): String
    {
        return $this->statusTrainingProgram;
    }

    /**
     * @param String $statusTrainingProgram
     */
    public function setStatusTrainingProgram(String $statusTrainingProgram): void
    {
        $this->statusTrainingProgram = $statusTrainingProgram;
    }
    //Creacion del metodo create
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.trainingprogram VALUES (NULL, ?, ?, ?, ?)", array(
            $this->codeTrainingProgram,
            $this->nameTrainingProgram ,
            $this->version,
            $this->statusTrainingProgram
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.trainingprogram SET nameTrainingProgram = ?,version = ?,statusTrainingProgram = ? WHERE idTrainingProgram = ?", array(
                $this->codeTrainingProgram,
                $this->nameTrainingProgram ,
                $this->version,
                $this->statusTrainingProgram,
                $this->idTrainingProgram
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del la funcion eliminar o cambiar estado de un Training Program segun el Id
    public function deleted($idTrainingProgram) : bool{
        $Program = TrainingProgram::searchForId($idTrainingProgram); //Buscando un Programa por el ID
        $Program->setStatusTrainingProgram("Inactivo"); //Cambia el estado del Programa
        return $Program->update();
    }

    //buscar por query
    public static function search($query) : array{
        $arrProgram = array();
        $tmp = new TrainingProgram();
        $getrows = $tmp->getRows($query);

        foreach($getrows as $value){
            $Program = new TrainingProgram();
            $Program->idTrainingProgram =  $value['idTrainingProgram'];
            $Program->codeTrainingProgram =$value['codeTrainingProgram'] ;
            $Program->nameTrainingProgram = $value['nameTrainingProgram'] ;
            $Program->version = $value['version'];
            $Program->statusTrainingProgram = $value['statusTrainingProgram'];
            $Program->Disconnect();
            array_push($arrProgram,$Program);
        }
        $tmp->Disconnect;
        return $arrProgram;
    }
    //Buscar pot Id de TrainingProgram
    public static function searchForId($idTrainingProgram) : TrainingProgram{
        $Program = null;
        if($idTrainingProgram > 0) {
            $Program = new TrainingProgram;
            $getrow = $Program->getRow("SELECT * FROM iteandes_novatik.trainingprogram WHERE idTrainingProgram =?", array($idTrainingProgram));
            $Program->idTrainingProgram =  $getrow['idTrainingProgram'];
            $Program->codeTrainingProgram =$getrow['codeTrainingProgram'] ;
            $Program->nameTrainingProgram = $getrow['nameTrainingProgram'] ;
            $Program->version = $getrow['$version'];
            $Program->statusTrainingProgram = $getrow['statusTrainingProgram'];
        }
        $Program->Disconnect();
        return $Program;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return TrainingProgram::search("SELECT * FROM iteandes_novatik.trainingprogram");
    }

    public static function programRegistration ($codeTrainingProgram) : bool
    {
        $result = TrainingProgram::search("SELECT idTrainingProgram FROM iteandes_novatik.trainingprogram where codeTrainingProgram = ".$codeTrainingProgram);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }
    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->codeTrainingProgram." ".$this->nameTrainingProgram." ".$this->version." ".$this->statusTrainingProgram;
    }

    public function delete($idTrainingProgram): bool
    {
        $programDelet = TrainingProgram::searchForId($idTrainingProgram);
        $programDelet->setStatusTrainingProgram("Inactivo");
        return $programDelet->update();
    }
}