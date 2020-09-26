<?php

function repondre_oui_non(string $phrase): bool {
    while (true) {
        $ask = readline("$phrase o/n ");
        if ($ask === 'o' || $ask === 'oui') {
            return true;
        } elseif ($ask === 'n' || $ask === 'non') {
            return false;
        }
    }
}

function askCreneau(string $phrase = "Inserer un creneau :") {
    while (true) {
        echo $phrase . "\n";
        $open = readline('Entrez une heure d\'ouverture :');
        $close = readline('Entrez une heure de fermeture :');
        if ($open > 24 || $close > 24 || $open > $close) {
           echo "Plage horaire invalide \n" ;
        }
        else {
            return [$open, $close];
        } 
    }
}

function askPlage(string $phrase = "Inserez une plage horaire :"): array {
    $creneaux = [];
    $continue = true;
    while ($continue) {
       $creneaux[] = askCreneau($phrase);
       $continue = repondre_oui_non('Voulez-vous entrer une nouvelle plage horaire ? ');
    }
    return $creneaux;
}
//$result = repondre_oui_non('Voulez vous continuer ?');
$result = askPlage();
var_dump($result);

?>