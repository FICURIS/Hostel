@extends('layouts.main')

@section('header-title')
Номера
@endsection

@section('content')

<div class="main-container">
    <h1 class="page-title">Номера и цены</h1>
    <div class="rooms-grid">
        @forelse($rooms as $room)
            @include('partials.room-card', ['room' => $room])
        @empty
             <p>Пока нет доступных номеров.</p>
         @endforelse
    </div>
</div>
@endsection