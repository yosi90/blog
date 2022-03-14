<?php
include_once 'RepositorioUsuario.inc.php';

class validadorActPass
{
    private $avisoInicio = "<br><div class='alert alert-danger' role='alert'>";
    private $avisoCierre = "</div>";
    private $errorClave1;
    private $errorClave2;
    private $clave;

    public function __construct($clave1, $clave2)
    {
        $this->errorClave1 = $this->validarClave1($clave1);
        $this->errorClave2 = $this->validarClave2($clave1, $clave2);
        if ($this->errorClave1 === "" && $this->errorClave2 === "")
            $this->clave = $clave1;
    }

    private function CampoVacio($vacio)
    {
        if (isset($vacio) && !empty($vacio))
            return true;
        return false;
    }

    private function validarClave1($clave1)
    {
        if (!$this->CampoVacio($clave1))
            return "Debes escribir una contraseña";
        return "";
    }

    private function validarClave2($clave1, $clave2)
    {
        if (!$this->CampoVacio($clave2) || $clave1 != $clave2) {
            if ($clave2 === "") {
                return "Debes confirmar la contraseña";
            } else {
                return "Las contraseñas no coinciden";
            }
        }
        return "";
    }

    public function getErrorClave1() { return $this->errorClave1; }
    public function getErrorClave2() { return $this->errorClave2; }
    public function getClave() { return $this->clave; }

    public function insertErrorClave1() { if ($this->errorClave1 !== "") echo $this->avisoInicio . $this->errorClave1 . $this->avisoCierre; }
    public function insertErrorClave2() { if ($this->errorClave2 !== "") echo $this->avisoInicio . $this->errorClave2 . $this->avisoCierre; }

    public function registroValido()
    {
        if ($this->errorClave1 === "" && $this->errorClave2 === "")
            return true;
        return false;
    }
}
