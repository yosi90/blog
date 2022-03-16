<?php
class comentario 
{
    private $id_comentario;
    private $id_autor;
    private $id_entrada;
    private $texto;
    private $fecha;

    public function __CONSTRUCT($id_comentario, $id_autor, $id_entrada, $texto, $fecha) 
    {
        $this->id_comentario = $id_comentario;
        $this->id_autor = $id_autor;
        $this->id_entrada = $id_entrada;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }

    public function getId() { return $this->id_comentario; }
    public function getAutor() { return $this->id_autor; }
    public function getId_entrada() { return $this->id_entrada; }
    public function getTexto() { return $this->texto; }
    public function getFecha() { return $this->fecha; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setTexto($texto) { $this->texto = $texto; }
}
