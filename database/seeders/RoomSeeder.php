<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rooms;
use App\Models\Beds;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Room::count() > 0) {
            $this->command->info('Номера уже существуют, пропускаем.');
            return;
        }

        $rooms = [
            [
                'title'       => 'Общий номер «Солнечный»',
                'description' => 'Светлый общий номер на 6 мест с общим санузлом.',
                'size'        => 6,
                'price'       => 700.00,
                'image'       => 'https://picsum.photos/seed/room1/600/400',
            ],
            [
                'title'       => 'Общий номер «Уютный»',
                'description' => 'Общий номер на 4 места с окнами во двор.',
                'size'        => 4,
                'price'       => 850.00,
                'image'       => 'https://picsum.photos/seed/room2/600/400',
            ],
            [
                'title'       => 'Отдельный номер «Стандарт»',
                'description' => 'Отдельный двухместный номер с собственной ванной.',
                'size'        => 2,
                'price'       => 1800.00,
                'image'       => 'https://picsum.photos/seed/room3/600/400',
            ],
            [
                'title'       => 'Отдельный номер «Люкс»',
                'description' => 'Отдельный номер повышенной комфортности.',
                'size'        => 2,
                'price'       => 2500.00,
                'image'       => 'https://picsum.photos/seed/room4/600/400',
            ],
        ];

        foreach ($rooms as $data) {
            $room = Room::create($data);

            for ($i = 1; $i <= $room->size; $i++) {
                Bed::create([
                    'room_id' => $room->id,
                    'number'  => (string) $i, // если оставите string в миграции
                    'status'  => 'free',
                ]);
            }
        }
    }
}
