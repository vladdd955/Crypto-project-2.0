<?php


namespace App\Controllers;


use App\Redirect;
use App\Services\CryptoCurrency\ListCryptoService;
use App\Services\CryptoTradeServices;


class CryptoTradeController
{
    private ListCryptoService $listCryptoService;

    public function __construct(ListCryptoService $listCryptoService)
    {
        $this->listCryptoService = $listCryptoService;
    }

    public function cryptoTrade($symbol): Redirect
    {
        $buyAmount = $_POST["buyAmount"];


        $buyMethod = $this->listCryptoService->execute($symbol["symbol"]);
        return (new CryptoTradeServices())->sellBuyMethod($buyAmount, $buyMethod);
    }
}





/////////////////////////////////////////TEST CODE////////////////////////////////////////////////////////














//
//namespace App\Controllers;
//
//
//
//use App\Redirect;
//use App\Repository\DatabaseRepository;
//
//class CryptoTradeController
//{
//    public function cryptoTrade()
//    {
//
//        if ($_POST["buyAmount"] === "") {
//            unset($_POST["buyAmount"]);
//        }
//        if ($_POST["sellAmount"] === "") {
//            unset($_POST["sellAmount"]);
//        }
//
//        $idSession = $_SESSION["id"];
//
//        $symbol = ($_SESSION["symbol"]->all()[0]->getSymbol());
//        $price = ($_SESSION["symbol"]->all()[0]->getPrice());
//
//
//        $resultSet = DatabaseRepository::getConnection()->executeQuery(
//            'SELECT money  FROM cryptoWallet WHERE user_id = ?', [$idSession]);
//        $userWallet = $resultSet->fetchAllAssociative();
//        $totalMoney = 0;
//        foreach ($userWallet as $moneyCount) {
//            $totalMoney += (int)$moneyCount["money"];
//
//        }
//
//
//        if (isset($_POST["buyAmount"])) {
//
//
//            if (($price * $_POST["buyAmount"]) <= $totalMoney) {
//
//
//                DatabaseRepository::getConnection()->executeQuery(
//                    'INSERT INTO cryptoWallet SET user_id = ?, price = ?, coin_symbol = ?, coin_amount=?, money = ?', [$idSession, $price, $symbol, "+" . $_POST["buyAmount"], "-" . $price * $_POST["buyAmount"]]);
//                unset($_SESSION["symbol"]);
//            } else {
//
//                $_SESSION["message"] = "You don't have enough money to buy this amount of coins. Total in wallet: $totalMoney$";
//            }
//        }
//        $resultSet = DatabaseRepository::getConnection()->executeQuery(
//            'SELECT coin_symbol, coin_amount FROM cryptoWallet WHERE user_id = ? AND coin_symbol = ?', [$idSession, $symbol]);
//        $user = $resultSet->fetchAllAssociative();
//
//        $items = 0;
//
//        foreach ($user as $item) {
//            $items += (int)$item["coin_amount"];
//        }
//        if (isset($_POST["sellAmount"])) {
//            if (($_POST["sellAmount"]) <= $items) {
//                DatabaseRepository::getConnection()->executeQuery(
//                    'INSERT INTO cryptoWallet SET user_id = ?, price = ?, coin_symbol = ?, coin_amount = ?, money = ?', [$idSession, $price, $symbol, "-" . $_POST["sellAmount"], "+" . $price * $_POST["sellAmount"]]);
//                unset($_SESSION["symbol"]);
//            } else {
//                $_SESSION["message"] = "You don't have enough coins to sell this amount. Total in wallet: $items";
//            }
//        }
//        return new Redirect("/userPage");
//    }
//}
//
