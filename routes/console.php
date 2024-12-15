<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\getHourlyData;
use App\Services\ApiWeather;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->hourly();



Artisan::command('app:get-hourly-data', function() {
    $apiWeather = new ApiWeather;
    $getHourlyData = new getHourlyData($apiWeather);
    $getHourlyData->handle();

});

Schedule::command('app:get-hourly-data')->hourly();