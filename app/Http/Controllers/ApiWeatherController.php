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

        $temperature = $weatherData['current']['temperature'];
        $precipitation = $weatherData['current']['precipitation']['total'];
        $windSpeed =  $weatherData['current']['wind']['speed'];
        $cloudCover = $weatherData['current']['cloud_cover'];

        if($temperature > 15 && $precipitation == 0 && $windSpeed < 15){
            if($cloudCover < 50){
                $isBbqWeather = "perfect day for a bbq";
                $msgColor = "green";
                $msgIndicator = "😀";
            }
            $isBbqWeather = "good bbq day but cloudy";
            $msgColor = "blue";
            $msgIndicator = "🙂";
        }else {
            $isBbqWeather = "it is a bad day for a bbq";
            $msgColor = "red";
            $msgIndicator = "☹";
        }
        return view('pages/bbq', ['weatherData' => $weatherData, 'isBbqWeather' => $isBbqWeather, 'msgColor' => $msgColor, 'msgIndicator' => $msgIndicator]);
    }
}
