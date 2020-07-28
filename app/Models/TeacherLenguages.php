<?php
namespace App\Models;

require_once('BasicModel.php');

class  TeacherLenguages Extends BasicModel
{
    private $idTeacherLenguages;
    private $Teacher_idTeacher;
    private $Lenguages_idLenguages;
    private $stateTeacherLenguages;

    /**
     * TeacherLenguages constructor.
     * @param $idTeacherLenguages
     * @param $Teacher_idTeacher
     * @param $Lenguages_idLenguages
     * @param $stateTeacherLenguages
     */
    public function __construct($TeacherLenguages = array())
    {
        parent::__construct();
        $this->idTeacherLenguages = $TeacherLenguages['idTeacherLenguages'] ?? null;
        $this->Teacher_idTeacher = $TeacherLenguages['Teacher_idTeacher'] ?? null;
        $this->Lenguages_idLenguages = $TeacherLenguages['Lenguages_idLenguages'] ?? null;
        $this->stateTeacherLenguages = $TeacherLenguages['stateTeacherLenguages'] ?? null;
    }
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return String
     */
    public function getStateTeacherLenguages(): String
    {
        return $this->stateTeacherLenguages;
    }

    /**
     * @param String $stateTeacherLenguages
     */
    public function setStateTeacherLenguages(String $stateTeacherLenguages): void
    {
        $this->stateTeacherLenguages = $stateTeacherLenguages;
    }

    /**
     * @return int
     */
    public function getIdTeacherLenguages(): int
    {
        return $this->idTeacherLenguages;
    }

    /**
     * @param mixed|null $idTeacherLenguages
     */
    public function setIdTeacherLenguages(int $idTeacherLenguages): void
    {
        $this->idTeacherLenguages = $idTeacherLenguages;
    }

    /**
     * @return int
     */
    public function getTeacherIdTeacher():int
    {
        return $this->Teacher_idTeacher;
    }

    /**
     * @param mixed|null $Teacher_idTeacher
     */
    public function setTeacherIdTeacher( $Teacher_idTeacher): void
    {
        $this->Teacher_idTeacher = $Teacher_idTeacher;
    }

    /**
     * @return Lenguages
     */
    public function getLenguagesIdLenguages(): Lenguages
    {
        return $this->Lenguages_idLenguages;
    }

    /**
     * @param int $Lenguages_idLenguages
     */
    public function setLenguagesIdLenguages(int $Lenguages_idLenguages): void
    {
        $this->Lenguages_idLenguages = $Lenguages_idLenguages;
    }
    //Funcion buscr por jquery

    public static function search($query)
    {

        $arrTeacherLenguages = array();
        $tmp = new Teacher();
        $getrows = $tmp->getRows($query);
        foreach ($getrows as $value) {
            $TeacherLenguages = new Teacher();
            $TeacherLenguages->idTeacherLenguages = $value['idTeacherLenguages'];
            $TeacherLenguages->Lenguages_idLenguages = Lenguages::searchForId($value['Lenguages_idLenguages']);
            $TeacherLenguages->Teacher_idTeacher = Teacher::searchForId($value['Teacher_idTeacher']);
            $TeacherLenguages->stateTeacherLenguages = $value['stateTeacherLenguages'];
            $TeacherLenguages->Disconnect();
            array_push($arrTeacherLenguages,$TeacherLenguages );
        }
        $tmp->Disconnect();
        return $arrTeacherLenguages;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return TeacherLenguages::search("SELECT * FROM iteande_novatik.TeacherLenguages");
    }

    //Buscar por id Teacher
    /**
     * @param $idTeacherLenguages
     * @return mixed
     */
    public static function searchForId($idTeacherLenguages)
    {
        $teacher = null;
        if ($idTeacherLenguages > 0) {
            $teacher = new Teacher();
            $getrow = $teacher->getRow("SELECT * FROM iteandes_novatik.TeacherLenguages WHERE idTeacherLenguages =?", array($idTeacherLenguages));
            $teacher->idTeacherLenguages = $getrow['idTeacherLenguages'];
            $teacher->Teacher_idTeacher = Teacher::searchForId($getrow['Teacher_idTeacher']);
            $teacher->Lenguages_idLenguages = Lenguages::searchForId($getrow['Lenguages_idLenguages']);
            $teacher->stateTeacherLenguages = $getrow['stateTeacher'];
        }
        $teacher->Disconnect();
        return $teacher;
    }
        /////////////////////////////////crear a un Teacherlenguages
        public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.TeacherLenguages VALUES (NULL, ?, ?, ?)", array(
                $this->Teacher_idTeacher->getIdTeacher(),
                $this->Lenguages_idLenguages->getIdLenguages(),
                $this->stateTeacherLenguages
            )
        );
        $this->setIdTeacherLenguages(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }
    //////////////////Actualizar  un docente
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.TeacherLenguages  SET  TeacherStudies_idTeacherStudies = ?, Lenguages_idLenguages= ?, stateTeacherLenguages = ? WHERE idTeacherLenguages = ?", array(
                $this->TeacherStudies_idTeacherStudies->getIdTeacherLenguages(),
                $this->Lenguages_idLenguages->getIdTeacherLenguages(),
                $this->stateTeacherLenguages,
                $this->idTeacherLenguages
            )
        );
        $this->Disconnect();
        return $result;
    }

    ////inactivar un TeacherLenguages
    public function delete($idTeacherLenguages): bool
    {
        $TeacherLenguages = TeacherLenguages::searchForId($idTeacherLenguages); //Buscando un TeacherLenguages por el ID
        $TeacherLenguages->setStateTeacherLenguages("Inactivo"); //Cambia el estado del TeacherLenguages
        return $TeacherLenguages->update();                    //Guarda los cambios..
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Teacher: $this->Teacher_idTeacher, lenguages: $this->Lenguages_idLenguages, stateLenguages: $this->stateTeacherLenguages , stateTeacher: $this->stateTeacher,  idTeacherLenguages: $this->idTeacherLenguages";
    }
}