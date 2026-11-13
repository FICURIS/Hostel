@extends('layouts.main')

@section('header-title')
Номера
@endsection

@section('content')
<div class="main-container">
    <h1>Доступные номера</h1>

    @forelse($rooms as $room)
    <div class="room-card">
        <h2>{{ $room->title }}</h2>
        <p>{{ $room->description }}</p>
        <p>Цена: {{ $room->price }} ₽ </p>
    </div>
    @empty
    <p>Пока нет номеров</p>
    @endforelse
</div>
@endsection