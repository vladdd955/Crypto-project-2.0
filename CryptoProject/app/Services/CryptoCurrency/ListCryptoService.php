<?php


namespace App\Services\CryptoCurrency;


use App\Models\CryptoCurrency;
use App\Repository\CryptoCurrenciesRepository;

class ListCryptoService
{
    private CryptoCurrenciesRepository $cryptoCurrenciesRepository;

    public function __construct(CryptoCurrenciesRepository $cryptoCurrenciesRepository)
    {
        $this->cryptoCurrenciesRepository = $cryptoCurrenciesRepository;
    }

    public function execute(string $symbol): CryptoCurrency
    {
        return $this->cryptoCurrenciesRepository->fetchBySymbol($symbol);
    }
}