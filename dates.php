<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once 'config.php';
    require 'functions.php';
    date_default_timezone_set('Europe/Paris');
    $heure_actuelle = (int)date('G');
    $creneaux = creneaux_html(CRENEAUX, JOURS);
    $choix_jour = (int)$_POST['jour'];
    $choix_heure = (int)($_POST['heure']);
    $affichage_heure = (isset($_POST['heure'])) ? $choix_heure : $heure_actuelle;
    ?>
</head>

<body>
    <h2>Nous contacter</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, pariatur?</p>
    <div class="horaires">
        <ul>
            <?= isOpen(CRENEAUX) ?>
            <?= $creneaux ?>
        </ul>
    </div>

    <form action="/dates.php" method="post">
        <?php select('jour', JOURS, $_POST['jour']) ?>
        <input type="number" id="heure" name="heure" min="0" max="23" value="<?= $affichage_heure ?>">
        <input type="submit" value="Valider">
    </form>
    <?php
    if (isset($_POST['jour']) && isset($_POST['heure'])) {
        if (canICome($choix_jour, $choix_heure, CRENEAUX)) {
            echo '<p>Le magasin sera ouvert à l\'heure choisie</p>';
        } elseif (!canICome($choix_jour, $choix_heure, CRENEAUX)) {
            echo '<p>Le magasin sera fermé à l\'heure choisie</p>';
        }
    }
    ?>


</body>

</html>