<?php


namespace App\Models;


class SendCryptoRequest
{
    public int $sendAmount;
    private string $symbol;
    private int $idToSend;
    private string $password;

    public function __construct(int $sendAmount, string $symbol, int $idToSend, string $password)
    {

        $this->sendAmount = $sendAmount;
        $this->symbol = $symbol;
        $this->idToSend = $idToSend;
        $this->password = $password;
    }

    public function getSendAmount(): int
    {
        return $this->sendAmount;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getIdToSend(): int
    {
        return $this->idToSend;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

