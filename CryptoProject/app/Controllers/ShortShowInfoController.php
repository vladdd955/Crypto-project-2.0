<?php


namespace App\Controllers;


use App\Models\CoinAmountShowRequest;
use App\Models\Collections\CryptoCurrenciesCollection;
use App\Repository\CryptoTradeRepository;
use App\Repository\DatabaseRepository;
use App\Session;
use App\Template;

class ShortShowInfoController
{
    private CryptoTradeRepository $cryptoTradeRepository;

    public function __construct(CryptoTradeRepository $cryptoTradeRepository)
    {

        $this->cryptoTradeRepository = $cryptoTradeRepository;
    }
    public function shortInfo(): CryptoCurrenciesCollection
    {
        $collection = new CryptoCurrenciesCollection();
        $result = DatabaseRepository::getConnection()->executeQuery(
            'SELECT short_symbol, short_amount, short_price FROM short WHERE short_user_id = ?', [Session::getSession("id")]);
        $short = $result->fetchAllAssociative();
        $shortInfo = [];
        foreach ($short as $symbols) {
            $shortInfo[$symbols["short_symbol"]] []= $symbols["short_amount"];
        }
        foreach ($shortInfo as $key => $value) {
            if(array_sum($value)>0)$collection->add(new CoinAmountShowRequest(array_sum($value),$key)) ;
        }
        return $collection;
    }

    public function showPage(): Template
    {
        return new Template("shortPage.twig", [
            "shortInfo"=>$this->shortInfo()->all(),
            "walletInfo"=>$this->cryptoTradeRepository->showWallet(),
        ]);
    }
}
