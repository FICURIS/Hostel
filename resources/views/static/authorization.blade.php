@extends('layouts.main')

@section('header-title')
Авторизация
@endsection

@section('content')
@if($errors->any())
    <div class="block-errors">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="main-container">
    <div class="main-block">
        <h1>Авторизация</h1>
        <form action="{{ route('authorization.post') }}" method="POST">
            <label for="login">Логин</label>
            <input type="text" placeholder="Введите логин" name="login" id="login" required minlength="6" value="{{ old('login') }}">

            <label for="password">Пароль</label>
            <input type="password" placeholder="Введите пароль" name="password" id="passsword" required minlength="8">

            <button type="submit">Войти</button>

            <a href="{{ route('login') }}">Еще не зарегистрированы? Регистрация</a>
        </form>
    </div>
</div>
@endsection