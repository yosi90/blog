<?php
require_once 'app/Conexion.inc.php';
require_once 'app/RepositorioActivarUsuario.inc.php';

conexion::abrir_conexion();
$peticion = RepositorioActivarUsuario::peticionPorUrl(conexion::obtener_conexion(), $url_unica);
if ($peticion != null) {
    $exito = RepositorioActivarUsuario::activarCuenta(conexion::obtener_conexion(), $peticion->getIdUsr());
    if($exito)
        echo '<script>alert("Tu cuenta ha sido activada satisfactoriamente.<br>Ahora te redirigiremos a login para que puedas iniciar sesión.");window.location.href = "' . RUTA_LOGIN . '"</script>';
    else
        echo '<script>alert("Ha habido un problema con la activación, por favor solicita un nuevo correo en la pantalla de login.");window.location.href = "' . SERVIDOR . '"</script>';
} else {
    if ($peticion == null)
        echo '<script>alert("Ha habido un problema con la activación, por favor solicita un nuevo correo en la pantalla de login.");window.location.href = "' . SERVIDOR . '"</script>';
}
conexion::cerrar_conexion();