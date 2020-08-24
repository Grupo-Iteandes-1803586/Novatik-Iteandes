<?php

namespace  App\Models;

require_once ('BasicModel.php');
use Carbon\Carbon;

class Schedule extends BasicModel{

    private $idSchedule;
    private Carbon $startDateSchedule;
    private Carbon $endDateSchedule;
    private $cantHours;
    private $daySchedule;
    private Carbon $startHourSchedule;
    private Carbon $endHourSchedule;
    private $stateSchedule;
    private $Group_idGroup;

    /**
     * Schedule constructor.
     * @param $idSchedule
     * @param $startDateSchedule
     * @param $endDateSchedule
     * @param $cantHours
     * @param $startHourSchedule
     * @param $endHourSchedule
     * @param $stateSchedule
     * @param $Group_idGroup
     */
    public function __construct($schedule = array())
    {
        parent::__construct();
        $this->idSchedule = $schedule['idSchedule'] ?? null;
        $this->startDateSchedule = $schedule['startDateSchedule'] ?? new Carbon();
        $this->endDateSchedule = $schedule['endDateSchedule'] ?? new Carbon();
        $this->cantHours = $schedule['cantHours'] ?? null;
        $this->daySchedule = $schedule['daySchedule'] ?? null;
        $this->startHourSchedule = $schedule['startHourSchedule'] ?? new Carbon();
        $this->endHourSchedule = $schedule['endHourSchedule'] ?? new Carbon();
        $this->stateSchedule = $schedule['stateSchedule'] ?? null;
        $this->Group_idGroup = $schedule['Group_idGroup'] ?? null;
    }

    /**
     * @return String
     */
    public function getDaySchedule(): String
    {
        return $this->daySchedule;
    }

    /**
     * @param String $daySchedule
     */
    public function setDaySchedule(String $daySchedule): void
    {
        $this->daySchedule = $daySchedule;
    }

    /**
     * @return int
     */
    public function getIdSchedule():int
    {
        return $this->idSchedule;
    }

    /**
     * @param int $idSchedule
     */
    public function setIdSchedule(int $idSchedule): void
    {
        $this->idSchedule = $idSchedule;
    }

    /**
     * @return Carbon
     */
    public function getStartDateSchedule(): Carbon
    {
        return $this->startDateSchedule->locale('es');
    }

    /**
     * @param Carbon $startDateSchedule
     */
    public function setStartDateSchedule(Carbon $startDateSchedule): void
    {
        $this->startDateSchedule = $startDateSchedule;
    }

    /**
     * @return Carbon
     */
    public function getEndDateSchedule(): Carbon
    {
        return $this->endDateSchedule->locale('es');
    }

    /**
     * @param Carbon $endDateSchedule
     */
    public function setEndDateSchedule(Carbon $endDateSchedule): void
    {
        $this->endDateSchedule = $endDateSchedule;
    }

    /**
     * @return int
     */
    public function getCantHours(): int
    {
        return $this->cantHours;
    }

    /**
     * @param int $cantHours
     */
    public function setCantHours(int $cantHours): void
    {
        $this->cantHours = $cantHours;
    }

    /**
     * @return Carbon
     */
    public function getStartHourSchedule(): Carbon
    {
        return $this->startHourSchedule;
    }

    /**
     * @param Carbon $startHourSchedule
     */
    public function setStartHourSchedule(Carbon $startHourSchedule): void
    {
        $this->startHourSchedule = $startHourSchedule;
    }

    /**
     * @return Carbon
     */
    public function getEndHourSchedule(): Carbon
    {
        return $this->endHourSchedule;
    }

    /**
     * @param Carbon $endHourSchedule
     */
    public function setEndHourSchedule(Carbon $endHourSchedule): void
    {
        $this->endHourSchedule = $endHourSchedule;
    }

    /**
     * @return String
     */
    public function getStateSchedule(): String
    {
        return $this->stateSchedule;
    }

    /**
     * @param String $stateSchedule
     */
    public function setStateSchedule(String $stateSchedule): void
    {
        $this->stateSchedule = $stateSchedule;
    }

    /**
     * @return int
     */
    public function getGroupIdGroup(): int
    {
        return $this->Group_idGroup;
    }

    /**
     * @param int $Group_idGroup
     */
    public function setGroupIdGroup(int $Group_idGroup): void
    {
        $this->Group_idGroup = $Group_idGroup;
    }

    //Crear un horario
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Schedule VALUES (NULL, ?,?, ?, ?, ?,?,?,?)", array(
                $this->startDateSchedule->toDateString(), //YYYY-MM-DD,
                $this->endDateSchedule->toDateString(), //YYYY-MM-DD,
                $this->cantHours,
                $this->daySchedule,
                $this->startHourSchedule->toTimeString(), //HH:MM:SS,
                $this->endHourSchedule->toTimeString(), //HH:MM:SS,
                $this->stateSchedule,
                $this->Group_idGroup->getIdGroup()
            )
        );
        $this->setIdSchedule(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  un docente
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Schedule  SET startDateSchedule = ?, endDateSchedule = ?, cantHours= ?, daySchedule = ?,startHourSchedule = ? ,endHourSchedule=?, stateSchedule=?, Group_idGroup =? WHERE idSchedule = ?", array(

                $this->startDateSchedule->toDateString(), //YYYY-MM-DD,,
                $this->endDateSchedule->toDateString(), //YYYY-MM-DD,,
                $this->cantHours,
                $this->daySchedule,
                $this->startHourSchedule->toDateTimeString(), //YYYY-MM-DD HH:MM:SS,
                $this->endHourSchedule->toDateTimeString(), //YYYY-MM-DD HH:MM:SS,
                $this->stateSchedule,
                $this->Group_idGroup->getIdGroup(),
                $this->idSchedule
            )
        );
        $this->Disconnect();
        return $result;
    }

    //inactivar un horario
    public function delete($idSchedule)
    {
        $schedule = Schedule::searchForId($idSchedule); //Buscando un Teacher por el ID
        $schedule->setStateSchedule("Inactivo"); //Cambia el estado del Teacher
        return $schedule->update();                    //Guarda los cambios..
    }
    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrSchedule = array();
        $tmp = new Schedule();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $schedule= new Schedule();
            $schedule->idSchedule=  $value['idSchedule'];
            $schedule->startDateSchedule=  Carbon::parse($value['startDateSchedule']);
            $schedule->endDateSchedule=  Carbon::parse($value['endDateSchedule']);
            $schedule->cantHours=  $value['cantHours'];
            $schedule->daySchedule=  $value['daySchedule'];
            $schedule->startHourSchedule=  Carbon::parse($value['startHourSchedule']);
            $schedule->endHourSchedule=  Carbon::parse($value['endHourSchedule']);
            $schedule->stateSchedule=  $value['stateSchedule'];
            $schedule->Group_idGroup=  Group::searchForId($value['Group_idGroup']);
            $schedule->Disconnect();
            array_push($arrSchedule, $schedule);
        }
        $tmp->Disconnect();
        return $arrSchedule;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Schedule::search("SELECT * FROM iteandes_novatik.Schedule");
    }
    public static function searchForId($idSchedule )
    {
        $schedule = null;
        if ($idSchedule  > 0) {
            $schedule= new Schedule();
            $getrow = $schedule->getRow("SELECT * FROM iteandes_novatik.Schedule WHERE idSchedule =?", array($idSchedule));
            $schedule->idSchedule=  $getrow['idSchedule'];
            $schedule->startDateSchedule=  Carbon::parse($getrow['startDateSchedule']);
            $schedule->endDateSchedule=  Carbon::parse($getrow['endDateSchedule']);
            $schedule->cantHours=  $getrow['cantHours'];
            $schedule->daySchedule=  $getrow['daySchedule'];
            $schedule->startHourSchedule=  Carbon::parse($getrow['startHourSchedule']);
            $schedule->endHourSchedule=  Carbon::parse($getrow['endHourSchedule']);
            $schedule->stateSchedule=  $getrow['stateSchedule'];
            $schedule->Group_idGroup=  Group::searchForId($getrow['Group_idGroup']);
        }
        $schedule->Disconnect();
        return $schedule;
    }

    //metodo to String
    public function __toString()
    {
        return "dia: $this->startDateSchedule->toDateString(), dia fin: $this->endDateSchedule->toDateString(), cant Horas: $this->cantHours ,dias : $this->daySchedule, hora Inicio: $this->startHourSchedule->toDateTimeString(),  hora Fin: $this->endHourSchedule->toDateTimeString(), estado $this->stateSchedule, grupo $this->Group_idGroup";
    }
}