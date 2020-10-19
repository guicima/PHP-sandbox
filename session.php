<?php
session_start();
$_SESSION['role'] = 'admin';
require 'functions.php';
require 'elements' . DIRECTORY_SEPARATOR . 'header.php';
?>
<div class="starter-template">
    <h1>Hello world</h1>
    <?= dump($_SESSION) ?>
</div>

<?php
require 'elements' . DIRECTORY_SEPARATOR . 'footer.php';
?>