<?php

namespace TestApp\Entity;

class CoinOHLC
{
    public function __construct(
        private int $timestamp,
        private float $open,
        private float $high,
        private float $low,
        private float $close,
    ) {
    }

    public function getOpen(): float
    {
        return $this->open;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getClose(): float
    {
        return $this->close;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
