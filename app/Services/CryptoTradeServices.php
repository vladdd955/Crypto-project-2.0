<?php

namespace App\Services;


use App\Redirect;
use App\Repository\CryptoTradeRepository;
use App\Session;

class CryptoTradeServices
{

    public function sellBuyMethod($buyAmount, $buyMethod): Redirect
    {

        $idSession = Session::getSession("id");

        return (new CryptoTradeRepository())->cryptoTrade($buyAmount ,$buyMethod, $idSession);

    }

}

