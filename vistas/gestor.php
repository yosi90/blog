<?php
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'plantillas/pc_declare.inc.php';
conexion::abrir_conexion();
switch ($gestor_actual)
{
    case '':
        $entradas_activas = repositorioentrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 1);
        $entradas_inactivas = repositorioentrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0);
        $comentarios = repositoriocomentarios::usr_comments(conexion::obtener_conexion(), $_SESSION['id_usuario']);
        include_once 'plantillas/gestor-generico.inc.php';
        break;
    case 'entradas':
        $array_entradas = repositorioentrada::entradas_usr_fecha(conexion::obtener_conexion(), $_SESSION['id_usuario']);
        include_once 'plantillas/gestor-entradas.inc.php';
        break;
    case 'favoritos':
        include_once 'plantillas/gestor-favoritos.inc.php';
        break;
    case 'comentarios':
        include_once 'plantillas/gestor-comentarios.inc.php';
        break;
}
conexion::cerrar_conexion();
include_once 'plantillas/pc_closing.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
