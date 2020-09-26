<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once 'config.php';
    require 'functions.php';
    ?>
</head>

<body>
    <?php
    $chemin = __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv';
    $file = fopen($chemin, 'r');
    $a = 0;
    while ($text = fgets($file, 2)) {
        echo $text;
        if ($text === '    ') {
            break;
        }
    }
    fclose($file);
    ?>

</body>

</html>