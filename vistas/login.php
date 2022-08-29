<?php

$titulo = "Troubles Time - Login";
require_once 'plantillas/documento-declaracion.inc.php';
require_once 'app/validadorLogin.inc.php';
require_once 'app/redireccion.inc.php';

if (controlsesion::sesion_iniciada()) {
    redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['enviar'])) {
    require_once 'app/RepositorioActivarUsuario.inc.php';
    require_once 'src/Mailer.php';
    conexion::abrir_conexion();
    $usuario = RepositorioUsuario::obtener_usuario_email(conexion::obtener_conexion(), $_POST['correo']);
    $peticion = RepositorioActivarUsuario::peticionPorUsr(conexion::obtener_conexion(), $usuario->getId());
    new Mailer($usuario->getEmail(), $usuario->getNombre(), 'Enlace de activación de cuenta', $peticion->getUrl(), 'act');
    $_SESSION['usuario'] = $usuario;
    echo '<script>window.location.href = "' . RUTA_REGISTRO_CORRECTO . '"</script>';
    conexion::cerrar_conexion();
} else if (isset($_POST['login'])) {
    conexion::abrir_conexion();
    $validador = new validadorLogin($_POST['correo'], $_POST['clave'], conexion::obtener_conexion());
    if ($validador->obtener_error() === '' && !is_null($validador->obtener_usuario())) {
        controlsesion::iniciar_sesion($validador->obtener_usuario()->getid(), $validador->obtener_usuario()->getnombre(), $validador->obtener_usuario()->getMod(), $validador->obtener_usuario()->getAdm());
        echo '<script>window.location.href = "' . SERVIDOR . '"</script>';
    }
    conexion::cerrar_conexion();
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card bg-dark mt-5">
                <div class="card-header text-white text-center">
                    <h2>Login</h2>
                </div>
                <div class="card-body text-white d-flex flex-row flex-wrap">
                    <form class="d-flex flex-row flex-wrap" role="form" method="post" action="<?php echo RUTA_LOGIN ?>">
                        <input type="email" name="correo" id="correo" class="textbox form-control" placeholder="Email" <?php
                                                                                                                        if (isset($_POST['login']) && isset($_POST['correo']) && !empty($_POST['correo']))
                                                                                                                            echo 'value="' . $_POST['correo'] . '"';
                                                                                                                        ?> required="true" autofocus="true">
                        <input type="password" name="clave" id="clave" class="textbox form-control mt-1" placeholder="Contraseña" required="true">
                        <?php
                        if (isset($_POST['login'])) {
                            $validador->mostrar_error();
                        }
                        ?>
                        <button type="submit" name="login" id="login" class="btn btn-outline-light form-control mt-3 flex-fill">Iniciar sesión</button>
                    </form>
                    <div class="d-flex flex-row flex-wrap flex-fill justify-content-center mt-2">
                        <a href="<?php echo RUTA_RECUPERAR_PASS ?>">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
