<?php
require_once ROOT . 'config/Config.inc.php';
require_once ROOT . 'config/Conexion.inc.php';
require_once ROOT . 'app/entradas/Entrada.inc.php';
require_once ROOT . 'app/comentarios/Comentario.inc.php';
require_once ROOT . 'app/usuarios/Usuario.inc.php';
require_once ROOT . 'app/usuarios/RepositorioUsuario.inc.php';
require_once ROOT . 'app/entradas/RepositorioEntrada.inc.php';
require_once ROOT . 'app/RepositorioComentarios.inc.php';

$cantUsers = 100;
$cantEntradas = 300;
$cantCometarios = 1000;

conexion::abrir_conexion();
for ($usuarios = 0; $usuarios < $cantUsers; $usuarios++) {
    $nombre = Texto(rand(4, 10));
    $email = TextoEmail(8) . '@' . TextoEmail(5) . '.com';
    $password = password_hash(ContraseñaRandom(rand(8, 15)), PASSWORD_DEFAULT);
    $usuario = new usuario('', $nombre, $email, $password, '', '', 0, 0);
    RepositorioUsuario::insertar_usuario(conexion::obtener_conexion(), $usuario);
}

for ($entradas = 0; $entradas < $cantEntradas; $entradas++) {
    $titulo = Texto(10);
    $texto = TextoComentarios(rand(20, 1000));
    $autor = rand(1, $cantUsers);
    $entrada = repositorioentrada::insertar_entrada(conexion::obtener_conexion(), Repositorioentrada::crearUrl($titulo), $titulo, $texto, 1, 0, 0, $autor);
}

for ($comentarios = 0; $comentarios < $cantCometarios; $comentarios++) {
    $texto = TextoComentarios(rand(20, 1000));
    $entrada = rand(1, $cantEntradas);
    $autor = rand(1, $cantUsers);
    repositoriocomentarios::insertar_comentario(conexion::obtener_conexion(), $texto, $autor, $entrada);
}
?>
<script>window.location.href = "<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl(); ?>"</script>
<?php
function Texto($longitud)
{
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}

function TextoEmail($longitud)
{
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}

function TextoComentarios($longitud)
{
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_¿?¡+$€[]{}()1234567890 ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}

function NumerosRandom($longitud)
{
    $caracteres = '0123456789';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}

function ContraseñaRandom($longitud)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#.,:;-_';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    return $string_aleatorio;
}
