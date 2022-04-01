<?php
$titulo = 'Troubles time - Panel de control';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/pc_declare.inc.php';

switch ($gestor_actual)
{
    case '':
        include_once 'app/Conexion.inc.php';
        conexion::abrir_conexion();
        $entradas_activas = repositorioEntrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 1);
        $entradas_inactivas = repositorioEntrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0);
        $comentarios = repositorioComentarios::usr_comments(conexion::obtener_conexion(), $_SESSION['id_usuario']);
        include_once 'plantillas/gestor-generico.inc.php';
        conexion::cerrar_conexion();
        break;
    case 'entradas':
        include_once 'plantillas/gestor-entradas.inc.php';
        break;
    case 'favoritos':
        include_once 'plantillas/gestor-favoritos.inc.php';
        break;
    case 'comentarios':
        include_once 'plantillas/gestor-comentarios.inc.php';
        break;
    case 'archivo':
        include_once 'plantillas/gestor-archivo.inc.php';
        break;
}
include_once 'plantillas/pc_closing.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
