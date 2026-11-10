@extends('layouts.main')

@section('header-title')
Регистрация
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
        <h1>Регистрация</h1>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <label for="login">Логин</label>
            <input type="text" placeholder="Введите логин" name="login" id="login" required minlength="6" value="{{ old('login') }}">

            <label for="password">Пароль</label>
            <input type="password" placeholder="Введите пароль" name="password" id="password" required minlength="8">

            <label for="login">ФИО</label>
            <input type="text" placeholder="Иванов Иван Иванович" name="name" id="name" required value="{{ old('name') }}">

            <label for="login">Email</label>
            <input type="email" placeholder="your.mail@mail.ru" name="email" id="email" required value="{{ old('email') }}">

            <label for="login">Телефон</label>
            <input type="tel" placeholder="8(XXX)XXX-XX-XX" name="phone" id="phone" required value="{{ old('phone') }}">

            <button type="submit">Зарегестрироваться</button>

            <a href="{{ route('authorization') }}">Уже есть аккаунт? Войти</a>
        </form>
    </div>
</div>
@endsection