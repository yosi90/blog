<?php
require_once ROOT . 'app/usuarios/Controlsesion.inc.php';
require_once ROOT . 'config/Redireccion.inc.php';
require_once ROOT . 'config/Config.inc.php';

controlsesion::cerrar_sesion();
redireccion::redirigir(SERVIDOR);