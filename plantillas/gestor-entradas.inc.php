<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center p-1 bg-dark translucido text-white jumbo fz-jumbo my-1">Mis entradas</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo RUTA_NUEVA_ENTRADA; ?>" class="btn btn-outline-light bg-rosa d-flex flex-fill justify-content-center" id="b_ent">Nueva entrada</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 translucido">
            <table class="table table-striped tabla rounded mt-1 mb-0">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Comentarios</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="contPaginacionE">
                </tbody>
            </table>
            <div id="paginadorE" class="d-flex justify-content-center align-items-center bg-dark">
                <div class="bg-dark text-white rounded my-1 p-5">
                    <h3 class="text-center">Todavia no has escrito entradas</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<input id="tipoE" type="hidden" value="tabla">
<script type="module" src="<?php echo CLASES; ?>paginadorEntradas.js"></script>