<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/vacante.php");
    require_once("../base/catalogo.php");

    $id = $_GET["id_vacante"] ?? "";

    $vacante = new Vacante();
    $datos_vacante = $vacante->verVacante($id);

    $map = new Listas();
    $datos_mapeados = $map -> mapearLlavesForaneas($datos_vacante);

    echo $datos_mapeados;

?>