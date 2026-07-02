<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['description' => '5 Estrellas'],
            ['description' => '4 Estrellas'],
            ['description' => '3 Estrellas'],
            ['description' => '2 Estrellas'],
            ['description' => '1 Estrella'],
            ['description' => 'Boutique'],
            ['description' => 'Eco Hotel'],
            ['iva' => 21.00],
            ['iva' => 10.00],
            ['iva' => 5.00],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

