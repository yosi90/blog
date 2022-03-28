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
            <table class="table table-striped tabla bg-dark rounded mt-1 mb-0">
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
                    <div class="bg-dark text-white rounded my-1 p-5">
                        <h3 class="text-center">Todavia no has escrito entradas</h3>
                    </div>
                </tbody>
            </table>
            <div id="paginador" class="d-flex justify-content-center align-items-center bg-dark"></div>
        </div>
    </div>
</div>
<input id="tipoEntradas" type="hidden" value="tabla">
<script type="module" src="<?php echo CLASES; ?>paginadorEntradas.js"></script>