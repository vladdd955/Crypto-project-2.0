<?php


namespace App;


class Validation
{
    public function registerValidation(array $post): void
    {
        if ($post["password"] !== $post["rePassword"]) {
            $_SESSION["errors"]["password"] = "Password does not match confirmation";
        }
    }
}