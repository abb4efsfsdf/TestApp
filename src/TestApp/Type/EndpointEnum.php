<?php

namespace TestApp\Type;

enum EndpointEnum: string
{
    // coins
    case CoinsList = 'coins/list';
    case CoinsOHLC = 'coins/%s/ohlc';
}
