<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">Mis entradas</div>
        </div>
    </div>
    <div class="g-e">
        <div class="col-md-11">
            <a href="<?php echo RUTA_NUEVA_ENTRADA; ?>" class="btn btn-lg btn-primary text-left" id="b_ent" style="margin-bottom: 2em; ">Nueva entrada</a>
            <br>
        </div>
    </div>
    <div class="row g-e">
        <div class="col-md-12">
            <?php
            if (count($array_entradas) > 0) {
            ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                Fecha
                            </th>
                            <th>
                                Título
                            </th>
                            <th>
                                Dirección
                            </th>
                            <th>
                                Estado
                            </th>
                            <th>
                                Comentarios
                            </th>
                            <th>
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($array_entradas); $i++) {
                            $entrada_actual = $array_entradas[$i][0];
                            $comentarios_entrada_actual = $array_entradas[$i][1];
                        ?>
                            <tr>
                                <td><?php echo $entrada_actual->getFecha(); ?></td>
                                <td><?php echo $entrada_actual->getTitulo(); ?></td>
                                <td><a class="btn btn-default btn-xs" role="button" id="b_ent" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl(); ?>">Visitar entrada</a></td>
                                <td><?php echo $entrada_actual->getActiva(); ?></td>
                                <td><?php echo $comentarios_entrada_actual; ?></td>
                                <td>
                                    <button type="button" class="btn btn-default btn-xs" id="b_ent" role="button" style="background-color: lightgray;">Editar</button>
                                    <button type="button" class="btn btn-default btn-xs" id="b_ent" role="button" style="background-color: lightgray;">Borrar</button>
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
                <h3 class="text-center">Todavia no has escrito entradas</h3>
                <br>
                <br>
            <?php
            }
            ?>
        </div>
    </div>
</div>