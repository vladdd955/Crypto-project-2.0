<?php


namespace App\Repository;

use App\Models\ShortPageRequest;
use App\Redirect;
use App\Services\CryptoCurrency\ListCryptoCurrenciesService;
use App\Session;
use Carbon\Carbon;

class ShortCloseRepository
{
    public function shortClose(ShortPageRequest $request): Redirect
    {
        $result = DatabaseRepository::getConnection()->executeQuery(
            'SELECT buy_sell, short_price, short_symbol, short_amount, short_time FROM short
        WHERE short_user_id = ?', [Session::getSession("id")]
        );


        $userMoney = $result->fetchAllAssociative();
        $totalMoney = 0;

        foreach ($userMoney as $value) {
            $totalMoney += $value["short_price"];
        }



        $newConnect = new ListCryptoCurrenciesService();
        $getCoinInfo = $newConnect->execute([$request->getShortSymbol()]);



        $currencyPrice = 0;
        foreach ($getCoinInfo->all() as $getPriceFromApi) {
            $currencyPrice = $getPriceFromApi->price;
        }


        DatabaseRepository::getConnection()->executeQuery('INSERT INTO short SET
                short_user_id = ?,
                buy_sell = ?,
                short_price = ?,
                short_symbol = ?,
                short_amount = ?,
                short_time = ?', [
                Session::getSession("id"),
                "close_short",
                "+" .$currencyPrice,
                $request->getShortSymbol(),
                "-". $request->getShortAmount(),
                Carbon::now()
            ]);

        $date = Carbon::now();
        DatabaseRepository::getConnection()->executeQuery('INSERT INTO cryptoWallet SET 
                money = ?,
                user_id = ?,
                coin_symbol = ?, 
                trade_date = ?', [
            "+".$currencyPrice,
            Session::getSession("id"),
            $request->getShortSymbol(),
            $date
        ]);


        return new Redirect("/shortPage");
    }

}