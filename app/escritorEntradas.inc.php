<?php
include_once 'entrada.inc.php';
include_once 'RepositorioEntrada.inc.php';
include_once 'Conexion.inc.php';

class escritorEntradas
{
    public static function entradasRecientes()
    {
        $entradas = repositorioEntrada::obtenerRecientes(Conexion::obtener_conexion());
        return json_encode($entradas);
    }

    public static function entradasFiltradas($entradas) { return json_encode($entradas); }
}
