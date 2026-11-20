<div class="rooms-grid">
        @forelse($rooms as $room)
            <div class="room-card">
                <div class="room-image">
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->title }}">
                    @else
                        <div class="no-image">Нет фото</div>
                    @endif
                </div>
                <div class="room-info">
                    <h3>{{ $room->title }}</h3>
                    <p class="room-desc">{{ $room->description }}</p>
                    <p class="room-capacity">Вместимость: {{ $room->size }} чел.</p>
                    <p class="room-price">Цена: <strong>{{ $room->price }} ₽</strong></p>
                    
                    <a href="{{ route('applications.create', ['bed_id' => $room->beds->first()->id, 'check_in' => request('check_in'), 'check_out' => request('check_out')]) }}" class="btn-book">Забронировать</a>
                </div>
            </div>
        @empty
            <p>Пока нет доступных номеров.</p>
        @endforelse
    </div>