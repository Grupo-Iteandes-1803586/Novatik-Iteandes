<?php
namespace App\Models;
require_once("BasicModel.php");
class Experience extends BasicModel{
    private $idExperience;
    private $institutionExperience;
    private $dedicationExperience;
    private $startExperience;
    private $endExperince;
    private $stateExperience;

    /**
     * Experience constructor.
     * @param $idExperience
     * @param $institutionExperience
     * @param $dedicationExperience
     * @param $startExperience
     * @param $endExperince
     */

    public function __construct($experience = array())
    {
        parent::__construct();//se llama al constructor de la clase BasicModel
        $this->idExperience = $experience['idExperience'] ?? null;
        $this->institutionExperience = $experience['institutionExperience'] ?? null;
        $this->dedicationExperience = $experience['dedicationExperience'] ?? null;
        $this->startExperience = $experience['startExperience'] ?? null;
        $this->endExperince = $experience['endExperince'] ?? null;
        $this->stateExperience = $experience['stateExperience'] ?? null;
    }
    function __destruct(){
        $this->Disconnect();
    }
    //metodos get y set

    /**
     * @return String
     */
    public function getStateExperience() : String
    {
        return $this->stateExperience;
    }

    /**
     * @param String $stateExperience
     */
    public function setStateExperience(String $stateExperience): void
    {
        $this->stateExperience = $stateExperience;
    }


    /**
     * @return int
     */
    public function getIdExperience (): int
    {
        return $this->idExperience;
    }

    /**
     * @param int  $idExperience
     */
    public function setIdExperience(int $idExperience): void
    {
        $this->idExperience = $idExperience;
    }

    /**
     * @return String
     */
    public function getInstitutionExperience(): String
    {
        return $this->institutionExperience;
    }

    /**
     * @param String $institutionExperience
     */
    public function setInstitutionExperience(String $institutionExperience): void
    {
        $this->institutionExperience = $institutionExperience;
    }

    /**
     * @return iString
     */
    public function getDedicationExperience(): String
    {
        return $this->dedicationExperience;
    }

    /**
     * @param String $dedicationExperience
     */
    public function setDedicationExperience(String $dedicationExperience): void
    {
        $this->dedicationExperience = $dedicationExperience;
    }

    /**
     * @return date
     */
    public function getStartExperience()
    {
        return $this->startExperience;
    }

    /**
     * @param date $startExperience
     */
    public function setStartExperience(date $startExperience): void
    {
        $this->startExperience = $startExperience;
    }

    /**
     * @return date
     */
    public function getEndExperince()
    {
        return $this->endExperince;
    }

    /**
     * @param date $endExperince
     */
    public function setEndExperince(date $endExperince): void
    {
        $this->endExperince = $endExperince;
    }

    //creacion de metodos
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.experience VALUES (NULL,?, ?,?,?,?)", array(
            $this-> institutionExperience,
            $this-> dedicationExperience,
            $this-> startExperience,
            $this-> endExperince,
            $this-> stateExperience
            )
        );
        $this->setIdExperience(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.experience SET institutionExperience = ?, dedicationExperience = ?, startExperience = ?, endExperince = ?, stateExperience=? WHERE idExperience = ?", array(
                $this-> institutionExperience,
                $this-> dedicationExperience,
                $this-> startExperience,
                $this-> endExperince,
                $this->stateExperience,
                $this->idExperience

        )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del la funcion eliminar o cambiar estado de Experience segun el Id
    public function delete($idExperience) : bool{
        $Experience = Experience::searchForId($idExperience); //Buscando un usuario por el ID
        $Experience->setStateExperience("Inactivo"); //Cambia el estado del Usuario
        return $Experience->update();
    }

    //buscar por query
    public static function search($query) : array{
        $arrExperience = array();
        $tmp = new Experience();
        $getrows = $tmp->getRows($query);

        foreach($getrows as $value){
            $experience = new Experience();
            $experience->institutionExperience = $value['institutionExperience'];
            $experience->dedicationExperience = $value['dedicationExperience'];
            $experience->startExperience= date('Y-m-d',strtotime($value['startExperience'])) ;
            $experience->endExperince= date('Y-m-d',strtotime($value['endExperince']));
            $experience->stateExperience= $value['stateExperience'];
        }
        $tmp->Disconnect();
        return $arrExperience;
    }
    //Buscar pot Id de Experience
    public static function searchForId($idExperience) : Experience{
        $experiences = null;
        if($idExperience > 0) {
            $experiences = new Experience;
            $getrow = $experiences->getRow("SELECT * FROM iteandes_novatik.experience WHERE idExperience =?", array($idExperience));
            $experiences->idExperience = $getrow['idExperience'];
            $experiences->institutionExperience = $getrow['institutionExperience'];
            $experiences->dedicationExperience = $getrow['dedicationExperience'];
            $experiences->startExperience = $getrow['startExperience'];
            $experiences->endExperince= $getrow['endExperince'];
            $experiences->stateExperience= $getrow['stateExperience'];
        }
        $experiences->Disconnect();
        return $experiences;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Experience::search("SELECT * FROM iteandes_novatik.experience");
    }

    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->institutionExperience ." ".$this->dedicationExperience." ".$this->startExperience ." ".$this->endExperince." ".$this->stateExperience;
    }

}