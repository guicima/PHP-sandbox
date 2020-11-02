<?php

declare(strict_types=1);

require 'class' . DIRECTORY_SEPARATOR . 'OpenWeather.php';
$weather = new OpenWeather('110d03b6ee7a4034724e67096d84d4ea');
$error = null;
try {
    $forecasts = $weather->getForecast('Metz', 13);
    $actualweather = $weather->getActual('Metz');
} catch (CurlException $e) {
    exit($e->getMessage());
} catch (HTTPException $e) {
    $error = $e->getCode() . ' : ' . $e->getMessage();
} catch (Error $e) {
    $error = $e->getMessage();
}
?>

<?php if ($error) : ?>

    <div><?= $error ?></div>

<?php else : ?>

    <ul>
        <?php foreach ($forecasts as $forecast) : ?>
            <li><?= $forecast['date']->format('d/m/Y à H\h') ?> : <strong><?= $forecast['temp'] ?>°C</strong> <?= $forecast['description'] ?></li>
        <?php endforeach ?>
    </ul>

    <p><?= $actualweather['date']->format('d/m/Y à H\h') ?> : <strong><?= $actualweather['temp'] ?>°C</strong> <?= $actualweather['description'] ?></p>

<?php endif ?>