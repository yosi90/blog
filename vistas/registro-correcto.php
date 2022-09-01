<?php
$titulo = 'Troubles time - ¡Registro satisfactorio!';

require_once 'plantillas/documento-declaracion.inc.php';
require_once 'app/RepositorioUsuario.inc.php';
require_once 'app/RepositorioActivarUsuario.inc.php';
require_once 'app/Conexion.inc.php';

conexion::abrir_conexion();
if (isset($_SESSION['usuario'])) {
    $usuario = RepositorioUsuario::obtener_usuario_email(conexion::obtener_conexion(), $_SESSION['usuario']->getEmail());
    unset($_SESSION['usuario']);
}
if (isset($_POST['enviar'])) {
    $usuario = RepositorioUsuario::obtener_usuario_email(conexion::obtener_conexion(), $_POST['email']);
    $peticion = RepositorioActivarUsuario::peticionPorUsr(conexion::obtener_conexion(), $usuario->getId());
    require_once 'src/Mailer.php';
    new Mailer($usuario->getEmail(), $usuario->getNombre(), 'Enlace de activación de cuenta', $peticion->getUrl(), 'act');
    echo '<script>window.location.href = "' . RUTA_REGISTRO_CORRECTO . '"</script>';
}
conexion::cerrar_conexion();
?>
<div class="container">
    <div class="row pt-5">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header text-white bg-dark m-5">
                    <h1 class="text-center fw-bold">
                        <script defer src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player id="check-ok" src="<?php echo IMG ?>/check-ok.json" background="transparent" speed="0.7" style="width: 300px; height: 300px;" autoplay></lottie-player>
                        Registro correcto
                    </h1>
                </div>
                <div class="card-body text-center p-4">
                    <?php
                    if (!isset($_POST['enviar']) && isset($usuario)) {
                    ?>
                        <h3>¡Gracias por registrarte<b> <?php echo $usuario->getNombre() ?></b>!</h3>
                        <br>
                    <?php
                    }
                    ?>
                    <h5>Hemos enviado un correo de verificación al email con el que te has registrado.<br> Visita la url que contiene para activar tu cuenta.</h5>
                    <br>
                    <?php
                    if (isset($usuario)) {
                    ?>
                        <form class="d-flex flex-row flex-wrap w-100" role="form" method="post" action="<?php echo RUTA_REGISTRO_CORRECTO ?>">
                            <input type="hidden" name="email" id="email" value="<?php echo $usuario->getEmail() ?>">
                            <button type="submit" name="enviar" id="enviar" class="btn btn-dark form-control mt-3">Reenviar correo de verificación</button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>