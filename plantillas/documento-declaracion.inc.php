<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if (!isset($titulo) || empty($titulo)) { $titulo = 'Troubles time'; }
    echo "<title>$titulo</title>";
    include_once $_SERVER['DOCUMENT_ROOT'] . '/blog/app/config.inc.php';
    ?>
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.min.js"></script>
    <script src="<?php echo JS; ?>/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/index.js"></script>
    <link href="<?php echo CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/FA.min.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/index.css" rel="stylesheet">
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
    <div class="pater">
        <?php
        include_once 'navbar.inc.php';
        ?>