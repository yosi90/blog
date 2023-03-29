<?php
$titulo = 'Troubles time - Panel de control';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/pc_declare.inc.php';

switch ($gestor_actual)
{
    case '':
        echo '<script>$(\'[id^="gen"]\').addClass("bg-rosa");</script>';
        include_once 'app/Conexion.inc.php';
        conexion::abrir_conexion();
        $entradas_activas = repositorioEntrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 1);
        $entradas_inactivas = repositorioEntrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0);
        $comentarios = repositorioComentario::usr_comments(conexion::obtener_conexion(), $_SESSION['id_usuario']);
        include_once 'plantillas/gestor-generico.inc.php';
        conexion::cerrar_conexion();
        break;
    case 'entradas':
        echo '<script>$(\'[id^="ent"]\').addClass("bg-rosa");</script>';
        include_once 'plantillas/gestor-entradas.inc.php';
        break;
    case 'favoritos':
        echo '<script>$(\'[id^="fav"]\').addClass("bg-rosa");</script>';
        include_once 'plantillas/gestor-favoritos.inc.php';
        break;
    case 'comentarios':
        echo '<script>$(\'[id^="com"]\').addClass("bg-rosa");</script>';
        include_once 'plantillas/gestor-comentarios.inc.php';
        break;
    case 'archivo':
        echo '<script>$(\'[id^="arc"]\').addClass("bg-rosa");</script>';
        include_once 'plantillas/gestor-archivo.inc.php';
        break;
}
include_once 'plantillas/pc_closing.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
