<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/catalogo.php");

    $tabla = $_GET["tabla"] ?? null;
    $proceso = $_GET["proceso"] ?? null;

    $catalogo = new Listas();
    $listado = $catalogo->listar($tabla, $proceso);

    echo $listado;
