<?php

namespace App\Services;

use Http;

class TwitterApiService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.twitter.base_url');
        $this->apiKey = config('services.twitter.api_key');
    }

    public function getTrends()
    {
        try {
            $endpoint = '/trends.php';

            $response = Http::withHeaders([
                'x-rapidapi-key' => $this->apiKey,
            ])->get($this->baseUrl . $endpoint);

            if ($response->failed()) {
                return [[
                    "name" => "Something Happened",
                    "description" => "Please try again later",
                    "context" => "Application Error"]
                ];
            }
            $trends = $response->json()["trends"];
        } catch (\Exception $e) {
            return [[
                "name" => "Something Happened",
                "description" => "Please try again later",
                "context" => "Application Error"]
            ];
        }

        return $trends;
    }
}
