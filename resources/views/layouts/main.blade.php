<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('header-title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a href="#" class="logo">Хостел</a>
            <nav class="main-nav">
            @auth
                <a href="{{ route('index') }}"></a>
                <a href="{{  route('index') }}">Главная</a>
                <a href="{{ route('applications.index') }}">Мои заявки</a>

                @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                <a href="{{ route('admin.applications.index') }}">Панель админа</a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="link-btn">Выйти</button>
                </form>
            @endauth
            @guest

                <a href="{{ route('register') }}">Регистрация</a>
                <a href="{{ route('login') }}">Войти</a>
            @endguest
            </nav>
        </div>
    </header>
    <main class="container">
    @yield('content')
    </main>
</body>
</html>