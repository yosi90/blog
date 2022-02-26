<?php
include_once 'entrada.inc.php';
include_once 'RepositorioEntrada.inc.php';
include_once 'Conexion.inc.php';
class EscritorEntradas
{
    public static function escribir_entradas()
    {
        $entradas = RepositorioEntrada::obtener_por_fecha(Conexion::obtener_conexion());
        if(count($entradas))
        {
            foreach($entradas as $entrada)
            {
                self::escribir_entrada($entrada);
            }
        }
    }
    public static function escribir_entrada($entrada)
    {
        if(!isset($entrada))
        {
            return;
        }
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                <i class="far fa-newspaper fa-lg"></i>
                                <span class="izq">
                                <?php
                                    echo $entrada -> getTitulo();
                                    ?> <br/>
                                </span>
                                <span class="der">
                                <?php
                                    echo $entrada -> getId();
                                ?>
                                    <i class="fab fa-slack-hash"></i>
                                </span>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p class="text-right">
                                <strong >
                                    <?php
                                        echo $entrada -> getFecha();
                                    ?>
                                </strong>
                            </p>
                            <br>
                            <div class="text-justify">
                                <p>
                                    <?php
                                        echo ucfirst (nl2br (self::resumir_texto ($entrada -> getTexto())));
                                    ?>
                                </p>
                            </div>
                            <br>
                            <div class="text-right back">
                                <a class="btn btn-primary" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada -> getUrl() ?>">
                                    <b>Continuar leyendo</b>
                                </a>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    public static function resumir_texto($texto)
    {
        $longitud_maxima = 400;
        $resultado = '';
        if(strlen($texto) > $longitud_maxima)
        {
            $resultado = substr($texto, 0, $longitud_maxima);
            $resultado .= '...';
        }
        else
        {
            $resultado = $texto;
        }
        return $resultado; 
    }
}