<?php

/*
$notes = [];
$action = null;
while ($action !== 'fin') {
    $action = readline('Entrez une note : ');
    if ($action !== 'fin') {
        $notes[] = (int)$action;
    }
}

foreach ($notes as $note) {
    echo "- $note \n";
}


$action = null;
$ask = null;

while (true) {
    $open = readline('Entrez une heure d\'ouverture :');
    $close = readline('Entrez une heure de fermeture :');
    if ($open == 'fin' || $close == 'fin') {
        break;
    } elseif ($open > 24 || $close > 24 || $open > $close) {
       echo "Plage horaire invalide \n" ;
    }
    else {
        $horaires[] = [$open, $close];
        $action = readline('Voulez-vous entrer une nouvelle plage horaire? O/N ');
        if ($action !== 'o') {
        break;
        } 
    }
}
echo 'Le magasin est ouvert de';
foreach ($horaires as $key => $heure) {
    if ($key > 0) {
        echo ' et de';
    }
    echo " {$heure[0]}h à {$heure[1]}h";
}


$ask = (int)readline('Inserez une heure pour savoir si le magasin est ouvert : ');

$isOpen = false;

foreach ($horaires as $heure) {
    if ($ask >= $heure[0] && $ask <= $heure[1]) {
        $isOpen = true;
        break;
    }
}

if ($isOpen) {
    echo 'Le magasin sera ouvert';
} else {
    echo 'Malheureusement le magasin sera fermé';
}*/


$notes = [10, 12, 17, 22, 10, 5, 2, 0, 1];
$moyenne = array_sum($notes) / count($notes);
echo $moyenne;
?>