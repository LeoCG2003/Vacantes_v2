<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/rechazo.php");

    $id_validacion = $_GET["id_validacion"] ?? null;

    $rechazo = new Rechazo();
    $nota_rechazo = $rechazo->verDetallesRechazo($id_validacion);

    echo $nota_rechazo;

?>