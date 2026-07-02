<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Hotel;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
      {
        $roomTypes = [
            [
                'type' => 'Single',
                'price' => 120000,
            ],
            [
                'type' => 'Double',
                'price' => 180000,
            ],
            [
                'type' => 'Family',
                'price' => 250000,
            ],
            [
                'type' => 'Suite',
                'price' => 350000,
            ],
            [
                'type' => 'Presidential Suite',
                'price' => 800000,
            ],
        ];

        foreach (Hotel::all() as $hotel) {

            $roomNumber = 101;

            foreach ($roomTypes as $roomType) {

                Room::create([
                    'number'   => $roomNumber++,
                    'type'     => $roomType['type'],
                    'price'    => $roomType['price'],
                    'hotel_id' => $hotel->id,
                ]);
            }
        }
    }
}
