<?php
namespace App\Models;

require_once('BasicModel.php');
//Clase Student
class Student extends BasicModel{
    //Atributos de la clase Student
    private $idStudent;
    private $gradeYear;
    private $modality;
    private $Institution;
    private $Person_idPerson;
    private $stateStudent;

    //Metodo constructor

    /**
     * Student constructor.
     * @param $idStudent
     * @param $gradeYear
     * @param $modality
     * @param $Institution
     * @param $Person_idPerson
     * @param $stateStudent
     */
    public function __construct($student =array())
    {
        parent::__construct();
        $this->idStudent = $student['idStudent'] ?? null;
        $this->gradeYear = $student['gradeYear'] ?? null;
        $this->modality = $student['modality'] ?? null;
        $this->Institution = $student['Institution'] ?? null;
        $this->Person_idPerson = $student['Person_idPerson'] ?? null;
        $this->stateStudent = $student['stateStudent'] ?? null;
    }

    //desconexion de la base de datos
    function __destruct()
    {
        $this->Disconnect();
    }
    //metodos set y get
    /**
     * @return int
     */
    public function getIdStudent():int
    {
        return $this->idStudent;
    }

    /**
     * @param int $idStudent
     */
    public function setIdStudent(int $idStudent): void
    {
        $this->idStudent = $idStudent;
    }

    /**
     * @return int
     */
    public function getGradeYear(): int
    {
        return $this->gradeYear;
    }

    /**
     * @param int $gradeYear
     */
    public function setGradeYear(int $gradeYear): void
    {
        $this->gradeYear = $gradeYear;
    }

    /**
     * @return String
     */
    public function getModality(): String
    {
        return $this->modality;
    }

    /**
     * @param String $modality
     */
    public function setModality(String$modality): void
    {
        $this->modality = $modality;
    }

    /**
     * @return String
     */
    public function getInstitution(): String
    {
        return $this->Institution;
    }

    /**
     * @param String $Institution
     */
    public function setInstitution(String $Institution): void
    {
        $this->Institution = $Institution;
    }

    /**
     * @return int
     */
    public function getPersonIdPerson(): Person
    {
        return $this->Person_idPerson;
    }

    /**
     * @param int$Person_idPerson
     */
    public function setPersonIdPerson(int $Person_idPerson): void
    {
        $this->Person_idPerson = $Person_idPerson;
    }

    /**
     * @return String
     */
    public function getStateStudent():String
    {
        return $this->stateStudent;
    }

    /**
     * @param String$stateStudent
     */
    public function setStateStudent(String $stateStudent): void
    {
        $this->stateStudent = $stateStudent;
    }


    //Funcion crear a un Student
    public function create() : bool{
        $result = $this->insertRow( "INSERT INTO iteandes_novatik.Student VALUES (NULL, ?, ?, ?, ?, ?)", array(
                $this->gradeYear,
                $this->modality,
                $this->Institution,
                $this->Person_idPerson->getIdPerson(),
                $this->stateStudent
            )
        );
        $this->setIdStudent(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }
    //Creacion del metodo actualizar
    public function update(): bool{
        $result = $this->updateRow( "UPDATE iteandes_novatik.Student  SET gradeYear = ?, modality = ?,Institution = ?,Person_idPerson = ?,stateStudent = ? WHERE idStudent = ?", array(
                $this->gradeYear,
                $this->modality,
                $this->Institution,
                $this->Person_idPerson->getIdPerson(),
                $this->stateStudent,
                $this->idStudent
            )
        );
        $this->Disconnect();
        return $result;
    }
//Creacion del la funcion eliminar o cambiar estado de un Estudiante
    public function delete($idStudent) : bool{
        $Student =Student::searchForId($idStudent); //Buscando un Programa por el ID
        $Student->setStateStudent("Inactivo"); //Cambia el estado del Programa
        return $Student->update();
    }
//buscar por query
    public static function search($query) : array{
        $arrStudent = array();
        $tmp = new Student();
        $getrows = $tmp->getRows($query);

        foreach($getrows as $value){
            $student = new Student();
            $student->idStudent = $value['idStudent'];
            $student->gradeYear = $value['gradeYear'];
            $student->modality = $value['modality'];
            $student->Institution = $value['Institution'];
            $student->Person_idPerson = Person::searchForId($value['Person_idPerson']);
            $student->stateStudent = $value['stateStudent'];
            $student->Disconnect();
            array_push($arrStudent,$student);
        }
        $tmp->Disconnect();
        return $arrStudent;
    }
    //Buscar pot Id del Student
    public static function searchForId($idStudent) : Student{
        $Student = null;
        if($idStudent > 0) {
            $Student = new Student();
            $getrow = $Student->getRow("SELECT * FROM iteandes_novatik.Student WHERE idStudent =?", array($idStudent));
            $Student->idStudent = $getrow['idStudent'];
            $Student->gradeYear = $getrow['gradeYear'];
            $Student->modality = $getrow['modality'];
            $Student->Institution = $getrow['Institution'];
            $Student->Person_idPerson = Person::searchForId($getrow['Person_idPerson']);
            $Student->stateStudent = $getrow['stateStudent'];
        }
        $Student->Disconnect();
        return $Student;
    }
    //  Obtener toda la informacion de la BD
    public static function getAll() : array
    {
        return Student::search("SELECT * FROM iteandes_novatik.Student");
    }
    //updateStudent
    public static function updateStudent($idPerson, $typeState){
        $student= new Student();
        $result = $student-> insertRow("CALL UpdateStudent(?,?)",array($idPerson, $typeState));
        $student->Disconnect();
        return $result;
    }
    //Metodo to string o cadena de texto
    public function __toString()
    {
        return $this->gradeYear." ".$this->modality." ".$this->Institution." ".$this->Person_idPerson." ".$this->stateStudent;
    }
}