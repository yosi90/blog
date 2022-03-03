<?php
class Usuario {
    private $id_usuario;
    private $nombre;
    private $correo;
    private $password;
    private $registro;
    private $activo;
    

    public function getId() {
        return $this -> id_usuario;
    }

    public function getNombre() {  /*Tengo que controlar que no se cause un overflow y que no se inyecte código sql*/
        return $this -> nombre;
    }
    public function setNombre($nombre) {
        $this-> nombre = $nombre;
    }

    public function getEmail() {
        return $this-> correo;
    }
    public function setEmail($correo) {
        $this -> correo = $correo;
    }

    public function getPassword() {
        return $this-> password;
    }
    public function setPassword($password) {
        $this -> password = $password;
    }

    public function getFecha_ingreso() {
        return $this-> registro;
    }

    public function getActivo() {
        return $this-> activo;
    }
    public function setActivo($activo) {
        $this-> activo = $activo;
    }


    public function __construct($id_usuario, $nombre, $correo, $password, $registro, $activo) {
        $this -> id_usuario = $id_usuario;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> password = $password;
        $this -> registro = $registro;
        $this -> activo = $activo;
    }
}