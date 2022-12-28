<?php declare(strict_types=1);

namespace App\Models;

use App\Models\Collections\CryptoCurrenciesCollection;

class CryptoCurrency extends CryptoCurrenciesCollection
{
    private string $symbol;
    private string $name;
    public float $price;
    private float $percentChange24h;

    public function __construct(string $symbol, string $name, float $price, float $percentChange24h)
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->price = $price;
        $this->percentChange24h = $percentChange24h;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPercentChange1h(): float
    {
        return $this->percentChange1h;
    }

    public function getPercentChange7d(): float
    {
        return $this->percentChange7d;
    }

    public function getPercentChange24h(): float
    {
        return $this->percentChange24h;
    }

}
