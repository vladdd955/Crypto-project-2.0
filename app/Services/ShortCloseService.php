<?php


namespace App\Services;

use App\Models\ShortPageRequest;
use App\Redirect;
use App\Repository\ShortCloseRepository;
use App\Repository\ShortOpenRepository;

class ShortCloseService
{
    public function execute(ShortPageRequest $request): Redirect
    {
        return (new ShortCloseRepository())->shortClose($request);
    }
}