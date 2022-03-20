<?php

class utilidades{
     /**
     * Array map recursive.
     *
     * @param string $callback 'utf8_decode', 'trim', etc.
     * @param array  $values
     *
     * @return array $values
     */
    public static function array_map_recursive($callback, array $values)
    {
        foreach ($values as $key => $value) {
            if (true === \is_object($value)) {
                $value = (array) $value;
            }
            if (true === \is_array($value)) {
                $values[$key] = self::array_map_recursive($callback, $value);
            } elseif (true === \is_string($value)) {
                $values = \array_map($callback, $values);
            }
        }

        return $values;
    }
    
    public static function utf8ize($d)
    {
        if (is_array($d))
            foreach ($d as $k => $v)
                $d[$k] = self::utf8ize($v);
        else if (is_object($d))
            foreach ($d as $k => $v)
                $d->$k = self::utf8ize($v);
        else if (is_string($d))
            return utf8_encode($d);

        return $d;
    }

    public static function truncateText($texto, $longitud_maxima)
    {
        $resultado = '';
        if (strlen($texto) > $longitud_maxima && $longitud_maxima > 0) {
            $resultado = substr($texto, 0, $longitud_maxima);
        } else {
            $resultado = $texto;
        }
        return $resultado;
    }
}