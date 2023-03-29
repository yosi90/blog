<div id="contenedorSidebar" class="d-none">
    <ul id="sidebar" class="d-none bg-dark text-center list-unstyled m-0 pe-1 py-1">
        <a href="<?php echo RUTA_GESTOR; ?>">
            <li id="gen"><i class="fas fa-solar-panel fa-2x"></i></li>
        </a>
        <a href="<?php echo RUTA_GESTOR_ENTRADAS; ?>">
            <li id="ent"><i class="fas fa-clipboard fa-2x"></i></li>
        </a>
        <a href="<?php echo RUTA_GESTOR_COMENTARIOS; ?>">
            <li id="com"><i class="fas fa-comments fa-2x"></i></li>
        </a>
        <a href="<?php echo RUTA_GESTOR_FAVORITOS; ?>">
            <li id="fav"><i class="fas fa-star fa-2x"></i></li>
        </a>
        <a href="<?php echo RUTA_GESTOR_ARCHIVO; ?>">
            <li id="arc"><i class="fas fa-box fa-2x"></i></li>
        </a>
    </ul>
    <button id="btnSidebar" class="btn bg-rosa p-1" type="button" onclick="cerrar();"></button>
</div>
<script type="text/javascript" src="<?php echo JS; ?>pcSidebar.js"></script>
<div class="container-fluid">
    <div class="row mt-5">
        <div id="pcMenu" class="col-2 d-flex flex-column flex-wrap align-items-center p-4 translucido">
            <ul class="p-control bg-dark rounded text-center list-unstyled m-0 my-5 p-0">
                <a href="<?php echo RUTA_GESTOR; ?>">
                    <li id="gen"><i class="fas fa-solar-panel fa-2x mt-1"></i><br>General</li>
                </a>
                <a href="<?php echo RUTA_GESTOR_ENTRADAS; ?>">
                    <li id="ent"><i class="fas fa-clipboard fa-2x mt-1"></i><br>Entradas</li>
                </a>
                <a href="<?php echo RUTA_GESTOR_COMENTARIOS; ?>">
                    <li id="com"><i class="fas fa-comments fa-2x mt-1"></i><br>Comentarios</li>
                </a>
                <a href="<?php echo RUTA_GESTOR_FAVORITOS; ?>">
                    <li id="fav"><i class="fas fa-star fa-2x mt-1"></i><br>Favoritos</li>
                </a>
                <a href="<?php echo RUTA_GESTOR_ARCHIVO; ?>">
                    <li id="arc"><i class="fas fa-box fa-2x mt-1"></i><br>Archivo</li>
                </a>
            </ul>
        </div>
        <div id="gestor" class="col-10 main mb-5">