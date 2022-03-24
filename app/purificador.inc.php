<?php

class purifier
{
    const PREG_STR = '/[^a-zA-Z0-9\-\_\¿\?\¡\+\$\€\[\]\{\}\(\)\s\:\.\,\;\@\#\|\"\!\^\*\'\<\>\&\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ç\Ç]/';
    // const PREG_STR2 = '/[^\p{Latin}0-9\s\{\}\?\'\"\$\€\&\¿\?\!\¡\(\)\/\\\=\*\´\@\#\%\+\-\_\<\>\,\;\.\:\s]/';
    const PREG_MAIL = '/[^a-zA-Z0-9\-\_\.\@]/';

    public static function purifier($value, $type)
    {
        switch ($type) {
            case 'texto':
                return self::limpiarTextos($value);
                break;
            case 'titulo':
                return self::limpiarTitulos($value);
                break;
            case 'email':
                return self::limpiarEmails($value);
                break;
            default:
                throw new Exception('Tipo no existe', 500);
        }
    }

    private static function limpiarTextos($var)
    {
        return \trim(\preg_replace(static::PREG_STR, '', $var), " \t\n\r");
    }

    private static function limpiarTitulos($var)
    {
        return \preg_replace(static::PREG_STR, '', $var);
    }

    private static function limpiarEmails(string $var): string
    {
        return \trim(\preg_replace(static::PREG_MAIL, '', $var), " \t\n\r");
    }
}
