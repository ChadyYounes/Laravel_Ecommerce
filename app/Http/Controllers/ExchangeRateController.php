<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function getExchangeRates()
    {
        // Initialize Guzzle client
        $client = new Client();

        // API endpoint URL
        $url = 'https://v6.exchangerate-api.com/v6/96c4bfcf9462e8a2c4748b48/latest/USD';

        try {
            // Send GET request to API
            $response = $client->request('GET', $url);

            // Check if response is successful (status code 200)
            if ($response->getStatusCode() == 200) {
                // Decode JSON response
                $data = json_decode($response->getBody(), true);

                // Check if API request was successful
                if ($data['result'] == 'success') {
                    // Access exchange rates
                    $exchangeRates = $data['conversion_rates'];

                    // Return exchange rates
                    return $exchangeRates;
                } else {
                    // API request failed, return error message
                    return ['error' => $data['error']];
                }
            } else {
                // API request failed, return error message
                return ['error' => 'API request failed with status code ' . $response->getStatusCode()];
            }
        } catch (\Exception $e) {
            // Exception occurred, return error message
            return ['error' => $e->getMessage()];
        }
    }
}
