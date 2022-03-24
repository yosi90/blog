<?php
                        for ($i = 0; $i < count($entradas); $i++) {
                            $entrada_actual = $entradas[$i][0];
                            $cantComentarios = $entradas[$i][1];
                        ?>
                            <tr>
                                <td title="<?php echo $entrada_actual->getTitulo(); ?>">
                                    <a class="text-decoration-none text-white" href="<?php echo RUTA_ENTRADA . '/' . $entrada_actual->getUrl(); ?>">
                                        <p class="lt-linea-200 mb-0 text-start"><?php echo $entrada_actual->getTitulo(); ?></p>
                                    </a>
                                </td>
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
                                        <input type="hidden" name="IdAutor" value="<?php echo $entrada_actual->getIdAutor(); ?>">
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