<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Bed;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        if (Room::count() > 0) {
            $this->command->info('Номера уже существуют в базе.');
            return;
        }

        $roomsData = [
            [
                'title'       => 'Общий номер «Солнечный»',
                'description' => 'Уютный однокомнатный номер с тремя двухъярусными кроватями.',
                'size'        => 6,
                'price'       => 500.00,
                'image'       => '/image/sunny.jpg',
            ],
            [
                'title'       => 'Общий номер «Уютный»',
                'description' => 'Уютный однокомнатный номер с двумя двухъярусными кроватями.',
                'size'        => 4,
                'price'       => 700.00,
                'image'       => '/image/cozy.jpg',
            ],
            [
                'title'       => 'Отдельный номер «Стандарт»',
                'description' => 'Уютный однокомнатный номер с тремя двухъярусными кроватями.',
                'size'        => 6,
                'price'       => 500.00,
                'image'       => '/image/standard.jpg',
            ],
            [
                'title'       => 'Отдельный номер «Люкс»',
                'description' => 'Комфортный однокомнатный номер с двухъярусной кроватью.',
                'size'        => 2,
                'price'       => 1800.00,
                'image'       => '/image/lux.jpg',
            ],
        ];

        foreach ($roomsData as $data) {
            $room = Room::create($data);

            for ($i = 1; $i <= $room->size; $i++) {
                Bed::create([
                    'room_id' => $room->id,
                    'number'  => (string)$i,
                    'status'  => 'free',
                ]);
            }
        }
    }
}