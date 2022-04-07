<?php
require_once ROOT . 'plantillas/documento-declaracion.inc.php';
require_once ROOT . 'app/usuarios/validadorRegistro.inc.php';
require_once ROOT . 'app/usuarios/Usuario.inc.php';
if (isset($_POST['submit'])) {
    conexion::abrir_conexion();
    $validador = new validadorRegistro($_POST['nombre'], $_POST['email'], $_POST['clave1'], $_POST['clave2'], conexion::obtener_conexion());
    if ($validador->registro_valido()) {
        $usuario = new usuario('', $validador->obtener_nombre(), $validador->obtener_email(), password_hash($validador->obtener_clave(), PASSWORD_DEFAULT), '', '', 0, 0);
        $usuario_insertado = RepositorioUsuario::insertar_usuario(conexion::obtener_conexion(), $usuario);
        if ($usuario_insertado) {
?>
            <script>
                window.location.href = "<?php echo RUTA_LOGIN ?>"
            </script>
<?php
        }
    }
    conexion::cerrar_conexion();
}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-3 mt-5 mb-1 bg-dark translucido text-white jumbo fz-jumbo">Formulario de registro</div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center mb-5">
            <div class="card bg-dark">
                <div class="card-body">
                    <div class="row">
                        <a href="<?php echo RUTA_LOGIN; ?>" class="my-3 flex-row">¿Ya tienes cuenta?</a>
                    </div>
                    <div class="row">
                        <a href="<?php echo RUTA_RECUPERAR_PASS ?>" class="my-3"> ¿Olvidate tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card bg-dark">
                <div class="card-header bg-dark text-white text-center">
                    <h3>Introduce tus datos</h3>
                </div>
                <div class="card-body">
                    <form class="d-flex flex-row flex-wrap" method="POST" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['submit'])) {
                            require_once ROOT . 'plantillas/registro_validado.inc.php';
                        } else {
                            require_once ROOT . 'plantillas/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once ROOT . 'plantillas/documento-cierre.inc.php';
?>