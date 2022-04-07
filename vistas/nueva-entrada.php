<?php

use phpDocumentor\Reflection\PseudoTypes\HtmlEscapedString;

$titulo = 'Nueva entrada';
require_once ROOT . 'plantillas/documento-declaracion.inc.php';
require_once ROOT . 'app/entradas/Entrada.inc.php';
require_once ROOT . 'app/entradas/RepositorioEntrada.inc.php';
require_once ROOT . 'app/validadorEntradaNueva.inc.php';
require_once ROOT . 'app/usuarios/RepositorioUsuario.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
if (isset($_POST['submit'])) {
    $activa = 1;
    conexion::abrir_conexion();
    $url = Repositorioentrada::crearUrl(purifier::purifier($_POST['titulo'], 'titulo'));
    if (isset($_POST['activa'])){ $activa = 0; }
    $validador = new validadorEntradaNueva($_POST['titulo'], $_POST['entrada'], $url, conexion::obtener_conexion());
    if ($validador->entrada_valida()) {
        if (repositorioentrada::insertar_entrada(conexion::obtener_conexion(), $url, htmlentities($validador->getTitulo(), ENT_QUOTES, 'UTF-8', true), $validador->getTexto(), $activa, 0, 0, $_SESSION['id_usuario'])) {
            ?>
                <script> window.location.href = "<?php echo RUTA_ENTRADA . '/' . $url ?>" </script>
            <?php
        }
    }
    conexion::cerrar_conexion();
}
require_once ROOT . 'plantillas/pc_declare.inc.php';
?>
<div class="card mt-5">
    <div class="card-header bg-dark text-white">
        <h1 class="text-center"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Nueva entrada</h1>
    </div>
    <div class="card-body bg-dark-light text-white">
        <form class="d-flex flex-row flex-wrap" method="POST" action="<?php echo RUTA_NUEVA_ENTRADA; ?>">
            <?php
            if (isset($_POST['submit'])) {
                require_once ROOT . 'plantillas/form_nueva_entrada_validado.inc.php';
            } else {
                require_once ROOT . 'plantillas/form_nueva_entrada_vacio.inc.php';
            }
            ?>
        </form>
    </div>
</div>
<?php
require_once ROOT . 'plantillas/pc_closing.inc.php';
require_once ROOT . 'plantillas/documento-cierre.inc.php';
