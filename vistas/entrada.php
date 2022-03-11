<?php
$titulo = $entrada->getTitulo();
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';
include_once 'app/usuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentarios.inc.php';

?>
<div class="container py-4">
    <div class="row">
        <div class="card rounded">
            <div class="card-header d-flex flex-fill bg-dark-light text-white p-3">
                <h1 class="d-flex flex-fill"><i class="far fa-newspaper fa-2x">&nbsp;</i><?php echo '    <u>' . $entrada->getTitulo() . '</u>'; ?></h1>
                <p class="d-flex align-self-end">
                    Por&nbsp;
                    <a href="#">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $autor->getNombre(); ?>
                    </a>
                    &nbsp;el
                    <?php
                    $fecha = $entrada->getFecha();
                    $partes_fecha = explode(' ', $fecha);
                    $parte1 = explode('-', $partes_fecha[0]);
                    $parte2 = $partes_fecha[1];
                    switch ($parte1[1]) {
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
                    echo $parte1[2] . ' de ' . $mes . ' del ' . $parte1[0] . ' a las ' . $parte2;
                    ?>
                    </td>
                </p>
            </div>
            <div class="card-body bs-s border-1 bc-dark p-3">
                <div class="col-md-12 text-justify">
                    <article class="fz-texto">
                        <?php
                        echo nl2br($entrada->getTexto());
                        ?>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        if (count($comentarios) > 0) {
            include_once 'plantillas/comentarios_entrada.inc.php';
        } else {
        ?>
            <button class="btn btn-outline-light rosa my-3" type="button" data-bs-toggle="collapse" data-bs-target="#comentarios" aria-expanded="false" aria-controls="comentarios">
                <i class="fas fa-comments fa-lg"></i>&nbsp;Aun no hay Comentarios
            </button>
        <?php
        }
        ?>
    </div>
    <div class="row mt-3">
        <?php
        include_once 'plantillas/entradas_azar.inc.php';
        ?>
    </div>
</div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>