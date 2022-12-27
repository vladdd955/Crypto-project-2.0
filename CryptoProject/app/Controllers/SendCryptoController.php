<?php


namespace App\Controllers;


use App\Models\SendCryptoRequest;
use App\Redirect;
use App\Repository\DatabaseRepository;
use App\Services\SendCryptoServices;
use App\Session;

class SendCryptoController
{
    public function sendCrypto(): Redirect
    {
        $postService = new SendCryptoServices();
       return $postService->execute(
            new SendCryptoRequest(
                $_POST["coinAmount"],
                $_POST["symbol"],
                $_POST["idToSend"],
                md5($_POST["password"]))
        );

    }

}














//////////////////////////////////////////////////
///
///
///
//namespace App\Controllers;
//
//
//use App\Redirect;
//use App\Repository\DatabaseRepository;
//use App\Session;
//
//class SendCryptoController
//{
//    public function sendCrypto()
//    {
//
//        $sendAmount = $_POST["coinAmount"];
//        $symbol = $_POST["symbol"];
//        $idToSend = $_POST["idToSend"];
//        $password = md5($_POST["password"]);
//
//
//        $resultSet = DatabaseRepository::getConnection()->executeQuery(
//            'SELECT coin_symbol, coin_amount FROM cryptoWallet WHERE user_id = ?', [Session::getSession("id")]);
//        $users = $resultSet->fetchAllAssociative();
//
//
//        $passwordSearch = DatabaseRepository::getConnection()->executeQuery('SELECT password FROM users WHERE id = ?', [Session::getSession("id")]);
//        $passwordCheck = $passwordSearch->fetchAllAssociative();
////        echo "<pre>";
////            var_dump($passwordCheck);die;
//        if($passwordCheck[0]["password"] == $password) {
//            DatabaseRepository::getConnection()->executeQuery(
//                'INSERT INTO cryptoWallet SET coin_symbol = ?,coin_amount = ?, user_id = ?', [$symbol, "-{$sendAmount}", Session::getSession("id")]
//            );
//            DatabaseRepository::getConnection()->executeQuery(
//                'INSERT INTO cryptoWallet SET  coin_symbol = ?, coin_amount = ?,user_id = ?', [$symbol, "+{$sendAmount}", $idToSend]
//            );
//        } else {
//            var_dump("nesanaca");die;
//        }
//        return new Redirect("/transfer");
//    }
//}
//
//
