<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleMaps
{
    protected ?string $apiKey;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
        
        if (!$this->apiKey) {
            throw new \Exception('Google Maps API key is not configured. Please set GOOGLE_MAPS_API_KEY in your .env file.');
        }
    }

    public function getNearestCity(float $latitude, float $longitude): ?string
    {
        $url = 'https://maps.googleapis.com/maps/api/geocode/json';

        $response = Http::get($url, [
            'latlng' => "$latitude,$longitude",
            'key' => $this->apiKey,
        ]);

        if ($response->failed()) {
            return null;
        }

        $results = $response->json('results');

        // dd($results);

        foreach ($results as $result) {
            foreach ($result['address_components'] as $component) {
                if (in_array('locality', $component['types'])) {
                    return $component['long_name'];
                }
            }
        }

        // fallback: administrative_area_level_1 or 2
        foreach ($results as $result) {
            foreach ($result['address_components'] as $component) {
                if (in_array('administrative_area_level_1', $component['types']) || in_array('administrative_area_level_2', $component['types'])) {
                    return $component['long_name'];
                }
            }
        }

        return null;
    }
}
