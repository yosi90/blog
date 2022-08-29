<?php
$titulo = "Troubles time - recuperar contraseña";
include_once 'plantillas/documento-declaracion.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card bg-dark mt-5">
                <div class="card-header text-white text-center">
                    <h2>Recuperar contraseña</h2>
                </div>
                <div class="card-body text-white d-flex flex-row flex-wrap">
                    <form class="d-flex flex-row flex-wrap w-100" role="form" method="post" action="<?php echo RUTA_URL_USR ?>">
                        <input type="email" name="correo" id="correo" class="textbox form-control mt-1" placeholder="Introduce el Email con el que te registraste" required="true" autofocus="true">
                        <button type="submit" name="login" id="login" class="btn btn-outline-light form-control mt-3 flex-fill">Recuperar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
