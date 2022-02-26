<?php
$titulo = $entrada -> getTitulo();
include_once 'plantillas/base.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';
include_once 'app/usuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentarios.inc.php';
?>
<div class="container contenido-articulo">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <i class="far fa-newspaper fa-2x">
                    </i><?php echo '    <u>' . $entrada -> getTitulo() . '</u>'; ?>
            </h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p align='right'>
                Por
                <a href="#">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $autor -> getNombre();?>
                </a>
                el
                <?php
                $fecha = $entrada -> getFecha();
                $partes_fecha = explode(' ', $fecha);
                $parte1 = explode('-', $partes_fecha[0]);
                $parte2 = $partes_fecha[1];
                switch ($parte1[1])
                {
                    case 1:
                        $mes = 'Enero';
                        break;
                    case 2:
                        $mes = 'Febrero';
                        break;
                    case 3:
                        $mes = 'Marzo';
                        break;
                    case 4:
                        $mes = 'Abril';
                        break;
                    case 5:
                        $mes = 'Mayo';
                        break;
                    case 6:
                        $mes = 'Junio';
                        break;
                    case 7:
                        $mes = 'Julio';
                        break;
                    case 8:
                        $mes = 'Agosto';
                        break;
                    case 9:
                        $mes = 'Septiembre';
                        break;
                    case 10:
                        $mes = 'Octubre';
                        break;
                    case 11:
                        $mes = 'Noviembre';
                        break;
                    case 12:
                        $mes = 'Diciembre';
                        break;
                }
                echo $parte1[2] . ' de ';
                echo $mes . ' del ';
                echo $parte1[0] . ' a las ';
                echo $parte2;
                ?>
            </td>
            </p>
        </div>
    </div>
    <br>
    <br>
    <div class="row" style="border-color: #449d44; border-radius: 1em; border-style: solid; background-color: whitesmoke; padding: 1em; margin: 1em; padding-top: 4em;">
        <div class="col-md-12 text-justify">
            <article>
                <font size =5em>
                <?php
                echo nl2br($entrada -> getTexto());
                ?>
                </font>
            </article>
        </div>
    </div>
    <?php
        include_once 'plantillas/entradas_azar.inc.php';
    ?>
    <br>
    <?php
        if(count($comentarios) > 0)
        {
            include_once 'plantillas/comentarios_entrada.inc.php';
        }
        else
        {
            echo '<p>Nadie ha comentado aun, ¡se el primero!</p>';
        }
    ?>
</div>
    
<?php
include_once 'plantillas/documento-cierre.inc.php';
include_once 'plantillas/footer.inc.php';