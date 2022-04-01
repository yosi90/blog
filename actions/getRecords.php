<?php
function error($msg)
{
    $response = array("success" => false, "message" => $msg);
    return json_encode($response);
}

$type = $_POST['type'];
$filtro = $_POST['filter'];
if ($type == "") {
    die(error('Error: no type'));
}
require_once '../app/Conexion.inc.php';
require_once '../app/RepositorioEntrada.inc.php';
require_once '../app/RepositorioComentario.inc.php';
require_once '../app/RepositorioUsuario.inc.php';
require_once '../app/controlsesion.inc.php';
conexion::abrir_conexion();
switch ($type) {
    case 'reciente':
        $records = repositorioEntrada::obtenerRecientes(Conexion::obtener_conexion());
        break;
    case 'busqueda':
        $records = RepositorioEntrada::obtenerFiltradas(Conexion::obtener_conexion(), "%" . $filtro . "%");
        break;
    case 'busquedaC':
        $records = RepositorioComentario::obtenerFiltrados(Conexion::obtener_conexion(), "%" . $filtro . "%");
        break;
    case 'busquedaU':
        $records = RepositorioUsuario::obtenerFiltrados(Conexion::obtener_conexion(), "%" . $filtro . "%");
        break;
    case 'tabla':
        if (controlSesion::sesion_iniciada())
            $records = repositorioEntrada::entradasUsuario(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0, 0);
        break;
    case 'archivo':
        if (controlSesion::sesion_iniciada())
            $records = repositorioEntrada::entradasUsuario(conexion::obtener_conexion(), $_SESSION['id_usuario'], 1, 0);
        break;
    default:
        break;
}
conexion::cerrar_conexion();
echo json_encode($records) ?? die(error('Value not valid'));
