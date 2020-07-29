<?php

namespace App\Models;
require_once ('BasicModel.php');
use Carbon\Carbon;

class Note extends BasicModel{
    private $idNote;
    private Carbon $dateNote;
    private $valueNote;
    private $Activity_idActivity;
    private $Teacher_idTeacher;
    private $stateNote;

    /**
     * Note constructor.
     * @param $idNote
     * @param $dateNote
     * @param $valueNote
     * @param $Activity_idActivity
     * @param $Teacher_idTeacher
     * @param $stateNote
     */
    public function __construct($note = array())
    {
        parent::__construct();
        $this->idNote = $note['idNote'] ?? null;
        $this->dateNote = $note['dateNote'] ?? new Carbon();
        $this->valueNote = $note['valueNote'] ?? null;
        $this->Activity_idActivity = $note['Activity_idActivity'] ?? null;
        $this->Teacher_idTeacher = $note['Teacher_idTeacher'] ?? null;
        $this->stateNote = $note['stateNote'] ?? null;
    }
    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdNote(): int
    {
        return $this->idNote;
    }

    /**
     * @param int $idNote
     */
    public function setIdNote(int$idNote): void
    {
        $this->idNote = $idNote;
    }

    /**
     * @return Carbon
     */
    public function getDateNote() : Carbon
    {
        return $this->dateNote;
    }

    /**
     * @param Carbon $dateNote
     */
    public function setDateNote(Carbon $dateNote): void
    {
        $this->dateNote = $dateNote;
    }

    /**
     * @return float
     */
    public function getValueNote():float
    {
        return $this->valueNote;
    }

    /**
     * @param float $valueNote
     */
    public function setValueNote(float $valueNote): void
    {
        $this->valueNote = $valueNote;
    }

    /**
     * @return int
     */
    public function getActivityIdActivity():int
    {
        return $this->Activity_idActivity;
    }

    /**
     * @param int $Activity_idActivity
     */
    public function setActivityIdActivity(int $Activity_idActivity): void
    {
        $this->Activity_idActivity = $Activity_idActivity;
    }

    /**
     * @return int
     */
    public function getTeacherIdTeacher():int
    {
        return $this->Teacher_idTeacher;
    }

    /**
     * @param int $Teacher_idTeacher
     */
    public function setTeacherIdTeacher(int $Teacher_idTeacher): void
    {
        $this->Teacher_idTeacher = $Teacher_idTeacher;
    }

    /**
     * @return String
     */
    public function getStateNote(): String
    {
        return $this->stateNote;
    }

    /**
     * @param String $stateNote
     */
    public function setStateNote(String $stateNote): void
    {
        $this->stateNote = $stateNote;
    }

    //crear nota
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Note VALUES (NULL, ?, ?, ?, ?,?)", array(
                $this->dateNote->toDateString(), //YYYY-MM-DD,
                $this->valueNote,
                $this->Activity_idActivity->getIdActivity(),
                $this->Teacher_idTeacher->getIdTeacher(),
                $this->stateNote
            )
        );
        $this->setIdNote(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  una Nota
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Note  SET dateNote = ?, valueNote = ?, Activity_idActivity= ?, Teacher_idTeacher = ?, stateNote=? WHERE idNote = ?", array(
                $this->idNote,
                $this->dateNote->toDateString(), //YYYY-MM-DD,
                $this->valueNote,
                $this->Activity_idActivity->getIdActivity(),
                $this->Teacher_idTeacher->getIdTeacher(),
                $this->stateNote
            )
        );
        $this->Disconnect();
        return $result;
    }

//inactivar un horario
    public function delete($idNote)
    {
        $note = Note::searchForId($idNote); //Buscando un Nota por el ID
        $note->setStateNote("Inactivo"); //Cambia el estado del Nota
        return $note->update();                    //Guarda los cambios..
    }

    //Funcion buscr por jquery
    public static function search($query)
    {

        $arrNote = array();
        $tmp = new Note();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $note= new Note();
            $note->idNote = $value['idNote'];
            $note->dateNote = Carbon::parse($value['dateNote']);
            $note->valueNote = $value['valueNote'];
            $note->Activity_idActivity= Activity::searchForId($value['Activity_idActivity']);
            $note->Teacher_idTeacher = Teacher::searchForId($value['Teacher_idTeacher']);
            $note->stateNote = $value['stateNote'];
            $note->Disconnect();
            array_push($arrNote, $note);
        }
        $tmp->Disconnect();
        return $arrNote;
    }
    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Note::search("SELECT * FROM iteandes_novatik.Note");
    }

    public static function searchForId($idNote)
    {
        $note = null;
        if ($idNote  > 0) {
            $note= new Note();
            $getrow = $note->getRow("SELECT * FROM iteandes_novatik.Note WHERE idNote =?", array($idNote));
            $note->idNote = $getrow['idNote'];
            $note->dateNote = Carbon::parse($getrow['dateNote']);
            $note->valueNote = $getrow['valueNote'];
            $note->Activity_idActivity= Activity::searchForId($getrow['Activity_idActivity']);
            $note->Teacher_idTeacher = Teacher::searchForId($getrow['Teacher_idTeacher']);
            $note->stateNote = $getrow['stateNote'];
        }
        $note->Disconnect();
        return $note;
}
    public function __toString()
    {
        return "id: $this->idNote,fecha: $this->dateNote->toDateString(), nota: $this->valueNote , actividad: $this->Activity_idActivity,  docente: $this->Teacher_idTeacher, estado: $this->stateNote";
    }

}