<?php
namespace App\Models;
require_once ('BasicModel.php');
class Activity extends BasicModel
{
    private $idActivity;
    private $codeActivity;
    private $nameActivity;
    private $descriptionActivity;
    private $typeActivity;
    private $LearningResult_idLearningResult;
    private $stateActivity;

    /**
     * Activity constructor.
     * @param $idActivity
     * @param $codeActivity
     * @param $nameActivity
     * @param $descriptionActivity
     * @param $typeActivity
     * @param $LearningResult_idLearningResult
     * @param $stateActivity
     */
    public function __construct()
    {
        parent::__construct();
        $this->idActivity = $Activity['idActivity'] ?? null;
        $this->codeActivity = $Activity['codeActivity'] ?? null;
        $this->nameActivity = $Activity['nameActivity'] ?? null;
        $this->descriptionActivity = $Activity['descriptionActivity'] ?? null;
        $this->typeActivity = $Activity['typeActivity'] ?? null;
        $this->LearningResult_idLearningResult = $Activity['LearningResult_idLearningResult'] ?? null;
        $this->stateActivity = $Activity['stateActivity'] ?? null;
    }
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdActivity(): int
    {
        return $this->idActivity;
    }

    /**
     * @param int $idActivity
     */
    public function setIdActivity(int $idActivity): void
    {
        $this->idActivity = $idActivity;
    }

    /**
     * @return int
     */
    public function getCodeActivity(): int
    {
        return $this->codeActivity;
    }

    /**
     * @param int $codeActivity
     */
    public function setCodeActivity(int $codeActivity): void
    {
        $this->codeActivity = $codeActivity;
    }

    /**
     * @return String
     */
    public function getNameActivity(): String
    {
        return $this->nameActivity;
    }

    /**
     * @param String  $nameActivity
     */
    public function setNameActivity(String $nameActivity): void
    {
        $this->nameActivity = $nameActivity;
    }

    /**
     * @return String
     */
    public function getDescriptionActivity(): String
    {
        return $this->descriptionActivity;
    }

    /**
     * @param String $descriptionActivity
     */
    public function setDescriptionActivity(String $descriptionActivity): void
    {
        $this->descriptionActivity = $descriptionActivity;
    }

    /**
     * @return String
     */
    public function getTypeActivity(): String
    {
        return $this->typeActivity;
    }

    /**
     * @param String $typeActivity
     */
    public function setTypeActivity(String $typeActivity): void
    {
        $this->typeActivity = $typeActivity;
    }

    /**
     * @return int
     */
    public function getLearningResultIdLearningResult(): LearningResult
    {
        return $this->LearningResult_idLearningResult;
    }

    /**
     * @param int $LearningResult_idLearningResult
     */
    public function setLearningResultIdLearningResult(int $LearningResult_idLearningResult): void
    {
        $this->LearningResult_idLearningResult = $LearningResult_idLearningResult;
    }

    /**
     * @return String
     */
    public function getStateActivity(): String
    {
        return $this->stateActivity;
    }

    /**
     * @param String $stateActivity
     */
    public function setStateActivity(String $stateActivity): void
    {
        $this->stateActivity = $stateActivity;
    }
    //crear Activity
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Activity VALUES (NULL, ?, ?, ?, ?,?,?)", array(
                $this->codeActivity,
                $this->nameActivity,
                $this->descriptionActivity,
                $this->typeActivity,
                $this->LearningResult_idLearningResult->getIdLearningResult(),
                $this->stateActivity
            )
        );
        $this->setIdActivity(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  una Activity
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Activity  SET codeActivity = ?, nameActivity = ?, descriptionActivity= ?, typeActivity = ?, LearningResult_idLearningResult=?, stateActivity=? WHERE idActivity = ?", array(
                $this->idActivity,
                $this->codeActivity,
                $this->nameActivity,
                $this->descriptionActivity,
                $this->typeActivity,
                $this->LearningResult_idLearningResult->getIdLearningResult(),
                $this->stateActivity
            )
        );
        $this->Disconnect();
        return $result;
    }
//inactivar un Activity
    public function delete($idActivity)
    {
        $Activity = Activity::searchForId($idActivity); //Buscando un Activity por el ID
        $Activity->setStateActivity("Inactivo"); //Cambia el estado del Activity
        return $Activity->update();                    //Guarda los cambios..
    }
    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrActivity = array();
        $tmp = new Activity();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $Activity= new Activity();
            $Activity->idActivity = $value['idActivity'];
            $Activity->codeActivity = $value['codeActivity'];
            $Activity->nameActivity = $value['nameActivity'];
            $Activity->descriptionActivity = $value['descriptionActivity'];
            $Activity->typeActivity = $value['typeActivity'];
            $Activity->LearningResult_idLearningResult= LearningResult::searchForId($value['LearningResult_idLearningResult']);
            $Activity->stateActivity = $value['stateActivity'];
            $Activity->Disconnect();
            array_push($arrActivity, $Activity);
        }
        $tmp->Disconnect();
        return $arrActivity;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Activity::search("SELECT * FROM iteandes_novatik.Activity");
    }

    public static function searchForId($idActivity)
    {
        $Activity = null;
        if ($idActivity  > 0) {
            $Activity= new Activity();
            $getrow = $Activity->getRow("SELECT * FROM iteandes_novatik.Activity WHERE idActivity =?", array($idActivity));
            $Activity->idActivity = $getrow['idActivity'];
            $Activity->codeActivity = $getrow['codeActivity'];
            $Activity->nameActivity = $getrow['nameActivity'];
            $Activity->descriptionActivity = $getrow['descriptionActivity'];
            $Activity->typeActivity = $getrow['typeActivity'];
            $Activity->LearningResult_idLearningResult= LearningResult::searchForId($getrow['LearningResult_idLearningResult']);
            $Activity->stateActivity = $getrow['stateActivity'];
        }
        $Activity->Disconnect();
        return $Activity;
    }
    public function __toString()
    {
        return "id: $this->idActivity,codigo: $this->codeActivity, nombre: $this->nameActivity, descripcion: $this->descriptionActivity , tipo de actividad: $this->typeActivity,  resultado: $this->LearningResult_idLearningResult, estado: $this->stateActivity";
    }

}