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

    public function checkBBQWeather(Request $request){
        $location = '';


        if($request->isMethod('post')){

            $location = $request->input('location');
            $weatherData = $this->apiWeather->getWeatherData($location);
            
            if(isset($weatherData['error']) && $weatherData['error'] === 'invalid location!'){
                //dd('it worke');
                
                return redirect()->back()->withErrors(['location' => $weatherData['error']]);

            }

        }else {
            $weatherData = $this->apiWeather->getWeatherDataStandard();
            $location = 'Zwolle';
        }

        $forecastedPrecip = $weatherData['daily']['data'][0]['all_day']['precipitation']['total'];
        $forecastedTemp = $weatherData['daily']['data'][0]['all_day']['temperature'];
        $forecastedWind = $weatherData['daily']['data'][0]['all_day']['wind']['speed'];
        $forecastedCloudCover = $weatherData['daily']['data'][0]['all_day']['cloud_cover']['total'];

        if($forecastedTemp > 15 && $forecastedPrecip == 0 && $forecastedWind < 15){
            if($forecastedCloudCover < 50){
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
        return view('pages/bbq', ['weatherData' => $weatherData, 'isBbqWeather' => $isBbqWeather, 'msgColor' => $msgColor, 'msgIndicator' => $msgIndicator, 'location' => $location]);
    }

    //public function getLocation(Request $request){
    //    if($request->isMethod('post')){
    //        $location = $request->input('location');
//
    //        return redirect()->back()->with('formData', ['location' => $location]);
    //    }
    //    return view('pages.bbq');
    //}
}
