<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    const LOGIN_COOKIE_NAME = 'user_id';

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $users = User::all();

        foreach ($users as $user) {
            if ($user->email == $request->email && $user->password == $request->password) {
                setcookie(self::LOGIN_COOKIE_NAME, $user->id, time() + (86400 * 30), "/");
                $request->session()->put('user', $user);
                return redirect()->route('products.list');
            }
        }

        return back()->withErrors(['email' => 'Неверные учетные данные']);
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed',
        ]);

        $users = User::all();
        foreach ($users as $user) {
            if ($user->email == $request->email) {
                return back()->withErrors(['email' => 'Пользователь с таким email уже существует']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        setcookie(self::LOGIN_COOKIE_NAME, $user->id, time() + (86400 * 30), "/");
        $request->session()->put('user', $user);
        return redirect()->route('products.list');
    }

    public function logout(Request $request)
    {
        setcookie(self::LOGIN_COOKIE_NAME, '', time() - 3600, '/');
        $request->session()->forget('user');
        return redirect('/');
    }
}