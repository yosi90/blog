<?php
$titulo = 'Nueva entrada';
include_once 'plantillas/base.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/repositorioentrada.inc.php';
include_once 'app/validadorentrada.inc.php';
include_once 'app/repositoriousuario.inc.php';
include_once 'app/controlsesion.inc.php';
include_once 'app/redireccion.inc.php';
$entrada_publica = 1;
if(isset($_POST['guardar']))
{
    conexion::abrir_conexion();
    $partes_url = explode(' ', $_POST['titulo']);
    $url = "";
    if(count($partes_url) > 1)
    {
        for ($i = 0; $i < count($partes_url); $i++)
        {
            if($i++ == count($partes_url))
            {
                $url .= $partes_url[$i];
            }
            else 
            {
                $url .= $partes_url[$i] . '-';
            }
        }
    }
    else
    {
        $url = $partes_url[0];
    }
    $validador = new validadorentrada($_POST['titulo'], $url, htmlspecialchars($_POST['texto']), conexion::obtener_conexion());
    if(isset($_POST['publicar']) && $_POST['publicar'] == 'no')
    {
        $entrada_publica = 0;
    }
    if($validador -> entrada_valida())
    {
        $entrada = new entrada('', $_SESSION['id_usuario'], $url, $validador -> getTitulo(), $validador -> getTexto(), '', $entrada_publica);
        $entrada_insertada = repositorioentrada::insertar_entrada(conexion::obtener_conexion(), $entrada);
        if($entrada_insertada)
        {
            redireccion::redirigir(RUTA_ENTRADA . '/' . $entrada -> getUrl());
        }
        conexion::cerrar_conexion();
    }
}
?>
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>  Creador de entradas</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="new-entry" method="post" action="<?php echo RUTA_NUEVA_ENTRADA ;?>">
                <?php
                    if(isset($_POST['guardar']))
                    {
                        include_once 'plantillas/form_nueva_entrada_validado.inc.php';
                    }
                    else
                    {
                        include_once 'plantillas/form_nueva_entrada_vacio.inc.php';
                    }
                ?>
            </form>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/footer.inc.php';
