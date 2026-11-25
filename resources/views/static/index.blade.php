@extends('layouts.main')

@section('header-title')
Главная
@endsection

@section('content')

@if(session('success'))
<div class="alert-success">{{ session('success') }}</div>
@endif

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

        <div class="reviews-list">
            @forelse($reviews as $review)
                <div class="review-block">
                    <div class="review-top">
                        <strong>{{ $review->user->name ?? 'Гость' }}</strong>
                        @if($review->created_at)
                            <span>{{ $review->created_at->format('d.m.Y') }}</span>
                        @endif
                    </div>
                    <div class="review-body">
                        {{ $review->text }}
                    </div>
                </div>
            @empty
                <p class="no-reviews">Пока нет отзывов.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection