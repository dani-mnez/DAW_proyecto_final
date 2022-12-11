<?php
    include_once(__DIR__ . '/../../modules/functions.php');
    include_once(__DIR__ . '/../../modules/classes.php');
    include_once(__DIR__ . '/../../modules/init_code.php');

    $baseName = basename($_SERVER['SCRIPT_FILENAME'], ".php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="preload" href="/DAW_proyecto_final/assets/fonts/Mona-Sans.woff2" as="font" type="font/woff2" crossorigin>
        <link rel="stylesheet" href="/DAW_proyecto_final/styles/css/styles.css">
        <script type="text/javascript" src="/DAW_proyecto_final/lib/functions.js"></script>
        <script type="text/javascript" src="/DAW_proyecto_final/lib/early_scripts.js"></script>
        <title><?php echo getTitle($baseName) ?></title>
        <link rel="icon" type="image/jpg" href="/DAW_proyecto_final/assets/img/ico.ico"/>
    </head>
    <body class="<?php echo bodyClassGen($baseName) ?>" data-page="<?php echo $baseName ?>">
        <div id="main_frame">
            <?php include_once(__DIR__ . '/main_menu.php'); ?>
