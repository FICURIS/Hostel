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
@endsection