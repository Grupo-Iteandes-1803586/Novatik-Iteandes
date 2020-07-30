<?php
namespace App\Models;
require_once ('BasicModel.php');

class Archive extends BasicModel
{
    private $idArchive;
    private $nameArchive;
    private $descriptionArchive;
    private $stateArchive;
    private $rutaArchive;
    private $Activity_idActivity;

    /**
     * Archive constructor.
     * @param $idArchive
     * @param $nameArchive
     * @param $descriptionArchive
     * @param $stateArchive
     * @param $rutaArchive
     * @param $Activity_idActivity
     */
    public function __construct()
    {
        parent::__construct();
        $this->idArchive = $Archive['idArchive'] ?? null;
        $this->nameArchive = $Archive['nameArchive'] ?? null;
        $this->descriptionArchive = $Archive['descriptionArchive'] ?? null;
        $this->stateArchive = $Archive['stateArchive'] ?? null;
        $this->rutaArchive = $Archive['rutaArchive'] ?? null;
        $this->Activity_idActivity = $Archive['Activity_idActivity'] ?? null;
    }

    function __destruct()
    {
        $this->Disconnect();
    }

    /**
     * @return int
     */
    public function getIdArchive(): int
    {
        return $this->idArchive;
    }

    /**
     * @param int $idArchive
     */
    public function setIdArchive(int $idArchive): void
    {
        $this->idArchive = $idArchive;
    }

    /**
     * @return String
     */
    public function getNameArchive(): String
    {
        return $this->nameArchive;
    }

    /**
     * @param String $nameArchive
     */
    public function setNameArchive(String $nameArchive): void
    {
        $this->nameArchive = $nameArchive;
    }

    /**
     * @return String
     */
    public function getDescriptionArchive(): String
    {
        return $this->descriptionArchive;
    }

    /**
     * @param String $descriptionArchive
     */
    public function setDescriptionArchive(String $descriptionArchive): void
    {
        $this->descriptionArchive = $descriptionArchive;
    }

    /**
     * @return String
     */
    public function getStateArchive(): String
    {
        return $this->stateArchive;
    }

    /**
     * @param String $stateArchive
     */
    public function setStateArchive(String $stateArchive): void
    {
        $this->stateArchive = $stateArchive;
    }

    /**
     * @return String
     */
    public function getRutaArchive(): String
    {
        return $this->rutaArchive;
    }

    /**
     * @param String $rutaArchive
     */
    public function setRutaArchive(String $rutaArchive): void
    {
        $this->rutaArchive = $rutaArchive;
    }

    /**
     * @return int
     */
    public function getActivityIdActivity(): Activity
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

    //crear Archive
    public function create()
    {
        $result = $this->insertRow("INSERT INTO iteandes_novatik.Archive VALUES (NULL, ?, ?, ?, ?,?)", array(
                $this->nameArchive,
                $this->descriptionArchive,
                $this->descrrutaArchiveiptionArchive,
                $this->Activity_idActivity->getIdActivity(),
                $this->stateArchive
            )
        );
        $this->setIdArchive(($result) ? $this->getLastId() : null);
        $this->Disconnect();
        return $result;
    }

    //Actualizar  un Archive
    public function update()
    {
        $result = $this->updateRow("UPDATE iteandes_novatik.Archive  SET nameArchive = ?, descriptionArchive = ?, rutaArchive= ?, Activity_idActivity = ?, stateArchive=? WHERE idArchive = ?", array(
                $this->idArchive,
                $this->nameArchive,
                $this->descriptionArchive,
                $this->rutaArchive,
                $this->Activity_idActivity->getIdActivity(),
                $this->stateArchive
            )
        );
        $this->Disconnect();
        return $result;
    }

    //inactivar un Archive
    public function delete($idArchive)
    {
        $Archive = Archive::searchForId($idArchive); //Buscando un Archive por el ID
        $Archive->setStateArchive("Inactivo"); //Cambia el estado del Archive
        return $Archive->update();                    //Guarda los cambios..
    }

//Funcion buscr por jquery
    public static function search($query)
    {
        $arrArchive = array();
        $tmp = new Archive();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $value) {
            $Archive = new Archive();
            $Archive->idArchive = $value['idArchive'];
            $Archive->nameArchive = $value['nameArchive'];
            $Archive->descriptionArchive = $value['descriptionArchive'];
            $Archive->rutaArchive = $value['rutaArchive'];
            $Archive->Activity_idActivity = Activity::searchForId($value['Activity_idActivity']);
            $Archive->stateArchive = $value['stateArchive'];
            $Archive->Disconnect();
            array_push($arrArchive, $Archive);
        }
        $tmp->Disconnect();
        return $arrArchive;
    }

    //Buscar toda la informacion de la tabla
    public static function getAll()
    {
        return Archive::search("SELECT * FROM iteandes_novatik.Archive");
    }

    public static function searchForId($idArchive)
    {
        $Archive = null;
        if ($idArchive > 0) {
            $Archive = new Archive();
            $getrow = $Archive->getRow("SELECT * FROM iteandes_novatik.Archive WHERE idArchive =?", array($idArchive));
            $Archive->idArchive = $getrow['idArchive'];
            $Archive->nameArchive = $getrow['nameArchive'];
            $Archive->descriptionArchive = $getrow['descriptionArchive'];
            $Archive->rutaArchive = $getrow['rutaArchive'];
            $Archive->Activity_idActivity = Activity::searchForId($getrow['Activity_idActivity']);
            $Archive->stateArchive = $getrow['stateArchive'];
        }
        $Archive->Disconnect();
        return  $Archive;
    }

    public function __toString()
    {
        return "id: $this->idArchive,nombre: $this->nameArchive, descripcion: $this->descriptionArchive , ruta: $this->rutaArchive,  actividad: $this->Activity_idActivity, estado: $this->stateArchive";
    }
}