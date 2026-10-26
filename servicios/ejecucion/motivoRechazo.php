<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/rechazo.php");

    $id_validacion = $_POST["id_validacion"] ?? null;
    $nota_rechazo = $_POST["nota_rechazo"] ?? null;

    $rechazo = new Rechazo();
    $resultado = $rechazo->motivoRechazo($id_validacion, $nota_rechazo);

    echo $resultado;

?>