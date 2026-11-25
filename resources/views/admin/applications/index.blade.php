@extends('layouts.main')

@section('header-title')
    Панель администратора
@endsection

@section('content')

<div class="main-container">
    <h1 class="page-title">Управление заявками</h1>

    @if(session('success'))
        <div class="alert-success" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-grid">
        @forelse($applications as $app)
            <div class="admin-card">
                <h2>Заявка №{{ $app->id }}</h2>

                <div class="app-details">
                    <p><strong>Гость:</strong> {{ $app->user->name }}</p>
                    <p><strong>Номер:</strong> {{ $app->bed->room->title ?? '—' }} (Место №{{ $app->bed->number ?? '—' }})</p>
                    <p><strong>Даты:</strong> {{ \Carbon\Carbon::parse($app->check_in)->format('d.m.Y') }} — {{ \Carbon\Carbon::parse($app->check_out)->format('d.m.Y') }}</p>
                    <p><strong>Оплата:</strong> {{ $app->payment_method ?? 'При заезде' }}</p>
                </div>

                <form action="{{ route('admin.applications.status', $app->id) }}" method="POST" class="admin-form">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="status-{{ $app->id }}">Статус заявки:</label>
                        <select name="status" id="status-{{ $app->id }}" class="form-select">
                            <option value="Новая" {{ $app->status == 'Новая' ? 'selected' : '' }}>Новая</option>
                            <option value="Подтверждена" {{ $app->status == 'Подтверждена' ? 'selected' : '' }}>Подтверждена</option>
                            <option value="Заселение" {{ $app->status == 'Заселение' ? 'selected' : '' }}>Заселение</option>
                            <option value="Завершена" {{ $app->status == 'Завершена' ? 'selected' : '' }}>Завершена</option>
                            <option value="Отменена" {{ $app->status == 'Отменена' ? 'selected' : '' }}>Отменена</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-book" style="width: 100%;">Сохранить</button>
                </form>
            </div>
        @empty
            <div class="admin-card" style="text-align: center; grid-column: 1 / -1;">
                <p>Заявок пока нет.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection