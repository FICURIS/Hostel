@extends('layouts.main')

@section('header-title')
Главная
@endsection

@section('content')

@if(session('success'))
<div class="alert-success">{{ session('success') }}</div>
@endif

<div class="main-container">
    <h1 class="page-title">Главная</h1>

</div>

<div class="search-block">
    <h2>Найти свободное место</h2>

    <form action="{{ route('rooms.index') }}" method="GET">
        @csrf

        <div class="form-row">
            <label for="check_in">Дата заезда</label>
            <input type="date" name="check_in" id="check_in" required min="{{now()->toString() }}" value="{{ old('check_in') }}">
        </div>
        <div class="form-row">
            <label for="check_out">Дата выезда</label>
            <input type="date" name="check_out" id="check_out" required min="{{now()->addDay()->toDateString() }}" value="{{ old('check_out') }}">
        </div>
        <button type="submit">Найти</button>
    </form>
</div>


@auth
<div class="review">
    <div class="block-errors">
        <h2>Оставить отзыв</h2>
        @if($errors->review->any())
            <div class="block-errors">
                <ul>
                    @foreach($errors->review->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reviews.store')}}" method="POST">
            @csrf

            <label for="text">Ваш отзыв</label>
            <textarea name="text" id="text" rows="5" required minlength="10" maxlength="1000" placeholder="Расскажите о вашем проживании">{{ old('text') }}</textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>
</div>
@endauth
@endsection