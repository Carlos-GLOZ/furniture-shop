<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'name' => 'Armario',
                'description' => 'Espacioso armario empotrado',
                'price' => 225.50
            ],
            [
                'name' => 'Escritorio',
                'description' => 'Sencillo escritorio con espacio para almacenamiento de sobra',
                'price' => 85.00
            ],
            [
                'name' => 'Silla de escritorio',
                'description' => 'Cómoda silla de escritorio',
                'price' => 45.00
            ],
            [
                'name' => 'Sillón',
                'description' => 'Un cómodo sillón',
                'price' => 123.45
            ],
            [
                'name' => 'Sofá',
                'description' => 'Sofá de cuero artificial negro',
                'price' => 336.68
            ],
        ]);
    }
}
