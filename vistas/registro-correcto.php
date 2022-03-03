<?php
include_once '../app/redireccion.inc.php';
if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
} else {
    redireccion::redirigir(SERVIDOR);
}
$titulo = '¡Registro satisfactorio!';
include_once '../plantillas/documento-declaracion.inc.php';
include_once '../app/RepositorioUsuario.inc.php';
include_once '../app/Conexion.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header text-white bg-dark">
                    <h2><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                    </svg>
                    Registro correcto</h2>
                </div>
                <div class="card-body text-center p-4">
                    <h3>¡Gracias por registrarte<b> <?php echo $nombre ?></b>!</h3>
                    <br>
                    <h4><a href="<?php echo RUTA_LOGIN ?>">Inicia sesión</a> para comenzar a usar tu cuenta.</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once '../plantillas/documento-cierre.inc.php';
?>