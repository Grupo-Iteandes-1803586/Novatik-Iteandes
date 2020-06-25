<?php
namespace App\Models;
require ('BasicModel.php');

class Semester extends BasicModel{
    private $idSemester;
    private $nameSemester;
    private $startDate;
    private $endDate;
    private $statuSemester;

    /**
     * Semester constructor.
     */
    public function __construct($semester = array())
    {
        parent::__construct();
        $this->idSemester = $semester['$idSemester'] ?? null;
        $this->nameSemester = $semester['$nameSemester'] ?? null;
        $this->startDate = $semester['$startDate'] ?? null;
        $this->endDate = $semester['$endDate'] ?? null;
        $this->statuSemester = $semester['$statuSemester'] ?? null;
    }
    /*Metodo destructor cierre de la conexion*/
    function __destruct(){
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdSemester(): int
    {
        return $this->idSemester;
    }
    /**
     * @param int $idSemester
     */
    public function setIdSemester(int $idSemester): void
    {
        $this->idSemester = $idSemester;
    }

    /**
     * @return String
     */
    public function getNameSemester(): String
    {
        return $this->nameSemester;
    }

    /**
     * @param String $nameSemester
     */
    public function setNameSemester(String $nameSemester): void
    {
        $this->nameSemester = $nameSemester;
    }

    /**
     * @return date
     */
    public function getStartDate(): date
    {
        return $this->startDate;
    }

    /**
     * @param date $startDate
     */
    public function setStartDate(date $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return date
     */
    public function getEndDate(): date
    {
        return $this->endDate;
    }

    /**
     * @param date $endDate
     */
    public function setEndDate(date $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return String
     */
    public function getStatuSemester(): String
    {
        return $this->statuSemester;
    }

    /**
     * @param String $statuSemester
     */
    public function setStatuSemester(String $statuSemester): void
    {
        $this->statuSemester = $statuSemester;
    }
    //Creacion del metodo create
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO Iteandes_Novatik.Semester VALUES (NULL, ?, ?, ?, ?)", array(
            $this->nameSemester = nameSemester,
            $this->startDate = startDate,
            $this->endDate = endDate,
            $this->statuSemester = statuSemester
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE Iteandes_Novatik.Semester SET nameSemester = ?,startDate = ?,endDate = ?,statuSemester? = WHERE idSemester = ?", array(
                $this->nameSemester = nameSemester,
                $this->startDate = startDate,
                $this->endDate = endDate,
                $this->statuSemester = statuSemester,
                $this->idSemester = idSemester
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del la funcion eliminar o cambiar estado de un semestre segun el Id
    public function deleted($idSemester) : bool{
        $Semester = TrainingProgram::searchForId($idSemester); //Buscando un Programa por el ID
        $Semester->getStatuSemester("Inactivo"); //Cambia el estado del Programa
        return $Semester->update();
    }

    //buscar por query
    public static function search($query) : array{
        $arrSemester = array();
        $tmp = new Semester();
        $getrows = $tmp->getRows($query);

        foreach($getrows as $value){
            $semeste = new Semester();
            $semeste->idSemester =  $value['$idSemester'];
            $semeste->nameSemester =$value['$nameSemester'] ;
            $semeste->startDate = $value['$startDate'] ;
            $semeste->endDate = $value['$endDate'];
            $semeste->statuSemester = $value['$statuSemester'];
            $semeste->Disconnect();
            array_push($arrSemester,$semeste);
        }
        $tmp->Disconnect;
        return $arrSemester;
    }
    //Buscar pot Id de semestre
    public static function searchForId($idSemester) : Semester{
        $semestes= null;
        if(idSemester > 0) {
            $semestes = new TrainingProgram;
            $getrow = $semestes->getRow("SELECT * FROM Iteandes_Novatik.Semester WHERE idSemester =?", array(idSemester));
            $semestes->idSemester =  $getrow['$idSemester'];
            $semestes->nameSemester =$getrow['$nameSemester'] ;
            $semestes->startDate = $getrow['$startDate'] ;
            $semestes->endDate = $getrow['$endDate'];
            $semestes->statuSemester = $getrow['$statuSemester'];
        }
        $semestes->Disconnect();
        return $semestes;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Semester::search("SELECT * FROM Iteandes_Novatik.Semester");
    }

    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->nameSemester." ".$this->startDate." ".$this->endDate." ".$this->statuSemester;
    }


}