<?php


namespace App\Controllers;


use App\Models\ShortPageRequest;
use App\Redirect;
use App\Services\ShortOpenServices;


class ShortOpenController
{

    public function shortBuy(): Redirect
    {

        $service = new ShortOpenServices();
        return $service->execute(
            new ShortPageRequest(
             $_POST["shortBuy"],
             $_POST["symbol"],
            )
        );
    }
}
