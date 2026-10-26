<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/vacante.php");

    $id_vacante = $_POST["id_vacante"] ?? "";
    $datos = $_POST["datos"] ?? "";
    
    if($datos != ""){
        $entidad = ($datos["entidad"] === "") ? null : $datos["entidad"]; 
        $municipio = ($datos["municipio"] === "") ? null : $datos["municipio"]; 
        $institucion = ($datos["institucion"] === "") ? null : $datos["institucion"]; 
        $region = ($datos["region"] === "") ? null : $datos["region"]; 
        $zona_economica = ($datos["zona_economica"] === "") ? null : $datos["zona_economica"]; 
        $proceso = ($datos["proceso"] === "") ? null : $datos["proceso"]; 
        $tipo_apreciacion = ($datos["tipo_apreciacion"] === "") ? null : $datos["tipo_apreciacion"]; 
        $tipo_vacante = ($datos["tipo_vacante"] === "") ? null : $datos["tipo_vacante"]; 
        $tipo_plaza = ($datos["tipo_plaza"] === "") ? null : $datos["tipo_plaza"]; 
        $numero_horas = ($datos["numero_horas"] === "") ? null : $datos["numero_horas"]; 
        $tipo_sostenimiento = ($datos["tipo_sostenimiento"] === "") ? null : $datos["tipo_sostenimiento"]; 
        $fecha_inicio_vacancia = ($datos["fecha_inicio_vacancia"] === "") ? null : $datos["fecha_inicio_vacancia"]; 
        $fecha_fin_vacancia = ($datos["fecha_fin_vacancia"] === "") ? null : $datos["fecha_fin_vacancia"]; 
        $clv_categoria = ($datos["clv_categoria"] === "") ? null : $datos["clv_categoria"]; 
        $paquete_de_plaza = ($datos["paquete_de_plaza"] === "") ? null : $datos["paquete_de_plaza"]; 
        $clave_plaza = ($datos["clave_plaza"] === "") ? null : $datos["clave_plaza"]; 
        $cctPlazaDondeCobra = ($datos["cctPlazaDondeCobra"] === "") ? null : $datos["cctPlazaDondeCobra"]; 
        $cctPlazaDondeTrabaja = ($datos["cctPlazaDondeTrabaja"] === "") ? null : $datos["cctPlazaDondeTrabaja"]; 
        $turno = ($datos["turno"] === "") ? null : $datos["turno"];
        $tipo_de_licencia = ($datos["tipo_de_licencia"] === "") ? null : $datos["tipo_de_licencia"]; 
        $codigo_licencia = ($datos["codigo_licencia"] === "") ? null : $datos["codigo_licencia"]; 
        $inicio_de_licencia = ($datos["inicio_de_licencia"] === "") ? null : $datos["inicio_de_licencia"]; 
        $observaciones = ($datos["observaciones"] === "") ? null : $datos["observaciones"]; 
        $inicio_ocupacion = ($datos["inicio_ocupacion"] === "") ? null : $datos["inicio_ocupacion"];
        $fin_ocupacion = ($datos["fin_ocupacion"] === "") ? null : $datos["fin_ocupacion"];
        $ordenamiento = ($datos["ordenamiento"] === "") ? null : $datos["ordenamiento"]; 
        $curp = ($datos["curp"] === "") ? null : $datos["curp"]; 
        $nombre_docente = ($datos["nombre_docente"] === "") ? null : $datos["nombre_docente"]; 
        $codigo = ($datos["codigo"] === "") ? null : $datos["codigo"];
    }

    $vacante = new Vacante();
    $resultado = $vacante->corregirCaptura($id_vacante, $entidad, $municipio, $institucion, $region, $zona_economica, $proceso, $tipo_apreciacion, $tipo_vacante, $tipo_plaza, $numero_horas, $tipo_sostenimiento, $fecha_inicio_vacancia, $fecha_fin_vacancia, $clv_categoria, $paquete_de_plaza, $clave_plaza, $cctPlazaDondeCobra, $cctPlazaDondeTrabaja, $turno, $tipo_de_licencia, $codigo_licencia, $inicio_de_licencia, $observaciones, $inicio_ocupacion, $fin_ocupacion, $ordenamiento, $curp, $nombre_docente, $codigo);

    echo $resultado;
?>  