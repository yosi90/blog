<?php
include_once 'usuario.inc.php';
include_once 'RepositorioUsuario.inc.php';
include_once 'Conexion.inc.php';

class escritorUsuarios
{
    public static function usuariosFiltrados($usuarios) { self::escribirUsuarios($usuarios); }

    public static function escribirUsuarios($usuarios)
    {
        if (count($usuarios)) {
            foreach ($usuarios as $usuario) {
                if (!isset($usuario)) {
                    return;
                }
?>
                <div class="card flex-fill controlTamaño m-1 mw-100">
                    <div class="card-header d-flex bg-secondary text-white h-100">
                        <a class="btn btn-outline-light fz-sm-texto flex-fill" role="button" href="<?php echo RUTA_AUTORES . '/' . $usuario->getNombre() ?>">
                            <div class="d-flex flex-wrap">
                                <strong class="flex-fill text-start fz-subtitulo lt-2"><?php echo $usuario->getNombre(); ?></strong>
                                <p class="flex-fill align-self-end text-end fz-texto m-0 pt-1"><?php echo $usuario->getTotalEntradas(); ?>&nbsp;<i class="far fa-clipboard"></i>&nbsp;&nbsp;&nbsp;<?php echo $usuario->getTotalComentarios(); ?>&nbsp;<i class="fas fa-comments"></i></p>
                            </div>
                        </a>
                    </div>
                </div>
<?php
            }
        }
    }
}
?>