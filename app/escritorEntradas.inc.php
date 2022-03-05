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
        <div class="card d-flex flex-fill controlTamaño max-100">
            <div class="card-header bg-secondary text-white">
                <div class="d-flex flex-wrap">
                    <div class="flex-fill fz-subtitulo">
                        <strong>
                            <?php
                            echo $entrada->getTitulo();
                            ?>
                        </strong>
                    </div>
                    <div class="pt-1">
                        <p class="m-0 text-end fz-texto">
                            <?php
                            echo date('d/M/Y', strtotime($entrada->getFecha()));
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="text-justify">
                    <p class="fz-sm-texto">
                        <?php
                        echo ucfirst(nl2br(self::resumir_texto($entrada->getTexto(), 200)));
                        ?>
                    </p>
                </div>
                <div class="text-right back">
                    <a class="btn btn-outline-light rosa fz-texto" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl() ?>">
                        <b>Continuar leyendo</b>
                    </a>
                </div>
            </div>
        </div>
<?php
    }

    public static function resumir_texto($texto, $longitud_maxima)
    {
        $resultado = '';
        if (strlen($texto) > $longitud_maxima) {
            $resultado = substr($texto, 0, $longitud_maxima);
            $resultado .= '...';
        } else {
            $resultado = $texto;
        }
        return $resultado;
    }
}
?>