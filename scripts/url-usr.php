<?php
require_once 'app/Conexion.inc.php';
require_once 'app/RepositorioUsuario.inc.php';
require_once 'app/RepositorioRecuperarPassword.inc.php';
require_once 'src/Mailer.php';
require_once 'src/Utils.php';

use src\Utils;

if (isset($_POST['correo'])) {
    conexion::abrir_conexion();
    $email = $_POST['correo'];
    $usuario = RepositorioUsuario::obtener_usuario_email(conexion::obtener_conexion(), $email);
    if (isset($usuario)) {
        $peticion = RepositorioRecuperarPassword::existePeticion(conexion::obtener_conexion(), $usuario->getId());
        if ($peticion == 'bloqueado') {
            echo '<script>alert("Demasiados intentos seguidos, inténtalo de nuevo mañana");window.location.href = "' . SERVIDOR . '"</script>';
        } else if ($peticion != false) {
            echo '<script>window.location.href = "' . RUTA_URL_REC . '/' . $peticion->getUrl() . '"</script>';
        } else {
            $urlRandom = hash('sha256', Utils::TextoRandom(rand(0, 40)) . $usuario->getNombre());
            $peticion = RepositorioRecuperarPassword::generarPeticion(conexion::obtener_conexion(), $usuario->getId(), $urlRandom);
            if ($peticion) {
                new Mailer($email, $usuario->getNombre(), 'Enlace de recuperación de contraseña', $urlRandom, 'rec');
                echo '<script>alert("Se ha enviado un correo electrónico con instrucciones a la dirección solicitada");window.location.href = "' . SERVIDOR . '"</script>';
            } else
                echo '<script>alert("Ha ocurrido un error al generar la petición");window.location.href = "' . SERVIDOR . '"</script>';
        }
    } else
        echo '<script>alert("Ese correo no figura en la base de datos");window.location.href = "' . RUTA_RECUPERAR_PASS . '"</script>';
    conexion::cerrar_conexion();
}