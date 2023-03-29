<button class="btn btn-outline-light flex-fill bg-rosa m-3" type="button" name="desplegarComentarios" id="desplegarComentarios" data-bs-toggle="collapse" data-bs-target="#comentarios" aria-expanded="false" aria-controls="comentarios">
    <i class="fas fa-comments fa-lg"></i>&nbsp;Comentarios&nbsp;(<?php echo count($comentarios) ?>)
</button>
<div id="comentarios" class="collapse" >
    <?php
    for ($i = 0; $i < count($comentarios); $i++) {
        $comentario = $comentarios[$i];
    ?>
        <div class="row mt-1">
            <div id="<?php echo 'comentario' . ($i + 1) ?>" class="card">
                <div class="card-header d-flex flex-fill flex-wrap bg-dark text-white p-3">
                    <div class="d-flex flex-fill"><strong>#<?php echo ($i + 1) ?></strong></div>
                    <p class="d-flex m-0">
                        <?php
                        $fecha = $comentario->getFecha();
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
                    </p>
                </div>
                <div class="card-body d-flex flex-fill flex-wrap bg-dark-light text-white">
                    <div class="col-md-2 columna_user">
                        <p><?php echo $comentario->getAutor(); ?></p>
                    </div>
                    <div class="col-md-10">
                        <p class="text-justify m-0 p-2"><?php echo nl2br($comentario->getTexto()); ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>