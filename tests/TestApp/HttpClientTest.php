<?php 

require_once "./bootstrap.php";

use TestApp\Entity\{ListCoin, CoinOHLC};
use TestApp\HttpClient;
use TestApp\Type\EndpointEnum;
use Tester\Assert;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class HttpClientTest extends BaseTestCase
{
	public function testCoinsList(): void
	{
		$mock = new MockHandler([
			new Response(200, [], $this->listSource),
		]);

		$handlerStack = HandlerStack::create($mock);
		$httpClient = new HttpClient($handlerStack);

		$response = $httpClient->makeRequest(EndpointEnum::CoinsList->value);
		
		Assert::same($response->getStatusCode(), 200);

		// array size
		Assert::same(count(json_decode($response->getBody())), 14645);
	}

	public function testCoinsOHLC(): void
	{
		$mock = new MockHandler([
			new Response(200, [], $this->ohlcSource),
		]);

		$handlerStack = HandlerStack::create($mock);
		$httpClient = new HttpClient($handlerStack);
		$params = ['vs_currency' => 'usd', 'days' => 1];

		$response = $httpClient->makeRequest(
			sprintf(EndpointEnum::CoinsOHLC->value, "chain-key-ethereum"), 
			$params
		);
		
		Assert::same($response->getStatusCode(), 200);

		// array size
		Assert::same(count(json_decode($response->getBody())), 48);
	}
}

(new HttpClientTest)->run();
