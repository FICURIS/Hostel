@extends('layouts.main')

@section('header-title')
Номера
@endsection

@section('content')

<div class="main-container">
    <h1 class="page-title">Номера и цены</h1>
    <div class="rooms-grid">
        @forelse($rooms as $room)
            <div class="room-card">
                <div class="room-image">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->title }}">
                    @else
                        <div class="no-image">Нет фото</div>
                    @endif
                </div>
                <div class="room-info">
                    <h3>{{ $room->title }}</h3>
                    <p class="room-desc">{{ $room->description }}</p>
                    <p class="room-capacity">Вместимость: {{ $room->size }} чел.</p>
                    <p class="room-price">Цена: <strong>{{ $room->price }} ₽</strong></p>
                    
                    <a href="#" class="btn-book">Забронировать</a>
                </div>
            </div>
        @empty
            <p>Пока нет доступных номеров.</p>
        @endforelse
    </div>
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