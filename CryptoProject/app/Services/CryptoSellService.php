<?php

namespace App\Services;

use App\Redirect;
use App\Repository\CryptoSellRepository;
use App\Repository\CryptoTradeRepository;
use App\Session;

class CryptoSellService
{
    public function sellMethod($sellAmount, $buyMethod): Redirect
    {

        $idSession = Session::getSession("id");

        return (new CryptoSellRepository())->sellCrypto($sellAmount ,$buyMethod, $idSession);

    }
}