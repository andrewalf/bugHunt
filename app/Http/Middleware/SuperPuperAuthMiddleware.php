<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;

class SuperPuperAuthMiddleware extends Authenticate
{
    protected function redirectTo($request)
    {
        return 'auth/login';
    }
}