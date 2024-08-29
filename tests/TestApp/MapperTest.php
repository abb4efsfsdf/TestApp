<?php

require_once "./bootstrap.php";

use TestApp\Entity\{ListCoin, CoinOHLC};
use Tester\Assert;

class MapperTest extends BaseTestCase
{
    public function testStandartMapper(): void
    {
        $res = $this->client->standartMapping($this->listSource, ListCoin::class);

        $currCoin = $res[0];

        Assert::same($currCoin->getId(), "01coin");
        Assert::same($currCoin->getSymbol(), "zoc");
        Assert::same($currCoin->getName(), "01coin");

        $currCoin = $res[count($res) - 5];
        Assert::same($currCoin->getId(), "zyncoin-2");
    }

    public function testOrderMapper(): void
    {
        $res = $this->client->orderMapping($this->ohlcSource, 5, CoinOHLC::class);

        $currOHLC = $res[0];

        Assert::same($currOHLC->getTimestamp(), 1724778000000);
        Assert::same($currOHLC->getOpen(), 2608.21);
        Assert::same($currOHLC->getHigh(), 2608.21);
        Assert::same($currOHLC->getLow(), 2607.79);
        Assert::same($currOHLC->getClose(), 2607.79);

        $currOHLC = $res[count($res) - 5];

        Assert::same($currOHLC->getTimestamp(), 1724855400000);
        Assert::same($currOHLC->getOpen(), 2529.08);
        Assert::same($currOHLC->getHigh(), 2551.96);
        Assert::same($currOHLC->getLow(), 2529.08);
        Assert::same($currOHLC->getClose(), 2551.96);
    }
}

(new MapperTest)->run();
