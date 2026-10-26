<?php
    // session_start();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    require_once("../base/firmasLayout.php");
    require_once("../base/firma.php");
    require_once("../base/vacante.php");
    require_once("../base/formato_pdf.php");

    $qna_folio = $_GET["qna_folio"] ?? null;
    $id_tipo_layout = $_GET["id_tipo_layout"] ?? null;

    $firmasLayout = new FirmasLayout();
    $id_firma_layout = $firmasLayout->listadoFirmasLayout($id_tipo_layout);

    $vacante = new Vacante();
    $lista_vacantes = $vacante->cargarVacantesImpresionQna($qna_folio);

    $firma = new Firma();
    $imgs_firmas = $firma->obtenerFirmas($id_firma_layout);

    $pdf = new PDF();

    // Proceso de poner los datos


    echo "FILE";


?>