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
    </div>
</div>
@endauth
@endsection