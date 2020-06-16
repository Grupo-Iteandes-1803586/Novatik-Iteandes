<?php

/**
 * Create by PhpStorm.
 * User: Kakuja_Pc
 * Date: 21/jun/2020
 * Hour: 12:40
 */

#Creacion de Clase Abstracta
abstract class BasicModel{
    #Creacion de variables
    public $isConnected;
    protected $datab;
    private $username ="iteandes";
    private $password="iteandesNovatik";
    private $host ="localhost";
    private $driver="mysql";//tipo de Base de datos a usar
    private $dbname ="Iteandes_Novatik";//Nombre de la base de datos

    #Metodos abstractos para CRUD de clases que heredan
    abstract protected static function search($query);
    abstract protected static function getAll();
    abstract protected static function searchForId($id);
    abstract protected function create();
    abstract protected function update();
    abstract protected function delete($id);

    #Metodo Constructor
    public function __construct(){
        $this->isConnected = true;
        try{
            $this -> datab = new \PDO(
                ($this ->driver != "sqlsrv") ?
                    "$this->driver:host={$this->host};dbname={$this->dbname};charset=utf8":
                    "$this->driver:Server=$this->host;database=$this->dbname",
                $this->username, $this->password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            $this->datab->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->datab->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->datab->setAttribute(\PDO::ATTR_PERSISTENT, true);
        }catch (PDOException $e){
            $this -> isConnected= false;
            throw new \Exception($e -> getMessage());
        }
    }
    #Disconnecting from database 0 desconexion de la base de datos
    public function Disconnect(){
        $this->datab = null;
        $this->isConnected = false;
    }
    #Geting row devuelve en una sola fila el valor de la base de datos
    public function getRow($query,$params=array()){
        try{
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }catch (PDOException $e){
            throw new \Exception($e -> getMessage());
        }
    }
    #Getting multiple rows
    #$getrows = $database->getRows("SELECT id, username FROM users");
    public function getRows($query, $params=array()){
        try{
            $stmt = $this->datab->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    //Getting last id insert
    public function getLastId(){
        try{
            return $this->datab->lastInsertId();
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    //inserting un campo
    public function insertRow($query, $params){
        try{
            if (is_null($this->datab)){
                $this->__construct();
            }
            $stmt = $this->datab->prepare($query);
            return $stmt->execute($params);
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    //updating existing row
    public function updateRow($query, $params){
        return $this->insertRow($query, $params);
    }

    //delete a row
    //$deleterow = $database->deleteRow("DELETE FROM users WHERE id = ?", array("1"));
    public function deleteRow($query, $params){
        return $this->insertRow($query, $params);
    }

}