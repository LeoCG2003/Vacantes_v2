
<?php

header('Content-Type: application/json; charset=utf-8');

$usuario  = 'vacantes';
$password = md5('4cc3355w3b74c');
// $password = "conincorrectaprueba";

$datos = [
    'usuario'    => $usuario,
    'password'   => $password,
    'cod_pago'   => $_POST['cod_pago'] ?? '',
    'unidad'     => $_POST['unidad'] ?? '',
    'subunidad'  => $_POST['subunidad'] ?? '',
    'cat_puesto' => $_POST['cat_puesto'] ?? '',
    'horas'      => $_POST['horas'] ?? '',
    'cons_plaza' => $_POST['cons_plaza'] ?? '',
    'qna_ini' => $_POST['qna_ini'] ?? '',
];

$url = 'https://netlax.septlaxcala.gob.mx/modulos/control_fup/servicios/buscarEFUP.php';

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query($datos),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/x-www-form-urlencoded'
    ]
]);

$respuesta = curl_exec($ch);

echo $respuesta;