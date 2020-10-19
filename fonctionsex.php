<?php

$insultes = ['merde', 'con', 'bite', 'pute'];
$censure = [];
foreach ($insultes as $insulte) {

        $censure[] = $insulte[0].str_repeat('*', (strlen($insulte)-1));
    }

while (true) {
    $entry = readline('Entrez un mot : ');
    $entry = str_replace($insultes, $censure, $entry);
    
    if ($entry == 'exit') {
        exit('Fin du programme');
    } else {
        echo "$entry \n";
    }
}
