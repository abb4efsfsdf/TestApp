<?php

declare(strict_types=1);

namespace TestApp;

use TestApp\Provider\{Guzzle, IProvider};
use TestApp\Entity\{ListCoin, CoinOHLC};
use TestApp\Exception\EndpointNotImplemented;
use TestApp\Type\EndpointEnum;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

class HttpClient
{
    private GuzzleClient $client;

    /** @var string[] */
    private array $defaultHeaders;

    public function __construct($handler = null)
    {
        $handlerStack = HandlerStack::create($handler ?? new CurlHandler());

        $this->client = new GuzzleClient([
            "base_uri" => $_ENV["COINGECKO_API_BASE_URI"],
            "handler" => $handlerStack
        ]);

        $this->defaultHeaders = [
            "accept" => "application/json",
            $_ENV["COINGECKO_AUTH_METHOD_NAME"] => $_ENV["COINGECKO_API_KEY"]
        ];
    }

    public function makeRequest(
        string $path,
        array $params = [],
        array $header = [],
        string $method = "GET"
    ): ResponseHandler {
        if(strtolower($method) !== "get") {
            throw new HttpMethodNotImplemented();
        }

        $res = $this->client->request($method, $path, [
            "header" => array_merge($this->getDefaultHeaders(), $header),
            "query" => $params
        ]);

        return new ResponseHandler($res->getStatusCode(), (string) $res->getBody());
    }

    public function getDefaultHeaders()
    {
        return $this->defaultHeaders;
    }
}
