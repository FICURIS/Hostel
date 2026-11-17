@extends('layouts.main')

@section('header-title')
    Панель администратора
@endsection

@section('content')

<div class="main-container">
    <h1 class="page-title">Управление заявками</h1>

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="admin-grid">
        @forelse($applications as $app)
        <div class="admin-card">
            <h2>Заявка №{{ $app->id }}</h2>

            <div>
                <p>Гость: {{ $app->user->name }}</p>
                <p>Номер: {{ $app->bed->room->title ?? '—' }} (Место №{{ $app->bed->number ?? '—' }})</p>
                <p>Даты: {{ \Carbon\Carbon::parse($app->check_in)->format('d.m.Y') }} — {{ \Carbon\Carbon::parse($app->check_out)->format('d.m.Y') }}</p>
                <p>Оплата: {{ $app->payment_method ?? 'При заезде' }}</p>
            </div>

            <form action="{{ route('admin.applications.status', $app->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <label>Статус заявки</label>
                <select name="status">
                    <option value="Новая" {{ $app->status == 'Новая' ? 'selected' : '' }}>Новая</option>
                    <option value="Подтверждена" {{ $app->status == 'Подтверждена' ? 'selected' : '' }}>Подтверждена</option>
                    <option value="Заселение" {{ $app->status == 'Заселение' ? 'selected' : '' }}>Заселение</option>
                    <option value="Завершена" {{ $app->status == 'Завершена' ? 'selected' : '' }}>Завершена</option>
                    <option value="Отменена" {{ $app->status == 'Отменена' ? 'selected' : '' }}>Отменена</option>
                </select>

                <div>
                    <button type="submit" class="btn-book">Сохранить</button>
                </div>
            </form>
        </div>
        @empty
        
        <div>
            <p>Заявок пока нет./p>
        </div>

        @endforelse
    </div>
</div>

@endsection