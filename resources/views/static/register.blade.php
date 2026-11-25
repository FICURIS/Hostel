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

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const phoneInput = document.getElementById('phone');
        if (!phoneInput) return;

        phoneInput.addEventListener('input', function (e) {
            let digits = this.value.replace(/\D/g, '');

            if (!digits) {
                this.value = '';
                return;
            }

            if (digits[0] !== '8') digits = '8' + digits;

            digits = digits.substring(0, 11);

            let formatted = '8';
            if (digits.length > 1) formatted += '(' + digits.substring(1, 4);
            if (digits.length >= 5) formatted += ')' + digits.substring(4, 7);
            if (digits.length >= 8) formatted += '-' + digits.substring(7, 9);
            if (digits.length >= 10) formatted += '-' + digits.substring(9, 11);

            this.value = formatted;
        });
    });
</script>
@endsection