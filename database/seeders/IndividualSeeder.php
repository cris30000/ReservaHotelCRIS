<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Individual;

class IndividualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
   {
        $individuals = [
            [
                
                'name' => 'María García',
                'address' => 'Calle Mayor 10, Madrid',
                'phone' => '+34 654321098'
            ],
            [
                
                'name' => 'Juan Pérez',
                'address' => 'Av. Libertad 25, Barcelona',
                'phone' => '+34 698765432'
            ],
            [
                
                'name' => 'Ana Martínez',
                'address' => 'Calle Real 15, Sevilla',
                'phone' => '+34 687654321'
            ],
        ];

        foreach ($individuals as $individual) {
            Individual::create($individual);
        }
    }
}
