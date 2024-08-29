<?php

namespace TestApp\Entity;

class ListCoin
{
    public function __construct(
        private string $id,
        private string $symbol,
        private string $name,
        private ?array $platforms,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlatforms(): array
    {
        return $this->platforms;
    }
}
