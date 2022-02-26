<?php
include_once 'RepositorioUsuario.inc.php';

class validador
{
    private $aviso_inicio;
    private $aviso_cierre;
    private $nombre;
    private $email;
    private $clave;
    private $error_nombre;
    private $error_email;
    private $error_clave1;
    private $error_clave2;
    
    public function __construct($nombre, $email, $clave1, $clave2, $conexion)
    {
        $this-> aviso_inicio = "<br><div class='alert alert-danger' role='alert'>";
        $this-> aviso_cierre = "</div>";
        $this -> nombre = "";
        $this-> email = "";
        $this-> clave = "";
        $this-> error_nombre = $this-> validar_nombre($conexion, $nombre);
        $this-> error_email = $this-> validar_email($conexion, $email);
        $this-> error_clave1 = $this-> validar_clave1($clave1);
        $this-> error_clave2 = $this-> validar_clave2($clave1, $clave2);
        
        if($this-> error_clave1 === "" && $this-> error_clave2 === "")
        {
            $this-> clave = $clave1;
        }
    }
    private function variable_iniciada ($var)
    {
        if(isset($var) && !empty($var))
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
    private function validar_nombre($conexion, $nombre) 
    {
        if(!$this-> variable_iniciada($nombre))
        {
            return "Debes escribir un nombre de usuario";
        }
        else
        {
            $this-> nombre = $nombre;
        }
        if(strlen($nombre) < 4)
        {
            return "Nombre demasiado corto, mínimo 6 caracteres";
        }
        else if(strlen($nombre) > 24)
        {
            return "Nombre demasiado largo, máximo 24 caracteres";
        }
        else if (RepositorioUsuario :: nombre_existe($conexion, $nombre))
        {
            return "Nombre de usuario ya usado";
        }
        else 
        {
            return "";
        }
    }
    private function validar_email($conexion, $email) 
    {
        if(!$this-> variable_iniciada($email))
        {
            return "Debes escribir un email";
        }
        else
        {
            $this-> email = $email;
        }
        if (RepositorioUsuario :: email_existe($conexion, $email))
        {
            return "Correo electrónico ya usado <a href='#'>¿Recuperar cuenta?</a>";
        }
        return "";
    }
    
    private function validar_clave1($clave1) 
    {
        if(!$this-> variable_iniciada($clave1))
        {
            return "Debes escribir una contraseña";
        }
        else
        {
            return "";
        }
    }
    private function validar_clave2($clave1, $clave2) 
    {
        if(!$this-> variable_iniciada($clave2) || $clave1 != $clave2)
        {
            if($clave2 === "")
            {
                return "Debes reescribir una contraseña";
            }
            else 
            {
                return "Las contraseñas deben ser iguales";
            }
        }
        else
        {
            return "";
        }
    }
    public function obtener_nombre()
    {
        return $this-> nombre;
    }
    public function obtener_email()
    {
        return $this-> email;
    }
    public function  obtener_clave()
    {
        return $this-> clave;
    }
    public function obtener_error_nombre()
    {
        return error_nombre;
    }
    public function obtener_error_email()
    {
        return error_email;
    }
    public function obtener_error_clave1()
    {
        return error_clave1;
    }
    public function obtener_error_clave2()
    {
        return error_clave2;
    }
    public function mostrar_nombre()
    {
        if($this -> nombre !== "")
        {
            echo 'value="'.$this-> nombre . '"';
        }
    }

    public function mostrar_email()
    {
        if($this -> email !== "")
        {
            echo 'value="'.$this-> email . '"';
        }
    }
    
    public function mostrar_error_nombre()
    {
        if($this -> error_nombre !== "")
        {
            echo $this -> aviso_inicio .$this-> error_nombre . $this-> aviso_cierre;
        }
    }
    
    public function mostrar_error_email()
    {
        if($this -> error_email !== "")
        {
            echo $this -> aviso_inicio .$this-> error_email . $this-> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave1()
    {
        if($this -> error_clave1 !== "")
        {
            echo $this -> aviso_inicio .$this-> error_clave1 . $this-> aviso_cierre;
        }
    }
    
    public function mostrar_error_clave2()
    {
        if($this -> error_clave2 !== "")
        {
            echo $this -> aviso_inicio .$this-> error_clave2 . $this-> aviso_cierre;
        }
    }
    
    public function registro_valido()
    {
        if($this-> error_nombre === "" && $this-> error_email === "" && $this-> error_clave1 === "" && $this-> error_clave2 === "")
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
