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
require_once '../app/controlsesion.inc.php';
if (controlSesion::sesion_iniciada())
    switch ($type) {
        case 'priv':
            $records = array("mod" => $_SESSION['moderador'], "adm" => $_SESSION['administrador']);
            echo json_encode($records) ?? 'empty';
            break;
        case 'mod':
            echo $_SESSION['moderador'] ?? '0';
            break;
        case 'adm':
            echo $_SESSION['administrador'] ?? '0';
            break;
        default:
            die(error('Value not valid'));
            break;
    }
