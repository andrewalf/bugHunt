<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('password-hash', function () {
    User::chunk(50, function (Collection $users) {
        foreach ($users as $user) {
            $password = $user->password;
            $algInfo = password_get_info($password);

            if ($algInfo['algo'] === NULL) {
                $user->password = Hash::make($password, [
                    'rounds' => 12,
                ]);
                $user->save();
            }
        }
    });
});