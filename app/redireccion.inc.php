<?php
class redireccion
{
    public static function redirigir($url)
    {
        header('Location:' . $url, true, 301);
        exit();
    }
}