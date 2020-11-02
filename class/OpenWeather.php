<?php
require_once 'CurlException.php';
require_once 'HTTPException.php';

/**
 * Manage Open Weather Map API
 * 
 * @author Guilherme Cima <guilherme.cimabatista@gmail.com>
 */
class OpenWeather
{
    private $api_key;

    public function __construct(string $api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Call Open Weather API
     *
     * @param  string $endpoint Type of action to call + the weather location (weather?q= or forecast?q=)
     * @throws CurlException Curl gets an error
     * @throws HTTPException URL error
     * @throws UnauthorizedHTTPException API error
     * @return array
     */
    private function askApi(string $endpoint): ?array
    {
        $curl = curl_init('http://api.openweathermap.org/data/2.5/' . $endpoint . '&appid=' . $this->api_key . '&units=metric&lang=fr');
        curl_setopt_array($curl, [
            CURLOPT_CAINFO => 'cert.cer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);

        if ($data === false) {
            throw new CurlException($curl);
        }
        $HTTP_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($HTTP_code !== 200) {
            curl_close($curl);
            if ($HTTP_code === 401) {
                $data = json_decode($data, true);
                throw new UnauthorizedHTTPException($data['message'], 401);
            }
            throw new HTTPException($data, $HTTP_code);
        } else {
            return json_decode($data, true);
        }
        curl_close($curl);
    }

    /**
     * Get weather forecast for the next hours or next days at given hour
     *
     * @param  string $location City (ex: "Paris" or "Paris,fr")
     * @param  int $frequency (optional) Hour UTC (must be: 0 || 3 || 6 || 9 || 12 || 15 || 18 || 21) it will give weather for the next 5 days at choosen hour
     * @return array[]
     */
    public function getForecast(string $location, $frequency = 'all'): array
    {
        $data = $this->askApi('forecast?q=' . $location);


        foreach ($data['list'] as $day) {
            $local_timestamp = $day['dt'] + $data['city']['timezone'];
            if (gmdate('H', $day['dt']) == $frequency || $frequency === 'all') {
                $forecasts[] = [
                    'temp' => $day['main']['temp'],
                    'description' => $day['weather'][0]['description'],
                    'date' => new DateTime("@$local_timestamp")
                ];
            }
        }

        return $forecasts;
    }

    /**
     * Get last report weather
     *
     * @param  string $location City (ex: "London" or "London,en")
     * @return array
     */
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
