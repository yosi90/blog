<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/redireccion.inc.php';
if (isset($_POST['toggle']) && $_SESSION['id_usuario'] == $_POST['IdAutor']) {
    $idEntrada = $_POST['IdEntrada'];
    conexion::abrir_conexion();
    if (!Repositorioentrada::activarEntrada(conexion::obtener_conexion(), $_POST['IdEntrada'], $_POST['activo'])) {
?>
        <script>alert("Algo ha salido mal");</script>
<?php
    }
    conexion::cerrar_conexion();
}
redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
?>