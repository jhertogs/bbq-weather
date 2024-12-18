<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiWeather {

    protected $location;
    public function setLocation(string $location){

        $this->location = $location;
    
    }

    public function getWeatherData(){

        if(!$this->location){
            throw new \Exception('location not set');
        }

        $response = Http::get('https://www.meteosource.com/api/v1/free/point?place_id='. $this->location .'&sections=current%2C%20daily&timezone=UTC&language=en&units=metric&key=07izgkr6ndizt3pwguwam9lfn26ksul7w3xx2gel');

        if($response->getStatusCode() != 400){
            return $response->json();
        }else{
            return ['error' => 'invalid location!'];
        }
        
        
    }

    public function getWeatherDataStandard(){
        //location: Zwolle (standard)
        $response = Http::get('https://www.meteosource.com/api/v1/free/point?place_id=Zwolle&sections=current%2C%20daily&timezone=UTC&language=en&units=metric&key=07izgkr6ndizt3pwguwam9lfn26ksul7w3xx2gel');
        return $response->json();
    }
}


