<?php
class controlSesion
{
    public static function iniciar_sesion($id_usuario, $nombre_usuario, $moderador, $administrador)
    {
        if (session_id() == '' || session_id() == null) {
            session_start();
        }
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['moderador'] = $moderador;
        $_SESSION['administrador'] = $administrador;
    }

    public static function cerrar_sesion()
    {
        if (session_id() == '') {
            session_start();
        }
        if (isset($_SESSION['id_usuario'])) {
            unset($_SESSION['id_usuario']);
        }
        if (isset($_SESSION['nombre_usuario'])) {
            unset($_SESSION['nombre_usuario']);
        }
        if (isset($_SESSION['moderador'])) {
            unset($_SESSION['moderador']);
        }
        if (isset($_SESSION['administrador'])) {
            unset($_SESSION['administrador']);
        }
        session_destroy();
    }
    
    public static function sesion_iniciada()
    {
        if (session_id() == '') { session_start(); }
        if (isset($_SESSION['id_usuario']) && isset($_SESSION['nombre_usuario'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
