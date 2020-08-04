<?php
namespace App\Models;
require_once ('TrainingCompetition.php');
use App\Models\TrainingCompetition;

require_once('BasicModel.php');
class  LearningResult  Extends BasicModel{

    private $idLearningResult;
    private $codeLearningResult;
    private $nameLearningResult;
    private $durationLearningResult;
    private $statuLearningResult;
    private $TrainingCompetition_idTrainingCompetition;

    /**
     * LearningResult constructor.
     * @param $idLearningResult
     * @param $codeLearningResult
     * @param $nameLearningResult
     * @param $durationLearningResult
     * @param $statuLearningResult
     * @param $TrainingCompetition_idTrainingCompetition
     */
    public function __construct($LearningResult = array())
    {
        parent::__construct();
        $this->idLearningResult = $LearningResult['idLearningResult'] ?? null;
        $this->codeLearningResult = $LearningResult['codeLearningResult'] ?? null;
        $this->nameLearningResult = $LearningResult['nameLearningResult'] ?? null;
        $this->durationLearningResult = $LearningResult['durationLearningResult'] ?? null;
        $this->statuLearningResult = $LearningResult['statuLearningResult'] ?? null;
        $this->TrainingCompetition_idTrainingCompetition = $LearningResult['TrainingCompetition_idTrainingCompetition'] ?? null;
    }
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     *
     */
    public function getIdLearningResult(): int

    {
        return $this->idLearningResult;
    }

    /**
     * @param int $idLearningResult
     */
    public function setIdLearningResult(int $idLearningResult): void
    {
        $this->idLearningResult = $idLearningResult;
    }

    /**
     * @return int
     */
    public function getCodeLearningResult(): int
    {
        return $this->codeLearningResult;
    }

    /**
     * @param int $codeLearningResult
     */
    public function setCodeLearningResult(int $codeLearningResult): void
    {
        $this->codeLearningResult = $codeLearningResult;
    }

    /**
     * @return String
     */
    public function getNameLearningResult(): String
    {
        return $this->nameLearningResult;
    }

    /**
     * @param String  $nameLearningResult
     */
    public function setNameLearningResult(String  $nameLearningResult): void
    {
        $this->nameLearningResult = $nameLearningResult;
    }

    /**
     * @return int
     */
    public function getDurationLearningResult():int
    {
        return $this->durationLearningResult;
    }

    /**
     * @param int $durationLearningResult
     */
    public function setDurationLearningResult(int $durationLearningResult): void
    {
        $this->durationLearningResult = $durationLearningResult;
    }

    /**
     * @return String
     */
    public function getStatuLearningResult(): String
    {
        return $this->statuLearningResult;
    }

    /**
     * @param String $statuLearningResult
     */
    public function setStatuLearningResult(String $statuLearningResult): void
    {
        $this->statuLearningResult = $statuLearningResult;
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

    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrLearningResult = array();
        $tmp = new LearningResult ();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $LearningResult = new  LearningResult();
            $LearningResult->idLearningResult = $value['idLearningResult'];
            $LearningResult->codeLearningResult = $value['codeLearningResult'];
            $LearningResult->nameLearningResult = $value['nameLearningResult'];
            $LearningResult->durationLearningResult = $value['durationLearningResult'];
            $LearningResult->statuLearningResult = $value['statuLearningResult'];
            $LearningResult->TrainingCompetition_idTrainingCompetition = TrainingCompetition::searchForId($value['TrainingCompetition_idTrainingCompetition']);

            $LearningResult->Disconnect();
            array_push($arrLearningResult, $LearningResult);
        }
        $tmp->Disconnect();
        return $arrLearningResult;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return LearningResult::search("SELECT * FROM iteandes_novatik.LearningResult");
    }
///Buscar por id LearningResult
    /**
     * @param $idLearningResult¿
     * @return mixed
     */
    public static function searchForId($idLearningResult) : LearningResult
    {
        $learning = null;
        if ($idLearningResult  > 0) {
            $learning= new LearningResult();
            $getrow = $learning->getRow("SELECT * FROM iteandes_novatik.LearningResult WHERE idLearningResult =?", array($idLearningResult));
            $learning->codeLearningResult = $getrow['codeLearningResult'];
            $learning->nameLearningResult = $getrow['nameLearningResult'];
            $learning->durationLearningResult = $getrow['durationLearningResult'];
            $learning->TrainingCompetition_idTrainingCompetition = TrainingCompetition::searchForId($getrow['TrainingCompetition_idTrainingCompetition']);
            $learning->statuLearningResult = $getrow['statuLearningResult'];
            $learning->idLearningResult = $getrow['idLearningResult'];
        }
        $learning->Disconnect();
        return $learning;
    }
    ////////////////////crear a un LearningResult
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.LearningResult VALUES (NULL, ?, ?, ?, ?,?)", array(
                $this->codeLearningResult,
                $this->nameLearningResult,
                $this->durationLearningResult,
                $this->statuLearningResult,
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingCompetition()
            )
        );
        $this->setIdLearningResult(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }
    ///////////////////Actualizar  un LearningResult
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.LearningResult  SET codeLearningResult = ?, nameLearningResult = ?, durationLearningResult= ?, TrainingCompetition_idTrainingCompetition = ?, statuLearningResult = ? WHERE idLearningResult = ?", array(
                $this->codeLearningResult,
                $this->nameLearningResult,
                $this->durationLearningResult,
                $this->TrainingCompetition_idTrainingCompetition->getIdTrainingCompetition(),
                $this->statuLearningResult,
                $this->idLearningResult
            )
        );
        $this->Disconnect();
        return $result;
    }

////inactivar un LearningResult
    public function delete($idLearningResult) : bool{
        $LearningResult = LearningResult::searchForId($idLearningResult); //Buscando un Programa por el ID
        $LearningResult->setStatuLearningResult("Inactivo"); //Cambia el estado del Programa
        return $LearningResult->update();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "codeLearningResult: $this->codeLearningResult, nameLearningResult: $this->nameLearningResult, durationLearningResult: $this->durationLearningResult , statuLearningResult: $this->statuLearningResult:,TrainingCompetition_idTrainingCompetition: $this->TrainingCompetition_idTrainingCompetition: idLearningResult: $this->idLearningResult";

    }

}
