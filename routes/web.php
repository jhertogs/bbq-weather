<?php

use App\Http\Controllers\ApiWeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/welcome');
});

Route::get('/bbq', [ApiWeatherController::class, 'checkBBQWeather']);
Route::post('/bbq', [ApiWeatherController::class, 'checkBBQWeather']);