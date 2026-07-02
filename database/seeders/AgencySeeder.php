<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
   {
        $agencies = [
            [
                
                'name' => 'Viajes Europa',
                'address' => 'Paseo de la Castellana 89, Madrid',
                'phone' => '+34 917654321',
                'name_contact' => 'Juan Pérez'
            ],
            [
                
                'name' => 'World Travel',
                'address' => 'Av. Diagonal 456, Barcelona',
                'phone' => '+34 932109876',
                'name_contact' => 'María López'
            ],
            [
                
                'name' => 'Tropical Tours',
                'address' => 'Calle San Francisco 12, Málaga',
                'phone' => '+34 951234567',
                'name_contact' => 'Carlos García'
            ],
        ];

        foreach ($agencies as $agency) {
            Agency::create($agency);
        }
    }
}

