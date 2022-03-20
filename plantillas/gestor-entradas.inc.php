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
                                <td title="<?php echo $entrada_actual->getTitulo(); ?>"><a class="text-decoration-none text-white" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl(); ?>"><p class="lt-linea-200 mb-0 text-start"><?php echo $entrada_actual->getTitulo(); ?></p></a></td>
                                <td><?php echo date('d/M/Y', strtotime($entrada_actual->getFecha())); ?></td>
                                <td>
                                    <form method="POST" action="<?php echo RUTA_ACTIVAR_ENTRADA; ?>">
                                    <?php
                                    if ($entrada_actual->getActiva() == 0) {
                                    ?>
                                        <input type="submit" name="toggle" class="btnmimic red mx-1" value="Borrador">
                                        <input type="hidden" name="activo" value="1">
                                    <?php
                                    } else {
                                    ?>
                                        <input type="submit" name="toggle" class="btnmimic green mx-1" value="Activa">
                                        <input type="hidden" name="activo" value="0">
                                    <?php
                                    }
                                    ?>
                                    <input type="hidden" name="IdEntrada" value="<?php echo $entrada_actual->getId_entrada(); ?>">
                                    <input type="hidden" name="IdAutor" value="<?php echo $entrada_actual->getAutor(); ?>">
                                    </form>
                                </td>
                                <td><?php echo $cantComentarios; ?></td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-outline-light mx-1" role="button" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl(); ?>">Visitar entrada</a>
                                    <form method="POST" action="<?php echo RUTA_EDITAR_ENTRADA; ?>">
                                        <button type="submit" name="edit" value="edit" class="btn btn-outline-light mx-1">Editar</button>
                                        <input type="hidden" name="IdEntrada" value="<?php echo $entrada_actual->getId_entrada(); ?>">
                                    </form>
                                    <form method="POST" action="<?php echo RUTA_ARCHIVAR_ENTRADA; ?>">
                                        <button type="submit" name="archive" value="archive" class="btn btn-outline-light mx-1">Archivar</button>
                                        <input type="hidden" name="IdEntrada" value="<?php echo $entrada_actual->getId_entrada(); ?>">
                                        <input type="hidden" name="IdAutor" value="<?php echo $entrada_actual->getAutor(); ?>">
                                        <input type="hidden" name="archivo" value="1">
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
                include_once 'navegadorElementos.inc.php';
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