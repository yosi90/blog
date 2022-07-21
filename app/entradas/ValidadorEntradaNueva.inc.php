<?php
require_once ROOT . 'app/entradas/repositorioentrada.inc.php';
require_once ROOT . 'app/entradas/validadorEntrada.inc.php';
class validadorEntradaNueva extends validadorEntrada
{
    public function __construct($titulo, $texto, $url, $conexion)
    {
        $this->error_titulo = $this->validar_titulo($conexion, $titulo, $url);
        $this->error_texto = $this->validar_texto($texto);
    }

    private function validar_titulo($conexion, $titulo, $url)
    {
        $this->titulo = $titulo;
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir un título";
        } else if (strlen($titulo) > 80) {
            return "El titulo no puede tener mas de 80 caracteres";
        } else if (repositorioentrada::titulo_existe($conexion, $titulo)) {
            return "Titulo ya usado";
        }else if (repositorioentrada::urlCoincide($conexion, $url)) {
            return "Este titulo provocaría una url duplicada";
        }
    }
}