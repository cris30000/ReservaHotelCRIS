<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Category;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Grand Plaza',
                'address' => 'Av. Principal 123, Madrid',
                'phone' => '+34 912345678',
                'año' => 2020,
                'category_id' => Category::where('description', '5 Estrellas')->first()->id
            ],
            [
                'name' => 'Marina Beach',
                'address' => 'Calle del Mar 45, Barcelona',
                'phone' => '+34 934567890',
                'año' => 2018,
                'category_id' => Category::where('description', '4 Estrellas')->first()->id
            ],
            [
                'name' => 'Mountain View',
                'address' => 'Camino de la Sierra 78, Granada',
                'phone' => '+34 958765432',
                'año' => 2015,
                'category_id' => Category::where('description', '3 Estrellas')->first()->id
            ],
            [
                'name' => 'Boutique Palace',
                'address' => 'Calle Mayor 56, Sevilla',
                'phone' => '+34 954321098',
                'año' => 2022,
                'category_id' => Category::where('description', 'Boutique')->first()->id
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}