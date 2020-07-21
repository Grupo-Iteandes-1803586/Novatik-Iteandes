<?php
namespace App\Models;

require_once('BasicModel.php');

class  TeacherLenguages Extends BasicModel
{
    private $idTeacherLenguages;
    private $Teacher_idTeacher;
    private $Lenguages_idLenguages;

    /**
     * TeacherLenguages constructor.
     * @param $idTeacherLenguages
     * @param $Teacher_idTeacher
     * @param $Lenguages_idLenguages
     */
    public function __construct()
    {
        $this->idTeacherLenguages = $TeacherLenguages['idTeacherLenguages'] ?? null;
        $this->Teacher_idTeacher = $TeacherLenguages['Teacher_idTeacher'] ?? null;
        $this->Lenguages_idLenguages = $TeacherLenguages['Lenguages_idLenguages'] ?? null;
    }
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return mixed|null
     */
    public function getIdTeacherLenguages(): ?mixed
    {
        return $this->idTeacherLenguages;
    }

    /**
     * @param mixed|null $idTeacherLenguages
     */
    public function setIdTeacherLenguages(?mixed $idTeacherLenguages): void
    {
        $this->idTeacherLenguages = $idTeacherLenguages;
    }

    /**
     * @return mixed|null
     */
    public function getTeacherIdTeacher(): ?mixed
    {
        return $this->Teacher_idTeacher;
    }

    /**
     * @param mixed|null $Teacher_idTeacher
     */
    public function setTeacherIdTeacher(?mixed $Teacher_idTeacher): void
    {
        $this->Teacher_idTeacher = $Teacher_idTeacher;
    }

    /**
     * @return mixed|null
     */
    public function getLenguagesIdLenguages(): ?mixed
    {
        return $this->Lenguages_idLenguages;
    }

    /**
     * @param mixed|null $Lenguages_idLenguages
     */
    public function setLenguagesIdLenguages(?mixed $Lenguages_idLenguages): void
    {
        $this->Lenguages_idLenguages = $Lenguages_idLenguages;
    }

}