<?php
function error($msg)
{
    $response = array("success" => false, "message" => $msg);
    return json_encode($response);
}
require_once '../app/config.inc.php';
$type = $_POST['type'];
if ($type == "") {
    die(error('Error: no type'));
}
require_once '../app/controlsesion.inc.php';
switch ($type) {
    case 'entrada':
        $prueba = RUTA_ENTRADA;
        echo RUTA_ENTRADA ?? 'empty';
        break;
    case 'activar':
        if (controlSesion::sesion_iniciada())
            echo RUTA_ACTIVAR_ENTRADA ?? 'empty';
        break;
    case 'editar':
        if (controlSesion::sesion_iniciada())
            echo RUTA_EDITAR_ENTRADA ?? 'empty';
        break;
    case 'archivar':
        if (controlSesion::sesion_iniciada())
            echo RUTA_ARCHIVAR_ENTRADA ?? 'empty';
        break;
    case 'bloquear':
        if (controlSesion::sesion_iniciada())
            if ($_SESSION['moderador'] == 1 || $_SESSION['administrador'] == 1)
                echo RUTA_BLOQUEAR_ENTRADA ?? 'empty';
        break;
    case 'borrar':
        if (controlSesion::sesion_iniciada())
            if ($_SESSION['administrador'] == 1)
                echo RUTA_BORRAR_ENTRADA ?? 'empty';
        break;
    case 'autores':
        echo RUTA_AUTORES ?? 'empty';
        break;
    default:
        echo 'empty';
        break;
}
