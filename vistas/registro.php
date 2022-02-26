<?php
    include_once '../plantillas/documento-declaracion.inc.php';
    include_once '../app/validador.inc.php';
    include_once '../app/usuario.inc.php';
    if (isset($_POST['submit']))
    {
        conexion :: abrir_conexion();
        $validador = new validador($_POST['nombre'], $_POST['email'], $_POST['clave1'], $_POST['clave2'], conexion::obtener_conexion());
        if($validador -> registro_valido())
        {
            $usuario = new usuario('', $validador -> obtener_nombre(), $validador -> obtener_email(), password_hash($validador -> obtener_clave(), PASSWORD_DEFAULT), '', '');
            $usuario_insertado = RepositorioUsuario :: insertar_usuario(conexion :: obtener_conexion(), $usuario);
            if($usuario_insertado)
            {
                redireccion::redirigir(RUTA_REGISTRO_CORRECTO.'/'. $usuario -> getNombre());
            }
        }
        conexion :: cerrar_conexion();
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="my-5 d-flex justify-content-center p-5 rounded bg-dark bg-opacity-75 text-white jumbo">Formulario de registro</div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Instrucciones
                    </h3>
                </div>
                <div class="panel-body">
                    <br>
                    <p>
                        <span class="glyphicon glyphicon-fire" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  
                        Suerte en la vida.
                    </p>
                    <br>
                    <a href="inicio_sesion.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>  ¿Ya tienes cuenta?</a>
                    <br>
                    <br>
                    <a href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  ¿Olvidate tu contraseña?</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>  Introduce tus datos
                    </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="<?php echo RUTA_REGISTRO?>">
                       <?php
                            if(isset($_POST['submit']))
                            {
                                include_once '../plantillas/registro_validado.inc.php';
                            }
                            else
                            {
                                include_once '../plantillas/registro_vacio.inc.php';
                            }
                       ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// include_once '../plantillas/footer.inc.php';
include_once '../plantillas/documento-cierre.inc.php';
?>