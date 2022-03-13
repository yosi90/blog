<?php
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/validadorRegistro.inc.php';
include_once 'app/usuario.inc.php';
if (isset($_POST['submit'])) {
    conexion::abrir_conexion();
    $validador = new validadorRegistro($_POST['nombre'], $_POST['email'], $_POST['clave1'], $_POST['clave2'], conexion::obtener_conexion());
    if ($validador->registro_valido()) {
        $usuario = new usuario('', $validador->obtener_nombre(), $validador->obtener_email(), password_hash($validador->obtener_clave(), PASSWORD_DEFAULT), '', '', 0);
        $usuario_insertado = RepositorioUsuario::insertar_usuario(conexion::obtener_conexion(), $usuario);
        if ($usuario_insertado) {
            redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuario->getNombre());
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
                        <a href="#" class="my-3"> ¿Olvidate tu contraseña?</a>
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
                            include_once 'plantillas/registro_validado.inc.php';
                        } else {
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>