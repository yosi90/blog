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
                <div class="card flex-fill sizeControl m-1 mw-100">
                    <div class="card-header d-flex bg-secondary text-white h-100">
                        <form class="d-flex flex-fill" method="POST" action="<?php echo RUTA_ENTRADA . '/' . $comentario->getUrl_entrada() ?>">
                            <strong class="d-flex flex-fill">
                                <input type="submit" name="busqueda" class="btn btn-outline-light form-control fz-sm-texto d-flex flex-fill align-items-center justify-content-center" role="button" value="
                            <?php echo '#' . ($comentario->getIndex() + 1) . ' en la entrada ' . $comentario->getTituloEntrada() ?>">
                            </strong>
                            <p class="flex-fill align-self-end text-end fz-texto m-0 pt-1"><?php echo date('d/M/Y', strtotime($comentario->getFecha())); ?></p>
                            <input type="hidden" name="posicion" value="<?php echo 'comentario' . ($comentario->getIndex() + 1) ?>">
                        </form>
                    </div>
                </div>
<?php
            }
        }
    }
}
?>