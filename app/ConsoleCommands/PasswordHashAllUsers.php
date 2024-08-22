<?php

namespace App\ConsoleCommands;

use App\Models\User;
use Illuminate\Support\Collection;


class PasswordHashAllUsers
{
    public static function run()
    {
        User::chunk(50, function (Collection $users) {
            try {
                foreach ($users as $user) {
                    $password = $user->password;
                    $algInfo = password_get_info($password);

                    if ($algInfo['algo'] === NULL) {
                        $user->password = $password;
                        $user->save();
                    }
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        );
    }
}