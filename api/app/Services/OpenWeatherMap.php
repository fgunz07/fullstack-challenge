<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenWeatherMap {

  private $apiKey;
  private $weatherApi;

  public function __construct(string $key) {
    $this->apiKey = $key;
    $this->weatherApi = env("OPEN_WEATHER_MAP_HOST", "https://api.openweathermap.org/data/2.5/weather");
  }

  public function getCurrentWeather(float $lat, float $lng): mixed {

    $response = Http::acceptJson()->timeout(0.5)
      ->get($this->weatherApi."?lat=".$lat."&lon=".$lng."&appid=".$this->apiKey);

    // Response is ok true
    if($response->ok()) {
      return $response->json();
    }

    // Response is not ok
    // Log the response
    Log::error($response->json());

    // return message
    return "Request to the weather api errored.";

  }

}