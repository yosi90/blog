<?php
include_once 'repositorioentrada.inc.php';
include_once 'validadorEntrada.inc.php';
class validadorEntradaEditada extends validadorEntrada
{
    public function __construct($titulo, $texto, $url, $entradaPrevia, $conexion)
    {
        $this->error_titulo = $this->validar_titulo($conexion, $titulo, $url, $entradaPrevia->getTitulo());
        $this->error_texto = $this->validar_texto($texto);
    }

    private function validar_titulo($conexion, $titulo, $url, $tituloPrevio)//verificar que al hacer un return la ejecución de la función finaliza en el y no sigue hasta el final.
    {
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir un título";
        } else if (strlen($titulo) > 80) {
            return "El titulo no puede tener mas de 80 caracteres";
        } else if ($titulo != $tituloPrevio) {
            if (repositorioentrada::titulo_existe($conexion, $titulo)) {
                return "Titulo ya usado";
            } else if (repositorioentrada::urlCoincide($conexion, $url)) {
                return "Este titulo provocaría una url duplicada";
            }
        } 
        $this->titulo = $titulo;
    }
}