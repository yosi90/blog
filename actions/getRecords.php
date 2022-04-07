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
require_once $_SERVER['DOCUMENT_ROOT'] . '/blog/Config/Config.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/entradas/RepositorioEntrada.inc.php';
require_once ROOT . 'app/comentarios/RepositorioComentario.inc.php';
require_once ROOT . 'app/usuarios/RepositorioUsuario.inc.php';
require_once ROOT . 'app/usuarios/Controlsesion.inc.php';
conexion::abrir_conexion();
switch ($type) {
    case 'reciente':
        $records = repositorioEntrada::obtenerRecientes(Conexion::obtener_conexion());
        break;
    case 'busquedaE':
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
echo json_encode($records);
