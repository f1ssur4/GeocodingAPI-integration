<?php

namespace App;

use App\Http\Api\ApiServiceClient;
use App\Models\RequestData;

class RequestDataHandler
{
    private $apiClient;
    public $address;
    public $latitude;
    public $longitude;
    public $arrayData;
    public $cityName;

    public function __construct(ApiServiceClient $client)
    {
        $this->apiClient = $client;
    }

    public function prepareData($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->arrayData = $this->getArrayData();
        $this->address = $this->getAddress();
        $this->cityName = $this->getCityName();

    }

    public function getArrayData(): array
    {
        try {
            $jsonData = $this->apiClient->getDataJson($this->latitude, $this->longitude);
            $this->arrayData = json_decode($jsonData->getBody(), true);
//            var_dump($this->arrayData);die;
            return $this->arrayData;
        }catch (\Exception $e){
            die('data incorrectly');
        }

    }

    public function getAddress()
    {
        return $this->address = $this->arrayData['results'][0]['formatted_address'];
    }

    public function getCityName()
    {
        if (isset($this->arrayData['plus_code']['compound_code'])){
            foreach ($this->arrayData['results'][0]['address_components'] as $address_component) {
                if ($address_component['types'] === ['locality', 'political']){
                   return $this->cityName = $address_component['long_name'];
                }
            }
        }else{
            return $this->cityName = 'none';
        }

    }

    public function resultData(): array
    {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'regions_cities_id' => $this->cityName,
        ];
    }
}
