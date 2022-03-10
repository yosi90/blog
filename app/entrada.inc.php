<?php
class entrada
{
    private $id_entrada;
    private $id_autor;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;
    
    public function __construct($id_entrada, $id_autor, $url, $titulo, $texto, $fecha, $activa)
    {
        $this-> id_entrada = $id_entrada;
        $this-> id_autor = $id_autor;
        $this-> url = $url;
        $this-> titulo = $titulo;
        $this-> texto = $texto;
        $this-> fecha = $fecha;
        $this-> activa = $activa;
    }

    public function getId_entrada() { return $this->id_entrada; }
    public function getAutor() { return $this->id_autor; }
    public function getUrl() { return $this->url; }
    public function getTitulo() { return $this->titulo; }
    public function getTexto() { return $this->texto; }
    public function getFecha() { return $this->fecha; }
    public function getActiva() { return $this->activa; }
    public function setUrl($url) { $this->url = $url; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setTexto($texto) { $this->texto = $texto; }
    public function setActiva ($activa) { $this->activa = $activa; }
}