@extends('layouts.main')

@section('header-title')
Мои заявки
@endsection

@section('content')
<div class="main-container">
    <h1 class="page-title">Мои заявки</h1>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="applications-list">
        @forelse($applications as $app)
        <div class="app-card">
            <div class="app-header">
                <h2>Заявка №{{ $app->id }}</h2>

                <span class="status-badge">
                    {{ $app->status }}
                </span>
            </div>
            <div class="app-details">
                <p><strong>Номер:</strong> {{ $app->bed->room->title ?? 'Неизвестно' }} (Место №{{ $app->bed->number ?? '—' }})</p>
                <p><strong>Даты:</strong> с {{ \Carbon\Carbon::parse($app->check_in)->format('d.m.Y') }} по {{ \Carbon\Carbon::parse($app->check_out)->format('d.m.Y') }}</p>
                <p><strong>Оплата:</strong> {{ $app->payment_method ?? 'При заезде' }}</p>
            </div>
            <div class="app-actions">
                @if($app->status === 'Заселение')
                    @if(\App\Models\Review::where('user_id', auth()->id())->exists())
                        <p>Вы уже оставили отзыв. Спасибо!</p>
                    @else
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <textarea name="text" rows="3" placeholder="Оставьте ваш отзыв о проживании" required minlength="10"></textarea>
                            <button type="submit">Оставить отзыв</button>
                        </form>
                    @endif

                @elseif($app->status === 'Подтверждена')
                    <p>Вы можете оставить отзыв после заселения.</p>
                @elseif($app->status === 'Новая')
                    <p>Ожидает подтверждения администратором</p>
                @elseif($app->status === 'Отменена')
                    <p>Заявка отменена</p>
                @elseif($app->status === 'Завершена')
                    <p>Проживание завершено. Спасибо, что были у нас!</p>
                @endif
            </div>
        </div>
        @empty
        <div class="app-card">
            <p>У вас пока нет заявок на бронирование.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection