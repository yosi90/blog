<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">Mis entradas</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo RUTA_NUEVA_ENTRADA; ?>" class="btn btn-outline-light rosa d-flex flex-fill justify-content-center" id="b_ent">Nueva entrada</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 translucido">
            <?php
            if (count($array_entradas) > 0) {
            ?>
                <table class="table table-striped tabla bg-dark rounded my-1">
                    <thead>
                        <tr>
                            <th>
                                Título
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Estado
                            </th>
                            <th>
                                Comentarios
                            </th>
                            <th class="text-center">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($array_entradas); $i++) {
                            $entrada_actual = $array_entradas[$i][0];
                            $cantComentarios = $array_entradas[$i][1];
                        ?>
                            <tr>
                                <td><?php echo $entrada_actual->getTitulo(); ?></td>
                                <td><?php echo date('d/M/Y', strtotime($entrada_actual->getFecha())); ?></td>
                                <td>
                                    <?php
                                    if($entrada_actual->getActiva() == 0){
                                        echo 'Borrador';
                                    } else{
                                        echo 'Activa';
                                    }
                                    ?>
                                </td>
                                <td><?php echo $cantComentarios; ?></td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-outline-light" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl(); ?>">Visitar entrada</a>
                                    <button type="button" class="btn btn-outline-light mx-2">Editar</button>
                                    <button type="button" class="btn btn-outline-light">Borrar</button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="bg-dark text-white rounded my-1 p-5">
                    <h3 class="text-center">Todavia no has escrito entradas</h3>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>