<?php


namespace App\Models;


use App\Models\Collections\CryptoCurrenciesCollection;


class UserPageRequest extends CryptoCurrenciesCollection
{
    private ?int $price;
    private ?string $date;
    private ?string $coinSymbol;
    private ?string $coinAmount;
    private ?float $money;



    public function __construct(?int $price = null, ?string $date =null, ?string $coinSymbol = null, ?string $coinAmount = null, ?float $money = null)
   {

       $this->price = $price;
       $this->date = $date;
       $this->coinSymbol = $coinSymbol;
       $this->coinAmount = $coinAmount;
       $this->money = $money;


   }


    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function getCoinSymbol(): ?string
    {
        return $this->coinSymbol;
    }

    public function getCoinAmount(): ?string
    {
        return $this->coinAmount;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }


}

