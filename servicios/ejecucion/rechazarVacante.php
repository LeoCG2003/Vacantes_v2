<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/validacion.php");

    $id_usuario = $_POST["id_usuario"] ?? null;
    $id_vacante = $_POST["id_vacante"] ?? null;
    $id_estado = $_POST["id_estado_vacante"] ?? null;

    $valicaion = new Validacion();
    $id_validacion = $valicaion->rechazarVacante($id_vacante, $id_usuario, $id_estado);

    echo $id_validacion;
?>