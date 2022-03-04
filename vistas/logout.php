<?php
include_once '../app/controlsesion.inc.php';
include_once '../app/redireccion.inc.php';
include_once '../app/config.inc.php';

controlsesion::cerrar_sesion();
redireccion::redirigir(SERVIDOR);