<?php
class OpenWeather
{
    private $api_key;

    public function __construct(string $api_key)
    {
        $this->api_key = $api_key;
    }

    private function askApi(string $endpoint): ?array
    {
        $curl = curl_init('http://api.openweathermap.org/data/2.5/' . $endpoint . '&appid=' . $this->api_key . '&units=metric&lang=fr');
        curl_setopt_array($curl, [
            CURLOPT_CAINFO => 'cert.cer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);

        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        } else {
            return json_decode($data, true);
        }
        curl_close($curl);
    }

    public function getForecast(string $location, $frequency = 'all'): array //frequency will get daily forecast at given hour -- must be an int (every 3 hours) = 1 / 4 / 7 / 10 / 13 / 16 / 19 / 22
    {
        $data = $this->askApi('forecast?q=' . $location);

        foreach ($data['list'] as $day) {
            $local_timestamp = $day['dt'] + $data['city']['timezone'];
            if (gmdate('H', $local_timestamp) == $frequency || $frequency === 'all') {
                $forecasts[] = [
                    'temp' => $day['main']['temp'],
                    'description' => $day['weather'][0]['description'],
                    'date' => new DateTime("@$local_timestamp")
                ];
            }
        }

        return $forecasts;
    }

    public function getActual(string $location): array
    {
        $data = $this->askApi('weather?q=' . $location);

        $local_timestamp = $data['dt'] + $data['timezone'];

        $weather = [
            'temp' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'date' => new DateTime("@$local_timestamp")
        ];

        return $weather;
    }
}
