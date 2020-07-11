<?php
namespace App\Models;
require ('BasicModel.php');

class Semester extends BasicModel{
    private $idSemester;
    private $nameSemester;
    private $descriptionSemester;
    private $startDate;
    private $endDate;
    private $startDate50;
    private $endDate50;
    private $starDate2Semester;
    private $endDate2Semester;
    private $statuSemester;

    /**
     * Semester constructor.
     */
    public function __construct($semester = array())
    {
        parent::__construct();
        $this->idSemester = $semester['idSemester'] ?? null;
        $this->nameSemester = $semester['nameSemester'] ?? null;
        $this->descriptionSemester = $semester['descriptionSemester'] ?? null;
        $this->startDate = $semester['startDate'] ?? null;
        $this->endDate = $semester['endDate'] ?? null;
        $this->startDate50 = $semester['startDate50'] ?? null;
        $this->endDate50 = $semester['endDate50'] ?? null;
        $this->starDate2Semester = $semester['starDate2Semester'] ?? null;
        $this->endDate2Semester = $semester['endDate2Semester'] ?? null;
        $this->statuSemester = $semester['statuSemester'] ?? null;
    }
    /*Metodo destructor cierre de la conexion*/
    function __destruct(){
        $this->Disconnect();
    }

    /**
     * @return bool
     */
    public function isConnected(): bool
    {
        return $this->isConnected;
    }

    /**
     * @param bool $isConnected
     */
    public function setIsConnected(bool $isConnected): void
    {
        $this->isConnected = $isConnected;
    }

    /**
     * @returnString
     */
    public function getDescriptionSemester(): String
    {
        return $this->descriptionSemester;
    }

    /**
     * @param String $descriptionSemester
     */
    public function setDescriptionSemester(String $descriptionSemester): void
    {
        $this->descriptionSemester = $descriptionSemester;
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

    /**
     * @return date
     */
    public function getStartDate50(): date
    {
        return $this->startDate50;
    }

    /**
      @param date $startDate50
     */
    public function setStartDate50(date $startDate50): void
    {
        $this->startDate50 = $startDate50;
    }

    /**
     * @return date
     */
    public function getEndDate50(): date
    {
        return $this->endDate50;
    }

    /**
     * @param date $endDate50
     */
    public function setEndDate50(date $endDate50): void
    {
        $this->endDate50 = $endDate50;
    }

    /**
     * @return date
     */
    public function getStarDate2Semester(): date
    {
        return $this->starDate2Semester;
    }

    /**
     * @param date $starDate2Semester
     */
    public function setStarDate2Semester(date $starDate2Semester): void
    {
        $this->starDate2Semester = $starDate2Semester;
    }

    /**
     * @return date
     */
    public function getEndDate2Semester(): date
    {
        return $this->endDate2Semester;
    }

    /**
     * @param date $endDate2Semester
     */
    public function setEndDate2Semester(date $endDate2Semester): void
    {
        $this->endDate2Semester = $endDate2Semester;
    }


    //Creacion del metodo create
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.semester VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
            $this->nameSemester,
            $this->descriptionSemester,
            $this->startDate,
            $this->endDate,
            $this->startDate50,
            $this->endDate50,
            $this->starDate2Semester,
            $this->endDate2Semester,
            $this->statuSemester,
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.semester SET nameSemester = ?, descriptionSemester = ?,startDate = ?,endDate = ?,startDate50 = ?,endDate50 = ?,starDate2Semester = ?,endDate2Semester = ?, statuSemester? = WHERE idSemester = ?", array(
                $this->nameSemester,
                $this->descriptionSemester,
                $this->startDate,
                $this->endDate,
                $this->startDate50,
                $this->endDate50,
                $this->starDate2Semester,
                $this->endDate2Semester,
                $this->statuSemester,
                $this->idSemester
            )
        );
        $this->Disconnect();
        return $result;
    }
    //buscar por query
    public static function search($query): array{
        $arrSemester = array();
        $tmp = new Semester();
        $getrows = $tmp->getRows($query);

        foreach($getrows as $value){
            $semeste = new Semester();
            $semeste->idSemester =  $value['idSemester'];
            $semeste->nameSemester = $value['nameSemester'] ;
            $semeste->descriptionSemester =$value['descriptionSemester'] ;
            $semeste->startDate= date('Y-m-d',strtotime($value['startDate']));
            $semeste->endDate = date('Y-m-d',strtotime($value['endDate']));
            $semeste->startDate50 = date('Y-m-d',strtotime($value['startDate50']));
            $semeste->endDate50 = date('Y-m-d',strtotime($value['endDate50']));
            $semeste->starDate2Semester = date('Y-m-d',strtotime($value['starDate2Semester']));
            $semeste->endDate2Semester = date('Y-m-d',strtotime($value['endDate2Semester']));
            $semeste->statuSemester = $value['statuSemester'];
            $semeste->Disconnect();
            array_push($arrSemester,$semeste);
        }
        $tmp->Disconnect;
        return $arrSemester;
    }
    //Buscar pot Id de semestre
    public static function searchForId($idSemester) : Semester{
        $semestes= null;
        if($idSemester > 0) {
            $semestes = new Semester();
            $getrow = $semestes->getRow("SELECT * FROM iteandes_novatik.semester WHERE idSemester =?", array($idSemester));
            $semestes->idSemester =  $getrow['idSemester'];
            $semestes->nameSemester =$getrow['nameSemester'] ;
            $semestes->descriptionSemester =$getrow['descriptionSemester'] ;
            $semestes->startDate = $getrow['startDate'] ;
            $semestes->endDate = $getrow['endDate'];
            $semestes->startDate50 = $getrow['startDate50'];
            $semestes->endDate50 = $getrow['endDate50'];
            $semestes->starDate2Semester = $getrow['starDate2Semester'] ;
            $semestes->endDate2Semester = $getrow['endDate2Semester'] ;
            $semestes->statuSemester = $getrow['statuSemester'];
        }
        $semestes->Disconnect();
        return $semestes;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Semester::search("SELECT * FROM iteandes_novatik.semester");
    }

    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->nameSemester." ".$this->descriptionSemester." ".$this->startDate." ".$this->endDate." ".$this->startDate50." ".$this->endDate50." ".$this->starDate2Semester." ".$this->endDate2Semester." ".$this->statuSemester;
    }

    public function delete($idSemester): bool
    {
        $semesterDelet = Semester::searchForId($idSemester);
        $semesterDelet->setStatuSemester("Inactivo");
        return $semesterDelet->update();
    }
}