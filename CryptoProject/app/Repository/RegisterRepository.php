<?php


namespace App\Repository;


use App\Models\RegisterServiceRequest;
use App\Redirect;

class RegisterRepository
{
    public function registerStart(RegisterServiceRequest $request): Redirect
    {
        $userEmail = $request->getEmail();
        $checkEmail = DatabaseRepository::getConnection()->executeQuery("SELECT email FROM users WHERE email = '$userEmail' ")->rowCount();
        if ($checkEmail == 1) {
            return new Redirect("/register");
        } elseif($request->getPassword() === $request->getRePassword()) {


            DatabaseRepository::getConnection()->insert('users', [
                "name" => $request->getName(),
                "email" => $request->getEmail(),
                "password" => md5($request->getPassword()),
            ]);

            $_SESSION["hello"] = "{$request->getname()} you successfully registered. Now you can press Log in";

        } else {
            $_SESSION["password"] = "Password does not match confirmation, please try again!";
        }
        return new Redirect("/authorization");
    }
}