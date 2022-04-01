<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">Archivo</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 translucido">
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
                <tbody id="contPaginacion">
                </tbody>
            </table>
            <div id="paginador" class="d-flex justify-content-center align-items-center bg-dark">
                <div class="bg-dark text-white rounded my-1 p-5">
                    <h3 class="text-center">No tienes entradas archivadas</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="tipo" type="hidden" value="archivo">
<script type="module" src="<?php echo CLASES; ?>paginadorEntradas.js"></script>