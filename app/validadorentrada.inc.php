<?php
include_once 'repositorioentrada.inc.php';
class validadorentrada
{
    private $aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
    private $aviso_cierre = "</div>";
    private $titulo = "";
    private $url = "";
    private $texto = "";
    private $error_titulo;
    private $error_texto;

    public function __construct($titulo, $texto, $conexion)
    {
        $this->error_titulo = $this->validar_titulo($conexion, $titulo);
        $this->error_texto = $this->validar_texto($texto);
    }

    private function variable_iniciada($variable)
    {
        if (isset($variable) && !empty($variable)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function validar_titulo($conexion, $titulo)
    {
        if (!$this->variable_iniciada($titulo)) {
            return "Debes escribir un título";
        } else if (strlen($titulo) > 40) {
            return "El titulo no puede tener mas de 40 caracteres";
        } else if (repositorioentrada::titulo_existe($conexion, $titulo)) {
            return "Titulo ya usado";
        } else {
            $this->titulo = $titulo;
        }
    }

    private function validar_texto($texto)
    {
        if (!$this->variable_iniciada($texto)) {
            return "Debes escribir algo de texto";
        } else if(strlen($texto) < 20){
            return "Entrada demasiado corta";
        } else {
            $this->texto = $texto;
        }
    }

    public function getTitulo() { return $this->titulo; }
    public function getTexto() { return $this->texto; }

    public function mostrar_titulo()
    {
        if ($this->titulo != "") {
            echo 'value = "' . $this->titulo . '"';
        }
    }

    public function mostrar_texto()
    {
        if ($this->texto != "" && strlen(trim($this->texto)) > 0) {
            echo $this->texto;
        }
    }

    public function mostrar_error_titulo()
    {
        if ($this->error_titulo != "") {
            echo $this->aviso_inicio . $this->error_titulo . $this->aviso_cierre;
        }
    }

    public function mostrar_error_texto()
    {
        if ($this->error_texto != "") {
            echo $this->aviso_inicio . $this->error_texto . $this->aviso_cierre;
        }
    }

    public function entrada_valida()
    {
        if ($this->error_titulo == "" && $this->error_texto == "") {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
