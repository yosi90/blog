<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/usuario.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentarios.inc.php';
include_once 'app/controlsesion.inc.php';

//Primero destruimos variables de sesión que no deben existir fuera de su entorno
try{
    unset($_SESSION['entradaPrevia']);
} catch (PDOException $ex){}

$componentes_url = parse_url($_SERVER['REQUEST_URI']);
$ruta = $componentes_url['path'];
$partes_ruta = explode('/', $ruta);
$partes_ruta = array_filter($partes_ruta);
$partes_ruta = array_slice($partes_ruta, 0);
$ruta_elegida = 'vistas/404.php';
if ($partes_ruta[0] == 'blog') {
    if (count($partes_ruta) == 1) {
        $ruta_elegida = 'vistas/home.php';
    } else if (count($partes_ruta) == 2) {
        switch ($partes_ruta[1]) {
            case 'buscar':
                $ruta_elegida = 'vistas/busqueda.php';
                break;
            case 'autores':
                $ruta_elegida = 'vistas/autores.php';
                break;
            case 'login':
                $ruta_elegida = 'vistas/login.php';
                break;
            case 'logout':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'scripts/logout.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'registro':
                $ruta_elegida = 'vistas/registro.php';
                break;
            case 'recuperar-password':
                $ruta_elegida = 'vistas/recuperar-password.php';
                break;
            case 'url-usr':
                $ruta_elegida = 'scripts/url-usr.php';
                break;
            case 'relleno-dev':
                if (controlsesion::sesion_iniciada() && $_SESSION['administrador'] == '1') {
                    $ruta_elegida = 'scripts/script-relleno.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'gestor':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'vistas/gestor.php';
                    $gestor_actual = '';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'gestor-administrador':
                if (controlsesion::sesion_iniciada() && $_SESSION['administrador'] == 1) {
                    $ruta_elegida = 'vistas/gestor-administrador.php';
                    $gestor_actual = '';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'nueva-entrada':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'vistas/nueva-entrada.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'activar-entrada':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'scripts/activar-entrada.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'archivar-entrada':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'scripts/archivar-entrada.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'borrar-entrada':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'scripts/borrar-entrada.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
            case 'editar-entrada':
                if (controlsesion::sesion_iniciada()) {
                    $ruta_elegida = 'vistas/editar-entrada.php';
                } else {
                    $ruta_elegida = 'vistas/home.php';
                }
                break;
        }
    } else if (count($partes_ruta) == 3) {
        if ($partes_ruta[1] == 'registro-correcto') {
            $nombre = $partes_ruta[2];
            echo $nombre;
            $ruta_elegida = 'vistas/registro-correcto.php';
        } else if ($partes_ruta[1] == 'entrada') {
            $url = $partes_ruta[2];
            conexion::abrir_conexion();
            $entrada = RepositorioEntrada::entrada_existe(conexion::obtener_conexion(), $url);
            if ($entrada != null) {
                $autor = repositoriousuario::obtener_usuario_id(conexion::obtener_conexion(), $entrada->getAutor());
                $comentarios = RepositorioComentarios::getComments(conexion::obtener_conexion(), $entrada->getId_entrada());
                $entradas_azar = repositorioentrada::entrada_azar(conexion::obtener_conexion(), 3);
                $ruta_elegida = 'vistas/entrada.php';
            }
        }
        if ($partes_ruta[1] == 'gestor' && controlsesion::sesion_iniciada()) {
            switch ($partes_ruta[2]) {
                case 'entradas':
                    $gestor_actual = 'entradas';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'comentarios':
                    $gestor_actual = 'comentarios';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'favoritos':
                    $gestor_actual = 'favoritos';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
                case 'archivo':
                    $gestor_actual = 'archivo';
                    $ruta_elegida = 'vistas/gestor.php';
                    break;
            }
        }
        if($partes_ruta[1] == 'rec-pass'){
            $url_unica = $partes_ruta[2];
            $ruta_elegida = 'vistas/actPass.php';
        }
    }
}
include_once $ruta_elegida;
