<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Services\ApiWeather;
use App\Models\DataModel;
use Illuminate\Support\Carbon;

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

        $currentPrecip = $weatherData['current']['precipitation']['total'];
        $currentTemp = $weatherData['current']['temperature'];

        $test = DataModel::latest()->first();
        if($test){
            $latestDate = $test['created_at'];
            $crntDate = Carbon::now();

            if($latestDate->diffInHours($crntDate) >= 1){
                DataModel::create(['temp' => $currentTemp, 'precip' => $currentPrecip]);
            }
        }else{
            DataModel::create(['temp' => $currentTemp, 'precip' => $currentPrecip]);
        }

        if($forecastedTemp > 15 && $forecastedPrecip == 0 && $forecastedWind < 15){
            if($forecastedCloudCover < 50){
                $isBbqWeather = "perfect day for a bbq";
                $msgColor = "green";
                $msgIndicator = "😀";
            }elseif($forecastedCloudCover >= 50){
                $isBbqWeather = "good bbq day but cloudy";
                $msgColor = "blue";
                $msgIndicator = "🙂";
            }
            
        }else {
            $isBbqWeather = "it is a bad day for a bbq";
            $msgColor = "red";
            $msgIndicator = "☹";
        }

        $tempData = DB::table('data_models')->select('temp', 'created_at')->get();

        $labels = $tempData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i');
        })->toArray();
        
        //dd($dates);
        $values = $tempData->pluck('temp');


        return view('pages/bbq', [
            'weatherData' => $weatherData,
            'isBbqWeather' => $isBbqWeather,
            'msgColor' => $msgColor,
            'msgIndicator' => $msgIndicator,
            'location' => $location,
            'labels' => $labels,
            'values' => $values
        ]);
    }
}
