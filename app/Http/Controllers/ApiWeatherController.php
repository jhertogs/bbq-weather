<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Services\ApiWeather;
use App\Models\DataModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;


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
            $this->apiWeather->setLocation($location);
            $weatherData = $this->apiWeather->getWeatherData();
            
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

        
        //Artisan::call('app:get-hourly-data');

        //data for the graphs
        
        $precipDaily = [];
        $tempDaily = [];
        $windDaily = [];

        $days = [];
        $days2 = [];
        $days3 = [];
        
        for ($i = 0; $i < 7; $i++){
            $days[] = $weatherData['daily']['data'][$i]['day'];
            $precipDaily[] = $weatherData['daily']['data'][$i]['all_day']['precipitation']['total'];
        
        }
        for ($k = 0; $k < 7; $k++){
            $days2[] = $weatherData['daily']['data'][$k]['day'];
            $tempDaily[] = $weatherData['daily']['data'][$k]['all_day']['temperature'];
        }
        for ($x = 0; $x < 7; $x++){
            $days3[] = $weatherData['daily']['data'][$x]['day'];
            $windDaily[] = $weatherData['daily']['data'][$x]['all_day']['wind']['speed'];
        }

        //submits data to database
        //$test = DataModel::latest()->first();
        //if($test){
        //    $latestDate = $test['created_at'];
        //    $crntDate = Carbon::now();
//
        //    if($latestDate->diffInHours($crntDate) >= 1){
        //        DataModel::create(['temp' => $currentTemp, 'precip' => $currentPrecip]);
        //    }
        //}else{
        //    DataModel::create(['temp' => $currentTemp, 'precip' => $currentPrecip]);
        //}

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


        //get the data from database
        $tempData = DB::table('data_models')->select('temp', 'created_at')->get();
        $tempLabelsH = $tempData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i');
        })->toArray();
        $tempValuesH = $tempData->pluck('temp');

        $precipData = DB::table('data_models')->select('precip', 'created_at')->get();
        $precipLabelsH = $tempData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i');
        })->toArray();
        $precipValuesH = $precipData->pluck('precip');

        $windData = DB::table('data_models')->select('wind', 'created_at')->get();
        $windLabelsH = $windData->pluck('created_at')->map(function($date) {
            return Carbon::parse($date)->format('H:i');
        })->toArray();
        $windValuesH = $windData->pluck('wind');



        $precipValues = $precipDaily;
        $precipLabels = $days;
        $tempValues = $tempDaily;
        $tempLabels = $days2;
        $windValues = $windDaily;
        $windLabels = $days3;


        return view('pages/bbq', [
            'weatherData' => $weatherData,
            'isBbqWeather' => $isBbqWeather,
            'msgColor' => $msgColor,
            'msgIndicator' => $msgIndicator,
            'location' => $location,
            'precipLabels' => $precipLabels,
            'precipValues' => $precipValues,
            'tempValues' => $tempValues,
            'tempLabels' => $tempLabels,
            'windLabels' => $windLabels,
            'windValues' => $windValues,
            'tempLabelsH' => $tempLabelsH,
            'tempValuesH' => $tempValuesH,
            'precipLabelsH' => $precipLabelsH,
            'precipValuesH' => $precipValuesH,
            'windValuesH' => $windValuesH,
            'windLabelsH' => $windLabelsH
        ]);
    }
}
