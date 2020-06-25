<?php
namespace App\Models;
require("BasicModel.php");
class Experience extends BasicModel{
    private $idExperience;
    private $institutionExperience;
    private $dedicationExperience;
    private $startExperience;
    private $endExperince;

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
        $this->idExperience = $experience['idExperience'] ?? null;
        $this->institutionExperience = $experience['institutionExperience'] ?? null;
        $this->dedicationExperience = $experience['dedicationExperience'] ?? null;
        $this->startExperience = $experience['startExperience'] ?? null;
        $this->endExperince = $experience['endExperince'] ?? null;
    }
    function __destruct(){
        $this->Disconnect();
    }
    //metodos get y set
    /**
     * @return int
     */
    public function getIdExperience (): int
    {
        return $this->idExperience;
    }

    /**
     * @param int |null $idExperience
     */
    public function setIdExperience(int $idExperience): void
    {
        $this->idExperience = $idExperience;
    }

    /**
     * @return String
     */
    public function getInstitutionExperience(): ?String
    {
        return $this->institutionExperience;
    }

    /**
     * @param String $institutionExperience
     */
    public function setInstitutionExperience(?String $institutionExperience): void
    {
        $this->institutionExperience = $institutionExperience;
    }

    /**
     * @return iString
     */
    public function getDedicationExperience(): ?String
    {
        return $this->dedicationExperience;
    }

    /**
     * @param String $dedicationExperience
     */
    public function setDedicationExperience(?String $dedicationExperience): void
    {
        $this->dedicationExperience = $dedicationExperience;
    }

    /**
     * @return date
     */
    public function getStartExperience(): ?date
    {
        return $this->startExperience;
    }

    /**
     * @param date $startExperience
     */
    public function setStartExperience(?date $startExperience): void
    {
        $this->startExperience = $startExperience;
    }

    /**
     * @return date
     */
    public function getEndExperince(): ?date
    {
        return $this->endExperince;
    }

    /**
     * @param date $endExperince
     */
    public function setEndExperince(?date $endExperince): void
    {
        $this->endExperince = $endExperince;
    }

    //creacion de metodos
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO Iteandes_Novatik.Experience VALUES (NULL,?, ?,?,?)", array(
            $this-> institutionExperience,
            $this-> dedicationExperience,
            $this-> startExperience,
            $this-> endExperince

            )
        );

        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE Iteandes_Novatik.Experience SET institutionExperience = ?,dedicationExperience = ?,startExperience = ?,endExperince = ? WHERE idExperience = ?", array(
                $this-> institutionExperience,
                $this-> dedicationExperience,
                $this-> startExperience,
                $this-> endExperince,
                $this->idExperience
            )
        );
        $this->Disconnect();
        return $result;
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
            $experience->startExperience= $value['startExperience'];
            $experience->endExperince= $value['endExperince'];
        }
        $tmp->Disconnect;
        return $arrExperience;
    }
    //Buscar pot Id de Experience
    public static function searchForId($idExperience) : Experience{
        $experiences = null;
        if($idExperience > 0) {
            $experiences = new Experience;
            $getrow = $experiences->getRow("SELECT * FROM Iteandes_Novatik.Experience WHERE idExperience =?", array($idExperience));
            $experiences->institutionExperience = $getrow['institutionExperience'];
            $experiences->dedicationExperience = $getrow['ndedicationExperience'];
            $experiences->startExperience = $getrow['startExperience'];
            $experiences->endExperince= $getrow['endExperince'];
        }
        $experiences->Disconnect();
        return $experiences;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Experince::search("SELECT * FROM Iteandes_Novatik.Experience");
    }

    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->institutionExperience ." ".$this->dedicationExperience." ".$this->startExperience ." ".$this->endExperince;
    }

}