<?php
include_once 'comentario.inc.php';
include_once 'RepositorioComentarios.inc.php';
include_once 'Conexion.inc.php';

class escritorComentarios
{
    public static function comentariosFiltrados($comentarios)
    {
        self::escribirComentarios($comentarios);
    }

    public static function escribirComentarios($comentarios)
    {
        if (count($comentarios)) {
            foreach ($comentarios as $comentario) {
                if (!isset($comentario))
                    return;
?>
                <div class="card flex-fill controlTamaño m-1 mw-100">
                    <div class="card-header d-flex bg-secondary text-white h-100">
                        <form class="d-flex flex-fill" method="POST" action="<?php echo RUTA_ENTRADA . '/' . $comentario->getUrl_entrada() ?>">
                            <input type="submit" class="btn btn-outline-light form-control fz-sm-texto flex-fill" role="button" value="
                            <?php echo '#' . $comentario->getIndex() . ' en la entrada ' . $comentario->getTituloEntrada() ?>">
                        </form>
                    </div>
                </div>
<?php
            }
        }
    }
}
?>