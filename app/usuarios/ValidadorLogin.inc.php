<?php
require_once ROOT . 'app/usuarios/RepositorioUsuario.inc.php';
require_once ROOT . 'app/usuarios/Usuario.inc.php';

class validadorlogin
{
    private $usuario;
    private $error;
    public function __construct($email, $clave, $conexion)
    {
        $this->error = "";
        if (!$this->variable_iniciada($email) || !$this->variable_iniciada($clave)) {
            $this->usuario = null;
            $this->error = "Completa los campos";
        } else {
            $this->usuario = RepositorioUsuario::obtener_usuario_email($conexion, $email);
            if (is_null($this->usuario) || !password_verify($clave, $this->usuario->getPassword())) {
                $this->error = "Datos de inicio erroneos";
            }
        }
    }

    private function variable_iniciada($var)
    {
        if (isset($var) && !empty($var)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtener_usuario() { return $this->usuario; }

    public function obtener_error() { return $this->error; }

    public function mostrar_error()
    {
        if ($this->error !== '') {
            echo "<div class='alert alert-danger mt-1 w-100' role='alert'>";
            echo $this->error;
            echo "</div>";
        }
    }
}
