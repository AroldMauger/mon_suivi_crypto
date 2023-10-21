<?php
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

require 'vendor/autoload.php';

$client = new CoinGeckoClient();
$data = $result = $client->coins()->getMarkets('eur');

// Envoyer les données en tant que réponse JSON
header('Content-Type: application/json');
echo json_encode($data);

?>

