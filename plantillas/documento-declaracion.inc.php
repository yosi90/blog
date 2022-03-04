<html lang="es">
<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/app/Redireccion.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/app/config.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/app/controlsesion.inc.php';
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (!isset($titulo) || empty($titulo)) {
        $titulo = 'Troubles time';
    }
    echo "<title>$titulo</title>";
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/index.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/mediaQueris.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/material.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/index.js"></script>
    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('#txt-content').Editor();
            $('#btn-enviar').click(function(e) {
                e.preventdefault();
                var texto = $('#txt-content').Editor('getText');
                $('#texto').html(texto);
            });
        });
    </script> -->
</head>

<body>
    <canvas id="sakura"></canvas>
    <?php
        include_once 'navbar.inc.php';
    ?>
    <div class="pater">