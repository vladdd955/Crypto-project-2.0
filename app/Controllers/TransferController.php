<?php


namespace App\Controllers;

use App\Models\CoinAmountShowRequest;
use App\Models\Collections\CryptoCurrenciesCollection;
use App\Repository\DatabaseRepository;
use App\Session;
use App\Template;

class TransferController
{

    public function showTransfer(): CryptoCurrenciesCollection
    {
        $collection = new CryptoCurrenciesCollection();
        $resultSet = DatabaseRepository::getConnection()->executeQuery(
            'SELECT coin_symbol, coin_amount FROM cryptoWallet WHERE user_id = ?', [Session::getSession("id")]);
        $users = $resultSet->fetchAllAssociative();
        $userCoinsSymbolsInDB = [];
        foreach ($users as $symbols) {
            $userCoinsSymbolsInDB[$symbols["coin_symbol"]] []= $symbols["coin_amount"];
        }
        foreach ($userCoinsSymbolsInDB as $key => $value) {
            if(array_sum($value)>0)$collection->add(new CoinAmountShowRequest(array_sum($value),$key));
        }

        return $collection;
    }

    public function showPage(): Template
    {
        return new Template("transfer.twig", [
                "coin"=>$this->showTransfer()->all(),
            ]
        );
    }



}





