<?php
$titulo = 'Troubles time - editando entrada';
require_once ROOT . 'plantillas/documento-declaracion.inc.php';
require_once ROOT . 'app/entradas/Entrada.inc.php';
require_once ROOT . 'app/entradas/RepositorioEntrada.inc.php';
require_once ROOT . 'app/validadorEntradaEditada.inc.php';
require_once ROOT . 'app/usuarios/RepositorioUsuario.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
if (isset($_POST['submit'])) {
    $activa = 1;
    conexion::abrir_conexion();
    $url = repositorioEntrada::crearUrl(purifier::purifier($_POST['titulo'], 'titulo'));
    $validador = new validadorEntradaEditada($_POST['titulo'], $_POST['entrada'], $url, $_SESSION['entradaPrevia'], conexion::obtener_conexion());
    if (isset($_POST['activa'])) { $activa = 0; }
    if ($validador->entrada_valida()) {
        $entrada = new entrada(null, '', $_SESSION['id_usuario'], $url, htmlentities($validador->getTitulo(), ENT_QUOTES, 'UTF-8', true), $validador->getTexto(), null, $activa, 0);
        $entrada_insertada = repositorioEntrada::actualizar_entrada(conexion::obtener_conexion(), $entrada, $_SESSION['entradaPrevia']);
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
require_once ROOT . 'plantillas/pc_declare.inc.php';
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
                $entrada = repositorioEntrada::getEntrada(conexion::obtener_conexion(), $idEntrada);
                $_SESSION['entradaPrevia'] = $entrada;
                require_once ROOT . 'plantillas/form_editar_entrada.inc.php';
                conexion::cerrar_conexion();
            } else if (isset($_POST['submit'])) {
                require_once ROOT . 'plantillas/form_editar_entrada_validado.inc.php';
            }
            ?>
        </form>
    </div>
</div>
<?php
require_once ROOT . 'plantillas/pc_closing.inc.php';
require_once ROOT . 'plantillas/documento-cierre.inc.php';
?>