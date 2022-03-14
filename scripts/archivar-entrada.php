<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/redireccion.inc.php';
if(isset($_POST['archive']) && $_SESSION['id_usuario'] == $_POST['IdAutor']){
    $idEntrada = $_POST['IdEntrada'];
    conexion::abrir_conexion();
    Repositorioentrada::archivarEntrada(conexion::obtener_conexion(), $_POST['IdEntrada'], $_POST['archivo']);
    conexion::cerrar_conexion();
}
redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
?>