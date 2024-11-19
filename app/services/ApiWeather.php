<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiWeather {

    public function getWeatherData(){

        $response = Http::get('https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&current=temperature_2m,
        relative_humidity_2m,apparent_temperature,is_day,precipitation,rain,showers,snowfall,cloud_cover,
        wind_speed_10m,wind_direction_10m,wind_gusts_10m&models=icon_seamless');

        return $response->json();
    }
}


