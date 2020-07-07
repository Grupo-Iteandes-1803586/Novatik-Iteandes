<?php
require(__DIR__.'/../Models/Lenguages.php');
use App\Models\Lenguages;

if(!empty($_GET['action'])){
    LenguagesControllers::main($_GET['action']);
}
class  LenguagesControllers
{
    static function main($action)
    {
        if ($action == "create") {
            LenguagesControllers::create();
        } else if ($action == "edit") {
            LenguagesControllers::edit();
        } else if ($action == "searchForID") {
            LenguagesControllers::searchForID($_REQUEST['idLenguages']);
        } else if ($action == "searchAll") {
            LenguagesControllers::getAll();
        }
    }

    static public function create()
    {
        try {
            $arrayLenguages = array();
            $arrayLenguages['idLenguages'] = $_POST['idLenguages'];
            $arrayLenguages['nameLenguages'] = $_POST['nameLenguages'];

                $Lenguages = new Lenguages  ($arrayLenguages);
                if($Lenguages->create()){
                    header("Location: ../../views/modules/Lenguages/create.php?respuesta=correcto");
                } else{
                header("Location: ../../views/modules/Lenguages/create.php?respuesta=error&mensaje=Lenguages ya registrado");
            }
        } catch (Exception $e) {
            header("Location: ../../views/modules/Lenguages/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }

    static public function edit (){
        try {
            $arrayLenguages  = array();
            $arrayLenguages ['idLenguages'] = $_POST['idLenguages'];
            $arrayLenguages ['nameLenguages'] = $_POST['nameLenguages'];

            $Lenguages = new Lenguages($arrayLenguages );
            $Lenguages->update();

            header("Location: ../../views/modules/Lenguages /show.php?id=".$Lenguages->getIdLenguages()."&respuesta=correcto");
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Lenguages /edit.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }
    static public function activate (){
        try {
            $Lenguages = Lenguages::searchForId($_GET['Id']);
            $Lenguages->setEstado("Activo");
            if($Lenguages->update()){
                header("Location: ../../views/modules/Lenguages/index.php");
            }else{
                header("Location: ../../views/modules/Lenguages/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Lenguages/index.php?respuesta=error&mensaje=".$e->getMessage());
        }
    }

    static public function inactivate (){
        try {
            $Lenguages = Lenguages::searchForId($_GET['Id']);
            $Lenguages->setEstado("Inactivo");
            if($Lenguages->update()){
                header("Location: ../../views/modules/Lenguages/index.php");
            }else{
                header("Location: ../../views/modules/Lenguages/index.php?respuesta=error&mensaje=Error al guardar");
            }
        } catch (\Exception $e) {
            //var_dump($e);
            header("Location: ../../views/modules/Lenguages/index.php?respuesta=error");
        }
    }

    static public function searchForID ($idLenguages){
        try {
            return Lenguages ::searchForId($idLenguages);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

    static public function getAll ()
    {
        try {
            return Lenguages ::getAll();
        } catch (\Exception $e) {
            var_dump($e);

        }
    }

}