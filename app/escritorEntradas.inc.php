<?php
include_once 'entrada.inc.php';
include_once 'RepositorioEntrada.inc.php';
include_once 'Conexion.inc.php';

class EscritorEntradas
{
    public static function escribirListaEntradas()
    {
        $entradas = RepositorioEntrada::obtener_fecha_desc(Conexion::obtener_conexion());
        if (count($entradas)) {
            foreach ($entradas as $entrada) {
                self::escribirEntradaLista($entrada);
            }
        }
    }

    public static function escribirEntradaLista($entrada)
    {
        if (!isset($entrada)) {
            return;
        }
?>
        <div class="card flex-fill controlTamaño m-1 mw-100">
            <div class="card-header d-flex bg-secondary text-white h-100">
                <a class="btn btn-outline-light fz-sm-texto flex-fill" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl() ?>">
                    <div class="d-flex flex-wrap">
                        <strong class="flex-fill text-start fz-subtitulo lt-2"><?php echo $entrada->getTitulo(); ?></strong>
                        <p class="flex-fill align-self-end text-end fz-texto m-0 pt-1"><?php echo date('d/M/Y', strtotime($entrada->getFecha())); ?></p>
                    </div>
                </a>
            </div>
        </div>
<?php
    }

    public static function resumir_texto($texto, $longitud_maxima)
    {
        $resultado = '';
        if (strlen($texto) > $longitud_maxima && $longitud_maxima > 0) {
            $resultado = substr($texto, 0, $longitud_maxima);
        } else {
            $resultado = $texto;
        }
        return $resultado;
    }
}
?>