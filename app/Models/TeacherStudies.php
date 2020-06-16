<?php
namespace App\Models;

require("BasicModel.php");
class TeacherStudies extends BasicModel{
    private $idTeacherStudies;
    private $titleTeacherStudies;
    private $yearStudyTeacher;

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
    }

    function __destruct(){
        $this->Disconnect();
    }
    //metodos get y set
    /**
     * @return int
     */
    public function getIdTeacherStudies(): ?int
    {
        return $this->idTeacherStudies;
    }

    /**
     * @param int $idTeacherStudies
     */
    public function setIdTeacherStudies(?int $idTeacherStudies): void
    {
        $this->idTeacherStudies = $idTeacherStudies;
    }

    /**
     * @return String
     */
    public function getTitleTeacherStudies(): ?String
    {
        return $this->titleTeacherStudies;
    }

    /**
     * @param String $titleTeacherStudies
     */
    public function setTitleTeacherStudies(?String $titleTeacherStudies): void
    {
        $this->titleTeacherStudies = $titleTeacherStudies;
    }

    /**
     * @return int
     */
    public function getYearStudyTeacher(): ?int
    {
        return $this->yearStudyTeacher;
    }

    /**
     * @param int $yearStudyTeacher
     */
    public function setYearStudyTeacher(?int $yearStudyTeacher): void
    {
        $this->yearStudyTeacher = $yearStudyTeacher;
    }
    //creacion de meodos


}
