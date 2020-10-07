<?php

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecte') {
    unset($_COOKIE['utilisateur']);
    setcookie('utilisateur', '', time() - 10);
}
if (!empty($_POST['nom'])) {
    setcookie('utilisateur', $_POST['nom']);
}
require 'functions.php';
require 'elements' . DIRECTORY_SEPARATOR . 'header.php';
?>

<?php if (!empty($_COOKIE['utilisateur'])) : ?>
    <div class="alert alert-success">Bienvenu(e) <?= $_COOKIE['utilisateur'] ?></div>
    <a href="profil.php?action=deconnecte">Se deconnecter</a>
<?php else : ?>
    <form action="" method="post">
        <div class="form-group">
            <input class="form-control" type="text" name="nom" placeholder="Entrez votre nom">
        </div>
        <button class="btn btn-primary">Se connecter</button>
    </form>
<?php endif; ?>


<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>