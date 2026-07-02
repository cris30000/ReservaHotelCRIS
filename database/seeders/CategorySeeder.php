<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'description' => '5 Estrellas',
                'iva' => 21.00,
            ],
            [
                'description' => '4 Estrellas',
                'iva' => 21.00,
            ],
            [
                'description' => '3 Estrellas',
                'iva' => 10.00,
            ],
            [
                'description' => '2 Estrellas',
                'iva' => 10.00,
            ],
            [
                'description' => '1 Estrella',
                'iva' => 10.00,
            ],
            [
                'description' => 'Boutique',
                'iva' => 21.00,
            ],
            [
                'description' => 'Eco Hotel',
                'iva' => 10.00,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

