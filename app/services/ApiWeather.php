<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiWeather {

    public function getWeatherData(){

        $response = Http::get('https://www.meteosource.com/api/v1/free/point?place_id=Zwolle&sections=current&language=en&units=auto&key=07izgkr6ndizt3pwguwam9lfn26ksul7w3xx2gel');

        return $response->json();
    }
}


