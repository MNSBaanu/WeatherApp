<?php

namespace WeatherApp;

use GuzzleHttp\Client;

class WeatherService
{
    private string $apiKey = 'c95b0f03d9d946c11de213af33b1af1a';
    private string $apiEndpoint = 'https://api.openweathermap.org/data/2.5/weather';
    private Client $client;

    public function __construct() {
        $this->client = new Client([
            'verify' => false // Disable SSL verification for testing
        ]);
    }

    public function getWeather(string $city): array
    {
        $response = $this->client->get($this->apiEndpoint, [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return [
            'city' => $data['name'],
            'temperature' => $data['main']['temp'],
            'description' => $data['weather'][0]['description'],
            'humidity' => $data['main']['humidity']
        ];
    }
}