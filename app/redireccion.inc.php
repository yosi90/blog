<?php
class redireccion
{
    public static function redirigir($url)
    {
        header('Location:' . $url, false, 301);
        exit();
    }
}