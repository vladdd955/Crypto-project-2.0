<?php


namespace App\Models;


use App\Models\Collections\CryptoCurrenciesCollection;



class CoinAmountShowRequest extends CryptoCurrenciesCollection
{
    private string $symbol;
    private float $count;

    public function __construct(float $count, string $symbol)
    {
        $this->symbol = $symbol;
        $this->count = $count;
    }

    public function getCount(): float
    {
        return $this->count;
    }


    public function getSymbol(): string
    {
        return $this->symbol;
    }
}

