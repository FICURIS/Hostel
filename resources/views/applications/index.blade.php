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
                <p>Номер: №{{ $app->bed->number ?? '-' }}</p>
                <p>Даты проживания: с {{ \Carbon\Carbon::parse($app->check_in)->format('d.m.Y') }} по {{ \Carbon\Carbon::parse($app->check_out)->format('d.m.Y') }}</p>
            </div>
            <div class="app-actions">
                @if($app->status === 'Подтверждена')
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <textarea name="text" rows="3" placeholder="Оставьте ваш отзыв о проживании..." required minlength="10"></textarea>
                    <button type="submit">Оставить отзыв</button>
                </form>
                @elseif($app->status === 'Новая')
                <p>Ожидает подтверждения администратором</p>
                @elseif($app->status ==='Отменена')
                <p>Заявка отменена</p>
                @elseif($app->status === 'Завершена')
                <p>Проживание завершено</p>
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