
@extends('layouts.app')

@section('title', 'bbq-weather')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">Is it a good day for a bbq?</h1>
    
    <p> {{ $isBbqWeather }} </p>
    <p> {{ "temperature: ". $weatherData['current']['temperature']. "°C"}}</p>
    <p> {{ "precipiation: ". $weatherData['current']['precipitation']['total']. "mm/h"}}</p>
    <p> {{"wind speed: ". $weatherData['current']['wind']['speed']. "m/s"}}</p>
    <p> {{"cloud cover: ". $weatherData['current']['cloud_cover']. "%" }} </p>
</div>
@endsection