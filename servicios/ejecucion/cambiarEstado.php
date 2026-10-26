<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once('../base/vacante.php');

    $id_vacante = $_POST['id_vacante'] ?? null;
    $nuevo_estado = $_POST['nuevo_estado'] ?? null;

    $vacante = new Vacante();
    $resultado = $vacante->cambiarEstado($id_vacante, $nuevo_estado);

    echo $resultado;
?>