<?php
require_once ROOT . 'config/Config.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/entradas/RepositorioEntrada.inc.php';
require_once ROOT . 'config/Redireccion.inc.php';
if(isset($_POST['delete']) && $_SESSION['id_usuario'] == $_POST['IdAutor']){
    conexion::abrir_conexion();
    Repositorioentrada::DeleteEntrada(conexion::obtener_conexion(), $_POST['IdEntrada']);
    conexion::cerrar_conexion();
}
redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
?>