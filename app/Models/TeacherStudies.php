<?php
namespace App\Models;

require_once("BasicModel.php");
class TeacherStudies extends BasicModel{
    private $idTeacherStudies;
    private $titleTeacherStudies;
    private $yearStudyTeacher;
    private $stateTeacherStudies;

    /**
     * TeacherStudies constructor.
     * @param $idTeacherStudies
     * @param $titleTeacherStudies
     * @param $yearStudyTeacher
     */
    public function __construct($teacherStudies = array())
    {
        $this->idTeacherStudies = $teacherStudies['idTeacherStudies'] ?? null;
        $this->titleTeacherStudies = $teacherStudies['titleTeacherStudies'] ?? null;
        $this->yearStudyTeacher = $teacherStudies['yearStudyTeacher'] ?? null;
        $this->stateTeacherStudies = $teacherStudies['stateTeacherStudies'] ?? null;
    }

    function __destruct(){
        $this->Disconnect();
    }
    //metodos get y set
    /**
     * @return int
     */
    public function getIdTeacherStudies(): int
    {
        return $this->idTeacherStudies;
    }

    /**
     * @param int $idTeacherStudies
     */
    public function setIdTeacherStudies(int $idTeacherStudies): void
    {
        $this->idTeacherStudies = $idTeacherStudies;
    }


    /**
     * @return String
     */
    public function getStateTeacherStudies(): String
    {
        return $this->stateTeacherStudies;
    }

    /**
     * @param String $stateTeacherStudies
     */
    public function setStateTeacherStudies(String $stateTeacherStudies): void
    {
        $this->stateTeacherStudies = $stateTeacherStudies;
    }

    /**
     * @return String
     */
    public function getTitleTeacherStudies(): String
    {
        return $this->titleTeacherStudies;
    }

    /**
     * @param String $titleTeacherStudies
     */
    public function setTitleTeacherStudies(String $titleTeacherStudies): void
    {
        $this->titleTeacherStudies = $titleTeacherStudies;
    }

    /**
     * @return int
     */
    public function getYearStudyTeacher(): int
    {
        return $this->yearStudyTeacher;
    }

    /**
     * @param int $yearStudyTeacher
     */
    public function setYearStudyTeacher(int $yearStudyTeacher): void
    {
        $this->yearStudyTeacher = $yearStudyTeacher;
    }
    //creacion de metodos
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.TeacherStudies VALUES (NULL,?, ?,?)", array(
                $this-> titleTeacherStudies,
                $this-> yearStudyTeacher,
                $this-> stateTeacherStudies
            )
        );

        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.TeacherStudies SET titleTeacherStudie = ?,yearStudyTeache = ?,stateTeacherStudies=? WHERE idTeacherStudies = ?", array(
            $this->titleTeacherStudies,
            $this->yearStudyTeacher,
                $this->stateTeacherStudies,
                $this->idTeacherStudies
            )
        );
        $this->Disconnect();
        return $result;
    }
    //Creacion del la funcion eliminar o cambiar estado de TeacherStudies segun el Id
    public function delete($idTeacherStudies) : bool{
        $TeacherStudies = TeacherStudies::searchForId($idTeacherStudies); //Buscando un usuario por el ID
        $TeacherStudies->setStateTeacherStudies("Inactivo"); //Cambia el estado del Usuario
        return $TeacherStudies->update();
    }

    //buscar por query
    public static function search($query) : array{
        $arrTeacherStudies = array();
        $tmp = new TeacherStudies();
        $getrows = $tmp->getRows($query);
        foreach($getrows as $value){
            $teacherStudies = new TeacherStudies();
            $teacherStudies->idTeacherStudies = $value['idTeacherStudies'];
            $teacherStudies->titleTeacherStudies= $value['titleTeacherStudies'];
            $teacherStudies->yearStudyTeacher = $value['yearStudyTeacher'];
            $teacherStudies->stateTeacherStudies = $value['stateTeacherStudies'];
            $teacherStudies->Disconnect();
            array_push($arrTeacherStudies,$teacherStudies);
        }
        $tmp->Disconnect();
        return $arrTeacherStudies;
    }

    //Buscar pot Id de TeacherStudies
    public static function searchForId($idTeacherStudies) : TeacherStudies{
        $teacherStudie = null;
        if($idTeacherStudies > 0) {
            $teacherStudie = new TeacherStudies;
            $getrow = $teacherStudie->getRow("SELECT * FROM iteandes_novatik.TeacherStudies WHERE idTeacherStudies =?", array($idTeacherStudies));
            $teacherStudie->titleTeacherStudies = $getrow['titleTeacherStudies'];
            $teacherStudie->yearStudyTeacher = $getrow['yearStudyTeacher'];
            $teacherStudie->stateTeacherStudies = $getrow['stateTeacherStudies'];
        }
        $teacherStudie->Disconnect();
        return $teacherStudie;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return TeacherStudies::search("SELECT * FROM iteandes_novatik.TeacherStudies");
    }
    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->getIdTeacherStudies()." ".$this->titleTeacherStudies." ".$this->yearStudyTeache." ".stateTeacherStudies ;
    }

}