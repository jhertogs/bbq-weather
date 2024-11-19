<?php

use App\Http\Controllers\ApiWeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/bbq', [ApiWeatherController::class, 'checkBBQWeather']);