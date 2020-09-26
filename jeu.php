<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require 'functions.php';

$parfums = [
    'Fraise' => 4,
    'Chocolat' => 5,
    'Vanille' => 3
];

$cornets = [
    'Pot' => 2,
    'Cornet' => 3
];

$supplements = [
    'Pepites chocolat' => 1,
    'Chantilly' => .5
];

$glaces = [
    'Parfums' => $parfums,
    'Cornets' => $cornets,
    'Supplements' => $supplements
];

/*$glaces[] = null;

$parfums = $_GET['parfums'];
//$cornets = $_GET['cornets'];
$supplements = $_GET['supplements'];

if ($_GET['cornets'][0] === 'cornet') {
    $cornets = ['cornet' => 3];
} else {
    $cornets = ['pot' => 2];
}



$totalPrice = calcPrice($glaces);
*/
?>


    <?php createForm($glaces); 
        calcPrice($glaces, $_GET);
    ?>

</body>
</html>