<?php
namespace App\Models;
require_once ('BasicModel.php');
use Carbon\Carbon;
class Semester extends BasicModel{
    private $idSemester;
    private $nameSemester;
    private $descriptionSemester;
    private Carbon $starDateSemester;
    private Carbon $endDateSemester;
    private Carbon $startDate50;
    private Carbon $endDate50;
    private Carbon $starDate2Semester;
    private Carbon $endDate2Semester;
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
        $this->starDateSemester = $semester['starDateSemester'] ?? new Carbon();
        $this->endDateSemester = $semester['endDateSemester'] ?? new Carbon();
        $this->startDate50 = $semester['startDate50'] ?? new Carbon();
        $this->endDate50 = $semester['endDate50'] ?? new Carbon();
        $this->starDate2Semester = $semester['starDate2Semester'] ?? new Carbon();
        $this->endDate2Semester = $semester['endDate2Semester'] ?? new Carbon();
        $this->statuSemester = $semester['statuSemester'] ?? null;
    }
    /*Metodo destructor cierre de la conexion*/
    function __destruct()
    {
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
     * @return Carbon
     */
    public function getStarDateSemester() : Carbon
    {
        return $this->starDateSemester;
    }

    /**
     * @param Carbon $starDateSemester
     */
    public function setStarDateSemester(Carbon $starDateSemester): void
    {
        $this->starDateSemester = $starDateSemester;
    }

    /**
     * @return Carbon
     */
    public function getEndDateSemester() : Carbon
    {
        return $this->endDateSemester;
    }

    /**
     * @param Carbon $endDateSemester
     */
    public function setEndDateSemester(Carbon $endDateSemester): void
    {
        $this->endDateSemester = $endDateSemester;
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
     * @return Carbon
     */
    public function getStartDate50() : Carbon
    {
        return $this->startDate50;
    }

    /**
      @param Carbon $startDate50
     */
    public function setStartDate50(Carbon $startDate50): void
    {
        $this->startDate50 = $startDate50;
    }

    /**
     * @return Carbon
     */
    public function getEndDate50() : Carbon
    {
        return $this->endDate50;
    }

    /**
     * @param Carbon $endDate50
     */
    public function setEndDate50(Carbon $endDate50): void
    {
        $this->endDate50 = $endDate50;
    }

    /**
     * @return Carbon
     */
    public function getStarDate2Semester() : Carbon
    {
        return $this->starDate2Semester;
    }

    /**
     * @param Carbon $starDate2Semester
     */
    public function setStarDate2Semester(Carbon $starDate2Semester): void
    {
        $this->starDate2Semester = $starDate2Semester;
    }

    /**
     * @return Carbon
     */
    public function getEndDate2Semester() : Carbon
    {
        return $this->endDate2Semester;
    }

    /**
     * @param Carbon $endDate2Semester
     */
    public function setEndDate2Semester(Carbon $endDate2Semester): void
    {
        $this->endDate2Semester = $endDate2Semester;
    }


    //Creacion del metodo create
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.semester VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
            $this->nameSemester,
            $this->descriptionSemester,
            $this->starDateSemester->toDateString(), //YYYY-MM-DD,
            $this->endDateSemester->toDateString(), //YYYY-MM-DD,
            $this->startDate50->toDateString(), //YYYY-MM-DD,
            $this->endDate50->toDateString(), //YYYY-MM-DD,
            $this->starDate2Semester->toDateString(), //YYYY-MM-DD,
            $this->endDate2Semester->toDateString(), //YYYY-MM-DD,
            $this->statuSemester
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.semester  SET nameSemester = ?, descriptionSemester = ?,starDateSemester = ?,endDateSemester = ?,startDate50 = ?,endDate50 = ?,starDate2Semester = ?,endDate2Semester = ?, statuSemester =? WHERE idSemester = ?", array(
                $this->nameSemester,
                $this->descriptionSemester,
                $this->starDateSemester->toDateString(), //YYYY-MM-DD,
                $this->endDateSemester->toDateString(), //YYYY-MM-DD,
                $this->startDate50->toDateString(), //YYYY-MM-DD,
                $this->endDate50->toDateString(), //YYYY-MM-DD,
                $this->starDate2Semester->toDateString(), //YYYY-MM-DD,
                $this->endDate2Semester->toDateString(), //YYYY-MM-DD,
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
            $semeste->starDateSemester= Carbon::parse($value['starDateSemester']);
            $semeste->endDateSemester = Carbon::parse($value['endDateSemester']);
            $semeste->startDate50 = Carbon::parse($value['startDate50']);
            $semeste->endDate50 = Carbon::parse($value['endDate50']);
            $semeste->starDate2Semester = Carbon::parse($value['starDate2Semester']);
            $semeste->endDate2Semester = Carbon::parse($value['endDate2Semester']);
            $semeste->statuSemester = $value['statuSemester'];
            $semeste->Disconnect();
            array_push($arrSemester,$semeste);
        }
        $tmp->Disconnect();
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
            $semestes->starDateSemester= Carbon::parse($getrow['starDateSemester']);
            $semestes->endDateSemester = Carbon::parse($getrow['endDateSemester']);
            $semestes->startDate50 = Carbon::parse($getrow['startDate50']);
            $semestes->endDate50 = Carbon::parse($getrow['endDate50']);
            $semestes->starDate2Semester = Carbon::parse($getrow['starDate2Semester']);
            $semestes->endDate2Semester = Carbon::parse($getrow['endDate2Semester']);
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
        return $this->nameSemester." ".$this->descriptionSemester." ".$this->starDateSemester->toDateString()." ".$this->endDateSemester->toDateString()." ".$this->startDate50->toDateString()." ".$this->endDate50->toDateString()." ".$this->starDate2Semester->toDateString()." ".$this->endDate2Semester->toDateString()." ".$this->statuSemester;
    }

    public function delete($idSemester): bool
    {
        $semesterDelet = Semester::searchForId($idSemester);
        $semesterDelet->setStatuSemester("Inactivo");
        return $semesterDelet->update();
    }
}