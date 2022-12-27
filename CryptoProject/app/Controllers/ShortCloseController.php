<?php


namespace App\Controllers;

use App\Models\ShortPageRequest;
use App\Redirect;
use App\Services\ShortCloseService;
use App\Services\ShortOpenServices;

class ShortCloseController
{
    public function shortSell(): Redirect
    {

        $service = new ShortCloseService();
        return $service->execute(
            new ShortPageRequest(
                $_POST["shortSell"],
                $_POST["symbol"],
            )
        );
    }
}