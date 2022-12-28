<?php


namespace App\Controllers;


use App\Models\Collections\CryptoCurrenciesCollection;
use App\Models\UserPageRequest;
use App\Repository\CryptoTradeRepository;
use App\Repository\DatabaseRepository;
use App\Template;

class UserWalletController
{

    private CryptoTradeRepository $cryptoTradeRepository;

    public function __construct(CryptoTradeRepository $cryptoTradeRepository)
    {

    $this->cryptoTradeRepository = $cryptoTradeRepository;
    }

    public function showPage(): Template
    {
        return new Template("userPage.twig", [

            "wallet"=>$this->wallet()->all(),
            "walletInfo"=>$this->cryptoTradeRepository->showWallet(),
        ]);
    }


    public function wallet(): CryptoCurrenciesCollection
    {
        $id = $_SESSION["id"];


        $portfolio = DatabaseRepository::getConnection()->executeQuery('SELECT price, trade_date, coin_symbol,coin_amount,money FROM cryptoWallet WHERE user_id =?', [$id]);
        $walletInfo = $portfolio->fetchAllAssociative();


        $showUserInfo = new CryptoCurrenciesCollection();

        foreach ($walletInfo as $walletsInfo) {
            $showUserInfo->add(new UserPageRequest(
                $walletsInfo["price"],
                $walletsInfo["trade_date"],
                $walletsInfo["coin_symbol"],
                $walletsInfo["coin_amount"],
                $walletsInfo["money"],
            ));
        }

        return $showUserInfo;
    }


}
