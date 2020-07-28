<?php
namespace App\Models;

require_once('BasicModel.php');

class  Teacher Extends BasicModel{

    private $idTeacher;
    private $Experience_idExperience;
    private $TeacherStudies_idTeacherStudies;
    private $Person_idPerson;
    private $stateTeacher;

    /**
     * Teacher constructor.
     * @param $idTeacher
     * @param $Experience_idExperience
     * @param $TeacherStudies_idTeacherStudies
     * @param $Person_idPerson
     * @param $stateTeacher
     */
    public function __construct($teacher = array())
    {
        parent::__construct();
        $this->idTeacher = $teacher['idTeacher'] ?? null;
        $this->Experience_idExperience = $teacher ['Experience_idExperience'] ?? null;
        $this->TeacherStudies_idTeacherStudies = $teacher['TeacherStudies_idTeacherStudies'] ?? null;
        $this->Person_idPerson = $teacher['Person_idPerson'] ?? null;
        $this->stateTeacher = $teacher['stateTeacher'] ?? null;
    }

    function __destruct()
    {
        $this->Disconnect();
    }


    /**
     * @return mixed|null
     */
    public function getIdTeacher()
    {
        return $this->idTeacher;
    }

    /**
     * @param mixed $idTeacher
     */
    public function setIdTeacher( $idTeacher): void
    {
        $this->idTeacher = $idTeacher;
    }

    /**
     * @return Experience
     */
    public function getExperienceIdExperience(): Experience
    {
        return $this->Experience_idExperience;
    }

    /**
     * @param int $Experience_idExperience
     */
    public function setExperienceIdExperience(int $Experience_idExperience): void
    {
        $this->Experience_idExperience = $Experience_idExperience;
    }

    /**
     * @return TeacherStudies
     */
    public function getTeacherStudiesIdTeacherStudies(): TeacherStudies
    {
        return $this->TeacherStudies_idTeacherStudies;
    }

    /**
     * @param int $TeacherStudies_idTeacherStudies
     */
    public function setTeacherStudiesIdTeacherStudies(int $TeacherStudies_idTeacherStudies): void
    {
        $this->TeacherStudies_idTeacherStudies = $TeacherStudies_idTeacherStudies;
    }

    /**
     * @return int
     */
    public function getPersonIdPerson(): int
    {
        return $this->Person_idPerson;
    }

    /**
     * @param mixed|null $Person_idPerson
     */
    public function setPersonIdPerson(int $Person_idPerson): void
    {
        $this->Person_idPerson = $Person_idPerson;
    }

    /**
     * @return mixed
     */
    public function getStateTeacher(): String
    {
        return $this->stateTeacher;
    }

    /**
     * @param mixed $stateTeacher
     */
    public function setStateTeacher(String $stateTeacher): void
    {
        $this->stateTeacher = $stateTeacher;
    }

    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrTeacher = array();
        $tmp = new Teacher();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $Teacher = new Teacher();
            $Teacher->idTeacher = $value['idTeacher'];
            $Teacher->Experience_idExperience = Experience::searchForId($value['Experience_idExperience']);
            $Teacher->TeacherStudies_idTeacherStudies = TeacherStudies::searchForId($value['TeacherStudies_idTeacherStudies']);
            $Teacher->Person_idPerson = Person::searchForId($value['Person_idPerson']);
            $Teacher->stateTeacher = $value['stateTeacher'];
            $Teacher->Disconnect();
            array_push($arrTeacher, $Teacher);
        }
        $tmp->Disconnect();
        return $arrTeacher;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Teacher::search("SELECT * FROM iteandes_novatik.Teacher");
    }
//Buscar por id Teacher
    /**
     * @param $idTeacher
     * @return mixed
     */
    public static function searchForId($idTeacher )
    {
        $teacher = null;
        if ($idTeacher  > 0) {
            $teacher= new Teacher();
            $getrow = $teacher->getRow("SELECT * FROM iteandes_novatik.Teacher WHERE idTeacher =?", array($idTeacher));
            $teacher->idTeacher = $getrow['idTeacher'];
            $teacher->Experience_idExperience = Experience::searchForId($getrow['Experience_idExperience']);
            $teacher->TeacherStudies_idTeacherStudies = TeacherStudies::searchForId($getrow['TeacherStudies_idTeacherStudies']);
            $teacher->Person_idPerson = Person::searchForId($getrow['Person_idPerson']);
            $teacher->stateTeacher = $getrow['stateTeacher'];
        }
        $teacher->Disconnect();
        return $teacher;
    }
/////////////////////////////////crear a un docente
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Teacher VALUES (NULL, ?, ?, ?, ?)", array(
                $this->Experience_idExperience->getIdExperience(),
                $this->TeacherStudies_idTeacherStudies->getIdTeacherStudies(),
                $this->Person_idPerson->getIdPerson(),
                $this->stateTeacher
            )
        );
        $this->setIdTeacher(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }
///////////////////Actualizar  un docente
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Teacher  SET Experience_idExperience = ?, TeacherStudies_idTeacherStudies = ?, Person_idPerson= ?, stateTeacher = ? WHERE idTeacher = ?", array(
                $this->Experience_idExperience->getIdExperience(),
                $this->TeacherStudies_idTeacherStudies->getIdTeacherStudies(),
                $this->Person_idPerson->getIdPerson(),
                $this->stateTeacher,
                $this->idTeacher
            )
        );
        $this->Disconnect();
        return $result;
    }
////inactivar un Teacher
    public function delete($idTeacher)
    {
        $Teacher = Teacher::searchForId($idTeacher); //Buscando un Teacher por el ID
        $Teacher->setStateTeacher("Inactivo"); //Cambia el estado del Teacher
        return $Teacher->update();                    //Guarda los cambios..
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Experiencia: $this->Experience_idExperience, Estudios: $this->TeacherStudies_idTeacherStudies, Person: $this->Person_idPerson , stateTeacher: $this->stateTeacher,  idTeacher: $this->idTeacher";
    }


}


