<!DOCTYPE html>
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
    <link rel="icon" type="image/png" href="<?php echo IMG; ?>/ficon.png">
    <?php
    if (!isset($titulo) || empty($titulo)) { $titulo = 'Troubles time'; }
    echo "<title>$titulo</title>";
    ?>
    <link href="<?php echo CSS; ?>/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo CSS; ?>/index.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/mediaQueris.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/material.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/scrollbar.css" rel="stylesheet">
    <link href="<?php echo CSS; ?>/gestor.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo JS; ?>/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo JS; ?>/bootstrap.bundle.js"></script>
    <script type="text/javascript" src="<?php echo editor; ?>ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo editor; ?>config.js"></script>
    <script type="text/javascript" src="<?php echo editor; ?>styles.js"></script>
    <script type="text/javascript" src="<?php echo editor; ?>/adapters/jquery.js"></script>
    <script defer type="text/javascript" src="<?php echo JS; ?>/fondo.js"></script>
    <script defer type="text/javascript" src="<?php echo JS; ?>/alternarVistas.js"></script>
</head>

<body>
    <canvas id="sakura"></canvas>
    <?php
        include_once 'navbar.inc.php';
    ?>
    <div class="pater">