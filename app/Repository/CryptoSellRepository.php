<?php


namespace App\Repository;


use App\Redirect;
use App\Session;
use Carbon\Carbon;

class CryptoSellRepository
{

    public function sellCrypto($sellAmount, $buyMethod, $idSession): Redirect
    {


        $symbol = $buyMethod->getSymbol();
        $price = $buyMethod->getPrice();



        $resultSet = DatabaseRepository::getConnection()->executeQuery(
            'SELECT coin_symbol, coin_amount FROM cryptoWallet WHERE user_id = ? AND coin_symbol = ?', [$idSession, $symbol]);
        $user = $resultSet->fetchAllAssociative();

        $items = 0;
        $date = Carbon::now();
        foreach ($user as $item) {
            $items += (int)$item["coin_amount"];
        }
        if (isset($sellAmount)) {
            if (($sellAmount) <= $items) {
                DatabaseRepository::getConnection()->executeQuery(
                    'INSERT INTO cryptoWallet SET 
                        user_id = ?,
                        price = ?,
                        trade_date =?,
                        coin_symbol = ?, 
                        coin_amount = ?, 
                        money = ?', [
                    $idSession,
                    $price,
                    $date,
                    $symbol,
                    "-" . $sellAmount,
                    "+" . $price * (int)$sellAmount]);

            } else {
                echo "dd";
            }
        }
        return new Redirect("/userPage");
    }


}