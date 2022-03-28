<?php
header('content-type', 'application/json');
$usuario = $_REQUEST['usuario'];
$usuario = array("mod" => $_SESSION['moderador'], "adm" => $_SESSION['administrador']);
echo json_encode($usuario) ?? 'empty';