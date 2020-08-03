<?php

namespace App\Models;
require_once("BasicModel.php");

class TrainingCompetition extends BasicModel{
    private $idTrainingCompetition;
    private $codeTrainingCompetition;
    private $codeAlfaTrainingCompetition;
    private $denomination;
    private $duration;
    private $minimumSpace;
    private $orderTrainingCompetition;
    private $statusTrainingCompetition;
    private $TrainingProgram_idTrainingProgram;

    /**
     * TrainingCompetition constructor.
     * @param $idTrainingCompetition
     * @param $codeTrainingCompetition
     * @param $codeAlfaTrainingCompetition
     * @param $denomination
     * @param $duration
     * @param $minimumSpace
     * @param $orderTrainingCompetition
     * @param $statusTrainingCompetition
     * @param $TrainingProgram_idTrainingProgram
     */
    public function __construct($trainingCompetition = array())
    {
        parent::__construct();
        $this->idTrainingCompetition =$trainingCompetition['idTrainingCompetition']  ?? null;
        $this->codeTrainingCompetition = $trainingCompetition['codeTrainingCompetition'] ?? null;
        $this->codeAlfaTrainingCompetition = $trainingCompetition['codeAlfaTrainingCompetition'] ?? null;
        $this->denomination = $trainingCompetition['denomination'] ?? null;
        $this->duration = $trainingCompetition['duration'] ?? null;
        $this->minimumSpace = $trainingCompetition['minimumSpace'] ?? null;
        $this->orderTrainingCompetition = $trainingCompetition['orderTrainingCompetition'] ?? null;
        $this->statusTrainingCompetition = $trainingCompetition['statusTrainingCompetition'] ?? null;
        $this->TrainingProgram_idTrainingProgram = $trainingCompetition['TrainingProgram_idTrainingProgram'] ?? null;
    }
    /*Metodo destructor cierre de la conexion*/
    function __destruct(){
        $this->Disconnect();
    }
    /**
     * @return int
     */
    public function getIdTrainingCompetition(): int
    {
        return $this->idTrainingCompetition;
    }

    /**
     * @param int $idTrainingCompetition
     */
    public function setIdTrainingCompetition(int $idTrainingCompetition): void
    {
        $this->idTrainingCompetition = $idTrainingCompetition;
    }

    /**
     * @return String
     */
    public function getCodeAlfaTrainingCompetition(): String
    {
        return $this->codeAlfaTrainingCompetition;
    }

    /**
     * @param String $codeAlfaTrainingCompetition
     */
    public function setCodeAlfaTrainingCompetition(String $codeAlfaTrainingCompetition): void
    {
        $this->codeAlfaTrainingCompetition = $codeAlfaTrainingCompetition;
    }

    /**
     * @return int
     */
    public function getCodeTrainingCompetition(): int
    {
        return $this->codeTrainingCompetition;
    }

    /**
     * @param int $codeTrainingCompetition
     */
    public function setCodeTrainingCompetition(int $codeTrainingCompetition): void
    {
        $this->codeTrainingCompetition = $codeTrainingCompetition;
    }

    /**
     * @return String
     */
    public function getDenomination(): String
    {
        return $this->denomination;
    }

    /**
     * @param String $denomination
     */
    public function setDenomination(String$denomination): void
    {
        $this->denomination = $denomination;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int$duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function getMinimumSpace():int
    {
        return $this->minimumSpace;
    }

    /**
     * @param int$minimumSpace
     */
    public function setMinimumSpace(int $minimumSpace): void
    {
        $this->minimumSpace = $minimumSpace;
    }

    /**
     * @return int
     */
    public function getOrderTrainingCompetition(): int
    {
        return $this->orderTrainingCompetition;
    }

    /**
     * @param int $orderTrainingCompetition
     */
    public function setOrderTrainingCompetition(int $orderTrainingCompetition): void
    {
        $this->orderTrainingCompetition = $orderTrainingCompetition;
    }

    /**
     * @return String
     */
    public function getStatusTrainingCompetition():String
    {
        return $this->statusTrainingCompetition;
    }

    /**
     * @paramint $statusTrainingCompetition
     */
    public function setStatusTrainingCompetition(String $statusTrainingCompetition): void
    {
        $this->statusTrainingCompetition = $statusTrainingCompetition;
    }

    /**
     * @return int
     */
    public function getTrainingProgramIdTrainingProgram(): TrainingProgram
    {
        return $this->TrainingProgram_idTrainingProgram;
    }

    /**
     * @param int $TrainingProgram_idTrainingProgram
     */
    public function setTrainingProgramIdTrainingProgram(int $TrainingProgram_idTrainingProgram): void
    {
        $this->TrainingProgram_idTrainingProgram = $TrainingProgram_idTrainingProgram;
    }

    //metodo crear una competencia
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.TrainingCompetition VALUES (NULL, ?,?, ?, ?, ?,?,?,?)", array(
                $this->codeTrainingCompetition,
                $this->codeAlfaTrainingCompetition,
                $this->denomination,
                $this->duration,
                $this->minimumSpace,
                $this->orderTrainingCompetition,
                $this->statusTrainingCompetition,
                $this->TrainingProgram_idTrainingProgram->getIdTrainingProgram()
            )
        );
        $this->setIdTrainingCompetition(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actulizar una competencia
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.TrainingCompetition  SET codeTrainingCompetition = ?,codeAlfaTrainingCompetition = ?, denomination = ?, orderTrainingCompetition =?, duration= ?, minimumSpace = ?,  statusTrainingCompetition =?,TrainingProgram_idTrainingProgram=? WHERE idTrainingCompetition = ?", array(
                $this->codeTrainingCompetition,
                $this->codeAlfaTrainingCompetition,
                $this->denomination,
                $this->duration,
                $this->minimumSpace,
                $this->orderTrainingCompetition,
                $this->statusTrainingCompetition,
                $this->TrainingProgram_idTrainingProgram->getIdTrainingProgram(),
                $this->idTrainingCompetition
            )
        );
        $this->Disconnect();
        return $result;
    }
    //cambio de estado
    public function delete($idTrainingCompetition) : bool{
        $trainingC = TrainingCompetition::searchForId($idTrainingCompetition); //Buscando un Programa por el ID
        $trainingC->setStatusTrainingCompetition("Inactivo"); //Cambia el estado del Programa
        return $trainingC->update();
    }
    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrTrainigCompetition = array();
        $tmp = new TrainingCompetition();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $competition = new TrainingCompetition();
            $competition->codeTrainingCompetition = $value['codeTrainingCompetition'];
            $competition->codeAlfaTrainingCompetition = $value['codeAlfaTrainingCompetition'];
            $competition->denomination = $value['denomination'];
            $competition->duration = $value['duration'];
            $competition->minimumSpace = $value['minimumSpace'];
            $competition->orderTrainingCompetition = $value['orderTrainingCompetition'];
            $competition->statusTrainingCompetition = $value['statusTrainingCompetition'];
            $competition->TrainingProgram_idTrainingProgram = TrainingProgram::searchForId($value['TrainingProgram_idTrainingProgram']);
            $competition->idTrainingCompetition = $value['idTrainingCompetition'];
            $competition->Disconnect();
            array_push($arrTrainigCompetition,$competition);
        }
        $tmp->Disconnect();
        return $arrTrainigCompetition;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return TrainingCompetition::search("SELECT * FROM iteandes_novatik.TrainingCompetition");
    }

    //Buscar por id de la competencia
    public static function searchForId($idTrainingCompetition)
    {
        $competition = null;
        if($idTrainingCompetition > 0){
            $competition = new TrainingCompetition();
            $getrow = $competition->getRow("SELECT * FROM iteandes_novatik.TrainingCompetition WHERE idTrainingCompetition =?", array($idTrainingCompetition));
            $competition->codeTrainingCompetition = $getrow['codeTrainingCompetition'];
            $competition->codeAlfaTrainingCompetition = $getrow['codeAlfaTrainingCompetition'];
            $competition->denomination = $getrow['denomination'];
            $competition->duration = $getrow['duration'];
            $competition->minimumSpace = $getrow['minimumSpace'];
            $competition->orderTrainingCompetition = $getrow['orderTrainingCompetition'];
            $competition->statusTrainingCompetition = $getrow['statusTrainingCompetition'];
            $competition->TrainingProgram_idTrainingProgram = TrainingProgram::searchForId($getrow['TrainingProgram_idTrainingProgram']);
            $competition->idTrainingCompetition = $getrow['idTrainingCompetition'];
        }
        $competition->Disconnect();
        return $competition;
    }
    public static function competitionRegistration ($codeTrainingCompetition) : bool
    {
        $result = TrainingCompetition::search("SELECT idTrainingCompetition FROM iteandes_novatik.TrainingCompetition where codeTrainingCompetition = ".$codeTrainingCompetition);
        if (count($result) > 0){
            return true;
        }else{
            return false;
        }
    }
    //Metodo to String
    public function __toString()
    {
        return "Codigo: $this->codeTrainingCompetition, Codigo Corto: $this->codeAlfaTrainingCompetition, Denominacion: $this->denomination, duracion: $this->duration , cupo Minimo: $this->minimumSpace,  orden: $this->orderTrainingCompetition, Estado: $this->statusTrainingCompetition, Programa de Formacion $this->TrainingProgram_idTrainingProgram";
    }
}
