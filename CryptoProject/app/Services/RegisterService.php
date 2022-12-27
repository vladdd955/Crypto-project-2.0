<?php


namespace App\Services;

namespace App\Services;

use App\Models\RegisterServiceRequest;
use App\Redirect;
use App\Repository\RegisterRepository;

class RegisterService
{

    public function execute(RegisterServiceRequest $request): Redirect
    {
        return (new RegisterRepository())->registerStart($request);
    }
}
