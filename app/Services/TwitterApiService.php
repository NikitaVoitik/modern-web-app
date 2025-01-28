<?php

namespace App\Services;

use Exception;
use Http;
use Illuminate\Support\Facades\Cache;

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
        $cachedTrends = Cache::get('twitter_trends');

        if ($cachedTrends) {
            return $cachedTrends;
        }
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
            Cache::put('twitter_trends', $trends, 60);
        } catch (Exception $e) {
            report($e);
            return [[
                "name" => "Something Happened",
                "description" => "Please try again later",
                "context" => "Application Error"]
            ];
        }

        return $trends;
    }
}
