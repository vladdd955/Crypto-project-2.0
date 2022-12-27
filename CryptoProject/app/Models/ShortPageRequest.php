<?php


namespace App\Models;


class ShortPageRequest
{
    private float $shortAmount;
    private string $shortSymbol;


    public function __construct(float $shortAmount, string $shortSymbol)
    {
        $this->shortAmount = $shortAmount;

        $this->shortSymbol = $shortSymbol;
    }

    public function getShortAmount(): float
    {
        return $this->shortAmount;
    }

    public function getShortSymbol(): string
    {
        return $this->shortSymbol;
    }

}

