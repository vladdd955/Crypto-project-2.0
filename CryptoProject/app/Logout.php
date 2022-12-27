<?php


namespace App;


class Logout
{
    public function Logout(): Redirect
    {
        session_destroy();
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        return new Redirect("/");
    }
}