<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <?php
    require_once 'config.php';
    require 'functions.php';
    ?>
</head>

<body>
    <h1>Menu</h1>
    <?php
    $lignes = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'menu.tsv');
    foreach ($lignes as $k => $ligne) {
        $lignes[$k] = explode("\t", trim($ligne));
    }
    ?>

    <?php foreach ($lignes as $ligne) : ?>
        <?php if (count($ligne) === 1) : ?>
            <h2><?= $ligne[0] ?></h2>
        <?php else : ?>
            <p>
                <strong><?= $ligne[0] ?></strong><br>
                <?= $ligne[1] ?>
                <strong><?= number_format($ligne[2], 2, ',', ' ') ?> €</strong>
            </p>
        <?php endif; ?>
    <?php endforeach; ?>


</body>

</html>