<?php
namespace App\Controllers;
require_once(__DIR__.'/../Models/Student.php');
require_once(__DIR__.'/../Models/Person.php');

use App\Models\Student;
use App\Models\Person;

//Metodo Get para recibir la accion
if(!empty($_GET['action'])){
    StudentControllers::main($_GET['action']);
}
//Cracion de la clase
class StudentControllers
{
    //Metodo main
    static function main($action)
    {
        if ($action == "create") {
            StudentControllers::create();
        } else if ($action == "edit") {
            StudentControllers::edit();
        } else if ($action == "searchForId") {
            StudentControllers::searchForId($_REQUEST['idStudent']);
        } else if ($action == "getAll") {
            StudentControllers::getAll();
        } else if ($action == "active") {
            StudentControllers::active();
        } else if ($action == "inactive") {
            StudentControllers::inactive();
        }
    }
    static public function create()
    {
        try {
            $arrayVenta = array();
            $arrayVenta['numero_serie'] = ;
            $arrayVenta['cliente_id'] = Usuarios::searchForId($_POST['cliente_id']);
            $arrayVenta['empleado_id'] = Usuarios::searchForId($_POST['empleado_id']);
            $arrayVenta['fecha_venta'] = date('Y-m-d H:i:s'); //Fecha Completa Hoy
            $arrayVenta['monto'] = 0;
    |        $arrayVenta['estado'] = 'Activo';
            $Venta = new Ventas($arrayVenta);
            if($Venta->create()){
                header("Location: ../../views/modules/ventas/create.php?id=".$Venta->getId());
            }
        } catch (Exception $e) {
            GeneralFunctions::console( $e, 'error', 'errorStack');
            header("Location: ../../views/modules/ventas/create.php?respuesta=error&mensaje=" . $e->getMessage());
        }
    }
}