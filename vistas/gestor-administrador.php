<?php 
$titulo = 'Troubles time - Panel de administración';
    require_once ROOT . 'plantillas/documento-declaracion.inc.php';
    require_once ROOT . 'config/Conexion.inc.php';
    require_once ROOT . 'plantillas/pc_declare.inc.php';
    conexion::abrir_conexion();
    
    switch ($gestor_actual)
    {
        case '':
            $entradas_activas = repositorioentrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 1);
            $entradas_inactivas = repositorioentrada::entradas_usr(conexion::obtener_conexion(), $_SESSION['id_usuario'], 0);
            $comentarios = repositoriocomentarios::usr_comments(conexion::obtener_conexion(), $_SESSION['id_usuario']);
            require_once ROOT . 'plantillas/gestor-generico.inc.php';
            break;
        case 'entradas':
            $array_entradas = repositorioentrada::entradas_usr_fecha(conexion::obtener_conexion(), $_SESSION['id_usuario']);
            require_once ROOT . 'plantillas/gestor-entradas.inc.php';
            break;
        case 'favoritos':
            require_once ROOT . 'plantillas/gestor-favoritos.inc.php';
            break;
        case 'comentarios':
            require_once ROOT . 'plantillas/gestor-comentarios.inc.php';
            break;
        case 'archivo':
            $array_archivo = repositorioentrada::entradasArchivadas(conexion::obtener_conexion(), $_SESSION['id_usuario']);
            require_once ROOT . 'plantillas/gestor-archivo.inc.php';
            break;
    }
    conexion::cerrar_conexion();
    require_once ROOT . 'plantillas/pc_closing.inc.php';
    require_once ROOT . 'plantillas/documento-cierre.inc.php';
