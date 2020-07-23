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

    /**
     * Group constructor.
     * @param $idGroup
     * @param $codeGroup
     * @param $nameGroup
     * @param $minimumSpaceGroup
     * @param $maximumSpaceGroup
     * @param $stateGroup
     * @param $TrainingCompetition_idTrainingCompetition
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
    public function getTrainingCompetitionIdTrainingCompetition(): int
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
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Group VALUES (NULL, ?, ?, ?, ?,?,?)", array(
                $this->codeGroup,
                $this->nameGroup,
                $this->minimumSpaceGroup,
                $this->maximumSpaceGroup,
                $this->stateGroup,
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingProgram()
            )
        );
        $this->setIdGroup(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }
    //Actualizar  un Grupo
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Group  SET codeGroup = ?, nameGroup = ?, minimumSpaceGroup= ?, maximumSpaceGroup = ?,stateGroup=?,TrainingCompetition_idTrainingCompetition=?  WHERE idGroup = ?", array(
                $this->idGroup,
                $this->codeGroup,
                $this->nameGroup,
                $this->minimumSpaceGroup,
                $this->maximumSpaceGroup,
                $this->stateGroup,
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingProgram()
            )
        );
        $this->Disconnect();
        return $result;
    }
    //inactivar un Grupo
    public function delete($idGroup)
    {
        $Group = Group::searchForId($idGroup); //Buscando un Teacher por el ID
        $Group->setStateGroup("Inactivo"); //Cambia el estado del Teacher
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
                $group->TrainingCompetition_idTrainingCompetition = TrainingProgram::searchForId($value['TrainingCompetition_idTrainingCompetition']);
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
            $group->TrainingCompetition_idTrainingCompetition = TrainingProgram::searchForId($getrow['TrainingCompetition_idTrainingCompetition']);
        }
        $group->Disconnect();
        return $group;
    }
    public function __toString()
    {
        return "codigo: $this->codeGroup, nombre: $this->nameGroup, cupo minimo: $this->minimumSpaceGroup , cupo maximo: $this->maximumSpaceGroup,  estado: $this->stateGroup, competencia: $this->TrainingCompetition_idTrainingCompetition";
    }

}