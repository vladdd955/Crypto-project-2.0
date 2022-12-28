<?php


namespace App\Repository;


use App\Redirect;
use App\Session;
use Carbon\Carbon;


class CryptoTradeRepository
{
    private float $totalMoney;

    public function showWallet(): float|int
    {
        $resultSet = DatabaseRepository::getConnection()->executeQuery(
            'SELECT money  FROM cryptoWallet WHERE user_id = ?', [Session::getSession("id")]);
        $userWallet = $resultSet->fetchAllAssociative();
        $totalMoney = 0;
        foreach ($userWallet as $money) {
            $totalMoney += (float)$money["money"];
        }
        return $this->totalMoney = $totalMoney;
    }


    public function cryptoTrade($buyAmount, $buyMethod, $idSession): Redirect
    {

        $symbol = $buyMethod->getSymbol();
        $price = $buyMethod->getPrice();


        $this->showWallet();
            $date = Carbon::now();
            if (($price * (float)$buyAmount) <= $this->totalMoney) {

                DatabaseRepository::getConnection()->executeQuery(
                    'INSERT INTO cryptoWallet SET 
                    user_id = ?, 
                    price = ?,
                    trade_date = ?, 
                    coin_symbol = ?, 
                    coin_amount=?, 
                    money = ?', [
                        $idSession,
                        $price,
                        $date,
                        $symbol,
                        "+" . $buyAmount,
                        "-" . $price * (int)$buyAmount,
                        ]);

            } else {
                    echo "dd";

            }

        return new Redirect("/userPage");
    }


}
