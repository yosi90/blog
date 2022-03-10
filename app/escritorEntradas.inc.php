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
            <div class="card-header bg-secondary text-white">
                <div class="d-flex flex-wrap">
                    <div class="flex-fill fz-subtitulo">
                        <strong class="lt-2">
                            <?php
                            echo $entrada->getTitulo();
                            ?>
                        </strong>
                    </div>
                    <div class="flex-fill pt-1">
                        <p class="m-0 text-end fz-texto">
                            <?php
                            echo date('d/M/Y', strtotime($entrada->getFecha()));
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body p-2">
                <p class="fz-sm-texto lt-3">
                    <?php
                    echo ucfirst(nl2br(self::resumir_texto($entrada->getTexto(), 400)));
                    ?>
                </p>
            </div>
            <div class="d-flex m-2">
                <a class="btn btn-outline-light flex-grow-0 rosa fz-sm-texto" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl() ?>">
                    <b>Continuar leyendo</b>
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