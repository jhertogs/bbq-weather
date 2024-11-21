<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ApiWeather;
use Str;

class ApiWeatherController extends Controller
{
    protected $apiWeather;

    public function __construct(ApiWeather $apiWeather){
        $this->apiWeather = $apiWeather;
    }

    public function checkBBQWeather(){

        $weatherData = $this->apiWeather->getWeatherData();
        $isBbqWeather = "unset";

        if($weatherData['current']['temperature'] > 15 && $weatherData['current']['precipitation']['total'] == 0 && $weatherData['current']['wind']['speed'] < 6 ){
            $isBbqWeather = "yes";
        }else {
        $isBbqWeather = "no";}


        return view('bbq', ['test' => $weatherData, 'isBbqWeather' => $isBbqWeather]);
    }
}
