<?php
$titulo = 'Troubles time - editando entrada';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/repositorioentrada.inc.php';
include_once 'app/validadorEntradaEditada.inc.php';
include_once 'app/repositoriousuario.inc.php';
include_once 'app/Conexion.inc.php';
if (isset($_POST['submit'])) {
    $activa = 1;
    conexion::abrir_conexion();
    $url = repositorioEntrada::crearUrl($_POST['titulo']);
    $validador = new validadorEntradaEditada($_POST['titulo'], $_POST['entrada'], $url, $_SESSION['entradaPrevia'], conexion::obtener_conexion());
    if (isset($_POST['activa'])) { $activa = 0; }
    if ($validador->entrada_valida()) {
        $entrada = new entrada(null, '', $_SESSION['id_usuario'], $url, htmlentities($validador->getTitulo(), ENT_QUOTES, 'UTF-8', true), $validador->getTexto(), null, $activa, 0);
        $entrada_insertada = repositorioentrada::actualizar_entrada(conexion::obtener_conexion(), $entrada, $_SESSION['entradaPrevia']);
        if ($entrada_insertada) {
            ?>
            <script>window.location.href = "<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl(); ?>"</script>
        <?php
        } else {
            ?>
            <script>alert("La entrada no pudo ser actualizada");</script>
            <?php
        }
    }
    conexion::cerrar_conexion();
}
include_once 'plantillas/pc_declare.inc.php';
?>
<div class="card mt-5">
    <div class="card-header bg-dark text-white">
        <h1 class="text-center"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Editando entrada</h1>
    </div>
    <div class="card-body bg-dark-light text-white">
        <form class="d-flex flex-row flex-wrap" method="POST" action="<?php echo RUTA_EDITAR_ENTRADA; ?>">
            <?php
            if (isset($_POST['edit'])) {
                $idEntrada = $_POST['IdEntrada'];
                conexion::abrir_conexion();
                $entrada = Repositorioentrada::getEntrada(conexion::obtener_conexion(), $idEntrada);
                $_SESSION['entradaPrevia'] = $entrada;
                include_once 'plantillas/form_editar_entrada.inc.php';
                conexion::cerrar_conexion();
            } else if (isset($_POST['submit'])) {
                include_once 'plantillas/form_editar_entrada_validado.inc.php';
            }
            ?>
        </form>
    </div>
</div>
<?php
include_once 'plantillas/pc_closing.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
?>