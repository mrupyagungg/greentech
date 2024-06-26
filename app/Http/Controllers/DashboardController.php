<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getWeather()
    {
        // Tetapkan kota secara statis
        $city = 'Bandung';
        $apiKey = env('OPENWEATHERMAP_API_KEY');

        // Buat klien Guzzle untuk mengirim permintaan ke API OpenWeatherMap
        $client = new Client();
        $response = $client->get("http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");
        $data = json_decode($response->getBody(), true);

        // Periksa apakah kota ditemukan
        if ($data['cod'] !== 200) {
            return response()->json(['error' => 'City not found'], 404);
        }

        // Kirim data cuaca dalam bentuk respons JSON
        return response()->json([
            'temperature' => $data['main']['temp'],
            'pressure' => $data['main']['pressure'],
            'humidity' => $data['main']['humidity'],
            'description' => $data['weather'][0]['description']
        ]);
    }
}
