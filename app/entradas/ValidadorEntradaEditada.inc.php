<?php
require_once ROOT . 'repositorioentrada.inc.php';
require_once ROOT . 'validadorEntrada.inc.php';
class validadorEntradaEditada extends validadorEntrada
{
    public function __construct($titulo, $texto, $url, $entradaPrevia, $conexion)
    {
        $this->error_titulo = $this->validar_titulo($conexion, $titulo, $url, $entradaPrevia->getTitulo());
        $this->error_texto = $this->validar_texto($texto);
    }

    private function validar_titulo($conexion, $titulo, $url, $tituloPrevio)
    {
        $this->titulo = $titulo;
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir un título";
        } else if (strlen($titulo) > 80) {
            return "El título no puede tener mas de 80 caracteres";
        } else if ($titulo != $tituloPrevio) {
            if (repositorioentrada::titulo_existe($conexion, $titulo)) {
                return "Título ya usado";
            } else if (repositorioentrada::urlCoincide($conexion, $url)) {
                return "Este título provocaría una url duplicada";
            }
        } 
    }
}