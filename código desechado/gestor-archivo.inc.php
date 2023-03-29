<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">Mis entradas archivadas</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 translucido">
            <?php
            if (count($array_archivo) > 0) {
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
                        for ($i = 0; $i < count($array_archivo); $i++) {
                            $entrada_actual = $array_archivo[$i][0];
                            $cantComentarios = $array_archivo[$i][1];
                        ?>
                            <tr>
                                <td title="<?php echo $entrada_actual->getTitulo(); ?>"><p class="lt-linea-200 mb-0"><?php echo $entrada_actual->getTitulo(); ?></p></td>
                                <td><?php echo date('d/M/Y', strtotime($entrada_actual->getFecha())); ?></td>
                                <td>
                                    <?php
                                    if ($entrada_actual->getActiva() == 0) {
                                    ?>
                                        <div class="btnmimic bg-red mx-1"><strong>Borrador</strong></div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="btnmimic bg-green mx-1"><strong>Activa</strong></div>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $cantComentarios; ?></td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-outline-light mx-1" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl(); ?>">Visitar entrada</a>
                                    <form method="POST" action="<?php echo RUTA_ARCHIVAR_ENTRADA; ?>">
                                        <button type="submit" name="archive" value="archive" class="btn btn-outline-light mx-1">Desarchivar</button>
                                        <input type="hidden" name="IdEntrada" value="<?php echo $entrada_actual->getId_entrada(); ?>">
                                        <input type="hidden" name="IdAutor" value="<?php echo $entrada_actual->getAutor(); ?>">
                                        <input type="hidden" name="archivo" value="0">
                                    </form>
                                    <?php
                                    if ($_SESSION['administrador'] == 1) {
                                    ?>
                                        <form method="POST" onSubmit="return confirm('Confirma que deseas borrar esta entrada');" action="<?php echo RUTA_BORRAR_ENTRADA; ?>">
                                            <button type="submit" name="delete" value="delete" class="btn btn-outline-light mx-1">Borrar</button>
                                            <input type="hidden" name="IdEntrada" value="<?php echo $entrada_actual->getId_entrada(); ?>">
                                            <input type="hidden" name="IdAutor" value="<?php echo $entrada_actual->getAutor(); ?>">
                                        </form>
                                    <?php
                                    }
                                    ?>
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
                    <h3 class="text-center">Todavia no has archivado entradas</h3>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>