<?php
class recuperarPassword{
    private $id_url;
    private $id_usuario;
    private $url;
    private $fecha;
    private $intentos;

    public function __construct($id_url, $id_usuario, $url, $fecha, $intentos)
    {
        $this->id_url = $id_url;
        $this->id_usuario = $id_usuario;
        $this->url = $url;
        $this->fecha = $fecha;
        $this->intentos = $intentos;
    }

    public function getIdUrl() { return $this->id_url; }
    public function getIdUsr() { return $this->id_usuario; }
    public function getUrl() { return $this->url; }
    public function getIntentos() { return $this->intentos; }
}
