@extends('layouts.main')

@section('header-title')
Регистрация
@endsection

@section('content')
<div class="main-container">
    <div class="main-block">
        <div class="auth-card">
            <h1>Регистрация</h1>
            @if($errors->any())
                <div class="block-errors">
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" placeholder="Введите логин" name="login" id="login" required minlength="6" value="{{ old('login') }}">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" placeholder="Введите пароль" name="password" id="password" required minlength="8">
            </div>
            <div class="form-group">
                <label for="login">Фамилия</label>
                <input type="text" placeholder="Введите фамилию" name="surname" id="surname" required value="{{ old('surname') }}">
            </div>
            <div class="form-group">
                <label for="login">Имя</label>
                <input type="text" placeholder="Введите имя" name="name" id="name" required value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="login">Отчество</label>
                <input type="text" placeholder="Введите отчетсво" name="middlename" id="middlename" required value="{{ old('middlename') }}">
            </div>
            <div class="form-group">
                <label for="login">Email</label>
                <input type="email" placeholder="your.mail@mail.ru" name="email" id="email" required value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="login">Телефон</label>
                <input type="tel" placeholder="8(XXX)XXX-XX-XX" name="phone" id="phone" required value="{{ old('phone') }}">
            </div>
                <button type="submit"class="btn-register">Зарегистрироваться</button>
    
            <div class="auth-links">
                <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
            </div>
            </form>
         </div>
        
    </div>
</div>
@endsection