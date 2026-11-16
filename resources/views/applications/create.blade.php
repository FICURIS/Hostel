@extends('layouts.main')

@section('header-title')
    Оформление брони
@endsection

@section('content')
<div class="main-container">
    <h1>Оформление брони</h1>

    @if($errors->any())
        <div class="block-errors" style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="auth-card">
        <h2>{{ $bed->room->title }} (Место №{{ $bed->number }})</h2>
        <p>Цена: {{ $bed->room->price }} ₽ / ночь</p>
    

        <form action="{{ route('applications.store') }}" method="POST">
            @csrf

            <input type="hidden" name="bed_id" value="{{ $bed->id }}">

            <div class="form-group">
                    <label for="check_in">Дата заезда</label>
                    <input type="date" name="check_in" id="check_in" required min="{{ now()->toDateString() }}" value="{{ request('check_in', old('check_in')) }}">
            </div>

            <div class="form-group">
                    <label for="check_out">Дата выезда</label>
                    <input type="date" name="check_out" id="check_out" required min="{{ now()->addDay()->toDateString() }}" value="{{ request('check_out', old('check_out')) }}">
            </div>

            <button type="submit" class="btn-book">Подтвердить бронирование</button>
        </form>
    </div>
</div>
@endsection