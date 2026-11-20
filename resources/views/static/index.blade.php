@extends('layouts.main')

@section('header-title')
Главная
@endsection

@section('content')

@if(session('success'))
<div class="alert-success">{{ session('success') }}</div>
@endif

<div class="main-container">
</div>
<div class="search-section">
    
    <div class="search-block">
        <h2>Найти свободное место</h2>

        <form action="{{ route('rooms.index') }}" method="GET" class="search-form">
            @csrf

            <div class="form-row">
                <label for="check_in">Дата заезда</label>
                <input type="date" name="check_in" id="check_in" required min="{{now()->toDateString() }}" value="{{ old('check_in') }}">
            </div>
            <div class="form-row">
                <label for="check_out">Дата выезда</label>
                <input type="date" name="check_out" id="check_out" required min="{{now()->addDay()->toDateString() }}" value="{{ old('check_out') }}">
            </div>
            <button type="submit" class="btn-search">Найти</button>
        </form>
    </div>
</div>

<div class="rooms-grid">
    @forelse($rooms as $room)
        @include('partials.room-card', ['room' => $room])
     @empty
        <p>Пока нет доступных номеров.</p>
    @endforelse
</div>

<div class="reviews-section">
    <h2 class="page-title">Отзывы наших гостей</h2>

    <div class="reviews-grid">
        @forelse($reviews as $review)
        <div class="review-card">
            <div class="review-header">
                <span class="review-author">{{ $review->user->name ?? 'Гость' }}</span>
            </div>
            <p class="review-text">{{ $review->text }}</p>
        </div>
        @empty
        <p class="no-reviews">Пока нет отзывов.</p>
        @endforelse
    </div>
</div>
@endsection