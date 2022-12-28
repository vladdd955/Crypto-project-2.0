<?php

namespace App\Controllers;

use App\Models\RegisterServiceRequest;
use App\Redirect;
use App\Services\RegisterService;
use App\Template;

class RegistrationController
{

    public function showPage(): Template
    {
        return new Template("register.twig");
    }

    public function store(): Redirect
    {

        $registerService = new RegisterService();
        $registerService->execute(
             new RegisterServiceRequest(
                $_POST["name"],
                $_POST["email"],
                $_POST["password"],
                $_POST["rePassword"]

            )
        );
        return new Redirect("/register");
    }
}

