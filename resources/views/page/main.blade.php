@extends('main')

@section('title', 'Супер Сайт')

@section('content')
    <div class="row justify-content-center">
        <div class="col-auto">
            <img src="php.png" class="img-fluid" style="height: 400px; object-fit: cover;">
        </div>

        <p class="mt-3">Нет аккаунта? <a href="{{ route('auth.forms.register') }}">Зарегистрироваться</a></p>

        <p class="mt-3">Уже есть аккаунт? <a href="{{ route('auth.forms.login') }}">Войти</a></p>
    </div>
@endsection