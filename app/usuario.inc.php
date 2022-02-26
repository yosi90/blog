<?php
class Usuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fecha_registro;
    private $activo;
    

    public function getId() {
        return $this -> id;
    }

    public function getNombre() {  /*Tengo que controlar que no se cause un overflow y que no se inyecte código sql*/
        return $this -> nombre;
    }
    public function setNombre($nombre) {
        $this-> nombre = $nombre;
    }

    public function getEmail() {
        return $this-> email;
    }
    public function setEmail($email) {
        $this -> email = $email;
    }

    public function getPassword() {
        return $this-> password;
    }
    public function setPassword($password) {
        $this -> password = $password;
    }

    public function getFecha_ingreso() {
        return $this-> fecha_registro;
    }

    public function getActivo() {
        return $this-> activo;
    }
    public function setActivo($activo) {
        $this-> activo = $activo;
    }


    public function __construct($id, $nombre, $email, $password, $fecha_registro, $activo) {
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> email = $email;
        $this -> password = $password;
        $this -> fecha_registro = $fecha_registro;
        $this -> activo = $activo;
    }
}