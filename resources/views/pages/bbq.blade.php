
@extends('layouts.app')

@section('title', 'bbq-weather')

@section('content')

<div class="container mx-auto p-4">
    <div class="flex flex-wrap justify-center gap-4">
        <div class="bg-gray-200 text-gray-800 p-4 rounded-md shadow-md max-w-md sm:max-w-xl lg:max-w-3xl">
            <div class="bg-gray-300 text-grey-800 text-center text-lg sm:text-xl lg:text-2xl p-3 rounded-t-md mb-5">
                <h1 class="text-3xl font-bold mb-4">BBQ indicator</h1>
            </div>
            
            <h2 class="text-3xl font-bold mb-4 text-{{ $msgColor }}-500"> {{ $isBbqWeather. $msgIndicator }} </h2>
            <div class="flex flex-wrap gap-4">
                <div class="bg-gray-300 text-grey-800 text-left text-lg sm:text-xl lg:text-2xl p-3 rounded-md">
                    <h3 class="font-bold mb-4">Forecasted weather:</h3>
                    <p class="font-bold mb-4"> {{ "- temperature: ". $weatherData['daily']['data'][0]['all_day']['temperature']. "°C" }}</p>
                    <p class="font-bold mb-4"> {{ "- precipitation: ". $weatherData['daily']['data'][0]['all_day']['precipitation']['total']. "(mm total)" }}</p>
                    <p class="font-bold mb-4"> {{ "- wind speed: ". $weatherData['daily']['data'][0]['all_day']['wind']['speed']. "m/s" }}</p>
                    <p class="font-bold mb-4"> {{ "- cloud cover: ". $weatherData['daily']['data'][0]['all_day']['cloud_cover']['total']. "(% total)" }}</p>
                </div>
                <div class="bg-gray-300 text-grey-800 text-left text-lg sm:text-xl lg:text-2xl p-3 rounded-md">
                    <h3 class="font-bold mb-4">Current weather:</h3>
                    <p class="font-bold mb-4"> {{ "- temperature: ". $weatherData['current']['temperature']. "°C" }}</p>
                    <p class="font-bold mb-4"> {{ "- precipitation: ". $weatherData['current']['precipitation']['total']. "mm/h" }}</p>
                    <p class="font-bold mb-4"> {{ "- wind speed: ". $weatherData['current']['wind']['speed']. "m/s" }}</p>
                    <p class="font-bold mb-4"> {{ "- cloud cover: ". $weatherData['current']['cloud_cover']. "%" }}</p>
                </div>
                <form method="POST" action="/bbq">
                    @csrf
                    <h2 class="font-bold mb-4">Location: @if($errors->has('location')) {{ $errors->first('location'). ' (Location is set to Zwolle)' }} @else {{$location }} @endif</h2> 
                    <input type="text" name="location" id="location">
                </form>
            </div>
        </div>
    </div>
    <div class="bg-gray-200 text-gray-800 p-4 rounded-md shadow-md max-w-full sm:max-w-xl lg:max-w-3xl mt-4 mx-auto">
        <iframe class="rounded-md w-full max-w-full" height="450" src="https://embed.windy.com/embed.html?type=map&location=coordinates&metricRain=mm&metricTemp=°C&metricWind=m/s&zoom=10&overlay=wind&product=ecmwf&level=surface&lat=52.533&lon=6.164&message=true" frameborder="0"> </iframe>
    </div>
</div>

@endsection