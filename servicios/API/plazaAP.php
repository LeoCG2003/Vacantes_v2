
<?php

header('Content-Type: application/json; charset=utf-8');

$usuario  = 'vacantes';
$password = md5('4cc3355w3b74c');

error_log($password);

if (!$usuario || !$password) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Credenciales del servicio no configuradas'
    ]);
    exit;
}

$datos = [
    'usuario'    => $usuario,
    'password'   => $password,
    'cod_pago'   => $_POST['cod_pago'] ?? null,
    'unidad'     => $_POST['unidad'] ?? null,
    'subunidad'  => $_POST['subunidad'] ?? null,
    'cat_puesto' => $_POST['cat_puesto'] ?? null,
    'horas'      => $_POST['horas'] ?? null,
    'cons_plaza' => $_POST['cons_plaza'] ?? null
];

error_log(http_build_query($datos));

$url = 'https://netlax.septlaxcala.gob.mx/modulos/control_fup/servicios/buscarPlazaAP.php';

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