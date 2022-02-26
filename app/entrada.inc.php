<?php
class entrada
{
    private $id;
    private $id_autor;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;
    public function __CONSTRUCT($id, $id_autor, $url, $titulo, $texto, $fecha, $activa)
    {
        $this-> id = $id;
        $this-> id_autor = $id_autor;
        $this-> url = $url;
        $this-> titulo = $titulo;
        $this-> texto = $texto;
        $this-> fecha = $fecha;
        $this-> activa = $activa;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getId_autor()
    {
        return $this->id_autor;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getTexto()
    {
        return $this->texto;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getActiva()
    {
        return $this->activa;
    }
    public function cambiar_url($url)
    {
        $this->url = $url;
    }
    public function cambiar_titulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function cambiar_texto($texto)
    {
        $this->texto = $texto;
    }
    public function cambiar_activa ($activa)
    {
        $this->activa = $activa;
    }
}