<?php
include_once 'repositorioentrada.inc.php';
abstract class validadorEntrada
{
    protected $aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
    protected $aviso_cierre = "</div>";
    protected $titulo = "";
    protected $texto = "";
    protected $error_titulo;
    protected $error_texto;

    public function __construct() { }

    protected function variable_iniciada($variable)
    {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    protected function validar_texto($texto)
    {
        $this->texto = $texto;
        if (!$this->variable_iniciada($texto)) {
            return "Este campo es obligatorio";
        } else if (strlen($texto) < 20) {
            return "Entrada demasiado corta";
        }
    }

    public function getTitulo() { return $this->titulo; }
    public function getTexto() { return $this->texto; }

    public function mostrar_titulo()
    {
        if ($this->titulo != "")
            echo $this->titulo;
    }

    public function mostrar_texto()
    {
        if ($this->texto != "" && strlen(trim($this->texto)) > 0)
            echo $this->texto;
    }

    public function mostrar_error_titulo()
    {
        if ($this->error_titulo != "")
            echo $this->aviso_inicio . $this->error_titulo . $this->aviso_cierre;
    }

    public function mostrar_error_texto()
    {
        if ($this->error_texto != "")
            echo $this->aviso_inicio . $this->error_texto . $this->aviso_cierre;
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
