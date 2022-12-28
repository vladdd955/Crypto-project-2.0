<?php


namespace App\Services;

use App\Models\LoginServiceRequest;
use App\Redirect;
use App\Repository\DatabaseRepository;

class LoginService
{

    public function getIn(): Redirect
    {
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $resultSet = DatabaseRepository::getConnection()->executeQuery('SELECT * FROM users WHERE email = ?', [$email]);
        $user = $resultSet->fetchAssociative();
        $database = new LoginServiceRequest(
            $user["id"],
            $user["name"],
            $user["email"],
        );
        if ($email == $user["email"] && $user["password"] == $password) {
            $_SESSION['id'] = $database->getId();
            $_SESSION["name"] = $database->getName();
            $_SESSION["email"] = $database->getEmail();



            return new Redirect("/userPage");
        } else {

             $_SESSION["errors"] = "*Your password don't correct";
            return new Redirect("/authorization");
        }
    }
}