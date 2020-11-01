<?php
/*require 'functions.php';
$curl = curl_init('https://api.openweathermap.org/data/2.5/weather?q=Metz&appid=110d03b6ee7a4034724e67096d84d4ea&units=metric&lang=fr');
curl_setopt_array($curl, [
    CURLOPT_CAINFO => 'cert.cer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 1
]);
$data = curl_exec($curl);
if ($data === false) {
    var_dump(curl_error($curl));
} else {
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
        $data = json_decode($data, true);
        dump($data['main']['temp']);
    }
}
curl_close($curl);*/
require 'class' . DIRECTORY_SEPARATOR . 'OpenWeather.php';
$weather = new OpenWeather('110d03b6ee7a4034724e67096d84d4ea');
$forecasts = $weather->getForecast('Metz', 13);
$actualweather = $weather->getActual('Metz');
?>
<ul>
    <?php foreach ($forecasts as $forecast) : ?>
        <li><?= $forecast['date']->format('d/m/Y à H\h') ?> : <strong><?= $forecast['temp'] ?>°C</strong> <?= $forecast['description'] ?></li>
    <?php endforeach; ?>
</ul>

<p><?= $actualweather['date']->format('d/m/Y à H\h') ?> : <strong><?= $actualweather['temp'] ?>°C</strong> <?= $actualweather['description'] ?></p>