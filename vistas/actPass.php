<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioRecuperarPassword.inc.php';
include_once 'app/validadorActPass.inc.php';
conexion::abrir_conexion();
$peticion = RepositorioRecuperarPassword::peticionPorUrl(conexion::obtener_conexion(), $url_unica);
if (isset($_POST['submit'])) {
    $validador = new validadorActPass($_POST['clave1'], $_POST['clave2']);
    if ($validador->registroValido()) {
        if (RepositorioRecuperarPassword::ActualizarContraseña(conexion::obtener_conexion(),  password_hash($validador->getClave(), PASSWORD_DEFAULT), $peticion->getIdUsr(), $peticion->getIdUrl())) {
?>
            <script>
                alert("Contraseña actualizada satisfactoriamente");
                window.location.href = "<?php echo RUTA_LOGIN ?>"
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("Algo ha salido mal y no se ha podido actualizar la contraseña");
            </script>
        <?php
        }
    }
} else {
    if ($peticion == null) {
        ?>
        <script>
            window.location.href = "<?php echo SERVIDOR ?>"
        </script>
<?php
    }
}
conexion::cerrar_conexion();
$titulo = 'Troubles time - Actualizar contraseña';
include_once 'plantillas/documento-declaracion.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card bg-dark mt-5">
                <div class="card-header text-white text-center">
                    <h2>Actualizar contraseña</h2>
                </div>
                <div class="card-body text-white d-flex flex-row flex-wrap">
                    <form class="d-flex flex-row flex-wrap w-100" role="form" method="post" action="<?php echo RUTA_URL_REC . '/' . $url_unica ?>">
                        <?php
                        if (isset($_POST['submit'])) {
                            include_once 'plantillas/form_act_pass_validado.inc.php';
                        } else {
                            include_once 'plantillas/form_act_pass_vacio.inc.php';
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