<?php 

// Test interface, may be deleted.

require_once "./src/bootstrap.php";

$client = new TestApp\Client();

echo "<h2>https://docs.coingecko.com/reference/coins-list</h2>";

$params = ['include_platform' => 'true'];
$coinsList = $client->getCoinsList($params);

dump($params);
// first 3 items
for($x = 0; $x < 3; $x++) {
    dump($coinsList[$x]);
}

echo "<h2>https://docs.coingecko.com/reference/coins-id-ohlc</h2>";

$params = ['vs_currency' => 'usd', 'days' => '1'];
$coinsOHLC = $client->getCoinsOHLC("chain-key-ethereum", $params);

dump($params);
dump($coinsOHLC[0]);