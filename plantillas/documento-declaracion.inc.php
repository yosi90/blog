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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/index.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/mediaQueris.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/material.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
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