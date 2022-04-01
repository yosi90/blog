<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/redireccion.inc.php';
if(isset($_POST['delete']) && $_SESSION['id_usuario'] == $_POST['IdAutor']){
    conexion::abrir_conexion();
    Repositorioentrada::DeleteEntrada(conexion::obtener_conexion(), $_POST['IdEntrada']);
    conexion::cerrar_conexion();
}
redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
?>