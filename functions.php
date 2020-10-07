<?php
/*function calcPrice($mainArray) {
    foreach ($mainArray as $array) {
        if ($array != null) {
            $result[] = array_sum($array);
        }
    }
    return array_sum($result);
}

function printGlace($mainArray) {
    foreach ($mainArray as $array) {
        if (isset($array)) {
            foreach ($array as $key => $value) {
               echo "$key = $value € \n";
            }
        }
    }
}*/

function dump($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
}

function calcPrice($mainArray, $finder)
{
    foreach ($mainArray as $arrayName => $array) {
        foreach ($array as $name => $price) {
            if (in_array($name, $finder[$arrayName])) {
                echo "<p> $name = $price €</p>";
                $totalPrice[] = $price;
            }
        }
    }
    echo '<p>Total = ' . array_sum($totalPrice) . ' €<p>';
}

function isChecked($value, $array)
{
    if (isset($array) && in_array($value, $array)) {
        return 'checked';
    }
}

function radio($category)
{
    if ($category === 'Cornets') {
        return 'radio';
    } else {
        return 'checkbox';
    }
}

function createForm($mainArray)
{
    echo '<form action="/jeu.php" method="GET">';
    foreach ($mainArray as $arrayName => $array) {
        echo '<h2>' . $arrayName . '</h2><br>';
        foreach ($array as $key => $value) {
            echo '<label><input type="' . radio($arrayName) . '" name="' . $arrayName . '[]" value="' . $key . '" ' . isChecked($key, $_GET[$arrayName]) . '>' . $key . ' : ' . $value . '€</label><br>';
        }
    }
    echo '<button type="submit">Composer</button></form>';
}

function creneaux_html(array $horaires, array $jours): string
{
    foreach ($horaires as $creneaux) {
        $heures = null;
        foreach ($creneaux as $creneau) {
            if (is_array($creneau)) {
                $heures[] = '<strong>' . implode('h</strong> à <strong>', $creneau) . 'h</strong>';
            }
        }
        if (empty($creneaux[0])) {
            $plage_horaires[] =  'Fermé';
        } else {
            $plage_horaires[] = 'Ouvert de ' . implode(' et de ', $heures);
        }
    }
    foreach ($jours as $i => $jour) {
        $emphase = "";
        if ($i + 1 === (int)date('N')) {
            $emphase = ' style="color: green;"';
        }
        $result[] = '<li' . $emphase . '><strong>' . $jour . ' : </strong>' . $plage_horaires[$i] . '.</li>';
    }
    return implode($result);
}

function isOpen(array $hours_array): string
{
    $jour = $hours_array[(int)date('N') - 1];
    $actual_time = (int)date('G');
    foreach ($jour as $hour) {
        if ($actual_time >= $hour[0] && $actual_time < $hour[1]) {
            return '<li style="color: green">Votre magasin est ouvert</li>';
        }
    }
    return '<li style="color: red">Votre magasin est fermé</li>';
}

function canICome(int $day, int $hour, array $hour_array): bool
{
    foreach ($hour_array[$day] as $plage_horaire) {
        if ($hour >= $plage_horaire[0] && $hour < $plage_horaire[1]) {
            return true;
        }
    }
    return false;
}

function select(string $name, array $days, $user)
{
    echo "<select name=\"$name\" id=\"$name\">";
    foreach ($days as $key => $jour) {
        echo "<option value=\"$key\"";
        if (isset($user) && (int)$user === $key || (int)date('N') === $key + 1) {
            echo " selected ";
        }
        echo ">$jour</option>";
    }
    echo "</select>";
}

function newsletter($data)
{
    if (isset($data)) {
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . date("Ymd"), "$data, ", FILE_APPEND);
    }
}

function isAdult(string $cookie_serial): bool
{
    $birthdate = unserialize($cookie_serial);
    $age = (int)date('Y') - (int)$birthdate['year'];
    if ((int)date('md') < (int)$birthdate['month'] . (int)$birthdate['day']) {
        $age--;
    }
    if ($age < 18) {
        return false;
    } else {
        return true;
    }
}
