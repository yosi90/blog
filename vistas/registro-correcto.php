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
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header text-white bg-dark">
                    <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                        </svg>
                        Registro correcto
                    </h2>
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
                    <h4>Hemos enviado un correo de verificación al email con el que te has registrado.<br> Visita la url que contiene para activar tu cuenta.</h4>
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