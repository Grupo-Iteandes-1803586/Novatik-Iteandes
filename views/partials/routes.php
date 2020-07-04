<?php
    //$RutaAbsoluta = "\Novatik-Iteandes\views\index.php"; //https://www.php.net/manual/es/regexp.reference.escape.php
    //$RutaRelativa = "../index.php";

    //Carga las librerias importadas del composer
    require(__DIR__ .'/../../vendor/autoload.php');
    //__DIR__ => D:\laragon\www\Novatik-Iteandes\views\partials
?>
<?php
    $dotenv = Dotenv\Dotenv::create(__DIR__ ."../../../"); //Cargamos el archivo .env de la raiz del sitio
    $dotenv->load(); //Carga las variables del archivo .env

    $baseURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".getenv('ROOT_FOLDER');
    //https://localhost/Novatik-Iteandes/
    $adminlteURL = $baseURL."/vendor/almasaeed2010/adminlte";
    //https://localhost/Novatik-Iteandes/vendor/almasaeed2010/adminlte
?>