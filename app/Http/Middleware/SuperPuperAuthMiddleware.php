<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SuperPuperAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!isset($_COOKIE['user_id'])) {
            return redirect()->route('auth.forms.login');
        }

        $userId = $_COOKIE['user_id'];

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('auth.forms.login')->withErrors(['email' => 'Пользователь не найден']);
        }

        View::share('logged_user', $user);

        return $next($request);
    }
}