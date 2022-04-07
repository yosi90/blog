<?php
require_once ROOT . 'config/Config.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/entradas/RepositorioEntrada.inc.php';
require_once ROOT . 'config/Redireccion.inc.php';
if (isset($_POST['archive']) && $_SESSION['id_usuario'] == $_POST['IdAutor']) {
    $idEntrada = $_POST['IdEntrada'];
    conexion::abrir_conexion();
    if (Repositorioentrada::archivarEntrada(conexion::obtener_conexion(), $_POST['IdEntrada'], $_POST['archivo'])) {
?>
        <script>alert("Algo ha salido mal");</script>
<?php
    }
    conexion::cerrar_conexion();
}
redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
?>