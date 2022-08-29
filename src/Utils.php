<?php

namespace src;

class Utils
{
    /**
     * Function to check is a html message.
     *
     * @param string $content
     *
     * @return bool
     */
    public static function isHtml(string $content): bool
    {
        $content = trim($content);

        if ('<' === substr($content, 0, 1) && '>' === substr($content, -1)) {
            return true;
        }

        return $content != strip_tags($content);
    }

    public static function TextoRandom($longitud)
    {
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $numero_caracteres = strlen($caracteres);
        $string_aleatorio = '';
        for ($i = 0; $i < $longitud; $i++) {
            $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
        }
        return $string_aleatorio;
    }
}