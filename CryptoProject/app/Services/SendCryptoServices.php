<?php


namespace App\Services;


use App\Models\SendCryptoRequest;
use App\Redirect;
use App\Repository\SendRepository;

class SendCryptoServices
{

    public function execute(SendCryptoRequest $request): Redirect
    {
        return (new SendRepository())->sendCrypto($request);
    }

}