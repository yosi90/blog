<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioRecuperarPassword.inc.php';
conexion::abrir_conexion();
$peticion = RepositorioRecuperarPassword::peticionPorUrl(conexion::obtener_conexion(), $url_unica);
if ($peticion == null) {
?>
    <script>
        window.location.href = "<?php echo SERVIDOR ?>"
    </script>
<?php
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
                    <form class="d-flex flex-row flex-wrap w-100" role="form" method="post" action="<?php echo RUTA_URL_USR ?>">
                        <input name="clave1" class="form-control textbox mt-1" type="password" maxlength="25" placeholder="Nueva contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La contraseña debe contener al menos un número, una letra minúscula, una letra mayúscula y al menos 8 caracteres." required>
                        <input name="clave2" class="form-control textbox mt-1" type="password" maxlength="25" placeholder="Confirmar nueva contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La contraseña debe contener al menos un número, una letra minúscula, una letra mayúscula y al menos 8 caracteres." required>
                        <button type="submit" name="login" id="login" class="btn btn-outline-light form-control mt-3 flex-fill">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>