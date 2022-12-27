<?php


namespace App\Services;

use App\Models\ShortPageRequest;
use App\Redirect;
use App\Repository\ShortOpenRepository;


class ShortOpenServices
{

    public function execute(ShortPageRequest $request): Redirect
    {
        return (new ShortOpenRepository())->shortMethod($request);
    }


}