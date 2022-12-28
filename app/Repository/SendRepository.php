<?php


namespace App\Repository;


use App\Redirect;
use App\Session;

class SendRepository
{
    public function sendCrypto($request): Redirect
    {
        $resultSet = DatabaseRepository::getConnection()->executeQuery(
            'SELECT coin_symbol, coin_amount FROM cryptoWallet WHERE user_id= ? AND coin_symbol=? ', [Session::getSession("id"),
                $request->getSymbol(),
                ]
        );
        $checkForMaxCoinAmount = $resultSet->fetchAllAssociative();

        $userCoinsSymbolsInDB = [];
        $DBuserCoinAmount="";

        foreach ($checkForMaxCoinAmount as $symbols) {
            $userCoinsSymbolsInDB[$symbols["coin_symbol"]][]= $symbols["coin_amount"];
        }
        foreach ($userCoinsSymbolsInDB as $value) {
            $DBuserCoinAmount= array_sum($value);
        }

        if($DBuserCoinAmount>=$request->sendAmount) {
            $resultSet = DatabaseRepository::getConnection()->executeQuery(
                'SELECT coin_symbol, coin_amount FROM cryptoWallet WHERE user_id = ?', [Session::getSession("id")]);
             $resultSet->fetchAllAssociative();

            $passwordSearch = DatabaseRepository::getConnection()->executeQuery('SELECT password FROM users WHERE id = ?', [Session::getSession("id")]);
            $passwordCheck = $passwordSearch->fetchAllAssociative();

            $passwordInfo = [];
            foreach ($passwordCheck as $value) {
                $passwordInfo = $value;
            }

            if ($passwordInfo["password"] == $request->getPassword()) {
                DatabaseRepository::getConnection()->executeQuery(
                    'INSERT INTO cryptoWallet SET coin_symbol = ?,coin_amount = ?, user_id = ?', [$request->getSymbol(), "-{$request->getSendAmount()}", Session::getSession("id")]
                );
                DatabaseRepository::getConnection()->executeQuery(
                    'INSERT INTO cryptoWallet SET  coin_symbol = ?, coin_amount = ?,user_id = ?', [$request->getSymbol(), "+{$request->getSendAmount()}", $request->getIdToSend()]
                );

            } else {
                $_SESSION["errors"] = "*Your password don't correct";
                return new Redirect("/transfer");
            }

        } else {
            $_SESSION["coinError"] = "Your coin not enough";
        }

        return new Redirect("/transfer");
    }
}