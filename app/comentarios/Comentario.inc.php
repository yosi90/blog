<?php
class comentario 
{
    private $idComentario;
    private $autor;
    private $idAutor;
    private $tituloEntrada;
    private $idEntrada;
    private $urlEntrada;
    private $texto;
    private $fecha;
    private $index;

    public function __CONSTRUCT($idComentario, $autor, $idAutor, $tituloEntrada, $idEntrada, $urlEntrada, $texto, $fecha, $index) 
    {
        $this->idComentario = $idComentario;
        $this->idAutor = $idAutor;
        $this->autor = $autor;
        $this->tituloEntrada = $tituloEntrada;
        $this->idEntrada = $idEntrada;
        $this->urlEntrada = $urlEntrada;
        $this->texto = $texto;
        $this->fecha = $fecha;
        $this->index = $index;
    }

    public function getArray()
    {
        return [
            'idComentario' => $this-> idComentario,
            'idAutor' => $this-> idAutor,
            'autor' => $this-> autor,
            'tituloEntrada' => $this-> tituloEntrada,
            'idEntrada' => $this-> idEntrada,
            'urlEntrada' => $this-> urlEntrada,
            'texto' => $this-> texto,
            'fecha' => $this-> fecha,
            'indice' => $this-> index
        ];
    }

    public function getId() { return $this->idComentario; }

    public function getAutor() { return $this->autor; }

    public function getIdAutor() { return $this->idAutor; }

    public function getTituloEntrada() { return $this->tituloEntrada; }

    public function getId_entrada() { return $this->idEntrada; }

    public function getUrl_entrada() { return $this->urlEntrada; }

    public function getTexto() { return $this->texto; }
    public function setTexto($texto) { $this->texto = $texto; }

    public function getFecha() { return $this->fecha; }

    public function getIndex() { return $this->index; }
}
