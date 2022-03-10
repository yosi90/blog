<?php
$titulo = "Favoritos";

if (!controlsesion::sesion_iniciada()) { redireccion::redirigir(SERVIDOR); }

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
