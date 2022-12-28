<?php


namespace App\Controllers;


use App\Redirect;
use App\Services\CryptoCurrency\ListCryptoService;
use App\Services\CryptoSellService;


class CryptoSellController
{
    private ListCryptoService $listCryptoService;

    public function __construct(ListCryptoService $listCryptoService)
    {
        $this->listCryptoService = $listCryptoService;
    }

    public function cryptoSell($symbol): Redirect
    {
        $sellAmount = $_POST["sellAmount"];

        $buyMethod = $this->listCryptoService->execute($symbol["symbol"]);
        return (new CryptoSellService())->sellMethod($sellAmount, $buyMethod);
    }
}