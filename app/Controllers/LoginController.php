<?php

namespace App\Controllers;

use App\Template;

class LoginController
{

    public function showPage(): Template
    {
        return new Template("authorization.twig");
    }
}