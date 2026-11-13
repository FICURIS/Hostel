@extends('layouts.main')

@section('header-title')
Номера
@endsection

@section('content')
<div class="main-container">
    <h1>Доступные номера</h1>

    @forelse($rooms as $room)
    <div class="room-card">
        @if($room->image)
        <img src="{{ asset('storage/' .$room->image) }}" alt="{{ $room->title }}">
        @else
        <div class="No_image"><p>Нет фото</p></div>
        @endif

        <h2>{{ $room->title }}</h2>
        <p>{{ $room->description }}</p>
        <p>Вместимость:{{ $room->size }} чел.</p>
        <p>Цена: {{ $room->price }} ₽ </p>
    </div>
    @empty
    <p>Пока нет номеров</p>
    @endforelse
</div>
@endsection