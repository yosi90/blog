<?php
class entrada
{
    private $id_entrada;
    private $autor;
    private $id_autor;
    private $url;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;
    private $archivada;
    private $bloqueada;
    private $cantComentarios;
    
    public function __construct($id_entrada, $autor, $id_autor, $url, $titulo, $texto, $fecha, $activa, $archivada = 0, $bloqueada = 0, $comentarios = 0)
    {
        $this-> id_entrada = $id_entrada;
        $this-> autor = $autor;
        $this-> id_autor = $id_autor;
        $this-> url = $url;
        $this-> titulo = $titulo;
        $this-> texto = $texto;
        $this-> fecha = $fecha;
        $this-> activa = $activa;
        $this-> archivada = $archivada;
        $this-> bloqueada = $bloqueada;
        $this-> cantComentarios = $comentarios;
    }

    public function getArray()
    {
        return [
            'id_entrada' => $this-> id_entrada,
            'autor' => $this-> autor,
            'id_autor' => $this-> id_autor,
            'url' => $this-> url,
            'titulo' => $this-> titulo,
            'texto' => $this-> texto,
            'fecha' => $this-> fecha,
            'activa' => $this-> activa,
            'archivada' => $this-> archivada,
            'bloqueada' => $this-> bloqueada,
            'cantComentarios' => $this-> cantComentarios
        ];
    }

    public function getId_entrada() { return $this->id_entrada; }

    public function getAutor() { return $this->autor; }

    public function getIdAutor() { return $this->id_autor; }

    public function getUrl() { return $this->url; }

    public function getTitulo() { return $this->titulo; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }

    public function getTexto() { return $this->texto; }
    public function setTexto($texto) { $this->texto = $texto; }

    public function getFecha() { return $this->fecha; }

    public function getActiva() { return $this->activa; }
    public function setActiva ($activa) { $this->activa = $activa; }

    public function getArchivada() { return $this->archivada; }
    public function setArchivada($archivada) { $this->archivada = $archivada; }

    public function getBloqueada() { return $this->bloqueada; }
    public function setBloqueada($bloqueada) { $this->bloqueada = $bloqueada; }

    public function getCantComentarios() { return $this->cantComentarios; }
}