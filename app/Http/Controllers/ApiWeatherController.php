<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiWeather;

class ApiWeatherController extends Controller
{
    protected $apiWeather;

    public function __construct(ApiWeather $apiWeather){
        $this->apiWeather = $apiWeather;
    }

    public function checkBBQWeather(){

        $weatherData = $this->apiWeather->getWeatherData();
        $weatherData2 = json_encode($weatherData);

        return view('bbq', ['weatherData2' => $weatherData2]);
    }
}
