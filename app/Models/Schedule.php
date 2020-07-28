<?php

namespace  App\Models;

require_once ('BasicModel.php');

class Schedule extends BasicModel{

    private $idSchedule;
    private $startDateSchedule;
    private $endDateSchedule;
    private $cantHours;
    private $startHourSchedule;
    private $endHourSchedule;
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
        $this->startDateSchedule = $schedule['startDateSchedule'] ?? nulle;
        $this->endDateSchedule = $schedule['endDateSchedule'] ?? null;
        $this->cantHours = $schedule['cantHours'] ?? null;
        $this->startHourSchedule = $schedule['startHourSchedule'] ?? null;
        $this->endHourSchedule = $schedule['endHourSchedule'] ?? null;
        $this->stateSchedule = $schedule['stateSchedule'] ?? null;
        $this->Group_idGroup = $schedule['Group_idGroup'] ?? null;
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
     * @return date
     */
    public function getStartDateSchedule()
    {
        return $this->startDateSchedule;
    }

    /**
     * @param date $startDateSchedule
     */
    public function setStartDateSchedule(date $startDateSchedule): void
    {
        $this->startDateSchedule = $startDateSchedule;
    }

    /**
     * @return date
     */
    public function getEndDateSchedule()
    {
        return $this->endDateSchedule;
    }

    /**
     * @param date $endDateSchedule
     */
    public function setEndDateSchedule(date $endDateSchedule): void
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
     * @return date
     */
    public function getStartHourSchedule()
    {
        return $this->startHourSchedule;
    }

    /**
     * @param date $startHourSchedule
     */
    public function setStartHourSchedule(date $startHourSchedule): void
    {
        $this->startHourSchedule = $startHourSchedule;
    }

    /**
     * @return date
     */
    public function getEndHourSchedule()
    {
        return $this->endHourSchedule;
    }

    /**
     * @param date $endHourSchedule
     */
    public function setEndHourSchedule(date $endHourSchedule): void
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
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Schedule VALUES (NULL, ?, ?, ?, ?,?,?,?)", array(
                $this->startDateSchedule,
                $this->endDateSchedule,
                $this->cantHours,
                $this->startHourSchedule,
                $this->endHourSchedule,
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
        $result = $this->updateRow("UPDATE iteandes_novatik.Schedule  SET startDateSchedule = ?, endDateSchedule = ?, cantHours= ?, startHourSchedule = ? ,endHourSchedule=?, stateSchedule=?, Group_idGroup =? WHERE idSchedule = ?", array(
                $this->idSchedule,
                $this->startDateSchedule,
                $this->endDateSchedule,
                $this->cantHours,
                $this->startHourSchedule,
                $this->endHourSchedule,
                $this->stateSchedule,
                $this->Group_idGroup->getIdGroup()
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
            $schedule->startDateSchedule=  $value['startDateSchedule'];
            $schedule->endDateSchedule=  $value['endDateSchedule'];
            $schedule->cantHours=  $value['cantHours'];
            $schedule->startHourSchedule=  $value['startHourSchedule'];
            $schedule->endHourSchedule=  $value['endHourSchedule'];
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
        $teacher = null;
        if ($idSchedule  > 0) {
            $schedule= new Schedule();
            $getrow = $teacher->getRow("SELECT * FROM iteandes_novatik.Schedule WHERE idSchedule =?", array($idSchedule));
            $schedule->idSchedule=  $getrow['idSchedule'];
            $schedule->startDateSchedule=  $getrow['startDateSchedule'];
            $schedule->endDateSchedule=  $getrow['endDateSchedule'];
            $schedule->cantHours=  $getrow['cantHours'];
            $schedule->startHourSchedule=  $getrow['startHourSchedule'];
            $schedule->endHourSchedule=  $getrow['endHourSchedule'];
            $schedule->stateSchedule=  $getrow['stateSchedule'];
            $schedule->Group_idGroup=  Group::searchForId($getrow['Group_idGroup']);
        }
        $schedule->Disconnect();
        return $teacher;
    }

    //metodo to String
    public function __toString()
    {
        return "dia: $this->startDateSchedule, dia fin: $this->endDateSchedule, cant Horas: $this->cantHours , hora Inicio: $this->startHourSchedule,  hora Fin: $this->endHourSchedule, estado $this->stateSchedule, grupo $this->Group_idGroup";
    }
}