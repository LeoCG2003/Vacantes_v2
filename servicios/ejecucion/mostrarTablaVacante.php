<?php
    session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/vacante.php");
    require_once("../base/catalogo.php");

    $id = $_GET["id_estado_vacante"] ?? "";

    $vacante = new Vacante();
    $lista_vacantes = $vacante->verVacantesPorNivel($id);

    
    $map = new Listas();
    $datos_mapeados = $map -> mapearLlavesForaneas($lista_vacantes);

    

    echo $datos_mapeados;
?>  