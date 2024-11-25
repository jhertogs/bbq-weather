<?php

use App\Http\Controllers\ApiWeatherController;
use App\Http\Controllers\LocationFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/welcome');
});


Route::get('/bbq', [ApiWeatherController::class, 'checkBBQWeather']);
Route::post('/bbq', [ApiWeatherController::class, 'checkBBQWeather']);

//Route::post('/bbq', [LocationFormController::class, 'getLocation'] ); 

//Route::match(['GET', 'POST'], '/bbq', [ApiWeatherController::class, 'getLocation', 'checkBBQWeather'] );