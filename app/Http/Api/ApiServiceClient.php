<?php

namespace App\Http\Api;

use GuzzleHttp\Client;
use function config;


class ApiServiceClient
{
    private $httpClient;
    private $baseUri;
    private $key;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->baseUri = config('geocodingApi.uri');
        $this->key = config('geocodingApi.key');
    }

    public function getDataJson(float $latitude, float $longitude)
    {
        return $this->httpClient->post($this->baseUri, [
            'query' => [
                'latlng' => "$latitude,$longitude",
                'key' => $this->key,
            ],
        ]);

    }
}
