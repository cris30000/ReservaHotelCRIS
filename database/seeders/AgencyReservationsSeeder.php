<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgencyReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencies = Agency::all();
        $rooms = Room::all();

        foreach ($agencies as $agency) {
            // Cada agencia hace entre 2 y 5 reservas
            $numReservations = rand(2, 5);
            
            for ($i = 0; $i < $numReservations; $i++) {
                $room = $rooms->random();
                
                // 70% fechas futuras, 30% fechas pasadas
                if (rand(1, 100) <= 70) {
                    // Fechas futuras
                    $startDate = Carbon::now()->addDays(rand(1, 90));
                    $endDate = (clone $startDate)->addDays(rand(2, 10));
                } else {
                    // Fechas pasadas
                    $startDate = Carbon::now()->subDays(rand(1, 60));
                    $endDate = (clone $startDate)->addDays(rand(2, 7));
                }

                DB::table('agency_reservations')->insert([
                    'agency_id' => $agency->id,
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