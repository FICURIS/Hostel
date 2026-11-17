@extends('layouts.main')

@section('header-title')
    Оплата бронирования
@endsection

@section('content')

<div class="main-container">
    <h1>Оплата картой</h1>

    <div class="auth-card">
        <h2>{{ $bed->room->title }} (Место №{{ $bed->number }})</h2>
        <p> Даты: с {{ \Carbon\Carbon::parse($check_in)->format('d.m.Y') }} по {{ \Carbon\Carbon::parse($check_out)->format('d.m.Y') }}</p>

        <form action="{{ route('applications.payment.process') }}" method="POST">
            @csrf
            <input type="hidden" name="bed_id" value="{{ $bed->id }}">
            <input type="hidden" name="check_in" value="{{ $check_in }}">
            <input type="hidden" name="check_out" value="{{ $check_out }}">

            <div class="form-group">
                <label>Номер карты</label>
                <input type="text" name="card_number" placeholder="0000 0000 0000 0000" required maxlength="19">
            </div>
            <div class="form-group">
                <label>Срок действия</label>
                <input type="text" name="card_expiry" placeholder="ММ/ГГ" required maxlength="5">
            </div>
            <div class="form-group">
                <label>CVC</label>
                <input type="password" name="card_cvc" placeholder="***" required maxlength="3">
            </div>

            <button type="submit" class="btn-book">Оплатить</button>
        </form>
    </div>
</div>


@endsection