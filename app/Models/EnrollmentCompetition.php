<?php
namespace App\Models;
require_once ('BasicModel.php');

class EnrollmentCompetition extends BasicModel
{

    private $idEnrollmentCompetition;
    private $Enrollment_idEnrollment;
    private $Schedule_idSchedule;
    private $TrainingCompetition_idTrainingCompetition;
    private $stateEnrollmentCompetition;

    /**
     * EnrollmentCompetition constructor.
     * @param $idEnrollmentCompetition
     * @param $Enrollment_idEnrollment
     * @param $Schedule_idSchedule
     * @param $TrainingCompetition_idTrainingCompetition
     * @param $stateEnrollmentCompetition
     */
    public function __construct()
    {
        parent::__construct();
        $this->idEnrollmentCompetition = $EnrollmentCompetition['idEnrollmentCompetition'] ?? null;
        $this->Enrollment_idEnrollment = $EnrollmentCompetition['Enrollment_idEnrollment'] ?? null;
        $this->Schedule_idSchedule = $EnrollmentCompetition['Schedule_idSchedule'] ?? null;
        $this->TrainingCompetition_idTrainingCompetition = $EnrollmentCompetition['TrainingCompetition_idTrainingCompetition'] ?? null;
        $this->stateEnrollmentCompetition = $EnrollmentCompetition['stateEnrollmentCompetition'] ?? null;
    }

    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdEnrollmentCompetition(): int
    {
        return $this->idEnrollmentCompetition;
    }

    /**
     * @param int $idEnrollmentCompetition
     */
    public function setIdEnrollmentCompetition(int $idEnrollmentCompetition): void
    {
        $this->idEnrollmentCompetition = $idEnrollmentCompetition;
    }

    /**
     * @return int
     */
    public function getEnrollmentIdEnrollment(): int
    {
        return $this->Enrollment_idEnrollment;
    }

    /**
     * @param int $Enrollment_idEnrollment
     */
    public function setEnrollmentIdEnrollment(int $Enrollment_idEnrollment): void
    {
        $this->Enrollment_idEnrollment = $Enrollment_idEnrollment;
    }

    /**
     * @return int
     */
    public function getScheduleIdSchedule(): int
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

    /**
     * @return String
     */
    public function getStateEnrollmentCompetition(): String
    {
        return $this->stateEnrollmentCompetition;
    }

    /**
     * @param String $stateEnrollmentCompetition
     */
    public function setStateEnrollmentCompetition(String $stateEnrollmentCompetition): void
    {
        $this->stateEnrollmentCompetition = $stateEnrollmentCompetition;
    }

//crear EnrollmentCompetition
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.EnrollmentCompetition VALUES (NULL, ?, ?, ?, ?)", array(

                $this->Enrollment_idEnrollment->getIdEnrollment(),
                $this->Schedule_idSchedule->getIdSchedule(),
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingCompetition(),
                $this->stateEnrollmentCompetition
            )
        );
        $this->setIdEnrollmentCompetition(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  un EnrollmentCompetition
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.EnrollmentCompetition  SET Enrollment_idEnrollment = ?, Schedule_idSchedule = ?, TrainingCompetition_idTrainingCompetition= ?, stateEnrollmentCompetition=? WHERE idEnrollmentCompetition = ?", array(
                $this->idEnrollmentCompetition,
                $this->Enrollment_idEnrollment->getIdEnrollment(),
                $this->Schedule_idSchedule->getIdSchedule(),
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingCompetition(),
                $this->stateEnrollmentCompetition
            )
        );
        $this->Disconnect();
        return $result;
    }

//inactivar un EnrollmentCompetition
    public function delete($idEnrollmentCompetition)
    {
        $EnrollmentCompetition = EnrollmentCompetition::searchForId($idEnrollmentCompetition); //Buscando un EnrollmentCompetition por el ID
        $EnrollmentCompetition->setStateEnrollmentCompetition("Inactivo"); //Cambia el estado del EnrollmentCompetition
        return $EnrollmentCompetition->update();                    //Guarda los cambios..
    }

    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrEnrollmentCompetition = array();
        $tmp = new EnrollmentCompetition();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $EnrollmentCompetition = new EnrollmentCompetition();
            $EnrollmentCompetition->idEnrollmentCompetition = $value['idEnrollmentCompetition'];
            $EnrollmentCompetition->Enrollment_idEnrollment = Enrollment::searchForId($value['Enrollment_idEnrollment']);
            $EnrollmentCompetition->Schedule_idSchedule = Schedule::searchForId($value['Schedule_idSchedule']);
            $EnrollmentCompetition->TrainingCompetition_idTrainingCompetition = TrainingCompetition::searchForId($value['TrainingCompetition_idTrainingCompetition']);
            $EnrollmentCompetition->stateEnrollmentCompetition = $value['stateEnrollmentCompetition'];
            $EnrollmentCompetition->Disconnect();
            array_push($arrEnrollmentCompetition, $EnrollmentCompetition);
        }
        $tmp->Disconnect();
        return $arrEnrollmentCompetition;
    }

    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Note::search("SELECT * FROM iteandes_novatik.EnrollmentCompetition");
    }

    public static function searchForId($idEnrollmentCompetition)
    {
        $idEnrollmentCompetition = null;
        if ($idEnrollmentCompetition > 0) {
            $EnrollmentCompetition= new EnrollmentCompetition();
            $getrow = $EnrollmentCompetition->getRow("SELECT * FROM iteandes_novatik.EnrollmentCompetition WHERE idEnrollmentCompetition =?", array($idEnrollmentCompetition));
            $EnrollmentCompetition->idEnrollmentCompetition = $getrow['idEnrollmentCompetition'];
            $EnrollmentCompetition->Enrollment_idEnrollment = Enrollment::searchForId($getrow['Enrollment_idEnrollment']);
            $EnrollmentCompetition->Schedule_idSchedule = Schedule::searchForId($getrow['Schedule_idSchedule']);
            $EnrollmentCompetition->TrainingCompetition_idTrainingCompetition = TrainingCompetition::searchForId($getrow['TrainingCompetition_idTrainingCompetition']);
            $EnrollmentCompetition->stateEnrollmentCompetition = $getrow['stateEnrollmentCompetition'];
        }
        $EnrollmentCompetition->Disconnect();
        return $EnrollmentCompetition;
    }
    public function __toString()
    {
        return "id: $this->idEnrollmentCompetition,matricula: $this->Enrollment_idEnrollment, horario: $this->Schedule_idSchedule , programa: $this->TrainingCompetition_idTrainingCompetition, estado: $this->stateEnrollmentCompetition";
    }
}