<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client();

try {
    // Example 1: Making a GET request to retrieve a country list
    $url1 = "https://continentl.com/api/country-list?page=1&key=sk-CPAS65448653cfaa735";
    $response1 = $client->request('GET', $url1);
    echo "Example 1 Response: " . $response1->getBody() . "\n";
} catch (RequestException $e) {
    echo "Example 1 Error: " . $e->getMessage() . "\n";
}

try {
    // Example 2: Making a GET request to retrieve a currency list
    $url2 = "https://continentl.com/api/currency-list?key=sk-CPAS65448653cfaa735";
    $response2 = $client->request('GET', $url2);
    echo "Example 2 Response: " . $response2->getBody() . "\n";
} catch (RequestException $e) {
    echo "Example 2 Error: " . $e->getMessage() . "\n";
}

// Prompt the user for a currency code
echo "Enter a currency code (e.g., USD, EUR): ";
$currencyCode = readline();

try {
    // Example 3: Fetch currency exchange details for the user-provided currency code
    $url3 = "https://continentl.com/api/currency-exchange-details/$currencyCode?key=sk-CPAS65448653cfaa735";
    $response3 = $client->request('GET', $url3);
    echo "Example 3 Response for $currencyCode: " . $response3->getBody() . "\n";
} catch (RequestException $e) {
    echo "Example 3 Error: " . $e->getMessage() . "\n";
}

try {
    // Example 4: Making a GET request to retrieve currency exchange details
    $url4 = "https://continentl.com/api/currency-exchange?key=sk-CPAS65448653cfaa735";
    $response4 = $client->request('GET', $url4);
    echo "Example 4 Response: " . $response4->getBody() . "\n";
} catch (RequestException $e) {
    echo "Example 4 Error: " . $e->getMessage() . "\n";
}

try {
    // Example 5: Fetch exchange rates using exchangeratesapi.io
    $client = new Client([
        'base_uri' => 'http://api.exchangeratesapi.io/v1/',
    ]);
     
    $accessKey = 'sk-CPAS65448653cfaa735'; // Replace with your actual API access key

    $response5 = $client->request('GET', 'latest', [
        'query' => [
            'access_key' => $accessKey,
            'symbols' => 'USD', // Replace with the currency symbol you want to fetch
        ]
    ]);
     
    if ($response5->getStatusCode() == 200) {
        $body = $response5->getBody();
        $data = json_decode($body, true);
        print_r($data);
    }
} catch (Exception $e) {
    echo "Example 5 Error: " . $e->getMessage();
}
