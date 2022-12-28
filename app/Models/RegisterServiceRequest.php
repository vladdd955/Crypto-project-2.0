<?php

namespace App\Models;

class RegisterServiceRequest
{
    private string $name;
    private string $email;
    private string $password;
    private string $rePassword;


    public function __construct(string $name, string $email, string $password, string $rePassword)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->rePassword = $rePassword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRePassword(): string
    {
        return $this->rePassword;
    }

}
