<?php
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'app/usuario.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-content-center align-items-center">
            <div class="card w-100 rounded mt-5 pb-0">
                <div class="card-header d-flex flex-row flex-nowrap justify-content-center bg-dark text-white border-bottom-0 fs-4 font-weight-bold pt-5 px-5 pb-0 mb-0">
                    <a id="bPerfil1" href="#" class="text-decoration-none text-white bg-gray rounded-top me-1 px-4 pt-2 pb-1 active">Imagen pública</a>
                    <a id="bPerfil2" href="#" class="text-decoration-none text-white bg-gray rounded-top me-1 px-4 pt-2 pb-1">Datos personales</a>
                    <a id="bPerfil3" href="#" class="text-decoration-none text-white bg-gray rounded-top me-1 px-4 pt-2 pb-1">Mensajes directos</a>
                    <a id="bPerfil4" href="#" class="text-decoration-none text-white bg-gray rounded-top px-4 pt-2 pb-1">Privacidad</a>
                </div>
                <div id="public" class="card-body d-flex flex-row flex-nowrap bg-dark-light p-5">
                    <div class="col-3 d-flex flex-column justify-content-center align-items-center">
                        <p class="text-white mb-0">Foto</p>
                        <div class="bg-gray" style="height: 15vh; width: 12vh;"></div>
                    </div>
                    <div class="col-9 d-flex flex-column justify-content-center align-items-center">
                        <p class="bg-gray text-white p-5">@Usuario: <?php echo $_SESSION['nombre_usuario'] ?></p>
                        <p class="bg-gray text-white p-5">Aun no has creado una firma</p>
                    </div>
                </div>
                <div id="private" class="card-body d-flex flex-row flex-nowrap bg-dark-light p-2">
                    <div id="contMds" class="d-flex flex-fill bg-gray rounded m-4">
                        Datos
                        <br>
                        personales
                    </div>
                </div>
                <div id="mds" class="card-body d-flex flex-row flex-nowrap bg-dark-light p-2">
                    <div id="contMds" class="d-flex flex-fill bg-gray rounded m-4">
                        Mensajes
                        <br>
                        directos
                    </div>
                </div>
                <div id="privacity" class="card-body d-flex flex-row flex-nowrap bg-dark-light p-2">
                    <div id="contMds" class="d-flex flex-fill bg-gray rounded m-4">
                        Opciones
                        <br>
                        de privacidad
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo JS ?>/perfil.js"></script>
<?php
include_once 'plantillas/documento-cierre.inc.php';
