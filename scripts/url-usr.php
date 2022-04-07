<?php
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/usuarios/RepositorioUsuario.inc.php';
require_once ROOT . 'app/RepositorioRecuperarPassword.inc.php';

if (isset($_POST['correo'])) {
    conexion::abrir_conexion();
    $email = $_POST['correo'];
    $usuario = RepositorioUsuario::obtener_usuario_email(conexion::obtener_conexion(), $email);
    if (isset($usuario)) {
        $peticion = RepositorioRecuperarPassword::existePeticion(conexion::obtener_conexion(), $usuario->getId());
        if ($peticion == 'bloqueado') {
?>
            <script>
                alert("Demasiados intentos seguidos, inténtalo de nuevo mañana");
                window.location.href = "<?php echo SERVIDOR ?>"
            </script>
        <?php
        } else if ($peticion != false) {
        ?>
            <script>
                window.location.href = "<?php echo RUTA_URL_REC . '/' . $peticion->getUrl() ?>"
            </script>
        <?php
        } else {
            $urlRandom = hash('sha256', TextoRandom(rand(0, 40)) . $usuario->getNombre());
            $peticion = RepositorioRecuperarPassword::generarPeticion(conexion::obtener_conexion(), $usuario->getId(), $urlRandom);
            /*Enviamos correo electrónico*/
        ?>
            <script>
                alert("Se ha enviado un correo electrónico con instrucciones a la dirección solicitada");
                window.location.href = "<?php echo SERVIDOR ?>"
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            alert("Ese correo no figura en la base de datos");
            window.location.href = "<?php echo RUTA_RECUPERAR_PASS ?>"
        </script>
<?php
    }
    conexion::cerrar_conexion();
}

function TextoRandom($longitud)
{
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}
