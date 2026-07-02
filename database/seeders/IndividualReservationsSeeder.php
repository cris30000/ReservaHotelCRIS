<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Individual;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IndividualReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $individuals = Individual::all();
        $rooms = Room::all();

        foreach ($individuals as $individual) {
            // Cada particular hace entre 1 y 3 reservas
            $numReservations = rand(1, 3);
            
            for ($i = 0; $i < $numReservations; $i++) {
                $room = $rooms->random();
                
                // Generar fechas
                $startDate = Carbon::now()->addDays(rand(1, 30));
                $endDate = (clone $startDate)->addDays(rand(1, 4));

                DB::table('individual_reservations')->insert([
                    'individual_id' => $individual->id,
                    'room_id' => $room->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}