
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
</head>
<body>
    <h1>Currency Converter</h1>

    <form method="post">
        <label for="fromCurrency">From Currency:</label>
        <select name="fromCurrency" id="fromCurrency">
            <option value="USD">US Dollar (USD)</option>
            <option value="EUR">Euro (EUR)</option>
            <option value="GBP">British Pound (GBP)</option>
        </select>

        <br>

        <label for="toCurrency">To Currency:</label>
        <select name="toCurrency" id="toCurrency">
            <option value="USD">US Dollar (USD)</option>
            <option value="EUR">Euro (EUR)</option>
            <option value="GBP">British Pound (GBP)</option>
        </select>

        <br>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">

        <br>

        <input type="submit" value="Convert">
    </form>

    <?php
    // Hardcoded exchange rates (you should use up-to-date rates from an API or database)
    require 'vendor/autoload.php';

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\RequestException;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fromCurrency = $_POST['fromCurrency'];
        $toCurrency = $_POST['toCurrency'];
        $amount = floatval($_POST['amount']);

        if (isset($exchangeRates[$fromCurrency]) && isset($exchangeRates[$fromCurrency][$toCurrency])) {
            $conversionRate = $exchangeRates[$fromCurrency][$toCurrency];
            $convertedAmount = $amount * $conversionRate;
            echo "<p>$amount $fromCurrency is equal to $convertedAmount $toCurrency.</p>";
        } else {
            echo "<p>Invalid currency selection.</p>";
        }
    }
    ?>
</body>
</html>
