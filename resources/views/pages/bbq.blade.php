
@extends('layouts.app')

@section('title', 'bbq-weather')

@section('content')
<div class="container mx-auto p-4">
    

    <div class="bg-gray-200 text-gray-800 p-4 rounded-md shadow-md max-w-md mx-auto sm:max-w-xl lg:max-w-3xl">
        <div class="bg-gray-300 text-grey-800 text-center text-lg sm:text-xl lg:text-2xl p-3 rounded-t-md mb-5">
            <h1 class="text-3xl font-bold mb-4">Is it a good day for a bbq?</h1>
        </div>
        
        <h2 class="text-2xl font-bold mb-4 text-{{ $msgColor }}-500"> {{ $isBbqWeather. $msgIndicator }} </h2>
        <p class="font-bold mb-4 " > {{ "- temperature: ". $weatherData['current']['temperature']. "°C"}}</p>
        <p class="font-bold mb-4" > {{ "- precipiation: ". $weatherData['current']['precipitation']['total']. "mm/h"}}</p>
        <p class="font-bold mb-4" > {{ "- wind speed: ". $weatherData['current']['wind']['speed']. "m/s"}}</p>
        <p class="font-bold mb-4" > {{ "- cloud cover: ". $weatherData['current']['cloud_cover']. "%" }} </p>
    </div>
</div>
<div class="bg-gray-200 text-gray-800 p-4 rounded-md shadow-md max-w-md mx-auto sm:max-w-xl lg:max-w-3xl flex items-center justify-center">
    <iframe class="rounded-md" width="650" height="450" src="https://embed.windy.com/embed.html?type=map&location=coordinates&metricRain=mm&metricTemp=°C&metricWind=m/s&zoom=10&overlay=wind&product=ecmwf&level=surface&lat=52.533&lon=6.164&message=true" frameborder="0"></iframe>    
</div>

@endsection