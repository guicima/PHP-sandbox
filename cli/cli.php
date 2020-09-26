<?php
$chemin = __DIR__ . DIRECTORY_SEPARATOR . 'demo.txt';
file_put_contents($chemin, 'Salut les gens', FILE_APPEND);
