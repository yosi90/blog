<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';
include_once 'app/usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentarios.inc.php';

$cantUsers = 100;
$cantEntradas = 300;
$cantCometarios = 1000;

conexion::abrir_conexion();
for ($usuarios = 0; $usuarios < $cantUsers; $usuarios++) {
    $nombre = TextoRandom(rand(4, 10));
    $email = TextoRandom(8) . '@' . TextoRandom(5) . '.com';
    $password = password_hash(ContraseñaRandom(rand(8, 15)), PASSWORD_DEFAULT);
    $usuario = new usuario('', $nombre, $email, $password, '', '');
    RepositorioUsuario::insertar_usuario(conexion::obtener_conexion(), $usuario);
}

for ($entradas = 0; $entradas < $cantEntradas; $entradas++) {
    $titulo = TextoRandom(10);
    $url = $titulo;
    $texto = lorem();
    $autor = rand(1, $cantUsers);
    $entrada = new entrada('', $autor, $url, $titulo, $texto, '', '');
    repositorioentrada::insertar_entrada(conexion::obtener_conexion(), $entrada);
}

for ($comentarios = 0; $comentarios < $cantCometarios; $comentarios++) {
    $titulo = TextoRandom(10);
    $texto = lorem();
    $autor = rand(1, $cantUsers);
    $entrada = rand(1, $cantEntradas);
    $comentario = new comentario('', $autor, $entrada, $titulo, $texto, '');
    repositoriocomentarios::insertar_comentario(conexion::obtener_conexion(), $comentario);
}

function TextoRandom($longitud)
{
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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

function lorem()
{
    return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lacinia a elit non gravida. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas vitae mi nulla. Nulla fringilla metus mauris, non faucibus nunc accumsan pellentesque. Integer non ante ut sem lacinia accumsan euismod quis quam. Nulla dignissim finibus quam, mattis consectetur magna tempus at. In eleifend semper condimentum. Nam tincidunt turpis a metus dapibus mattis. Mauris vulputate metus sed risus tristique, sed hendrerit lectus placerat. Vestibulum eu sagittis orci. Sed risus elit, euismod nec odio ac, convallis pretium libero. Suspendisse imperdiet quam non rhoncus suscipit. Integer quis mattis sapien.

    Pellentesque aliquam euismod tortor venenatis aliquet. Fusce quis mauris mauris. Nullam id aliquet mauris. In hac habitasse platea dictumst. In accumsan nulla vitae venenatis sodales. Cras gravida, ante at congue tincidunt, nibh nulla ornare sapien, nec tristique nunc purus in sapien. In pellentesque ac massa sit amet hendrerit. Phasellus massa augue, ultrices nec ex vitae, varius auctor augue. Morbi sed gravida justo. Aenean eget est commodo, accumsan leo at, elementum metus. Sed tempus turpis nec orci consectetur pretium. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce congue bibendum magna, vel condimentum sapien rhoncus non.

    Nam aliquam sem ut lectus bibendum, a facilisis mi mollis. Praesent semper vel nulla vel efficitur. Suspendisse interdum arcu vitae diam facilisis, a hendrerit erat egestas. Ut non porttitor arcu. Donec ultrices augue eget odio vehicula rhoncus. Sed sodales in eros et accumsan. Fusce non mi sit amet libero faucibus rutrum. Maecenas maximus leo at molestie maximus. Duis vitae sapien justo. Nam pulvinar eleifend nisi, ac convallis ante elementum sit amet. Morbi vitae vehicula felis. Etiam rutrum feugiat suscipit. Donec nec purus sed libero malesuada vulputate. Mauris ultrices tortor in pulvinar faucibus. In auctor, nisi non varius faucibus, neque nibh molestie mauris, sit amet fringilla tortor augue vel quam. Maecenas ullamcorper tristique ligula.

    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur faucibus pulvinar ipsum, quis ullamcorper mauris varius vel. Nam venenatis augue sit amet consequat pretium. Proin tristique nisi eget ipsum posuere, at dictum arcu porta. Quisque auctor facilisis augue quis congue. Nam nec augue ut velit aliquam condimentum. Suspendisse consectetur ex et egestas efficitur. Sed elementum ante vel sem pulvinar facilisis. Sed ut pharetra lacus, et laoreet odio. Vestibulum sed quam non elit tincidunt tristique vel sit amet ex. Suspendisse vestibulum scelerisque lacus vitae vulputate. Aenean malesuada est magna, vel luctus tortor lobortis vitae. Donec auctor enim sit amet varius venenatis. In convallis facilisis quam.

    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at quam quis mi congue sodales. Nulla ullamcorper arcu sit amet metus bibendum aliquam. Etiam sit amet enim luctus, aliquet felis ac, efficitur quam. Morbi ornare turpis nec urna fermentum, vel euismod nisl tempor. Curabitur eget magna et est commodo scelerisque. Praesent lorem enim, cursus eu mauris ac, fringilla mattis arcu.';
}
