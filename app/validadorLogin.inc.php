<?php
include_once 'RepositorioUsuario.inc.php';
include_once 'usuario.inc.php';

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
            } else if (!is_null($this->usuario) && $this->usuario->getActivo() == 0)
                $this->error = 'La cuenta aun no ha sido activada<form class="d-flex flex-row flex-wrap w-100" role="form" method="post" action="' . RUTA_REGISTRO_CORRECTO . '">
                <button type="submit" name="enviar" id="enviar" class="btn btn-dark form-control mt-3">Reenviar correo de verificación</button></form>';
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
