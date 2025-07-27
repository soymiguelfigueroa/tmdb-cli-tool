<?php

namespace Mfigu\TmdbCliTool\Classes;

use GuzzleHttp\Client;

class Movies
{
    public static function getMovies(string $type): array
    {   
        print_r(gettype($_ENV['TMDB_API_VERIFY']));
        try {
            $client = new Client([
                'base_uri' => 'https://api.themoviedb.org/3/',
                'headers' => [
                    'Authorization' => 'Bearer ' . $_ENV['TMDB_API_KEY'],
                    'accept' => 'application/json',
                ],
                'verify' => (boolean) $_ENV['TMDB_API_VERIFY'],
            ]);

            switch ($type) {
                case 'playing':
                    $response = $client->get('movie/now_playing');
                    $result = [
                        'data' => json_decode($response->getBody()->getContents(), true) ?? [],
                        'status_message' => 'Successfully fetched currently playing movies.'
                    ];
                    return $result;

                case 'popular':
                    $response = $client->get('movie/popular');
                    $result = [
                        'data' => json_decode($response->getBody()->getContents(), true) ?? [],
                        'status_message' => 'Successfully fetched popular movies.'
                    ];
                    return $result;

                case 'top':
                    $response = $client->get('movie/top_rated');
                    $result = [
                        'data' => json_decode($response->getBody()->getContents(), true) ?? [],
                        'status_message' => 'Successfully fetched top movies.'
                    ];
                    return $result;

                case 'upcoming':
                    $response = $client->get('movie/upcoming');
                    $result = [
                        'data' => json_decode($response->getBody()->getContents(), true) ?? [],
                        'status_message' => 'Successfully fetched upcoming movies.'
                    ];
                    return $result;
                
                default:
                    $result = [
                        'data' => [
                            'results' => []
                        ],
                        'status_message' => 'Invalid type specified. Please use "playing", "popular", "top", or "upcoming".'
                    ];
                    return $result;
            }
        } catch (\Exception $e) {
            // Handle exceptions such as network errors or API errors
            return [
                'data' => [
                    'results' => []
                ],
                'status_message' => 'Error fetching movies: ' . $e->getMessage()
            ];
        }
    }
}