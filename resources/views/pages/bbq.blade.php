<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bbq</title>
</head>
<body>
    <p>{{"is it bbq weather? "}}</p>
    <p> {{ $isBbqWeather }} </p>
    <p> {{ "temperature: ". $weatherData['current']['temperature']. "°C"}}</p>
    <p> {{ "precipiation: ". $weatherData['current']['precipitation']['total']. "mm/h"}}</p>
    <p> {{"wind speed: ". $weatherData['current']['wind']['speed']. "m/s"}}</p>
    <p> {{"cloud cover: ". $weatherData['current']['cloud_cover']. "%" }} </p>


    

    


</body>
</html>