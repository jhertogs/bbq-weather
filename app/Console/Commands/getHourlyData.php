<?php

namespace App\Console\Commands;

use App\Services\ApiWeather;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\DataModel;

class getHourlyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-hourly-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and store data every hour';


    /**
     * The API Weather service instance.
     *
     * @var ApiWeather
     */
    protected $apiWeather;

    /**
     * Execute the console command.
     */


    public function __construct(ApiWeather $apiWeather){
        parent::__construct();
        $this->apiWeather = $apiWeather;
    }
    public function handle()
    {        
        $this->apiWeather->setLocation('Zwolle');
        $weatherData =  $this->apiWeather->getWeatherData();
        $currentTemp= $weatherData['current']['temperature'];
        $currentPrecip = $weatherData['current']['precipitation']['total'];
        $currentWind = $weatherData['current']['wind']['speed'];
        //dd();
        

        DataModel::create([
            'temp' => $currentTemp, 
            'precip' => $currentPrecip, 
            'wind' => $currentWind
        ]);
    
    }
}
