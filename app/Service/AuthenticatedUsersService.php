<?php

namespace App\Service;

use App\Models\User;

class AuthenticatedUsersService
{
    public static function getUserFromSession()
    {
        if (!isset($_COOKIE['user_id'])) {
            return null;
        }

        return User::find($_COOKIE['user_id']);
    }
}