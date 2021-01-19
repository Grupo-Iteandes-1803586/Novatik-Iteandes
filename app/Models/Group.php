<?php

namespace App\Models;

require_once ('BasicModel.php');

class Group extends BasicModel{

    private $idGroup;
    private $codeGroup;
    private $nameGroup;
    private $minimumSpaceGroup ;
    private $maximumSpaceGroup;
    private $stateGroup;
    private $TrainingCompetition_idTrainingCompetition;
    private $Schedule_idSchedule;
    private $Teacher_idTeacher;

    /**
     * Group constructor.
     * @param $idGroup
     * @param $codeGroup
     * @param $nameGroup
     * @param $minimumSpaceGroup
     * @param $maximumSpaceGroup
     * @param $stateGroup
     * @param $TrainingCompetition_idTrainingCompetition
     * @param $Schedule_idSchedule
     * @param $Teacher_idTeacher
     */
    public function __construct($group = array())
    {
        parent::__construct();
        $this->idGroup = $group['idGroup'] ?? null;
        $this->codeGroup = $group['codeGroup'] ?? null;
        $this->nameGroup = $group['nameGroup'] ?? null;
        $this->minimumSpaceGroup = $group['minimumSpaceGroup'] ?? null;
        $this->maximumSpaceGroup = $group['maximumSpaceGroup'] ?? null;
        $this->stateGroup = $group['stateGroup'] ?? null;
        $this->TrainingCompetition_idTrainingCompetition = $group['TrainingCompetition_idTrainingCompetition'] ?? null;
        $this->Schedule_idSchedule = $group['Schedule_idSchedule'] ?? null;
        $this->Teacher_idTeacher = $group['Teacher_idTeacher'] ?? null;
    }

    /**
     * @return Teacher
     */
    public function getTeacherIdTeacher(): Teacher
    {
        return $this->Teacher_idTeacher;
    }

    /**
     * @param int $Teacher_idTeacher
     */
    public function setTeacherIdTeacher(int $Teacher_idTeacher): void
    {
        $this->Teacher_idTeacher = $Teacher_idTeacher;
    }

    /**
     * @return int
     */
    public function getScheduleIdSchedule(): Schedule
    {
        return $this->Schedule_idSchedule;
    }

    /**
     * @param int $Schedule_idSchedule
     */
    public function setScheduleIdSchedule(int $Schedule_idSchedule): void
    {
        $this->Schedule_idSchedule = $Schedule_idSchedule;
    }

    /**
     * @return int
     */
    public function getIdGroup(): int
    {
        return $this->idGroup;
    }

    /**
     * @param int $idGroup
     */
    public function setIdGroup(int$idGroup): void
    {
        $this->idGroup = $idGroup;
    }

    /**
     * @return int
     */
    public function getCodeGroup(): int
    {
        return $this->codeGroup;
    }

    /**
     * @param int $codeGroup
     */
    public function setCodeGroup(int$codeGroup): void
    {
        $this->codeGroup = $codeGroup;
    }

    /**
     * @return String
     */
    public function getNameGroup(): String
    {
        return $this->nameGroup;
    }

    /**
     * @param String $nameGroup
     */
    public function setNameGroup(String $nameGroup): void
    {
        $this->nameGroup = $nameGroup;
    }

    /**
     * @return int
     */
    public function getMinimumSpaceGroup(): int
    {
        return $this->minimumSpaceGroup;
    }

    /**
     * @param int $minimumSpaceGroup
     */
    public function setMinimumSpaceGroup(int $minimumSpaceGroup): void
    {
        $this->minimumSpaceGroup = $minimumSpaceGroup;
    }

    /**
     * @return int
     */
    public function getMaximumSpaceGroup(): int
    {
        return $this->maximumSpaceGroup;
    }

    /**
     * @param int $maximumSpaceGroup
     */
    public function setMaximumSpaceGroup(int $maximumSpaceGroup): void
    {
        $this->maximumSpaceGroup = $maximumSpaceGroup;
    }

    /**
     * @return String
     */
    public function getStateGroup():String
    {
        return $this->stateGroup;
    }

    /**
     * @param String $stateGroup
     */
    public function setStateGroup(String $stateGroup): void
    {
        $this->stateGroup = $stateGroup;
    }

    /**
     * @return int
     */
    public function getTrainingCompetitionIdTrainingCompetition(): TrainingCompetition
    {
        return $this->TrainingCompetition_idTrainingCompetition;
    }

    /**
     * @param int $TrainingCompetition_idTrainingCompetition
     */
    public function setTrainingCompetitionIdTrainingCompetition(int $TrainingCompetition_idTrainingCompetition): void
    {
        $this->TrainingCompetition_idTrainingCompetition = $TrainingCompetition_idTrainingCompetition;
    }

    //funcion cierre de conexion
    function __destruct()
    {
        $this->Disconnect();
    }
//Funcion crear un grupo
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Group VALUES (NULL, ?, ?, ?, ?,?,?,?,?)", array(
                $this->codeGroup,
                $this->nameGroup,
                $this->minimumSpaceGroup,
                $this->maximumSpaceGroup,
                $this->stateGroup,
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingCompetition(),
                $this->Schedule_idSchedule->getIdSchedule(),
                $this->Teacher_idTeacher->getIdTeacher()
            )
        );
        $this->setIdGroup(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  un Grupo
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Group  SET codeGroup = ?, nameGroup = ?, minimumSpaceGroup= ?, maximumSpaceGroup = ?,stateGroup = ?,TrainingCompetition_idTrainingCompetition = ?,Schedule_idSchedule = ?,Teacher_idTeacher = ?   WHERE idGroup = ?", array(
                $this->codeGroup,
                $this->nameGroup,
                $this->minimumSpaceGroup,
                $this->maximumSpaceGroup,
                $this->stateGroup,
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingCompetition(),
                $this->Schedule_idSchedule->getIdSchedule(),
                $this->Teacher_idTeacher->getIdTeacher(),
                $this->idGroup
            )
        );
        $this->Disconnect();
        return $result;
    }
    //inactivar un Grupo
    public function delete($idGroup)
    {
        $Group = Group::searchForId($idGroup); //Buscando un Teacher por el ID
        $Group->setStateGroup("Inactivo"); //Cambia el estado
        return $Group->update();                    //Guarda los cambios..
    }
    //Funcion buscar por jquery
    public static function search($query)
    {
            $arrGroup = array();
            $tmp = new Group();
            $getrows = $tmp->getRows($query);
            foreach ($getrows as $value) {
                $group = new Group();
                $group->idGroup = $value['idGroup'];
                $group->codeGroup = $value['codeGroup'];
                $group->nameGroup = $value['nameGroup'];
                $group->minimumSpaceGroup = $value['minimumSpaceGroup'];
                $group->maximumSpaceGroup = $value['maximumSpaceGroup'];
                $group->stateGroup = $value['stateGroup'];
                $group->TrainingCompetition_idTrainingCompetition = TrainingCompetition::searchForId($value['TrainingCompetition_idTrainingCompetition']);
                $group->Schedule_idSchedule = Schedule::searchForId($value['Schedule_idSchedule']);
                $group->Teacher_idTeacher = Teacher::searchForIdTeacher($value['Teacher_idTeacher']);
                $group->Disconnect();
                array_push($arrGroup,$group);
            }
        $tmp->Disconnect();
        return $arrGroup;
        }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Group::search("SELECT * FROM iteandes_novatik.Group");
    }

    public static function searchForId($idGroup)
    {
        $group = null;
        if ($idGroup  > 0) {
            $group= new Group();
            $getrow = $group->getRow("SELECT * FROM iteandes_novatik.Group WHERE idGroup =?", array($idGroup));
            $group->idGroup = $getrow['idGroup'];
            $group->codeGroup = $getrow['codeGroup'];
            $group->nameGroup = $getrow['nameGroup'];
            $group->minimumSpaceGroup = $getrow['minimumSpaceGroup'];
            $group->maximumSpaceGroup = $getrow['maximumSpaceGroup'];
            $group->stateGroup = $getrow['stateGroup'];
            $group->TrainingCompetition_idTrainingCompetition = TrainingCompetition::searchForId($getrow['TrainingCompetition_idTrainingCompetition']);
            $group->Schedule_idSchedule = Schedule::searchForId($getrow['Schedule_idSchedule']);
            $group->Teacher_idTeacher = Teacher::searchForIdTeacher($getrow['Teacher_idTeacher']);
        }
        $group->Disconnect();
        return $group;
    }
    public function __toString()
    {
        return "codigo: $this->codeGroup, nombre: $this->nameGroup, cupo minimo: $this->minimumSpaceGroup , cupo maximo: $this->maximumSpaceGroup,  estado: $this->stateGroup, competencia: $this->TrainingCompetition_idTrainingCompetition, Horario: $this->Schedule_idSchedule,Docente : $this->Teacher_idTeacher";
    }

}