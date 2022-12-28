<?php

namespace App\Models;

class LoginServiceRequest
{
    private string $id;
    private string $name;
    private string $email;



    public function __construct(string $id,
                                string $name,
                                string $email,

                                            )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;

    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): string
    {
        return $this->id;
    }

}