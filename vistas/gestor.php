<?php
$titulo = 'Troubles time - Panel de control';
require_once ROOT . 'plantillas/documento-declaracion.inc.php';
require_once ROOT . 'plantillas/pc_declare.inc.php';

switch ($gestor_actual)
{
    case '':
        require_once ROOT . 'config/Conexion.inc.php';
        conexion::abrir_conexion();
        $entradas_activas = repositorioEntrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 1);
        $entradas_inactivas = repositorioEntrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0);
        $comentarios = repositorioComentario::usr_comments(conexion::obtener_conexion(), $_SESSION['id_usuario']);
        require_once ROOT . 'plantillas/gestor-generico.inc.php';
        conexion::cerrar_conexion();
        break;
    case 'entradas':
        require_once ROOT . 'plantillas/gestor-entradas.inc.php';
        break;
    case 'favoritos':
        require_once ROOT . 'plantillas/gestor-favoritos.inc.php';
        break;
    case 'comentarios':
        require_once ROOT . 'plantillas/gestor-comentarios.inc.php';
        break;
    case 'archivo':
        require_once ROOT . 'plantillas/gestor-archivo.inc.php';
        break;
}
require_once ROOT . 'plantillas/pc_closing.inc.php';
require_once ROOT . 'plantillas/documento-cierre.inc.php';
