<?php
include_once 'app/config.inc.php';
include_once 'app/Redireccion.inc.php';
$titulo = '¡Registro satisfactorio!';
include_once 'plantillas/base.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>  Registro correcto
                </div>
                <div class="panel-body text-center">
                    <p>¡Gracias por registrarte<b> <?php echo $nombre?></b>!</p>
                    <br>
                    <p><a href="<?php echo RUTA_LOGIN?>">Inicia sesión</a> para comenzar a usar tu cuenta.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/footer.inc.php';