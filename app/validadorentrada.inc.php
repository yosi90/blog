<?php
include_once 'repositorioentrada.inc.php';
class validadorentrada
{
    private $aviso_inicio;
    private $aviso_cierre;
    private $titulo;
    private $texto;
    private $error_titulo;
    private $error_texto;
    
    public function __construct($titulo, $texto, $conexion)
    {
        $this -> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this -> aviso_cierre = "</div>";
        
        $this-> titulo = "";
        $this-> url = "";
        $this-> texto = "";
        $this -> error_titulo = $this->validar_titulo($conexion, $titulo);
        $this -> error_texto = $this->validar_texto($conexion, $texto);
    }
    private function variable_iniciada($variable)
    {
        if(isset($variable) && !empty($variable))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    private function validar_titulo ($conexion, $titulo)
    {
        if(!$this->variable_iniciada($titulo))
        {
            return "Debes escribir un título";
        }
        else if(strlen($titulo) > 255)
        {
            return "El titulo no puede tener mas de 255 caracteres";
        }
        else if(repositorioentrada::titulo_existe($conexion, $titulo))
        {
            return "Titulo ya usado";
        }
        else
        {
            $this -> titulo = $titulo;
        }
    }
    private function validar_texto ($conexion, $texto)
    {
        if(!$this->variable_iniciada($texto))
        {
            return "Debes escribir algo de texto";
        }
        else
        {
            $this -> titulo = $texto;
        }
        
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getTexto()
    {
        return $this->texto;
    }
    public function mostrar_titulo()
    {
        if($this->titulo != "")
        {
            echo 'value = "' . $this->titulo . '"';
        }
    }
    public function mostrar_texto()
    {
        if($this->texto != "" && strlen(trim($this->texto)) > 0)
        {
            echo $this -> texto;
        }
    }
    public function mostrar_error_titulo ()
    {
        if($this->error_titulo != "")
        {
            echo $this -> aviso_inicio . $this ->error_titulo . $this -> aviso_cierre;
        }
    }
    public function mostrar_error_texto ()
    {
        if($this->error_texto != "")
        {
            echo $this -> aviso_inicio . $this ->error_texto . $this -> aviso_cierre;
        }
    }
    public function entrada_valida()
    {
        if($this -> error_titulo == "" && $this->error_texto == "")
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
}