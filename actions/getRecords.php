<?php
function error($msg)
{
    $response = array("success" => false, "message" => $msg);
    return json_encode($response);
}

$type = $_POST['type'];
if ($type == "") {
    die(error('Error: no type'));
}
require_once '../app/Conexion.inc.php';
require_once '../app/RepositorioEntrada.inc.php';
require_once '../app/controlsesion.inc.php';
conexion::abrir_conexion();
switch ($type) {
    case 'recientes':
        $records = repositorioEntrada::obtenerRecientes(Conexion::obtener_conexion());
        break;
    case 'tabla':
        if (controlSesion::sesion_iniciada())
            $records = repositorioEntrada::entradasUsuario(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0, 1);
        break;
    default:
        $records = "";
        break;
}
conexion::cerrar_conexion();
echo json_encode($records) ?? die(error('Value not valid'));
