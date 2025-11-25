<?php

declare(strict_types=1);

namespace Modules\Geo\Actions\Weather;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetOpenWeatherDataAction
{
    private const ENDPOINT = 'https://api.openweathermap.org/data/2.5/weather';

<<<<<<< HEAD
    public function execute(float $latitude, float $longitude): null|array
=======
    public function execute(float $latitude, float $longitude): ?array
>>>>>>> bc26394 (.)
    {
        try {
            $response = Http::get(self::ENDPOINT, [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => config('services.openweather.api_key'),
                'units' => 'metric',
                'lang' => 'it',
            ]);

<<<<<<< HEAD
            if (!$response->successful()) {
=======
            if (! $response->successful()) {
>>>>>>> bc26394 (.)
                return null;
            }

            $data = $response->json();

<<<<<<< HEAD
            if (!is_array($data)) {
=======
            if (! is_array($data)) {
>>>>>>> bc26394 (.)
                return null;
            }

            return [
                'temperature' => Arr::get($data, 'main.temp'),
                'feels_like' => Arr::get($data, 'main.feels_like'),
                'humidity' => Arr::get($data, 'main.humidity'),
                'pressure' => Arr::get($data, 'main.pressure'),
                'weather' => [
                    'main' => Arr::get($data, 'weather.0.main'),
                    'description' => Arr::get($data, 'weather.0.description'),
                    'icon' => Arr::get($data, 'weather.0.icon'),
                ],
                'wind' => [
                    'speed' => Arr::get($data, 'wind.speed'),
                    'direction' => Arr::get($data, 'wind.deg'),
                ],
                'clouds' => Arr::get($data, 'clouds.all'),
                'timestamp' => Arr::get($data, 'dt'),
            ];
        } catch (Exception $e) {
<<<<<<< HEAD
            Log::error('OpenWeather API error: ' . $e->getMessage());
=======
            Log::error('OpenWeather API error: '.$e->getMessage());
>>>>>>> bc26394 (.)

            return null;
        }
    }
}
