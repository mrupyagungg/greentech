<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $client = new Client();
        $response = $client->get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");
        $data = json_decode($response->getBody(), true);

        if ($data['cod'] !== 200) {
            return response()->json(['error' => 'City not found'], 404);
        }

        return response()->json([
            'temperature' => $data['main']['temp'],
            'pressure' => $data['main']['pressure'],
            'humidity' => $data['main']['humidity'],
            'description' => $data['weather'][0]['description']
        ]);
    }
}
