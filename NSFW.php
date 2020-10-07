<?php
if (!empty($_GET['action']) && $_GET['action'] === 'deconnecte') {
    unset($_COOKIE['utilisateur']);
    setcookie('utilisateur', '', time() - 10);
}
if (!empty($_POST)) {
    setcookie('utilisateur', serialize($_POST));
}
require 'functions.php';
require 'elements' . DIRECTORY_SEPARATOR . 'header.php';
?>

<?php if (!empty($_COOKIE['utilisateur']) && isAdult($_COOKIE['utilisateur'])) : ?>
    <h1>Bienvenue</h1>
    <a href="profil.php?action=deconnecte">Se deconnecter</a>
<?php elseif (!empty($_COOKIE['utilisateur']) && !isAdult($_COOKIE['utilisateur'])) : ?>
    <h1 class="alert alert-danger">Vous n'etes pas majeur!</h1>
<?php else : ?>
    <form action="" method="post">
        <div class="form-group">
            <select name="day">
                <?php for ($day = 1; $day < 31; $day++) : ?>
                    <option value="<?= $day ?>"><?= $day ?></option>
                <?php endfor; ?>
            </select>
            <select name="month">
                <?php for ($month = 1; $month < 13; $month++) : ?>
                    <option value="<?= $month ?>"><?= $month ?></option>
                <?php endfor; ?>
            </select>
            <select name="year">
                <?php for ($year = (int)date('Y'); $year > 1920; $year--) : ?>
                    <option value="<?= $year ?>"><?= $year ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <button class="btn btn-primary">Entrer dans le site</button>
    </form>
<?php endif; ?>

<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>