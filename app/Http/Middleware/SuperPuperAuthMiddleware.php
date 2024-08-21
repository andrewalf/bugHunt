<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SuperPuperAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.forms.login');
        }

        if (!$request->user()) {
            return redirect()->route('auth.forms.login')->withErrors(['email' => 'Пользователь не найден']);
        }

        View::share('logged_user', $request->user());

        return $next($request);
    }
}