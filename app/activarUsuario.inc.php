<?php
class activarUsuario{
    private $id_url;
    private $id_usuario;
    private $url;
    private $fecha;

    public function __construct($id_url, $id_usuario, $url, $fecha)
    {
        $this->id_url = $id_url;
        $this->id_usuario = $id_usuario;
        $this->url = $url;
        $this->fecha = $fecha;
    }

    public function getIdUrl() { return $this->id_url; }
    public function getIdUsr() { return $this->id_usuario; }
    public function getUrl() { return $this->url; }
}
