<?php

namespace App\Wrappers;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class Currencies
{
    const CURRENCY_URL = 'https://api.loftchain.io/api/tx/2';

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get(): Collection
    {
        try {
            $response = $this->client->get(self::CURRENCY_URL);
            return collect(json_decode($response->getBody(), true));
        } catch (\Exception $e) {
            return collect(['error' => $e->getMessage()]);
        }
    }
}