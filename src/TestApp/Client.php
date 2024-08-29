<?php

declare(strict_types=1);

namespace TestApp;

use TestApp\Entity\{ListCoin, CoinOHLC};
use TestApp\Exception\EndpointNotImplemented;
use TestApp\Type\EndpointEnum;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Client
{
    private HttpClient $httpClient;
    private Serializer $serializer;

    public function __construct()
    {
        $this->httpClient = new HttpClient();
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    /**
     * @return ListCoin[]
     */
    public function getCoinsList(array $params = []): array
    {
        $resBody = $this->httpClient
            ->makeRequest(EndpointEnum::CoinsList->value, $params)
            ->getBody();

        return $this->standartMapping($resBody, ListCoin::class);
    }

    /**
     * @return CoinOHLC[]
     */
    public function getCoinsOHLC($id, array $params = []): array
    {
        $resBody = $this->httpClient
            ->makeRequest(sprintf(EndpointEnum::CoinsOHLC->value, $id), $params)
            ->getBody();

        return $this->orderMapping($resBody, 5, CoinOHLC::class);
    }

    // ....

    // ....

    // ....

    /**
     * @return mixed[]
     */
    public function standartMapping($resBody, string $to): array
    {
        $resList = [];

        foreach(json_decode($resBody) as $item) {
            $resList[] = $this->serializer->deserialize(json_encode($item), $to, 'json');
        }

        return $resList;
    }

    /**
     * @return mixed[]
     */
    public function orderMapping($resBody, $size, string $to): array
    {
        $resList = [];

        foreach(json_decode($resBody) as $item) {
            $vals = [];

            for($x = 0; $x < $size; $x++) {
                $vals[] = $item[$x];
            }

            $resList[] = new $to(...$vals);
        }

        return $resList;
    }

}
