<?php
class redireccion
{
    public static function redirigir($url)
    {
        header('Location:' . $url, false, 301); /*El booleano en la segunda posición del header significa si se actualiza en el navegador la url de la página actual. En false no se actualiza*/
        exit();
    }
}