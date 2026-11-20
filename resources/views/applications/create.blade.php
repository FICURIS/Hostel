@extends('layouts.main')

@section('header-title')
    Оформление брони
@endsection

@section('content')
<div class="main-container">
    <h1>Оформление брони</h1>

    @if($errors->any())
        <div class="block-errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="auth-card">
        <h2>{{ $bed->room->title }}</h2>
        <p>Цена: {{ $bed->room->price }} ₽ / ночь</p>

        <form action="{{ route('applications.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="bed_id">Выберите место:</label>
                <select name="bed_id" id="bed_id" required>
                    @foreach($availableBeds as $availableBed)
                        <option value="{{ $availableBed->id }}" {{ $availableBed->id == $bed->id ? 'selected' : '' }}>
                            Место №{{ $availableBed->number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="check_in">Дата заезда</label>
                <input type="date" name="check_in" id="check_in" required min="{{ now()->toDateString() }}" value="{{ $checkIn ?? old('check_in') }}">
            </div>

            <div class="form-group">
                <label for="check_out">Дата выезда</label>
                <input type="date" name="check_out" id="check_out" required min="{{ now()->addDay()->toDateString() }}" value="{{ $checkOut ?? old('check_out') }}">
            </div>

            <div class="payment-section">
                <label>Способ оплаты</label>
                
                <div class="form-group">
                    <label>
                        <input type="radio" name="payment_method" value="При заезде" checked> При заезде
                    </label>
                    <label>
                        <input type="radio" name="payment_method" value="Картой онлайн"> Картой онлайн
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-book">Подтвердить бронирование</button>
        </form>
    </div>
</div>
@endsection