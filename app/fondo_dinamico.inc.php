<?php
    $fondo = rand(1, 3);
    switch ($fondo)
    {
        case 1:
            $fondo = "url(img/fondo_jumbo.jpg";
            $color = "black";
            break;
        case 2:
            $fondo = "url(img/fondo_jumbo2.jpg";
            $color = "yellow";
            break;
        case 3:
            $fondo = "url(img/fondo_jumbo3.jpg";
            $color = "white";
            break;  
    }
