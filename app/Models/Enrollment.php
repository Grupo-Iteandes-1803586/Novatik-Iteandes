<?php
namespace App\Models;
require_once ('BasicModel.php');
use Carbon\Carbon;
class Enrollment extends BasicModel{
    private $idEnrollment;
    private Carbon $dateEnrollment;
    private $stateEnrollment;
    private $Student_idStudent;
    private $Semester_idSemester;
    private $TrainingProgram_idTrainingProgram;
    /**
 * Enrollment constructor.
 * @param $idEnrollment
 * @param $dateEnrollment
 * @param $stateEnrollment
 * @param $Student_idStudent
 * @param $Semester_idSemester
 * @param $TrainingProgram_idTrainingProgram
     *
 */
    public function __construct($enrollment = array())
{
    parent::__construct();
    $this->idEnrollment = $enrollment['idEnrollment'] ?? null;
    $this->dateEnrollment = $enrollment['dateEnrollment'] ?? new Carbon();
    $this->stateEnrollment = $enrollment['stateEnrollment'] ?? null;
    $this->Student_idStudent = $enrollment['Student_idStudent'] ?? null;
    $this->Semester_idSemester = $enrollment['Semester_idSemester'] ?? null;
    $this->TrainingProgram_idTrainingProgram = $enrollment['TrainingProgram_idTrainingProgram'] ?? null;
}

    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdEnrollment():int
    {
        return $this->idEnrollment;
    }

    /**
     * @param int $idEnrollment
     */
    public function setIdEnrollment(int $idEnrollment): void
    {
        $this->idEnrollment = $idEnrollment;
    }

    /**
     * @return Carbon
     */
    public function getDateEnrollment() : Carbon
    {
        return $this->dateEnrollment;
    }

    /**
     * @param Carbon $dateEnrollment
     */
    public function setDateEnrollment(Carbon $dateEnrollment): void
    {
        $this->dateEnrollment = $dateEnrollment;
    }

    /**
     * @return String
     */
    public function getStateEnrollment():String
    {
        return $this->stateEnrollment;
    }

    /**
     * @param Stringl $stateEnrollment
     */
    public function setStateEnrollment(String $stateEnrollment): void
    {
        $this->stateEnrollment = $stateEnrollment;
    }

    /**
     * @return int
     */
    public function getStudentIdStudent(): Student
    {
        return $this->Student_idStudent;
    }

    /**
     * @param int $Student_idStudent
     */
    public function setStudentIdStudent(int $Student_idStudent): void
    {
        $this->Student_idStudent = $Student_idStudent;
    }

    /**
     * @return int
     */
    public function getSemesterIdSemester(): int
    {
        return $this->Semester_idSemester;
    }

    /**
     * @param int $Semester_idSemester
     */
    public function setSemesterIdSemester(int$Semester_idSemester): void
    {
        $this->Semester_idSemester = $Semester_idSemester;
    }

    /**
     * @return int
     */
    public function getTrainingProgramIdTrainingProgram(): int
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

    //crear una matricula
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Enrollment VALUES (NULL, ?, ?, ?, ?,?)", array(
            $this->dateEnrollment->toDateString(), //YYYY-MM-DD,
            $this->stateEnrollment,
            $this->Student_idStudent->getIdStudent(),
            $this->Semester_idSemester->getIdSemester(),
            $this->TrainingProgram_idTrainingProgram->getIdTrainingProgram()
            )
        );
        $this->setIdEnrollment(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  una matricula
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Enrollment  SET dateEnrollment = ?, stateEnrollment = ?, Student_idStudent= ?, Semester_idSemester = ?,TrainingProgram_idTrainingProgram=? WHERE idEnrollment = ?", array(
                $this->idEnrollment,
                $this->dateEnrollment->toDateString(), //YYYY-MM-DD,
                $this->stateEnrollment,
                $this->Student_idStudent->getIdStudent(),
                $this->Semester_idSemester->getIdSemester(),
                $this->TrainingProgram_idTrainingProgram->getIdTrainingProgram()
            )
        );
        $this->Disconnect();
        return $result;
    }

    //inactivar un Teacher
    public function delete($idEnrollment)
    {
        $enrollment = Enrollment::searchForId($idEnrollment); //Buscando un Teacher por el ID
        $enrollment->setStateEnrollment("Inactivo"); //Cambia el estado del Teacher
        return $enrollment->update();                    //Guarda los cambios..
    }

    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrEnrollment = array();
        $tmp = new Enrollment();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $enrolment= new Enrollment();

            $enrolment->idEnrollment = $value['idEnrollment'];
            $enrolment->dateEnrollment = Carbon::parse($value['dateEnrollment']);
            $enrolment->stateEnrollment = $value['stateEnrollment'];
            $enrolment->Student_idStudent = Student::searchForId($value['Student_idStudent']);
            $enrolment->Semester_idSemester= Semester::searchForId($value['Semester_idSemester']);
            $enrolment->TrainingProgram_idTrainingProgram= TrainingProgram::searchForId($value['TrainingProgram_idTrainingProgram']);
            $enrolment->Disconnect();
            array_push($arrEnrollment, $enrolment);
        }
        $tmp->Disconnect();
        return $arrEnrollment;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Enrollment::search("SELECT * FROM iteandes_novatik.Enrollment");
    }
//Buscar por Id
    public static function searchForId($idEnrollment)
    {
        $enrollment = null;
        if ($idEnrollment  > 0) {
            $enrollment= new Enrollment();
            $getrow = $enrollment->getRow("SELECT * FROM iteandes_novatik.Enrollment WHERE idEnrollment =?", array($idEnrollment));
            $enrollment->idEnrollment = $getrow['idEnrollment'];
            $enrollment->Carbon::parse($getrow['dateEnrollment']);
            $enrollment->stateEnrollment = $getrow['stateEnrollment'];
            $enrollment->Student_idStudent = Student::searchForId($getrow['Student_idStudent']);
            $enrollment->Semester_idSemester= Semester::searchForId($getrow['Semester_idSemester']);
            $enrollment->TrainingProgram_idTrainingProgram= TrainingProgram::searchForId($getrow['TrainingProgram_idTrainingProgram']);
        }
        $enrollment->Disconnect();
        return $enrollment;
    }
    public function __toString()
    {
        return "id: $this->idEnrollment,fecha: $this->dateEnrollment->toDateString(), estudiante: $this->Student_idStudent , semeste: $this->Semester_idSemester,  programa: $this->TrainingProgram_idTrainingProgram, estado: $this->stateEnrollment";
    }
}