<?php
class comentario 
{
    private $id;
    private $id_autor;
    private $id_entrada;
    private $titulo;
    private $texto;
    private $fecha;

    public function __CONSTRUCT($id, $id_autor, $id_entrada, $titulo, $texto, $fecha) 
    {
        $this->id = $id;
        $this->id_autor = $id_autor;
        $this->id_entrada = $id_entrada;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha = $fecha;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getId_autor()
    {
        return $this->id_autor;
    }
    public function getId_entrada()
    {
        return $this->id_entrada;
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
    public function cambiar_titulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function cambiar_texto($texto)
    {
        $this->texto = $texto;
    }
}
