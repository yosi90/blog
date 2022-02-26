<?php
    $titulo = "Login";
    include_once 'plantillas/base.inc.php';
    include_once 'app/config.inc.php';
    include_once 'app/validadorLogin.inc.php';
    include_once 'app/controlsesion.inc.php';
    
    if(controlsesion::sesion_iniciada())
    {
        redireccion::redirigir(SERVIDOR);
    }
    
    if(isset($_POST['login']))
    {
        conexion::abrir_conexion();
        $validador = new validadorLogin($_POST['correo'], $_POST['PASSWORD'], conexion::obtener_conexion());
        if($validador -> obtener_error() === '' && !is_null($validador -> obtener_usuario()))
        {
            controlsesion::iniciar_sesion($validador -> obtener_usuario() -> getid(), $validador -> obtener_usuario() -> getnombre());
            redireccion::redirigir(SERVIDOR);
        }
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h2>Iniciar sesión</h2>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo RUTA_LOGIN; ?>">
                        <h3>Introduce tus datos</h3>
                        <br>
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" 
                               <?php 
                                    if(isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email']))
                                    {
                                        echo 'value="' . $_POST['email'] . '"';
                                    }
                               ?>
                               required="true" autofocus="true">
                        <br>
                        <label for="clave" class="sr-only">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required="true">
                        <br>
                        <?php
                            if(isset($_POST['login']))
                            {
                                $validador -> mostrar_error();
                            }
                        ?>
                        <button type="submit" name="login" id="login" class="btn btn-lg btn-block btn-primary">Iniciar sesión</button>
                    </form>
                    <br>
                    <br>
                    <div class="text-center">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/footer.inc.php';