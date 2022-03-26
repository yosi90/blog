<?php
class Usuario {
    private $id_usuario;
    private $nombre;
    private $correo;
    private $password;
    private $registro;
    private $activo;
    private $moderador;
    private $administrador;
    private $totalEntradas;
    private $totalComentarios;

    public function __construct($id_usuario, $nombre, $correo, $password, $registro, $activo, $moderador, $administrador) {
        $this -> id_usuario = $id_usuario;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> password = $password;
        $this -> registro = $registro;
        $this -> activo = $activo;
        $this -> moderador = $moderador;
        $this -> administrador = $administrador;
    }

    public function getArray()
    {
        return [
            'idUsuario' => $this-> id_usuario,
            'nombre' => $this-> nombre,
            'registro' => $this-> registro,
            'entradas' => $this-> totalEntradas,
            'comentarios' => $this-> totalComentarios
        ];
    }
    
    public function getId() { return $this -> id_usuario; }

    public function getNombre() { return $this -> nombre; }
    public function setNombre($nombre) { $this-> nombre = $nombre; }

    public function getEmail() { return $this-> correo; }
    public function setEmail($correo) { $this -> correo = $correo; }

    public function getPassword() { return $this-> password; }

    public function getFecha_ingreso() { return $this-> registro; }

    public function getActivo() { return $this-> activo; }
    public function setActivo($activo) { $this-> activo = $activo; }

    public function getMod() { return $this-> moderador; }

    public function getAdm() { return $this-> administrador; }

    public function getTotalEntradas() { return $this-> totalEntradas; }
    public function setTotalEntradas($total) { $this-> totalEntradas = $total; }

    public function getTotalComentarios() { return $this-> totalComentarios; }
    public function setTotalComentarios($total) { $this-> totalComentarios = $total; }


}