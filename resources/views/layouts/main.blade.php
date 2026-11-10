<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('header-title')</title>
</head>
<body>
    <header>
        <a href="requests.html" class="logo">Конференции.РФ</a>
        @auth   
        <nav>
            <a href="{{ route('requests') }}">Мои заявки</a>
            <a href="{{ route('create_requests') }}">Новая заявка</a>
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <button type="submit" class="link-btn">Выйти</button>
            </form>
        
        @endauth
            <a href="{{ route('register') }}">Регистрация</a>
            <a href="{{ route('authorization') }}">Войти</a>
        @guest
        </nav>

        @endguest
    </header>
    <main class="container">
    @yield('content')
    </main>
</body>
</html>