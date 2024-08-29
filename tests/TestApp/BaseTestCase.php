<?php 

require_once "./bootstrap.php";

use TestApp\Client;

class BaseTestCase extends Tester\TestCase
{
	protected Client $client;
	protected string $listSource;
	protected string $ohlcSource;

	public function setUp(): void
	{
		$this->client = new Client();
		$this->listSource = file_get_contents("./data/coingecko/coins/list.json");
		$this->ohlcSource = file_get_contents("./data/coingecko/coins/OHLC.json");
	}
}	
