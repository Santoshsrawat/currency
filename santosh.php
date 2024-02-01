<!DOCTYPE html>
<html>
<head>
    <title>Currency Exchange</title>
</head>
<body>
    <h1>Currency Exchange</h1>

    <form method="post">
        <label for="fromCurrency">From Currency:</label>
        <select name="fromCurrency" id="fromCurrency">
            <option value="USD">US Dollar</option>
            <option value="EUR">Euro</option>
            <option value="GBP">British Pound</option>
        </select>

        <br>

        <label for="toCurrency">To Currency:</label>
        <select name="toCurrency" id="toCurrency">
            <option value="USD">US Dollar</option>
            <option value="EUR">Euro</option>
            <option value="GBP">British Pound</option>
        </select>

        <br>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">

        <br>

        <input type="submit" value="Convert">
    </form>
</body>
</html>

<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $client = new Client();

        $accessKey = urlencode('sk-U3ni6544cb8bbf8c635        ');
 // Replace with your actual API access key

        $baseCurrency = $_POST['fromCurrency'];
        $targetCurrency = $_POST['toCurrency'];

        $response = $client->request('GET',  'https://continentl.com/api/currency-exchange-details/USD?key=sk-U3ni6544cb8bbf8c635
        ' . $accessKey, [
            'query' => [
                'base' => $baseCurrency,
                'symbols' => $targetCurrency,
            ]
        ]);
        

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $data = json_decode($body, true);

            if (isset($data['rates'][$targetCurrency])) {
                $exchangeRate = $data['rates'][$targetCurrency];
                $amount = floatval($_POST['amount']);

                // Perform the currency conversion
                $convertedAmount = $amount * $exchangeRate;

                echo "$amount $baseCurrency is equivalent to $convertedAmount $targetCurrency";
            } else {
                echo "Currency code $targetCurrency not found in the exchange rates data.";
            }
        } else {
            echo "Error fetching exchange rates.";
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>
